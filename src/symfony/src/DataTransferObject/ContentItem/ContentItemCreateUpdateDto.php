<?php

namespace App\DataTransferObject\ContentItem;

use App\Entity\Media;

class ContentItemCreateUpdateDto
{
    public function __construct(
        public string $name,
        public ?int $parent,
        public string $slug,
        public ?string $description,
        public ?Media $image
    )  
    {}
}