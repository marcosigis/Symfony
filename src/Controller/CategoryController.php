<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use App\Form\CategoryType;
use App\Entity\Category;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new/', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $categoryRepository->save($category, true);
            return $this->redirectToRoute('category_index');
        }

        // Render the form
        return $this->renderForm('category/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/show/{categoryName<^[a-zA-Z]+$>}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneByName(['name' => $categoryName]);
        if ($category) {
            // $programs = $category->getPrograms();

            // $programs = $programRepository->findBy(['category' => $category], limit: 3);

            //      $categories = $categoryRepository->findAll();
            //      $program = $programRepository->findAll();


            return $this->render('category/show.html.twig', [
                'category' => $category
            ]);
        } else {
            throw $this->createNotFoundException(
                'No category with name : ' . $categoryName . ' found in category\'s table.'
            );
        }
    }
}
