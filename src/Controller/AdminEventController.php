<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{
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
