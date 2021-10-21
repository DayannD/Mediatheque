<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    //mon controller pour le profile de l'utilisateur 
    #[Route('/profile', name: 'profile')]
    public function index(EmpruntRepository $empruntRepository): Response
    {
        //Je vérifie ses emprunts et lui affiche dans la vue twig
        $emprunt = $empruntRepository->empruntProfil($this->getUser()->getId());

        return $this->render('profile/index.html.twig', [
            'emprunt' => $emprunt,
        ]);
    }
}
