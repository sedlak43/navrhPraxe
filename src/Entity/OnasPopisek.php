<?php

namespace App\Entity;

use App\Repository\OnasPopisekRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OnasPopisekRepository::class)]
class OnasPopisek
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nazev = null;

    #[ORM\Column(type: 'text')]
    private  ?string $popisek = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $obrazek = null;

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

    public function getObrazek(): ?string
    {
        return $this->obrazek;
    }

    public function setObrazek(?string $obrazek): self
    {
        $this->obrazek = $obrazek;
        return $this;
    }
}
