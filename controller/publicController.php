<?php


use model\Manager\UserManager;
use model\Manager\FormManager;
$formManager = new FormManager($db);

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


$route = $_GET['route'] ?? 'home';
switch ($route) {
    case 'home':
        echo $twig->render('publicView/public.home.html.twig');
        break;
    case 'login' :
        echo $twig->render('publicView/public.login.html.twig');
        break;
    case 'select':
        $class = htmlspecialchars(strip_tags(trim($_GET['class'])));
        $type = htmlspecialchars(strip_tags(trim($_GET['type'])));
        $getDataPublic = $formManager->getDataByType($class, $type);

        echo $twig->render('publicView/public.form.view.html.twig', ['getData' => $getDataPublic]);
        /*
        switch ($_GET["class"]) {
            case "login":

                break;
            case "create":

                break;
            case "reset":

                break;
        }
        */
        break;
    case 'showCode':

        break;
    default :
        echo $twig->render('publicView/public.home.html.twig');
        break;
}

