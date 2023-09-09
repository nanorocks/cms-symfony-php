<?php

namespace App\Repository;

use App\DataTransferObject\Category\CategoryCreateUpdateDto;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function createCategory(CategoryCreateUpdateDto $dto): Category
    {
        $category = new Category();

        $category->setName($dto->name);
        $category->setParent($dto->parent);
        $category->setSlug($dto->slug);
        $category->setImage($dto->image);
        $category->setDescription($dto->description);
        $category->setCreatedAt();

        $entityManager = $this->getEntityManager();
        $entityManager->persist($category);
        $entityManager->flush();

        return $category;
    }

    public function createIfNotExist(CategoryCreateUpdateDto $dto): Category
    {
        $category = $this->findOneBy(['slug' => $dto->slug]);

        if (!$category) {
            $category = $this->createCategory($dto);
        }

        return $category;
    }

    public function findBySlug(string $value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.slug LIKE :val')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function delete(int $categoryId): ?int
    {
        $category = $this->find($categoryId);

        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        $entityManager = $this->getEntityManager();
        $entityManager->remove($category);
        $entityManager->flush();

        return $categoryId;
    }

    public function findAllOrdered($orderByField = 'createdAt', $direction = 'ASC')
    {
        return $this->createQueryBuilder('c')
            ->orderBy("c.$orderByField", $direction)
            ->getQuery()
            ->getResult();
    }

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
