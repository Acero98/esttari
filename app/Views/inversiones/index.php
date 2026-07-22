<?php require_once 'modalDocumentos.php'; ?>

<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">
    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Inversiones
            </h1>
            <p class="text-sm text-slate-500">
                Gestiona las inversiones del sistema
            </p>
        </div>
        <button
            id="abrirModalInversion"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="bi bi-plus-lg"></i>
            Nueva Inversión
        </button>
    </div>
    <!-- CARD -->
    <div class="bg-white rounded-xl shadow border border-slate-200">
        <div class="overflow-x-auto">
            <div class="p-6">
                <table
                    id="tablaInversiones"
                    class="min-w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">N°</th>
                            <th class="px-4 py-3">CUI</th>
                            <th class="px-4 py-3">Nom. Resumen</th>
                            <th class="px-4 py-3">Est. Tarifario</th>
                            <th class="px-4 py-3">Fondo</th>
                            <th class="px-4 py-3">Área</th>
                            <!-- <th class="px-4 py-3">Nombre</th> 
                            <th class="px-4 py-3">Creado</th>-->
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 align-middle">
                        <?php foreach ($inversiones as $index => $i): ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3"><?= $index + 1 ?></td>
                                <td class="px-4 py-3"><?= $i['cui'] ?: '-' ?></td>
                                <td class="px-4 py-3 max-w-xs whitespace-normal break-words">
                                    <div
                                        title="<?= htmlspecialchars($i['nombre']) ?>">
                                        <?= htmlspecialchars($i['descripcion']) ?>
                                    </div>
                                </td>
                                <td class="px-4 py-3"><?= $i['nombreEstudioTarifario'] . ' (' . $i['anioInicio'] . ' - ' . $i['anioFin'] . ')' ?></td>
                                <td class="px-4 py-3"><?= $i['nombreFondo'] ?></td>
                                <td class="px-4 py-3">
                                    <div
                                        title="<?= htmlspecialchars($i['nombreArea']) ?>">
                                        <?= htmlspecialchars($i['siglasArea']) ?>
                                    </div>
                                </td>
                                <!-- <td class="px-4 py-3 max-w-md whitespace-normal">
                                    <= $i['nombre'] ?>
                                </td> 
                                <td class="px-4 py-3"><= $i['fechaCreado'] ?></td>-->
                                <td class="px-4 py-3">
                                    <?php if ($i['estado'] == 1): ?>
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
                                        <!-- Año Regulatorio -->
                                        <a
                                            href="index.php?url=anioregulatorio&idInversiones=<?= $i['idInversiones'] ?>"
                                            class="inline-flex p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                                            title="Año Regulatorio">
                                            <i class="bi bi-calendar3"></i>
                                        </a>
                                        <!-- Documentos -->
                                        <button
                                            class="btnDocumentos inline-flex p-2 rounded-lg bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition"
                                            data-id="<?= $i['idInversiones'] ?>"
                                            data-nombre="<?= htmlspecialchars($i['descripcion']) ?>"
                                            title="Documentos">
                                            <i class="bi bi-folder2-open"></i>
                                        </button>
                                        <!-- Editar -->
                                        <button
                                            class="btnEditarInversion inline-flex p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $i['idInversiones'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <!-- Estado -->
                                        <?php if ($i['estado'] == 1): ?>
                                            <button
                                                class="btnEstadoInversion inline-flex p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                data-id="<?= $i['idInversiones'] ?>"
                                                data-estado="0"
                                                data-nombre="<?= htmlspecialchars($i['descripcion']) ?>">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        <?php else: ?>
                                            <button
                                                class="btnEstadoInversion inline-flex p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                                data-id="<?= $i['idInversiones'] ?>"
                                                data-estado="1"
                                                data-nombre="<?= htmlspecialchars($i['descripcion']) ?>">
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
<!-- MODAL NUEVA INVERSIÓN -->
<div
    id="modalInversion"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl mx-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Nueva Inversión
                </h2>
                <p class="text-sm text-slate-500">
                    Registre una nueva inversión para el sistema.
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalInversion"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- FORM -->
        <form
            id="formInversion"
            method="POST"
            action="index.php?url=inversiones_store">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Estudio Tarifario -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estudio Tarifario
                        </label>

                        <select
                            name="idEstudioTarifario"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                focus:ring-2 focus:ring-blue-500
                                focus:border-blue-500 outline-none">

                            <option value="">Seleccione...</option>

                            <?php foreach ($estudios as $e): ?>

                                <option value="<?= $e['idEstudioTarifario'] ?>">
                                    <?= htmlspecialchars($e['nombre']) ?>
                                    (<?= $e['anioInicio'] ?> - <?= $e['anioFin'] ?>)
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                    <!-- Fondo -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Fondo
                        </label>
                        <select
                            name="idFondos"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none">
                            <option value="">Seleccione...</option>
                            <?php foreach ($fondos as $f): ?>
                                <option value="<?= $f['idFondos'] ?>">
                                    <?= $f['nombreFondo'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- Área ocupa toda la fila -->
                <div class="mt-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Área Responsable
                    </label>

                    <select
                        name="idAreas"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                focus:ring-2 focus:ring-blue-500
                                focus:border-blue-500 outline-none">

                        <option value="">Seleccione...</option>

                        <?php foreach ($areas as $a): ?>
                            <option value="<?= $a['idAreas'] ?>">
                                <?= $a['nombreArea'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mt-5">
                    <!-- CUI -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            CUI
                        </label>
                        <input
                            type="text"
                            name="cui"
                            maxlength="20"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none">
                    </div>
                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre Resumen
                        </label>
                        <input
                            type="text"
                            name="descripcion"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none">
                    </div>
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre de la Inversión
                        </label>
                        <textarea
                            name="nombre"
                            rows="4"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none resize-none"></textarea>
                    </div>
                    <!-- Observaciones 
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Observaciones
                        </label>
                        <textarea
                            name="observaciones"
                            rows="3"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none resize-none"></textarea>
                    </div> -->
                </div>
            </div>
            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalInversion"
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
<!-- MODAL EDITAR INVERSIÓN -->
<div
    id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl mx-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Inversión
                </h2>
                <p class="text-sm text-slate-500">
                    Actualice la información de la inversión.
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalEditarInversion"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- FORM -->
        <form
            id="formEditarInversion"
            method="POST"
            action="index.php?url=inversiones_update">
            <input
                type="hidden"
                name="idInversiones"
                id="edit_id">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Estudio Tarifario -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estudio Tarifario
                        </label>

                        <select
                            name="idEstudioTarifario"
                            id="edit_idEstudioTarifario"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none">

                            <option value="">Seleccione...</option>

                            <?php foreach ($estudios as $e): ?>
                                <option value="<?= $e['idEstudioTarifario'] ?>">
                                    <?= $e['nombre'] ?>
                                    (<?= $e['anioInicio'] ?> - <?= $e['anioFin'] ?>)
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <!-- Fondo -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Fondo
                        </label>
                        <select
                            name="idFondos"
                            id="edit_idFondos"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500 outline-none">
                            <option value="">Seleccione...</option>
                            <?php foreach ($fondos as $f): ?>
                                <option value="<?= $f['idFondos'] ?>">
                                    <?= $f['nombreFondo'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Área ocupa toda la fila -->
                <div class="mt-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Área Responsable
                    </label>

                    <select
                        name="idAreas"
                        id="edit_idAreas"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                focus:ring-2 focus:ring-blue-500
                                focus:border-blue-500 outline-none">

                        <option value="">Seleccione...</option>

                        <?php foreach ($areas as $a): ?>
                            <option value="<?= $a['idAreas'] ?>">
                                <?= $a['nombreArea'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- CUI / Nombre Resumen -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
                    <!-- CUI -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            CUI
                        </label>
                        <input
                            type="text"
                            name="cui"
                            id="edit_cui"
                            maxlength="20"
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
                            name="descripcion"
                            id="edit_descripcion"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none">
                    </div>
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nombre de la Inversión
                        </label>
                        <textarea
                            name="nombre"
                            id="edit_nombre"
                            rows="4"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none resize-none"></textarea>
                    </div>
                    <!-- Observaciones
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Observaciones
                        </label>
                        <textarea
                            name="observaciones"
                            id="edit_observaciones"
                            rows="3"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                                    focus:ring-2 focus:ring-blue-500
                                    focus:border-blue-500 outline-none resize-none"></textarea>
                    </div> -->
                </div>
            </div>
            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalEditarInversion"
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
$titulo = "Inversiones";
$js = "inversiones.js";
?>