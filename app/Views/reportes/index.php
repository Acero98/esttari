<div class="w-full px-4 py-1 space-y-4">
    <?php require "components/header.php"; ?>
    <!-- <php require "components/tipoReporte.php"; ?> -->
    <?php
    require "components/filtros.php";
    require "components/estadoGeneral.php";
    ?>

    <?php
    /*
    if (!empty($tipoReporte)) {
        switch ($tipoReporte) {
            case "estadoGeneral":
                require "components/estadoGeneral.php";
                break;
            case "programadoEjecutado":
                require "components/programadoEjecutado.php";
                break;
            case "seguimientos":
                require "components/seguimientos.php";
                break;
            case "ejecuciones":
                require "components/ejecuciones.php";
                break;
            case "resumenEjecutivo":
                require "components/resumenEjecutivo.php";
                break;
            default:
                require "components/home.php";
        }
    } else {
        require "components/home.php";
    }
    */
    ?>
    
</div>
<script>
    const tipoReporteSeleccionado =
        <?= json_encode($tipoReporte ?? null) ?>;
    const datosReporte =
        <?= json_encode($datos ?? []) ?>;
</script>
<?php
$titulo = "Centro de Reportes";
$js = "reportes.js";
?>