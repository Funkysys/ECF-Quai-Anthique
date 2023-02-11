<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'client:item']),
        new GetCollection(normalizationContext: ['groups' => 'allergy:list'])   
        ]
    )
]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['client:list', 'client:item'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['client:list', 'client:item'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Allergy::class, inversedBy: 'clients')]
    #[Groups(['client:list', 'client:item'])]
    private Collection $allergy;

    public function __construct()
    {
        $this->allergy = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, allergy>
     */
    public function getAllergy(): Collection
    {
        return $this->allergy;
    }

    public function addAllergy(Allergy $allergy): self
    {
        if (!$this->allergy->contains($allergy)) {
            $this->allergy->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergy $allergy): self
    {
        $this->allergy->removeElement($allergy);

        return $this;
    }
}
