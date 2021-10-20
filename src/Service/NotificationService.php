<?php

// namespace App\Service;

// use App\Entity\Emprunt;
// use DateTime;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\Security\Core\User\UserInterface;

// class NotificationService 
// {
//   private $manager;
  

//   public function __construct(EntityManagerInterface $manager)
//   {
//     $this->manager = $manager;
//   }

//   public function notificationLoan($emprunt): null|int
//   {
//     $now = new DateTime();
//     $nbrNotif=0;

//     if ($emprunt == null) {
//       return null;
//     }

//     for ($i=0; $i < $emprunt ; $i++) { 
//       $date = new DateTime($emprunt[$i]);
//       $result = $now->diff($date,true)->d;
//       if ($result > 3) {
//         $nbrNotif += 1;
//         dd($emprunt[$i]);
//       }
//     }
    
//     return $nbrNotif;
//   }
// }