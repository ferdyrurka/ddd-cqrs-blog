<?php
declare(strict_types=1);

namespace App\Blog\UI\Controller\Admin\Post;

use App\Blog\Application\UseCase\Command\Post\CreatePostCommand;
use App\Blog\UI\Form\Admin\Post\CreatePostForm;
use App\Blog\UI\Request\DTO\Post\CreatePostDTO;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends AbstractController
{
    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/admin/create/post", methods={"POST"})
     */
    public function createAction(Request $request): JsonResponse
    {
        $form = $this->createForm(CreatePostForm::class, new CreatePostDTO());
        $form->submit(
            json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            $this->dispatchMessage(new CreatePostCommand(
                $dto->title,
                $dto->content,
                $dto->publishType,
                new Carbon($dto->plannedPublishAt),
                $dto->customSlug
            ));

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['valid' => (string) $form->getErrors()], 400);
    }
}
