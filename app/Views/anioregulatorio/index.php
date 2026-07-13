<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">
    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Años Regulatorios
            </h1>
            <p class="text-sm text-slate-500">
                <?= $inversion['descripcion'] ?? 'Inversión seleccionada' ?>
            </p>
        </div>
        <button
            id="abrirModalAnioRegulatorio"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="bi bi-plus-lg"></i>
            Nuevo Año
        </button>
    </div>
    <!-- CARD -->
    <div class="bg-white rounded-xl shadow border border-slate-200">
        <div class="overflow-x-auto">
            <div class="p-6">
                <table id="tablaAnioRegulatorio"
                    class="min-w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">N°</th>
                            <th class="px-4 py-3">Año</th>
                            <th class="px-4 py-3">Estudio Tarifario</th>
                            <th class="px-4 py-3">Programado</th>
                            <th class="px-4 py-3">RDR</th>
                            <th class="px-4 py-3">ET</th>
                            <th class="px-4 py-3">Avance Físico</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($anios as $index => $a): ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3"><?= $index + 1 ?></td>
                                <td class="px-4 py-3 font-semibold text-slate-700"><?= $a['anio'] ?></td>
                                <td class="px-4 py-3"><?= $a['estudioTarifario'] . ' | ' . $a['anioInicio'] . '-' . $a['anioFin'] ?></td>
                                <td class="px-4 py-3">S/<?= number_format($a['programado'], 2) ?></td>
                                <td class="px-4 py-3">S/<?= number_format($a['rdr'], 2) ?></td>
                                <td class="px-4 py-3">S/<?= number_format($a['et'], 2) ?></td>
                                <td class="px-4 py-3">
                                    <?php if ($a['avanceFisico']): ?>
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            <?= $a['avanceFisico'] ?> %
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                                            Sin dato
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <!-- VER DETALLE -->
                                        <button
                                            type="button"
                                            class="btnEjecucion inline-flex p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                                            data-id="<?= $a['idAnioRegulatorio'] ?>"
                                            data-inversion="<?= $inversion['idInversiones'] ?>"
                                            data-anio="<?= $a['anio'] ?>"
                                            title="Ejecución mensual">
                                            <i class="bi bi-calendar-check"></i>
                                        </button>
                                        <!-- SEGUIMIENTO MENSUAL -->
                                        <button
                                            type="button"
                                            class="btnSeguimiento inline-flex p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                                            data-id="<?= $a['idAnioRegulatorio'] ?>"
                                            data-inversion="<?= $inversion['idInversiones'] ?>"
                                            data-anio="<?= $a['anio'] ?>"
                                            title="Seguimiento mensual">
                                            <i class="bi bi-journal-check"></i>
                                        </button>
                                        <!-- Editar -->
                                        <button
                                            class="btnEditarAnio inline-flex p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                            data-id="<?= $a['idAnioRegulatorio'] ?>"
                                            title="Editar Año Regulatorio">
                                            <i class="bi bi-pencil"></i>
                                        </button>
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
<!-- MODAL AÑO REGULATORIO -->
<div
    id="modalAnioRegulatorio"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Nuevo Año Regulatorio
                </h2>
                <p class="text-sm text-slate-500">
                    Registra el presupuesto regulatorio de la inversión
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalAnioRegulatorio"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- FORM -->
        <form
            id="formAnioRegulatorio"
            method="POST"
            action="index.php?url=anioregulatorio_store">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- ID INVERSIÓN -->
                    <input
                        type="hidden"
                        name="idInversiones"
                        value="<?= $inversion['idInversiones'] ?>">
                    <!-- ESTUDIO TARIFARIO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estudio Tarifario
                        </label>
                        <select
                            name="idEstudioTarifario"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="">
                                Seleccionar
                            </option>
                            <?php foreach ($estudiosTarifarios as $et): ?>
                                <option value="<?= $et['idEstudioTarifario'] ?>">
                                    <?= $et['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- AÑO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Año
                        </label>
                        <input
                            type="text"
                            name="anio"
                            required
                            placeholder="Ejemplo: 2026"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- PROGRAMADO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Programado
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="programado"
                            value="0"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- EJECUTADO 
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Ejecutado
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="ejecutado"
                            value="0"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div> -->
                    <!-- AVANCE FISICO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Avance Físico (%)
                        </label>
                        <input
                            type="text"
                            name="avanceFisico"
                            placeholder="Ejemplo: 50"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- RDR -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            RDR
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="rdr"
                            value="0"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- ET -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            ET
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="et"
                            value="0"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- OBSERVACIONES -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Observaciones
                        </label>
                        <textarea
                            name="observaciones"
                            rows="3"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalAnioRegulatorio"
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
<!-- MODAL EDITAR AÑO REGULATORIO -->
<div
    id="modalEditarAnioRegulatorio"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Año Regulatorio
                </h2>
                <p class="text-sm text-slate-500">
                    Actualice la información presupuestal del año
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalEditarAnioRegulatorio"
                class="text-slate-400 hover:text-slate-600 transition">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <!-- FORM -->
        <form
            id="formEditarAnioRegulatorio"
            method="POST"
            action="index.php?url=anioregulatorio_update">
            <input
                type="hidden"
                name="idAnioRegulatorio"
                id="edit_idAnioRegulatorio">
            <input
                type="hidden"
                name="idInversiones"
                id="edit_idInversiones">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- ESTUDIO TARIFARIO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estudio Tarifario
                        </label>
                        <select
                            name="idEstudioTarifario"
                            id="edit_idEstudioTarifario"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="">
                                Seleccionar
                            </option>
                            <?php foreach ($estudiosTarifarios as $et): ?>
                                <option value="<?= $et['idEstudioTarifario'] ?>">
                                    <?= $et['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- AÑO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Año
                        </label>
                        <input
                            type="text"
                            name="anio"
                            id="edit_anio"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- PROGRAMADO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Programado
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="programado"
                            id="edit_programado"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- AVANCE FISICO -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Avance Físico (%)
                        </label>
                        <input
                            type="text"
                            name="avanceFisico"
                            id="edit_avanceFisico"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- EJECUTADO 
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Ejecutado
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="ejecutado"
                            id="edit_ejecutado"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>-->
                    <!-- RDR -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            RDR
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="rdr"
                            id="edit_rdr"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- ET -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            ET
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="et"
                            id="edit_et"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- OBSERVACIONES -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Observaciones
                        </label>
                        <textarea
                            name="observaciones"
                            id="edit_observaciones"
                            rows="3"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">
                <button
                    type="button"
                    id="cancelarModalEditarAnioRegulatorio"
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
<!-- MODAL EJECUCION MENSUAL -->
<div
    id="modalEjecucionMensual"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[85vh] flex flex-col">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    <span id="tituloModalEjecucion">
                        Ejecución Mensual
                    </span>
                    <span id="tituloAnio"></span>
                </h2>
                <p class="text-sm text-slate-500">
                    Registro de ejecución del año regulatorio
                </p>
            </div>
            <button
                type="button"
                id="cerrarModalEjecucionMensual"
                class="text-slate-400 hover:text-slate-600">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>
        <form
            id="formEjecucionMensual"
            method="POST"
            action="index.php?url=ejecucionmensual_store">
            <input
                type="hidden"
                name="idAnioRegulatorio"
                id="idAnioRegulatorio">
            <input
                type="hidden"
                name="idInversiones"
                id="idInversiones">
            <input
                type="hidden"
                name="idEjecucionMensual"
                id="idEjecucionMensual">
            <div class="p-6 shrink-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                    <!-- MES -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Mes
                        </label>
                        <select
                            name="mes"
                            id="mes"
                            required
                            class="w-full rounded-lg border px-4 py-2.5">
                            <option value="">Seleccionar</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                    <!-- PROGRAMADO 
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Programado
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="programado"
                            id="programado"
                            value="0"
                            class="w-full rounded-lg border px-4 py-2.5">
                    </div>-->
                    <!-- EJECUTADO -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Ejecutado
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="ejecutado"
                            id="ejecutado"
                            value="0"
                            class="w-full rounded-lg border px-4 py-2.5">
                    </div>
                    <!-- FISICO 
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Avance físico
                        </label>
                        <input
                            type="text"
                            name="fisico"
                            id="fisico"
                            placeholder="Ejemplo: 80%"
                            class="w-full rounded-lg border px-4 py-2.5">
                    </div>-->
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-slate-50">
                        <h3 class="text-sm font-semibold text-slate-700">
                            Ejecuciones Mensuales
                        </h3>
                    </div>
                    <div class="max-h-[350px] overflow-y-auto overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="sticky top-0 bg-white z-10 border-b">
                                <tr class="text-left text-slate-500">
                                    <th class="px-4 py-2 w-16 text-center">N°</th>
                                    <th class="px-4 py-2">Mes</th>
                                    <!-- <th class="px-4 py-3">Programado</th>
                                    <th class="px-4 py-3">Avance</th> -->
                                    <th class="px-4 py-2">Ejecutado</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaEjecucionesMensuales">
                                <!-- AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 px-6 py-3 bg-slate-50 shrink-0">
                <button
                    type="button"
                    id="cancelarModalEjecucionMensual"
                    class="px-5 py-2.5 border rounded-lg">
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg">
                    <i class="bi bi-save"></i>
                    <span id="textoGuardar">
                        Guardar
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL SEGUIMIENTO MENSUAL -->
<div
    id="modalSeguimientoMensual"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-xl w-full max-w-7xl max-h-[90vh] overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h2 class="text-xl font-bold text-slate-800">

                    <span id="tituloModalSeguimiento">
                        Seguimiento Mensual
                    </span>

                    <span id="tituloAnioSeguimiento"></span>

                </h2>

                <p class="text-sm text-slate-500">
                    Registro de seguimiento del año regulatorio
                </p>

            </div>

            <button
                type="button"
                id="cerrarModalSeguimiento"
                class="text-slate-400 hover:text-slate-600">

                <i class="bi bi-x-lg text-xl"></i>

            </button>

        </div>

        <form
            id="formSeguimientoMensual"
            method="POST"
            action="index.php?url=seguimientomensual_store">

            <input
                type="hidden"
                name="idAnioRegulatorio"
                id="idAnioRegulatorioSeguimiento">

            <input
                type="hidden"
                name="idInversiones"
                id="idInversionesSeguimiento">

            <input
                type="hidden"
                name="idSeguimientoMensual"
                id="idSeguimientoMensual">

            <div class="p-6 space-y-12">

                <!-- FORMULARIO -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <!-- PRODUCTO -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Producto
                        </label>

                        <input
                            type="text"
                            name="producto"
                            id="producto"
                            class="w-full rounded-lg border px-4 py-2.5"
                            placeholder="Ingrese el producto">
                    </div>


                    <!-- ESTADO -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Estado de la inversión
                        </label>

                        <input
                            type="text"
                            name="estadoInver"
                            id="estadoInver"
                            class="w-full rounded-lg border px-4 py-2.5"
                            placeholder="Ingrese el estado">
                    </div>


                    <!-- FECHA -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Fecha
                        </label>

                        <input
                            type="date"
                            name="fechas"
                            id="fechas"
                            class="w-full rounded-lg border px-4 py-2.5">
                    </div>


                    <!-- SITUACIÓN -->
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Situación
                        </label>

                        <input
                            type="text"
                            name="situacion"
                            id="situacion"
                            class="w-full rounded-lg border px-4 py-2.5"
                            placeholder="Ingrese la situación">
                    </div>


                    <!-- ACCIONES -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium mb-2">
                            Acciones
                        </label>

                        <textarea
                            name="acciones"
                            id="acciones"
                            rows="1"
                            class="w-full rounded-lg border px-4 py-2.5 resize-none"
                            placeholder="Describa las acciones realizadas..."></textarea>

                    </div>

                </div>


                <!-- TABLA -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200">

                    <div class="px-5 py-3 border-b bg-slate-50">

                        <h3 class="text-sm font-semibold text-slate-700">
                            Seguimientos Mensuales
                        </h3>

                    </div>


                    <div class="max-h-[260px] overflow-y-auto overflow-x-auto">

                        <table class="min-w-[900px] w-full text-sm">

                            <thead class="sticky top-0 bg-white border-b z-10">

                                <tr class="text-left text-slate-500">

                                    <th class="px-4 py-3 text-center w-16">
                                        N°
                                    </th>

                                    <th class="px-4 py-3">
                                        Producto
                                    </th>

                                    <th class="px-4 py-3">
                                        Estado
                                    </th>

                                    <th class="px-4 py-3">
                                        Acción
                                    </th>

                                    <th class="px-10 py-3">
                                        Fecha
                                    </th>

                                    <th class="px-4 py-3">
                                        Situación
                                    </th>

                                    <th class="px-4 py-3 text-center">
                                        Acciones
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="listaSeguimientosMensuales">

                            </tbody>


                        </table>

                    </div>

                </div>

            </div>

            <div class="flex justify-end gap-3 px-6 py-3 bg-slate-50">

                <button
                    type="button"
                    id="cancelarModalSeguimiento"
                    class="px-5 py-2.5 border rounded-lg">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg">

                    <i class="bi bi-save"></i>

                    <span id="textoGuardarSeguimiento">
                        Guardar
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>

<?php
$titulo = "Años Regulatorios";
$js = "anioregulatorio.js";
?>