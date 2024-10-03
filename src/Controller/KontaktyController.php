<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class KontaktyController extends AbstractController
{
    #[Route('/kontakty', name: 'app_kontakty')]
    public function index(): Response
    {
        return $this->render('kontakty/index.html.twig');
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/send-email', name: 'app_send_email_kontakty', methods: ['POST'])]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {
        $fullname = $request->request->get('fullname');
        $email = $request->request->get('email'); // Respondent's email
        $phone = $request->request->get('phone');
        $subject = $request->request->get('subject');
        $messageContent = $request->request->get('message');

        // Create the email to send to you (admin)
        $emailToAdmin = (new Email())
            ->from('sedlak43@student.vspj.cz') // Your fixed email address
            ->to('sedlak43@student.vspj.cz') // Your Outlook email
            ->subject($subject)
            ->text("Jméno: $fullname\nEmail: $email\nTelefon: $phone\n\nZpráva:\n$messageContent");

        // Send the email to admin
        $mailer->send($emailToAdmin);

        // Create an email to send to the respondent as a confirmation
        $emailToRespondent = (new Email())
            ->from('sedlak43@student.vspj.cz') // Your fixed email address
            ->to($email) // This should be the respondent's email address
            ->subject('Potvrzení přijetí zprávy') // Confirmation subject
            ->text("Dobrý den, $fullname,\n\nDěkujeme za zprávu. Toto je potvrzení, že jsme vaši zprávu obdrželi.\n\nVaše zpráva:\n$messageContent\n\nS pozdravem,\nCK VŠPJ");

        // Send the email to the respondent
        $mailer->send($emailToRespondent);

        // Redirect or render a success page
        return $this->redirectToRoute('app_kontakty');
    }
}
