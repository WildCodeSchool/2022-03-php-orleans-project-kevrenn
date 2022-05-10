<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{
    public const NAME_LENGTH = 255;
    public const ADRESS_LENGTH = 255;
    public const IMAGE_LINK_LENGTH = 255;
    public const AUTHORIZED_MIMES = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    public const MAX_FILE_SIZE = 1000000;
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

    private function validateImage(array $files): void
    {
        if ($files['error'] === UPLOAD_ERR_NO_FILE) {
            $this->errors[] = 'Le fichier est obligatoire';
        } elseif ($files['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = 'Problème de téléchargement du fichier';
        } else {
            if ($files['size'] > self::MAX_FILE_SIZE) {
                $this->errors[] = 'Le fichier doit faire moins de ' . self::MAX_FILE_SIZE / 1000000 . 'Mo';
            }

            if (!in_array(mime_content_type($files['tmp_name']), self::AUTHORIZED_MIMES)) {
                $this->errors[] = 'Le fichier doit être de type ' . implode(', ', self::AUTHORIZED_MIMES);
            }
        }
    }

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll('name');

        return $this->twig->render('Admin/Event/index.html.twig', ['events' => $events]);
    }
    public function add(): ?string
    {
        $event = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $event = array_map('trim', $_POST);
            $imageFile = $_FILES['url_link'];

            // if validation is ok, insert and redirection
            $this->validate($event);
            $this->validateImage($imageFile);
            if (empty($this->errors)) {
                $extension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
                $imageName = uniqid('', true) . '.' . $extension;

                move_uploaded_file($imageFile['tmp_name'], UPLOAD_PATH . '/' . $imageName);
                $eventManager = new EventManager();
                $event['url_link'] = $imageName;
                $eventManager->insert($event);
                header('Location: /admin/evenements');
            }
        }

        return $this->twig->render('Admin/Event/add.html.twig', [
            'event' => $event,
            'errors' => $this->getErrors(),
        ]);
    }

    public function edit(int $id): ?string
    {
        $eventManager = new EventManager();
        $event = $eventManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = array_map('trim', $_POST);
            $imageFile = $_FILES['url_link'];

            $this->validate($event);
            $this->validateImage($imageFile);

            if (empty($this->errors)) {
                $extension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
                $imageName = uniqid('', true) . '.' . $extension;

                move_uploaded_file($imageFile['tmp_name'], UPLOAD_PATH . '/' . $imageName);

                $event['url_link'] = $imageName;
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
