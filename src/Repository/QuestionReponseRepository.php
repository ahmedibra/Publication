<?php

namespace App\Repository;

use App\Entity\QuestionReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionReponse[]    findAll()
 * @method QuestionReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionReponse::class);
    }

    // /**
    //  * @return QuestionReponse[] Returns an array of QuestionReponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionReponse
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
