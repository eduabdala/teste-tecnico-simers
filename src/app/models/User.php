<?php

require_once __DIR__ . '/../core/Database.php';

/**
 * User model for handling user data in the database.
 */
class User {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Validates user data before database operations.
     * 
     * @param array $data Associative array with user data.
     * @return true|string Returns true if valid, or an error message string.
     */
    private function validate(array $data) {
        if (empty(trim($data['nome'] ?? ''))) {
            return "Nome é obrigatório.";
        }
        if (empty(trim($data['cpf'] ?? ''))) {
            return "CPF é obrigatório.";
        }
        if (empty(trim($data['email'] ?? ''))) {
            return "Email é obrigatório.";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return "Email inválido.";
        }
        if (empty(trim($data['data_nascimento'] ?? ''))) {
            return "Data de nascimento é obrigatória.";
        }
        if (empty(trim($data['telefone'] ?? ''))) {
            return "Telefone é obrigatório.";
        }
        // Validate password only if it's set
        if (isset($data['senha']) && empty(trim($data['senha']))) {
            return "Senha não pode ser vazia.";
        }

        return true;
    }

    /**
     * Create a new user with hashed password.
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
     * Retrieve a single user by ID.
     */
    public function findById($id) {
        $sql = "SELECT id, name, cpf, email, birth_date, phone, created_at FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve all users (without passwords).
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT id, name, cpf, email, birth_date, phone, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update user data. Password is updated only if provided.
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

        // Bind password if provided
        if (!empty($data['senha'])) {
            $hashedPassword = password_hash($data['senha'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Delete a user by ID.
     */
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
