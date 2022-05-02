<?php

namespace App\Controller;

use App\Model\MemberManager;

class AdminMemberController extends AbstractController
{
    public const NAME_LENGTH = 255;
    public const STATUS_LENGTH = 255;
    public array $errors = [];

    public function index(): string
    {
        $memberManager = new MemberManager();
        $members = $memberManager->selectAll('name');

        return $this->twig->render('Admin/Member/index.html.twig', ['members' => $members]);
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

    public function edit(int $id): ?string
    {
        $memberManager = new MemberManager();
        $member = $memberManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);

            $this->isEmpty('Nom', $member['name']);
            $this->isEmpty('Statut', $member['status']);
            $this->isTooLong('Nom', $member['name'], self::NAME_LENGTH);
            $this->isTooLong('Statut', $member['status'], self::STATUS_LENGTH);

            if (empty($this->errors)) {
                $memberManager->update($member);
                header('Location: /admin/membres');
            }
        }

        return $this->twig->render('Admin/Member/edit.html.twig', [
            'member' => $member,
            'errors' => $this->getErrors(),
        ]);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
