<?php

namespace App\Entity;

use App\Repository\FormulasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: FormulasRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'formulas:item']),
        new GetCollection(normalizationContext: ['groups' => 'formulas:list'])   
        ]
    )
]
class Formulas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['formulas:list', 'formulas:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['formulas:list', 'formulas:item'])]
    private ?string $title = null;
    
    #[ORM\Column]
    #[Groups(['formulas:list', 'formulas:item'])]
    private ?int $price = null;

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
