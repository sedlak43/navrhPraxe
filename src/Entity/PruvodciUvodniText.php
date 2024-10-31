<?php

namespace App\Entity;

use App\Repository\PruvodciUvodniTextRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PruvodciUvodniTextRepository::class)]
#[ORM\Table(name: 'pruvodci_uvodni_text')]
class PruvodciUvodniText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $nazev = null;

    #[ORM\Column(type: 'text')]
    private  ?string $popisek = null;

    // Getters and Setters

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
