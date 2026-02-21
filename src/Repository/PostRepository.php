<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(private EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function store(Post $post, bool $isFlash = true): Post
    {
        $this->entityManager->persist($post);

        if ($isFlash) {
            $this->entityManager->flush();
        }

        return $post;
    }

    public function update(Post $post, bool $isFlash = true): Post
    {
        $this->entityManager->persist($post);

        if ($isFlash) {
            $this->entityManager->flush();
        }

        return $post;
    }

    public function destroy(Post $post, bool $isFlash = true): void
    {
        $this->entityManager->remove($post);

        if ($isFlash) {
            $this->entityManager->flush();
        }
    }
}
