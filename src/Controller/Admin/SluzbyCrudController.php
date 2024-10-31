<?php

namespace App\Controller\Admin;

use App\Entity\Sluzby;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SluzbyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sluzby::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nazev', 'Název služby'),
            TextEditorField::new('popisek', 'Popis služby'),
        ];
    }
}
