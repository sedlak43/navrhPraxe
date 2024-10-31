<?php

namespace App\Controller\Admin;

use App\Entity\Dokument;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DokumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dokument::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Název'),
            FormField::addPanel('Upload PDF'),
            TextField::new('file', 'Nahrajte PDF')
                ->setFormType(FileType::class)
                ->setFormTypeOptions([
                    'required' => false,
                    'mapped' => false, // Ensure the file field is not mapped to the entity directly
                    'attr' => ['accept' => 'application/pdf'],
                ])
                ->setHelp('Please upload a PDF document.'),
            BooleanField::new('isGpdr', 'GDPR Document'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $this->getContext()->getRequest()->files->get('Dokument')['file'];

        if ($uploadedFile) {
            // Generate a unique filename and move the file to the upload directory
            $fileName = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move(
                $this->getParameter('kernel.project_dir') . '/public/uploads/dokuments',
                $fileName
            );

            // Set the filename in the entity
            $entityInstance->setFile($fileName);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
