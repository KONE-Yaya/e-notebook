<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Entity\Repertoire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
    * @return Contact[] Returns an array of Contact objects
    */
    
    public function findBySameId($id): array
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            'SELECT c
            FROM App\Entity\Contact c
            WHERE c.idRep = :id
            '
            )->setParameter('id', $id);
        return $query->getResult();
    }


     /**
    * @return Contact[] Returns an array of Contact objects
    */
    
    public function findBySameIdOder($id): array
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            'SELECT c
            FROM App\Entity\Contact c
            WHERE c.idRep = :id
            ORDER BY c.nomContact, c.prenomContact'
            )->setParameter('id', $id);
        return $query->getResult();
    }


    // /**
    //  * @return Contact[] Returns an array of Contact objects
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
    public function findOneBySomeField($value): ?Contact
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
