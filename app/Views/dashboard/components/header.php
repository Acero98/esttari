<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-4">
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 text-blue-600 rounded-xl p-4">
                <i class="bi bi-speedometer2 text-3xl"></i>
            </div>
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold uppercase tracking-wide">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard Ejecutivo
                </div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Dashboard Gerencial
                </h1>
                <p class="text-slate-500 mt-1">
                    Seguimiento financiero y avance de inversiones
                </p>
                <p class="text-sm text-slate-400 mt-2">
                    Usuario:
                    <span class="font-medium text-slate-600">
                        <?= $_SESSION['nombres']; ?>
                    </span>
                </p>
            </div>
        </div>

        <div class="flex items-center md:justify-end">
            <div class="text-right">
                <p class="text-xs uppercase text-slate-400">
                    Fecha del reporte
                </p>
                <p class="text-lg font-semibold text-slate-700">
                    <?= date('d/m/Y'); ?>
                </p>
            </div>
        </div>
    </div>
</div>