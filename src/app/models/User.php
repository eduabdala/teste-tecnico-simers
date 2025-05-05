<?php

require_once __DIR__ . '/../core/Database.php';

/**
 * User model for handling user-related data operations.
 */
class User {
    /**
     * PDO database connection instance.
     * @var PDO
     */
    private $db;

    /**
     * Initializes the User model and establishes a database connection.
     */
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Validates user data before performing any database operations.
     * 
     * @param array $data Associative array containing user information.
     * @return true|string Returns true if valid, otherwise an error message.
     */
    private function validate(array $data) {
        if (empty(trim($data['nome'] ?? ''))) {
            return "Name is required.";
        }
        if (!preg_match('/^[\p{L} ]+$/u', $data['nome'])) {
            return "Name must contain only letters and spaces.";
        }

        if (empty(trim($data['cpf'] ?? ''))) {
            return "CPF is required.";
        }
        if (!preg_match('/^\d{11}$/', $data['cpf'])) {
            return "CPF must be exactly 11 numeric digits.";
        }

        if (empty(trim($data['email'] ?? '')) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return "Email is invalid or missing.";
        }

        if (empty(trim($data['data_nascimento'] ?? ''))) {
            return "Birth date is required.";
        }

        if (empty(trim($data['telefone'] ?? ''))) {
            return "Phone number is required.";
        }
        if (!preg_match('/^\d{10,11}$/', $data['telefone'])) {
            return "Phone must be 10 or 11 numeric digits.";
        }

        if (isset($data['senha']) && $data['senha'] !== '') {
            if (strlen($data['senha']) < 6) {
                return "Password must be at least 6 characters long.";
            }
        }

        return true;
    }

    /**
     * Creates a new user in the database with a hashed password.
     * 
     * @param array $data Associative array with user information.
     * @return bool True on success, false on failure.
     * @throws Exception if validation fails.
     */
    public function create($data) {
        $validation = $this->validate($data);
        if ($validation !== true) {
            throw new Exception($validation);
        }

        $sql = "INSERT INTO users (name, cpf, email, birth_date, phone, password)
                VALUES (:name, :cpf, :email, :birth_date, :phone, :password)";
        $stmt = $this->db->prepare($sql);

        $hashedPassword = password_hash($data['senha'], PASSWORD_DEFAULT);

        $stmt->bindParam(':name', $data['nome']);
        $stmt->bindParam(':cpf', $data['cpf']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':birth_date', $data['data_nascimento']);
        $stmt->bindParam(':phone', $data['telefone']);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    /**
     * Retrieves a single user by their ID.
     * 
     * @param int $id The user's unique identifier.
     * @return array|false Associative array with user data or false if not found.
     */
    public function findById($id) {
        $sql = "SELECT id, name, cpf, email, birth_date, phone, created_at FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves all users from the database (excluding passwords).
     * 
     * @return array Array of associative arrays containing user data.
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT id, name, cpf, email, birth_date, phone, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Updates an existing user's data. Updates the password only if provided.
     * 
     * @param int $id The ID of the user to update.
     * @param array $data Associative array with the updated data.
     * @return bool True on success, false on failure.
     * @throws Exception if validation fails.
     */
    public function update($id, $data) {
        $validation = $this->validate($data);
        if ($validation !== true) {
            throw new Exception($validation);
        }

        $sql = "UPDATE users SET name = :name, cpf = :cpf, email = :email, 
                birth_date = :birth_date, phone = :phone";

        if (!empty($data['senha'])) {
            $sql .= ", password = :password";
        }

        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':name', $data['nome']);
        $stmt->bindParam(':cpf', $data['cpf']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':birth_date', $data['data_nascimento']);
        $stmt->bindParam(':phone', $data['telefone']);

        if (!empty($data['senha'])) {
            $hashedPassword = password_hash($data['senha'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Deletes a user from the database by their ID.
     * 
     * @param int $id The user's ID.
     * @return bool True on success, false on failure.
     */
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
