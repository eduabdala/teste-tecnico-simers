<?php

/**
 * Database class responsible for establishing and providing a PDO connection.
 */
class Database {
    /**
     * @var PDO|null Holds the database connection instance.
     */
    private $conn;

    /**
     * Constructor: Initializes the database connection using configuration settings.
     *
     * Loads the configuration file and attempts to establish a connection to the database.
     * If the connection fails, the script is terminated with an error message.
     */
    public function __construct() {
        $config = require __DIR__ . '../../../config/config.php';

        try {
            $this->conn = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
                $config['username'],
                $config['password']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Returns the current PDO database connection.
     *
     * @return PDO The PDO connection instance.
     */
    public function getConnection() {
        return $this->conn;
    }
}
