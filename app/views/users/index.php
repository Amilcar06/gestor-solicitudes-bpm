<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <h2>Usuarios</h2>
    <a href="users.php?action=create" class="btn btn-success mb-3">Nuevo Usuario</a>
    <table class="table table-bordered">
        <thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['nombre'] ?></td>
                <td><?= $u['correo'] ?></td>
                <td><?= $u['rol'] ?></td>
                <td>
                    <a href="users.php?action=edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="users.php?action=delete&id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
