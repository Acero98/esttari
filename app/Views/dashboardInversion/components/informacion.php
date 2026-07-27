<?php
require_once __DIR__ . '/../../../Helpers/EstadoHelper.php';

$estado = estadoInversion($informacion['estadoInversion'] ?? null);
?>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Cabecera -->
    <div class="px-6 py-4 bg-indigo-50 border-b border-indigo-100">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-indigo-100">
                <i class="bi bi-info-circle-fill text-indigo-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Información General de la Inversión
                </h2>
                <p class="text-sm text-slate-500">
                    Datos principales, responsables y clasificación del proyecto.
                </p>
            </div>
        </div>
    </div>
    <!-- Contenido -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- CUI -->
            <div class="rounded-xl bg-slate-50 border border-slate-200 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase">
                    <i class="bi bi-hash text-blue-600"></i>
                    CUI
                </span>
                <p class="mt-2 text-lg font-bold text-slate-800">
                    <?= $informacion['cui'] ?? '-' ?>
                </p>
            </div>
            <!-- Fondo -->
            <div class="rounded-xl bg-emerald-50 border border-emerald-100 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-emerald-700 uppercase">
                    <i class="bi bi-wallet2"></i>
                    Fondo
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?= $informacion['nombreFondo'] ?? '-' ?>
                </p>
            </div>
            <!-- Área -->
            <div class="rounded-xl bg-purple-50 border border-purple-100 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-purple-700 uppercase">
                    <i class="bi bi-building"></i>
                    Área Responsable
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?= $informacion['nombreArea'] ?? '-' ?>
                </p>
            </div>
            <!-- Gerencia -->
            <div class="rounded-xl bg-orange-50 border border-orange-100 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-orange-700 uppercase">
                    <i class="bi bi-diagram-3"></i>
                    Gerencia
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?= $informacion['nombreGerencia'] ?? '-' ?>
                </p>
            </div>
            <div class="rounded-xl <?= $estado['bg'] ?> <?= $estado['border'] ?> border-2 p-5">

                <span class="text-xs uppercase font-semibold text-slate-500">
                    Estado de la inversión
                </span>

                <div class="mt-4 flex items-center gap-4">

                    <div class="w-14 h-14 rounded-xl <?= $estado['iconBg'] ?> flex items-center justify-center">

                        <i class="bi <?= $estado['icono'] ?> <?= $estado['iconColor'] ?> text-2xl"></i>

                    </div>

                    <div>

                        <h3 class="text-lg font-bold <?= $estado['textColor'] ?>">
                            <?= $estado['texto'] ?>
                        </h3>

                        <p class="text-sm text-slate-600 mt-1">
                            <?= $estado['descripcion'] ?>
                        </p>

                    </div>

                </div>

            </div>
            <!-- Nombre Resumen -->
            <div class="lg:col-span-1 rounded-xl bg-slate-50 border border-slate-200 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase">
                    <i class="bi bi-card-text text-blue-600"></i>
                    Nombre Resumen
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?= $informacion['descripcion'] ?? '-' ?>
                </p>
            </div>
            <!-- Nombre Completo -->
            <div class="lg:col-span-2 rounded-xl bg-slate-50 border border-slate-200 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase">
                    <i class="bi bi-file-earmark-text text-blue-600"></i>
                    Nombre Completo
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?= $informacion['nombre'] ?? '-' ?>
                </p>
            </div>
            <!-- Estudio Tarifario -->
            <div class="lg:col-span-2 rounded-xl bg-blue-50 border border-blue-100 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-blue-700 uppercase">
                    <i class="bi bi-journal-text"></i>
                    Estudio Tarifario
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?=
                    ($informacion['estudioTarifario'] ?? '-')
                        . ' '
                        .
                        ($informacion['periodoTarifario'] ?? '')
                    ?>
                </p>
            </div>
            <!-- Responsables -->
            <div class="lg:col-span-2 rounded-xl bg-yellow-50 border border-yellow-100 p-4">
                <span class="flex items-center gap-2 text-xs font-semibold text-yellow-700 uppercase">
                    <i class="bi bi-people"></i>
                    Responsables
                </span>
                <p class="mt-2 font-semibold text-slate-800">
                    <?= $informacion['responsables'] ?? '-' ?>
                </p>
            </div>
        </div>
    </div>
</div>