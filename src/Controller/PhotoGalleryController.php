<?php

// src/Controller/PhotoGalleryController.php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotoGalleryController extends AbstractController
{
    #[Route('/galerie', name: 'gallery')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response // Add Request type hint
    {
        // Fetch all tags for the filter
        $tags = $entityManager->getRepository(Tag::class)->findAll();
        $selectedTagId = $request->query->get('tag');

        if ($selectedTagId) {
            // Fetch photos filtered by the selected tag
            $photos = $entityManager->getRepository(Photo::class)->createQueryBuilder('p')
                ->join('p.tags', 't')
                ->where('t.id = :tagId')
                ->setParameter('tagId', $selectedTagId)
                ->getQuery()
                ->getResult();
        } else {
            // Fetch all photos if no tag is selected
            $photos = $entityManager->getRepository(Photo::class)->findAll();
        }

        return $this->render('photo_gallery/index.html.twig', [
            'photos' => $photos,
            'tags' => $tags,
            'selectedTag' => $selectedTagId
        ]);
    }
}
