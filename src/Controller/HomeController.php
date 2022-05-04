<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Model\PartnerManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $memberManager = new MemberManager();
        $members = $memberManager->selectAll();

        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll('name');

        return $this->twig->render(
            'Home/index.html.twig',
            ['members' => $members,
            'partners' => $partners]
        );
    }
}
