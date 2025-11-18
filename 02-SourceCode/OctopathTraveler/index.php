<?php
// Front controller
require_once 'config/database.php';
require_once 'models/Character.php';
require_once 'models/Ability.php';
require_once 'controllers/CharacterController.php';

// Simple routing
$page = $_GET['page'] ?? 'home';
$controller = new CharacterController();

switch ($page) {
    case 'home':
        $controller->index();
        break;
    case 'character':
        $id = $_GET['id'] ?? 1;
        $controller->show($id);
        break;
    case 'abilities':
        $controller->abilities();
        break;
    default:
        $controller->index();
        break;
}
?>
