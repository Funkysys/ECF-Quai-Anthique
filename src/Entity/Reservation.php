<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ReservationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[
    ApiResource(
        operations: [
            new Get(),
            new GetCollection(),
            new Post(validationContext: ['groups' => 'reservation:create']),
            new Put(),
            new Delete()
        ],
        normalizationContext: ['groups' => ['reservation:read']],
        denormalizationContext: ['groups' => ['reservation:create']],
    ),
    ApiFilter(SearchFilter::class, properties: ['reservationDate' => 'exact', 'user' => 'exact']),
    ApiFilter(OrderFilter::class, properties: ['reservationDate' => 'desc']),
]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['reservation:read', 'reservation:create', 'user:create'])]
    private ?int $nbCovers = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['reservation:read', 'reservation:create', 'user:create'])]
    private ?\DateTimeInterface $reservationDate = null;
    
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Groups(['reservation:read', 'reservation:create', 'user:create'])]
    private ?User $user = null;

    #[ORM\Column]
    #[Groups(['reservation:read', 'reservation:create', 'user:create'])]
    private ?bool $lunchOrDiner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbCovers(): ?int
    {
        return $this->nbCovers;
    }

    public function setNbCovers(int $nbCovers): self
    {
        $this->nbCovers = $nbCovers;

        return $this;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setReservationDate(\DateTimeInterface $reservationDate): self
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isLunchOrDiner(): ?bool
    {
        return $this->lunchOrDiner;
    }

    public function setLunchOrDiner(bool $lunchOrDiner): self
    {
        $this->lunchOrDiner = $lunchOrDiner;

        return $this;
    }
}
