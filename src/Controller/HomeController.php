<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Méthode qui affiche la page d'accueil du site
     * @Route("/", name="app_home")
     *
     * @return Response
     */
    public function index(): Response
    {
       // dump($request);
        return $this->render('home/index.html.twig', [

        ]);
    }



}
