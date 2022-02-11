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

    #[ORM\ManyToMany(targetEntity: Spots::class, mappedBy: 'grounds_list')]
    private $ground_list;

    public function __construct()
    {
        $this->ground_list = new ArrayCollection();
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
     * @return Collection|Spots[]
     */
    public function getGroundList(): Collection
    {
        return $this->ground_list;
    }

    public function addGroundList(Spots $groundList): self
    {
        if (!$this->ground_list->contains($groundList)) {
            $this->ground_list[] = $groundList;
            $groundList->addGroundsList($this);
        }

        return $this;
    }

    public function removeGroundList(Spots $groundList): self
    {
        if ($this->ground_list->removeElement($groundList)) {
            $groundList->removeGroundsList($this);
        }

        return $this;
    }
}
