<?php

// Include the Composer autoload file to load all required dependencies.
require_once __DIR__ . '/../vendor/autoload.php';

// Create a new instance of the Dotenv class to load environment variables from the .env file.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

// Load the environment variables defined in the .env file.
$dotenv->load();

// Return an associative array with database connection parameters from environment variables.
return [
    'host' => $_ENV['DB_HOST'],    // Database host (e.g., 'localhost' or '127.0.0.1').
    'dbname' => $_ENV['DB_NAME'],  // Database name.
    'username' => $_ENV['DB_USER'],// Database username.
    'password' => $_ENV['DB_PASS'],// Database password.
];
