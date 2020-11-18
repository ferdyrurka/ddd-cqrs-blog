<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use Carbon\Carbon;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class Timeline
{
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = Carbon::now();
    }
}
