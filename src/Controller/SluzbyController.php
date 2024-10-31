<?php

namespace App\Controller;

use App\Repository\SluzbyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SluzbyController extends AbstractController
{
    private SluzbyRepository $sluzbyRepository;

    public function __construct(
        SluzbyRepository $sluzbyRepository,
    ) {
        $this->sluzbyRepository = $sluzbyRepository;
    }

    #[Route('/sluzby', name: 'app_sluzby')]
    #[Route('/cs/sluzby', name: 'app_sluzby_cs')]
    public function index(): Response
    {
        $sluzby = $this->sluzbyRepository->findAll();

        return $this->render('sluzby/index.html.twig', [
            'controller_name' => 'SluzbyController',
            'sluzby' => $sluzby,
        ]);
    }
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/send-email', name: 'app_send_email_sluzby', methods: ['POST'])]
    #[Route('/cs/send-email', name: 'app_send_email_sluzby_cs', methods: ['POST'])]
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
        return $this->redirectToRoute('app_sluzby');
    }

}
