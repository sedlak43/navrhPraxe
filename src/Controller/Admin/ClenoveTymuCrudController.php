<?php

namespace App\Controller\Admin;

use App\Entity\ClenoveTymu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClenoveTymuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClenoveTymu::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('jmeno', 'Jméno'),
            TextField::new('role', 'Role'),
            ChoiceField::new('umisteni', 'Pozice')
                ->setChoices([
                    'Stálý tým' => 'Stálý tým',
                    'Praktikanti' => 'Praktikanti',
                ]),
            ImageField::new('obrazek', 'Obrázek')
                ->setUploadDir('public/uploads/praktikanti')
                ->setBasePath('uploads/praktikanti')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
