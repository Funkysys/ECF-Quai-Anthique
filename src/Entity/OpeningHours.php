<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\OpeningHoursRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'openingHours:item']),
        new GetCollection(normalizationContext: ['groups' => 'openingHours:list']),
        new Post()   
        ]
    )
]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'openingHours')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?Days $day = null;

    #[ORM\ManyToOne]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?Hours $openingHours = null;

    #[ORM\ManyToOne]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?Minutes $openMinutes = null;

    #[ORM\ManyToOne]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?Hours $closeHours = null;

    #[ORM\ManyToOne]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?Minutes $closeMinutes = null;

    #[ORM\Column]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?bool $close = null;

    #[ORM\Column]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?bool $lunch = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?bool $diner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?Days
    {
        return $this->day;
    }

    public function setDay(?Days $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningHours(): ?Hours
    {
        return $this->openingHours;
    }

    public function setOpeningHours(?Hours $openingHours): self
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    public function getOpenMinutes(): ?Minutes
    {
        return $this->openMinutes;
    }

    public function setOpenMinutes(?Minutes $openMinutes): self
    {
        $this->openMinutes = $openMinutes;

        return $this;
    }

    public function getCloseHours(): ?Hours
    {
        return $this->closeHours;
    }

    public function setCloseHours(?Hours $closeHours): self
    {
        $this->closeHours = $closeHours;

        return $this;
    }

    public function getCloseMinutes(): ?Minutes
    {
        return $this->closeMinutes;
    }

    public function setCloseMinutes(?Minutes $closeMinutes): self
    {
        $this->closeMinutes = $closeMinutes;

        return $this;
    }

    public function isClose(): ?bool
    {
        return $this->close;
    }

    public function setClose(bool $close): self
    {
        $this->close = $close;

        return $this;
    }

    public function isLunch(): ?bool
    {
        return $this->lunch;
    }

    public function setLunch(bool $lunch): self
    {
        $this->lunch = $lunch;

        return $this;
    }

    public function isDiner(): ?bool
    {
        return $this->diner;
    }

    public function setDiner(?bool $diner): self
    {
        $this->diner = $diner;

        return $this;
    }
}
