<?php

namespace App\DataTransferObject\Category;

use App\Entity\Media;

class CategoryCreateUpdateDto
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