<?php

namespace App\Controller;

use App\Model\EventManager;

class EventController extends AbstractController
{
    public function show(int $id): string
    {
        $eventManager = new EventManager();
        $event = $eventManager->selectOneById($id);

        return $this->twig->render('Event/description.html.twig', ['event' => $event]);
    }
}
