<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DaysRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DaysRepository::class)]
class Days
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['openingHours:list', 'openingHours:item'])]
    private ?string $day = null;

    #[ORM\OneToMany(mappedBy: 'day', targetEntity: OpeningHours::class)]
    private Collection $openingHours;

    public function __construct()
    {
        $this->openingHours = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->day;
    }
    
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

    /**
     * @return Collection<int, OpeningHours>
     */
    public function getOpeningHours(): Collection
    {
        return $this->openingHours;
    }

    public function addOpeningHour(OpeningHours $openingHour): self
    {
        if (!$this->openingHours->contains($openingHour)) {
            $this->openingHours->add($openingHour);
            $openingHour->setDay($this);
        }

        return $this;
    }

    public function removeOpeningHour(OpeningHours $openingHour): self
    {
        if ($this->openingHours->removeElement($openingHour)) {
            // set the owning side to null (unless already changed)
            if ($openingHour->getDay() === $this) {
                $openingHour->setDay(null);
            }
        }

        return $this;
    }
}
