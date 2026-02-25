<?php

namespace App\DTO\Input\User;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UserRegisterDTO
{
    public function __construct(
        #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
        #[Assert\Length(min: 6, max: 255)]
        public string $password,
    ) {}
}
