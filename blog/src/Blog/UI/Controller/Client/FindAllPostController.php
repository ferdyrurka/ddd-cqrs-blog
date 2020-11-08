<?php

declare(strict_types=1);

namespace App\Blog\UI\Controller\Client;

use App\Blog\Application\Query\Post\FindAllPublishedPostQuery;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FindAllPostController extends AbstractController
{
    /**
     * @param MessageBusInterface $queryBus
     * @param SerializerInterface $serializer
     * @return JsonResponse
     *
     * @Route("/client/post/published/find-all", methods={"GET"}, host="%client_host%")
     */
    public function findAllPublishedPost(MessageBusInterface $queryBus, SerializerInterface $serializer): JsonResponse
    {
        $envelope = $queryBus->dispatch(new FindAllPublishedPostQuery());
        $handledStamp = $envelope->last(HandledStamp::class);

        $result = $handledStamp ? $handledStamp->getResult() : [];

        if ($result instanceof Collection && !$result->isEmpty()) {
            return JsonResponse::fromJsonString(
                $serializer->serialize($result->toArray(), 'json')
            );
        }

        return new JsonResponse(['message' => 'Published post not exist :(!']);
    }
}
