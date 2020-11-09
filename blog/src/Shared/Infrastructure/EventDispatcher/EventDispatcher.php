<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventDispatcher;

use Symfony\Component\EventDispatcher\EventDispatcher as BaseEventDispatcher;

class EventDispatcher extends BaseEventDispatcher implements EventDispatcherInterface
{
}
