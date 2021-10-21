<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\SearchFormType;
use App\Repository\LivreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $request,LivreRepository $searchRepo,PaginatorInterface $paginator): Response
    {   
        $form = $this->createForm(SearchFormType::class);

        $livre = $form->handleRequest($request);
        
        $isSubmitte = false;

        if ($form->isSubmitted() && $form->isValid()) {
            
            //je récupère les données envoyer dans mon formulaire pour faire la recherche
            $livre = $searchRepo->search($livre->get('title','genre')->getData());
            
            $livre = $paginator->paginate(
                $livre,
                $request->query->getInt('page',1),
                8
            );
            $isSubmitte = true;
        }
        
        return $this->render('search/index.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
            'isSubmitte'=> $isSubmitte,
        ]);
    }
}
