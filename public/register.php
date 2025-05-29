<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Registro</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form method="POST" action="/app/controllers/AuthController.php?action=register">
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">Registrar</button>
        <a href="/public/login.php">Iniciar Sesión</a>
    </form>
</body>
</html>
