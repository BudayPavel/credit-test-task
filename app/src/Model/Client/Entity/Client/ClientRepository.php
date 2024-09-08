<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\Client;

use App\Exception\EntityNotFoundException;
use App\Model\Client\Entity\VO\Id;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final readonly class ClientRepository
{
    /**
     * @var EntityRepository<Client>
     */
    private EntityRepository $repository;

    public function __construct(private EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Client::class);
    }

    public function add(Client $client): void
    {
        $this->em->persist($client);
    }

    public function get(Id $id): Client
    {
        $user = $this->repository->find($id->getValue());

        if ($user === null) {
            throw new EntityNotFoundException('Client is not found.');
        }

        return $user;
    }
}
