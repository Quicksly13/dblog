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
    public function findAllTitles(): array
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

    /**
     * Outputs an array containing the previous and next neighbours of a principle.
     *
     * @param string $titleToFind
     * @param array $titles
     * @return array
     */
    public function findNeighboursByTitle(string $titleToFind, array $titles = null): array
    {
        if ($titles===null)
        {
            $titles = $this->findAllTitles();
        }
        
        //looping through all titles
        foreach ($titles as $title)
        {
            //if the previous title was the title whose neighbours are to be found
            if (isset($foundTitle))
            {
                $next = $title;
                //end the loop
                break;
            }

            //if this title matches title whose neighbours are to be found
            if ($title===$titleToFind)
            {
                $foundTitle = $title;
            }
            else
            {
                $previous = $title;
            }
        }

        //if no previous title
        if (!isset($previous))
        {
            $previous = null;
        }

        //if no next title
        if (!isset($next))
        {
            $next = null;
        }
        
        return ['previous' => $previous, 'next' => $next];
    }


    
}
