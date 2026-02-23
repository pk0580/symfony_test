<?php

namespace App\DTOValidator\User;

use App\DTO\Input\User\UserRegisterDTO;
use App\Exception\ValidateException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRegisterDTOValidator
{
    public function __construct(private ValidatorInterface $validator) {}

    public function validate(UserRegisterDTO $userRegisterDTO): void
    {
        $errors = $this->validator->validate($userRegisterDTO);

        if (count($errors)) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }

            throw new ValidateException($messages);
        }
    }
}
