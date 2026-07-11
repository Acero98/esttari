<div class="w-full px-4 py-1 space-y-4">

    <?php require "components/header.php"; ?>


    <?php require "components/filtros.php"; ?>


    <!-- BLOQUE 1 -->
    <?php require "components/kpis.php"; ?>


    <!-- BLOQUE 2 -->
    <?php require "components/financiero.php"; ?>


    <!-- BLOQUE 3
    <php require "components/distribucion.php"; ?>-->


    <!-- BLOQUE 4
    <php require "components/analisis.php"; ?>-->


    <!-- BLOQUE 5
    <php require "components/seguimiento.php"; ?>-->


</div>

<script>
    const graficoPrincipal =
        <?= json_encode($graficoPrincipal) ?>;

    const graficoFondo =
        <?= json_encode($graficoFondo) ?>;

    const graficoArea =
        <?= json_encode($graficoArea) ?>;

    const graficoAvance =
        <?= json_encode($graficoAvance) ?>;

    const topProgramado =
        <?= json_encode($topProgramado) ?>;
    const topEjecutado =
        <?= json_encode($topEjecutado) ?>;
</script>

<?php

$titulo = "Dashboard";
$js = "dashboard.js";

?>