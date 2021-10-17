<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisabledController extends AbstractController
{
    #[Route('/disable/{id}', name: 'disabled')]
    public function index(LivreRepository $livreRepository,int $id): Response
    {
        $disable = $livreRepository->disableBook($id);

        return $this->redirectToRoute('home', [
            'controller_name' => 'DisabledController',
        ]);
    }
}
