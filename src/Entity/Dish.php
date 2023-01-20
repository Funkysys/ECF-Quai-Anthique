<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DishRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DishRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'dish:item']),
        new GetCollection(normalizationContext: ['groups' => 'dish:list'])   
        ]
    )
]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['dish:list', 'dish:item'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['dish:list', 'dish:item'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['dish:list', 'dish:item'])]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'Dish')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['dish:list', 'dish:item'])]
    private ?SubCat $subCat = null;

    #[ORM\ManyToOne(inversedBy: 'dishes')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category = null;

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

    public function getSubCat(): ?SubCat
    {
        return $this->subCat;
    }

    public function setSubCat(?SubCat $subCat): self
    {
        $this->subCat = $subCat;

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
}
