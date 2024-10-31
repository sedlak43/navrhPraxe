<?php

namespace App\Controller;

use App\Repository\KontaktyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class KontaktyController extends AbstractController
{
    private KontaktyRepository $kontaktyRepository;

    public function __construct(
        KontaktyRepository $kontaktyRepository,
    ) {
        $this->kontaktyRepository = $kontaktyRepository;
    }

    #[Route('/kontakty', name: 'app_kontakty')]
    #[Route('/cs/kontakty', name: 'app_kontakty_cs')]
    public function index(): Response
    {

        $kontakty = $this->kontaktyRepository->findAll();


        return $this->render('kontakty/index.html.twig', [
            'kontakty' => $kontakty,
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/send-email', name: 'app_send_email_kontakty', methods: ['POST'])]
    #[Route('/cs/send-email', name: 'app_send_email_kontakty_cs', methods: ['POST'])]
    public function sendEmail(Request $request): Response
    {
        $fullname = $request->request->get('fullname');
        $email = $request->request->get('email'); // Respondent's email
        $phone = $request->request->get('phone');
        $subject = $request->request->get('subject');
        $messageContent = $request->request->get('message');

        // Příprava e-mailu pro administrátora
        $toAdmin = 'ckvspj@vspj.cz';
        $subjectAdmin = 'Nezávazná objednávka zájezdu';
        $messageAdmin =
            "Jméno: $fullname\nEmail: $email\nTelefon: $phone\n" .
            "Předmět: $subject\n" .
            "Zpráva: $messageContent\n";

        // Hlavičky e-mailu
        $headers = 'From: ckvspj@vspj.cz' . "\r\n" .
            'Reply-To: ' . $request->request->get('email') . "\r\n" .
            'X-Mailer: PHP/' . phpversion();


        // Odeslání e-mailu pro administrátora
        mail($toAdmin, $subjectAdmin, $messageAdmin, $headers);

        // Příprava potvrzovacího e-mailu pro respondenta
        $subjectRespondent = 'Potvrzení přijetí zprávy';
        $messageRespondent = "Dobrý den, $fullname,\n\nDěkujeme za zprávu. Toto je potvrzení, že jsme vaši zprávu obdrželi.\nBrzy se Vám ozveme.\n\nPozdravem,\n\nCK VŠPJ";

        // Odeslání potvrzovacího e-mailu
        mail($email, $subjectRespondent, $messageRespondent, $headers);

        // Redirect or render a success page
        return $this->redirectToRoute('app_kontakty');
    }
}
