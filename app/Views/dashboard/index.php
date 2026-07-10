<div class="w-full px-6 py-6 space-y-6">

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
    const graficoAcumulado =
        <?= json_encode($graficoAcumulado); ?>;
</script>

<?php

$titulo = "Dashboard";
$js = "dashboard.js";

?>