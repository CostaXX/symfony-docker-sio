<?php

namespace App\Controller;

use App\Entity\FollowUp;
use App\Form\FollowupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FollowUpRepository as RepositoryFollowUpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/followup')]
class FollowupController extends AbstractController
{
    #[Route('/', name: 'app_followup_index')]
    public function index(RepositoryFollowUpRepository $followUpRepository): Response
    {
        $followups = $followUpRepository->GetAllFollowupsOrderByCallDate();
        return $this->render('followup/index.html.twig', [
            'followups' => $followups
        ]);
    }

    #[Route('/new',name: 'app_followup_new', methods: ['GET', 'POST'])]
    public function new(Request $request,EntityManagerInterface $entityManager)
    {
        $followup = new FollowUp();
        $form = $this->createForm(FollowupType::class, $followup);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($followup);
            $entityManager->flush();

            return $this->redirectToRoute('app_followup_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('followup/new.html.twig', [
            'followup' => $followup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_followup_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FollowUp $followup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FollowupType::class, $followup);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_followup_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('followup/edit.html.twig', [
            'followup' => $followup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_followup_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(FollowUp $followup):Response
    {
        return $this->render('followup/show.html.twig', [
            'followup' => $followup,
        ]);
    }

    #[Route('/veterinary/{veterinaryId}', name:'app_followup_showbyveterinaryid', methods: ['GET'], requirements: ['veterinaryId' => '\d+'])]
    public function showByVeterinaryId(int $veterinaryId, RepositoryFollowUpRepository $followUpRepository): Response
    {
        $followup = $followUpRepository->GetFollowUpByVeterinaryId($veterinaryId);
        return $this->render('followup/showbyveterinaryid.html.twig', [
            'followups' => $followup,
            'veterinaryId' => $veterinaryId
        ]);
    }

    #[Route('/{id}', name: 'app_followup_delete', methods: ['POST'])]
    public function delete(Request $request, FollowUp $followup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$followup->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($followup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_followup_index', [], Response::HTTP_SEE_OTHER);
    }
}
