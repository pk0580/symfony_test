<?php

namespace App\DTO\Input\Post;

use App\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraint\EntityExists;

readonly class PostStoreInputDTO
{
    public function __construct(
        #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
        #[Assert\Length(min: 1, max: 255)]
        public string $title,

        #[Assert\NotBlank(allowNull: true, normalizer: 'trim')]
        public ?string $description,

        #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
        public string $content,

        #[Assert\Type(type: \DateTimeImmutable::class)]
        #[Assert\NotNull]
        public \DateTimeImmutable $publishedAt,

        #[Assert\NotNull]
        #[Assert\Type('integer')]
        public int $status = 1,

        #[Assert\NotNull]
        #[Assert\Type('integer')]
        #[EntityExists(entity: Category::class)]
        public int $categoryId,
    ) {}
}
