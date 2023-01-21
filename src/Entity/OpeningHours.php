<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'openingHours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?days $day = null;

    #[ORM\ManyToOne]
    private ?Hours $openingHours = null;

    #[ORM\ManyToOne]
    private ?Minutes $openMinutes = null;

    #[ORM\ManyToOne]
    private ?Hours $closeHours = null;

    #[ORM\ManyToOne]
    private ?Minutes $closeMinutes = null;

    #[ORM\Column]
    private ?bool $open = null;

    #[ORM\Column]
    private ?bool $lunch = null;

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

    public function isOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

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
}
