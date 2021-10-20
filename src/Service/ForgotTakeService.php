<?php

namespace App\Service;

use App\Entity\Emprunt;
use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ForgotTakeService 
{
  private $manager;
  private $livreRepository;
  private $empruntRepository;

  public function __construct(EntityManagerInterface $manager,LivreRepository $livreRepository,EmpruntRepository $empruntRepository)
  {
    $this->manager = $manager;
    $this->livreRepository = $livreRepository;
    $this->empruntRepository = $empruntRepository;
  }

  public function forgotTake($emprunt)
  {
    $now = new DateTime();
    
    for ($i=0; $i < sizeof($emprunt) ; $i++) { 
      
      $result = $now->diff($emprunt[$i]->getDateEmprunt(),true)->days;
      if ($result > 3 && $emprunt[$i]->getIsLoan() == false) {
        $this->livreRepository->resetBook($emprunt[$i]->getNameLivre());   
        $this->empruntRepository->deleteEmprunt($emprunt[$i]->getId(),$emprunt[$i]->getNameLivre());
      }
    }
    
  }
}