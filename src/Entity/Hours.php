<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\HoursRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['openingHours:list', 'openingHours:item'])]
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
