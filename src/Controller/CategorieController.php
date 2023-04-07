<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    #[Route('/categorie/{name}', name: 'app_categorie_descriptioncategorie')]
    public function descriptionCategorie($name, EntityManagerInterface $entityManager): Response
    {
        $repo = $entityManager->getRepository(Categorie::class);
        // $categorie = $repo->find($id);
        $categories = $repo->findBy(['nom' => $name]);
//        dd($categories);
        if (empty($categories)) {

            return $this->render('categorie/descriptionError.html.twig', [
                'categorieInexistante' => $name,
             ]);
        } else {
            $categorie = $categories[0];
            // dd($categorie);
            return $this->render('categorie/description.html.twig', [
                'categorie' => $categorie
            ]);
        }

    }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_home');
    }



    public function listeCategorie(CategorieRepository $categorieRepository)
    {
        $categoriesValide = $categorieRepository->findBy(['validite' => true], ['nom' => 'ASC']);


        return $this->render('categorie/listeCategories.html.twig', [
            'categoriesValide' => $categoriesValide
        ]);

    }
}
