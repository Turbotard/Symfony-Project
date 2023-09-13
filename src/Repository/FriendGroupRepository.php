<?php

namespace App\Repository;

use App\Entity\FriendGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FriendGroup>
 *
 * @method FriendGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method FriendGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method FriendGroup[]    findAll()
 * @method FriendGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FriendGroup::class);
    }

//    /**
//     * @return FriendGroup[] Returns an array of FriendGroup objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FriendGroup
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
