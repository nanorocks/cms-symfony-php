<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Request\Category\CategoryCreateUpdateRequest;
use Symfony\Component\Serializer\SerializerInterface;
use App\PlainOldPhpObject\Category\CategoryCreateUpdatePopo;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]
class CategoryController extends AbstractController
{
    public function __construct(
        public CategoryRepository $categoryRepository,
        public SerializerInterface $serializer,
        public PaginatorInterface $paginator,
        public ManagerRegistry $doctrine
    )
    {
    }

    #[Route('/categories', name: 'app_category', methods: [Request::METHOD_GET])]
    public function index(Request $request)
    {
        $slug = $request->query->get('slug', "");

        $categories = !empty($slug) ? $this->categoryRepository->findBySlug($slug) : $this->categoryRepository->findAllOrdered();

        $categories = $this->paginator->paginate(
            // Doctrine Query, not results
            $categories,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        // dd($categories[0]);
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/categories/new', name: 'app_category_create', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function create(Request $request)
    {
        $category = new Category();

        $category->setCreatedAt();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_category');
        }
       
        return $this->render('admin/category/create-update-category.html.twig', [
            'category' => $category,
            'form' => $form,
            'isEditMode' => false
        ]);
    }

    #[Route('/categories/{id}', name: 'app_category_edit', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function edit(int $id, Request $request)
    {
        $category = $this->categoryRepository->find($id);

        $category->setUpdatedAt();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_category');
        }
       
        return $this->render('admin/category/create-update-category.html.twig', [
            'category' => $category,
            'form' => $form,
            'isEditMode' => true
        ]);
    }

    #[Route('/categories/{id}', name: 'app_category_delete', methods: [Request::METHOD_DELETE])]
    public function delete(int $id)
    {
        $category = $this->categoryRepository->delete($id);
       
        return $this->json([
            'msg' => 'Category deleted!!!',
            'data' => $category,
        ], 200);
    }
}
