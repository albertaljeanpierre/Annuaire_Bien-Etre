<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    /**
     * Méthode qui affiche la vue correspondante à la page a-propos
     * @return Response
     */
    #[Route('/apropos', name: 'app_apropos')]
    public function index(): Response
    {
        return $this->render('apropos/index.html.twig', [

        ]);
    }
}
