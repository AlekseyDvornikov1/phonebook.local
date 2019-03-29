<?php
session_start();
require __DIR__ . '/autoload.php';
$controller = new \App\Controllers\Base();
$action = $_GET['action'];
switch ($action)
{
    case 'home':
        $controller->action($action);
        break;
    case 'login':
        $controller->action($action);
        break;
    case 'MyContact':
        if(isset($_SESSION['user'])) {
            $controller->action($action);
        } else {
            $controller->action('home');
        }
        break;
    default:
        $controller->action('home');
        break;
}

