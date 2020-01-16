<?php

namespace App\Repository;

use App\Entity\FilmGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FilmGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmGenre[]    findAll()
 * @method FilmGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmGenre::class);
    }

    // /**
    //  * @return FilmGenre[] Returns an array of FilmGenre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilmGenre
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
