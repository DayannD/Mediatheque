<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use App\Service\ForgotTakeService;
use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PaginatorInterface $paginator,
    Request $request,
    EmpruntRepository $empruntRepository,
    ForgotTakeService $forgot,
    NotificationService $notificationService): Response
    {   
        //Je récupère tout mes livres
        $data = $this->getDoctrine()->getRepository(Livre::class)->findAll();
        
        //Si l'utilisateur est connecter
        if ($this->getUser()) {
            //je vérifie sa demande d'emprunt,si elle date de plus de 3 jours ,je supprime la demande et rend le livre disponible
            $forgot->forgotTake($empruntRepository->empruntProfil($this->getUser()->getId()));
           
            //Je vérifie si le livre l'inscrit à un livre en sa possesion depuis plus de 3 semaines
            $notif = $notificationService->notificationLoan($empruntRepository->empruntProfil($this->getUser()->getId()));
            
            //si oui,un message flash s'affiche pour lui rappeller
            if ($notif) {
                $this->addFlash(
                    'notice', 'Vous êtes en possesion de livre depuis plus de 3 semaines.Veuillez les rentres merci'
                );
            }
        }

        $livre = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            8
        );

        return $this->render('home/index.html.twig', [
            'livre' => $livre,
        ]);
    }
}
