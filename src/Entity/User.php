<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\ManyToMany(targetEntity: FishingGroup::class, mappedBy: 'Users')]
    private $listUsers;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $username;

    #[ORM\ManyToMany(targetEntity: Spots::class, mappedBy: 'owner')]
    private $listSpots;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typePeche;

    public function __construct()
    {
        $this->listUsers = new ArrayCollection();
        $this->listSpots = new ArrayCollection();
    }
    public function __toString (): string
    {
        return $this->getEmail();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, FishingGroup>
     */
    public function getListUsers(): Collection
    {
        return $this->listUsers;
    }

    public function addListUser(FishingGroup $listUser): self
    {
        if (!$this->listUsers->contains($listUser)) {
            $this->listUsers[] = $listUser;
            $listUser->addUser($this);
        }

        return $this;
    }

    public function removeListUser(FishingGroup $listUser): self
    {
        if ($this->listUsers->removeElement($listUser)) {
            $listUser->removeUser($this);
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Spots>
     */
    public function getListSpots(): Collection
    {
        return $this->listSpots;
    }

    public function addListSpot(Spots $listSpot): self
    {
        if (!$this->listSpots->contains($listSpot)) {
            $this->listSpots[] = $listSpot;
            $listSpot->addOwner($this);
        }

        return $this;
    }

    public function removeListSpot(Spots $listSpot): self
    {
        if ($this->listSpots->removeElement($listSpot)) {
            $listSpot->removeOwner($this);
        }

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTypePeche(): ?string
    {
        return $this->typePeche;
    }

    public function setTypePeche(?string $typePeche): self
    {
        $this->typePeche = $typePeche;

        return $this;
    }
}
