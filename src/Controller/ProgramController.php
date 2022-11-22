<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProgramRepository;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Form\ProgramType;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series', 'programs' => $programs,
        ]);
    }

    #[Route('/new/', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $programRepository->save($program, true);
            return $this->redirectToRoute('program_index');
        }

        // Render the form
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/show/{slug}', name: 'show')]
    public function show(?Program $program): Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }
        $seasons = $program->getSeasons();
        return $this->render('program/show.html.twig', [
            'program' => $program, 'id' => $program->getId(), 'seasons' => $seasons,
        ]);
    }

    #[Route('/{slug}/seasons/{seasonId<^[0-9]+$>}', name: 'season_show')]
    #[Entity('season', options: ['id' => 'seasonId'])]
    public function showSeason(Program $program, Season $season): Response
    {

        $episodes = $season->getEpisodes();


        return $this->render('program/season_show.html.twig', [
            'program' => $program, 'season' => $season, 'episodes' => $episodes,
        ]);
    }

    #[Route('/{slug}/seasons/{seasonId<^[0-9]+$>}/episode/{episodeId<^[0-9]+$>}', name: 'episode_show')]
    #[Entity('season', options: ['id' => 'seasonId'])]
    #[Entity('episode', options: ['id' => 'episodeId'])]
    public function showEpisode(Program $program, Season $season, Episode $episode)
    {
        $totep = $season->getEpisodes();
        return $this->render('program/episode_show.html.twig', [
            'program' => $program, 'season' => $season, 'episode' => $episode, 'totep' => $totep,
        ]);
    }
}
