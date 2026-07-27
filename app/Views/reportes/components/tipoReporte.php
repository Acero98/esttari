<?php
$tipoReporte = $_GET["tipoReporte"] ?? "";
$reportes = [
    [
        "id" => "resumenEjecutivo",
        "titulo" => "Resumen Ejecutivo",
        "descripcion" => "Indicadores consolidados de las inversiones.",
        "icono" => "bi-speedometer2",
        "color" => "blue"
    ],
    [
        "id" => "estadoGeneral",
        "titulo" => "Estado General",
        "descripcion" => "Información detallada de las inversiones.",
        "icono" => "bi-list-check",
        "color" => "emerald"
    ],
    [
        "id" => "programadoEjecutado",
        "titulo" => "Programado vs Ejecutado",
        "descripcion" => "Comparación financiera por año.",
        "icono" => "bi-bar-chart-line-fill",
        "color" => "amber"
    ],
    [
        "id" => "seguimientos",
        "titulo" => "Seguimientos",
        "descripcion" => "Historial de seguimientos registrados.",
        "icono" => "bi-clipboard2-data-fill",
        "color" => "purple"
    ],
    [
        "id" => "ejecuciones",
        "titulo" => "Ejecuciones",
        "descripcion" => "Detalle de las ejecuciones registradas.",
        "icono" => "bi-cash-stack",
        "color" => "cyan"
    ]
];
?>
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
    <div class="px-6 py-5 border-b border-slate-200">
        <h2 class="text-lg font-bold text-slate-800">
            Tipo de reporte
        </h2>
        <p class="text-sm text-slate-500">
            Seleccione el reporte que desea consultar.
        </p>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5">
            <?php foreach ($reportes as $r):
                $activo = $tipoReporte == $r["id"];
                ?>
                <a
                    href="index.php?url=reportes&tipoReporte=<?= $r["id"] ?>"
                    class="group rounded-2xl border transition-all duration-300
                    <?= $activo
                        ? "border-indigo-500 bg-indigo-50 shadow-md scale-[1.02]"
                        : "border-slate-200 hover:border-indigo-300 hover:shadow-lg hover:-translate-y-1 bg-white"
                    ?>">
                    <div class="p-5">
                        <div class="w-14 h-14 rounded-2xl bg-<?= $r["color"] ?>-100 flex items-center justify-center mb-4">
                            <i class="bi <?= $r["icono"] ?> text-2xl text-<?= $r["color"] ?>-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800">
                            <?= $r["titulo"] ?>
                        </h3>
                        <p class="mt-2 text-sm text-slate-500">
                            <?= $r["descripcion"] ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>