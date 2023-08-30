<?php

namespace App\PlainOldPhpObject\ContentItem;

use App\Entity\ContentItem;
use App\Entity\Media;
use App\Entity\User;
use App\Enum\ContentItemType;
use Doctrine\Common\Collections\Collection;

class ContentItemCreateUpdatePopo
{
    public int $id;
    public string $title;
    public ?string $slug;
    // public ?string $content;
    public ?string $excerpt;
    // public ?ContentItemType $type;
    // public ?bool $published;
    // public ?\DateTimeImmutable $publishedAt;
    // public ?User $author;
    // public Collection $categories;
    public ?string $videoUrl;
    public Collection $images;
    // public Collection $tags;

    public function __construct(
        ContentItem $contentItem
    )  
    {
        $this->id = $contentItem->getId();
        $this->title = $contentItem->getTitle();
        $this->slug = $contentItem->getSlug();
        $this->excerpt = $contentItem->getExcerpt();
        $this->images = $contentItem->getImage();
        $this->videoUrl = $contentItem->getVideoUrl();
    }


    public function json()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'images' => $this->images,
            'videoUrl' => $this->videoUrl,
        ];
    }
}