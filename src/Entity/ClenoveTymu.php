<?php

namespace App\Entity;

use App\Repository\ClenoveTymuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClenoveTymuRepository::class)]
#[ORM\Table(name: 'clenoveTymu')]
class ClenoveTymu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $jmeno = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $role = null;

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    private ?string $umisteni = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $obrazek = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getUmisteni(): ?string
    {
        return $this->umisteni;
    }

    public function setUmisteni(?string $umisteni): self
    {
        $this->umisteni = $umisteni;
        return $this;
    }

    public function getObrazek(): ?string
    {
        return $this->obrazek ?? 'anonym.jpg';
    }

    public function setObrazek(?string $obrazek): self
    {
        $this->obrazek = $obrazek;
        return $this;
    }
}
