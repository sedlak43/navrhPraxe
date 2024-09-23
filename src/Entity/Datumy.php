<?php

// src/Entity/Datumy.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Datumy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    #[Assert\Regex(
        pattern: "/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[0-2])\.\d{4}$/",
        message: "The date must be in the format DD.MM.YYYY."
    )]
    private ?\DateTimeInterface $datum = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, inversedBy: 'datumy')]
    private ?Zajezdy $zajezd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): static
    {
        $this->datum = $datum;
        return $this;
    }

    public function getZajezd(): ?Zajezdy
    {
        return $this->zajezd;
    }

    public function setZajezd(?Zajezdy $zajezd): static
    {
        $this->zajezd = $zajezd;
        return $this;
    }

    // Add the __toString method
    public function __toString(): string
    {
        // Return a formatted string representing the date
        return $this->datum ? $this->datum->format('d.m.Y') : '';
    }
}
