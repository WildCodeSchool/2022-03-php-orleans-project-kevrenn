<?php

namespace App\Controller;

use App\Model\PartnerManager;

class AdminPartnerController extends AbstractController
{
    public const BDD_LENGTH = 255;
    public array $errors = [];

    public function index(): string
    {
        if ($this->getUser() === null) {
            echo 'Pas autorisé';
            header('HTTP/1.0 403 Forbidden');
            return '';
        }

        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll('name');

        return $this->twig->render('Admin/Partner/index.html.twig', ['partners' => $partners]);
    }

    public function add(): ?string
    {
        $partner = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partner = array_map('trim', $_POST);

            $this->validate($partner);
            if (!filter_var($partner['url'], FILTER_VALIDATE_URL)) {
                $this->errors[] = 'L\'adresse du site est invalide';
            }

            if (empty($this->errors)) {
                $partnerManager = new PartnerManager();
                $partnerManager->insert($partner);
                header('Location: /admin/partenaires');
            }
        }

        return $this->twig->render('Admin/Partner/add.html.twig', [
            'partner' => $partner,
            'errors' => $this->getErrors(),
        ]);
    }

    public function edit(int $id): ?string
    {
        $partnerManager = new PartnerManager();
        $partner = $partnerManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partner = array_map('trim', $_POST);

            $this->validate($partner);
            if (!filter_var($partner['url'], FILTER_VALIDATE_URL)) {
                $this->errors[] = 'L\'adresse du site est invalide';
            }

            if (empty($this->errors)) {
                $partnerManager->update($partner);
                header('Location: /admin/partenaires');
            }
        }

        return $this->twig->render('Admin/Partner/edit.html.twig', [
            'partner' => $partner,
            'errors' => $this->getErrors(),
        ]);
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

    private function validate($partner): void
    {
        $this->isEmpty('Nom', $partner['name']);
        $this->isEmpty('Adresse du site', $partner['url']);
        $this->isEmpty('Lien du logo', $partner['logo_link']);
        $this->isTooLong('Nom', $partner['name'], self::BDD_LENGTH);
        $this->isTooLong('Adresse du site', $partner['url'], self::BDD_LENGTH);
        $this->isTooLong('Lien du logo', $partner['logo_link'], self::BDD_LENGTH);
    }


    public function getErrors(): array
    {
        return $this->errors;
    }
}
