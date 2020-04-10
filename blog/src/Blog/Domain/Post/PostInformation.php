<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post;

use Carbon\Carbon;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class PostInformation
{
    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private bool $publish;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $publishedAt;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private string $publishType;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private string $publisherId;

    public function __construct(
        string $publishType,
        string $publisherId,
        bool $publish = false
    ) {
        $this->publishType = $publishType;
        $this->publisherId = $publisherId;

        if ($publish) {
            $this->publishPost();
        }
    }

    public function publishPost(): void
    {
        $this->publish = true;
        $this->publishedAt = Carbon::now();
    }
}
