<?php

namespace App\Entity;

use App\Repository\CarouselHomepageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarouselHomepageRepository::class)]
#[ORM\Table(name: 'carousel_homepage_images')]
class CarouselHomepage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $carousel_homepage_image1 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $carousel_homepage_image2 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $carousel_homepage_image3 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarouselHomepageImage1(): ?string
    {
        return $this->carousel_homepage_image1;
    }

    public function setCarouselHomepageImage1(?string $carouselHomepageImage1): self
    {
        $this->carousel_homepage_image1 = $carouselHomepageImage1;
        return $this;
    }

    public function getCarouselHomepageImage2(): ?string
    {
        return $this->carousel_homepage_image2;
    }

    public function setCarouselHomepageImage2(?string $carouselHomepageImage2): self
    {
        $this->carousel_homepage_image2 = $carouselHomepageImage2;
        return $this;
    }

    public function getCarouselHomepageImage3(): ?string
    {
        return $this->carousel_homepage_image3;
    }

    public function setCarouselHomepageImage3(?string $carouselHomepageImage3): self
    {
        $this->carousel_homepage_image3 = $carouselHomepageImage3;
        return $this;
    }
}
