<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <h2>Editar Usuario</h2>
    <form method="POST" action="users.php?action=update&id=<?= $user['id'] ?>">
        <input class="form-control mb-2" name="nombre" value="<?= $user['nombre'] ?>" required>
        <input class="form-control mb-2" name="correo" type="email" value="<?= $user['correo'] ?>" required>
        <select class="form-control mb-2" name="rol">
            <option value="admin" <?= $user['rol'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="usuario" <?= $user['rol'] == 'usuario' ? 'selected' : '' ?>>Usuario</option>
        </select>
        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
