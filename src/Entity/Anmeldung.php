<?php

namespace App\Entity;

use App\Repository\AnmeldungRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnmeldungRepository::class)]
class Anmeldung
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $eventNr = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $teilnehmer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column]
    private ?bool $datenschutz = null;

    #[ORM\Column]
    private ?bool $foto = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $code = null;

    private bool $isSpecialEvent = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getEventNr(): ?string
    {
        return $this->eventNr;
    }

    public function setEventNr(string $eventNr): static
    {
        $this->eventNr = $eventNr;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTeilnehmer(): ?int
    {
        return $this->teilnehmer;
    }

    public function setTeilnehmer(int $teilnehmer): static
    {
        $this->teilnehmer = $teilnehmer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isDatenschutz(): ?bool
    {
        return $this->datenschutz;
    }

    public function setDatenschutz(bool $datenschutz): static
    {
        $this->datenschutz = $datenschutz;

        return $this;
    }

    public function isFoto(): ?bool
    {
        return $this->foto;
    }

    public function setFoto(bool $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSpecialEvent(): bool
    {
        return $this->isSpecialEvent;
    }

    /**
     * @param bool $isSpecialEvent
     */
    public function setIsSpecialEvent(bool $isSpecialEvent): void
    {
        $this->isSpecialEvent = $isSpecialEvent;
    }


}
