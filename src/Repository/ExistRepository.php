<?php

namespace App\Repository;

use App\Entity\Exist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Exist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exist[]    findAll()
 * @method Exist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exist::class);
    }

    // /**
    //  * @return Exist[] Returns an array of Exist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exist
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
