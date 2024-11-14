<?php

namespace App\Controller;

use App\Entity\FollowUp;
use App\Form\FollowupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FollowUpRepository as RepositoryFollowUpRepository;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Repository\FollowUpRepository;

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
}
