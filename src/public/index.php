<?php

require_once __DIR__ . '/../app/controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? 'readAll';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if ($id) $controller->edit($id);
        break;
    case 'delete':
        if ($id) $controller->delete($id);
        break;
    case 'readAll':
        $controller->readAll();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
