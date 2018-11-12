<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\CommandInterface;

/**
 * Interface CommandHandlerInterface
 * @package App\Service\Interfaces
 */
interface HandlerInterface
{
    public function handle(CommandInterface $command): void;
}
