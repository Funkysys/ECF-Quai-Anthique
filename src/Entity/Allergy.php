<?php

namespace App\Entity;

use App\Repository\AllergyRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AllergyRepository::class)]
#[
    ApiResource(
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
    #[Groups(['allergy:list', 'allergy:item', 'user:list', 'user:item', 'groups' => 'user:create'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['allergy:list', 'allergy:item', 'user:list', 'user:item', 'groups' => 'user:create'])]
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
        $this->name = $name;

        return $this;
    }
}
