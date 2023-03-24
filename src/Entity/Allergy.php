<?php

namespace App\Entity;

use App\Repository\AllergyRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AllergyRepository::class)]
#[
    ApiResource(
        operations: [
            new Get(normalizationContext: ['groups' => 'allergy:item']),
            new GetCollection(normalizationContext: ['groups' => 'allergy:list']),
        ]
    )
]
class Allergy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['allergy:list', 'allergy:item', 'user:list', 'user:item', 'dish:list', 'dish:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['allergy:list', 'allergy:item', 'user:list', 'user:item', 'dish:list', 'dish:item'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'allergies', cascade: ['persist'])]
    #[Groups(['allergy:list', 'allergy:item'])]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Dish::class, mappedBy: 'allergies')]
    #[Groups(['allergy:list', 'allergy:item'])]
    private Collection $dishes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->dishes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addAllergy($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeAllergy($this);
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
            $dish->addAllergy($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dishes->removeElement($dish)) {
            $dish->removeAllergy($this);
        }

        return $this;
    }
}
