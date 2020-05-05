<?php

namespace App\Repository;

use App\Model\Cards\CardHelper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CardHelper|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardHelper|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardHelper[]    findAll()
 * @method CardHelper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardHelperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardHelper::class);
    }

    // /**
    //  * @return CardHelper[] Returns an array of CardHelper objects
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
    public function findOneBySomeField($value): ?CardHelper
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
