<?php

namespace App\Controller;

class WorkshopController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Workshop/index.html.twig');
    }
}
