<?php
declare(strict_types=1);

namespace App\Query\ViewObject;

/**
 * Class PostViewObject
 * @package App\Query\ViewObject
 */
class PostViewObject
{
    /**
     * @var \DateTime
     */
    private $dateTime;

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
     * @param \DateTime $dateTime
     * @param string $content
     * @param string $title
     */
    public function __construct(\DateTime $dateTime, string $content, string $title)
    {
        $this->dateTime = $dateTime;
        $this->content = $content;
        $this->title = $title;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
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
