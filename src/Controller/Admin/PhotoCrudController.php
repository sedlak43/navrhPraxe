<?php

// src/Controller/Admin/PhotoCrudController.php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ImageField::new('image', 'Obrázek')
                ->setUploadDir('public/uploads/photos')
                ->setBasePath('uploads/photos')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            // Allow selecting existing tags and adding new ones
            AssociationField::new('tags', 'Tag')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'multiple' => true, // Allows multiple tags to be selected
                    'attr' => ['data-widget' => 'select2'], // Optional: Integrate with select2 for better UI (requires select2 JS)
                ])
                ->setRequired(false), // Make form simpler for tags
        ];
    }
}





