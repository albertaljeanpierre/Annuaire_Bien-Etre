<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param Request $request la requête POST pour la recherche des prestataires
     * @return Response
     */
    public function index(Request $request): Response
    {
       // dump($request);
        return $this->render('home/index.html.twig', [
            'requete' => $request
        ]);
    }


    /**
     * @Route("/test", name="app_test")
     *
     */
    public function test( ): Response
    {
        // dump($request);
        return $this->render('home/index.html.twig', [

        ]);
    }
}
