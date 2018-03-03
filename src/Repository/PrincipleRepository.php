<?php

namespace App\Repository;

use App\Entity\Principle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Principle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Principle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Principle[]    findAll()
 * @method Principle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Principle::class);
    }

    /**
     * Outputs an array of all principle titles from the database.
     * The format of the array is as follows
     * [0 => ['title' => title1], 1 => ['title' => title2], 2 => ['title' => title3]]
     *
     * @return array
     */
    public function findAllTitles() : array
    {
        return $this->createQueryBuilder('principle')

            ->select('principle.title')
            ->orderBy('principle.id', 'ASC')
            ->getQuery()//get the query object
            ->getResult()//get the result as an array
        ;
    }
    
}
