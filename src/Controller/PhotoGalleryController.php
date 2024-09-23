<?php

// src/Controller/PhotoGalleryController.php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotoGalleryController extends AbstractController
{
    #[Route('/galerie', name: 'gallery')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Fetch all photos from the database
        $photos = $entityManager->getRepository(Photo::class)->findAll();

        return $this->render('photo_gallery/index.html.twig', [
            'photos' => $photos,
        ]);
    }

    #[Route('/galerie/upload', name: 'gallery_upload')]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['filePath']->getData();
            if ($uploadedFile) {
                $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Handle exception if something happens during file upload
                }

                // Set the file path in the entity and save it to the database
                $photo->setFilePath('uploads/photos/' . $newFilename);
                $entityManager->persist($photo);
                $entityManager->flush();

                return $this->redirectToRoute('gallery');
            }
        }

        return $this->render('photo_gallery/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


