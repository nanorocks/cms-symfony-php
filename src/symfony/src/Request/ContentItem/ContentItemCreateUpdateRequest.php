<?php

namespace App\Request\Category;

use App\DataTransferObject\ContentItem\ContentItemCreateUpdateDto;
use App\Entity\User;
use App\Enum\ContentItemType;
use App\Requests\BaseRequest;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

class ContentItemCreateUpdateRequest extends BaseRequest
{
    #[Assert\NotBlank]
    protected string $title;

    protected ?string $slug;

    protected ?string $content;

    protected ?string $excerpt;

    protected ?ContentItemType $type;

    protected ?bool $published;

    protected ?\DateTimeImmutable $publishedAt;

    protected ?User $author;

    protected Collection $categories;

    protected ?string $videoUrl;

    protected Collection $images;

    protected Collection $tags;


    public function toDto() : ?ContentItemCreateUpdateDto
    {
        return new ContentItemCreateUpdateDto(
            $this->title,
            $this->slug,
            $this->content,
            $this->excerpt,
            $this->type,
            $this->published,
            $this->publishedAt,
            $this->author,
            $this->categories,
            $this->videoUrl,
            $this->images,
            $this->tags,
        );
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }
}
