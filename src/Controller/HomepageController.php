<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ZajezdyRepository;
use App\Repository\DomovskastrankaRepository; // Fix the repository class name

class HomepageController extends AbstractController
{
    private ZajezdyRepository $zajezdyRepository;
    private DomovskastrankaRepository $domovskastrankaRepository; // Use the correct repository name

    public function __construct(ZajezdyRepository $zajezdyRepository, DomovskastrankaRepository $domovskastrankaRepository)
    {
        $this->zajezdyRepository = $zajezdyRepository;
        $this->domovskastrankaRepository = $domovskastrankaRepository; // Corrected here as well
    }

    #[Route('/homepage', name: 'app_homepage')]
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

        // Fetch all records of Domovskastranka
        $domovskastrankas = $this->domovskastrankaRepository->findBy([], null, 3); // Limit to 3 records

        return $this->render('homepage/index.html.twig', [
            'zajezdy' => $zajezdy,
            'selected_destinace' => $selected_destinace,
            'selected_doprava' => $selected_doprava,
            'selected_typ' => $selected_typ,
            'selected_date' => $selected_date,
            'destinaces' => $destinaces,
            'dopravas' => $dopravas,
            'types' => $types,
            'domovskastrankas' => $domovskastrankas, // Pass the list of all Domovskastranka records
        ]);
    }
}
