<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OnasController extends AbstractController
{
    #[Route('/onas', name: 'app_onas')]
    public function index(): Response
    {
        return $this->render('onas/index.html.twig', [
            'controller_name' => 'OnasController',
        ]);
    }
}
