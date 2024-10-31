<?php

// src/Entity/Zajezdy.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Zajezdy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 80)]
    private ?string $nazev = null;

    #[ORM\Column(type: 'string', length: 80, nullable: true)]
    private ?string $podnazev = null;

    #[ORM\Column(type: 'integer')]
    private ?int $cena = null;

    #[ORM\Column(type: 'string', length: 40)]
    private ?string $doprava = null;

    #[ORM\Column(type: 'string', length: 40)]
    private ?string $strava = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $destinace = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $typ = null;

    #[ORM\OneToMany(targetEntity: Datumy::class, mappedBy: 'zajezd', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $datumy;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $delka = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $zajezd_order = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(targetEntity: PricingItem::class, mappedBy: 'zajezd', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $pricingItems;

    #[ORM\OneToMany(targetEntity: ProgramDne::class, mappedBy: 'zajezd', cascade: ['persist', 'remove'])]
    private Collection $programDne;

    #[ORM\OneToMany(targetEntity: Tipy::class, mappedBy: 'zajezd', cascade: ['persist', 'remove'])]
    private Collection $tipy;

    #[ORM\Column(name: 'uvodniNadpis', type: 'string', length: 255, nullable: true)]
    private ?string $uvodniNadpis = null;

    #[ORM\Column(name: 'uvodniPopisek', type: 'text', nullable: true)]
    private ?string $uvodniPopisek = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $poznamky = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $dopravaPopisek = null;

    public function __toString(): string
    {
        return (string) $this->nazev; // Use 'nazev' for the string representation
    }

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $carousel_image1 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $carousel_image2 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $carousel_image3 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image1 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image2 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image3 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image4 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image5 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image6 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image7 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image8 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image9 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $zajezdy_image10 = null;


    public function getDopravaPopisek(): ?string
    {
        return $this->dopravaPopisek;
    }

    public function setDopravaPopisek(?string $dopravaPopisek): self
    {
        $this->dopravaPopisek = $dopravaPopisek;

        return $this;
    }


    public function getCarouselImage1(): ?string
    {
        return $this->carousel_image1;
    }

    public function setCarouselImage1(?string $carouselImage1): self
    {
        $this->carousel_image1 = $carouselImage1;
        return $this;
    }

    public function getCarouselImage2(): ?string
    {
        return $this->carousel_image2;
    }

    public function setCarouselImage2(?string $carouselImage2): self
    {
        $this->carousel_image2 = $carouselImage2;
        return $this;
    }

    public function getCarouselImage3(): ?string
    {
        return $this->carousel_image3;
    }

    public function setCarouselImage3(?string $carouselImage3): self
    {
        $this->carousel_image3 = $carouselImage3;
        return $this;
    }

    public function getZajezdyImage1(): ?string
    {
        return $this->zajezdy_image1;
    }

    public function setZajezdyImage1(?string $zajezdyImage1): self
    {
        $this->zajezdy_image1 = $zajezdyImage1;
        return $this;
    }

    public function getZajezdyImage2(): ?string
    {
        return $this->zajezdy_image2;
    }

    public function setZajezdyImage2(?string $zajezdyImage2): self
    {
        $this->zajezdy_image2 = $zajezdyImage2;
        return $this;
    }

    public function getZajezdyImage3(): ?string
    {
        return $this->zajezdy_image3;
    }

    public function setZajezdyImage3(?string $zajezdyImage3): self
    {
        $this->zajezdy_image3 = $zajezdyImage3;
        return $this;
    }

    public function getZajezdyImage4(): ?string
    {
        return $this->zajezdy_image4;
    }

    public function setZajezdyImage4(?string $zajezdyImage4): self
    {
        $this->zajezdy_image4 = $zajezdyImage4;
        return $this;
    }

    public function getZajezdyImage5(): ?string
    {
        return $this->zajezdy_image5;
    }

    public function setZajezdyImage5(?string $zajezdyImage5): self
    {
        $this->zajezdy_image5 = $zajezdyImage5;
        return $this;
    }

    public function getZajezdyImage6(): ?string
    {
        return $this->zajezdy_image6;
    }

    public function setZajezdyImage6(?string $zajezdyImage6): self
    {
        $this->zajezdy_image6 = $zajezdyImage6;
        return $this;
    }

    public function getZajezdyImage7(): ?string
    {
        return $this->zajezdy_image7;
    }

    public function setZajezdyImage7(?string $zajezdyImage7): self
    {
        $this->zajezdy_image7 = $zajezdyImage7;
        return $this;
    }

    public function getZajezdyImage8(): ?string
    {
        return $this->zajezdy_image8;
    }

    public function setZajezdyImage8(?string $zajezdyImage8): self
    {
        $this->zajezdy_image8 = $zajezdyImage8;
        return $this;
    }

    public function getZajezdyImage9(): ?string
    {
        return $this->zajezdy_image9;
    }

    public function setZajezdyImage9(?string $zajezdyImage9): self
    {
        $this->zajezdy_image9 = $zajezdyImage9;
        return $this;
    }

    public function getZajezdyImage10(): ?string
    {
        return $this->zajezdy_image10;
    }

    public function setZajezdyImage10(?string $zajezdyImage10): self
    {
        $this->zajezdy_image10 = $zajezdyImage10;
        return $this;
    }

    public function __construct()
    {
        $this->datumy = new ArrayCollection();
        $this->pricingItems = new ArrayCollection();
        $this->programDne = new ArrayCollection();
        $this->tipy = new ArrayCollection();
    }

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZajezdOrder(): ?int
    {
        return $this->zajezd_order;
    }

    public function setZajezdOrder(int $zajezd_order): self
    {
        $this->zajezd_order = $zajezd_order;
        return $this;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): static
    {
        $this->nazev = $nazev;
        return $this;
    }

    public function getPodnazev(): ?string
    {
        return $this->podnazev;
    }

    public function setPodnazev(?string $podnazev): static
    {
        $this->podnazev = $podnazev;
        return $this;
    }


    public function getCena(): ?int
    {
        return $this->cena;
    }

    public function setCena(int $cena): static
    {
        $this->cena = $cena;
        return $this;
    }

    public function getDoprava(): ?string
    {
        return $this->doprava;
    }

    public function setDoprava(string $doprava): static
    {
        $this->doprava = $doprava;
        return $this;
    }

    public function getStrava(): ?string
    {
        return $this->strava;
    }

    public function setStrava(string $strava): static
    {
        $this->strava = $strava;
        return $this;
    }

    public function getDestinace(): ?string
    {
        return $this->destinace;
    }

    public function setDestinace(?string $destinace): static
    {
        $this->destinace = $destinace;
        return $this;
    }

    public function getTyp(): ?string
    {
        return $this->typ;
    }

    public function setTyp(?string $typ): static
    {
        $this->typ = $typ;
        return $this;
    }

    public function getDatumy(): Collection
    {
        return $this->datumy;
    }

    public function getDelka(): ?int
    {
        return $this->delka;
    }

    public function setDelka(?int $delka): self
    {
        $this->delka = $delka;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image ?? 'anonym.jpg';
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getFormattedCena(): string
    {
        // Format the price with a space every 3 digits
        $formattedCena = number_format($this->cena, 0, ',', ' ');

        return $formattedCena;
    }

    public function setDatumy(Collection $datumy): static
    {
        // First, remove dates that are not in the new collection
        foreach ($this->datumy as $existingDatum) {
            if (!$datumy->contains($existingDatum)) {
                $this->removeDatum($existingDatum);
            }
        }

        // Then, add new dates that are not already in the current collection
        foreach ($datumy as $datum) {
            if (!$this->datumy->contains($datum)) {
                if (is_string($datum)) {
                    // Assuming $datum is a date string, convert it to a Datumy object
                    $datumyObject = new Datumy();
                    $datumyObject->setDatum(new \DateTime($datum)); // Convert string to DateTime
                    $this->addDatum($datumyObject);
                } elseif ($datum instanceof Datumy) {
                    // If it's already a Datumy object, add it directly
                    $this->addDatum($datum);
                }
            }
        }

        return $this;
    }

    public function addDatum(Datumy $datum): static
    {
        if (!$this->datumy->contains($datum)) {
            $this->datumy[] = $datum;
            $datum->setZajezd($this);
        }

        return $this;
    }

    public function removeDatum(Datumy $datum): static
    {
        if ($this->datumy->removeElement($datum)) {
            if ($datum->getZajezd() === $this) {
                $datum->setZajezd(null);
            }
        }

        return $this;
    }

    public function getPricingItems(): Collection
    {
        return $this->pricingItems;
    }

    public function addPricingItem(PricingItem $pricingItem): self
    {
        if (!$this->pricingItems->contains($pricingItem)) {
            $this->pricingItems[] = $pricingItem;
            $pricingItem->setZajezd($this);
        }

        return $this;
    }

    public function removePricingItem(PricingItem $pricingItem): self
    {
        if ($this->pricingItems->removeElement($pricingItem)) {
            if ($pricingItem->getZajezd() === $this) {
                $pricingItem->setZajezd(null);
            }
        }

        return $this;
    }

    public function getProgramDne(): Collection
{
    return $this->programDne;
}

    public function addProgramDne(ProgramDne $programDne): self
    {
        if (!$this->programDne->contains($programDne)) {
            $this->programDne[] = $programDne;
            $programDne->setZajezd($this);
        }

        return $this;
    }

    public function removeProgramDne(ProgramDne $programDne): self
    {
        if ($this->programDne->removeElement($programDne)) {
            if ($programDne->getZajezd() === $this) {
                $programDne->setZajezd(null);
            }
        }

        return $this;
    }

    public function getTipy(): ArrayCollection|Collection
    {
        return $this->tipy;
    }

    public function addTipy(Tipy $tipy): self
    {
        if (!$this->tipy->contains($tipy)) {
            $this->tipy[] = $tipy;
            $tipy->setZajezd($this);
        }

        return $this;
    }

    public function removeTipy(Tipy $tipy): self
    {
        if ($this->tipy->removeElement($tipy)) {
            // set the owning side to null (unless already changed)
            if ($tipy->getZajezd() === $this) {
                $tipy->setZajezd(null);
            }
        }

        return $this;
    }

    // src/Entity/Zajezdy.php

    public function getUvodniNadpis(): ?string
    {
        return $this->uvodniNadpis;
    }

    public function setUvodniNadpis(?string $uvodniNadpis): self
    {
        $this->uvodniNadpis = $uvodniNadpis;

        return $this;
    }

    public function getUvodniPopisek(): ?string
    {
        return $this->uvodniPopisek;
    }

    public function setUvodniPopisek(?string $uvodniPopisek): self
    {
        $this->uvodniPopisek = $uvodniPopisek;

        return $this;
    }

    public function getPoznamky(): ?string
    {
        return $this->poznamky;
    }

    public function setPoznamky(?string $poznamky): self
    {
        $this->poznamky = $poznamky;

        return $this;
    }

}
