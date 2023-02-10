<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request): Response
    {
        $message = null;
        $erreur = null;
        if ($request->request->count() > 0) {
            // dump($request->request);
            // dump($request->request->get('inscription'));
            // Récupération de l'adresse mail envoyé par l'utilisateur
            $to = trim($request->request->get('inscription'));
            $to =  filter_var($to, FILTER_VALIDATE_EMAIL);
            if ($to !== false ) {
                $subject = "Inscription à l'annuaire du bien-être";
                $message = "Bonjour, suite à votre inscription à l'annuaire du bien-être, veuillez confirmer votre inscription en cliquant sur le lien suivant:";
                $token = sha1($to);
                $lien = 'http://' . $_SERVER['HTTP_HOST'] . "/inscription/confirmation?mail=" . urlencode($to) . '&amp;token=' . $token;

                $message .= '<br><br><a href="' . $lien . '">Valider mon inscription</a>';
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html; charset=UTF-8',
                    'From' => 'webmaster@example.com',
                    'Reply-To' => 'webmaster@example.com',

                );


                mail($to, $subject, $message, $headers);
                $message = "Un mail vient d'être envoyer à l'adresse $to, veuillez cliquer sur le lien qui s'y trouve pour confirmer votre inscription.";

            } else {
                $erreur = "Veuillez introduire une adresse mail valide!";
            }

        }

        return $this->render('inscription/index.html.twig', [
            'message' => $message,
            'erreur' => $erreur
        ]);
    }


    #[Route('/inscription/confirmation', name: 'app_inscription_confirmation')]
    function confirmationInscription(Request $request, EntityManagerInterface $entityManager )
    {
        // dd($request->query->get('mail'));
         //dd($request);
        $mail = $request->query->get('mail');
        $token = $request->query->get('token');
        $tokenVerif = sha1($mail);
        $mailVerif = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if ( ($token === $tokenVerif) and ( $mailVerif !== false) ) { // insertion mail en base si l'email n'existe pas encore en base

            $userRepo = $entityManager->getRepository(User::class);
            $userMail = $userRepo->findOneBy(["email" => $mailVerif]);
            //dd($userMail );
            if(is_null($userMail )) { // L'utilisateur ne s'est pas encore inscrit
                $user = new  User();
                $user->setInscription( new \DateTime());
                $user->setInscriptionConfirmee(true);
                $user->setEmail($mailVerif);
                $entityManager->persist($user);
                $entityManager->flush();
            } else { // l'utilisateur est déjà inscrit
                dd('erreur utilisateur déjà inscrit');

            }

        } else { // affichage message d'erreur si lien corrompu
            return $this->render('inscription/erreurInscription.html.twig', [

            ]);

        }
    }
}