<?php

// src/Entity/Photo.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'photos')]
    #[ORM\JoinTable(name: 'photo_tag')]
    private Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }
}