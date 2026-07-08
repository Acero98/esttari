<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-lg font-semibold text-slate-800">
                Resumen Financiero
            </h2>

            <p class="text-sm text-slate-500">
                Estado actual de la ejecución presupuestal
            </p>

        </div>

        <div class="text-right">

            <p class="text-3xl font-bold text-blue-600">

                <?= number_format($kpis['ejecucion'],2) ?>%

            </p>

            <p class="text-sm text-slate-500">

                Ejecutado

            </p>

        </div>

    </div>

    <div class="space-y-5">

        <div>

            <div class="flex justify-between mb-1">

                <span class="text-slate-600">
                    Presupuesto Total
                </span>

                <span class="font-semibold">
                    S/ <?= number_format($kpis['montoTotal'],2) ?>
                </span>

            </div>

        </div>

        <div>

            <div class="flex justify-between mb-1">

                <span class="text-slate-600">
                    Ejecutado
                </span>

                <span class="font-semibold text-green-600">
                    S/ <?= number_format($kpis['ejecutado'],2) ?>
                </span>

            </div>

        </div>

        <div>

            <div class="flex justify-between mb-3">

                <span class="text-slate-600">
                    Saldo
                </span>

                <span class="font-semibold text-orange-600">
                    S/ <?= number_format($kpis['saldo'],2) ?>
                </span>

            </div>

        </div>

        <!-- Barra -->

        <div>

            <div class="w-full bg-slate-200 rounded-full h-4 overflow-hidden">

                <div
                    class="bg-blue-600 h-4 rounded-full transition-all duration-700"
                    style="width: <?= min($kpis['ejecucion'],100) ?>%">
                </div>

            </div>

            <div class="flex justify-between text-xs text-slate-500 mt-2">

                <span>0%</span>

                <span>100%</span>

            </div>

        </div>

        <div class="pt-2">

            <p class="text-sm text-slate-500">

                Se ha ejecutado el
                <strong><?= number_format($kpis['ejecucion'],2) ?>%</strong>
                del presupuesto asignado.

            </p>

        </div>

    </div>

</div>