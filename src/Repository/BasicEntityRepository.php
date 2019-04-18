<?php

namespace App\Repository;

use App\Entity\BasicEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BasicEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasicEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasicEntity[]    findAll()
 * @method BasicEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasicEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BasicEntity::class);
    }

    // /**
    //  * @return BasicEntity[] Returns an array of BasicEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BasicEntity
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
