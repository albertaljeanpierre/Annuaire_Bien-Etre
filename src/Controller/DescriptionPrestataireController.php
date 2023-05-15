<?php

namespace App\Controller;

use App\Entity\Prestataire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DescriptionPrestataireController extends AbstractController
{
    /**
     *  Methode qui recherche un prestataire en fonction de son identifiant passer en paramètre dans l'URL
     * @param $id // identifiant d'un prestataire passer dans l'URL
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/fiche-prestataire/{id}', name: 'app_description_prestataire',  defaults: ['id' => 1 ])]
    public function index($id, EntityManagerInterface $entityManager ): Response
    {
        $repo = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repo->find($id);
        // dd($prestataire);

        return $this->render('description_prestataire/index.html.twig', [
            'prestataire' => $prestataire
        ]);
    }
}
