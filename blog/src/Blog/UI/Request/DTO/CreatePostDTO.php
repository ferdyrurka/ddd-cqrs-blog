<?php
declare(strict_types=1);

namespace App\Blog\UI\Request\DTO;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePostDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="512", min="6")
     */
    public ?string $title = null;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1")
     */
    public ?string $content = null;

    /**
     * @Assert\NotBlank()
     */
    public ?string $publishType = null;

    public ?string $plannedPublishAt = null;

    /**
     * @Assert\Regex("/^([A-Z|a-z|0-9|\-|\.|\_]){0,128}$/")
     */
    public ?string $customSlug = null;
}
