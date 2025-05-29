<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form method="POST" action="/app/controllers/AuthController.php?action=login">
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Entrar</button>
        <a href="/public/register.php">Registrarse</a>
    </form>
</body>
</html>
