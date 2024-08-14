<?php


use model\Manager\UserManager;
use model\Manager\FormManager;

use model\Mapping\FormMapping;


$formManager = new FormManager($db);

// ADD NEW FORM

if (isset(
    $_POST["addFormClass"],
    $_POST["addFormType"],
    $_POST["addFormTitle"],
    $_POST["addFormDesc"],
    $_POST["addFormImage"],
    $_POST["addFormCode"]
)) {
    $formMappingData = [
        'snip_form_class' => $_POST["addFormClass"],
        'snip_form_type' => $_POST["addFormType"],
        'snip_form_title' => $_POST["addFormTitle"],
        'snip_form_desc' => $_POST["addFormDesc"],
        'snip_form_img' => $_POST["addFormImage"],
        'snip_form_code' => $_POST["addFormCode"]
    ];

    $formMapping = new FormMapping($formMappingData);
    $formManager->addNewForm($formMapping);
}





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
                case 'phpCall':
                    echo $twig->render('privateView/private.addPhpCall.html.twig');
                    break;
                case 'phpFunc':
                    echo $twig->render('privateView/private.addPhpFunc.html.twig');
                    break;

            }
        break;
    case 'link':
        $getData = $formManager->selectAllDataForLink();

        echo $twig->render('privateView/private.link.html.twig', ['getData' => $getData]);
        break;

}

