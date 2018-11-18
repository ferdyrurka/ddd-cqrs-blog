<?php
declare(strict_types=1);

namespace App\Tests\Unit\Handler;

use App\Command\AddPostCommand;
use App\Domain\Entity\Post;
use App\Handler\AddPostHandler;
use App\Repository\PostRepository;
use \Mockery;
use PHPUnit\Framework\TestCase;
use \DateTime;

/**
 * Class AddPostHandlerTest
 * @package App\Tests\Unit\Handler
 */
class AddPostHandlerTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function testHandle(): void
    {
        $postRepository = Mockery::mock(PostRepository::class);
        $postRepository->shouldReceive('save')->withArgs([Post::class])->once();

        $post = Mockery::mock(Post::class);
        $post->shouldReceive('setCreatedAt')->withArgs([DateTime::class])->once();
        $post->shouldReceive('setContent')->once()->withArgs(['&lt;?&gt;Hello']);
        $post->shouldReceive('getContent')->once()->andReturn('<?>Hello');

        $command = new AddPostCommand($post);

        $addPostHandler = new AddPostHandler($postRepository);
        $addPostHandler->handle($command);
    }
}
