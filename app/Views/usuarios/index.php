<div class="max-w-7xl mx-auto p-6 space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Usuarios
            </h1>

            <p class="text-sm text-slate-500">
                Gestiona los usuarios del sistema
            </p>
        </div>

        <button
            id="abrirModalUsuario"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

            <i class="bi bi-plus-lg"></i>
            Nuevo Usuario

        </button>
    </div>

    <div class="bg-white rounded-xl shadow border border-slate-200">
        <div class="overflow-x-auto">
            <div class="p-6">

                <table
                    id="tablaUsuarios"
                    class="min-w-full text-sm text-left whitespace-nowrap">

                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">

                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Usuario</th>
                            <th class="px-4 py-3">Nombres</th>
                            <th class="px-4 py-3">Correo</th>
                            <th class="px-4 py-3">Rol</th>
                            <th class="px-4 py-3">Creado</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                        
                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        <?php foreach ($usuarios as $u): ?>

                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3"><?= $u['idUser'] ?></td>
                                <td class="px-4 py-3  font-medium text-slate-700"><?= $u['usuario'] ?></td>
                                <td class="px-4 py-3"><?= $u['nombres'] . ' ' . $u['apellidos'] ?></td>
                                <td class="px-4 py-3"><?= $u['correo'] ?></td>
                                <td class="px-4 py-3"><?= $u['nombreRol'] ?? 'Sin rol' ?></td>
                                <td class="px-4 py-3"><?= $u['fechaCreado'] ?></td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <?php if ($u['estado'] == 1): ?>
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Activo
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                Inactivo
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">

                                        <button
                                            class="btnEditar inline-flex items-center justify-center p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $u['idUser'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <?php if ($u['estado'] == 1): ?>

                                            <button
                                                class="btnEstado inline-flex items-center justify-center p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                data-id="<?= $u['idUser'] ?>"
                                                data-estado="0"
                                                data-nombre="<?= htmlspecialchars($u['nombres'] . ' ' . $u['apellidos']) ?>">
                                                <i class="bi bi-person-x"></i>
                                            </button>

                                        <?php else: ?>

                                            <button
                                                class="btnEstado inline-flex items-center justify-center p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                                data-id="<?= $u['idUser'] ?>"
                                                data-estado="1"
                                                data-nombre="<?= htmlspecialchars($u['nombres'] . ' ' . $u['apellidos']) ?>">
                                                <i class="bi bi-person-check"></i>
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

<!-- MODAL USUARIO -->
<!-- MODAL NUEVO USUARIO -->
<div
    id="modalUsuario"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <div class="w-full max-w-4xl rounded-2xl bg-white shadow-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between border-b px-6 py-4">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Nuevo Usuario
                </h2>

                <p class="text-sm text-slate-500">
                    Complete la información del usuario.
                </p>
            </div>

            <button
                type="button"
                id="cerrarModalUsuario"
                class="rounded-lg p-2 hover:bg-slate-100">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <form
            id="formUsuario"
            method="POST"
            action="index.php?url=usuarios_store">

            <!-- Body -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Usuario
                    </label>

                    <input
                        type="text"
                        name="usuario"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Correo
                    </label>

                    <input
                        type="email"
                        name="correo"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Nombres
                    </label>

                    <input
                        type="text"
                        name="nombres"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Apellidos
                    </label>

                    <input
                        type="text"
                        name="apellidos"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Rol
                    </label>

                    <select
                        name="rol"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">

                        <option value="">Seleccione un rol</option>

                        <?php foreach ($roles as $r): ?>

                            <option value="<?= $r['idRol'] ?>">
                                <?= $r['nombreRol'] ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 border-t px-6 py-4">

                <button
                    type="button"
                    id="cancelarModalUsuario"
                    class="rounded-lg border border-slate-300 px-5 py-2 hover:bg-slate-100">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                    Guardar Usuario

                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL USUARIO -->
<!-- MODAL EDITAR USUARIO -->
<div
    id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <div class="w-full max-w-4xl rounded-2xl bg-white shadow-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between border-b px-6 py-4">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Usuario
                </h2>

                <p class="text-sm text-slate-500">
                    Modifique la información del usuario.
                </p>
            </div>

            <button
                type="button"
                id="cerrarModalEditar"
                class="rounded-lg p-2 hover:bg-slate-100">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <form
            id="formEditarUsuario"
            method="POST"
            action="index.php?url=usuarios_update">

            <input
                type="hidden"
                name="idUser"
                id="edit_id">

            <!-- Body -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Usuario
                    </label>

                    <input
                        type="text"
                        name="usuario"
                        id="edit_usuario"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Correo
                    </label>

                    <input
                        type="email"
                        name="correo"
                        id="edit_correo"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Nombres
                    </label>

                    <input
                        type="text"
                        name="nombres"
                        id="edit_nombres"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Apellidos
                    </label>

                    <input
                        type="text"
                        name="apellidos"
                        id="edit_apellidos"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Contraseña (opcional)
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Rol
                    </label>

                    <select
                        name="rol"
                        id="edit_rol"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200">

                    </select>

                </div>

            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 border-t px-6 py-4">

                <button
                    type="button"
                    id="cancelarModalEditar"
                    class="rounded-lg border border-slate-300 px-5 py-2 hover:bg-slate-100">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>

<?php
$titulo = "Usuarios";
$js = "usuarios.js";
?>