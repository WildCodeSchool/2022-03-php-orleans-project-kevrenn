<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'ateliers' => ['WorkshopController', 'index',],
    'atelier' => ['WorkshopController','show', ['id']],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'contact' => ['ContactController', 'index'],
    'evenements' => ['EventController', 'index'],
    'admin/evenements' => ['AdminEventController', 'index',],
    'evenement' => ['EventController','show', ['id']],
    'admin/evenements/supprimer' => ['AdminEventController', 'delete', ['id']],
    'admin/atelier' => ['AdminWorkshopController', 'index'],
    'admin/atelier/modifier' => ['AdminWorkshopController', 'edit', ['id']],
    'admin/atelier/ajouter' => ['AdminWorkshopController', 'add'],
    'admin/atelier/supprimer' => ['AdminWorkshopController', 'delete', ['id']],
    'login' => ['LoginController', 'login'],
    'logout' => ['LoginController', 'logout'],
    'admin/membres' => ['AdminMemberController', 'index'],
    'admin/membres/modifier' => ['AdminMemberController', 'edit', ['id']],
    'admin/membres/ajouter' => ['AdminMemberController', 'add',],
    'admin/membres/supprimer' => ['AdminMemberController', 'delete', ['id']],
    'admin/partenaires' => ['AdminPartnerController', 'index'],
    'admin/partenaires/ajouter' => ['AdminPartnerController', 'add'],
    'admin/partenaires/supprimer' => ['AdminPartnerController', 'delete', ['id']],
];
