<?php

namespace App\Controller\Admin;

use App\Entity\Aktuality;
use App\Entity\CarouselHomepage;
use App\Entity\Dokument;
use App\Entity\DokumentyText;
use App\Entity\VystaveneZajezdy;
use App\Entity\Kontakty;
use App\Entity\OnasPopisek;
use App\Entity\Photo;
use App\Entity\ClenoveTymu;
use App\Entity\PruvodciUvodniText;
use App\Entity\Sluzby;
use App\Entity\Tag;
use App\Entity\Zajezdy;
use App\Entity\Guide;
use App\Entity\ZajezdyStudent;
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
        yield MenuItem::linkToUrl('CK VŠPJ Web', 'fas fa-globe', 'https://cestovka.vspj.cz/');

        yield MenuItem::subMenu('Domovská stránka', 'fas fa-home')->setSubItems([
            MenuItem::linkToCrud('Vystavené zájezdy', 'fas fa-list', VystaveneZajezdy::class),
            MenuItem::linkToCrud('Aktuality', 'fas fa-newspaper', Aktuality::class),
            MenuItem::linkToCrud('Nahrát obrázky carouselu', 'fas fa-images', CarouselHomepage::class),
        ]);
        yield MenuItem::linkToCrud('Zájezdy', 'fas fa-list', Zajezdy::class);
        yield MenuItem::subMenu('Fotogalerie', 'fas fa-images')->setSubItems([
            MenuItem::linkToCrud('Nahrávání fotografií', 'fas fa-images', Photo::class),
            MenuItem::linkToCrud('Tagy pro alba', 'fas fa-tags', Tag::class),
        ]);
        yield MenuItem::subMenu('O nás', 'fas fa-info-circle')->setSubItems([
            MenuItem::linkToCrud('O nás', 'fas fa-info-circle', OnasPopisek::class),
            MenuItem::linkToCrud('Členové týmu', 'fas fa-users', ClenoveTymu::class),
        ]);
        yield MenuItem::subMenu('Průvodci', 'fas fa-users')->setSubItems([
            MenuItem::linkToCrud('Úvodní text', 'fas fa-pen', PruvodciUvodniText::class),
            MenuItem::linkToCrud('Průvodci', 'fas fa-users', Guide::class),
        ]);
        yield MenuItem::linkToCrud('Kontakty', 'fas fa-address-book', Kontakty::class);
        yield MenuItem::linkToCrud('Služby', 'fas fa-briefcase', Sluzby::class);
        yield MenuItem::subMenu('Dokumenty', 'fas fa-file')->setSubItems([
            MenuItem::linkToCrud('Dokumenty', 'fas fa-file', Dokument::class),
            MenuItem::linkToCrud('Dokumenty text', 'fas fa-pen', DokumentyText::class),
        ]);
    }
}
