<?php

namespace App\Command;

use App\ApiResponseBuilder\PostApiResponseBuilder;
use App\DTO\Input\Post\PostStoreInputDTO;
use App\DTOValidator\PostDTOValidator;
use App\Service\PostService;
use App\Validator\PostValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private PostService $postService,
        private PostDTOValidator $validator,
        private PostApiResponseBuilder $postResponseBuilder,
        private PostStoreInputDTO $postStoreInputDTO
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = [
            'title'       => 'Test New 2',
            'description' => 'Description New 2',
            'content'     => 'Content New 2',
            'published_at' => '2020-02-01',
            'status'      => 2,
            'category_id' => 100,
        ];

//        $posts = $this->postRepository->findAll();

        $postInputDTO = $this->postStoreInputDTO->makePostStoreInputDTO($data);

        $errors = $this->validator->validate($postInputDTO);

        $post = $this->postService->store($postInputDTO);

        $res = $this->postResponseBuilder->storePostResponse($post);
        dump($res);

        return Command::SUCCESS;
    }
}
