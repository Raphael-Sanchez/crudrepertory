<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function findHighestReference()
    {
        $contact = $this->createQueryBuilder('c')
            ->select('MAX(c.reference)')
            ->getQuery()
            ->getOneOrNullResult();

        return $contact;
    }

    public function findByTerms($arrayTerms)
    {
        $qb = $this->createQueryBuilder('c');
        foreach($arrayTerms as $index => $value)
        {
            $qb->orWhere("c.firstname LIKE :firstname$index");
            $qb->setParameter("firstname$index", '%'.$value.'%');
            $qb->orWhere("c.lastname LIKE :lastname$index");
            $qb->setParameter("lastname$index", '%'.$value.'%');
            $qb->orWhere("c.phone LIKE :phone$index");
            $qb->setParameter("phone$index", '%'.$value.'%');
            $qb->orWhere("c.email LIKE :email$index");
            $qb->setParameter("email$index", '%'.$value.'%');
            $qb->orWhere("c.compagny LIKE :compagny$index");
            $qb->setParameter("compagny$index", '%'.$value.'%');
        }
        $qb->orderBy('c.lastname', 'ASC');
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Contact[] Returns an array of Contact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contact
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
