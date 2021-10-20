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
        $data = new Livre();

        $data = $this->getDoctrine()->getRepository(Livre::class)->findAll();
        
        $forgot->forgotTake($empruntRepository->empruntProfil($this->getUser()->getId()));
        $notif = $notificationService->notificationLoan($empruntRepository->empruntProfil($this->getUser()->getId()));

        if ($notif) {
            $this->addFlash(
                'notice', 'Vous êtes en possesion de livre depuis plus de 3 semaines.Veuillez les rentres merci'
            );
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
