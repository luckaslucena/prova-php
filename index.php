<?php

require_once "controller/UserController.php";
require_once "controller/ColorController.php";

if (isset($_GET['user'])) {
    $user = new UserController();
    switch ($_GET['user']) {
        case 'index':
            $user->index();
            break;
        case 'create':
            $user->create();
            break;
        case 'store':
            $user->store($_POST);
            break;
        case 'destroy':
            $user->destroy($_GET['id']);
            break;
        case 'edit':
            $user->edit($_GET['id']);
            break;
        case 'update':
            $user->update($_POST);
            break;
        default:
            http_response_code(404);
    }
} elseif (isset($_GET['color'])) {
    $color = new ColorController();
    switch ($_GET['color']) {
        case 'index':
            $color->index();
            break;
        case 'create':
            $color->create();
            break;
        case 'store':
            $color->store($_POST);
            break;
        case 'edit':
            $color->edit($_GET['id']);
            break;
        case 'update':
            $color->update($_POST);
            break;
        case 'destroy':
            $color->destroy($_GET['id']);
            break;
        default:
            http_response_code(404);
    }
} else {
    $user = new UserController();
    $user->index();
}
