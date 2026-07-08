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

        $filtrosActivos = [
            'programa' => $_GET['programa'] ?? null,
            'area'     => $_GET['area'] ?? null,
            'fondo'    => $_GET['fondo'] ?? null,
            'anio'     => $_GET['anio'] ?? null
        ];

        // KPIs
        $kpis = $model->obtenerKPIs($filtrosActivos);

        // Filtros
        $filtros = $model->obtenerFiltros();

        // Gráficos
        $graficoPresupuesto = $model->obtenerGraficoPresupuesto($filtrosActivos);
        $graficoFondos      = $model->obtenerGraficoFondos($filtrosActivos);
        $graficoEjecucionMensual = $model->obtenerEjecucionMensual($filtrosActivos['anio'] ?? null);
        $procesos = $model->obtenerProcesos();

        // Vistas (estructura tipo UsuarioController)
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/dashboard/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
}