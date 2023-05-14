<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Prestataire;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    /**
     * Méthode qui affiche la catégorie en fonction de son non et
     *  (qui affiche les prestataires en rapport avec cette catégorie) => à implémenter ultérieurement
     * @param $name
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/categorie/{name}', name: 'app_categorie_descriptioncategorie')]
    public function descriptionCategorie($name, EntityManagerInterface $entityManager): Response
    {
        $repo = $entityManager->getRepository(Categorie::class);
        // $categorie = $repo->find($id);
        $categories = $repo->findBy(['nom' => $name]);
//        dd($categories);
        if (empty($categories)) { // si pas de catégorie

            return $this->render('categorie/descriptionError.html.twig', [
                'categorieInexistante' => $name,
             ]);
        } else { // si une catégorie existe
            // recherche de cette catégorie dans le tableau qui est retourné de la DB
            $categorie = $categories[0];
            $nomCategorie = $categorie->getNom();
            $idCategorie =  $categorie->getId();

            // recherche des prestataires en fonction du nom de la catégorie
//            $repoPrestataire = $entityManager->getRepository(Prestataire::class);


//            $categorieDuPrestataire = $prestataire->getCategorie();
//            $prestataires = $repoPrestataire->findPrestataireCategoriePagination($categorie , 1, 3, );

//          dd($prestataires);

            return $this->render('categorie/description.html.twig', [
                'categorie' => $categorie
            ]);
        }

    }

    /**
     * Méthode de redirection d'URL en cas de changement par l'utilisateur
     * @return Response
     */
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_home');
    }


    /**
     * Méthode qui recherche et affiche les catégories validée par l'administrateur
     * @param CategorieRepository $categorieRepository
     * @return Response
     */
    public function listeCategorie(CategorieRepository $categorieRepository)
    {
        $categoriesValide = $categorieRepository->findBy(['validite' => true], ['nom' => 'ASC']);


        return $this->render('categorie/listeCategories.html.twig', [
            'categoriesValide' => $categoriesValide
        ]);

    }
}
