<?php

namespace App\Repository;

use App\DataTransferObject\ContentItem\ContentItemCreateUpdateDto;
use App\Entity\Category;
use App\Entity\ContentItem;
use App\Entity\Media;
use App\Entity\Tag;
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

    public function createContentItem(ContentItemCreateUpdateDto $contentItemDto)
    {
        $contentItem = new ContentItem();

        $contentItem->setTitle($contentItemDto->title);
        $contentItem->setSlug($contentItemDto->slug);
        $contentItem->setContent($contentItemDto->content);
        $contentItem->setExcerpt($contentItemDto->excerpt);
        $contentItem->setContentItemType($contentItemDto->type);
        $contentItem->setPublished($contentItemDto->published);
        $contentItem->setPublishedAt($contentItemDto->publishedAt);
        $contentItem->setAuthor($contentItemDto->author);

        // foreach($contentItemDto->categories as $category) // ? not sure it will work
        // {
        //     $contentItem->addCategory(new Category($category));
        // }
       
        $contentItem->setVideoUrl($contentItemDto->videoUrl);
        $contentItem->setCreatedAt(new \DateTimeImmutable('now'));

        // foreach($contentItemDto->images as $image) // ? not sure it will work
        // {
        //     $contentItem->addImage(new Media($image));
        // }

        // foreach($contentItemDto->tags as $tag) // ? not sure it will work
        // {
        //     $contentItem->addTag(new Tag($tag));
        // }

        $entityManager = $this->getEntityManager();
        $entityManager->persist($contentItem);
        $entityManager->flush();

        return $contentItem;
    }

    public function createIfNotExist(ContentItemCreateUpdateDto $dto): ContentItem
    {
        $contentItem = $this->findOneBy(['slug' => $dto->slug]);

        if (!$contentItem) {
            $contentItem = $this->createContentItem($dto);
        }

        return $contentItem;
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
