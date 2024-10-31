<?php

namespace App\Controller\Admin;

use App\Entity\DokumentyText;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DokumentyTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DokumentyText::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nazev', 'První název (Šedé pole)'),
            TextField::new('nazev_dokumenty', 'Druhý název (Bílé pole)'),
            TextEditorField::new('popisek', 'Text pod dokumenty'),
        ];
    }
}
