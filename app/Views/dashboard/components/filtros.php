<form method="GET">

    <input type="hidden" name="url" value="dashboard">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

        <!-- Cabecera -->
        <div class="flex items-start justify-between mb-6">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <i class="bi bi-funnel text-blue-600 text-xl"></i>
                </div>

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        Filtros de análisis
                    </h2>

                    <p class="text-sm text-slate-500">
                        Los indicadores se actualizan automáticamente al seleccionar un filtro.
                    </p>

                </div>

            </div>

            <button
                type="button"
                id="limpiarFiltros"
                class="
                    inline-flex
                    items-center
                    gap-2
                    px-4
                    py-2
                    rounded-xl
                    border
                    border-slate-300
                    bg-white
                    hover:bg-slate-100
                    text-slate-700
                    text-sm
                    font-medium
                    transition
                ">

                <i class="bi bi-arrow-clockwise"></i>

                Limpiar

            </button>

        </div>

        <!-- Filtros -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5">

            <!-- Estudio Tarifario -->

            <div>

                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">

                    <span class="
                                w-8 h-8
                                rounded-lg
                                bg-blue-100
                                text-blue-700
                                flex
                                items-center
                                justify-center">

                        <i class="bi bi-journal-bookmark"></i>

                    </span>

                    Estudio Tarifario

                </label>

                <select
                    id="filtroEstudio"
                    name="estudio"
                    class="w-full rounded-xl border-slate-300 px-4 py-2.5
                    focus:ring-2 focus:ring-blue-500
                    disabled:bg-slate-100
                    disabled:text-slate-400
                    disabled:cursor-not-allowed">

                    <option value="">Todos</option>

                    <?php foreach ($filtros['estudios'] as $estudio): ?>

                        <option
                            value="<?= $estudio['idEstudioTarifario']; ?>"
                            <?= ($filtrosActivos['estudio'] == $estudio['idEstudioTarifario']) ? 'selected' : '' ?>>

                            <?= $estudio['codigo']; ?> - <?= $estudio['nombre']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Año -->

            <div>

                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">

                    <span class="
                                w-8 h-8
                                rounded-lg
                                bg-emerald-100
                                text-emerald-700
                                flex
                                items-center
                                justify-center">

                        <i class="bi bi-calendar3"></i>

                    </span>

                    Año

                </label>

                <select
                    id="filtroAnio"
                    name="anio"
                    <?= empty($filtrosActivos['estudio']) ? 'disabled' : '' ?>
                    class="w-full rounded-xl border-slate-300 px-4 py-2.5
                    focus:ring-2 focus:ring-blue-500
                    disabled:bg-slate-100
                    disabled:text-slate-400
                    disabled:cursor-not-allowed">

                    <option value="">Todos</option>

                    <?php foreach ($filtros['anios'] as $anio): ?>

                        <option
                            value="<?= $anio['anio']; ?>"
                            <?= ($filtrosActivos['anio'] == $anio['anio']) ? 'selected' : '' ?>>

                            <?= $anio['anio']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Fondo -->

            <div>

                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">

                    <span class="
                                w-8 h-8
                                rounded-lg
                                bg-amber-100
                                text-amber-700
                                flex
                                items-center
                                justify-center">

                        <i class="bi bi-cash-stack"></i>

                    </span>

                    Fondo

                </label>

                <select
                    id="filtroFondo"
                    name="fondo"
                    <?= empty($filtrosActivos['anio']) ? 'disabled' : '' ?>
                    class="w-full rounded-xl border-slate-300 px-4 py-2.5
                    focus:ring-2 focus:ring-blue-500
                    disabled:bg-slate-100
                    disabled:text-slate-400
                    disabled:cursor-not-allowed">

                    <option value="">Todos</option>

                    <?php foreach ($filtros['fondos'] as $fondo): ?>

                        <option
                            value="<?= $fondo['idFondos']; ?>"
                            <?= ($filtrosActivos['fondo'] == $fondo['idFondos']) ? 'selected' : '' ?>>

                            <?= $fondo['nombre']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Área -->

            <div>

                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">

                    <span class="
                                w-8 h-8
                                rounded-lg
                                bg-violet-100
                                text-purple-700
                                flex
                                items-center
                                justify-center">

                        <i class="bi bi-building"></i>

                    </span>

                    Área

                </label>

                <select
                    id="filtroArea"
                    name="area"
                    <?= empty($filtrosActivos['fondo']) ? 'disabled' : '' ?>
                    class="w-full rounded-xl border-slate-300 px-4 py-2.5
                    focus:ring-2 focus:ring-blue-500
                    disabled:bg-slate-100
                    disabled:text-slate-400
                    disabled:cursor-not-allowed">

                    <option value="">Todas</option>

                    <?php foreach ($filtros['areas'] as $area): ?>

                        <option
                            value="<?= $area['idAreas']; ?>"
                            <?= ($filtrosActivos['area'] == $area['idAreas']) ? 'selected' : '' ?>>

                            <?= $area['nombreArea']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Inversión -->

            <div>

                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">

                    <span class="
                                w-8 h-8
                                rounded-lg
                                bg-cyan-100
                                text-cyan-700
                                flex
                                items-center
                                justify-center">

                        <i class="bi bi-diagram-3"></i>

                    </span>

                    Inversión

                </label>

                <select
                    id="filtroInversion"
                    name="inversion"
                    <?= empty($filtrosActivos['area']) ? 'disabled' : '' ?>
                    class="w-full rounded-xl border-slate-300 px-4 py-2.5
                    focus:ring-2 focus:ring-blue-500
                    disabled:bg-slate-100
                    disabled:text-slate-400
                    disabled:cursor-not-allowed">

                    <option value="">Todas</option>

                    <?php foreach ($filtros['inversiones'] as $inversion): ?>

                        <option
                            value="<?= $inversion['idInversiones']; ?>"
                            <?= ($filtrosActivos['inversion'] == $inversion['idInversiones']) ? 'selected' : '' ?>>

                            <?= $inversion['descripcion']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

    </div>

</form>