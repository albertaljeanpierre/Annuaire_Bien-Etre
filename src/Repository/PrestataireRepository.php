<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prestataire>
 *
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }

    public function save(Prestataire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Prestataire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     *  Recherche tous les prestataires
     * @return Prestataire[] Returns an array of Prestataire objects
     */
    public function findAllOrderByName(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
public function findPrestatairePagination(int $page, int $limit = 6 ) : array
{
    $limit = abs($limit); // Valeur absolue
    $result = [];
    $query = $this->getEntityManager()->createQueryBuilder()
        ->select('p')
        ->from('app\Entity\Prestataire', 'p')
        ->orderBy('p.nom', 'ASC')
        ->setMaxResults($limit)
        ->setFirstResult(($page * $limit) - $limit);
    // dd($query->getQuery()->getResult());
    $paginator = new Paginator($query);
    $data = $paginator->getQuery()->getResult();

    // On vérifie si il y a des données
    if (empty($data)) {
        $result['data'] = null;
        return  $result;
    }
    // on calcule le nombre de pages
    $pages = ceil($paginator->count() / $limit);

    // on remplit le tableau
    $result['data'] = $data;
    $result['pages'] = $pages;
    $result['page'] = $page;
    $result['limit'] = $limit;

    return $result;

}
    public function findPrestataireCategoriePagination( Categorie $categorie , int $page, int $limit = 6, ) : array
    {
        $nomCategorie = $categorie->getNom();
        $limit = abs($limit); // Valeur absolue
        $result = [];
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('app\Entity\Prestataire', 'p')
            ->where('p.categorie IN (:ids)')
            ->setParameter('ids', [22])
//            ->orderBy('p.nom', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($page * $limit) - $limit);



        // dd($query->getQuery()->getResult());
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();

        // On vérifie si il y a des données
        if (empty($data)) {
            $result['data'] = null;
            return  $result;
        }
        // on calcule le nombre de pages
        $pages = ceil($paginator->count() / $limit);

        // on remplit le tableau
        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;

        return $result;

    }
    /**
     * Recherche des prestataires en fonction des critères de recherche du formulaire
     * @return Prestataire[] Returns an array of Prestataire objects
     */
    public function findPrestataireMulti($nomPrestataire = null, $categorie = null): array
    {
        return $this->createQueryBuilder('p')

            ->andWhere('p.nom = :nom')
            //->andWhere('p.categorie = :categorie')
            ->setParameter('nom', $nomPrestataire)
            //->setParameter('categorie', $categorie)
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
//    /**
//     * @return Prestataire[] Returns an array of Prestataire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Prestataire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
