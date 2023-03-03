<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TableRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'table:item']),
        new GetCollection(normalizationContext: ['groups' => 'table:list']),
        new Post()
        ]
    )
]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['table:list', 'table:item' , 'groups' => 'user:create'])]
    private ?int $nb_covers = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['table:list', 'table:item' , 'groups' => 'user:create'])]
    private ?\DateTimeInterface $reservationDate = null;

    #[ORM\ManyToOne(inversedBy: 'tables')]
    private ?User $user = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbCovers(): ?int
    {
        return $this->nb_covers;
    }

    public function setNbCovers(int $nb_covers): self
    {
        $this->nb_covers = $nb_covers;

        return $this;
    }

    public function getreservationDate(): ?\DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setreservationDate(\DateTimeInterface $reservationDate): self
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

    
}
