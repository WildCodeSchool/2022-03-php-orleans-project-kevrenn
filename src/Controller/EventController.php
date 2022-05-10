<?php

namespace App\Controller;

use App\Model\EventManager;
use App\Model\MediaManager;

class EventController extends AbstractController
{
    public function index(): string
    {
        $eventManager = new EventManager();

        $events = $eventManager->selectAll('date', 'DESC');


        return $this->twig->render('Event/index.html.twig', ['events' => $events,]);
    }

    public function show(int $id): string
    {
        $eventManager = new EventManager();
        $mediaManager = new MediaManager();
        $event = $eventManager->selectOneById($id);
        $images = $mediaManager->selectByEventId($id);
        return $this->twig->render('Event/description.html.twig', ['event' => $event,'images' => $images]);
    }
}
