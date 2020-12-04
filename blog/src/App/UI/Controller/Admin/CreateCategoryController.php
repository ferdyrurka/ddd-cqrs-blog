<?php

declare(strict_types=1);

namespace App\UI\Controller\Admin;

use App\Blog\Application\UseCase\Command\Category\CreateCategoryCommand;
use App\Blog\Domain\Post\Exception\FoundException;
use App\UI\Form\Admin\CreateCategoryForm;
use App\UI\Request\DTO\CreateCategoryDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Annotation\Route;

class CreateCategoryController extends AbstractController
{
    /**
     * @Route("/admin/create/category", methods={"POST"}, host="%admin_host%")
     */
    public function indexAction(Request $request): JsonResponse
    {
        $form = $this->createForm(CreateCategoryForm::class, new CreateCategoryDTO());
        $form->submit(
            json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            try {
                $this->dispatchMessage(new CreateCategoryCommand($dto->name));
            } catch (HandlerFailedException $exception) {
                if ($exception->getPrevious() instanceof FoundException) {
                    return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_FOUND);
                }

                throw $exception;
            }

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['valid' => (string) $form->getErrors()], Response::HTTP_BAD_REQUEST);
    }
}
