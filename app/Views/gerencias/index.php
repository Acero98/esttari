<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">
    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Gerencias</h1>
            <p class="text-sm text-slate-500">Gestiona las gerencias del sistema</p>
        </div>
        <button
            id="abrirModalGerencia"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="bi bi-plus-lg"></i>
            Nueva Gerencia
        </button>
    </div>
    <!-- CARD -->
    <div class="bg-white rounded-xl shadow border border-slate-200">
        <div class="overflow-x-auto">
            <div class="p-6">
                <table
                    id="tablaGerencias"
                    class="min-w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">N°</th>
                            <th class="px-4 py-3">Siglas</th>
                            <th class="px-4 py-3">Gerencia</th>
                            <th class="px-4 py-3">Creado</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($gerencias as $index => $g): ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3">
                                    <?= $index + 1 ?>
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-700">
                                    <?= $g['siglasGerencia'] ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?= $g['nombreGerencia'] ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?= $g['fechaCreado'] ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?php if ($g['estadoGerencia'] == 1): ?>
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
                                        <!-- EDITAR -->
                                        <button
                                            class="btnEditarGerencia inline-flex p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $g['idGerencias'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <!-- ESTADO -->
                                        <?php if ($g['estadoGerencia'] == 1): ?>
                                            <button
                                                class="btnEstadoGerencia inline-flex p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                data-id="<?= $g['idGerencias'] ?>"
                                                data-estado="0"
                                                data-nombre="<?= htmlspecialchars($g['nombreGerencia']) ?>">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        <?php else: ?>
                                            <button
                                                class="btnEstadoGerencia inline-flex p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                                data-id="<?= $g['idGerencias'] ?>"
                                                data-estado="1"
                                                data-nombre="<?= htmlspecialchars($g['nombreGerencia']) ?>">
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
<!-- MODAL GERENCIA -->
<div
    id="modalGerencia"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Nueva Gerencia
                </h2>
                <p class="text-sm text-slate-500">
                    Registra una nueva gerencia del sistema.
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalGerencia"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- FORM -->
        <form
            id="formGerencia"
            method="POST"
            action="index.php?url=gerencias_store">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Siglas -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Siglas
                        </label>
                        <input
                            type="text"
                            name="siglasGerencia"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                    </div>
                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre de la Gerencia
                        </label>
                        <input
                            type="text"
                            name="nombreGerencia"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalGerencia"
                    class="px-5 py-2.5 rounded-lg border border-slate-300 hover:bg-slate-100 transition">
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
<!-- MODAL EDITAR GERENCIA -->
<div
    id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Gerencia
                </h2>
                <p class="text-sm text-slate-500">
                    Actualice la información de la gerencia
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalEditarGerencia"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- FORM -->
        <form
            id="formEditarGerencia"
            method="POST"
            action="index.php?url=gerencias_update">
            <input
                type="hidden"
                name="idGerencias"
                id="edit_id">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- SIGLAS -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Siglas
                        </label>
                        <input
                            type="text"
                            name="siglasGerencia"
                            id="edit_siglasGerencia"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- NOMBRE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre de la Gerencia
                        </label>
                        <input
                            type="text"
                            name="nombreGerencia"
                            id="edit_nombreGerencia"
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
                    id="cancelarModalEditarGerencia"
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
$titulo = "Gerencias";
$js = "gerencias.js";
?>