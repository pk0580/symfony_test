<?php

namespace App\DTO\Input\User;

use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterDTO
{
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[Assert\Length(min: 1, max: 255)]
    public ?string $email = null;

    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[Assert\Length(min: 6, max: 255)]
    public ?string $password = null;

    public function makeDTO(array $data): UserRegisterDTO
    {
        $dto = new UserRegisterDTO();

        $dto->email = $data['email'] ?? null;
        $dto->password = $data['password'] ?? null;

        return $dto;
    }
}
