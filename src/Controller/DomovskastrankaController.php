<?php

// src/Controller/HomepageController.php

namespace App\Controller;

use App\Entity\Domovskastranka;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DomovskastrankaController extends AbstractController
{
    #[Route('/', name: 'domovskastranka')]
    public function index(EntityManagerInterface $em): Response
    {
        // Fetch the first homepage entry
        $domovskastranka = $em->getRepository(Domovskastranka::class)->find(1);

        return $this->render('homepage/index.html.twig', [
            'domovskastranka' => $domovskastranka,
        ]);
    }
}
