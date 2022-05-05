<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PointageRepository::class)]
#[ApiResource()]
class Pointage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("pointage_Read")]
    private $id;

    #[ORM\Column(type: 'time')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="L'heure du début de matinée est obligatoire")
     *
     */
    private $startHourAm;

    #[ORM\Column(type: 'time')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="L'heure du Fin de matinée est obligatoire")
     *
     */
    private $endHourAm;

    #[ORM\Column(type: 'time')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="L'heure du début de la pause est obligatoire")
     *
     */
    private $startHourBreak;

    #[ORM\Column(type: 'time')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="L'heure de fin de la pause est obligatoire")
     *
     */
    private $endHourBreak;

    #[ORM\Column(type: 'time')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="L'heure du début de l'aprés-midi est obligatoire")
     *
     */
    private $startHourPm;

    #[ORM\Column(type: 'time')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="L'heure de la fib de journée est obligatoire")
     *
     */
    private $endHourPm;

    #[ORM\Column(type: 'date')]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="La date du jour du pointage et obligatoire")
     *
     */
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="La description de la journée est obligatoire")
     * @Assert\Length(min= 3, minMessage="La description de la journee doit faire entre 3 et 255 caractere", max= 255, maxMessage="La description de la journée doit faire entre 3 et 255 caractère")
     */
    private $observation;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("pointage_Read")]
    /**
     * @Assert\NotBlank(message="le status et obligatoire")
     *
     */
    private $status;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'pointages')]
    #[ORM\JoinColumn(nullable: false)]
    /**
     * @Assert\NotBlank(message="l'utilisateur est obligatoire")
     *
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartHourAm(): ?\DateTimeInterface
    {
        return $this->startHourAm;
    }

    public function setStartHourAm(\DateTimeInterface $startHourAm): self
    {
        $this->startHourAm = $startHourAm;

        return $this;
    }

    public function getEndHourAm(): ?\DateTimeInterface
    {
        return $this->endHourAm;
    }

    public function setEndHourAm(\DateTimeInterface $endHourAm): self
    {
        $this->endHourAm = $endHourAm;

        return $this;
    }

    public function getStartHourBreak(): ?\DateTimeInterface
    {
        return $this->startHourBreak;
    }

    public function setStartHourBreak(\DateTimeInterface $startHourBreak): self
    {
        $this->startHourBreak = $startHourBreak;

        return $this;
    }

    public function getEndHourBreak(): ?\DateTimeInterface
    {
        return $this->endHourBreak;
    }

    public function setEndHourBreak(\DateTimeInterface $endHourBreak): self
    {
        $this->endHourBreak = $endHourBreak;

        return $this;
    }

    public function getStartHourPm(): ?\DateTimeInterface
    {
        return $this->startHourPm;
    }

    public function setStartHourPm(\DateTimeInterface $startHourPm): self
    {
        $this->startHourPm = $startHourPm;

        return $this;
    }

    public function getEndHourPm(): ?\DateTimeInterface
    {
        return $this->endHourPm;
    }

    public function setEndHourPm(\DateTimeInterface $endHourPm): self
    {
        $this->endHourPm = $endHourPm;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
}
