<?php
declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Command\CommandInterface;
use App\Handler\CommandHandlerInterface;
use App\Service\CommandBus;
use PHPUnit\Framework\TestCase;
use App\Exception\HandlerNotFoundException;
use \Mockery;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class CommandBusTest
 * @package App\Tests\Unit\Service
 */
class CommandBusTest extends TestCase
{
    /**
     * @throws HandlerNotFoundException
     */
    public function testHandle(): void
    {
        $handler = Mockery::mock(CommandHandlerInterface::class);
        $handler->shouldReceive('handler')->withArgs([CommandInterface::class])->once();

        $container = Mockery::mock(Container::class);
        $container->shouldReceive('get')->times(2)->withArgs([CommandHandlerInterface::class])
            ->andReturn($handler, null);

        $command = Mockery::mock(CommandInterface::class);

        $commandBus = new CommandBus($container);
        $commandBus->handle($command);

        $this->expectException(HandlerNotFoundException::class);
        $commandBus->handle($command);
    }
}

