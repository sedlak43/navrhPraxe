<?php

// src/Controller/DocumentController.php

namespace App\Controller;

use App\Repository\DokumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DokumentController extends AbstractController
{
    #[Route('/dokumenty', name: 'dokumenty_index')]
    public function index(DokumentRepository $dokumentRepository): Response
    {
        $dokuments = $dokumentRepository->findAll();

        return $this->render('dokumenty/index.html.twig', [
            'dokuments' => $dokuments,
        ]);
    }
}

