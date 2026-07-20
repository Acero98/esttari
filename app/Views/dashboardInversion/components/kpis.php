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


                        <th class="px-4 py-3 text-left font-semibold">
                            Año
                        </th>


                        <th class="px-4 py-3 text-right font-semibold">
                            Programado
                        </th>


                        <th class="px-4 py-3 text-right font-semibold">
                            Ejecutado
                        </th>


                        <th class="px-4 py-3 text-right font-semibold">
                            Saldo
                        </th>


                        <th class="px-4 py-3 text-right font-semibold">
                            PIM
                        </th>


                        <th class="px-4 py-3 text-right font-semibold">
                            Avance Físico
                        </th>


                        <th class="px-4 py-3 text-right font-semibold">
                            Avance Financiero
                        </th>


                    </tr>


                </thead>



                <tbody class="divide-y divide-slate-100">


                    <?php foreach ($resumenAnios as $fila): ?>


                        <tr class="hover:bg-blue-50 transition">


                            <!-- Año -->
                            <td class="px-4 py-3">


                                <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold text-xs">


                                    <?= $fila['anio'] ?>


                                </span>


                            </td>



                            <!-- Programado -->
                            <td class="px-4 py-3 text-right font-medium text-slate-700">


                                S/
                                <?= number_format($fila['programado'], 2) ?>


                            </td>



                            <!-- Ejecutado -->
                            <td class="px-4 py-3 text-right">


                                <span class="font-semibold text-emerald-600">


                                    S/
                                    <?= $fila['total'] > 0
                                        ? number_format($fila['total'], 2)
                                        : '-'
                                    ?>


                                </span>


                            </td>



                            <!-- Saldo -->
                            <td class="px-4 py-3 text-right">


                                <span class="font-semibold text-rose-600">


                                    S/
                                    <?= number_format($fila['saldo'], 2) ?>


                                </span>


                            </td>



                            <!-- PIM -->
                            <td class="px-4 py-3 text-right">


                                <span class="font-semibold text-purple-600">


                                    <?= $fila['pim'] > 0
                                        ? 'S/ ' . number_format($fila['pim'], 2)
                                        : '-'
                                    ?>


                                </span>


                            </td>



                            <!-- Avance físico -->
                            <td class="px-4 py-3 text-right">


                                <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-xs">


                                    <?= isset($fila['avanceFisico']) &&
                                        $fila['avanceFisico'] !== ''
                                        ? $fila['avanceFisico'] . '%'
                                        : '-'
                                    ?>


                                </span>


                            </td>



                            <!-- Avance financiero -->
                            <td class="px-4 py-3 text-right">


                                <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold text-xs">


                                    <?= isset($fila['avanceFinanciero'])
                                        ? number_format($fila['avanceFinanciero'], 2) . '%'
                                        : '-'
                                    ?>


                                </span>


                            </td>



                        </tr>


                    <?php endforeach; ?>


                </tbody>


            </table>


        </div>


    </div>


</div>