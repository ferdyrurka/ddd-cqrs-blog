<?php
declare(strict_types=1);

namespace App\Command;

use App\Domain\Entity\Post;

/**
 * Class AddPostCommand
 * @package App\Command
 */
class AddPostCommand
{
    /**
     * @var Post
     */
    private $post;

    /**
     * AddPostCommand constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}
