<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MinutesRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MinutesRepository::class)]
class Minutes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?int $minutes = null;

    public function __toString()
    {
        return $this->minutes;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(int $minutes): self
    {
        $this->minutes = $minutes;

        return $this;
    }
}
