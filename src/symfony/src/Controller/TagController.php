<?php

namespace App\Controller;

use App\PlainOldPhpObject\Tag\TagCreateUpdatePopo;
use App\Repository\TagRepository;
use App\Request\Tag\TagCreateUpdateRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    public function __construct(protected TagRepository $tagRepository)
    {}

    #[Route('/tags', name: 'app_tag', methods: [Request::METHOD_GET])]
    public function index()
    {
        $tags = $this->tagRepository->findAll();
        
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
