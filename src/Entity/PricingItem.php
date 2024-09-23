<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pricing_items')]
class PricingItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $item = null;

    #[ORM\Column(type: 'string', length: 10)]  // either 'include' or 'exclude'
    private ?string $type = null;

    #[ORM\ManyToOne(targetEntity: Zajezdy::class, cascade: ['persist', 'remove'], inversedBy: 'pricingItems')]
    private ?Zajezdy $zajezd = null;

    public function __toString(): string
    {
        return $this->item;  // Adjust to return the value you want to display
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?string
    {
        return $this->item;
    }

    public function setItem(string $item): self
    {
        $this->item = $item;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getZajezd(): ?Zajezdy
    {
        return $this->zajezd;
    }

    public function setZajezd(?Zajezdy $zajezd): self
    {
        $this->zajezd = $zajezd;
        return $this;
    }
}
