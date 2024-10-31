<?php

namespace App\Entity;

use App\Repository\SluzbyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SluzbyRepository::class)]
class Sluzby
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nazev = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek = null;

    // Getters and setters...

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
}