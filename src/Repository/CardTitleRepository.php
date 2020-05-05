<?php

namespace App\Repository;

use App\Entity\CardTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CardTitle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardTitle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardTitle[]    findAll()
 * @method CardTitle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardTitleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardTitle::class);
    }

    // /**
    //  * @return CardTitle[] Returns an array of CardTitle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CardTitle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
