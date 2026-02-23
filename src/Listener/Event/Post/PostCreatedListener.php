<?php

namespace App\Listener\Event\Post;

use App\Event\Post\PostCreatedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: PostCreatedEvent::NAME, method: 'onPostCreated')]
class PostCreatedListener
{
    public function onPostCreated(PostCreatedEvent $event) {
        dd($event->getPost());
    }
}
