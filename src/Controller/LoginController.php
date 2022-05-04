<?php

namespace App\Controller;

use App\Model\UserManager;

class LoginController extends AbstractController
{
    public function login(): string
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $cresdentials = array_map('trim', $_POST);
            if (empty($cresdentials['email'])) {
                $errors[] = "L'email est obligatoire";
            }
            if (empty($cresdentials['password'])) {
                $errors[] = "Le mot de passe est obligatoire";
            }
            if (!filter_var($cresdentials['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'email est pas valide";
            }

            if (empty($errors)) {
                $userManager = new UserManager();
                $user = $userManager->selectOneByEmail($cresdentials['email']);
                if ($user) {
                    if (password_verify($cresdentials['password'], $user['password'])) {
                        $_SESSION['user'] = $user['id'];
                        header('Location: admin/membres');
                    } else {
                        $errors[] = 'Mauvais mot de passe';
                    }
                }
            }
        }

        return $this->twig->render('Login/login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        if (!empty($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        header('Location: /');
    }
}
