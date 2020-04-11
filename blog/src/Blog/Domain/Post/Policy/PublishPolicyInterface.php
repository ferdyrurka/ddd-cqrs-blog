<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post\Policy;

use App\Blog\Domain\Post\PostInformation;

interface PublishPolicyInterface
{
    public function checkPublishWay(PostInformation $postInformation): PostInformation;
}
