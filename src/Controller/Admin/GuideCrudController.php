<?php

namespace App\Controller\Admin;

use App\Entity\Guide;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class GuideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guide::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Jméno'),
            TextField::new('employment', 'Zaměstnání'),
            TextField::new('language', 'Jazyk'),
            TextField::new('certificate', 'Certifikáty'),
            TextareaField::new('experience', 'Zkušenosti'),
            TextareaField::new('about', 'O mně'),
            ImageField::new('image', 'Obrázek')
                ->setUploadDir('public/uploads/pruvodci')
                ->setBasePath('uploads/pruvodci')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
