<?php

// src/Entity/Tipy.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Tipy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nazev = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, inversedBy: 'tipy')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zajezdy $zajezd = null;

    public function __toString(): string
    {
        return $this->nazev;  // Adjust to return the value you want to display
    }

    // Gettery a settery
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): self
    {
        $this->nazev = $nazev;
        return $this;
    }

    public function getPopisek(): ?string
    {
        return $this->popisek;
    }

    public function setPopisek(string $popisek): self
    {
        $this->popisek = $popisek;
        return $this;
    }

    public function getZajezd(): ?Zajezdy
    {
        return $this->zajezd;
    }

    public function setZajezd(?Zajezdy $zajezd): self
    {
        $this->zajezd = $zajezd;
        return $this;
    }
}
