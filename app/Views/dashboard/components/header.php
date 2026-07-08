<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Dashboard Ejecutivo
            </h1>
            <p class="text-slate-500 mt-1">
                Bienvenido <?= $_SESSION['nombres']; ?>
            </p>
        </div>

        <div class="text-right">
            <p class="text-sm text-slate-500">
                <?= date('d/m/Y'); ?>
            </p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

    <div class="grid grid-cols-4 gap-4">

        <!-- Programa -->
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
                Programa
            </label>

            <select id="filtroPrograma"
                class="w-full rounded-xl border border-slate-300 px-4 py-2">

                <option value="">Todos</option>

                <?php foreach ($filtros['programas'] as $programa): ?>

                    <option value="<?= $programa['idInversiones']; ?>">
                        <?= $programa['nombre']; ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- Oficina -->
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
                Oficina
            </label>

            <select id="filtroArea"
                class="w-full rounded-xl border border-slate-300 px-4 py-2">

                <option value="">Todas</option>

                <?php foreach ($filtros['areas'] as $area): ?>

                    <option value="<?= $area['idAreas']; ?>">
                        <?= $area['nombreArea']; ?>
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
                class="w-full rounded-xl border border-slate-300 px-4 py-2">

                <option value="">Todos</option>

                <?php foreach ($filtros['fondos'] as $fondo): ?>

                    <option value="<?= $fondo['idFondos']; ?>">
                        <?= $fondo['nombre']; ?>
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
                class="w-full rounded-xl border border-slate-300 px-4 py-2">

                <option value="">Todos</option>

                <?php foreach ($filtros['anios'] as $anio): ?>

                    <option value="<?= $anio['anio']; ?>">
                        <?= $anio['anio']; ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

    </div>

</div>

<div class="space-y-8">

    <!-- Título -->
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Resumen General
        </h1>

        <p class="text-sm text-slate-500">
            Panel principal del sistema
        </p>
    </div>

</div>