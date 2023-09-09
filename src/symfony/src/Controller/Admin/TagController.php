<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/admin')]
class TagController extends AbstractController
{
    public function __construct(
        protected TagRepository $tagRepository,
        protected SerializerInterface $serializer,
        protected PaginatorInterface $paginator,
        protected ManagerRegistry $doctrine
    )
    {}

    #[Route('/tags', name: 'app_tag', methods: [Request::METHOD_GET])]
    public function index(Request $request): Response
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

    #[Route('/tags/new', name: 'app_tag_create', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function create(Request $request): RedirectResponse|Response
    {
        $tag = new Tag();

        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute('app_tag');
        }

        return $this->render('admin/tag/create-update-tag.html.twig', [
            'tag' => $tag,
            'form' => $form,
            'isEditMode' => false
        ]);
    }

    #[Route('/tags/{id}', name: 'app_tag_edit', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function edit(int $id, Request $request): RedirectResponse|Response
    {
        $tag = $this->tagRepository->find($id);

        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_tag');
        }

        return $this->render('admin/tag/create-update-tag.html.twig', [
            'tag' => $tag,
            'form' => $form,
            'isEditMode' => true
        ]);
    }

    #[Route('/tags/{id}', name: 'app_tag_delete', methods: [Request::METHOD_DELETE])]
    public function delete(int $id): JsonResponse
    {
        $tag = $this->tagRepository->delete($id);

        return $this->json([
            'msg' => 'Tag deleted!!!',
            'data' => $tag,
        ], 200);
    }
}
