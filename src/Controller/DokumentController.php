<?php

// src/Controller/DocumentController.php

namespace App\Controller;

use App\Repository\DokumentRepository;
use App\Repository\DokumentyTextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DokumentController extends AbstractController
{
    private DokumentyTextRepository $dokumentyTextRepository;

    public function __construct(
        DokumentyTextRepository $dokumentyTextRepository,
    ) {
        $this->dokumentyTextRepository = $dokumentyTextRepository;
    }

    #[Route('/dokumenty', name: 'dokumenty_index')]
    #[Route('/cs/dokumenty', name: 'dokumenty_index_cs')]
    public function index(DokumentRepository $dokumentRepository): Response
    {
        $dokuments = $dokumentRepository->findAll();
        $dokumenty_text = $this->dokumentyTextRepository->findAll();

        return $this->render('dokumenty/index.html.twig', [
            'dokuments' => $dokuments,
            'dokumenty_text' => $dokumenty_text,
        ]);
    }
}

