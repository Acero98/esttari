<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 hover:shadow-md transition-all duration-300">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-slate-500">
                <?= $titulo ?>
            </p>
            <h2 class="text-3xl font-bold text-slate-800 mt-1">
                <?= $valor ?>
            </h2>
            <?php if (!empty($descripcion)): ?>
                <p class="text-xs text-slate-400 mt-2">
                    <?= $descripcion ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center <?= $colorFondo ?>">
            <i class="bi <?= $icono ?> text-2xl <?= $colorIcono ?>"></i>
        </div>
    </div>
</div>