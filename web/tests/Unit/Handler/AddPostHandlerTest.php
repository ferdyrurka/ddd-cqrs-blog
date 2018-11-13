<?php
declare(strict_types=1);

namespace App\Tests\Unit\Handler;

use App\Command\AddPostCommand;
use App\Domain\Entity\Post;
use App\Exception\ValidateEntityException;
use App\Handler\AddPostHandler;
use App\Query\PostQuery;
use \Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddPostHandlerTest
 * @package App\Tests\Unit\Handler
 */
class AddPostHandlerTest extends TestCase
{
    /**
     * @throws ValidateEntityException
     */
    public function testHandle(): void
    {
        $postQuery = Mockery::mock(PostQuery::class);
        $postQuery->shouldReceive('save')->with(Mockery::on(function (Post $post) {
            if ($post->getCreatedAt() === null) {
                return false;
            }

            return true;
        }))->once();

        $validator = Mockery::mock(ValidatorInterface::class);
        $validator->shouldReceive('validate')->withArgs([Post::class])->times(2)
            ->andReturn([], ['failed']);

        $post = Mockery::mock(Post::class);
        $post->shouldReceive('setCreatedAt')->withArgs([\DateTime::class])->times(2);

        $command = new AddPostCommand($post);

        $addPostHandler = new AddPostHandler($postQuery, $validator);
        $addPostHandler->handle($command);

        $this->expectException(ValidateEntityException::class);
        $addPostHandler->handle($command);
    }
}
