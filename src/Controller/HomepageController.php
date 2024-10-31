<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ZajezdyRepository;
use App\Repository\VystaveneZajezdyRepository;
use App\Repository\AktualityRepository;
use App\Repository\CarouselHomepageRepository; // Import CarouselHomepage repository

class HomepageController extends AbstractController
{
    private ZajezdyRepository $zajezdyRepository;
    private VystaveneZajezdyRepository $vystaveneZajezdyRepository;
    private AktualityRepository $aktualityRepository;
    private CarouselHomepageRepository $carouselHomepageRepository;

    public function __construct(
        ZajezdyRepository          $zajezdyRepository,
        VystaveneZajezdyRepository $vystaveneZajezdyRepository,
        AktualityRepository        $aktualityRepository,
        CarouselHomepageRepository $carouselHomepageRepository
    ) {
        $this->zajezdyRepository = $zajezdyRepository;
        $this->vystaveneZajezdyRepository = $vystaveneZajezdyRepository;
        $this->aktualityRepository = $aktualityRepository;
        $this->carouselHomepageRepository = $carouselHomepageRepository;
    }

    #[Route('/homepage', name: 'app_homepage')]
    #[Route('/cs/homepage', name: 'app_homepage_cs')]
    public function index(Request $request): Response
    {
        $destinace = $request->query->get('destinace');
        $doprava = $request->query->get('doprava');
        $typ = $request->query->get('typ');
        $date = $request->query->get('date');

        $selected_destinace = $destinace;
        $selected_doprava = $doprava;
        $selected_typ = $typ;
        $selected_date = $date;

        // Fetch unique destinations, transport, and trip types
        $destinaces = $this->zajezdyRepository->findDistinctDestinaces();
        $dopravas = $this->zajezdyRepository->findDistinctDopravas();
        $types = ['Pobyt', 'Poznávačka'];

        $criteria = [];
        if ($destinace) {
            $criteria['destinace'] = $destinace;
        }
        if ($doprava) {
            $criteria['doprava'] = $doprava;
        }
        if ($typ) {
            $criteria['typ'] = $typ;
        }

        $zajezdy = $this->zajezdyRepository->findByCriteriaAndDate($criteria, $date);

        // Fetch all records of VystaveneZajezdy
        $vystaveneZajezdy = $this->vystaveneZajezdyRepository->findBy([], null, 3); // Limit to 3 records

        // Fetch all Aktuality records
        $aktuality = $this->aktualityRepository->findAll();

        // Remove HTML tags from each aktualita's popis
        foreach ($aktuality as $aktualita) {
            $aktualita->setPopisek(strip_tags($aktualita->getPopisek())); // Remove HTML tags
        }

        // Fetch carousel images
        $carouselHomepage = $this->carouselHomepageRepository->findOneBy([]);

        return $this->render('homepage/index.html.twig', [
            'zajezdy' => $zajezdy,
            'selected_destinace' => $selected_destinace,
            'selected_doprava' => $selected_doprava,
            'selected_typ' => $selected_typ,
            'selected_date' => $selected_date,
            'destinaces' => $destinaces,
            'dopravas' => $dopravas,
            'types' => $types,
            'vystaveneZajezdy' => $vystaveneZajezdy,
            'aktuality' => $aktuality,
            'carouselHomepage' => $carouselHomepage,
        ]);
    }
}
