<div class="bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden mt-6">
    <!-- Cabecera -->
    <div class="px-6 py-5 bg-gradient-to-r from-amber-50 to-orange-50 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-amber-100 flex items-center justify-center">
                <i class="bi bi-clipboard-data text-amber-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Últimos Seguimientos
                </h2>
                <p class="text-sm text-slate-500">
                    Estado actualizado de los hitos y situación de la inversión.
                </p>
            </div>
        </div>
    </div>
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
                            Estado Inv.
                        </th>
                        <th class="px-4 py-3 text-left font-semibold">
                            Hitos
                        </th>
                        <th class="px-4 py-3 text-center font-semibold">
                            Fecha
                        </th>
                        <th class="px-4 py-3 text-left font-semibold">
                            Situación
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (!empty($ultimoSeguimiento)): ?>
                        <?php foreach ($ultimoSeguimiento as $i => $item): ?>
                            <tr class="hover:bg-amber-50 transition">
                                <!-- N° -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-100 text-slate-700 font-semibold">
                                        <?= $i + 1 ?>
                                    </span>
                                </td>
                                <!-- Año -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                        <?= htmlspecialchars($item["anio"]) ?>
                                    </span>
                                </td>
                                <!-- Estado -->
                                <td class="px-4 py-3 text-slate-700 font-medium">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-bar-chart-line text-blue-500"></i>
                                        <?= htmlspecialchars($item["estadoInver"]) ?>
                                    </div>
                                </td>
                                <!-- Hitos -->
                                <td class="px-4 py-3 text-slate-600 max-w-md">
                                    <div class="flex items-start gap-2">
                                        <i class="bi bi-flag text-orange-500 mt-1"></i>
                                        <span>
                                            <?= htmlspecialchars($item["acciones"]) ?>
                                        </span>
                                    </div>
                                </td>
                                <!-- Fecha -->
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold <?= $item['estadoColor'] ?>">
                                        <i class="bi <?= $item['estadoIcono'] ?>"></i>
                                        <?php if (!empty($item['fechas'])): ?>
                                            <?= $item['diasTranscurridos'] ?> /
                                            <?= $item['diasTotales'] ?> días
                                            (<?= date("d/m/Y", strtotime($item["fechas"])) ?>)
                                        <?php else: ?>
                                            Sin fecha programada
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <!-- Situación -->
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-3 py-2 rounded-lg bg-emerald-100 text-emerald-700 text-sm font-semibold">
                                        <?= htmlspecialchars($item["situacion"]) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6"
                                class="px-4 py-6 text-center text-slate-500">
                                <i class="bi bi-info-circle mr-2"></i>
                                No existe seguimiento registrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>