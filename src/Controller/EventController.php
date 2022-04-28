<?php

namespace App\Controller;

use App\Model\EventManager;

class EventController extends AbstractController
{
    public function index()
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll('date', 'DESC');

        return $this->twig->render('Event/index.html.twig', ['events' => $events]);
    }
}
