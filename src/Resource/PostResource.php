<?php

namespace App\Resource;

use App\DTO\Output\Post\PostOutputDTO;
use App\Entity\Post;
use Symfony\Component\Serializer\SerializerInterface;

class PostResource
{
    public function __construct(private SerializerInterface $serializer)
    {

    }
    public function postItem(PostOutputDTO $dto): string
    {
        return $this->serializer->serialize($dto, 'json', ['groups' => 'post:item']);
    }

    public function postCollection(array $collection): string
    {
        return $this->serializer->serialize($collection, 'json', ['groups' => 'post:item']);
    }
}
