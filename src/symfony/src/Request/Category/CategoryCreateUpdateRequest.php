<?php

namespace App\Request\Category;

use App\DataTransferObject\Category\CreateUpdateCategoryDto;
use App\Requests\BaseRequest;

use Symfony\Component\Validator\Constraints as Assert;

class CategoryCreateUpdateRequest extends BaseRequest
{
    #[Assert\NotBlank]
    protected string $name;

    protected ?int $parent;

    #[Assert\NotBlank]
    protected string $slug;

    #[Assert\NotBlank]
    protected string $description;

    public function toDto() : ?CreateUpdateCategoryDto
    {
        return new CreateUpdateCategoryDto(
            $this->name,
            $this->parent,
            $this->slug,
            $this->description
        );
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }
}
