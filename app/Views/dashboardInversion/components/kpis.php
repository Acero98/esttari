<!-- KPIs Financieros -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
    <!-- Programado -->
    <div class="group bg-blue-50 border border-blue-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-blue-600 flex items-center gap-2">
                    <i class="bi bi-calendar-check"></i>
                    Programado
                </p>
                <h3 class="mt-3 text-3xl font-extrabold text-slate-800">
                    S/ <?= number_format($totales['programado'], 2) ?>
                </h3>
                <p class="mt-2 text-xs text-slate-500">
                    Presupuesto planificado
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                <i class="bi bi-calendar-check text-3xl text-blue-600"></i>
            </div>
        </div>
    </div>
    <!-- Ejecutado -->
    <div class="group bg-emerald-50 border border-emerald-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-emerald-600 flex items-center gap-2">
                    <i class="bi bi-check-circle"></i>
                    Ejecutado
                </p>
                <h3 class="mt-3 text-3xl font-extrabold text-slate-800">
                    S/ <?= number_format($totales['total'], 2) ?>
                </h3>
                <p class="mt-2 text-xs text-slate-500">
                    Ejecución acumulada
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                <i class="bi bi-graph-up-arrow text-3xl text-emerald-600"></i>
            </div>
        </div>
    </div>
    <!-- Saldo -->
    <div class="group bg-rose-50 border border-rose-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-rose-600 flex items-center gap-2">
                    <i class="bi bi-hourglass-split"></i>
                    Saldo Pendiente
                </p>
                <h3 class="mt-3 text-3xl font-extrabold text-slate-800">
                    S/ <?= number_format($totales['saldo'], 2) ?>
                </h3>
                <p class="mt-2 text-xs text-slate-500">
                    Monto por ejecutar
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-rose-100 flex items-center justify-center">
                <i class="bi bi-hourglass-split text-3xl text-rose-600"></i>
            </div>
        </div>
    </div>
    <!-- PIM -->
    <div class="group bg-purple-50 border border-purple-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-purple-600 flex items-center gap-2">
                    <i class="bi bi-wallet2"></i>
                    PIM
                </p>
                <h3 class="mt-3 text-3xl font-extrabold text-slate-800">
                    S/ <?= number_format($totales['pim'], 2) ?>
                </h3>
                <p class="mt-2 text-xs text-slate-500">
                    Presupuesto actualizado
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center">
                <i class="bi bi-wallet-fill text-3xl text-purple-600"></i>
            </div>
        </div>
    </div>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Cabecera -->
    <div class="px-6 py-5 bg-blue-50 border-b border-blue-100">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                <i class="bi bi-bar-chart-line-fill text-xl text-blue-600"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Resumen por Año Regulatorio
                </h2>
                <p class="text-sm text-slate-500">
                    Evolución financiera y física de la inversión.
                </p>
            </div>
        </div>
    </div>
    <!-- Tabla -->
    <div class="p-5">
        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold">N°</th>
                        <th class="px-4 py-3 text-center font-semibold">Año</th>
                        <th class="px-4 py-3 text-right font-semibold">Programado</th>
                        <th class="px-4 py-3 text-right font-semibold">Ejecutado</th>
                        <th class="px-4 py-3 text-right font-semibold">Saldo</th>
                        <th class="px-4 py-3 text-right font-semibold">PIM</th>
                        <th class="px-4 py-3 text-center font-semibold">Avance Físico</th>
                        <th class="px-4 py-3 text-center font-semibold">Avance Financiero</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    <?php if (!empty($resumenAnios)): ?>

                        <?php foreach ($resumenAnios as $index => $fila): ?>

                            <tr class="hover:bg-blue-50 transition">

                                <!-- N° -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-100 text-slate-700 font-semibold">
                                        <?= $index + 1 ?>
                                    </span>
                                </td>

                                <!-- Año -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                        <i class="bi bi-calendar3"></i>
                                        <?= $fila['anio'] ?>
                                    </span>
                                </td>

                                <!-- Programado -->
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <i class="bi bi-cash-stack text-sky-500"></i>
                                        <span class="font-semibold text-slate-700">
                                            S/ <?= number_format($fila['programado'], 2) ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Ejecutado -->
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <i class="bi bi-cash-stack text-emerald-500"></i>
                                        <span class="font-bold text-emerald-600">
                                            <?= $fila['total'] > 0
                                                ? 'S/ ' . number_format($fila['total'], 2)
                                                : '-' ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Saldo -->
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <i class="bi bi-piggy-bank text-rose-500"></i>
                                        <span class="font-bold text-rose-600">
                                            S/ <?= number_format($fila['saldo'], 2) ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- PIM -->
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <i class="bi bi-cash-stack text-violet-500"></i>
                                        <span class="font-semibold text-violet-700">
                                            <?= $fila['pim'] > 0
                                                ? 'S/ ' . number_format($fila['pim'], 2)
                                                : '-' ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Avance Físico -->
                                <td class="px-4 py-3 text-center">
                                    <?php
                                    $fisico = $fila['avanceFisico'] ?? 0;

                                    if ($fisico >= 80) {
                                        $color = "bg-emerald-100 text-emerald-700";
                                    } elseif ($fisico >= 50) {
                                        $color = "bg-amber-100 text-amber-700";
                                    } else {
                                        $color = "bg-rose-100 text-rose-700";
                                    }
                                    ?>

                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold <?= $color ?>">
                                        <?= $fila['avanceFisico'] !== ''
                                            ? $fila['avanceFisico'] . '%'
                                            : '-' ?>
                                    </span>
                                </td>

                                <!-- Avance Financiero -->
                                <td class="px-4 py-3 text-center">

                                    <?php
                                    $financiero = $fila['avanceFinanciero'] ?? 0;

                                    if ($financiero >= 80) {
                                        $color = "bg-emerald-100 text-emerald-700";
                                    } elseif ($financiero >= 50) {
                                        $color = "bg-amber-100 text-amber-700";
                                    } else {
                                        $color = "bg-rose-100 text-rose-700";
                                    }
                                    ?>

                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold <?= $color ?>">
                                        <?= isset($fila['avanceFinanciero'])
                                            ? number_format($fila['avanceFinanciero'], 2) . '%'
                                            : '-' ?>
                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-slate-500">

                                <div class="flex flex-col items-center gap-3">

                                    <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center">
                                        <i class="bi bi-calendar-x text-2xl text-slate-400"></i>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-slate-600">
                                            No existen años regulatorios registrados.
                                        </p>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Registre un año regulatorio para visualizar el resumen financiero.
                                        </p>
                                    </div>

                                </div>

                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>