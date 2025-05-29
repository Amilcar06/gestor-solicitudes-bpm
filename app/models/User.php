<?php
require_once __DIR__ . '/../../config/db.php';

// Ensure Database class exists
if (!class_exists('Database')) {
    class Database {
        public static function connect() {
            // Update the DSN, username, and password as needed for your setup
            $dsn = 'mysql:host=localhost;dbname=bpm_system;charset=utf8mb4';
            $username = 'root';
            $password = '';
            try {
                return new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
    }
}

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE correo = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $email, $password, $rol = 'usuario') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (nombre, correo, password, rol) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $hash, $rol]);
    }

    public function login($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAll() {
    $stmt = $this->conn->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nombre, $correo, $rol) {
        $stmt = $this->conn->prepare("UPDATE users SET nombre=?, correo=?, rol=? WHERE id=?");
        return $stmt->execute([$nombre, $correo, $rol, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        return $stmt->execute([$id]);
    }

}
