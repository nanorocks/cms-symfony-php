<?php

namespace App\DataTransferObject\Tag;

class TagCreateUpdateDto
{
    public function __construct(
        public string $name,
        public string $slug,
        public ?string $description,
    )  
    {}
}