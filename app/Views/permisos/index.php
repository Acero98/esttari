<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Permisos</h4>

        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPermiso">
            Nuevo Permiso
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table
                id="tablaPermisos"
                class="table table-hover align-middle nowrap"
                style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Permiso</th>
                        <th>Grupo</th>
                        <th>Ruta</th>
                        <th>Icono</th>
                        <th>Orden</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($permisos as $p): ?>

                        <tr>
                            <td><?= $p['idPermiso'] ?></td>
                            <td><?= $p['permiso'] ?></td>
                            <td><?= $p['grupo'] ?></td>
                            <td><?= $p['ruta'] ?></td>
                            <td><?= $p['icono'] ?></td>
                            <td><?= $p['orden'] ?></td>
                            <td><?= $p['fechaCreado'] ?></td>

                            <td>
                                <?php if ($p['estado'] == 1): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>

                            <td>

                                <button
                                    class="btn btn-sm btn-warning btnEditar"
                                    data-id="<?= $p['idPermiso'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <?php if ($p['estado'] == 1): ?>

                                    <button
                                        class="btn btn-sm btn-outline-danger btnEstado"
                                        data-id="<?= $p['idPermiso'] ?>"
                                        data-estado="0"
                                        data-nombre="<?= htmlspecialchars($p['permiso']) ?>">
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                <?php else: ?>

                                    <button
                                        class="btn btn-sm btn-outline-success btnEstado"
                                        data-id="<?= $p['idPermiso'] ?>"
                                        data-estado="1"
                                        data-nombre="<?= htmlspecialchars($p['permiso']) ?>">
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

<!-- MODAL USUARIO -->
<div class="modal fade" id="modalPermiso" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                id="formPermiso"
                method="POST"
                action="index.php?url=permisos_store">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Permiso</label>
                            <input type="text" name="permiso" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Grupo</label>
                            <input type="text" name="grupo" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Ruta</label>
                            <input type="text" name="ruta" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Icono</label>
                            <input type="text" name="icono" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Orden</label>
                            <input type="text" name="orden" class="form-control" required>
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
                id="formEditarPermiso"
                method="POST"
                action="index.php?url=permisos_update">

                <input type="hidden" name="idPermiso" id="edit_id">

                <div class="modal-header">
                    <h5>Editar Permiso</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Permiso</label>
                            <input type="text" name="permiso" id="edit_permiso" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Grupo</label>
                            <input type="text" name="grupo" id="edit_grupo" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Ruta</label>
                            <input type="text" name="ruta" id="edit_ruta" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Icono</label>
                            <input type="text" name="icono" id="edit_icono" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Orden</label>
                            <input type="text" name="orden" id="edit_orden" class="form-control">
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
$titulo = "Permisos";
$js = "permisos.js";
?>