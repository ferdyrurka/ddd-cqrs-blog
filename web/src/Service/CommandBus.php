<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\CommandInterface;
use App\Exception\HandlerNotFoundException;
use App\Handler\HandlerInterface;
use Psr\Container\ContainerInterface;

/**
 * Class CommandBus
 * @package App\Service
 */
class CommandBus
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * CommandBus constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param CommandInterface $command
     * @throws HandlerNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $handler = $this->commandToHandler(\get_class($command));

        $handler->handle($command);
    }

    /**
     * @param string $command
     * @return HandlerInterface
     * @throws HandlerNotFoundException
     * @throws \Exception
     */
    private function commandToHandler(string $command): HandlerInterface
    {
        $commandHandler = str_replace('Command', 'Handler', $command);

        if (!$this->container->has($commandHandler)) {
            throw new HandlerNotFoundException('Handler not found from: ' . $command);
        }

        $handler = $this->container->get($commandHandler);

        if (!$handler instanceof HandlerInterface) {
            throw new HandlerNotFoundException('Handler not found from: ' . $command);
        }

        return $handler;
    }
}
