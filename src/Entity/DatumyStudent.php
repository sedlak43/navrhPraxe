<?php

// src/Entity/Datumy.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class DatumyStudent
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

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $delka = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?float $price = null;

    #[ORM\ManyToOne(targetEntity: ZajezdyStudent::class, inversedBy: 'datumy_student')]
    private ?ZajezdyStudent $zajezd_student = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelka(): ?int
    {
        return $this->delka;
    }

    public function setDelka(?int $delka): static
    {
        $this->delka = $delka;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;
        return $this;
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

    public function getZajezdStudent(): ?ZajezdyStudent
    {
        return $this->zajezd_student;
    }

    public function setZajezdStudent(?ZajezdyStudent $zajezd_student): static
    {
        $this->zajezd_student = $zajezd_student;
        return $this;
    }

    // Add the __toString method
    public function __toString(): string
    {
        return $this->datum ? $this->datum->format('d.m.Y') : '';
    }
}

