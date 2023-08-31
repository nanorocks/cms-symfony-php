<?php

namespace App\Request\Tag;

use App\DataTransferObject\Tag\TagCreateUpdateDto;
use App\Entity\Media;
use App\Requests\BaseRequest;

use Symfony\Component\Validator\Constraints as Assert;

class TagCreateUpdateRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Unique]
    protected string $name;

    protected ?string $description;

    public function toDto() : ?TagCreateUpdateDto
    {
        return new TagCreateUpdateDto(
            $this->name,
            $this->description,
        );
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }
}
