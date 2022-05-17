<?php

namespace App\Repository;

use App\Entity\ClassComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassComment[]    findAll()
 * @method ClassComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassComment::class);
    }

    // /**
    //  * @return ClassComment[] Returns an array of ClassComment objects
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
    public function findOneBySomeField($value): ?ClassComment
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
