<?php

namespace App\Repository;

use App\DataTransferObject\Category\CategoryCreateUpdateDto;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function createCategory(CategoryCreateUpdateDto $categoryDto)
    {
        $category = new Category();

        $category->setName($categoryDto->name);
        $category->setParent($categoryDto->parent);
        $category->setSlug($categoryDto->slug);
        $category->setImage($categoryDto->image);
        $category->setDescription($categoryDto->description);
        $category->setCreatedAt(new \DateTimeImmutable('now'));

        $entityManager = $this->getEntityManager();
        $entityManager->persist($category);
        $entityManager->flush();

        return $category;
    }

    public function createIfNotExist(CategoryCreateUpdateDto $categoryDto): Category
    {
        $category = $this->findOneBy(['slug' => $categoryDto->slug]);

        if (!$category) {
            $category = $this->createCategory($categoryDto);
        }

        return $category;
    }

//    /**
//     * @return Category[] Returns an array of Category objects
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

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
