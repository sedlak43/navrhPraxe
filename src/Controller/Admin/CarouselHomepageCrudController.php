<?php

namespace App\Controller\Admin;

use App\Entity\CarouselHomepage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CarouselHomepageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarouselHomepage::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // Disabling the "Add" (new) button on the index page
            ->disable(Action::NEW);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('carouselHomepageImage1', 'Obrázek pro "Zájezdy"')
                ->setUploadDir('public/uploads/zajezdy/carousel/')
                ->setBasePath('uploads/zajezdy/carousel/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),

            ImageField::new('carouselHomepageImage2', 'Obrázek pro "O nás"')
            ->setUploadDir('public/uploads/zajezdy/carousel/')
                ->setBasePath('uploads/zajezdy/carousel/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),

            ImageField::new('carouselHomepageImage3', 'Obrázek pro "Fotogalerie"')
                ->setUploadDir('public/uploads/zajezdy/carousel/')
                ->setBasePath('uploads/zajezdy/carousel/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
