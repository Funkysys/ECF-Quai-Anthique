<?php

namespace App\EventSubscriber;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([BeforeEntityPersistedEvent::class => "string[]"])]
    public static function getSubscribedEvents(): array
    {
        return [
          BeforeEntityPersistedEvent::class => ['setImagesDate'],
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
}