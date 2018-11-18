<?php
declare(strict_types=1);

namespace App\Query\ViewObject;

use \DateTime;

/**
 * Class PostViewObject
 * @package App\Query\ViewObject
 */
class PostViewObject
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $title;

    /**
     * PostViewObject constructor.
     * @param \DateTime $createdAt
     * @param string $content
     * @param string $title
     */
    public function __construct(DateTime $createdAt, string $content, string $title)
    {
        $this->createdAt = $createdAt;
        $this->content = $content;
        $this->title = $title;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
