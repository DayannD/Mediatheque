<?php

namespace App\Repository;

use App\Entity\Emprunt;
use App\Entity\Livre;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emprunt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emprunt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emprunt[]    findAll()
 * @method Emprunt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpruntRepository extends ServiceEntityRepository
{   
    private $manager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Emprunt::class);
        $this->manager = $manager;
    }


    public function loan($id,$user)
    {
        $date = new DateTime();
        $emprunt = new Emprunt();

        $livre = $this->manager->find(Livre::class, $id);

        $emprunt->setNameLivre($livre)
                ->setEmail($user)
                ->setDateEmprunt($date)
                ->setIsLoan(false)
                ->setIsRendering(false)
                ;
        $this->manager->persist($emprunt);
        $this->manager->flush();

    }

    public function empruntProfil($id)
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.email = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function notifDate($id)
    {
        return $this->createQueryBuilder('e')
            ->select('e.loanAt')
            ->where('e.email = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function deleteEmprunt($id,$livre)
    {
        return $this->createQueryBuilder('em')
        ->delete(Emprunt::class,'em')
        ->where('em.id = :id')
        ->andWhere('em.name_livre = :livre')
        ->setParameter('id', $id)
        ->setParameter('livre', $livre)
        ->getQuery()
        ->getResult()
        ;
    }


    // /**
    //  * @return Emprunt[] Returns an array of Emprunt objects
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
    public function findOneBySomeField($value): ?Emprunt
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
