<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Roles</h4>

        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalRol">
            Nuevo Rol
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table
                id="tablaRoles"
                class="table table-hover align-middle nowrap"
                style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th>Descripción</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($roles as $r): ?>

                        <tr>
                            <td><?= $r['idRol'] ?></td>
                            <td><?= $r['nombreRol'] ?></td>
                            <td><?= $r['descripcionRol'] ?></td>
                            <td><?= $r['fechaCreado'] ?></td>

                            <td>
                                <?php if ($r['estado'] == 1): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>

                            <td>

                                <button
                                    class="btn btn-sm btn-warning btnEditar"
                                    data-id="<?= $r['idRol'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button
                                    class="btn btn-primary btn-sm btnPermisos"
                                    data-id="<?= $r['idRol'] ?>"
                                    data-nombre="<?= htmlspecialchars($r['nombreRol']) ?>">
                                    <i class="bi bi-shield-lock"></i>
                                </button>

                                <?php if ($r['estado'] == 1): ?>

                                    <button
                                        class="btn btn-sm btn-outline-danger btnEstado"
                                        data-id="<?= $r['idRol'] ?>"
                                        data-estado="0"
                                        data-nombre="<?= htmlspecialchars($r['nombreRol']) ?>">
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                <?php else: ?>

                                    <button
                                        class="btn btn-sm btn-outline-success btnEstado"
                                        data-id="<?= $r['idRol'] ?>"
                                        data-estado="1"
                                        data-nombre="<?= htmlspecialchars($r['nombreRol']) ?>">
                                        <i class="bi bi-check2"></i>
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

<!-- MODAL ROL -->
<div class="modal fade" id="modalRol" tabindex="-1">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form
                id="formRol"
                method="POST"
                action="index.php?url=roles_store">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Rol</label>
                            <input type="text" name="nombreRol" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Descripción</label>
                            <input type="text" name="descripcionRol" class="form-control" required>
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

<!-- MODAL ROLES -->
<div class="modal fade" id="modalEditar">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form
                id="formEditarRol"
                method="POST"
                action="index.php?url=roles_update">

                <input type="hidden" name="idRol" id="edit_id">

                <div class="modal-header">
                    <h5>Editar Rol</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Rol</label>
                            <input type="text" name="nombreRol" id="edit_nombreRol" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Descripción</label>
                            <input type="text" name="descripcionRol" id="edit_descripcionRol" class="form-control">
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

<!-- MODAL PERMISOS-ROLES -->
<div class="modal fade" id="modalPermisos">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formPermisos"
                method="POST"
                action="index.php?url=roles_permisos_guardar">

                <input
                    type="hidden"
                    id="idRolPermiso"
                    name="idRol">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-shield-lock"></i>
                        Permisos del Rol
                    </h5>
                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <h5 id="nombreRol"></h5>
                    <hr>
                    <div id="contenedorPermisos"
                        class="row justify-content-center g-4">
                        <!-- Aquí irán los checkboxes -->
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
                        Guardar permisos
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
$titulo = "Roles";
$js = "roles.js";
?>