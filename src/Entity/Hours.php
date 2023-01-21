<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: HoursRepository::class)]#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'hours:item']),
        new GetCollection(normalizationContext: ['groups' => 'hours:list'])   
        ]
    )
]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $hour = null;

    public function __toString()
    {
        return $this->hour;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function setHour(int $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

}
