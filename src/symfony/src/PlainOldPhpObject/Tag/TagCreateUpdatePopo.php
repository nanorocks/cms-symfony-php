<?php

namespace App\PlainOldPhpObject\Tag;

use App\Entity\Tag;

class TagCreateUpdatePopo
{
    public int $id;
    public string $name;
    public ?string $description;

    public function __construct(
        Tag $tag
    )  
    {
        $this->id = $tag->getId();
        $this->name = $tag->getName();
        $this->description = $tag->getDescription();
    }


    public function json()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}