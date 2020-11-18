<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post;

use App\Blog\Domain\Shared\PostId;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Embedded(class="Content", columnPrefix=false)
     */
    private Content $postContent;

    /**
     * @ORM\Embedded(class="Information", columnPrefix=false)
     */
    private Information $postInformation;

    /**
     * @ORM\Embedded(class="Metadata", columnPrefix=false)
     */
    private Metadata $postMetadata;

    /**
     * @ORM\Embedded(class="Timeline", columnPrefix=false)
     */
    private Timeline $timeline;

    public function __construct(
        PostId $postId,
        Content $postContent,
        Information $postInformation,
        Metadata $postMetadata
    ) {
        $this->postId = $postId;
        $this->postContent = $postContent;
        $this->postInformation = $postInformation;
        $this->postMetadata = $postMetadata;
        $this->timeline = new Timeline();
    }
}
