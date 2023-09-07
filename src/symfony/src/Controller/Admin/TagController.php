<?php

namespace App\Controller\Admin;

use App\PlainOldPhpObject\Tag\TagCreateUpdatePopo;
use App\Repository\TagRepository;
use App\Request\Tag\TagCreateUpdateRequest;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class TagController extends AbstractController
{
    public function __construct(
        protected TagRepository $tagRepository,
        protected PaginatorInterface $paginator,
    )
    {}

    #[Route('/tags', name: 'app_tag', methods: [Request::METHOD_GET])]
    public function index(Request $request)
    {

        $name = $request->query->get('name', "");

        $tags = !empty($name) ? $this->tagRepository->findByName($name) : $this->tagRepository->findAll();
  
        $tags = $this->paginator->paginate(
            // Doctrine Query, not results
            $tags,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            8
        );
        
        return $this->render('admin/tag/index.html.twig', [
            'tags' => $tags
        ]);
    }

    #[Route('/tags', name: 'app_tag_create', methods: [Request::METHOD_POST])]
    public function create(TagCreateUpdateRequest $request)
    {
        $tag = $this->tagRepository->createTag($request->toDto());

        return $this->json([
            'msg' => 'Tag created!!!',
            'data' => (new TagCreateUpdatePopo($tag))->json()
        ], 200);
    }
}
