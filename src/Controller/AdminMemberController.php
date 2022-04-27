<?php

namespace App\Controller;

use App\Model\MemberManager;

class AdminMemberController extends AbstractController
{
    public function index(): string
    {
        $memberManager = new MemberManager();
        $members = $memberManager->selectAll('name');

        return $this->twig->render('Admin/Member/index.html.twig', ['members' => $members]);
    }
}
