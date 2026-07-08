<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- Presupuesto Total -->
    <?php

    $titulo = "Presupuesto Total";
    $valor = "S/ " . number_format($kpis['montoTotal'], 2);
    $descripcion = "Monto total aprobado";
    $icono = "bi-cash-stack";
    $colorFondo = "bg-blue-100";
    $colorIcono = "text-blue-600";

    include "card-kpi.php";

    ?>

    <!-- Ejecutado -->
    <?php

    $titulo = "Ejecutado";
    $valor = "S/ " . number_format($kpis['ejecutado'], 2);
    $descripcion = "Monto ejecutado";
    $icono = "bi-wallet2";
    $colorFondo = "bg-green-100";
    $colorIcono = "text-green-600";

    include "card-kpi.php";

    ?>

    <!-- Saldo Disponible -->
    <?php

    $titulo = "Saldo Disponible";
    $valor = "S/ " . number_format($kpis['saldo'], 2);
    $descripcion = "Saldo pendiente";
    $icono = "bi-piggy-bank";
    $colorFondo = "bg-orange-100";
    $colorIcono = "text-orange-600";

    include "card-kpi.php";

    ?>

    <!-- Ejecución -->
    <?php

    $titulo = "Ejecución";
    $valor = number_format($kpis['ejecucion'], 2) . "%";
    $descripcion = "Avance financiero";
    $icono = "bi-graph-up-arrow";
    $colorFondo = "bg-purple-100";
    $colorIcono = "text-purple-600";

    include "card-kpi.php";

    ?>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mt-6">
    <!-- Programas -->
    <div class="xl:col-span-1">
        <?php

        $titulo = "Programas";
        $valor = number_format($kpis['programas']);
        $descripcion = "Programas registrados";
        $icono = "bi-diagram-3";
        $colorFondo = "bg-cyan-100";
        $colorIcono = "text-cyan-600";

        include "card-kpi.php";

        ?>
    </div>
    <div class="xl:col-span-1">

        <!-- Fondos -->
        <?php

        $titulo = "Fondos";
        $valor = number_format($kpis['fondos']);
        $descripcion = "Fuentes de financiamiento";
        $icono = "bi-bank";
        $colorFondo = "bg-indigo-100";
        $colorIcono = "text-indigo-600";

        include "card-kpi.php";

        ?>

    </div>
    <div class="xl:col-span-2">

        <!-- Proyectos en Riesgo -->
        <?php

        $titulo = "Proyectos en Riesgo";
        $valor = "--";
        $descripcion = "Próximamente";
        $icono = "bi-exclamation-triangle";
        $colorFondo = "bg-red-100";
        $colorIcono = "text-red-600";

        include "card-kpi.php";

        ?>

    </div>
</div>