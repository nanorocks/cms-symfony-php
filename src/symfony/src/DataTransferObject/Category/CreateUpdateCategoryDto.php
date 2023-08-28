<?php

namespace App\DataTransferObject\Category;

class CreateUpdateCategoryDto
{
    public function __construct(
        public string $name,
        public ?int $parent,
        public string $slug,
        public string $description,
    )  
    {}
}