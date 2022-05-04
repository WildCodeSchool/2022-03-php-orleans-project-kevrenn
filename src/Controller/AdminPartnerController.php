<?php

namespace App\Controller;

use App\Model\PartnerManager;

class AdminPartnerController extends AbstractController
{
    public function index(): string
    {
        if ($this->getUser() === null) {
            echo 'Pas autorisé';
            header('HTTP/1.0 403 Forbidden');
            return '';
        }

        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll('name');

        return $this->twig->render('Admin/Partner/index.html.twig', ['partners' => $partners]);
    }
}
