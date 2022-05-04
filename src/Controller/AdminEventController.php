<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{
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
}
