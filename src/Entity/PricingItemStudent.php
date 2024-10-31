<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pricing_items_student')]
class PricingItemStudent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $item = null;

    #[ORM\Column(type: 'string', length: 10)]  // either 'include' or 'exclude'
    private ?string $type = null;

    #[ORM\ManyToOne(targetEntity: ZajezdyStudent::class, inversedBy: 'pricingItems_student')]
    #[ORM\JoinColumn(name: 'zajezd_student_id', referencedColumnName: 'id', nullable: false)]
    private ?ZajezdyStudent $zajezd_student = null;


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

    public function getZajezdStudent(): ?ZajezdyStudent
    {
        return $this->zajezd_student;
    }

    public function setZajezdStudent(?ZajezdyStudent $zajezd_student): self
    {
        $this->zajezd_student = $zajezd_student;
        return $this;
    }
}
