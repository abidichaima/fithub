<?php

namespace App\Controller;

use App\Entity\ParticipationSeance;
use App\Form\ParticipationSeanceType;
use App\Repository\ParticipationSeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participation/seance')]
class ParticipationSeanceController extends AbstractController
{
    #[Route('/', name: 'app_participation_seance_index', methods: ['GET'])]
    public function index(ParticipationSeanceRepository $participationSeanceRepository): Response
    {
        return $this->render('participation_seance/index.html.twig', [
            'participation_seances' => $participationSeanceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_participation_seance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ParticipationSeanceRepository $participationSeanceRepository): Response
    {
        $participationSeance = new ParticipationSeance();
        $form = $this->createForm(ParticipationSeanceType::class, $participationSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participationSeanceRepository->save($participationSeance, true);

            return $this->redirectToRoute('app_participation_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participation_seance/new.html.twig', [
            'participation_seance' => $participationSeance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_seance_show', methods: ['GET'])]
    public function show(ParticipationSeance $participationSeance): Response
    {
        return $this->render('participation_seance/show.html.twig', [
            'participation_seance' => $participationSeance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_participation_seance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParticipationSeance $participationSeance, ParticipationSeanceRepository $participationSeanceRepository): Response
    {
        $form = $this->createForm(ParticipationSeanceType::class, $participationSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participationSeanceRepository->save($participationSeance, true);

            return $this->redirectToRoute('app_participation_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participation_seance/edit.html.twig', [
            'participation_seance' => $participationSeance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_seance_delete', methods: ['POST'])]
    public function delete(Request $request, ParticipationSeance $participationSeance, ParticipationSeanceRepository $participationSeanceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participationSeance->getId(), $request->request->get('_token'))) {
            $participationSeanceRepository->remove($participationSeance, true);
        }

        return $this->redirectToRoute('app_participation_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
