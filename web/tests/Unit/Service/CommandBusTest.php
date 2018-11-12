<?php
declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Command\CommandInterface;
use App\Handler\HandlerInterface;
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
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * @throws HandlerNotFoundException
     */
    public function testHandle(): void
    {
        $handler = Mockery::mock(HandlerInterface::class);
        $handler->shouldReceive('handle')->with(
            Mockery::on(function ($command) {
                if (!$command instanceof CommandInterface) {
                    return false;
                }

                return true;
            })
        )->once();

        $container = Mockery::mock(Container::class);
        $container->shouldReceive('get')->times(2)->with(
            Mockery::on(function (string $handler) {
                if (!\preg_match('/HandlerInterface{1}/', $handler)) {
                    return false;
                }

                return true;
            })
        )->andReturn($handler, null);

        $command = Mockery::mock(CommandInterface::class);

        $commandBus = new CommandBus($container);
        $commandBus->handle($command);

        $this->expectException(HandlerNotFoundException::class);
        $commandBus->handle($command);
    }
}

