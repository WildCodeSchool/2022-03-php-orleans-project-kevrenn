<?php

namespace App\Controller;

use App\Model\EventManager;

class EventController extends AbstractController
{
    public function index()
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectALL();

        return $this->twig->render('Event/event.html.twig', ['events' => $events]);
    }
}
