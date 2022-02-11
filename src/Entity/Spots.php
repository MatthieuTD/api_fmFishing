<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SpotsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotsRepository::class)]
#[ApiResource]
class Spots
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $superficie;

    #[ORM\Column(type: 'float', nullable: true)]
    private $profondeur_min;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prodondeur_min;

    #[ORM\Column(type: 'string', length: 9000)]
    private $image;

    #[ORM\ManyToMany(targetEntity: Fishes::class, inversedBy: 'spots_list')]
    private $list_fish;

    #[ORM\ManyToMany(targetEntity: TypesGrounds::class, inversedBy: 'ground_list')]
    private $grounds_list;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'categorie')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    #[ORM\ManyToOne(targetEntity: States::class, inversedBy: 'spots')]
    private $state;

    public function __construct()
    {
        $this->list_fish = new ArrayCollection();
        $this->grounds_list = new ArrayCollection();
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

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(?int $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getProfondeurMin(): ?float
    {
        return $this->profondeur_min;
    }

    public function setProfondeurMin(?float $profondeur_min): self
    {
        $this->profondeur_min = $profondeur_min;

        return $this;
    }

    public function getProdondeurMin(): ?float
    {
        return $this->prodondeur_min;
    }

    public function setProdondeurMin(?float $prodondeur_min): self
    {
        $this->prodondeur_min = $prodondeur_min;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Fishes[]
     */
    public function getListFish(): Collection
    {
        return $this->list_fish;
    }

    public function addListFish(Fishes $listFish): self
    {
        if (!$this->list_fish->contains($listFish)) {
            $this->list_fish[] = $listFish;
        }

        return $this;
    }

    public function removeListFish(Fishes $listFish): self
    {
        $this->list_fish->removeElement($listFish);

        return $this;
    }

    /**
     * @return Collection|TypesGrounds[]
     */
    public function getGroundsList(): Collection
    {
        return $this->grounds_list;
    }

    public function addGroundsList(TypesGrounds $groundsList): self
    {
        if (!$this->grounds_list->contains($groundsList)) {
            $this->grounds_list[] = $groundsList;
        }

        return $this;
    }

    public function removeGroundsList(TypesGrounds $groundsList): self
    {
        $this->grounds_list->removeElement($groundsList);

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getState(): ?States
    {
        return $this->state;
    }

    public function setState(?States $state): self
    {
        $this->state = $state;

        return $this;
    }
}
