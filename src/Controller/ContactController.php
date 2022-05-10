<?php

namespace App\Controller;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    public function index(): string
    {

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = array_map('trim', $_POST);
            // validations
            $errors = $this->validate($contact);

            // si pas d'erreurs
            if (empty($errors)) {
                // envoi de mail
                $transport = Transport::fromDsn(MAILER_DSN);
                $mailer = new Mailer($transport);

                $email = (new Email())
                    ->from($contact['email'])
                    ->to(ADMIN_MAIL)
                    ->replyTo($contact['email'])
                    ->subject('Message de kevrenn.com')
                    ->html($this->twig->render('Contact/contactEmail.html.twig', ['contact' => $contact]));

                $mailer->send($email);
            }
        }

        return $this->twig->render('Contact/index.html.twig', [
            'errors' => $errors,
        ]);
    }

    private function validate(array $contact): array
    {
        $errors = [];
        if (empty($contact['lastname'])) {
            $errors[] = 'Le champ nom est obligatoire';
        }

        if (empty($contact['firstname'])) {
            $errors[] = 'Le champ prénom est obligatoire';
        }

        if (empty($contact['email'])) {
            $errors[] = 'Le champ email est obligatoire';
        }

        if (empty($contact['message'])) {
            $errors[] = 'Le champ message est obligatoire';
        }

        if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le champ email est invalide';
        }

        return $errors;
    }
}
