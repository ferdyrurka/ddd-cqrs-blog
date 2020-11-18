<?php

declare(strict_types=1);

namespace App\Blog\UI\Request\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateCategoryDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255", min="1")
     */
    public ?string $name = null;
}
