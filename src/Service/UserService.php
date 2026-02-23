<?php

namespace App\Service;

use App\DTO\Input\User\UserRegisterDTO;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserFactory $userFactory
    ) {}


    public function index(): array
    {
        return $this->userRepository->findAll();
    }

    public function store(UserRegisterDTO $dto): user
    {
        $user = $this->userFactory->makeUser($dto);
        $this->userRepository->store($user, $dto->password);

        return $user;
    }

//    public function update(User $user, UserUpdateDTO $dto): user
//    {
//        $user = $this->userFactory->edituser($user, $dto);
//        $this->userRepository->store($user);
//
//        return $user;
//    }

    public function destroy(User $user): void
    {
        $this->userRepository->destroy($user);
    }
}
