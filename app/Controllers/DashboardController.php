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
        $idRol = $_SESSION['idRol'] ?? null;
        $rolesGerenciales = [
            1, // Super Admin
            2, // Admin
            3  // GerenteGeneral
        ];
        // Si NO es gerencial mostramos dashboard operativo
        if (!in_array($idRol, $rolesGerenciales)) {
            header(
                "Location: index.php?url=dashboardInversion"
            );
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
        $graficoAvance =
            $model->obtenerGraficoAvance($filtrosActivos);
        /*
        |--------------------------------------------------------------------------
        | BLOQUE 3
        | Distribución
        |--------------------------------------------------------------------------
        */
        $graficoFondo =
            $model->obtenerGraficoFondo($filtrosActivos);
        $graficoArea =
            $model->obtenerGraficoArea($filtrosActivos);
        /*
        |--------------------------------------------------------------------------
        | BLOQUE 4
        | Análisis
        |--------------------------------------------------------------------------
        */
        $topProgramado =
            $model->obtenerTopInversionProgramado($filtrosActivos);
        $topEjecutado =
            $model->obtenerTopInversionEjecutado($filtrosActivos);
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
