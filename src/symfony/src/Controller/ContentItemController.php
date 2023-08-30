<?php

namespace App\Controller;

use App\Repository\ContentItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Request\Category\ContentItemCreateUpdateRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\PlainOldPhpObject\ContentItem\ContentItemCreateUpdatePopo;

class ContentItemController extends AbstractController
{

    public function __construct(protected ContentItemRepository $contentItemRepository)
    {
        
    }
    #[Route('/content/item', name: 'app_content_item')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ContentItemController.php',
        ]);
    }

    #[Route('/content-items', name: 'app_content_item_create', methods: [Request::METHOD_POST])]
    public function create(ContentItemCreateUpdateRequest $request)
    {
        $contentItem = $this->contentItemRepository->createContentItem($request->toDto());

        return $this->json([
            'msg' => 'Content item created!!!',
            'data' => (new ContentItemCreateUpdatePopo($contentItem))->json()
        ], 200);
    }
}
