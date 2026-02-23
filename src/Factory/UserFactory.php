<?php

namespace App\Factory;

use App\DTO\Input\User\UserRegisterDTO;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function makeUser(UserRegisterDTO $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);;
        $user->setPassword($this->passwordHasher->hashPassword($user, $dto->password));

        return $user;
    }
}
