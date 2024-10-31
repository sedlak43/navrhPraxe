<?php

// src/Controller/Admin/ZajezdyCrudController.php
namespace App\Controller\Admin;

use App\Entity\ZajezdyStudent;
use App\Form\DatumStudentType;
use App\Form\PricingItemStudentType;
use App\Form\ProgramDneType;
use App\Form\TipyType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ZajezdyStudentCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return ZajezdyStudent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('nazev', label: 'Název'),

            TextareaField::new('podnazev', 'Podnázev'),

            TextField::new('uvodniNadpis', 'Nadpis Úvodního Textu')->hideOnIndex(),

            TextareaField::new('uvodniPopisek', 'Popisek Úvodního Textu')->hideOnIndex(),

            ImageField::new('image', 'Hlavní obrázek')
                ->setUploadDir('public/uploads/zajezdy/')  // Where the image is uploaded
                ->setBasePath('uploads/zajezdy/')  // The base URL path for displaying the image
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            NumberField::new('cena')
                ->formatValue(function($value) {
                    return number_format($value, 0, ',', ' ') . ' Kč';
                }),

            NumberField::new('delka', 'Délka zájezdu (dny)'),

            ChoiceField::new('doprava')
                ->setChoices([
                    'Autobus' => 'Autobus',
                    'Vlak' => 'Vlak',
                    'Loď' => 'Loď',
                    'Letecky' => 'Letecky',
                    'Vlastní' => 'Vlastní',
                ]),

            TextareaField::new('dopravaPopisek', 'Popis dopravy')->hideOnIndex(),

            ChoiceField::new('strava')->setChoices([
                'Plná penze' => 'Plná penze',
                'Polopenze' => 'Polopenze',
                'Oběd' => 'Oběd',
                'Snídaně' => 'Snídaně',
                'Bez stravy' => 'Bez stravy',
                'Dle programu' => 'Dle programu',
                'Vlastní strava, za příplatek' => 'Vlastní strava, za příplatek',
            ]),

            ChoiceField::new('typ')->setChoices([
                'Poznávací zájezd' => 'Poznávací zájezd',
                'Pobyt' => 'Pobyt',
            ]),

            TextField::new('destinace', label:'Destinace'),

            CollectionField::new('datumy_student')
                ->setEntryType(DatumStudentType::class)  // Use TextType to allow custom date input format
                ->setFormTypeOptions([
                    'attr' => ['placeholder' => 'DD.MM.YYYY'],  // Placeholder to guide input
                ])
                ->allowAdd()
                ->allowDelete(),

            ImageField::new('carouselImage1', 'Carousel obrázek 1')
                ->setUploadDir('public/uploads/zajezdy/carousel/')
                ->setBasePath('uploads/zajezdy/carousel/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('carouselImage2', 'Carousel obrázek 2')
                ->setUploadDir('public/uploads/zajezdy/carousel/')
                ->setBasePath('uploads/zajezdy/carousel/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('carouselImage3', 'Carousel obrázek 3')
                ->setUploadDir('public/uploads/zajezdy/carousel/')
                ->setBasePath('uploads/zajezdy/carousel/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            CollectionField::new('programDne')
                ->setEntryType(ProgramDneType::class)
                ->hideOnIndex()
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'empty_data' => null,
                ]),

            CollectionField::new('pricingItems_student')
                ->setEntryType(PricingItemStudentType::class)
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

            NumberField::new('zajezd_order', 'Pozice'),

            FormField::addPanel('Galerie přímo v zájezdu'),

            ImageField::new('zajezdyImage1', 'Zajzedy obrázeke 1')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage2', 'Zajzedy obrázek 2')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage3', 'Zajzedy obrázek 3')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage4', 'Zajzedy obrázek 4')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage5', 'Zajzedy obrázek 5')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage6', 'Zajzedy obrázek 6')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage7', 'Zajzedy obrázek 7')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage8', 'Zajzedy obrázek 8')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage9', 'Zajzedy obrázek 9')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

            ImageField::new('zajezdyImage10', 'Zajzedy obrázek 10')
                ->setUploadDir('public/uploads/zajezdy/foto')
                ->setBasePath('uploads/zajezdy/foto')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),

        ];
    }
}


