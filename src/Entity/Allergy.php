<?php

namespace App\Entity;

use App\Repository\AllergyRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AllergyRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'allergy:item']),
        new GetCollection(normalizationContext: ['groups' => 'allergy:list']),
        ]
    )
]
class Allergy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['allergy:list', 'allergy:item'])]
    private ?string $name = null;

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function setName(string $name): self
    {
        $allergns = ['Gluten', 'Peanuts', 'Milk', 'Eggs', 'Nuts', 'Mollusc', 'Seafood', 'Mustard', 'Fish', 'Celery', 'Soy', 'Sulphites', 'Sesame', 'Lupine'];
        $this->name = $name;

        return $this;
    }
}
