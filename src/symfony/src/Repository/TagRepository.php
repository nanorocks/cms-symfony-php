<?php

namespace App\Repository;

use App\DataTransferObject\Tag\TagCreateUpdateDto;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @extends ServiceEntityRepository<Tag>
 *
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function createTag(TagCreateUpdateDto $dto): Tag
    {
        $tag = new Tag();

        $tag->setName($dto->name);
        $tag->setDescription($dto->description);
        $tag->setSlug($dto->slug);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($tag);
        $entityManager->flush();

        return $tag;
    }

    public function createIfNotExist(TagCreateUpdateDto $dto): Tag
    {
        $tag = $this->findOneBy(['name' => $dto->name]);

        if (!$tag) {
            $tag = $this->createTag($dto);
        }

        return $tag;
    }

    public function findByName(string $value): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.name LIKE :val')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
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

    public function delete(int $tagId): ?int
    {
        $category = $this->find($tagId);

        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        $entityManager = $this->getEntityManager();
        $entityManager->remove($category);
        $entityManager->flush();

        return $tagId;
    }

    //    /**
    //     * @return Tag[] Returns an array of Tag objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Tag
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
