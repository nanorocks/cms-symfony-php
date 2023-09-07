<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class MediaController extends AbstractController
{
    #[Route('/media', name: 'app_media')]
    public function index(): Response
    {
        return $this->render('admin/media/index.html.twig', [
            'categories' => ''
        ]);
    }
}
