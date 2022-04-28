<?php

namespace App\Controller;

use App\Model\WorkshopManager;

class AdminWorkshopController extends AbstractController
{
    public function index(): string
    {
        $workshopManager = new WorkshopManager();
        $workshops = $workshopManager->selectAll();

        return $this->twig->render('Admin/Workshop/index.html.twig', ['workshops' => $workshops,]);
    }
}
