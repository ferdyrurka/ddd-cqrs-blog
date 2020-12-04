<?php

declare(strict_types=1);

namespace Symfony\Tests\Blog\Domain\Post\Policy;

use Symfony\Blog\Domain\Post\Exception\InvalidArgumentException;
use Symfony\Blog\Domain\Post\Exception\RuntimeException;
use Symfony\Blog\Domain\Post\Policy\PublishPolicy;
use Symfony\Blog\Domain\Post\Information;
use Symfony\Blog\Domain\Post\Type\PublishType;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PublishPolicyTest extends TestCase
{
    private PublishPolicy $publishPolicy;

    protected function setUp(): void
    {
        $this->publishPolicy = new PublishPolicy();
    }

    /**
     * @test
     */
    public function cronTypePlannedPublishAtIsNull(): void
    {
        $postInformation = new Information(PublishType::CRON()->getValue(), null);

        $this->expectException(InvalidArgumentException::class);
        $this->publishPolicy->checkPublishWay($postInformation);
    }

    /**
     * @test
     */
    public function cronTypePlannedPublishAtIsYesterday(): void
    {
        $postInformation = new Information(PublishType::CRON()->getValue(), Carbon::yesterday());

        $this->expectException(RuntimeException::class);
        $this->publishPolicy->checkPublishWay($postInformation);
    }

    /**
     * @test
     */
    public function cronTypePlannedPublishAtIsTomorrow(): void
    {
        $postInformation = new Information(PublishType::CRON()->getValue(), Carbon::tomorrow());

        $postInformation = $this->publishPolicy->checkPublishWay($postInformation);
        self::assertFalse($postInformation->isPublish());
    }

    /**
     * @test
     */
    public function nowType(): void
    {
        $postInformation = new Information(PublishType::NOW()->getValue());

        $postInformation = $this->publishPolicy->checkPublishWay($postInformation);
        self::assertTrue($postInformation->isPublish());
    }
}
