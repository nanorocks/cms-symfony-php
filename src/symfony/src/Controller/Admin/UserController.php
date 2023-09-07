<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class UserController extends AbstractController
{
    public function __construct(protected UserRepository $userRepository)
    {}

    #[Route('/users', name: 'app_user', methods: [Request::METHOD_GET])]
    public function index()
    {
        $users = $this->userRepository->findAll();
        
        return $this->render('admin/user/index.html.twig', [
            'users' => $users
        ]);
    }
}
