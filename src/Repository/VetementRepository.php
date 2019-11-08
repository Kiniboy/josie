<?php

namespace App\Repository;

use App\Entity\Vetement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Vetement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vetement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vetement[]    findAll()
 * @method Vetement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VetementRepository extends ServiceEntityRepository  // lien entre la classe vetement et la base de donnees
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vetement::class);
    }

    /**
     * @return Vetement[]
     */
    public function findAllNonVendu(): array  // fonction qui retourne les articles non vendu
    {
        return $this->findAllQuery()
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllVendu(): array  // fonction qui retourne les articles vendu, non utilisées pour le moment
    {
        return $this->findAllQuery()
            ->where("v.vendu = true")
            ->getQuery()
            ->getResult()
            ;
    }



    private function findAllQuery(): QueryBuilder // fonction qui retourne les articles non vendu également, peut etre modifier en fonction qui retourne tout les articles, il faudra donc modifier findAllNonVendu
    {
        return $this->createQueryBuilder('v')
            ->where("v.vendu = false");
    }




    // /**
    //  * @return Vetement[] Returns an array of Vetement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vetement
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
