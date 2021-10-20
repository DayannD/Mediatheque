<?php

namespace App\Service;

use App\Entity\Emprunt;
use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class NotificationService 
{
  private $livreRepository;
  private $empruntRepository;

  public function __construct(EntityManagerInterface $manager,LivreRepository $livreRepository,EmpruntRepository $empruntRepository)
  {
    $this->manager = $manager;
    $this->livreRepository = $livreRepository;
    $this->empruntRepository = $empruntRepository;
  }

  public function notificationLoan($emprunt): bool
  {
    $now = new DateTime();
    for ($i=0; $i < sizeof($emprunt) ; $i++) { 
      $result = $now->diff($emprunt[$i]->getLoanAt(),true)->days;
      if ($result > 19 && $emprunt[$i]->getIsLoan() == true) {
        return true;
      }
    }
    return false;
  }
}