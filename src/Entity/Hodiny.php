<?php

// src/Entity/Hodiny.php

namespace App\Entity;

use App\Repository\HodinyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HodinyRepository::class)]
class Hodiny
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nazev_dne = null;

    #[ORM\Column(type: 'text')]
    private ?string $hodiny_dne = null;

    #[ORM\ManyToOne(targetEntity: Kontakty::class, inversedBy: 'hodiny')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Kontakty $kontakty = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazevDne(): ?string
    {
        return $this->nazev_dne;
    }

    public function setNazevDne(string $nazev_dne): self
    {
        $this->nazev_dne = $nazev_dne;

        return $this;
    }

    public function getHodinyDne(): ?string
    {
        return $this->hodiny_dne;
    }

    public function setHodinyDne(string $hodiny_dne): self
    {
        $this->hodiny_dne = $hodiny_dne;

        return $this;
    }

    public function getKontakty(): ?Kontakty
    {
        return $this->kontakty;
    }

    public function setKontakty(?Kontakty $kontakty): self
    {
        $this->kontakty = $kontakty;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nazev_dne ?? '';
    }
}

