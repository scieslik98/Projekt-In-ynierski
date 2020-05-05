<?php

namespace App\Repository;

use App\Model\Cards\CardCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CardCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardCategory[]    findAll()
 * @method CardCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardCategory::class);
    }

    // /**
    //  * @return CardCategory[] Returns an array of CardCategory objects
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
    public function findOneBySomeField($value): ?CardCategory
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
