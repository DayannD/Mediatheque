<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(EmpruntRepository $empruntRepository): Response
    {
        $emprunt = $empruntRepository->empruntProfil($this->getUser()->getId());

        return $this->render('profile/index.html.twig', [
            'emprunt' => $emprunt,
        ]);
    }
}
