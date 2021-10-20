<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    protected $manager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Livre::class);
        $this->manager = $manager;
    }

    public function disableBook($id)
    {   
        $this->createQueryBuilder('l')
            ->update(Livre::class, 'l')
            ->set('l.dispo', '0')
            ->Where('l.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    public function search($search)
    {
        return $this->createQueryBuilder('l')
            ->select('l')
            ->where('l.title = :search')
            ->orWhere('l.genre = :search')
            ->setParameter('search', $search)
            ->getQuery()
            ->getResult()
            ;
            
    }

    public function resetBook($id)
    {
        $this->createQueryBuilder('l')
            ->update(Livre::class, 'l')
            ->set('l.dispo', '1')
            ->Where('l.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;           
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
