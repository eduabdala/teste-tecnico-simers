<?php

require_once __DIR__ . '/../models/User.php';
use Valitron\Validator;

/**
 * Controller responsible for managing user-related actions.
 */
class UserController {
    /**
     * Instance of the User model.
     * @var User
     */
    private $model;

    /**
     * Initializes the controller and loads the User model.
     */
    public function __construct() {
        $this->model = new User();
    }

    /**
     * Displays the home page.
     * @return void
     */
    public function index() {
        include __DIR__ . '/../views/home.php';
    }

    /**
     * Displays a list of all registered users.
     * @return void
     */
    public function readAll() {
        $users = $this->model->getAll();
        include __DIR__ . '/../views/user_list.php';
    }

    /**
     * Handles user creation form display and submission.
     * Validates input data and stores a new user in the database.
     * @return void
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome' => $_POST['name'],
                'cpf' => $_POST['cpf'],
                'email' => $_POST['email'],
                'data_nascimento' => $_POST['birth_date'],
                'telefone' => $_POST['phone'],
                'senha' => $_POST['password'],
            ];

            $v = new Validator($data);
            $v->rule('required', ['nome', 'cpf', 'email', 'data_nascimento', 'telefone', 'senha']);
            $v->rule('email', 'email');
            $v->rule('lengthMin', 'senha', 6);

            if ($v->validate()) {
                $this->model->create($data);
                header('Location: index.php?action=readAll');
                exit;
            } else {
                $errors = $v->errors();
                include __DIR__ . '/../views/user_create.php';
            }
        } else {
            include __DIR__ . '/../views/user_create.php';
        }
    }

    /**
     * Loads user data and handles the update form submission.
     * Validates input data and updates user info in the database.
     *
     * @param int $id User ID to be edited.
     * @return void
     */
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome' => $_POST['nome'],
                'cpf' => $_POST['cpf'],
                'email' => $_POST['email'],
                'data_nascimento' => $_POST['data_nascimento'],
                'telefone' => $_POST['telefone'],
            ];
            
            if (!empty($_POST['senha'])) {
                $data['senha'] = $_POST['senha'];
            }

            $v = new Validator($data);
            $v->rule('required', ['nome', 'cpf', 'email', 'data_nascimento', 'telefone']);
            $v->rule('email', 'email');
            $v->rule('lengthMin', 'senha', 6);

            if ($v->validate()) {
                $this->model->update($id, $data);
                header('Location: index.php?action=readAll');
                exit;
            } else {
                $errors = $v->errors();
                $user = $this->model->findById($id);
                include __DIR__ . '/../views/user_edit.php';
            }
        } else {
            $user = $this->model->findById($id);
            include __DIR__ . '/../views/user_edit.php';
        }
    }

    /**
     * Deletes a user by their ID.
     *
     * @param int $id User ID to be deleted.
     * @return void
     */
    public function delete($id) {
        $this->model->delete($id);
        header('Location: index.php?action=readAll');
        exit;
    }
}
