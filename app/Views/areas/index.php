<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">

    <!-- Encabezado -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Áreas
            </h1>

            <p class="text-sm text-slate-500">
                Gestiona las áreas del sistema
            </p>

        </div>

        <button
            id="abrirModalArea"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

            <i class="bi bi-plus-lg"></i>
            Nueva Área

        </button>

    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-xl shadow border border-slate-200">

        <div class="overflow-x-auto">

            <div class="p-6">

                <table
                    id="tablaAreas"
                    class="min-w-full text-sm text-left whitespace-nowrap">

                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">

                        <tr>

                            <th class="px-4 py-3">N°</th>
                            <th class="px-4 py-3">Gerencia</th>
                            <th class="px-4 py-3">Siglas</th>
                            <th class="px-4 py-3">Área</th>
                            <th class="px-4 py-3">Creado</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        <?php foreach ($areas as $index => $a): ?>

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-4 py-3">
                                    <?= $index + 1 ?>
                                </td>

                                <td class="px-4 py-3">
                                    <?= $a['nombreGerencia'] ?>
                                </td>

                                <td class="px-4 py-3 font-medium text-slate-700">
                                    <?= $a['siglasArea'] ?>
                                </td>

                                <td class="px-4 py-3">
                                    <?= $a['nombreArea'] ?>
                                </td>

                                <td class="px-4 py-3">
                                    <?= $a['fechaCreado'] ?>
                                </td>

                                <td class="px-4 py-3">

                                    <?php if ($a['estadoArea'] == 1): ?>

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

                                        <!-- Editar -->
                                        <button
                                            class="btnEditarArea inline-flex items-center justify-center p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $a['idAreas'] ?>">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>

                                        <!-- Estado -->
                                        <?php if ($a['estadoArea'] == 1): ?>

                                            <button
                                                class="btnEstadoArea inline-flex items-center justify-center p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                data-id="<?= $a['idAreas'] ?>"
                                                data-estado="0"
                                                data-nombre="<?= htmlspecialchars($a['nombreArea']) ?>">

                                                <i class="bi bi-x-lg"></i>

                                            </button>

                                        <?php else: ?>

                                            <button
                                                class="btnEstadoArea inline-flex items-center justify-center p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                                data-id="<?= $a['idAreas'] ?>"
                                                data-estado="1"
                                                data-nombre="<?= htmlspecialchars($a['nombreArea']) ?>">

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

<!-- MODAL NUEVA ÁREA -->
<div
    id="modalArea"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">

        <!-- Encabezado -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Nueva Área
                </h2>

                <p class="text-sm text-slate-500">
                    Registre una nueva área para el sistema.
                </p>

            </div>

            <button
                id="cerrarModalArea"
                type="button"
                class="text-slate-400 hover:text-slate-600 transition">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <!-- Formulario -->
        <form
            id="formArea"
            method="POST"
            action="index.php?url=areas_store">

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Gerencia -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Gerencia
                        </label>

                        <select
                            name="idGerencias"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">

                            <option value="">Seleccione...</option>

                            <?php foreach ($gerencias as $g): ?>

                                <option value="<?= $g['idGerencias'] ?>">
                                    <?= $g['nombreGerencia'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- Siglas -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Siglas
                        </label>

                        <input
                            type="text"
                            name="siglasArea"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">

                    </div>

                    <!-- Nombre -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre del Área
                        </label>

                        <input
                            type="text"
                            name="nombreArea"
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
                    id="cancelarModalArea"
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

<!-- MODAL EDITAR ÁREA -->
<div
    id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">

        <!-- Encabezado -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Editar Área
                </h2>

                <p class="text-sm text-slate-500">
                    Actualice la información del área.
                </p>

            </div>

            <button
                id="cerrarModalEditar"
                type="button"
                class="text-slate-400 hover:text-slate-600 transition">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <!-- Formulario -->
        <form
            id="formEditarArea"
            method="POST"
            action="index.php?url=areas_update">

            <input
                type="hidden"
                name="idAreas"
                id="edit_id">

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Gerencia -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Gerencia
                        </label>

                        <select
                            name="idGerencias"
                            id="edit_idGerencias"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">

                            <option value="">Seleccione...</option>

                            <?php foreach ($gerencias as $g): ?>

                                <option value="<?= $g['idGerencias'] ?>">
                                    <?= $g['nombreGerencia'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- Siglas -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Siglas
                        </label>

                        <input
                            type="text"
                            name="siglasArea"
                            id="edit_siglasArea"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">

                    </div>

                    <!-- Nombre -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre del Área
                        </label>

                        <input
                            type="text"
                            name="nombreArea"
                            id="edit_nombreArea"
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

<?php
$titulo = "Areas";
$js = "areas.js";
?>