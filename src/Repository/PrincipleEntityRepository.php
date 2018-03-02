<?php

namespace App\Repository;

use App\Entity\PrincipleEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrincipleEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipleEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipleEntity[]    findAll()
 * @method PrincipleEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipleEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrincipleEntity::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
