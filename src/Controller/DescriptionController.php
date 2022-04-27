<?php

namespace App\Controller;

use App\Model\DescriptionManager;

class DescriptionController extends AbstractController
{
    public function show(int $id): string
    {
        $descriptionManager = new DescriptionManager();
        $description = $descriptionManager->selectOneById($id);

        return $this->twig->render('Event/description.html.twig', ['description' => $description]);
    }
}
