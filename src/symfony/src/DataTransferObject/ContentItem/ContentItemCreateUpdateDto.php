<?php

namespace App\DataTransferObject\ContentItem;

use App\Entity\User;
use App\Enum\ContentItemType;
use Doctrine\Common\Collections\Collection;

class ContentItemCreateUpdateDto
{
    public function __construct(
        public string $title,
        public ?string $slug,
        public ?string $content,
        public ?string $excerpt,
        public ?ContentItemType $type,
        public ?bool $published,
        public ?\DateTimeImmutable $publishedAt,
        public ?User $author,
        public Collection $categories,
        public ?string $videoUrl,
        public Collection $images,
        public Collection $tags,
    )  
    {}
}