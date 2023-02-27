<?php

namespace App\Entity;

use App\Repository\SubCatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SubCatRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'subcat:item']),
        new GetCollection(normalizationContext: ['groups' => 'subcat:list'])   
        ]
    )
]
class SubCat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'subCat', targetEntity: Dish::class)]
    #[Groups(['subcat:list', 'subcat:item'])]
    private Collection $Dish;

    #[ORM\ManyToOne(inversedBy: 'subCats')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['subcat:list', 'subcat:item'])]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    #[Groups(['subcat:list', 'subcat:item', 'category:list', 'category:item', 'dish:list', 'dish:item'])]
    private ?string $title = null;

    public function __construct()
    {
        $this->Dish = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDish(): Collection
    {
        return $this->Dish;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->Dish->contains($dish)) {
            $this->Dish->add($dish);
            $dish->setSubCat($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->Dish->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getSubCat() === $this) {
                $dish->setSubCat(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
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
}
