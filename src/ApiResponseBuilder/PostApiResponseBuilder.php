<?php

namespace App\ApiResponseBuilder;

use App\Entity\Post;
use App\Factory\PostFactory;
use App\Resource\PostResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostApiResponseBuilder
{
    public function __construct(
        private readonly PostResource $postResource,
        private PostFactory $postFactory
    ) {}

    public function indexPostResponse(array $posts, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTOs = $this->postFactory->makePostOutputDTOs($posts);
        $resource = $this->postResource->postCollection($postOutputDTOs);

        return new JsonResponse($resource, $status, $headers, $isJson);
    }

    public function storePostResponse(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTO = $this->postFactory->makePostOutputDTO($post);
        $resource = $this->postResource->postItem($postOutputDTO);

        return new JsonResponse($resource, $status, $headers, $isJson);
    }

    public function showPostResponse(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTO = $this->postFactory->makePostOutputDTO($post);
        $resource = $this->postResource->postItem($postOutputDTO);

        return new JsonResponse($resource, $status, $headers, $isJson);
    }

    public function updatePostResponse(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTO = $this->postFactory->makePostOutputDTO($post);
        $resource = $this->postResource->postItem($postOutputDTO);

        return new JsonResponse($resource, $status, $headers, $isJson);
    }

    public function destroyPost($status = 200, $headers = []): JsonResponse
    {
        return new JsonResponse(['message' => 'success'], $status, $headers);
    }
}
