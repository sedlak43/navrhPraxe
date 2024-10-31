<?php

// src/Controller/Admin/ZajezdyCrudController.php
namespace App\Controller\Admin;

use App\Entity\Zajezdy;
use App\Form\DatumType;
use App\Form\PricingItemType;
use App\Form\ProgramDneType;
use App\Form\TipyType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class ZajezdyCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Zajezdy::class;
    }

    #[Route("/admin/zajezdy/{id}/move-up", name: "zajezdy_move_up")]
    public function moveUp($id): RedirectResponse
    {
        $zajezd = $this->entityManager->getRepository(Zajezdy::class)->find($id);

        if (!$zajezd) {
            throw $this->createNotFoundException('No zajezd found for id ' . $id);
        }

        if ($zajezd) {
            $higherZajezd = $this->entityManager->getRepository(Zajezdy::class)
                ->createQueryBuilder('z')
                ->where('z.zajezd_order < :currentOrder')
                ->setParameter('currentOrder', $zajezd->getZajezdOrder())
                ->orderBy('z.zajezd_order', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            if ($higherZajezd) {
                // Swap orders
                $tempOrder = $zajezd->getZajezdOrder();
                $zajezd->setZajezdOrder($higherZajezd->getZajezdOrder());
                $higherZajezd->setZajezdOrder($tempOrder);

                $this->entityManager->flush();
            }
        }

        return new RedirectResponse($this->generateUrl('admin', [
            'crudAction' => 'index',
            'crudControllerFqcn' => ZajezdyCrudController::class,
        ]));
    }

    #[Route("/admin/zajezdy/{id}/move-down", name: "zajezdy_move_down")]
    public function moveDown($id): RedirectResponse
    {
        $zajezd = $this->entityManager->getRepository(Zajezdy::class)->find($id);

        if (!$zajezd) {
            throw $this->createNotFoundException('No zajezd found for id ' . $id);
        }

        if ($zajezd) {
            $lowerZajezd = $this->entityManager->getRepository(Zajezdy::class)
                ->createQueryBuilder('z')
                ->where('z.zajezd_order > :currentOrder')
                ->setParameter('currentOrder', $zajezd->getZajezdOrder())
                ->orderBy('z.zajezd_order', 'ASC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            if ($lowerZajezd) {
                // Swap orders
                $tempOrder = $zajezd->getZajezdOrder();
                $zajezd->setZajezdOrder($lowerZajezd->getZajezdOrder());
                $lowerZajezd->setZajezdOrder($tempOrder);

                $this->entityManager->flush();
            }
        }

        return new RedirectResponse($this->generateUrl('admin', [
            'crudAction' => 'index',
            'crudControllerFqcn' => ZajezdyCrudController::class,
        ]));
    }

    public function configureActions(Actions $actions): Actions
    {
        $moveUp = Action::new('moveUp', '⬆️')
            ->linkToRoute('zajezdy_move_up', function (Zajezdy $zajezd): array {
                return ['id' => $zajezd->getId()];
            });

        $moveDown = Action::new('moveDown', '⬇️')
            ->linkToRoute('zajezdy_move_down', function (Zajezdy $zajezd): array {
                return ['id' => $zajezd->getId()];
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $moveUp)
            ->add(Crud::PAGE_INDEX, $moveDown);
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



            CollectionField::new('datumy')
                ->setEntryType(DatumType::class)  // Use TextType to allow custom date input format
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


