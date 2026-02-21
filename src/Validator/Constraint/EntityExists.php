<?php

namespace App\Validator\Constraint;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EntityExists extends Constraint
{
    public string $message = 'The entity {{ entity }} with ID {{ id }} does not exist.';

    public function __construct(
        public string $entity,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return EntityExistsValidator::class;
    }
}
