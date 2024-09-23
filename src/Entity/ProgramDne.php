<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'program_dne')]
class ProgramDne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer', name: 'cisloDne')]
    private ?int $cisloDne = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $nazev = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, inversedBy: 'programDne')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zajezdy $zajezd = null;

    public function __toString(): string
    {
        return sprintf('Den %d: %s', $this->cisloDne, $this->nazev);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCisloDne(): ?int
    {
        return $this->cisloDne;
    }

    public function setCisloDne(int $cisloDne): self
    {
        $this->cisloDne = $cisloDne;
        return $this;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(?string $nazev): self // Update setter to accept null
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

    public function setZajezd(Zajezdy $zajezd): self
    {
        $this->zajezd = $zajezd;
        return $this;
    }
}
