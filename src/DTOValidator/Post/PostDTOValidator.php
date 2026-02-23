<?php

namespace App\DTOValidator\Post;

use App\DTO\Input\Post\PostStoreInputDTO;
use App\DTO\Input\Post\PostUpdateInputDTO;
use App\Exception\ValidateException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostDTOValidator
{
    public function __construct(private ValidatorInterface $validator)
    {}

    public function validate(PostStoreInputDTO|PostUpdateInputDTO $postStoreInputDTO): void
    {
        $errors = $this->validator->validate($postStoreInputDTO);

        if (count($errors)) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }

            throw new ValidateException($messages);
        }
    }
}
