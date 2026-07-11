<?php

require_once "../config/conexion.php";
require_once "../app/Models/DashboardModel.php";

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['idUser'])) {
            header("Location: index.php?url=login");
            exit;
        }

        global $conexion;

        $model = new DashboardModel($conexion);


        /*
        |--------------------------------------------------------------------------
        | FILTROS GENERALES DEL DASHBOARD
        |--------------------------------------------------------------------------
        */

        $filtrosActivos = [
            'estudio'   => !empty($_GET['estudio']) ? $_GET['estudio'] : null,
            'anio'      => !empty($_GET['anio']) ? $_GET['anio'] : null,
            'area'      => !empty($_GET['area']) ? $_GET['area'] : null,
            'fondo'     => !empty($_GET['fondo']) ? $_GET['fondo'] : null,
            'inversion' => !empty($_GET['inversion']) ? $_GET['inversion'] : null
        ];

        /*
        |--------------------------------------------------------------------------
        | BLOQUE 1
        | Resumen General (KPIs)
        |--------------------------------------------------------------------------
        */

        $kpis = $model->obtenerKPIs($filtrosActivos);

        /*
        |--------------------------------------------------------------------------
        | BLOQUE 2
        |--------------------------------------------------------------------------
        */

        $graficoPrincipal =
            $model->obtenerGraficoPrincipal($filtrosActivos);



        /*
        |--------------------------------------------------------------------------
        | BLOQUE 3
        | Distribución
        |--------------------------------------------------------------------------
        */

        /*
        $graficoFondos =
            $model->obtenerGraficoFondos($filtrosActivos);



        /*
        |--------------------------------------------------------------------------
        | BLOQUE 4
        | Análisis
        |--------------------------------------------------------------------------
        */

        /*
        $procesos =
            $model->obtenerProcesos($filtrosActivos);



        /*
        |--------------------------------------------------------------------------
        | FILTROS
        |--------------------------------------------------------------------------
        */


        $filtros = $model->obtenerFiltros($filtrosActivos);


        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/dashboard/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
}
