<?php

namespace App\EventListener;

// for Doctrine < 2.4: use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Contact;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ContactListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Contact)
        {
            $entity->setReference($this->generateReference($args));
        }
    }

    private function generateReference($args)
    {
        $highestContactReference = $args->getEntityManager()->getRepository(Contact::class)->findHighestReference();
        // If hightest contact reference is null, set the "first" reference at 1
        if ($highestContactReference[1] == null)
        {
            return intval(1);
        }

        return $highestContactReference[1] + intval(1);
    }
}