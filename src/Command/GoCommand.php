<?php

namespace App\Command;

use App\Message\SomeMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
//        private PostService $postService,
//        private PostDTOValidator $validator,
//        private PostApiResponseBuilder $postResponseBuilder,
//        private PostStoreInputDTO $postStoreInputDTO,
//        private EntityManagerInterface $entityManager,
//        private UserPasswordHasherInterface $passwordHasher,
//        private EventDispatcherInterface $eventDispatcher,
        private MessageBusInterface $messageBus
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->messageBus->dispatch(new SomeMessage('Hello World!'));

//        $post = $this->entityManager->getRepository(Post::class)->find(1);
//        $post->setTitle('New Title 2');
//        $this->entityManager->persist($post);
//        $this->entityManager->flush();
//
//        $this->eventDispatcher->dispatch(new PostCreatedEvent($post), PostCreatedEvent::NAME);

//        $data = [
//            'email' => 'user@mail.ru',
//            'password' => 'password',
//        ];
//
//        $user = new User();
//
//        $user->setEmail($data['email']);
//        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));
//
//        $this->entityManager->persist($user);
//        $this->entityManager->flush();

//        $data = [
//            'title'       => 'Test New 2',
//            'description' => 'Description New 2',
//            'content'     => 'Content New 2',
//            'published_at' => '2020-02-01',
//            'status'      => 2,
//            'category_id' => 100,
//        ];
//
////        $posts = $this->postRepository->findAll();
//
//        $postInputDTO = $this->postStoreInputDTO->makePostStoreInputDTO($data);
//
//        $errors = $this->validator->validate($postInputDTO);
//
//        $post = $this->postService->store($postInputDTO);
//
//        $res = $this->postResponseBuilder->storePostResponse($post);
//        dump($res);

        return Command::SUCCESS;
    }
}
