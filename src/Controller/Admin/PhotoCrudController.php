<?php

// src/Controller/Admin/PhotoCrudController.php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('popisek', 'Popisek')
                ->setRequired(false),
            ImageField::new('image', 'Image')
                ->setUploadDir('public/uploads/photos')  // Directory where files will be uploaded
                ->setBasePath('uploads/photos')          // Base path to access the images from the frontend
                ->setUploadedFileNamePattern('[randomhash].[extension]') // File name pattern (to avoid conflicts)
                ->setRequired(true) // Make image upload optional if necessary
        ];
    }
}




