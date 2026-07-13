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

        $idAnioRegulatorio = $_POST['idAnioRegulatorio'];

        $data = [

            'idAnioRegulatorio' => $idAnioRegulatorio,

            'producto' => $_POST['producto'] ?? null,

            'estadoInver' => $_POST['estadoInver'] ?? null,

            'acciones' => $_POST['acciones'] ?? null,

            'fechas' => $_POST['fechas'] ?? null,

            'situacion' => $_POST['situacion'] ?? null

        ];

        if (!empty($_POST['idSeguimientoMensual'])) {

            $ok = $model->update(
                $_POST['idSeguimientoMensual'],
                $data
            );
        } else {

            $ok = $model->create($data);
        }

        if ($ok) {

            if (!empty($_POST['idSeguimientoMensual'])) {

                $_SESSION['mensaje'] =
                    "Seguimiento actualizado correctamente";
            } else {

                $_SESSION['mensaje'] =
                    "Seguimiento registrado correctamente";
            }

            $_SESSION['tipo'] = "success";
        } else {

            $_SESSION['mensaje'] =
                "Error al registrar el seguimiento";

            $_SESSION['tipo'] = "error";
        }

        header(
            "Location:index.php?url=anioregulatorio&idInversiones="
                . $_POST['idInversiones']
        );

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
    | ELIMINAR
    |--------------------------------------------------------------------------
    */
    /*
|--------------------------------------------------------------------------
| ELIMINAR SEGUIMIENTO
|--------------------------------------------------------------------------
*/
    public function delete()
    {
        global $conexion;

        $model = new SeguimientoMensualModel($conexion);


        $id = $_GET['id'] ?? null;


        if (!$id) {

            $_SESSION['mensaje'] =
                "No se recibió el seguimiento a eliminar";

            $_SESSION['tipo'] = "error";
        } else {


            $ok = $model->delete($id);


            if ($ok) {

                $_SESSION['mensaje'] =
                    "Seguimiento eliminado correctamente";

                $_SESSION['tipo'] = "success";
            } else {

                $_SESSION['mensaje'] =
                    "Error al eliminar el seguimiento";

                $_SESSION['tipo'] = "error";
            }
        }


        header(
            "Location:index.php?url=anioregulatorio&idInversiones="
                . $_GET['idInversiones']
        );

        exit;
    }
}
