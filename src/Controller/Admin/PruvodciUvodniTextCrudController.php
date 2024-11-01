<?php

namespace App\Controller\Admin;

use App\Entity\PruvodciUvodniText;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PruvodciUvodniTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PruvodciUvodniText::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nazev', 'Název'),
            TextEditorField::new('popisek', 'Popisek'),
        ];
    }
}
