<?php

namespace App\Controller\Admin;

use App\Entity\Kontakty;
use App\Form\HodinyType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class KontaktyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kontakty::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nadpis', 'Nadpis text'),
            TextEditorField::new('popisek', 'Popisek text'),

            TextField::new('nadpis_adresa', 'Nadpis adresy'),
            TextEditorField::new('popisek_adresa', 'Popisek adresy'),

            TextField::new('nadpis_telefon', 'Nadpis telefony'),
            TextEditorField::new('popisek_telefon', 'Popisek telefony'),

            TextField::new('nadpis_email', 'Nadpis e-maily'),
            TextEditorField::new('popisek_email', 'Popisek e-maily'),

            TextField::new('nadpis_hodiny', 'Nadpis otevírací hodiny'),
            CollectionField::new('hodiny')
                ->setEntryIsComplex(true)
                ->setLabel('Otevírací hodiny')
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'entry_type' => HodinyType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                ]),

            TextField::new('nadpis_mapa', 'Nadpis mapy'),
            ImageField::new('obrazek', 'Obrázek')
                ->setUploadDir('public/uploads')
                ->setBasePath('/uploads')
                ->setRequired(false),
        ];
    }
}
