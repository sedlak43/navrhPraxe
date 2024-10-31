<?php

namespace App\Entity;

use App\Repository\KontaktyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KontaktyRepository::class)]
class Kontakty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // Nadpis and Popisek fields for general information
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nadpis = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek = null;

    // Address-related fields
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nadpis_adresa = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek_adresa = null;

    // Phone-related fields
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nadpis_telefon = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek_telefon = null;

    // Email-related fields
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nadpis_email = null;

    #[ORM\Column(type: 'text')]
    private ?string $popisek_email = null;

    // Opening hours fields
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nadpis_hodiny = null;

    #[ORM\OneToMany(targetEntity: Hodiny::class, mappedBy: 'kontakty', cascade: ['persist', 'remove'])]
    private Collection $hodiny;

    // Map-related fields
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nadpis_mapa = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $obrazek = null;

    public function __construct()
    {
        $this->hodiny = new ArrayCollection();
    }

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNadpis(): ?string
    {
        return $this->nadpis;
    }

    public function setNadpis(string $nadpis): self
    {
        $this->nadpis = $nadpis;
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

    public function getNadpisAdresa(): ?string
    {
        return $this->nadpis_adresa;
    }

    public function setNadpisAdresa(string $nadpis_adresa): self
    {
        $this->nadpis_adresa = $nadpis_adresa;
        return $this;
    }

    public function getPopisekAdresa(): ?string
    {
        return $this->popisek_adresa;
    }

    public function setPopisekAdresa(string $popisek_adresa): self
    {
        $this->popisek_adresa = $popisek_adresa;
        return $this;
    }

    public function getNadpisTelefon(): ?string
    {
        return $this->nadpis_telefon;
    }

    public function setNadpisTelefon(string $nadpis_telefon): self
    {
        $this->nadpis_telefon = $nadpis_telefon;
        return $this;
    }

    public function getPopisekTelefon(): ?string
    {
        return $this->popisek_telefon;
    }

    public function setPopisekTelefon(string $popisek_telefon): self
    {
        $this->popisek_telefon = $popisek_telefon;
        return $this;
    }

    public function getNadpisEmail(): ?string
    {
        return $this->nadpis_email;
    }

    public function setNadpisEmail(string $nadpis_email): self
    {
        $this->nadpis_email = $nadpis_email;
        return $this;
    }

    public function getPopisekEmail(): ?string
    {
        return $this->popisek_email;
    }

    public function setPopisekEmail(string $popisek_email): self
    {
        $this->popisek_email = $popisek_email;
        return $this;
    }

    public function getNadpisHodiny(): ?string
    {
        return $this->nadpis_hodiny;
    }

    public function setNadpisHodiny(string $nadpis_hodiny): self
    {
        $this->nadpis_hodiny = $nadpis_hodiny;
        return $this;
    }

    public function getHodiny(): Collection
    {
        return $this->hodiny;
    }

    public function addHodiny(Hodiny $hodiny): self
    {
        if (!$this->hodiny->contains($hodiny)) {
            $this->hodiny[] = $hodiny;
            $hodiny->setKontakty($this);
        }

        return $this;
    }

    public function removeHodiny(Hodiny $hodiny): self
    {
        if ($this->hodiny->removeElement($hodiny)) {
            // Set the owning side to null (unless already changed)
            if ($hodiny->getKontakty() === $this) {
                $hodiny->setKontakty(null);
            }
        }

        return $this;
    }

    public function getNadpisMapa(): ?string
    {
        return $this->nadpis_mapa;
    }

    public function setNadpisMapa(string $nadpis_mapa): self
    {
        $this->nadpis_mapa = $nadpis_mapa;
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
