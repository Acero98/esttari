<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    <!-- Total Inversión -->
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total Inversión
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    S/ <?= number_format($kpis['total'], 2) ?>
                </h2>
            </div>
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                <i class="bi bi-cash-stack text-3xl"></i>
            </div>
        </div>
    </div>




    <!-- PIM -->
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    PIM
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    S/ <?= number_format($kpis['pim'], 2) ?>
                </h2>                
            </div>
            <div class="bg-purple-100 text-purple-600 p-4 rounded-full">
                <i class="bi bi-wallet2 text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Acumulado -->
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total Acumulado
                </p>
                <h2 class="text-2xl font-bold mt-2">
                    S/ <?= number_format($kpis['totalAcumulado'], 2) ?>
                </h2>
                <?php if (!empty($_GET['anio'])): ?>
                    <p class="text-xs text-gray-400 mt-1">
                        Acumulado hasta <?= htmlspecialchars($_GET['anio']) ?>
                    </p>
                <?php else: ?>
                    <p class="text-xs text-gray-400 mt-1">
                        Acumulado de todos los años
                    </p>
                <?php endif; ?>
            </div>
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                <i class="bi bi-bar-chart-line-fill text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Ejecución Acumulada -->
    <div class="bg-white rounded-xl shadow-sm border p-5">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Ejecución Acumulada
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    S/ <?= number_format($kpis['ejecucionAcumulada'], 2) ?>
                </h2>
            </div>


            <div class="bg-green-100 text-green-600 p-4 rounded-full">

                <i class="bi bi-bar-chart-line text-3xl"></i>

            </div>

        </div>

    </div>





    <!-- Saldo Acumulado -->
    <div class="bg-white rounded-xl shadow-sm border p-5">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Saldo Acumulado
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    S/ <?= number_format($kpis['saldoAcumulado'], 2) ?>
                </h2>
            </div>


            <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full">

                <i class="bi bi-piggy-bank text-3xl"></i>

            </div>

        </div>

    </div>





    <!-- Avance -->
    <div class="bg-white rounded-xl shadow-sm border p-5">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Avance Financiero
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    <?= $kpis['avance'] ?> %
                </h2>
            </div>


            <div class="bg-orange-100 text-orange-600 p-4 rounded-full">

                <i class="bi bi-speedometer2 text-3xl"></i>

            </div>

        </div>

    </div>


</div>