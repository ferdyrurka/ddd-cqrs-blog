<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\CommandInterface;
use App\Exception\ValidateEntityException;
use App\Query\PostQuery;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddPostHandler
 * @package App\Handler
 */
class AddPostHandler implements HandlerInterface
{
    /**
     * @var PostQuery
     */
    private $postQuery;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * AddPostHandler constructor.
     * @param PostQuery $postQuery
     * @param ValidatorInterface $validator
     */
    public function __construct(PostQuery $postQuery, ValidatorInterface $validator)
    {
        $this->postQuery = $postQuery;
        $this->validator = $validator;
    }

    /**
     * @param CommandInterface $command
     * @throws ValidateEntityException
     */
    public function handle(CommandInterface $command): void
    {
        $post = $command->getPost();

        $post->setCreatedAt(new \DateTime('now', new \DateTimeZone('Europe/Warsaw')));
        $post->setContent(htmlspecialchars($post->getContent()));

        if (\count($this->validator->validate($post)) > 0) {
            throw new ValidateEntityException('Validate failed in: ' . \get_class($post));
        }

        $this->postQuery->save($post);
    }
}
