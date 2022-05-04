<?php

namespace App\Controller;

use App\Model\WorkshopManager;

class AdminWorkshopController extends AbstractController
{
    public const NAME_LENGTH = 255;
    public const ADRESS_LENGTH = 255;
    public array $errors = [];


    public function index(): string
    {
        $workshopManager = new WorkshopManager();
        $workshops = $workshopManager->selectAll();

        return $this->twig->render('Admin/Workshop/index.html.twig', ['workshops' => $workshops,]);
    }

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

    private function validate($workshop): void
    {
        $this->isEmpty('Nom', $workshop['name']);
        $this->isEmpty('Adresse', $workshop['address']);
        $this->isTooLong('Nom', $workshop['name'], self::NAME_LENGTH);
        $this->isTooLong('Adresse', $workshop['address'], self::ADRESS_LENGTH);
    }

    public function edit(int $id): ?string
    {
        $workshopManager = new WorkshopManager();
        $workshop = $workshopManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $workshop = array_map('trim', $_POST);

            $this->validate($workshop);

            if (empty($this->errors)) {
                $workshopManager->update($workshop);
                header('Location: /admin/atelier');
            }
        }


        return $this->twig->render('Admin/Workshop/edit.html.twig', [
            'workshop' => $workshop,
            'errors' => $this->getErrors(),
        ]);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function add(): ?string
    {
        $workshop = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $workshop = array_map('trim', $_POST);

            $this->validate($workshop);

            if (empty($this->errors)) {
                $workshopManager = new WorkshopManager();
                $workshopManager->insert($workshop);
                header('Location: /admin/atelier');
            }
        }

        return $this->twig->render('Admin/Workshop/add.html.twig', [
            'workshop' => $workshop,
            'errors' => $this->getErrors(),
        ]);
    }
}
