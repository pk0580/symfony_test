<?php

namespace App\DTO\Input\Post;

use App\Entity\Category;
use App\Validator\Constraint\EntityExists;
use Symfony\Component\Validator\Constraints as Assert;

class PostUpdateInputDTO
{
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[Assert\Length(min: 1, max: 255)]
    public ?string $title = null;

    #[Assert\NotBlank(allowNull: true, normalizer: 'trim')]
    public ?string $description = null;

    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    public ?string $content = null;

    #[Assert\Type(type: \DateTimeImmutable::class)]
    #[Assert\NotNull]
    public ?\DateTimeImmutable $publishedAt = null;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public ?int $status = 1;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[EntityExists(entity: Category::class)]
    public ?int $categoryId = null;
}
