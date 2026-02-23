<?php

namespace App\Controller;

use App\DTO\Input\User\UserRegisterDTO;
use App\DTOValidator\User\UserRegisterDTOValidator;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    public function __construct(
        private readonly JWTTokenManagerInterface $jwtManager,
        private readonly UserService $userService
    ) {}

    #[Route('/api/auth/register', name: 'auth_register', methods: ['POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserRegisterDTO $userRegisterDTO,
        UserRegisterDTOValidator $dtoValidator,
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $dto = $userRegisterDTO->makeDTO($data);
        $dtoValidator->validate($dto);
        $user = $this->userService->store($dto);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            'user' => $user,
            'token' => $this->jwtManager->create($user)
        ]);
    }

    #[Route('/api/auth/me', name: 'auth_me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        return $this->json([
            'user' => $this->getUser(),
        ]);
    }
}
