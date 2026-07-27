<div class="bg-white rounded-2xl shadow-md border border-slate-200">
    <!-- Cabecera del filtro -->
    <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100">
                <i class="bi bi-funnel-fill text-blue-600 text-lg"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Filtros de Consulta
                </h2>
                <p class="text-sm text-slate-500">
                    Seleccione los criterios para visualizar la información de la inversión.
                </p>
            </div>
        </div>
    </div>
    <form
        action="index.php"
        method="GET"
        class="p-6">
        <input
            type="hidden"
            name="url"
            value="dashboardInversion">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 items-end">
            <!-- Estudio Tarifario -->
            <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">
                    <i class="bi bi-file-earmark-text text-blue-600"></i>
                    Estudio Tarifario
                </label>
                <select
                    name="idEstudioTarifario"
                    id="filtroEstudio"
                    onchange="
                        document.getElementById('filtroFondo').value='';
                        document.getElementById('filtroInversion').value='';
                        this.form.submit();
                    "
                    class="tom-select w-full rounded-xl border-slate-300 bg-white focus:border-blue-500 focus:ring-blue-500 transition">
                    <option value="">
                        Todas
                    </option>
                    <?php foreach ($estudios as $est): ?>
                        <option
                            value="<?= $est['idEstudioTarifario'] ?>"
                            <?= ($idEstudioTarifario == $est['idEstudioTarifario']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($est['nombre']) ?>
                            (<?= $est['anioInicio'] ?> - <?= $est['anioFin'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Fondo -->
            <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">
                    <i class="bi bi-wallet2 text-emerald-600"></i>
                    Fondo
                </label>
                <select
                    name="idFondo"
                    id="filtroFondo"
                    onchange="
                        document.getElementById('filtroInversion').value='';
                        this.form.submit();
                    "
                    class="tom-select w-full rounded-xl border-slate-300 bg-white focus:border-blue-500 focus:ring-blue-500 transition"
                    >
                    <option value="">
                        Todas
                    </option>
                    <?php foreach ($fondos as $fondo): ?>
                        <option
                            value="<?= $fondo['idFondos'] ?>"
                            <?= ($idFondo == $fondo['idFondos']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($fondo['nombreFondo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Inversión -->
            <div class="lg:col-span-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">
                    <i class="bi bi-building text-purple-600"></i>
                    Inversión
                </label>
                <select
                    name="idInversiones"
                    id="filtroInversion"
                    class="tom-select w-full rounded-xl border-slate-300 bg-white focus:border-blue-500 focus:ring-blue-500 transition"
                    >
                    <option value="">
                        Todas
                    </option>
                    <?php foreach ($inversiones as $inv): ?>
                        <option
                            value="<?= $inv['idInversiones'] ?>"
                            <?= ($idInversion == $inv['idInversiones']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($inv['descripcion']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Botón -->
            <!-- Botones -->
            <div class="flex gap-3">
                <button
                    type="submit"
                    class="flex-1 h-11 inline-flex items-center justify-center gap-2 rounded-xl 
                        bg-gradient-to-r from-blue-600 to-blue-700 
                        text-white font-semibold shadow-md 
                        hover:shadow-lg transition">
                    <i class="bi bi-search"></i>
                    Consultar
                </button>
                <a
                    href="index.php?url=dashboardInversion"
                    class="flex-1 h-11 inline-flex items-center justify-center gap-2 rounded-xl
                        border border-slate-300
                        bg-white
                        text-slate-700
                        font-semibold
                        hover:bg-slate-50
                        transition">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Limpiar
                </a>
            </div>
        </div>
    </form>
</div>