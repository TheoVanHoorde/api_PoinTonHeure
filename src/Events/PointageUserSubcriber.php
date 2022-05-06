<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Pointage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;


class PointageUserSubcriber implements EventSubscriberInterface
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setUserForPointage', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function setUserForPointage(ViewEvent $event)
    {
        $pointage= $event->getControllerResult();
        $method= $event->getRequest()->getMethod();

        if($pointage instanceof Pointage && $method === "POST"){;

            $user = $this->security->getUser();
            $pointage->setUser($user);
        }
    }
}