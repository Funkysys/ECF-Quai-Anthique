<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'menu:item']),
        new GetCollection(normalizationContext: ['groups' => 'menu:list'])   
        ]
    )
]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['menu:list', 'menu:item'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['menu:list', 'menu:item'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['menu:list', 'menu:item'])]
    private ?int $price = null;

    #[ORM\ManyToMany(targetEntity: Formulas::class, inversedBy: 'menus')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['menu:list', 'menu:item'])]
    private Collection $formulas;

    public function __construct()
    {
        $this->formulas = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Formulas>
     */
    public function getFormulas(): Collection
    {
        return $this->formulas;
    }

    public function addFormula(Formulas $formula): self
    {
        if (!$this->formulas->contains($formula)) {
            $this->formulas->add($formula);
        }

        return $this;
    }

    public function removeFormula(Formulas $formula): self
    {
        $this->formulas->removeElement($formula);

        return $this;
    }
}
