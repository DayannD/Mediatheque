<?php

namespace App\Controller;

use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisabledController extends AbstractController
{
    //Mon controller qui rend le livre indisponible et fait une demande d'emprunt pour l'inscrit
    #[Route('/disable/{id}', name: 'disabled')]
    public function index(LivreRepository $livreRepository,int $id,EmpruntRepository $empruntRepository): Response
    {
        $livreRepository->disableBook($id);
        $empruntRepository->loan($id,$this->getUser());
        
        return $this->redirectToRoute('home', [
            'controller_name' => 'DisabledController',
        ]);
    }
}
