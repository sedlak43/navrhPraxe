<?php

namespace App\Controller;

use App\Entity\PricingItemStudent;
use App\Entity\ZajezdyStudent; // Assuming you have renamed the entity
use App\Repository\ZajezdyStudentRepository; // Update the repository name accordingly
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ZajezdyStudentController extends AbstractController // Renamed controller
{
    #[Route('/zajezdy-student/{nazev}', name: 'zajezd_student_show')]
    #[Route('/cs/zajezdy-student/{nazev}', name: 'zajezd_show_cs')]
    public function show(ManagerRegistry $doctrine, string $nazev): Response
    {
        // Convert hyphens back to spaces for the 'nazev' field
        $formattedNazev = str_replace('-', ' ', $nazev);

        // Find the Zajezd by the 'nazev'
        $zajezd_student = $doctrine->getRepository(ZajezdyStudent::class)->findOneBy([
            'nazev' => $formattedNazev
        ]);

        if (!$zajezd_student) {
            throw $this->createNotFoundException('Zájezd nebyl nalezen');
        }

        // Fetch inclusions and exclusions for this Zajezd
        $zahrnujes = $doctrine->getRepository(PricingItemStudent::class)->findBy([
            'zajezd_student' => $zajezd_student,
            'type' => 'Zahrnuje'
        ]);

        $nezahrnujes = $doctrine->getRepository(PricingItemStudent::class)->findBy([
            'zajezd_student' => $zajezd_student,
            'type' => 'Nezahrnuje'
        ]);

        // Pass the Zajezd and other data to the template
        return $this->render('zajezdy/student/show.html.twig', [ // Updated template path
            'zajezd_student' => $zajezd_student,
            'zahrnujes' => $zahrnujes,
            'nezahrnujes' => $nezahrnujes,
        ]);
    }

    private ZajezdyStudentRepository $zajezdyStudentRepository; // Updated repository type

    public function __construct(ZajezdyStudentRepository $zajezdyStudentRepository) // Updated constructor
    {
        $this->zajezdyStudentRepository = $zajezdyStudentRepository;
    }

    #[Route('/zajezdy-student', name: 'zajezdy_student_list')]
    #[Route('/cs/zajezdy-student', name: 'zajezdy_student_list_cs')]
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
        $destinaces = $this->zajezdyStudentRepository->findDistinctDestinaces();
        $dopravas = $this->zajezdyStudentRepository->findDistinctDopravas();
        $types = $this->zajezdyStudentRepository->findDistinctTypes();

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

        // Fetch zajezdy sorted by the 'order' field
        $zajezdy_student = $this->zajezdyStudentRepository->findByCriteriaAndDate($criteria, $date, ['zajezd_order' => 'ASC']);

        return $this->render('zajezdy/student/index.html.twig', [ // Updated template path
            'zajezdy_student' => $zajezdy_student,
            'selected_destinace' => $selected_destinace,
            'selected_doprava' => $selected_doprava,
            'selected_typ' => $selected_typ,
            'selected_date' => $selected_date,
            'destinaces' => $destinaces,
            'dopravas' => $dopravas,
            'types' => $types, // Pass the dynamically fetched types to the template
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/zajezdy-student/{nazev}/order', name: 'zajezd_order', methods: ['POST'])]
    #[Route('/cs/zajezdy-student/{nazev}/order', name: 'zajezd_order_cs', methods: ['POST'])]
    public function sendOrder(Request $request, ManagerRegistry $doctrine, string $nazev): Response
    {
        // Najděte Zajezd podle 'nazev'
        $zajezd_student = $doctrine->getRepository(ZajezdyStudent::class)->findOneBy([ // Updated entity reference
            'nazev' => str_replace('-', ' ', ucwords($nazev))
        ]);

        if (!$zajezd_student) {
            throw $this->createNotFoundException('Zájezd nebyl nalezen');
        }

        // Získání dat z formuláře
        $osoby = (int) $request->request->get('osoby');
        $cena = (int) $zajezd_student->getCena();
        $bydliste = $request->request->get('bydliste');
        $poznamka = $request->request->get('poznamka');
        $telefon = $request->request->get('tel');
        $email = $request->request->get('email');
        $pojisteni = $request->request->get('pojisteni') ? 'Ano' : 'Ne';
        $newsletter = $request->request->get('newsletter') ? 'Ano' : 'Ne';
        $statniPrislusnost = $request->request->get('statni_prislusnost');

        // Výpočet celkové ceny
        $totalCena = $cena * $osoby;

        // Příprava e-mailu pro administrátora
        $toAdmin = 'cestovka@vspj.cz';
        $subjectAdmin = 'Nezávazná objednávka zájezdu';

        // Zde vytvořte pole pro jména a narození
        $names = [];
        $birthdates = [];

        // Loop through the number of people to gather names and birthdates
        for ($i = 1; $i <= $osoby; $i++) {
            $name = $request->request->get("jmeno_$i");
            $birthdate = $request->request->get("narozeni_$i");
            if ($name) {
                $names[] = $name;
            }
            if ($birthdate) {
                $birthdates[] = $birthdate;
            }
        }

        // Sestavte zprávu s jmény a daty narození
        $namesList = implode(", ", $names);
        $birthdatesList = implode(", ", $birthdates);

        $messageAdmin =
            "Zájezd: {$zajezd_student->getNazev()}\n" .
            "Počet osob: $osoby\nCena za osobu: $cena\n" .
            "Celková cena: $totalCena Kč\n" .
            "Adresa trvalého bydliště: $bydliste\n" .
            "Státní příslušnost: $statniPrislusnost\n" .
            "Jména: $namesList\n" .
            "Datum narození: $birthdatesList\n" .
            "Telefoní číslo: $telefon\n" .
            "E-mail: $email\n" .
            "Poznámka: $poznamka\nCestovní pojištění: $pojisteni\nZájem o newsletter: $newsletter";

        // Hlavičky e-mailu
        $headers = 'From: cestovka@vspj.cz' . "\r\n" .
            'Reply-To: ' . $request->request->get('email') . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Odeslání e-mailu pro administrátora
        mail($toAdmin, $subjectAdmin, $messageAdmin, $headers);

        // Příprava potvrzovacího e-mailu pro respondenta
        $fullname = implode(", ", $names); // Combine names for confirmation email
        $firstName = explode(' ', trim($fullname))[0];
        $subjectRespondent = 'Potvrzení přijetí nezávazné objednávky';
        $messageRespondent = "Dobrý den, $firstName,\n\nDěkujeme za zprávu. Toto je potvrzení, že jsme obdrželi Vaši objednávku na zájezd {$zajezd_student->getNazev()}.\n\n" .
            "Budeme Vás informovat, jakmile budeme mít další informace.\n\nS pozdravem,\nVáš tým CK VŠPJ";

        // Odeslat potvrzovací e-mail
        mail($email, $subjectRespondent, $messageRespondent, $headers);

        return $this->redirectToRoute('zajezd_student_show', ['nazev' => str_replace(' ', '-', $zajezd_student->getNazev())]);
    }
}
