<?php

namespace App\Controller;

use App\Repository\OnasPopisekRepository;
use App\Repository\ClenoveTymuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OnasController extends AbstractController
{
    private OnasPopisekRepository $onasPopisekRepository;
    private ClenoveTymuRepository $clenoveTymuRepository;

    public function __construct(
        OnasPopisekRepository $onasPopisekRepository,
        ClenoveTymuRepository $clenoveTymuRepository,
    ) {
        $this->onasPopisekRepository = $onasPopisekRepository;
        $this->clenoveTymuRepository = $clenoveTymuRepository;
    }

    // First route for /onas
    #[Route('/onas', name: 'app_onas')]
    #[Route('/cs/onas', name: 'app_onas_cs')]
    #[Route('/o-nas', name: 'app_o-nas')]
    #[Route('/cs/o-nas', name: 'app_o-nas_cs')]
    public function index(): Response
    {
        $onasPopisek = $this->onasPopisekRepository->findAll();
        $clenoveTymu = $this->clenoveTymuRepository->findAll();

        return $this->render('onas/index.html.twig', [
            'controller_name' => 'OnasController',
            'onasPopisek' => $onasPopisek,
            'clenoveTymu' => $clenoveTymu,
        ]);
    }
}
