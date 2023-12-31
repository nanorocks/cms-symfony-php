<?php

namespace App\Request\Category;

use App\DataTransferObject\Category\CategoryCreateUpdateDto;
use App\Entity\Media;
use App\Requests\BaseRequest;

use Symfony\Component\Validator\Constraints as Assert;

class CategoryCreateUpdateRequest extends BaseRequest
{
    #[Assert\NotBlank]
    protected string $name;

    protected ?int $parent;

    #[Assert\NotBlank]
    protected string $slug;

    protected ?string $description;

    protected ?Media $image;

    public function toDto() : ?CategoryCreateUpdateDto
    {
        return new CategoryCreateUpdateDto(
            $this->name,
            $this->parent,
            $this->slug,
            $this->description,
            $this->image
        );
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }
}
