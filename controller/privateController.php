<?php

use model\Manager\CodeManager;
use model\Manager\UserManager;
use model\Manager\FormManager;
use model\Mapping\CodeMapping;
use model\Mapping\FormMapping;


$formManager = new FormManager($db);
$codeManager = new CodeManager($db);
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

if (isset(
    $_POST["addCallType"],
    $_POST["addCallDesc"],
    $_POST["addCallCode"]
)) {
    $type = $_POST["addCallType"];
    $desc = $_POST["addCallDesc"];
    $code = $_POST["addCallCode"];
    $codeMappingData = [
        'snip_code_type' => $_POST["addCallType"],
        'snip_code_desc' => $_POST["addCallDesc"],
        'snip_code_code' => $_POST["addCallCode"]
    ];

    $codeMapping = new CodeMapping($codeMappingData);
    $codeManager->addNewCode($codeMapping);

}

if (isset(
    $_POST["addFuncType"],
    $_POST["addFuncDesc"],
    $_POST["addFuncCode"]
)) {
    $type = $_POST["addFuncType"];
    $desc = $_POST["addFuncDesc"];
    $code = $_POST["addFuncCode"];
    $codeMappingData = [
        'snip_code_type' => $_POST["addFuncType"],
        'snip_code_desc' => $_POST["addFuncDesc"],
        'snip_code_code' => $_POST["addFuncCode"]
    ];

    $codeMapping = new CodeMapping($codeMappingData);
    $codeManager->addNewFunction($codeMapping);
}

if (isset(
    $_POST["linkSelectHtml"],
    $_POST["linkSelectCode"]
)) {
    $html = $_POST["linkSelectHtml"];
    $code = $_POST["linkSelectCode"];
    $codeManager->linkCodeToData($html, $code);
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


        $getCode = $codeManager->selectAllCodeForLink();
        echo $twig->render('privateView/private.link.html.twig', ['getData' => $getData, 'getCode' => $getCode]);
        break;

}

