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

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $event = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $eventManager = new EventManager();
            $eventManager->insert($event);

            header('Location: /admin/evenements/');
            return null;
        }


        return $this->twig->render('Admin/Event/add.html.twig');
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

        return $this->twig->render('Admin/Event/edit.html.twig', [
            'event' => $event,
            'errors' => $this->getErrors(),
        ]);
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $eventManager = new EventManager();
            $eventManager->delete((int)$id);

            header('Location:/admin/evenements');
        }
    }
}
