<?php

namespace App\Repository;

use App\Entity\GameParticipantStatistics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameParticipantStatistics|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameParticipantStatistics|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameParticipantStatistics[]    findAll()
 * @method GameParticipantStatistics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameParticipantStatisticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameParticipantStatistics::class);
    }

    // /**
    //  * @return GameParticipantStatistics[] Returns an array of GameParticipantStatistics objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GameParticipantStatistics
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
