<div class="max-w-7xl mx-auto p-6 space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">Permisos</h1>
            <p class="text-sm text-slate-500">Gestiona los permisos del sistema</p>
        </div>

        <button id="abrirModalPermiso" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="bi bi-plus-lg"></i>
            Nuevo Permiso
        </button>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow border border-slate-200">

        <div class="overflow-x-auto">

            <div class="p-6">

                <table id="tablaPermisos"
                    class="min-w-full text-sm text-left whitespace-nowrap">

                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Permiso</th>
                            <th class="px-4 py-3">Grupo</th>
                            <th class="px-4 py-3">Ruta</th>
                            <th class="px-4 py-3">Icono</th>
                            <th class="px-4 py-3">Orden</th>
                            <th class="px-4 py-3">Creado</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        <?php foreach ($permisos as $p): ?>

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-4 py-3"><?= $p['idPermiso'] ?></td>
                                <td class="px-4 py-3"><?= $p['permiso'] ?></td>
                                <td class="px-4 py-3"><?= $p['grupo'] ?></td>
                                <td class="px-4 py-3"><?= $p['ruta'] ?></td>
                                <td class="px-4 py-3"><?= $p['icono'] ?></td>
                                <td class="px-4 py-3"><?= $p['orden'] ?></td>
                                <td class="px-4 py-3"><?= $p['fechaCreado'] ?></td>

                                <td class="px-4 py-3">
                                    <?php if ($p['estado'] == 1): ?>
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Activo
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            Inactivo
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">

                                        <button class="btnEditar inline-flex p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $p['idPermiso'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <?php if ($p['estado'] == 1): ?>

                                            <button class="btnEstado inline-flex p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                data-id="<?= $p['idPermiso'] ?>"
                                                data-estado="0"
                                                data-nombre="<?= htmlspecialchars($p['permiso']) ?>">
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                        <?php else: ?>

                                            <button class="btnEstado inline-flex p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                                data-id="<?= $p['idPermiso'] ?>"
                                                data-estado="1"
                                                data-nombre="<?= htmlspecialchars($p['permiso']) ?>">
                                                <i class="bi bi-check2"></i>
                                            </button>

                                        <?php endif; ?>

                                    </div>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- MODAL PERMISO -->
<div
    id="modalPermiso"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Nuevo Permiso
                </h2>

                <p class="text-sm text-slate-500">
                    Registra un nuevo permiso del sistema
                </p>
            </div>

            <button
                type="button"
                id="cerrarModalPermiso"
                class="text-slate-400 hover:text-slate-600 transition">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <!-- FORM -->
        <form
            id="formPermiso"
            method="POST"
            action="index.php?url=permisos_store">

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Permiso -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Permiso
                        </label>

                        <input
                            type="text"
                            name="permiso"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Grupo -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Grupo
                        </label>

                        <input
                            type="text"
                            name="grupo"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Ruta -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Ruta
                        </label>

                        <input
                            type="text"
                            name="ruta"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Icono -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Icono
                        </label>

                        <input
                            type="text"
                            name="icono"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Orden -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Orden
                        </label>

                        <input
                            type="number"
                            name="orden"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">

                <button
                    type="button"
                    id="cancelarModalPermiso"
                    class="px-5 py-2.5 rounded-lg border border-slate-300
                           hover:bg-slate-100 transition">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition">

                    <i class="bi bi-floppy mr-1"></i>
                    Guardar

                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL EDITAR PERMISO -->
<div
    id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Permiso
                </h2>

                <p class="text-sm text-slate-500">
                    Actualice la información del permiso
                </p>
            </div>

            <button
                type="button"
                id="cerrarModalEditarPermiso"
                class="text-slate-400 hover:text-slate-600 transition">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <!-- FORM -->
        <form
            id="formEditarPermiso"
            method="POST"
            action="index.php?url=permisos_update">

            <input type="hidden" name="idPermiso" id="edit_id">

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Permiso -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Permiso
                        </label>

                        <input
                            type="text"
                            name="permiso"
                            id="edit_permiso"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Grupo -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Grupo
                        </label>

                        <input
                            type="text"
                            name="grupo"
                            id="edit_grupo"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Ruta -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Ruta
                        </label>

                        <input
                            type="text"
                            name="ruta"
                            id="edit_ruta"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Icono -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Icono
                        </label>

                        <input
                            type="text"
                            name="icono"
                            id="edit_icono"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                    <!-- Orden -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Orden
                        </label>

                        <input
                            type="number"
                            name="orden"
                            id="edit_orden"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">

                <button
                    type="button"
                    id="cancelarModalEditarPermiso"
                    class="px-5 py-2.5 rounded-lg border border-slate-300
                           hover:bg-slate-100 transition">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition">

                    <i class="bi bi-floppy mr-1"></i>
                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>

<?php
$titulo = "Permisos";
$js = "permisos.js";
?>