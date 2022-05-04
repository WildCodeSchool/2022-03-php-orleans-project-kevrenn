<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{

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

            // TODO validations (length, format...)
            $eventManager->update($event);

            header('Location: /admin/evenements/');

            return null;
        }

        return $this->twig->render('Admin/Event/_edit.html.twig', [
            'event' => $event,
        ]);
    }
}
