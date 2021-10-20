<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TriByGenreController extends AbstractController
{
    #[Route('/{genre}', name: 'tri_by_genre')]
    public function index($genre,EntityManagerInterface $manager,PaginatorInterface $paginator,Request $request): Response
    {
        $livre = $manager->getRepository(Livre::class)->findBy(array('genre'=> $genre));

        $livre = $paginator->paginate(
            $livre,
            $request->query->getInt('page',1),
            8
        );

        return $this->render('tri_by_genre/index.html.twig', [
            'livre' => $livre,
        ]);
    }
}
