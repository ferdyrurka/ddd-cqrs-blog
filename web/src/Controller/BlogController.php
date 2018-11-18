<?php
declare(strict_types=1);

namespace App\Controller;

use App\Command\AddPostCommand;
use App\Domain\Entity\Post;
use App\Form\AddPostForm;
use App\Query\PostQueryInterface;
use App\Service\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 */
class BlogController extends Controller
{
    /**
     * @param PostQueryInterface $postQuery
     * @return array
     * @Route("/", methods={"GET"}, name="index.blog")
     * @Template("blog/index.html.twig")
     */
    public function indexAction(PostQueryInterface $postQuery): array
    {
        return [
            'posts' => $postQuery->getAll()
        ];
    }

    /**
     * @return array
     * @param Request $request
     * @Route("/add-post", methods={"GET"}, name="addPost.blog")
     * @Template("blog/add-post.html.twig")
     */
    public function addPostAction(Request $request): array
    {
        $form = $this->createForm(AddPostForm::class, new Post());
        $form->handleRequest($request);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param CommandBus $commandBus
     * @return Response
     * @throws \App\Exception\HandlerNotFoundException
     * @Route("/add-post", methods={"POST"})
     */
    public function savePostAction(Request $request, CommandBus $commandBus): Response
    {
        $form = $this->createForm(AddPostForm::class, new Post());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new AddPostCommand($form->getData());
            $commandBus->handle($command);

            return $this->redirect('/');
        }

        return $this->forward(BlogController::class . ':indexAction', [
           'request' => $request
        ]);
    }
}
