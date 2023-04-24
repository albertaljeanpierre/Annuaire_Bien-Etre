<?php

namespace App\Controller\Recherche;

use App\Entity\Categorie;
use App\Entity\Commune;
use App\Entity\Province;
use App\Repository\CategorieRepository;
use App\Repository\CommuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class addDataController extends AbstractController
{

    /**
     * Fonction qui a pour but de lire le tableau de donnée et de les pousser dans la base de donnée
     * @param CategorieRepository $categorieRepository
     * @return Response
     */
    #[Route('/admin/addCategories', name: 'app_add_categories')]
    public function addCategories(CategorieRepository $categorieRepository): Response
    {
        $categories = [];
        $categories[] = ['nom' => 'Coiffeur', 'description' => 'Le coiffeur ou la coiffeuse assure l\'ensemble des soins esthétiques et hygiéniques de votre chevelure. Aux soins courants comme le shampooing, la coupe et le brushing s\'ajoutent le traitement du cuir chevelu, la permanente, les mèches, la couleur et plus rarement la barbe.', 'en_avant' => false, 'validite' => true];
        $categories[] = ['nom' => 'Esthéticien', 'description' => 'L\'esthéticien ou l\'esthéticienne est un professionnel spécialiste de la peau, des cosmétiques, des techniques de soins, de modelages esthétiques, de manucure, de maquillages et d\'épilation.', 'en_avant' => false, 'validite' => true];
        $categories[] = ['nom' => 'Manucure', 'description' => 'La manucure ou le manucure est la personne qui réalise un soin de beauté destiné à embellir les mains et les ongles réalisé par un ou une prothésiste ongulaire. Le mot « manucure » désigne aussi la personne chargée de dispenser ces soins. ', 'en_avant' => false, 'validite' => true];
        $categories[] = ['nom' => 'Pédicure', 'description' => 'La pédicure-podologue est une  spécialiste qui s’occupe des soins et bien être du pied : traitement des affections de la peau et des ongles, etc. ', 'en_avant' => false, 'validite' => true];
        $categories[] = ['nom' => 'Massage', 'description' => 'Le massage, ou la massothérapie est l\'application d\'un ensemble de techniques manuelles qui visent le mieux-être des personnes grâce à l\'exécution de mouvements des mains sur les différents tissus vivants.', 'en_avant' => true, 'validite' => true];
        $categories[] = ['nom' => 'S.P.A . Therme', 'description' => 'Un spa ou centre d\'hydrothérapie est un établissement de soins esthétiques ou de remise en forme à l\'aide de l\'hydrothérapie. Les méthodes utilisées peuvent comprendre le bain et la douche d\'hydromassage, le bain de boue, le bain de vapeur, le sauna, la gymnastique aquatique.', 'en_avant' => false, 'validite' => true];
        $categories[] = ['nom' => 'Tatoueur', 'description' => 'Le tatoueur ou la tatoueuse crée et la réalise de tatouages de différents sujets et de formes variées sur diverses parties du corps. Le tatouage est un dessin décoratif, symbolique ou ethnique effectué avec des aiguilles et de l\'encre.', 'en_avant' => false, 'validite' => true];


        foreach ($categories as $dataCategorie) {
            $categorie = new Categorie();
            $categorie->setNom($dataCategorie['nom']);
            $categorie->setDescription($dataCategorie['description']);
            $categorie->setEnAvant($dataCategorie['en_avant']);
            $categorie->setValidite($dataCategorie['validite']);

            $categorieRepository->save($categorie, true);
        }
        return $this->render('categorie/addCategories.html.twig', [

        ]);
    }

    /**
     * Fonction qui à pour but de lire les données des communes, code postal et province pour les pousser dans la base de donnée
     * @param CommuneRepository $communeRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/admin/addLieu', name: 'app_add_lieu')]
    public function addLieu(CommuneRepository $communeRepository, EntityManagerInterface $entityManager) : Response
    {
        $file =  "http://" . $_SERVER['SERVER_NAME'] . '/data/Region-Ville-CodePostal.json';
        $data = file_get_contents($file, FILE_USE_INCLUDE_PATH);
        $obj = json_decode($data);
        // dd($obj);
        foreach ($obj as $item) {
//            $ville =  $item->ville;
//            $cp =  $item->codePostal;
//            $province =  $item->region;
            $commune = new Commune();
            $province = new Province();
            $province->setNom($item->region);
            $commune->setNom($item->ville);
            $commune->setProvince($province);
            $commune->setCodePostal($item->codePostal);

            $communeRepository->save($commune , true);
        }

        return $this->render('recherche/addLieu.html.twig', [

        ]);
    }
}