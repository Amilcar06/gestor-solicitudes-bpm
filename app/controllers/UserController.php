<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new User();
        session_start();
        if (!isset($_SESSION["user"])) {
            header("Location: /public/login.php");
            exit;
        }
    }

    public function index() {
        $users = $this->model->getAll();
        include __DIR__ . '/../views/users/index.php';
    }

    public function create() {
        include __DIR__ . '/../views/users/create.php';
    }

    public function store() {
        $this->model->create($_POST['nombre'], $_POST['correo'], $_POST['password'], $_POST['rol']);
        header("Location: /public/users.php");
    }

    public function edit($id) {
        $user = $this->model->findById($id);
        include __DIR__ . '/../views/users/edit.php';
    }

    public function update($id) {
        $this->model->update($id, $_POST['nombre'], $_POST['correo'], $_POST['rol']);
        header("Location: /public/users.php");
    }

    public function delete($id) {
        $this->model->delete($id);
        header("Location: /public/users.php");
    }
}
