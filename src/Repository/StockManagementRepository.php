<?php

namespace App\Repository;

use App\Entity\StockManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockManagement>
 *
 * @method StockManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockManagement[]    findAll()
 * @method StockManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockManagement::class);
    }

//    /**
//     * @return StockManagement[] Returns an array of StockManagement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StockManagement
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
