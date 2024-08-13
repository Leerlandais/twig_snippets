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
    case 'add':
            switch ($_GET['type']) {
                case 'form':
                    $buttonsForAddForm = $buttonsForAddForm = [
                        [
                            'class' => 'Create'
                        ],
                        [
                            'class' => 'Login'
                        ],
                        [
                            'class' => 'Reset'
                        ]
                    ];
                    ;
                    echo $twig->render('privateView/private.addForm.html.twig', ['buttonsForAddForm' => $buttonsForAddForm]);
                    break;
                case 'table':

                    break;
            }
        break;

}

