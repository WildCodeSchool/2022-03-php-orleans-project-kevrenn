<?php

namespace App\Controller;

use App\Model\EventManager;

class EventController extends AbstractController
{
    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectALL();

        return $this->twig->render('Event/index.html.twig', ['events' => $events]);
    }
}
