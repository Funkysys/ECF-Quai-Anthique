<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'category:item']),
        new GetCollection(normalizationContext: ['groups' => 'category:list'])   
        ]
    )
]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['category:list', 'category:item'])]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: SubCat::class)]
    #[Groups(['category:list', 'category:item'])]
    private Collection $subCats;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Dish::class)]
    private Collection $dishes;

    public function __construct()
    {
        $this->subCats = new ArrayCollection();
        $this->dishes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
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

    /**
     * @return Collection<int, SubCat>
     */
    public function getSubCats(): Collection
    {
        return $this->subCats;
    }

    public function addSubCat(SubCat $subCat): self
    {
        if (!$this->subCats->contains($subCat)) {
            $this->subCats->add($subCat);
            $subCat->setCategory($this);
        }

        return $this;
    }

    public function removeSubCat(SubCat $subCat): self
    {
        if ($this->subCats->removeElement($subCat)) {
            // set the owning side to null (unless already changed)
            if ($subCat->getCategory() === $this) {
                $subCat->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDishes(): Collection
    {
        return $this->dishes;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dishes->contains($dish)) {
            $this->dishes->add($dish);
            $dish->setCategory($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dishes->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getCategory() === $this) {
                $dish->setCategory(null);
            }
        }

        return $this;
    }
}
