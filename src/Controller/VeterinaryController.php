<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class VeterinaryController extends AbstractController
{

    private $lesVeterinaires = [
        [
            'id' => 1,
            'nom' => 'Lasseau et Desguerre',
            'adresse' => '3 rue du 11 novembre',
            'codePostal' => '60340',
            'ville' => 'SAINT LEU D\'ESSERENT',
            'telephone' => '03.44.55.66.77',
            'fichierImage' => '17.jpg'
        ],
        [
            'id' => 2,
            'nom' => 'Saudubray Jérôme',
            'adresse' => '86 rue de la république',
            'codePostal' => '60100',
            'ville' => 'CREIL',
            'telephone' => '03.44.99.88.77',
            'fichierImage' => '12.jpg'
        ],
        [
            'id' => 3,
            'nom' => 'Brahim et Radji',
            'adresse' => '64 avenue Claude Péroche',
            'codePostal' => '60180',
            'ville' => 'NOGENT SUR OISE',
            'telephone' => '03.22.54.88.77',
            'fichierImage' => '14.jpg'
        ]
    ];

    private function getUnVeterinaire(int $id){
        $lesVeterinaires = $this->lesVeterinaires;
        foreach($lesVeterinaires as $veterinaire){
            if($veterinaire['id'] === $id){
                return $veterinaire;
                break;
            }
        }
        return null;
    }

    #[Route('/veterinary', name: 'app_veterinary_index', methods: ['GET'])]
    public function index(): Response
    {
        // On appelle la vue en lui fournissant la liste des vétérinaires
        // dans une variable TWIG nommée lesVetos
        return $this->render('veterinary/index.html.twig', [
            'lesVetos' => $this->lesVeterinaires
        ]);
    }

    #[Route('/veterinary/{id}/show', name: 'app_veterinary_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $veto = $this->getUnVeterinaire($id);
        if (!$veto) {
            throw new NotFoundHttpException("Ce vétérinaire n'existe pas");
        }
        return $this->render('veterinary/show.html.twig', [
            'veto' => $veto
        ]);
    }
}
