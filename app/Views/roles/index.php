<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">
    <!-- Encabezado -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Roles
            </h1>
            <p class="text-sm text-slate-500">
                Gestiona los roles del sistema
            </p>
        </div>
        <button
            id="abrirModalRol"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="bi bi-plus-lg"></i>
            Nuevo Rol
        </button>
    </div>
    <!-- Tabla -->
    <div class="bg-white rounded-xl shadow border border-slate-200">
        <div class="overflow-x-auto">
            <div class="p-6">
                <table
                    id="tablaRoles"
                    class="min-w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">N°</th>
                            <th class="px-4 py-3">Rol</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Creado</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($roles as $index => $r): ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3"><?= $index + 1 ?></td>
                                <td class="px-4 py-3 font-medium text-slate-700"><?= $r['nombreRol'] ?></td>
                                <td class="px-4 py-3"><?= $r['descripcionRol'] ?></td>
                                <td class="px-4 py-3"><?= $r['fechaCreado'] ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <?php if ($r['estado'] == 1): ?>
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Activo
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                Inactivo
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <!-- Editar -->
                                        <button
                                            class="btnEditar inline-flex items-center justify-center p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $r['idRol'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <!-- Permisos -->
                                        <button
                                            class="btnPermisos inline-flex items-center justify-center p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                                            data-id="<?= $r['idRol'] ?>"
                                            data-nombre="<?= htmlspecialchars($r['nombreRol']) ?>">
                                            <i class="bi bi-shield-lock"></i>
                                        </button>
                                        <!-- Estado -->
                                        <?php if ($r['estado'] == 1): ?>
                                            <button
                                                class="btnEstado inline-flex items-center justify-center p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                data-id="<?= $r['idRol'] ?>"
                                                data-estado="0"
                                                data-nombre="<?= htmlspecialchars($r['nombreRol']) ?>">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        <?php else: ?>
                                            <button
                                                class="btnEstado inline-flex items-center justify-center p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                                data-id="<?= $r['idRol'] ?>"
                                                data-estado="1"
                                                data-nombre="<?= htmlspecialchars($r['nombreRol']) ?>">
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
<!-- MODAL NUEVO ROL -->
<div
    id="modalRol"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">
        <!-- Encabezado -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Nuevo Rol
                </h2>
                <p class="text-sm text-slate-500">
                    Registre un nuevo rol para el sistema.
                </p>
            </div>
            <button
                id="cerrarModalRol"
                type="button"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- Formulario -->
        <form
            id="formRol"
            method="POST"
            action="index.php?url=roles_store">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre del Rol
                        </label>
                        <input
                            type="text"
                            name="nombreRol"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                    </div>
                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Descripción
                        </label>
                        <input
                            type="text"
                            name="descripcionRol"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalRol"
                    class="px-5 py-2.5 rounded-lg border border-slate-300
                           hover:bg-slate-100 transition">
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600
                           hover:bg-blue-700 text-white transition">
                    <i class="bi bi-floppy mr-1"></i>
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
<!-- MODAL EDITAR ROL -->
<div
    id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">
        <!-- Encabezado -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Rol
                </h2>
                <p class="text-sm text-slate-500">
                    Actualice la información del rol.
                </p>
            </div>
            <button
                id="cerrarModalEditar"
                type="button"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <form
            id="formEditarRol"
            method="POST"
            action="index.php?url=roles_update">
            <input
                type="hidden"
                name="idRol"
                id="edit_id">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre del Rol
                        </label>
                        <input
                            type="text"
                            name="nombreRol"
                            id="edit_nombreRol"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                    </div>
                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Descripción
                        </label>
                        <input
                            type="text"
                            name="descripcionRol"
                            id="edit_descripcionRol"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalEditar"
                    class="px-5 py-2.5 rounded-lg border border-slate-300 hover:bg-slate-100 transition">
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
<!-- MODAL PERMISOS -->
<div
    id="modalPermisos"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl mx-4">
        <!-- Encabezado -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <i class="bi bi-shield-lock text-blue-600"></i>
                    Permisos del Rol
                </h2>
                <p class="text-sm text-slate-500">
                    Seleccione los permisos que tendrá este rol.
                </p>
            </div>
            <button
                id="cerrarModalPermisos"
                type="button"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <form
            id="formPermisos"
            method="POST"
            action="index.php?url=roles_permisos_guardar">
            <input
                type="hidden"
                id="idRolPermiso"
                name="idRol">
            <div class="p-6">
                <!-- Nombre del rol -->
                <div class="mb-6">
                    <h3
                        id="nombreRol"
                        class="text-lg font-semibold text-blue-700">
                    </h3>
                </div>
                <!-- Permisos -->
                <div
                    id="contenedorPermisos"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Los permisos se cargan desde JS -->
                </div>
            </div>
            <!-- Footer -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalPermisos"
                    class="px-5 py-2.5 rounded-lg border border-slate-300 hover:bg-slate-100 transition">
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition">
                    <i class="bi bi-floppy mr-1"></i>
                    Guardar permisos
                </button>
            </div>
        </form>
    </div>
</div>
<?php
$titulo = "Roles";
$js = "roles.js";
?>