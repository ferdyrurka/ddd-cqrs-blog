<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class Metadata
{
    /**
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private string $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }
}
