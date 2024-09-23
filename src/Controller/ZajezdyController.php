<?php

namespace App\Controller;

use App\Entity\PricingItem;
use App\Entity\Zajezdy;
use App\Repository\ZajezdyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZajezdyController extends AbstractController
{
    #[Route('/zajezdy/{nazev}', name: 'zajezd_show')]
    public function show(ManagerRegistry $doctrine, string $nazev): Response
    {
        // Find the Zajezd by the 'nazev'
        $zajezd = $doctrine->getRepository(Zajezdy::class)->findOneBy([
            'nazev' => str_replace('-', ' ', ucwords($nazev))
        ]);

        if (!$zajezd) {
            throw $this->createNotFoundException('Zájezd nebyl nalezen');
        }

        // Fetch inclusions and exclusions for this Zajezd
        $zahrnujes = $doctrine->getRepository(PricingItem::class)->findBy([
            'zajezd' => $zajezd,
            'type' => 'Zahrnuje'
        ]);

        $nezahrnujes = $doctrine->getRepository(PricingItem::class)->findBy([
            'zajezd' => $zajezd,
            'type' => 'Nezahrnuje'
        ]);

        // Pass the Zajezd and other data to the template
        return $this->render('zajezdy/show.html.twig', [
            'zajezd' => $zajezd,
            'zahrnujes' => $zahrnujes,
            'nezahrnujes' => $nezahrnujes,
        ]);
    }

    private ZajezdyRepository $zajezdyRepository;

    public function __construct(ZajezdyRepository $zajezdyRepository)
    {
        $this->zajezdyRepository = $zajezdyRepository;
    }

    #[Route('/zajezdy', name: 'zajezdy_list')]
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

        // Fetch unique destinaces, dopravas and typs dynamically
        $destinaces = $this->zajezdyRepository->findDistinctDestinaces();
        $dopravas = $this->zajezdyRepository->findDistinctDopravas();
        $types = $this->zajezdyRepository->findDistinctTypes();

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

        return $this->render('zajezdy/index.html.twig', [
            'zajezdy' => $zajezdy,
            'selected_destinace' => $selected_destinace,
            'selected_doprava' => $selected_doprava,
            'selected_typ' => $selected_typ,
            'selected_date' => $selected_date,
            'destinaces' => $destinaces,
            'dopravas' => $dopravas,
            'types' => $types, // Pass the dynamically fetched types to the template
        ]);
    }
}
