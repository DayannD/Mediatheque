<?php

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Emprunt;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $manager;

    public function __construct($slugger, EntityManagerInterface $manager)
    {
        $this->slugger = $slugger;
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDispo'],
        ];
    }

    public function setBlogPostSlug(BeforeEntityPersistedEvent $event)
    {
        dd($event);
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Emprunt)) {
            return;
        }

        // $slug = $this->slugger->slugify($entity->getTitle());
        // $entity->setSlug($slug);
    }
}