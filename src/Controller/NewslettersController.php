<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewslettersController extends AbstractController
{
    /**
     * Méthode qui affiche la vue en rapport avec la newsletter
     * @return Response
     */
    #[Route('/newsletters', name: 'app_newsletters')]
    public function index(): Response
    {
        return $this->render('newsletters/index.html.twig', [

        ]);
    }
}
