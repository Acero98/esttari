<?php

require_once "../config/conexion.php";
require_once "../app/Models/SeguimientoMensualModel.php";

class SeguimientoMensualController
{
    /*
    |--------------------------------------------------------------------------
    | REGISTRAR / ACTUALIZAR SEGUIMIENTO
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        global $conexion;

        $model = new SeguimientoMensualModel($conexion);

        $data = [

            'idAnioRegulatorio' => $_POST['idAnioRegulatorio'],

            'producto'     => $_POST['producto'] ?? null,
            'estadoInver'  => $_POST['estadoInver'] ?? null,
            'acciones'     => $_POST['acciones'] ?? null,
            'fechas'       => $_POST['fechas'] ?? null,
            'situacion'    => $_POST['situacion'] ?? null

        ];

        if (!empty($_POST['idSeguimientoMensual'])) {

            $ok = $model->update(
                $_POST['idSeguimientoMensual'],
                $data
            );

            $mensaje = $ok
                ? "Seguimiento actualizado correctamente"
                : "Error al actualizar el seguimiento";
        } else {

            $ok = $model->create($data);

            $mensaje = $ok
                ? "Seguimiento registrado correctamente"
                : "Error al registrar el seguimiento";
        }

        header('Content-Type: application/json');

        echo json_encode([
            "success" => $ok,
            "mensaje" => $mensaje
        ]);

        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR
    |--------------------------------------------------------------------------
    */
    public function lista()
    {
        global $conexion;

        $model = new SeguimientoMensualModel($conexion);

        $id = $_GET['idAnioRegulatorio'];

        $datos = $model->getByAnio($id);

        header('Content-Type: application/json');

        echo json_encode($datos);

        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR POR ID
    |--------------------------------------------------------------------------
    */
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

        $model = new SeguimientoMensualModel($conexion);

        $data = $model->obtenerPorId($id);

        echo json_encode($data);

        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | DESACTIVAR SEGUIMIENTO
    |--------------------------------------------------------------------------
    */
    public function delete()
    {
        global $conexion;

        $model = new SeguimientoMensualModel($conexion);

        header('Content-Type: application/json');

        $id = $_GET['id'] ?? null;

        if (!$id) {

            echo json_encode([
                "success" => false,
                "mensaje" => "No se recibió el seguimiento."
            ]);

            exit;
        }

        $ok = $model->delete($id);

        if ($ok) {

            echo json_encode([
                "success" => true,
                "mensaje" => "Seguimiento desactivado correctamente."
            ]);
        } else {

            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo desactivar el seguimiento."
            ]);
        }

        exit;
    }
}
