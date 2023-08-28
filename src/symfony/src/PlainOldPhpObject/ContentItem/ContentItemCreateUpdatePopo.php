<?php

namespace App\PlainOldPhpObject\ContentItem;

use App\Entity\Category;
use App\Entity\Media;

class ContentItemCreateUpdatePopo
{
    public int $id;
    public string $name;
    public ?int $parent;
    public string $slug;
    public string $description;
    public ?Media $image;

    public function __construct(
        Category $category
    )  
    {
        $this->id = $category->getId();
        $this->name = $category->getName();
        $this->parent = $category->getParent();
        $this->slug = $category->getSlug();
        $this->description = $category->getDescription();
        $this->image = $category->getImage();
    }


    public function json()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent' => $this->parent,
            'description' => $this->description,
        ];
    }
}