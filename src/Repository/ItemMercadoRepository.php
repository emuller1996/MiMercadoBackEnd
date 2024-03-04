<?php

namespace App\Repository;

use App\Entity\ItemMercado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemMercado>
 *
 * @method ItemMercado|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemMercado|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemMercado[]    findAll()
 * @method ItemMercado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMercadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemMercado::class);
    }

//    /**
//     * @return ItemMercado[] Returns an array of ItemMercado objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ItemMercado
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
