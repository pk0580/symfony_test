<?php

namespace App\Service;

use App\DTO\Input\Post\PostStoreInputDTO;
use App\DTO\Input\Post\PostUpdateInputDTO;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\Repository\PostRepository;

class PostService
{
    public function __construct(
        private PostRepository $postRepository,
        private PostFactory $postFactory
    )
    {

    }

    public function index(): array
    {
        return $this->postRepository->findAll();
    }

    public function store(PostStoreInputDTO $postStoreInputDTO): Post
    {
        $post = $this->postFactory->makePost($postStoreInputDTO);
        $this->postRepository->store($post);

        return $post;
    }

    public function update(Post $post, PostUpdateInputDTO $postUpdateInputDTO): Post
    {
        $post = $this->postFactory->editPost($post, $postUpdateInputDTO);
        $this->postRepository->store($post);

        return $post;
    }

    public function destroy(Post $post): void
    {
        $this->postRepository->destroy($post);
    }
}
