<?php

namespace App\PlainOldPhpObject\Category;

use App\Entity\Category;

class CreateUpdateCategoryPopo
{
    public int $id;
    public string $name;
    public ?int $parent;
    public string $slug;
    public string $description;

    public function __construct(
        Category $category
    )  
    {
        $this->id = $category->getId();
        $this->name = $category->getName();
        $this->parent = $category->getParent();
        $this->slug = $category->getSlug();
        $this->description = $category->getDescription();
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