<?php

namespace App\DataTransferObject\Tag;

class TagCreateUpdateDto
{
    public function __construct(
        public string $name,
        public ?string $description,
    )  
    {}
}