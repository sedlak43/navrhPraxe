<?php

// src/Entity/Photo.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)] // Allow null values
    private ?string $popisek = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)] // This is already nullable
    private ?string $image = null;

    // Getters and Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPopisek(): ?string
    {
        return $this->popisek;
    }

    public function setPopisek(?string $popisek): static // Make it nullable in the setter
    {
        $this->popisek = $popisek;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image ?? 'anonym.jpg';
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }
}