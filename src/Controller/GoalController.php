<?php

namespace App\Controller;

use App\Entity\Veterinary;
use App\Form\VeterinarySelectType;
use App\Entity\Goal;
use App\Form\GoalType;
use App\Repository\VeterinaryRepository;
use App\Repository\GoalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/goal')]
final class GoalController extends AbstractController
{
    
    #[Route(name: 'app_goal_index', methods: ['GET', 'POST'])]
    public function index(Request $request,GoalRepository $goalRepository): Response
    {
        // Par défaut, la liste des objectifs contient tous les objectifs
        $goals = $goalRepository->findAll();
        // On crée un objet veterinary pour interagir avec le formulaire
        $veterinary = new Veterinary();
        // On crée un formulaire basé sur la classe formulaire créée précédemment
        $form = $this->createForm(VeterinarySelectType::class);
        // Récupère les données dans la superglobale adéquate ($_POST ou $_GET)
        $form->handleRequest($request);
        // Le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données du formulaire
            $data = $form->getData();
            $veterinary = $data['veterinary'];
            // Si une catégorie est sélectionnée, on récupère la liste des vétérinaires concernés
            if (!is_null($veterinary)) {
                $goals = $goalRepository->findByVeterinary($veterinary);
            }
        }
        return $this->render('goal/index.html.twig', [
            'goals' => $goals,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_goal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($goal);
            $entityManager->flush();

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goal/new.html.twig', [
            'goal' => $goal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goal_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Goal $goal): Response
    {
        return $this->render('goal/show.html.twig', [
            'goal' => $goal
        ]);
    }

    #[Route('/{id}/edit', name: 'app_goal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goal/edit.html.twig', [
            'goal' => $goal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goal_delete', methods: ['POST'])]
    public function delete(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($goal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }
}
