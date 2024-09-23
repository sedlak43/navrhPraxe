<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class KontaktyController extends AbstractController
{
    #[Route('/kontakty', name: 'app_kontakty')]
    public function index(): Response
    {
        return $this->render('kontakty/index.html.twig', [
            'controller_name' => 'KontaktyController',
        ]);
    }
}
