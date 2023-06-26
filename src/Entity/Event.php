<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $beschreibung = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $datum = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bild = null;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Kategorie', inversedBy: 'event')]
    private ?Kategorie $Kategorie = null;

    #[ORM\Column(nullable: true)]
    private ?int $anzahl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zeit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hinweis = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getBeschreibung(): ?string
    {
        return $this->beschreibung;
    }

    public function setBeschreibung(?string $beschreibung): static
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }

    public function getDatum(): ?string
    {
        return $this->datum;
    }

    public function setDatum(?string $datum): static
    {
        $this->datum = $datum;

        return $this;
    }

    public function getBild(): ?string
    {
        return $this->bild;
    }

    public function setBild(?string $bild): static
    {
        $this->bild = $bild;

        return $this;
    }

    public function getKategorie(): ?Kategorie
    {
        return $this->Kategorie;
    }

    public function setKategorie(?Kategorie $Kategorie): static
    {
        $this->Kategorie = $Kategorie;

        return $this;
    }

    public function getAnzahl(): ?int
    {
        return $this->anzahl;
    }

    public function setAnzahl(?int $anzahl): static
    {
        $this->anzahl = $anzahl;

        return $this;
    }

    public function getZeit(): ?string
    {
        return $this->zeit;
    }

    public function setZeit(?string $zeit): static
    {
        $this->zeit = $zeit;

        return $this;
    }

    public function getHinweis(): ?string
    {
        return $this->hinweis;
    }

    public function setHinweis(?string $hinweis): static
    {
        $this->hinweis = $hinweis;

        return $this;
    }


}
