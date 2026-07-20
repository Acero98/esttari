<!-- ==========================================================
     BLOQUE 1 - TOTALES GENERALES
=========================================================== 
<div class="mb-8">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">
        Totales Generales
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Total Inversión 
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Inversión
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <= number_format($kpis['total'], 2) ?>
                    </h2>
                </div>
                <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                    <i class="bi bi-cash-stack text-3xl"></i>
                </div>
            </div>
        </div>-->
        <!-- Total PIM 
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total PIM
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <= number_format($kpis['totalPim'], 2) ?>
                    </h2>
                </div>
                <div class="bg-purple-100 text-purple-600 p-4 rounded-full">
                    <i class="bi bi-wallet2 text-3xl"></i>
                </div>
            </div>
        </div>-->
        <!-- Total Ejecución 
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Ejecución
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <= number_format($kpis['totalEjecucion'], 2) ?>
                    </h2>
                </div>
                <div class="bg-green-100 text-green-600 p-4 rounded-full">
                    <i class="bi bi-check-circle text-3xl"></i>
                </div>
            </div>
        </div> -->
        <!-- Total Saldo 
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Saldo
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <= number_format($kpis['totalSaldo'], 2) ?>
                    </h2>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full">
                    <i class="bi bi-piggy-bank text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- ==========================================================
     BLOQUE 2 - ACUMULADO HASTA AÑO SELECCIONADO
=========================================================== -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-700">
            Acumulado hasta <?= htmlspecialchars($_GET['anio'] ?? 'Todos los años') ?>
        </h3>
        <?php if (!empty($_GET['anio'])): ?>
            <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                Año <?= htmlspecialchars($_GET['anio']) ?>
            </span>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">
        <!-- Inversión Acumulada -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Inversión Acumulada
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <?= number_format($kpis['totalAcumulado'], 2) ?>
                    </h2>
                </div>
                <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                    <i class="bi bi-bar-chart-line-fill text-3xl"></i>
                </div>
            </div>
        </div>
        <!-- PIM Acumulado -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        PIM Acumulado
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <?= number_format($kpis['pimAcumulado'], 2) ?>
                    </h2>
                </div>
                <div class="bg-purple-100 text-purple-600 p-4 rounded-full">
                    <i class="bi bi-wallet2 text-3xl"></i>
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
                    <i class="bi bi-check-circle text-3xl"></i>
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
        <!-- Avance Acumulado -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Avance Acumulado
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        <?= $kpis['avanceAcumulado'] ?> %
                    </h2>
                </div>
                <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                    <i class="bi bi-speedometer2 text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========================================================
     BLOQUE 3 - SOLO AÑO SELECCIONADO
=========================================================== -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-700">
            Año seleccionado <?= htmlspecialchars($_GET['anio'] ?? '') ?>
        </h3>
        <?php if (!empty($_GET['anio'])): ?>
            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                Ejercicio <?= htmlspecialchars($_GET['anio']) ?>
            </span>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">
        <!-- Inversión del Año -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Inversión del Año
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <?= number_format($kpis['totalAnio'], 2) ?>
                    </h2>
                </div>
                <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                    <i class="bi bi-calendar-event text-3xl"></i>
                </div>
            </div>
        </div>
        <!-- PIM del Año -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        PIM del Año
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <?= number_format($kpis['pimAnio'], 2) ?>
                    </h2>
                </div>
                <div class="bg-purple-100 text-purple-600 p-4 rounded-full">
                    <i class="bi bi-wallet2 text-3xl"></i>
                </div>
            </div>
        </div>
        <!-- Ejecución del Año -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Ejecución del Año
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <?= number_format($kpis['ejecucionAnio'], 2) ?>
                    </h2>
                </div>
                <div class="bg-green-100 text-green-600 p-4 rounded-full">
                    <i class="bi bi-check-circle-fill text-3xl"></i>
                </div>
            </div>
        </div>
        <!-- Saldo del Año -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Saldo del Año
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        S/ <?= number_format($kpis['saldoAnio'], 2) ?>
                    </h2>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full">
                    <i class="bi bi-piggy-bank text-3xl"></i>
                </div>
            </div>
        </div>
        <!-- Avance del Año -->
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Avance del Año
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        <?= $kpis['avanceAnio'] ?> %
                    </h2>
                </div>
                <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                    <i class="bi bi-speedometer2 text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>
