<?php

namespace App\Repository;

use App\Entity\PrincipleEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Principle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Principle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Principle[]    findAll()
 * @method Principle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipleEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrincipleEntity::class);
    }

    /**
     * Outputs an array of all principle titles from the database.
     *
     * @return array
     */
    public function findAllTitles() : array
    {
        $titlesInArray = $this->createQueryBuilder('principle')

            ->select('principle.title')
            ->orderBy('principle.id', 'ASC')
            //get the query object
            ->getQuery()
            //get the result as an array formatted as  [0 => ['title' => title1], 1 => ['title' => title2], 2 => ['title' => title3]]
            ->getResult()
        ;

        //converting the result array into numerically indexed array of just the title columns/keys
        return $arrayOfTitles = array_column($titlesInArray, 'title');
    }
    
}
