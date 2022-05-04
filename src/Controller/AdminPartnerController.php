<?php

namespace App\Controller;

use App\Model\PartnerManager;

class AdminPartnerController extends AbstractController
{
    public function index(): string
    {
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll('name');

        return $this->twig->render('Admin/Partner/index.html.twig', ['partners' => $partners]);
    }
}
