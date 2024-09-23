<?php

namespace App\Controller;

use App\Repository\GuideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuideController extends AbstractController
{
    #[Route('/guides', name: 'guide_list')]
    public function index(GuideRepository $guideRepository): Response
    {
        // Fetch all guides from the repository
        $guides = $guideRepository->findAll();

        // Pass guides to the Twig template
        return $this->render('guides/index.html.twig', [
            'guides' => $guides,
        ]);
    }
}