<?php

// src/Controller/Admin/ZajezdyCrudController.php
namespace App\Controller\Admin;

use App\Entity\Zajezdy;
use App\Form\DatumType;
use App\Form\PricingItemType;
use App\Form\ProgramDneType;
use App\Form\TipyType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class ZajezdyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Zajezdy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('nazev', label: 'Název'),

            TextField::new('podnazev', 'Podnázev'),

            TextField::new('uvodniNadpis', 'Nadpis Úvodního Textu')->hideOnIndex(),

            TextareaField::new('uvodniPopisek', 'Popisek Úvodního Textu')->hideOnIndex(),

            ImageField::new('image', 'Hlavní obrázek')
                ->setUploadDir('public/uploads/zajezdy/')  // Where the image is uploaded
                ->setBasePath('uploads/zajezdy/')  // The base URL path for displaying the image
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),

            NumberField::new('cena')
                ->formatValue(function($value) {
                    return number_format($value, 0, ',', ' ') . ' Kč';
                }),

            NumberField::new('delka', 'Délka zájezdu (dny)'),

            ChoiceField::new('doprava')->setChoices([
                'Autobus, odjezd z Jihlavy' => 'Autobus, odjezd z Jihlavy',
                'Vlak' => 'Vlak',
                'Letadlo' => 'Letadlo',
                'Vlastní' => 'Vlastní',
            ]),

            ChoiceField::new('strava')->setChoices([
                'Plná penze' => 'Plná penze',
                'Polopenze' => 'Polopenze',
                'Snídaně' => 'Snídaně',
                'Vlastní strava, za příplatek' => 'Vlastní strava, za příplatek',
            ]),

            ChoiceField::new('typ')->setChoices([
                'Poznávací' => 'Poznávačka',
                'Pobyt' => 'Pobyt',
            ]),

            TextField::new('destinace'),

            CollectionField::new('datumy')
                ->setEntryType(DatumType::class)  // Use TextType to allow custom date input format
                ->setFormTypeOptions([
                    'attr' => ['placeholder' => 'DD.MM.YYYY'],  // Placeholder to guide input
                ])
                ->allowAdd()
                ->allowDelete(),

            ImageField::new('carouselImage1', 'Carousel Image 1')
                ->setUploadDir('public/uploads/zajezdy/')
                ->setBasePath('uploads/zajezdy/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('carouselImage2', 'Carousel Image 2')
                ->setUploadDir('public/uploads/zajezdy/')
                ->setBasePath('uploads/zajezdy/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('carouselImage3', 'Carousel Image 3')
                ->setUploadDir('public/uploads/zajezdy/')
                ->setBasePath('uploads/zajezdy/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),


            CollectionField::new('programDne')
                ->setEntryType(ProgramDneType::class)
                ->hideOnIndex()
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false, // Ensure proper handling of the collection
                ]),


            CollectionField::new('pricing_items')
                ->setEntryType(PricingItemType::class)
                ->hideOnIndex()
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),

            CollectionField::new('tipy')
                ->setEntryType(TipyType::class)
                ->hideOnIndex()
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),

            TextareaField::new('poznamky', 'Poznámky')->hideOnIndex(),
        ];
    }
}


