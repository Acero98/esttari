<?php
require_once "../config/conexion.php";
require_once "../app/Models/InversionModel.php";
require_once "../app/Models/DashboardInversionModel.php";
class DashboardInversionController
{
    /*
    |------------------------------------------------------------------
    | DASHBOARD EJECUTIVO DE LA INVERSIÓN
    |------------------------------------------------------------------
    */
    public function index()
    {
        global $conexion;
        $model = new DashboardInversionModel($conexion);
        $inversionModel = new InversionModel($conexion);
        $idEstudioTarifario = $_GET["idEstudioTarifario"] ?? null;
        $idFondo = $_GET["idFondo"] ?? null;
        $idInversion = $_GET["idInversiones"] ?? null;
        // Si solo llega la inversión, obtener automáticamente su estudio tarifario
        if (!$idEstudioTarifario && $idInversion) {
            $idEstudioTarifario = $inversionModel->obtenerEstudioTarifario(
                $idInversion
            );
        }
        // =====================================
        // VALIDAR QUE LA INVERSIÓN PERTENEZCA AL ESTUDIO
        // =====================================
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
            header("Location:index.php?url=dashboardInversion");
            exit;
        }
        // =====================================
        // LISTAR ESTUDIOS TARIFARIOS
        // =====================================
        $estudios = $model->obtenerEstudiosTarifarios();
        $fondos = [];
        if ($idEstudioTarifario) {
            $fondos =
                $model->obtenerFondosPorEstudio(
                    $idEstudioTarifario
                );
        }
        // =====================================
        // LISTAR INVERSIONES SEGÚN ESTUDIO Y USUARIO
        // =====================================
        $inversiones = [];
        if (
            $idEstudioTarifario &&
            $idFondo
        ) {
            if ($_SESSION["idRol"] == 1) {
                // Super Admin
                $inversiones =
                    $model->obtenerInversionesPorEstudio(
                        $idEstudioTarifario,
                        $idFondo
                    );
            } else {
                // Usuario con permisos sobre inversiones
                $inversiones =
                    $model->obtenerInversionesPorEstudioUsuario(
                        $idEstudioTarifario,
                        $idFondo,
                        $_SESSION["idUser"]
                    );
            }
        }
        // =====================================
        // VALIDAR ACCESO A UNA INVERSIÓN
        // =====================================
        if (
            $idInversion &&
            $_SESSION["idRol"] != 1 &&
            !$inversionModel->usuarioTieneAcceso(
                $_SESSION["idUser"],
                $idInversion
            )
        ) {
            if (
                !$inversionModel->usuarioTieneAcceso(
                    $_SESSION["idUser"],
                    $idInversion
                )
            ) {
                $_SESSION["mensaje"] =
                    "No tiene permisos para acceder a esta inversión.";
                $_SESSION["tipo"] = "warning";
                header("Location:index.php?url=dashboardInversion");
                exit;
            }
        }
        // =====================================
        // INFORMACIÓN GENERAL
        // =====================================
        $totales = [
            'programado' => 0,
            'total' => 0,
            'saldo' => 0,
            'pim' => 0
        ];
        $informacion = null;
        $resumenAnios = [];
        $ejecucionesRecientes = [];
        if ($idInversion) {
            $informacion =
                $model->obtenerInformacionGeneral($idInversion);
            $resumenAnios =
                $model->obtenerResumenAniosRegulatorios($idInversion);
            $totales =
                $model->calcularTotalesInversion($resumenAnios);
            $ejecucionesRecientes =
                $model->obtenerEjecucionesRecientes($idInversion);
            $ultimoSeguimiento =
                $model->obtenerUltimoSeguimiento($idInversion);
        }
        $categoriasAvance = [];
        $avanceFisico = [];
        $avanceFinanciero = [];
        foreach ($resumenAnios as $fila) {
            $categoriasAvance[] = $fila['anio'];
            $avanceFisico[] = (float) $fila['avanceFisico'];
            $avanceFinanciero[] = round(
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
