<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post\Policy;

use App\Blog\Domain\Post\Exception\InvalidArgumentException;
use App\Blog\Domain\Post\Exception\RuntimeException;
use App\Blog\Domain\Post\PostInformation;
use App\Blog\Domain\Post\Type\PublishType;
use Carbon\Carbon;
use DateTime;

class PublishPolicy implements PublishPolicyInterface
{
    public function checkPublishWay(PostInformation $postInformation): PostInformation
    {
        if (PublishType::NOW()->equals($postInformation->getPublishType())) {
            $postInformation->publishPost();

            return $postInformation;
        }

        $this->checkPlannedPublishAt($postInformation->getPlannedPublishAt());

        return $postInformation;
    }

    private function checkPlannedPublishAt(?DateTime $plannedPublishAt): void
    {
        if (!$plannedPublishAt) {
            throw new InvalidArgumentException('If use cron publish type you must set planned publish date');
        }

        if (Carbon::now()->isAfter($plannedPublishAt)) {
            throw new RuntimeException('The publication date cannot be earlier than today');
        }
    }
}
