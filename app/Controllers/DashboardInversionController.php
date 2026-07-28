<?php
require_once "../config/conexion.php";
require_once "../app/Models/InversionModel.php";
require_once "../app/Models/DashboardInversionModel.php";

class DashboardInversionController
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD EJECUTIVO DE LA INVERSIÓN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        global $conexion;


        $model = new DashboardInversionModel($conexion);
        $inversionModel = new InversionModel($conexion);


        $idUsuario = $_SESSION["idUser"];
        $idRol = $_SESSION["idRol"];


        $idEstudioTarifario =
            $_GET["idEstudioTarifario"] ?? null;

        $idFondo =
            $_GET["idFondo"] ?? null;

        $idInversion =
            $_GET["idInversiones"] ?? null;



        /*
        |--------------------------------------------------------------------------
        | LISTA DE FILTROS
        |--------------------------------------------------------------------------
        */


        // Estudios disponibles según usuario
        $estudios =
            $model->obtenerEstudiosDashboard(
                $idUsuario,
                $idRol
            );


        // Fondos según estudio seleccionado
        $fondos = [];

        if ($idEstudioTarifario) {

            $fondos =
                $model->obtenerFondosDashboard(
                    $idEstudioTarifario,
                    $idUsuario,
                    $idRol
                );
        }


        // Inversiones según estudio + fondo
        $inversiones = [];

        if (
            $idEstudioTarifario &&
            $idFondo
        ) {

            $inversiones =
                $model->obtenerInversionesDashboard(
                    $idEstudioTarifario,
                    $idFondo,
                    $idUsuario,
                    $idRol
                );
        }



        /*
        |--------------------------------------------------------------------------
        | VALIDAR ESTUDIO DE LA INVERSIÓN
        |--------------------------------------------------------------------------
        */


        if (!$idEstudioTarifario && $idInversion) {

            $idEstudioTarifario =
                $inversionModel->obtenerEstudioTarifario(
                    $idInversion
                );
        }


        if (
            $idInversion &&
            $idEstudioTarifario &&
            !$inversionModel->perteneceAlEstudio(
                $idInversion,
                $idEstudioTarifario
            )
        ) {

            $_SESSION["mensaje"] =
                "La inversión no pertenece al estudio tarifario seleccionado.";

            $_SESSION["tipo"] = "warning";

            header(
                "Location:index.php?url=dashboardInversion"
            );

            exit;
        }



        /*
        |--------------------------------------------------------------------------
        | VALIDAR ACCESO A LA INVERSIÓN
        |--------------------------------------------------------------------------
        */


        if (
            $idInversion &&
            !in_array(
                'ver_dashboard_inversion_todo',
                $_SESSION['permisos']
            ) &&
            !$inversionModel->usuarioTieneAcceso(
                $idUsuario,
                $idInversion
            )
        ) {


            $_SESSION["mensaje"] =
                "No tiene permisos para acceder a esta inversión.";

            $_SESSION["tipo"] = "warning";


            header(
                "Location:index.php?url=dashboardInversion"
            );

            exit;
        }



        /*
        |--------------------------------------------------------------------------
        | DATOS DEL DASHBOARD
        |--------------------------------------------------------------------------
        */


        $totales = [
            'programado' => 0,
            'total' => 0,
            'saldo' => 0,
            'pim' => 0
        ];


        $informacion = null;
        $resumenAnios = [];
        $ejecucionesRecientes = [];
        $ultimoSeguimiento = null;


        if ($idInversion) {


            $informacion =
                $model->obtenerInformacionGeneral(
                    $idInversion
                );


            $resumenAnios =
                $model->obtenerResumenAniosRegulatorios(
                    $idInversion
                );


            $totales =
                $model->calcularTotalesInversion(
                    $resumenAnios
                );


            $ejecucionesRecientes =
                $model->obtenerEjecucionesRecientes(
                    $idInversion
                );


            $ultimoSeguimiento =
                $model->obtenerUltimoSeguimiento(
                    $idInversion
                );
        }



        /*
        |--------------------------------------------------------------------------
        | DATOS PARA GRÁFICO AVANCE
        |--------------------------------------------------------------------------
        */


        $categoriasAvance = [];
        $avanceFisico = [];
        $avanceFinanciero = [];


        foreach ($resumenAnios as $fila) {


            $categoriasAvance[] =
                $fila['anio'];


            $avanceFisico[] =
                (float)$fila['avanceFisico'];


            $avanceFinanciero[] =
                round(
                    $fila['avanceFinanciero'],
                    2
                );
        }



        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/dashboardInversion/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
}
