<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage]
final class SomeMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

     public function __construct(
         private readonly string $name,
     ) {
     }

    public function getName(): string
    {
        return $this->name;
    }
}
