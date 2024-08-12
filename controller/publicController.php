<?php

use model\Manager\UserManager;

$route = $_GET['route'] ?? 'home';

if (isset($_POST["userLoginName"], $_POST["userLoginPwd"])) {
    $userManager = new UserManager($db); // Assuming $db is your PDO instance
    $name = $_POST["userLoginName"];
    $pwd = $_POST["userLoginPwd"];

    if ($userManager->attemptUserLogin($name, $pwd)) {
        header("Location: ./");
        exit;
    } else {
        echo "Login failed. Please check your credentials.";
    }
}


switch ($route) {
    case 'home':
        echo $twig->render('publicView/public.home.html.twig');
        break;
    case 'login' :
        echo $twig->render('publicView/public.login.html.twig');
}

