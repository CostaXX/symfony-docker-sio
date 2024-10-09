<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Veterinary;
use App\Repository\VeterinaryRepository;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/followups', name: 'app_dashboard_followups')]
    public function followUpsByVeterinary(VeterinaryRepository $veterinaryRepository): Response
    {
        $suivisParVeto = $veterinaryRepository->getNumberFollowsupByVeterinary();
        return $this->render('dashboard/followups.html.twig', [
            'followups' => $suivisParVeto,
        ]);
    }

    #[Route('/indicators', name: 'app_dashboard_indicators')]
    public function indicators(VeterinaryRepository $veterinaryRepository): Response
    {
        $nbNouveauxVetosDuMois = $veterinaryRepository->countNewVetsInMonth();
        $nbVetos = $veterinaryRepository->countAllVets();
        dump($nbNouveauxVetosDuMois);
        dump($nbVetos);
        return $this->render('dashboard/indicators.html.twig', [
            'newVetsNumber' => $nbNouveauxVetosDuMois,
            'vetsNumber' => $nbVetos,
        ]);
    }
}
