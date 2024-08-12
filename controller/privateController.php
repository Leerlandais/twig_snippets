<?php
use model\Manager\UserManager;

$route = $_GET['route'] ?? 'home';
switch ($route) {
    case 'home':
        echo $twig->render('privateView/private.home.html.twig');
        break;
    case 'logout':
        $userManager = new UserManager($db);
        $userManager->userLogout();
        header ("Location: ./");
        break;

}