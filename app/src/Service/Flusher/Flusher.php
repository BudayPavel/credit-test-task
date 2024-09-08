<?php

declare(strict_types=1);

namespace App\Service\Flusher;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

final class Flusher implements FlusherInterface
{
    public function __construct(private EntityManagerInterface $em, private EntityManager $entityManager)
    {
    }

    public function flush(): void
    {
        $this->em->flush();
    }
}
