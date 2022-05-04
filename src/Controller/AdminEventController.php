<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{
    public const NAME_LENGTH = 255;
    public const ADRESS_LENGTH = 255;
    public const IMAGE_LINK_LENGTH = 255;

    public array $errors = [];

    private function isEmpty(string $label, $input): void
    {
        if (empty($input)) {
            $this->errors[] = "$label ne peut pas être vide";
        }
    }

    private function isTooLong(string $label, $input, int $const): void
    {
        if (strlen($input) > $const) {
            $this->errors[] = "$label ne peut pas être plus long que $const caractères";
        }
    }

    private function validate($event): void
    {
        $this->isEmpty('Nom', $event['name']);
        $this->isEmpty('Date', $event['date']);
        $this->isEmpty('Description', $event['description']);
        $this->isEmpty('Adresse', $event['address']);
        $this->isEmpty('Image', $event['image_link']);
        $this->isTooLong('Nom', $event['name'], self::NAME_LENGTH);
        $this->isTooLong('Adresse', $event['address'], self::ADRESS_LENGTH);
        $this->isTooLong('Image', $event['image_link'], self::IMAGE_LINK_LENGTH);
    }

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll('date', 'DESC');

        return $this->twig->render('Admin/Event/index.html.twig', ['events' => $events]);
    }

    public function edit(int $id): ?string
    {
        $eventManager = new EventManager();
        $event = $eventManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = array_map('trim', $_POST);

            $this->validate($event);

            if (empty($this->errors)) {
                $eventManager->update($event);
                header('Location: /admin/evenements/');
            }
        }

        return $this->twig->render('Admin/Event/_edit.html.twig', [
            'event' => $event,
            'errors' => $this->getErrors(),
        ]);
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}
