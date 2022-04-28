<?php

namespace App\Controller;

use App\Model\EventManager;

class EventController extends AbstractController
{
    public function index()
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll();

        return $this->twig->render('Event/index.html.twig', ['events' => $events]);
    }

    public function show(int $id): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectOneById($id);

        return $this->twig->render('Event/description.html.twig', ['description' => $events]);
    }
}
