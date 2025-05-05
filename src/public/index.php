<?php

// Including the UserController to handle the actions.
require_once __DIR__ . '/../app/controllers/UserController.php';

// Create an instance of the UserController.
$controller = new UserController();

// Get the action from the URL parameters, defaulting to 'readAll'.
$action = $_GET['action'] ?? 'readAll';

// Get the user ID from the URL parameters, if present.
$id = $_GET['id'] ?? null;

// Switch based on the action parameter and call the respective method of the controller.
switch ($action) {
    /**
     * Create a new user by calling the 'create' method of the controller.
     */
    case 'create':
        $controller->create();
        break;

    /**
     * Edit an existing user by calling the 'edit' method of the controller.
     * The user ID must be provided.
     */
    case 'edit':
        if ($id) $controller->edit($id);
        break;

    /**
     * Delete a user by calling the 'delete' method of the controller.
     * The user ID must be provided.
     */
    case 'delete':
        if ($id) $controller->delete($id);
        break;

    /**
     * Display all users by calling the 'readAll' method of the controller.
     */
    case 'readAll':
        $controller->readAll();
        break;

    /**
     * Default case that loads the home page by calling the 'index' method of the controller.
     */
    case 'index':
    default:
        $controller->index();
        break;
}
