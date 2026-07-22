<div class="w-full px-4 py-1 space-y-4">
    <?php require "components/header.php"; ?>
    <?php require "components/filtros.php"; ?>
    <!-- BLOQUE 1 -->
    <?php require "components/informacion.php"; ?>
    <!-- BLOQUE 2 -->
    <?php require "components/kpis.php"; ?>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-1">
            <?php require "components/ejecucionesRecientes.php"; ?>
        </div>
        <div class="xl:col-span-2">
            <?php require "components/seguimiento.php"; ?>
        </div>
    </div>
    <!-- BLOQUE 6 -->
    <?php require "components/graficos.php"; ?>
    <!-- BLOQUE 5 
    <php require "components/documentos.php"; ?>-->
</div>
<script>
    const dashboardInversionInformacion =
        <?= json_encode($informacion ?? []) ?>;
    const dashboardInversionKpis =
        <?= json_encode($kpis ?? []) ?>;
    const dashboardInversionGraficoFinanciero =
        <?= json_encode($graficoFinanciero ?? []) ?>;
    const evolucionAnual = <?= json_encode($resumenAnios) ?>;
    const categoriasAvance = <?= json_encode($categoriasAvance) ?>;
    const avanceFinanciero = <?= json_encode($avanceFinanciero) ?>;
    const avanceFisico = <?= json_encode($avanceFisico) ?>;
    const dashboardInversionSeguimientos =
        <?= json_encode($seguimientos ?? []) ?>;
    const dashboardInversionDocumentos =
        <?= json_encode($documentos ?? []) ?>;
</script>
<?php
$titulo = "Dashboard Ejecutivo de la Inversión";
$js = "dashboardInversion.js";
?>