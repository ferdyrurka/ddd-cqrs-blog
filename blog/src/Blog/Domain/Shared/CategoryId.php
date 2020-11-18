<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class CategoryId
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=128)
     */
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
