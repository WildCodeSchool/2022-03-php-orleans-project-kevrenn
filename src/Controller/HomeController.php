<?php

namespace App\Controller;

use App\Model\MemberManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $memberManager = new MemberManager();
        $members = $memberManager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['members' => $members]);
    }
}
