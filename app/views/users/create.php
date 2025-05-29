<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <h2>Crear Usuario</h2>
    <form method="POST" action="users.php?action=store">
        <input class="form-control mb-2" name="nombre" placeholder="Nombre" required>
        <input class="form-control mb-2" name="correo" type="email" placeholder="Email" required>
        <input class="form-control mb-2" name="password" type="password" placeholder="Contraseña" required>
        <select class="form-control mb-2" name="rol">
            <option value="admin">Admin</option>
            <option value="usuario">Usuario</option>
        </select>
        <button class="btn btn-success">Guardar</button>
    </form>
</div>
