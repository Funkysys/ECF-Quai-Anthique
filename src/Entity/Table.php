<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
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
    #[Groups(['table:list', 'table:item'])]
    private ?int $nb_covers = null;

    #[ORM\Column(length: 255)]
    #[Groups(['table:list', 'table:item'])]
    private ?int $hours = null;

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

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }
}
