<?php

namespace App\Repository;

use App\Entity\DollarValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DollarValue>
 *
 * @method DollarValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method DollarValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method DollarValue[]    findAll()
 * @method DollarValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DollarValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DollarValue::class);
    }

    public function add(DollarValue $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DollarValue $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getDollarValuesByMonth($initialDate,$endDate){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('dvalues')
            ->from('App:DollarValue','dvalues')
            ->where('dvalues.date BETWEEN :initial AND :end')
            ->setParameter('initial',$initialDate->format('Y-m-d'))
            ->setParameter('end',$endDate->format('Y-m-d'));
        $query = $qb->getQuery();
        return $query->getResult();
    }

//    /**
//     * @return DollarValue[] Returns an array of DollarValue objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DollarValue
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
