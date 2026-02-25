<?php

namespace App\Factory;

use App\DTO\Input\Post\PostStoreInputDTO;
use App\DTO\Input\Post\PostUpdateInputDTO;
use App\DTO\Output\Post\PostOutputDTO;
use App\Entity\Category;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostFactory
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function makePost(PostStoreInputDTO $postStoreInputDTO): Post
    {
        $post = new Post();

        $post->setTitle($postStoreInputDTO->title);
        $post->setDescription($postStoreInputDTO->description);
        $post->setContent($postStoreInputDTO->content);
        $post->setPublishedAt($postStoreInputDTO->publishedAt);
        $post->setStatus($postStoreInputDTO->status);
        $post->setCategory($this->entityManager->getReference(Category::class, $postStoreInputDTO->categoryId));

        return $post;
    }

    public function editPost(Post $post, PostUpdateInputDTO $postUpdateInputDTO): Post
    {
        $post->setTitle($postUpdateInputDTO->title);
        $post->setDescription($postUpdateInputDTO->description);
        $post->setContent($postUpdateInputDTO->content);
        $post->setPublishedAt($postUpdateInputDTO->publishedAt);
        $post->setStatus($postUpdateInputDTO->status);
        $post->setCategory($this->entityManager->getReference(Category::class, $postUpdateInputDTO->categoryId));

        return $post;
    }

    public function makePostOutputDTO(Post $post): PostOutputDTO
    {
        $dto = new PostOutputDTO();

        $dto->id = $post->getId();
        $dto->title = $post->getTitle();
        $dto->description = $post->getDescription();
        $dto->content = $post->getContent();
        $dto->publishedAt = $post->getPublishedAt();
        $dto->status = $post->getStatus();
        $dto->category = $post->getCategory();

        return $dto;
    }

    public function makePostOutputDTOs(array $posts): array
    {
        return array_map(fn(Post $post) => $this->makePostOutputDTO($post), $posts);
    }
}
