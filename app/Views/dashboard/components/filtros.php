<form method="GET">
    <input type="hidden" name="url" value="dashboard">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
        <!-- Cabecera filtros -->
        <div class="flex items-center gap-3 mb-5">
            <div class="bg-slate-100 rounded-lg p-3">
                <i class="bi bi-funnel text-xl text-slate-600"></i>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Filtros de análisis
                </h2>
                <p class="text-sm text-slate-500">
                    Seleccione los criterios para actualizar los indicadores
                </p>
            </div>
        </div>

        <div class="
        grid 
        grid-cols-1 
        md:grid-cols-2 
        xl:grid-cols-4 
        gap-5
        ">
            <!-- Estudio Tarifario -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Estudio Tarifario
                </label>

                <select
                    id="filtroEstudio"
                    name="estudio"
                    class="
                    w-full
                    rounded-xl
                    border-slate-300
                    px-4
                    py-2.5
                    focus:ring-2
                    focus:ring-blue-500
                    ">

                    <option value="">
                        Todos
                    </option>

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
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Año
                </label>

                <select id="filtroAnio"
                    name="anio"
                    <?= empty($filtrosActivos['estudio']) ? 'disabled' : '' ?>
                    class="
                        w-full
                        rounded-xl
                        border-slate-300
                        px-4
                        py-2.5
                        focus:ring-2
                        focus:ring-blue-500
                        ">

                    <option value="">
                        Todos
                    </option>

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
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Fondo
                </label>

                <select id="filtroFondo"
                    name="fondo"
                    <?= empty($filtrosActivos['anio']) ? 'disabled' : '' ?>
                    class="
                        w-full
                        rounded-xl
                        border-slate-300
                        px-4
                        py-2.5
                        focus:ring-2
                        focus:ring-blue-500
                        ">

                    <option value="">
                        Todos
                    </option>

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
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Área responsable
                </label>

                <select id="filtroArea"
                    name="area"
                    <?= empty($filtrosActivos['fondo']) ? 'disabled' : '' ?>
                    class="
                w-full
                rounded-xl
                border-slate-300
                px-4
                py-2.5
                focus:ring-2
                focus:ring-blue-500
                ">

                    <option value="">
                        Todas
                    </option>

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
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Inversión
                </label>
                <select id="filtroInversion"
                    name="inversion"
                    <?= empty($filtrosActivos['area']) ? 'disabled' : '' ?>
                    class="
                w-full
                rounded-xl
                border-slate-300
                px-4
                py-2.5
                focus:ring-2
                focus:ring-blue-500
                ">
                    <option value="">
                        Todas
                    </option>

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



        <!-- Botón limpiar -->

        <div class="mt-5 flex justify-end gap-3">

            <button type="submit"
                class="
                inline-flex
                items-center
                gap-2
                px-4
                py-2
                rounded-xl
                bg-blue-600
                hover:bg-blue-700
                text-white
                text-sm
                font-medium
                ">

                <i class="bi bi-funnel"></i>

                Aplicar filtros

            </button>


            <button type="button"
                id="limpiarFiltros"
                class="
                inline-flex
                items-center
                gap-2
                px-4
                py-2
                rounded-xl
                bg-slate-100
                hover:bg-slate-200
                text-slate-700
                text-sm
                font-medium
                ">

                <i class="bi bi-arrow-counterclockwise"></i>

                Limpiar filtros

            </button>

        </div>



    </div>
</form>