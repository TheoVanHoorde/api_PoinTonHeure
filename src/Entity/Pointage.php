<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: PointageRepository::class)]
#[ApiResource]
class Pointage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'time')]
    private $startHourAm;

    #[ORM\Column(type: 'time')]
    private $endHourAm;

    #[ORM\Column(type: 'time')]
    private $startHourBreak;

    #[ORM\Column(type: 'time')]
    private $endHourBreak;

    #[ORM\Column(type: 'time')]
    private $startHourPm;

    #[ORM\Column(type: 'time')]
    private $endHourPm;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    private $observation;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'pointages')]
    #[ORM\JoinColumn(nullable: false)]
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
