<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class Name
{
    /**
     * @ORM\Column(type="string", nullable=false, unique=true, length=255)
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
