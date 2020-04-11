<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post;

use App\Blog\Domain\Shared\PostId;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Table(name="post")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @ORM\Entity()
 */
final class Post
{
    /**
     * @ORM\Embedded(class="App\Blog\Domain\Shared\PostId", columnPrefix=false)
     */
    private PostId $postId;

    /**
     * @ORM\Embedded(class="App\Blog\Domain\Post\PostContent", columnPrefix=false)
     */
    private PostContent $postContent;

    /**
     * @ORM\Embedded(class="App\Blog\Domain\Post\PostInformation", columnPrefix=false)
     */
    private PostInformation $postInformation;

    /**
     * @ORM\Embedded(class="App\Blog\Domain\Post\PostMetadata", columnPrefix=false)
     */
    private PostMetadata $postMetadata;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    public function __construct(
        PostId $postId,
        PostContent $postContent,
        PostInformation $postInformation,
        PostMetadata $postMetadata
    ) {
        $this->postId = $postId;
        $this->postContent = $postContent;
        $this->postInformation = $postInformation;
        $this->postMetadata = $postMetadata;
        $this->createdAt = Carbon::now();
    }
}
