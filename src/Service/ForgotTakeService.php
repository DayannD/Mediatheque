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

  //Ma function pour vérifier si l'utilisateur à récuperer on livre avant 3 jours
  public function forgotTake($emprunt)
  {
    $now = new DateTime();
      
    //Avec sizeof je vérifie combien de données il a dans $emprunt
      for ($i=0; $i < sizeof($emprunt) ; $i++) { 
        
        //diff pour trouver la différence entre maintenant et la date d'emprunt
        $result = $now->diff($emprunt[$i]->getDateEmprunt(),true)->days;

        //si cette date est supérieur à 3 et que il n'a pas était récupèrer
        if ($result > 3 && $emprunt[$i]->getIsLoan() == false) {

          //je supprime l'emprunt et rend le livre disponible
          $this->livreRepository->resetBook($emprunt[$i]->getNameLivre());   
          $this->empruntRepository->deleteEmprunt($emprunt[$i]->getId(),$emprunt[$i]->getNameLivre());
        }
      }

  }
}