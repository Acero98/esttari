<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
    <!-- Gráfico Evolución Anual -->
    <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                <i class="bi bi-graph-up-arrow text-emerald-600 text-lg"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Programado vs Ejecutado
                </h2>
                <p class="text-sm text-slate-500">
                    Evolución financiera anual.
                </p>
            </div>
        </div>
        <div id="graficoEvolucionAnual"></div>
    </div>
    <!-- Gráfico Avances -->
    <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                <i class="bi bi-speedometer2 text-purple-600 text-lg"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Avance por Año Regulatorio
                </h2>
                <p class="text-sm text-slate-500">
                    Comparación financiero vs físico.
                </p>
            </div>
        </div>
        <div id="graficoAvances" class="w-full"></div>
    </div>
</div>