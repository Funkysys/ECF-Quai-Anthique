<?php

namespace App\EventSubscriber;

use App\Entity\Images;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([BeforeEntityPersistedEvent::class => "string[]"])]
    public static function getSubscribedEvents(): array
    {
        return [
          BeforeEntityPersistedEvent::class => ['setImagesDate'],
          BeforeEntityPersistedEvent::class => ['is_admin']
        ];
    }
    
    public function setImagesDate(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Images)) {
            return;
        }
            return $entity->setCreatedAt(new \DateTimeImmutable());
    }
    public function setAdminRole(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }
        if ($entity->getIsAdmin()) {
            $entity->setRoles(['ROLE_ADMIN']);
        }
        return $entity->setRoles([]);
    }
}