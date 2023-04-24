<?php

namespace App\Controller\Recherche;


use App\Repository\CommuneRepository;
use App\Repository\PrestataireRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuController extends AbstractController
{

    /**
     * Méthode qui recherche la liste des provinces
     * @param ProvinceRepository $provinceRepository
     * @return Response
     */
    public function listeProvince(ProvinceRepository $provinceRepository) : Response
    {
        $listeProvince = $provinceRepository->findByNomUnique();
        //  dd($listeProvince);

        return $this->render('recherche/listeProvince.html.twig', [
            'listeProvince' => $listeProvince,

        ]);
    }


    /**
     * Méthode qui recherche la liste des communes
     * @param CommuneRepository $communeRepository
     * @return Response
     */
    public function listeCommune(CommuneRepository $communeRepository) : Response
    {
        $listeCommune = $communeRepository->findBy([], ['nom' => 'ASC']);
         //  dd($listeCommunes);

        return $this->render('recherche/listeCommunes.html.twig', [
            'listeCommunes' => $listeCommune,

        ]);
    }


    /**
     * Méthode qui recherche la liste des codes postaux
     * @param CommuneRepository $communeRepository
     * @return Response
     */
    public function listeCodePostal(CommuneRepository $communeRepository) : Response
    {
        $listeCodePostal = $communeRepository->findBy([], ['codePostal' => 'ASC']);
          //dd($listeCodePostal);

        return $this->render('recherche/listeCodePostal.html.twig', [
            'listeCodePostal' => $listeCodePostal

        ]);
    }


    /**
     * Méthode qui recherche la liste des noms de prestataires
     * @param PrestataireRepository $prestataireRepository
     * @return Response
     */
    public function listeNomPrestataire(PrestataireRepository $prestataireRepository) : Response
    {
        $listeNomPrestataire = $prestataireRepository->findBy([], ['nom' => 'ASC']);
        //dd($listeCodePostal);

        return $this->render('recherche/listeNomPrestataire.html.twig', [
            'listeNomPrestataire' => $listeNomPrestataire

        ]);
    }

}