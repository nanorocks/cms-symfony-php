<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    public function __construct(protected UserRepository $userRepository)
    {}

    #[Route('/profile', name: 'app_profile', methods: [Request::METHOD_GET])]
    public function index()
    {
        $users = $this->userRepository->findAll();
        
        return $this->render('admin/profile/index.html.twig', [
            'users' => $users
        ]);
    }
}
