<?php

namespace App\Controller;

use App\ApiResponseBuilder\PostApiResponseBuilder;
use App\DTO\Input\Post\PostStoreInputDTO;
use App\DTOValidator\PostDTOValidator;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    public function __construct(
        private readonly PostService            $postService,
        private readonly PostApiResponseBuilder $postApiResponseBuilder,
        private readonly PostDTOValidator       $postDTOValidator,
        private readonly PostStoreInputDTO      $postStoreInputDTO,
        private readonly PostFactory            $postFactory
    ) {}

    #[Route('/api/post', name: 'post_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $posts = $this->postService->index();

        return $this->postApiResponseBuilder->indexPostResponse($posts);

//        return $this->render('post/index.html.twig', [
//            'controller_name' => 'PostController',
//        ]);
    }

    #[Route('/api/post/{post}', name: 'post_show', methods: ['GET'])]
    public function show(Post $post): JsonResponse
    {
        return $this->postApiResponseBuilder->showPostResponse($post);
    }

    #[Route('/api/post', name: 'post_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $postInputDTO = $this->postStoreInputDTO->makePostStoreInputDTO($data);

        $this->postDTOValidator->validate($postInputDTO);

        $post = $this->postService->store($postInputDTO);

        return $this->postApiResponseBuilder->storePostResponse($post);
    }

    #[Route('/api/post/{post}', name: 'post_update', methods: ['PATCH'])]
    public function update(Post $post, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $postInputDTO = $this->postFactory->makePostUpdateInputDTO($data);

        $this->postDTOValidator->validate($postInputDTO);

        $post = $this->postService->update($post, $postInputDTO);

        return $this->postApiResponseBuilder->updatePostResponse($post);
    }

    #[Route('/api/post/{post}', name: 'post_destroy', methods: ['DELETE'])]
    public function destroy(Post $post): JsonResponse
    {
        $this->postService->destroy($post);
        return $this->postApiResponseBuilder->destroyPost();
    }
}
