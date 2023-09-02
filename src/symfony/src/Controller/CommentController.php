<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    public function __construct(protected CommentRepository $commentRepository)
    {}

    #[Route('/comments', name: 'app_comment', methods: [Request::METHOD_GET])]
    public function index()
    {
        $comments = $this->commentRepository->findAll();
        
        return $this->render('admin/comment/index.html.twig', [
            'comments' => $comments
        ]);
    }
}
