<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Usuarios</h4>

        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUsuario">
            Nuevo Usuario
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table
                id="tablaUsuarios"
                class="table table-hover align-middle nowrap"
                style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($usuarios as $u): ?>

                        <tr>
                            <td><?= $u['idUser'] ?></td>
                            <td><?= $u['usuario'] ?></td>
                            <td><?= $u['nombres'] . ' ' . $u['apellidos'] ?></td>
                            <td><?= $u['correo'] ?></td>
                            <td><?= $u['nombreRol'] ?? 'Sin rol' ?></td>
                            <td><?= $u['fechaCreado'] ?></td>

                            <td>
                                <?php if ($u['estado'] == 1): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>

                            <td>

                                <button
                                    class="btn btn-sm btn-warning btnEditar"
                                    data-id="<?= $u['idUser'] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <?php if ($u['estado'] == 1): ?>

                                    <button
                                        class="btn btn-sm btn-outline-danger btnEstado"
                                        data-id="<?= $u['idUser'] ?>"
                                        data-estado="0"
                                        data-nombre="<?= htmlspecialchars($u['nombres'] . ' ' . $u['apellidos']) ?>">
                                        <i class="bi bi-person-x"></i>
                                    </button>

                                <?php else: ?>

                                    <button
                                        class="btn btn-sm btn-outline-success btnEstado"
                                        data-id="<?= $u['idUser'] ?>"
                                        data-estado="1"
                                        data-nombre="<?= htmlspecialchars($u['nombres'] . ' ' . $u['apellidos']) ?>">
                                        <i class="bi bi-person-check"></i>
                                    </button>

                                <?php endif; ?>

                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- MODAL USUARIO -->
<div class="modal fade" id="modalUsuario" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                id="formUsuario"
                method="POST"
                action="index.php?url=usuarios_store">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Usuario</label>
                            <input type="text" name="usuario" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Nombres</label>
                            <input type="text" name="nombres" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Rol</label>
                            <select name="rol" class="form-select" required>
                                <option value="">Seleccione un rol</option>

                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r['idRol'] ?>">
                                        <?= $r['nombreRol'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- MODAL USUARIO -->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form
                id="formEditarUsuario"
                method="POST"
                action="index.php?url=usuarios_update">

                <input type="hidden" name="idUser" id="edit_id">

                <div class="modal-header">
                    <h5>Editar Usuario</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Usuario</label>
                            <input type="text" name="usuario" id="edit_usuario" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Correo</label>
                            <input type="email" name="correo" id="edit_correo" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Nombres</label>
                            <input type="text" name="nombres" id="edit_nombres" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" id="edit_apellidos" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Rol</label>
                            <select name="rol" id="edit_rol" class="form-select"></select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="btn btn-primary">
                        Guardar cambios
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
$titulo = "Usuarios";
$js = "usuarios.js";
?>