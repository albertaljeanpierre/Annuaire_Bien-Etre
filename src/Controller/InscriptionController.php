<?php

namespace App\Controller;

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
                $lien = 'http://' . $_SERVER['HTTP_HOST'] . "inscription/confirmation?mail=" . urlencode($to) . '&amp;token=' . $token;

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
    function confirmationInscription()
    {

    }
}
