<?php

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'home':
    echo $twig->render('publicView/public.home.html.twig');
        break;
}