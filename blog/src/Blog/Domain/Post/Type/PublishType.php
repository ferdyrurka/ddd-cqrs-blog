<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post\Type;

use MyCLabs\Enum\Enum;

/**
 * @method static PublishType CRON()
 * @method static PublishType MANUAL()
 */
class PublishType extends Enum
{
    public const CRON = 'cron';

    public const MANUAL = 'manual';
}
