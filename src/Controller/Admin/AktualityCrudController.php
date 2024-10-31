<?php

namespace App\Controller\Admin;

use App\Entity\Aktuality;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class AktualityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Aktuality::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nazev', 'Název'),
            TextEditorField::new('popisek', 'Popisek'),
            ImageField::new('obrazek', 'Obrázek')
                ->setUploadDir('public/uploads/aktuality')
                ->setBasePath('/uploads/aktuality')
                ->setRequired(false),
        ];
    }
}
