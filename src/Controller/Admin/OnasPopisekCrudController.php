<?php

namespace App\Controller\Admin;

use App\Entity\OnasPopisek;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OnasPopisekCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OnasPopisek::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nazev', 'Název'),
            TextEditorField::new('popisek', 'Popisek'),
            ImageField::new('obrazek', 'Obrázek')
                ->setUploadDir('public/uploads')
                ->setBasePath('/uploads')
                ->setRequired(false),
        ];
    }
}
