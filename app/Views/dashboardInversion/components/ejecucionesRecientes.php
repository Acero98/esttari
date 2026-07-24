<div class="bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden mt-6">
    <!-- Cabecera -->
    <div class="px-6 py-5 bg-gradient-to-r from-emerald-50 to-green-50 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center">
                <i class="bi bi-cash-coin text-emerald-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Ejecuciones Recientes
                </h2>
                <p class="text-sm text-slate-500">
                    Últimos movimientos de ejecución financiera registrados.
                </p>
            </div>
        </div>
    </div>
    <!-- Tabla -->
    <div class="p-6">
        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold">
                            N°
                        </th>
                        <th class="px-4 py-3 text-center font-semibold">
                            Año
                        </th>
                        <th class="px-4 py-3 text-left font-semibold">
                            Fecha
                        </th>
                        <th class="px-4 py-3 text-right font-semibold">
                            Monto Ejecutado
                        </th>
                        <!-- <th class="px-4 py-3 text-right font-semibold">
                            Comprobante
                        </th>-->
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (!empty($ejecucionesRecientes)): ?>
                        <?php foreach ($ejecucionesRecientes as $index => $item): ?>
                            <tr class="hover:bg-emerald-50 transition">

                                <!-- N° -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-100 text-slate-700 font-semibold">
                                        <?= $index + 1 ?>
                                    </span>
                                </td>

                                <!-- Año -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                        <?= htmlspecialchars($item['anio']) ?>
                                    </span>
                                </td>

                                <!-- Fecha -->
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2 text-slate-700">
                                        <i class="bi bi-calendar-event text-emerald-500"></i>
                                        <?= date('d/m/Y', strtotime($item['mes'])) ?>
                                    </div>
                                </td>

                                <!-- Total -->
                                <td class="px-4 py-3 text-right">
                                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-100 text-emerald-700 font-bold">
                                        <i class="bi bi-cash-stack"></i>
                                        S/ <?= number_format($item['total'], 2) ?>
                                    </span>
                                </td>
                                <!--<td class="px-4 py-3 text-center">
                                    <php if (!empty($item['archivo'])): ?>
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                            PDF
                                        </span>
                                    <php else: ?>
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs">
                                            <i class="bi bi-dash-circle"></i>
                                            Sin archivo
                                        </span>
                                    <php endif; ?>
                                </td>-->

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500">
                                <i class="bi bi-info-circle mr-2"></i>
                                No existen ejecuciones registradas.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>