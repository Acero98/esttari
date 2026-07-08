<div class="w-full px-6 py-6 space-y-6">

    <?php require "components/header.php"; ?>

    <?php require "components/filtros.php"; ?>

    <?php require "components/kpis.php"; ?>

    <!-- <php require "components/resumen-financiero.php"; ?> -->

    <?php require "components/graficos.php"; ?>

</div>

<script>
    window.graficoPresupuesto = <?= json_encode($graficoPresupuesto); ?>;
    window.graficoFondos = <?= json_encode($graficoFondos); ?>;
    window.graficoEjecucionMensual = <?= json_encode($graficoEjecucionMensual ?? []); ?>;
    window.procesos = <?= json_encode($procesos ?? []); ?>;
</script>

<?php
$titulo = "Dashboard";
$js = "dashboard.js";
?>