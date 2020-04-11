<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post;

use App\Blog\Domain\Post\Exception\InvalidArgumentException;
use App\Blog\Domain\Post\Type\PublishType;
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
    private bool $publish = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $publishedAt;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private string $publishType;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $plannedPublishAt;

    public function __construct(
        string $publishType,
        ?DateTime $plannedPublishAt = null
    ) {
        if ($this->validatePublishType($publishType)) {
            throw new InvalidArgumentException('Give invalid publish type');
        }

        $this->publishType = $publishType;
        $this->plannedPublishAt = $plannedPublishAt;
    }

    public function publishPost(): void
    {
        $this->publish = true;
        $this->publishedAt = Carbon::now();
    }

    public function getPublishType(): PublishType
    {
        return new PublishType($this->publishType);
    }

    public function getPlannedPublishAt(): ?DateTime
    {
        return $this->plannedPublishAt;
    }

    public function isPublish(): bool
    {
        return $this->publish;
    }

    private function validatePublishType(string $publishType): bool
    {
        return !PublishType::search($publishType);
    }
}
