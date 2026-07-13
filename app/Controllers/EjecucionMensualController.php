<?php
require_once "../config/conexion.php";
require_once "../app/Models/EjecucionMensualModel.php";
class EjecucionMensualController
{
    /*
    |--------------------------------------------------------------------------
    | REGISTRAR EJECUCIÓN MENSUAL
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        global $conexion;
        $model = new EjecucionMensualModel($conexion);
        $idAnioRegulatorio =
            $_POST['idAnioRegulatorio'];
        $data = [
            'idAnioRegulatorio' =>
            $idAnioRegulatorio,
            'mes' =>
            $_POST['mes'],
            'programado' =>
            $_POST['programado'] ?? 0,
            'ejecutado' =>
            $_POST['ejecutado'] ?? 0,
            'fisico' =>
            $_POST['fisico'] ?? null
        ];
        if (!empty($_POST['idEjecucionMensual'])) {

            $ok = $model->update(
                $_POST['idEjecucionMensual'],
                $data
            );
        } else {

            $ok = $model->create($data);
        }
        if ($ok) {
            if (!empty($_POST['idEjecucionMensual'])) {

                $_SESSION['mensaje'] =
                    "Ejecución mensual actualizada correctamente";
            } else {

                $_SESSION['mensaje'] =
                    "Ejecución mensual registrada correctamente";
            }

            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] =
                "Error al registrar ejecución mensual";
            $_SESSION['tipo'] =
                "error";
        }
        header(
            //$idInversion = $model->getIdInversion($idAnioRegulatorio);
            "Location:index.php?url=anioregulatorio&idInversiones="
                . $_POST['idInversiones']
        );
        exit;
    }
    public function lista()
    {
        global $conexion;
        $model = new EjecucionMensualModel($conexion);
        $id = $_GET['idAnioRegulatorio'];
        $datos = $model->getByAnio($id);
        header('Content-Type: application/json');
        echo json_encode($datos);
        exit;
    }
    public function show()
    {
        global $conexion;
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo json_encode([
                "error" => "ID no enviado"
            ]);
            exit;
        }
        $model = new EjecucionMensualModel($conexion);
        $data = $model->obtenerPorId($id);
        echo json_encode($data);
        exit;
    }
}
