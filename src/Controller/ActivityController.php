<?php

namespace App\Controller;

use App\Entity\Veterinary;
use App\Form\VeterinaryType;
use App\Repository\VeterinaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/activity')]
class VeterinaryController extends AbstractController
{
    #[Route('/', name: 'app_activity_index', methods: ['GET'])]
    // public function index(VeterinaryRepository $veterinaryRepository): Response
    // {
    //     return $this->render('veterinary/index.html.twig', [
    //         'veterinaries' => $veterinaryRepository->findAll(),
    //     ]);
    // }
}