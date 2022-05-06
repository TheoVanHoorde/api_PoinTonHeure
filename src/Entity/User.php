<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
/**
 * @ApiResource(
 *     normalizationContext={"groups"={"users_read"}}
 *     )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /**
     * @Groups({"users_read"})
     */
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    /**
     * @Assert\NotBlank(message="L'adresse email est obligatoire")
     * @Groups({"users_read"})
     */
    private $email;

    #[ORM\Column(type: 'json')]
    /**
     * @Groups({"users_read"})
     */
    private $roles = [];

    #[ORM\Column(type: 'string')]
    /**
     * @Assert\NotBlank(message=" Il vous faut un mots de passe obligatoire")
     */
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\NotBlank(message="Le nom de famille est obligatoire")
     * @Groups({"users_read"})
     */
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\NotBlank(message=" Le prénom est obligatoire")
     * @Groups({"users_read"})
     */
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\NotBlank(message="La description de la journée est obligatoire")
     * @Assert\Length(min= 9, minMessage="Le numéro de téléphone doit faire entre 9 et 255 caractere", max= 255, maxMessage="Le numéro de téléphone doit faire entre 9 et 255 caractere")
     * @Groups({"users_read"})
     */
    private $phone;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Pointage::class)]
    #[ApiSubresource]
    /**
     * @Groups({"users_read"})
     */
    private $pointages;

    public function __construct()
    {
        $this->pointages = new ArrayCollection();
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

    public function getUsername(): ?string
    {
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Pointage>
     */
    public function getPointages(): Collection
    {
        return $this->pointages;
    }

    public function addPointage(Pointage $pointage): self
    {
        if (!$this->pointages->contains($pointage)) {
            $this->pointages[] = $pointage;
            $pointage->setUser($this);
        }

        return $this;
    }

    public function removePointage(Pointage $pointage): self
    {
        if ($this->pointages->removeElement($pointage)) {
            // set the owning side to null (unless already changed)
            if ($pointage->getUser() === $this) {
                $pointage->setUser(null);
            }
        }

        return $this;
    }
}
