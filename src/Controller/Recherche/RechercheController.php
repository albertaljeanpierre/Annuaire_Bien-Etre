<?php

namespace App\Controller\Recherche;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class RechercheController extends AbstractController
{

    public function recherchePrestataire(Request $request)
    {
        $response = "Un texte de réponse";

        return $this->render('recherche/recherchePrestataire.html.twig', [
                'response' => $response
        ]);
    }
}
