<?php

namespace App\Controller;

use App\Entity\PricingItem;
use App\Entity\Zajezdy;
use App\Repository\ZajezdyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ZajezdyController extends AbstractController
{
    #[Route('/zajezdy/{nazev}', name: 'zajezd_show')]
    public function show(ManagerRegistry $doctrine, string $nazev): Response
    {
        // Convert hyphens back to spaces for the 'nazev' field
        $formattedNazev = str_replace('-', ' ', $nazev);

        // Find the Zajezd by the 'nazev'
        $zajezd = $doctrine->getRepository(Zajezdy::class)->findOneBy([
            'nazev' => $formattedNazev
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

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/zajezdy/{nazev}/order', name: 'zajezd_order', methods: ['POST'])]
    public function sendOrder(Request $request, MailerInterface $mailer, ManagerRegistry $doctrine, string $nazev): Response
    {
        // Find the Zajezd by 'nazev'
        $zajezd = $doctrine->getRepository(Zajezdy::class)->findOneBy([
            'nazev' => str_replace('-', ' ', ucwords($nazev))
        ]);

        if (!$zajezd) {
            throw $this->createNotFoundException('Zájezd nebyl nalezen');
        }

        // Get form data
        $fullname = $request->request->get('jmeno');
        $email = $request->request->get('email');
        $phone = $request->request->get('tel');
        $osoby = (int) $request->request->get('osoby');
        $cena = (int) $zajezd->getCena();
        $bydliste = $request->request->get('bydliste');
        $narozeni = $request->request->get('narozeni');
        $poznamka = $request->request->get('poznamka');
        $pojisteni = $request->request->get('pojisteni') ? 'Ano' : 'Ne';

        // Calculate the total price
        $totalCena = $cena * $osoby;

        // Create the email
        $emailMessage = (new Email())
            ->from('sedlak43@student.vspj.cz') // Your fixed email address
            ->to('sedlak43@student.vspj.cz') // Your Outlook email
            ->subject('Nezávazná objednávka zájezdu')
            ->text(
                "Zájezd: {$zajezd->getNazev()}\n" .
                "Jméno: $fullname\nEmail: $email\nTelefon: $phone\nPočet osob: $osoby\nCena za osobu: $cena\n" .
                "Celková cena: $totalCena Kč\n" .
                "Bydliště: $bydliste\nDatum narození: $narozeni\nPoznámka: $poznamka\nCestovní pojištění: $pojisteni"
            );

        // Send the email
        $mailer->send($emailMessage);

        // Create an email to send to the respondent as a confirmation
        $emailToRespondent = (new Email())
            ->from('sedlak43@student.vspj.cz') // Your fixed email address
            ->to($email) // This should be the respondent's email address
            ->subject('Potvrzení přijetí nezávazné objednávky') // Confirmation subject
            ->text("Dobrý den, $fullname,\n\nDěkujeme za zprávu. Toto je potvrzení, že jsme vaši nezávaznou objednávku obdrželi.\nBrzy se Vám ozveme.\n\nPozdravem,\n\nCK VŠPJ");

        // Send the email to the respondent
        $mailer->send($emailToRespondent);

        // Redirect to a success page or any other route
        return $this->redirectToRoute('zajezd_show', ['nazev' => $nazev]);
    }
}
