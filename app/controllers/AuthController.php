
<?php
// Al inicio de AuthController.php
$action = $_GET['action'] ?? '';
$auth = new AuthController();

switch ($action) {
    case 'login':
        $auth->login(); break;
    case 'register':
        $auth->register(); break;
    case 'logout':
        $auth->logout(); break;
}

require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login() {
        session_start();
        $userModel = new User();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = $userModel->login($email, $password);
            if ($user) {
                $_SESSION["user"] = $user;
                header("Location: /public/dashboard.php");
                exit;
            } else {
                $_SESSION["error"] = "Credenciales inválidas";
                header("Location: /public/login.php");
                exit;
            }
        }
    }

    public function register() {
        session_start();
        $userModel = new User();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $rol = $_POST["rol"] ?? "usuario";

            if ($userModel->findByEmail($email)) {
                $_SESSION["error"] = "El correo ya está registrado";
                header("Location: /public/register.php");
                exit;
            }

            $userModel->create($nombre, $email, $password, $rol);
            $_SESSION["success"] = "Registro exitoso. Inicia sesión.";
            header("Location: /public/login.php");
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /public/login.php");
        exit;
    }
}
