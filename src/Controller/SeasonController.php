<?php
// src/Controller/SeasonController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;

#[Route('/season', name: 'season_')]
class SeasonController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/show/{categoryName<^[a-zA-Z]+$>}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneByName(['name' => $categoryName]);
        if ($category) {
            $programs = $category->getPrograms();

            // $programs = $programRepository->findBy(['category' => $category], limit: 3);

            //      $categories = $categoryRepository->findAll();
            //      $program = $programRepository->findAll();


            return $this->render('category/show.html.twig', [
                'category' => $category, 'programs' => $programs,
            ]);
        } else {
            throw $this->createNotFoundException(
                'No category with name : ' . $categoryName . ' found in category\'s table.'
            );
        }
    }
}
