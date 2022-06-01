<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypesGroundsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypesGroundsRepository::class)]
#[ApiResource]
class TypesGrounds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Spots::class, mappedBy: 'groundSpot')]
    private $spotsList;



    public function __construct()
    {
        $this->spotsList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString (): string
    {
        return $this->getName();
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
            $spotsList->addGroundSpot($this);
        }

        return $this;
    }

    public function removeSpotsList(Spots $spotsList): self
    {
        if ($this->spotsList->removeElement($spotsList)) {
            $spotsList->removeGroundSpot($this);
        }

        return $this;
    }


}
