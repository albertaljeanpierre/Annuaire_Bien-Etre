<?php

namespace App\Controller\Recherche;

use App\Entity\Prestataire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    /**
     * Méthode qui recherche les prestataires selon le cas ou le nom du prestataire est entré dans le formulaire de recherche ou
     *  que le formulaire est vide, dans ce cas tous les prestataires seront afficher
     * @Route("/recherchePrestataire", name="app_recherchePrestataire")
     * @param Request $request la requête POST pour la recherche des prestataires
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function recherchePrestataire( Request $request, EntityManagerInterface $entityManager): Response
    {
        // $request est transmis en paramètre de la fonction depuis base.html.twig qui récupère la requête de Request
        // Ce qui permet de récupérer les données de POST dans ce controller
        $page = $request->query->getInt('page', 1);

//        dump($request );
        $data = null;
        $response = "";
        if ($request->request->count() > 0  || $request->get('page')) { // Si il y a des données envoyées en POST ou s'il y a un paramètre page dans l'URL
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
                // recherche de tous les prestataires
                $repo = $entityManager->getRepository(Prestataire::class);
//                $data = $repo->findAllOrderByName();
                // on vas chercher la liste des prestataires paginée
                $data = $repo->findPrestatairePagination($page);

                // dd($data);

            } else {
                // récupération des données du formulaire
                $nomPrestataire = $request->request->get('prestataire');
                // $categorie = $request->request->get('categorie');
                // envoie au repository
                $response = "Recherche selon les données fournies";
                $repo = $entityManager->getRepository(Prestataire::class);
                $data['data'] = $repo->findPrestataireMulti($nomPrestataire );
                $data['pages'] = 1;
                $data['page'] = 1;
                // $data = $request->request;
            }
            //dump($request->request);
             //dd($data);
        }
        return $this->render('recherche/recherchePrestataire.html.twig', [
            'data' => $data,
            'response' => $response
        ]);
    }
}
