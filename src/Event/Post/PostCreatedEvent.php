<?php

namespace App\Event\Post;

use App\Entity\Post;

class PostCreatedEvent
{
    public const string NAME = 'post.created';

    public function __construct(private Post $post) {}

    public function getPost(): Post
    {
        return $this->post;
    }
}
