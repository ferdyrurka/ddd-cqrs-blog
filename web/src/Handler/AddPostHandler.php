<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\CommandInterface;
use App\Exception\ValidateEntityException;
use App\Query\PostQueryInterface;
use App\Repository\PostRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use \DateTime;

/**
 * Class AddPostHandler
 * @package App\Handler
 */
class AddPostHandler implements HandlerInterface
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * AddPostHandler constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param CommandInterface $command
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CommandInterface $command): void
    {
        $post = $command->getPost();

        $post->setCreatedAt(new DateTime('now'));
        $post->setContent(htmlspecialchars($post->getContent()));

        $this->postRepository->save($post);
    }
}
