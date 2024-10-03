<?php

// src/Entity/Domovskastranka.php

namespace App\Entity;

use AllowDynamicProperties;
use App\Repository\DomovskastrankaRepository;
use Doctrine\ORM\Mapping as ORM;

#[AllowDynamicProperties] #[ORM\Entity(repositoryClass: DomovskastrankaRepository::class)]
class Domovskastranka
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, cascade: ["remove"])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Zajezdy $vystavenyZajezd1 = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, cascade: ["remove"])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Zajezdy $vystavenyZajezd2 = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, cascade: ["remove"])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Zajezdy $vystavenyZajezd3 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVystavenyZajezd1(): ?Zajezdy
    {
        return $this->vystavenyZajezd1;
    }

    public function setVystavenyZajezd1(?Zajezdy $vystavenyZajezd1): self
    {
        $this->vystavenyZajez1 = $vystavenyZajezd1;
        return $this;
    }

    public function getVystavenyZajezd2(): ?Zajezdy
    {
        return $this->vystavenyZajezd2;
    }

    public function setVystavenyZajezd2(?Zajezdy $vystavenyZajezd2): self
    {
        $this->vystavenyZajezd2 = $vystavenyZajezd2;
        return $this;
    }

    public function getVystavenyZajezd3(): ?Zajezdy
    {
        return $this->vystavenyZajezd3;
    }

    public function setVystavenyZajezd3(?Zajezdy $vystavenyZajezd3): self
    {
        $this->vystavenyZajezd3 = $vystavenyZajezd3;
        return $this;
    }
}
