<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FishesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FishesRepository::class)]
#[ApiResource]
class Fishes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 9000)]
    private $image;

    #[ORM\ManyToMany(targetEntity: Spots::class, mappedBy: 'spotFish')]
    private $spotsList;

    public function __construct()
    {
        $this->spotsList = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function __toString (): string
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Spots>
     */
    public function getSpotsList(): Collection
    {
        return $this->spotsList;
    }

    public function addSpotsList(Spots $spotsList): self
    {
        if (!$this->spotsList->contains($spotsList)) {
            $this->spotsList[] = $spotsList;
            $spotsList->addSpotFish($this);
        }

        return $this;
    }

    public function removeSpotsList(Spots $spotsList): self
    {
        if ($this->spotsList->removeElement($spotsList)) {
            $spotsList->removeSpotFish($this);
        }

        return $this;
    }


}
