<?php

// src/Entity/Tag.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Photo::class, mappedBy: 'tags')]
    private Collection $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    // Getters and setters for the properties...

    public function __toString(): string
    {
        return $this->name;  // Adjust to return the value you want to display
    }

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

    public function getPhotos(): Collection
    {
        return $this->photos;
    }
}
