<?php

namespace App\Controller\Recherche;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherchePrestataire", name="app_recherchePrestataire")
     * @param Request $request la requête POST pour la recherche des prestataires
     * @return Response
     */
    public function recherchePrestataire( Request $request): Response
    {
        // $request est transmis en paramètre de la fonction depuis base.html.twig qui récupère la requête de Request
        // Ce qui permet de récupérer les données de POST dans ce controller

//        dump($request );
        $data = null;
        $response = "";
        if ($request->request->count() > 0) { // Si il y a des données envoyées en POST
            function my_empty( $arr)
            {
                foreach ($arr as $key => $value) {
                    if ($value ) {
                        return false;
                    }
                }
                return true;
            }

            if (my_empty($request->request)) {
                $response = "Recherche de tous les prestataires";

            } else {
                $response = "Recherche selon les donnés fournie";
                $data = $request->request;
            }
            //dump($request->request);
        }
        return $this->render('recherche/recherchePrestataire.html.twig', [
            'data' => $data,
            'response' => $response
        ]);
    }
}
