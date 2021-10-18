<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisabledController extends AbstractController
{
    #[Route('/disable/{id}', name: 'disabled')]
    public function index(LivreRepository $livreRepository,int $id,EmpruntRepository $empruntRepository,EntityManagerInterface $manager): Response
    {
        $disable = $livreRepository->disableBook($id);
        $emprunt = $empruntRepository->loan($id,$this->getUser());
        
        return $this->redirectToRoute('home', [
            'controller_name' => 'DisabledController',
        ]);
    }
}
