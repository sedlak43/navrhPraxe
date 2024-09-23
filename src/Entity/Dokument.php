<?php

namespace App\Entity;

use App\Repository\DokumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Dokument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $file = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isGpdr = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function isGpdr(): bool
    {
        return $this->isGpdr;
    }

    public function setGpdr(bool $isGpdr): self
    {
        $this->isGpdr = $isGpdr;
        return $this;
    }
}
