<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\PrestataireType;
use App\Form\UserType;
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
            $to = filter_var($to, FILTER_VALIDATE_EMAIL);
            if ($to !== false) {
                $subject = "Inscription à l'annuaire du bien-être";
                $message = "Bonjour, suite à votre inscription à l'annuaire du bien-être, veuillez confirmer votre inscription en cliquant sur le lien suivant:";
                $token = sha1($to);
                $lien = 'http://' . $_SERVER['HTTP_HOST'] . "/inscription/confirmation?mail=" . urlencode($to) . '&amp;token=' . $token;

                $message .= '<br><br><a href="' . $lien . '">Valider mon inscription</a>';
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html; charset=utf-8',
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
    public function confirmationInscription(Request $request, EntityManagerInterface $entityManager): Response
    {
        // dd($request->query->get('mail'));
        //dd($request);
        $mail = $request->query->get('mail');
        $token = $request->query->get('token');
        $tokenVerif = sha1($mail);
        $mailVerif = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if (($token === $tokenVerif) and ($mailVerif !== false)) { // insertion mail en base si l'email n'existe pas encore en base

            $userRepo = $entityManager->getRepository(User::class);
            $userMail = $userRepo->findOneBy(["email" => $mailVerif]);
            //dd($userMail );
            if (is_null($userMail)) { // L'utilisateur ne s'est pas encore inscrit
                $user = new  User();
                $user->setInscription(new \DateTime('now'));
                $user->setInscriptionConfirmee(true);
                $user->setEmail($mailVerif);
                $roles = $user->getRoles();
                $user->setRoles($roles);
                $entityManager->persist($user);
                $entityManager->flush(); // enregistrement en base des données (mail, role, la confirmation d'inscription, date d'inscription)
                return $this->redirectToRoute('app_inscription_etape_2', ['id' => $user->getId()]);


//                return $this->redirectToRoute('app_inscription_etape_2');
//                return $this->render('inscription/formInscription.html.twig', [
//                    'formUser' => $formUser->createView(),
////                    'formPrestataire' => $formPrestataire->createView()
//                ]);
            } else { // l'utilisateur est déjà inscrit
                // dd('erreur utilisateur déjà inscrit');
                $message_erreur = "Vous être déjà inscrit dans notre annuaire.";
                $message_texte = "Si vous avez finalisez votre inscription vous pouvez vous connectez.";
                return $this->render('inscription/erreurInscription.html.twig', [
                    'message_erreur' => $message_erreur,
                    'message_texte' => $message_texte
                ]);
            }

        } else { // affichage message d'erreur si lien corrompu

            $message_erreur = "Une erreur est survenue lors de votre inscription, le lien que vous avez suivis est corrompu.";
            // Pour que le twig puisse interpréter le chemin du path il faut l'échapper aver un ~ et ce contenu doit être du texte pour être interprété par twig.
            $message_texte = "Si vous désirez vous inscrire, <a href=\"\"~{{ path('app_inscription') }}~\"\">recommencer la procedure</a> ou <a href=\"\"~{{ path('app_home') }}~\"\">retournez à l'accueil</a>.";
            return $this->render('inscription/erreurInscription.html.twig', [
                'message_erreur' => $message_erreur,
                'message_texte' => $message_texte
            ]);

        }
    }

    #[Route('/inscription/etappe-2/{id}', name: 'app_inscription_etape_2')]
    public function inscriptionEtape2(Request $request , User $user, EntityManagerInterface $entityManager): Response
    {

        // Création du formulaire dépendant des Entity User
        $formUser = $this->createForm(UserType::class, $user);


        // $formPrestataire = $this->createForm(PrestataireType::class, $prestataire);
        $formUser->handleRequest($request);
        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $user->setTypeUtilisateur('Prestataire');
            $prestataire = new Prestataire();
            $user->setPrestataire($prestataire);
            $prestataire->setUser($user);
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
            $user = $formUser->getData();
            $entityManager->persist($prestataire);
            $entityManager->persist($user);
            $entityManager->flush();
            dump($prestataire);
            dd($user);

            return $this->redirectToRoute('task_success');
        }
        return $this->render('inscription/formInscription.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }


}
