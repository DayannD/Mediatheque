<?php

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Emprunt;
use App\Entity\Livre;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;

class EasyAdminSubscriber extends Event
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['livreRendu'],
        ];
    }

    public function livreRendu(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Emprunt)) {
            return;
        }

        $this->setDispo($entity);
        // $slug = $this->slugger->slugify($entity->getTitle());
        // $entity->setSlug($slug);
    }

    public function setDispo(Emprunt $entity): void
    {
        dd($entity);
        $livre = $entity->getNameLivre();

        $livre->setDispo(true);     
    }
}