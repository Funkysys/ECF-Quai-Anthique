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

    #[ORM\Column(length: 255)]
    #[Groups(['hours:list', 'hours:item'])]
    private ?string $day = null;

    #[ORM\Column]
    #[Groups(['hours:list', 'hours:item'])]
    private ?int $open_hour = null;

    #[ORM\Column]
    #[Groups(['hours:list', 'hours:item'])]
    private ?int $close_hour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpenHour(): ?int
    {
        return $this->open_hour;
    }

    public function setOpenHour(int $open_hour): self
    {
        $this->open_hour = $open_hour;

        return $this;
    }

    public function getCloseHour(): ?int
    {
        return $this->close_hour;
    }

    public function setCloseHour(int $close_hour): self
    {
        $this->close_hour = $close_hour;

        return $this;
    }
}
