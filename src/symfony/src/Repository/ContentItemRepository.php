<?php

namespace App\Repository;

use App\Entity\ContentItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContentItem>
 *
 * @method ContentItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContentItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContentItem[]    findAll()
 * @method ContentItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContentItem::class);
    }

//    /**
//     * @return ContentItem[] Returns an array of ContentItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContentItem
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
