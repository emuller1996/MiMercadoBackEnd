<?php

namespace App\Repository;

use App\Entity\Mercado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mercado>
 *
 * @method Mercado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mercado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mercado[]    findAll()
 * @method Mercado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MercadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mercado::class);
    }

//    /**
//     * @return Mercado[] Returns an array of Mercado objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mercado
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
