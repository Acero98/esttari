<!-- ==========================================================
     BLOQUE 4 - GRÁFICOS PRINCIPALES
=========================================================== -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <!-- ===================================== -->
    <!-- Programado vs Ejecutado -->
    <!-- ===================================== -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Programado vs Ejecutado
                </h2>
                <p class="text-sm text-slate-500">
                    Evolución histórica del presupuesto y ejecución
                </p>
            </div>
            <div class="bg-blue-100 rounded-lg p-3">
                <i class="bi bi-bar-chart-line text-xl text-blue-600"></i>
            </div>
        </div>
        <div id="graficoPrincipal"></div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Avance Financiero vs Avance Físico
                </h2>
                <p class="text-sm text-slate-500">
                    Comparación del avance económico y físico por año
                </p>
            </div>
            <div class="bg-green-100 rounded-lg p-3">
                <i class="bi bi-graph-up-arrow text-xl text-green-600"></i>
            </div>
        </div>
        <div id="graficoAvance"></div>
    </div>
    <!-- ===================================== -->
    <!-- Próximo gráfico -->
    <!-- ===================================== -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Distribución por Fondo
                </h2>
                <p class="text-sm text-slate-500">
                    Participación del presupuesto por fuente de financiamiento
                </p>
            </div>
            <div class="bg-purple-100 rounded-lg p-3">
                <i class="bi bi-pie-chart text-xl text-purple-600"></i>
            </div>
        </div>
        <div id="graficoFondo"></div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Distribución por Área
                </h2>
                <p class="text-sm text-slate-500">
                    Participación del presupuesto por área
                </p>
            </div>
            <div class="bg-green-100 rounded-lg p-3">
                <i class="bi bi-diagram-3 text-xl text-green-600"></i>
            </div>
        </div>
        <div id="graficoArea"></div>
    </div>
</div>
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <!-- TOP PROGRAMADO -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Top Inversión Programado
                </h2>
                <p class="text-sm text-slate-500">
                    Inversiones con mayor presupuesto asignado
                </p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                <i class="bi bi-bar-chart-fill text-xl"></i>
            </div>
        </div>
        <div id="topProgramadoChart"></div>
    </div>
    <!-- TOP EJECUTADO -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Top Inversión Ejecutado
                </h2>
                <p class="text-sm text-slate-500">
                    Inversiones con mayor ejecución acumulada
                </p>
            </div>
            <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                <i class="bi bi-check-circle-fill text-xl"></i>
            </div>
        </div>
        <div id="topEjecutadoChart"></div>
    </div>
</div>