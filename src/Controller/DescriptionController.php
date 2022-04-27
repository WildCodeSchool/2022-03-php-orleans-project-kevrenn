<?php

namespace App\Controller;

use App\Model\DescriptionManager;

class DescriptionController extends AbstractController
{
    public function index()
    {
        $descriptionManager = new DescriptionManager();
        $descriptions = $descriptionManager->selectALL();

        return $this->twig->render('Event/description.html.twig', ['descriptions' => $descriptions]);
    }
}
