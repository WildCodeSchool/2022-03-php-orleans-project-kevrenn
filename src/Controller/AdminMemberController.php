<?php

namespace App\Controller;

use App\Model\MemberManager;

class AdminMemberController extends AbstractController
{
    public const NAME_LENGTH = 255;
    public const STATUS_LENGTH = 255;
    public const AUTHORIZED_MIMES = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    public const MAX_FILE_SIZE = 1000000;
    public array $errors = [];

    public function index(): string
    {
        if ($this->getUser() === null) {
            echo 'Pas autorisé';
            header('HTTP/1.0 403 Forbidden');
            return '';
        }
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

    private function validate($member): void
    {
        $this->isEmpty('Nom', $member['name']);
        $this->isEmpty('Statut', $member['status']);
        $this->isTooLong('Nom', $member['name'], self::NAME_LENGTH);
        $this->isTooLong('Statut', $member['status'], self::STATUS_LENGTH);
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

    public function edit(int $id): ?string
    {
        if ($this->getUser() === null) {
            echo 'Pas autorisé';
            header('HTTP/1.0 403 Forbidden');
            return '';
        }
        $memberManager = new MemberManager();
        $member = $memberManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);
            $imageFile = $_FILES['photo_link'];

            $this->validate($member);
            $this->validateImage($imageFile);

            if (empty($this->errors)) {
                $extension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
                $imageName = uniqid('', true) . '.' . $extension;

                move_uploaded_file($imageFile['tmp_name'], UPLOAD_PATH . '/' . $imageName);

                $member['photo_link'] = $imageName;

                $memberManager->update($member);
                header('Location: /admin/membres');
            }
        }

        return $this->twig->render('Admin/Member/edit.html.twig', [
            'member' => $member,
            'errors' => $this->getErrors(),
        ]);
    }

    public function add(): ?string
    {
        if ($this->getUser() === null) {
            echo 'Pas autorisé';
            header('HTTP/1.0 403 Forbidden');
            return '';
        }
        $member = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);
            $imageFile = $_FILES['photo_link'];

            $this->validate($member);
            $this->validateImage($imageFile);

            if (empty($this->errors)) {
                $extension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
                $imageName = uniqid('', true) . '.' . $extension;

                move_uploaded_file($imageFile['tmp_name'], UPLOAD_PATH . '/' . $imageName);

                $memberManager = new MemberManager();
                $member['photo_link'] = $imageName;

                $memberManager->insert($member);
                header('Location: /admin/membres');
            }
        }

        return $this->twig->render('Admin/Member/add.html.twig', [
            'member' => $member,
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
            $memberManager = new MemberManager();
            $memberManager->delete((int)$id);

            header('Location:/admin/membres');
        }
    }
}
