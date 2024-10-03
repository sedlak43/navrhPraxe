<?php

namespace App\Controller\Admin;

use App\Entity\Dokument;
use App\Entity\Domovskastranka;
use App\Entity\Photo;
use App\Entity\Tag;
use App\Entity\Zajezdy;
use App\Entity\Guide;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Redirect to the Zajezdy CRUD controller as the default page
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ZajezdyCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CK VŠPJ');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('CK VŠPJ Web', 'fas fa-globe', 'https://www.vspj.cz');

        yield MenuItem::linkToCrud('Domovská stránka', 'fas fa-home', Domovskastranka::class);
        yield MenuItem::linkToCrud('Zájezdy', 'fas fa-list', Zajezdy::class);
        yield MenuItem::linkToCrud('Průvodci', 'fas fa-users', Guide::class);
        yield MenuItem::linkToCrud('Dokumenty', 'fas fa-file', Dokument::class);
        yield MenuItem::linkToCrud('Fotografie', 'fas fa-images', Photo::class);
        yield MenuItem::linkToCrud('Tagy pro Alba', 'fas fa-tags', Tag::class);
    }
}
