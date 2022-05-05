<?php

namespace App\Controller;

use App\Model\WorkshopManager;

class WorkshopController extends AbstractController
{
    public function index(): string
    {
        $workshopManager = new WorkshopManager();
        $workshops = $workshopManager->selectAll();

        return $this->twig->render('Workshop/index.html.twig', ['workshops' => $workshops,]);
    }

    public function show(int $id): string
    {
        $workshopManager = new WorkshopManager();
        $workshop = $workshopManager->selectOneById($id);

        return $this->twig->render('Workshop/description.html.twig', ['workshop' => $workshop]);
    }
}
