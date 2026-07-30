<div class="space-y-4">
    <!-- Título 
    <div class="bg-white rounded-xl shadow-sm p-5">
        <div class="flex items-center gap-3">
            <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                <i class="bi bi-bar-chart-fill text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Estado General de Inversiones
                </h2>
                <p class="text-sm text-gray-500">
                    Información consolidada de las inversiones asignadas.
                </p>
            </div>
        </div>
    </div>-->
    <!-- Resumen -->
    <?php
    $totalProgramado = 0;
    $totalEjecutado = 0;
    $totalSaldo = 0;
    foreach ($datosReporte as $item) {
        $totalProgramado += $item["programado"];
        $totalEjecutado += $item["ejecutado"];
        $totalSaldo += $item["saldo"];
    }
    $avanceFinanciero = 0;
    if ($totalProgramado > 0) {
        $avanceFinanciero =
            ($totalEjecutado / $totalProgramado) * 100;
    }
    ?>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Programado -->
        <div class="bg-blue-50 rounded-xl p-4">
            <div class="text-sm text-blue-600">
                Total Programado
            </div>
            <div class="text-2xl font-bold text-gray-800">
                S/<?= number_format($totales["programado"], 2) ?>
            </div>
        </div>
        <!-- Ejecutado -->
        <div class="bg-emerald-50 rounded-xl p-4">
            <div class="text-sm text-emerald-600">
                Total Ejecutado
            </div>
            <div class="text-2xl font-bold text-gray-800">
                S/<?= number_format($totales["ejecutado"], 2) ?>
            </div>
        </div>
        <!-- Saldo -->
        <div class="bg-amber-50 rounded-xl p-4">
            <div class="text-sm text-amber-600">
                Saldo Pendiente
            </div>
            <div class="text-2xl font-bold text-gray-800">
                S/<?= number_format($totales["saldo"], 2) ?>
            </div>
        </div>
        <!-- RDR -->
        <div class="bg-cyan-50 rounded-xl p-4">
            <div class="text-sm text-cyan-600">
                RDR
            </div>
            <div class="text-2xl font-bold text-gray-800">
                S/<?= number_format($totales["rdr"], 2) ?>
            </div>
        </div>
        <!-- E.T -->
        <div class="bg-indigo-50 rounded-xl p-4">
            <div class="text-sm text-indigo-600">
                E.T.
            </div>
            <div class="text-2xl font-bold text-gray-800">
                S/<?= number_format($totales["et"], 2) ?>
            </div>
        </div>
        <!-- PIM -->
        <div class="bg-pink-50 rounded-xl p-4">
            <div class="text-sm text-pink-600">
                PIM
            </div>
            <div class="text-2xl font-bold text-gray-800">
                S/<?= number_format($totales["pim"], 2) ?>
            </div>
        </div>
    </div>
    <?php if ($buscar): ?>
        <!-- Tabla -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex justify-end gap-3 mb-4">
                <?php
                $params = $_GET;
                $params["accion"] = "excelEjecutivo";
                ?>

                <a href="index.php?<?= http_build_query($params) ?>"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                    bg-emerald-50 text-emerald-700 border border-emerald-200
                    hover:bg-emerald-100 hover:border-emerald-300
                    transition-all duration-200 shadow-sm text-sm font-medium">

                    <i class="bi bi-file-earmark-excel text-base"></i>
                    Excel Ejecutivo

                </a>

                <!-- 
            <php
            //$params = $_GET;
            //$params["accion"] = "excel";
            ?>
            
            <a href="index.php?<= http_build_query($params) ?>"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                    bg-emerald-50 text-emerald-700 border border-emerald-200
                    hover:bg-emerald-100 hover:border-emerald-300
                    transition-all duration-200 shadow-sm text-sm font-medium">

                <i class="bi bi-file-earmark-excel text-base"></i>
                Excel

            </a> -->

                <?php
                $params = $_GET;
                $params["accion"] = "pdf";
                ?>

                <a href="index.php?<?= http_build_query($params) ?>"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                    bg-red-50 text-red-700 border border-red-200
                    hover:bg-red-100 hover:border-red-300
                    transition-all duration-200 shadow-sm text-sm font-medium">

                    <i class="bi bi-file-earmark-pdf text-base"></i>
                    PDF

                </a>

                <button
                    onclick="imprimirTabla()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                    bg-slate-50 text-slate-700 border border-slate-200
                    hover:bg-slate-100 hover:border-slate-300
                    transition-all duration-200 shadow-sm text-sm font-medium">

                    <i class="bi bi-printer text-base"></i>
                    Imprimir

                </button>
            </div>
            <div class="overflow-x-auto max-w-full">
                <table
                    id="tablaEstadoGeneral"
                    class="min-w-[1800px] text-sm">
                    <thead class="sticky top-0 bg-gray-100 z-10">
                        <tr>
                            <th class="sticky left-0 bg-gray-100 z-30 w-12">#</th>
                            <th class="sticky left-10 bg-gray-100 z-20 min-w-[350px]">Inversión</th>
                            <th class="px-4 py-3 text-left">Área</th>
                            <th class="px-4 py-3 text-left">Fondo</th>
                            <th class="px-4 py-3 text-center">Año</th>
                            <th class="px-4 py-3 text-right">Programado</th>
                            <th class="px-4 py-3 text-right">Ejecutado</th>
                            <th class="px-4 py-3 text-right">Saldo</th>
                            <th class="px-4 py-3 text-right">RDR</th>
                            <th class="px-4 py-3 text-right">E.T.</th>
                            <th class="px-4 py-3 text-right">PIM</th>
                            <!-- <th class="px-4 py-3 text-right">Ejec. Acum.</th>
                        <th class="px-4 py-3 text-right">Saldo Acum.</th> -->
                            <th class="px-4 py-3 text-right">Av. Físico</th>
                            <th class="px-4 py-3 text-right">Av. Financiero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($datosReporte)): ?>
                            <?php
                            $numero = 1;
                            $totalProgramado = 0;
                            $totalEjecutado = 0;
                            $totalSaldo = 0;
                            $totalRdr = 0;
                            $totalEt = 0;
                            $totalPim = 0;
                            $totalEjecucionAcumulada = 0;
                            $totalSaldoAcumulado = 0;
                            ?>
                            <?php foreach ($datosReporte as $item): ?>
                                <?php
                                $totalProgramado += $item["programado"];
                                $totalEjecutado += $item["ejecutado"];
                                $totalSaldo += $item["saldo"];
                                $totalRdr += $item["rdr"];
                                $totalEt += $item["et"];
                                $totalPim += $item["pim"];
                                $totalEjecucionAcumulada +=
                                    $item["ejecucionAcumulada"];
                                $totalSaldoAcumulado +=
                                    $item["saldoAcumulado"];
                                ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="sticky left-0 bg-white z-10 text-center"><?= $numero++ ?></td>
                                    <td class="sticky left-10 bg-white z-10 min-w-[350px]"><?= $item["descripcion"] ?></td>
                                    <td class="px-4 py-3"><?= $item["siglasArea"] ?></td>
                                    <td class="px-4 py-3"><?= $item["codigoFondo"] ?></td>
                                    <td class="px-4 py-3"><?= $item["anio"] ?></td>
                                    <th class="px-4 py-3 text-right min-w-[150px]">S/<?= number_format($item["programado"], 2) ?></td>
                                    <th class="px-4 py-3 text-right min-w-[150px]">S/<?= number_format($item["ejecutado"], 2) ?></td>
                                    <th class="px-4 py-3 text-right min-w-[150px]">S/<?= number_format($item["saldo"], 2) ?></td>
                                    <th class="px-4 py-3 text-right min-w-[150px]">S/<?= number_format($item["rdr"], 2) ?></td>
                                    <th class="px-4 py-3 text-right min-w-[150px]">S/<?= number_format($item["et"], 2) ?></td>
                                    <th class="px-4 py-3 text-right min-w-[150px]">S/<?= number_format($item["pim"], 2) ?></td>
                                        <!--
                                <th class="px-4 py-3 text-right min-w-[150px]">S/<= number_format($item["ejecucionAcumulada"],2) ?></td>                                
                                <th class="px-4 py-3 text-right min-w-[150px]">S/<= number_format($item["saldoAcumulado"],2) ?></td> -->
                                    <td class="px-4 py-3 text-center min-w-[120px]"><?= $item["avanceFisico"] ?> %</td>
                                    <td class="px-4 py-3 text-center min-w-[120px]"><?= number_format($item["avanceFinanciero"], 2) ?> %</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-gray-500">
                                    No existen datos para mostrar.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="bg-slate-100 font-semibold border-t-2 border-slate-300">
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-right">TOTAL GENERAL</td>
                            <td class="px-4 py-3 text-right">S/<?= number_format($totales["programado"], 2) ?></td>
                            <td class="px-4 py-3 text-right">S/<?= number_format($totales["ejecutado"], 2) ?></td>
                            <td class="px-4 py-3 text-right">S/<?= number_format($totales["saldo"], 2) ?></td>
                            <td class="px-4 py-3 text-right">S/<?= number_format($totales["rdr"], 2) ?></td>
                            <td class="px-4 py-3 text-right">S/<?= number_format($totales["et"], 2) ?></td>
                            <td class="px-4 py-3 text-right">S/<?= number_format($totales["pim"], 2) ?></td>
                            <!--
                        <td class="px-4 py-3 text-right">S/<= number_format($totales["ejecucionAcumulada"], 2) ?></td>
                        <td class="px-4 py-3 text-right">S/<= number_format($totales["saldoAcumulado"], 2) ?></td> -->
                            <td class="px-4 py-3 text-center"><?= number_format($totales["avanceFisico"], 2) ?> %</td>
                            <td class="px-4 py-3 text-center"><?= number_format($totales["avanceFinanciero"], 2) ?> %</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php else: ?>

        <div class="bg-white rounded-xl shadow-sm p-10 text-center">
            <i class="bi bi-search text-4xl text-slate-400"></i>

            <p class="mt-3 text-gray-500">
                Seleccione los filtros y presione <strong>Buscar</strong>.
            </p>
        </div>

    <?php endif; ?>
</div>