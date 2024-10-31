<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Repository\GuideRepository;
use App\Repository\PruvodciUvodniTextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AllowDynamicProperties] class GuideController extends AbstractController
{
    private PruvodciUvodniTextRepository $pruvodciUvodniTextRepository;

    public function __construct(
        PruvodciUvodniTextRepository $pruvodciUvodniTextRepository,
    ) {
        $this->pruvodciUvodniTextRepository = $pruvodciUvodniTextRepository;
    }

    #[Route('/guides', name: 'guide_list')]
    #[Route('/cs/guides', name: 'guide_list_cs')]
    public function index(GuideRepository $guideRepository): Response
    {
        // Fetch all guides from the repository
        $guides = $guideRepository->findAll();
        $pruvodciUvodniText = $this->pruvodciUvodniTextRepository->findAll();

        // Pass guides to the Twig template
        return $this->render('guides/index.html.twig', [
            'guides' => $guides,
            'pruvodciUvodniText' => $pruvodciUvodniText,
        ]);
    }
}