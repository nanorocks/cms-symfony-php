<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Request\Category\CategoryCreateUpdateRequest;
use Symfony\Component\Serializer\SerializerInterface;
use App\PlainOldPhpObject\Category\CategoryCreateUpdatePopo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function __construct(
        public CategoryRepository $categoryRepository,
        public SerializerInterface $serializer,
        public PaginatorInterface $paginator,
    )
    {
    }

    #[Route('/categories', name: 'app_category', methods: [Request::METHOD_GET])]
    public function index(Request $request)
    {
        $slug = $request->query->get('slug', "");

        $categories = !empty($slug) ? $this->categoryRepository->findBySlug($slug) : $this->categoryRepository->findAll();

        $categories = $this->paginator->paginate(
            // Doctrine Query, not results
            $categories,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );
        
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/categories', name: 'app_category_create', methods: [Request::METHOD_POST])]
    public function create(CategoryCreateUpdateRequest $request)
    {
        $category = $this->categoryRepository->createCategory($request->toDto());

        return $this->json([
            'msg' => 'Category created!!!',
            'data' => (new CategoryCreateUpdatePopo($category))->json()
        ], 200);
    }

    #[Route('/categories', name: 'app_category_update', methods: [Request::METHOD_PUT])]
    public function update()
    {
        return $this->render('admin/category/index.html.twig', [

        ]);
    }

    #[Route('/categories', name: 'app_category_delete', methods: [Request::METHOD_DELETE])]
    public function delete()
    {
        return $this->render('admin/category/index.html.twig', [

        ]);
    }
}
