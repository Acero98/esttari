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
        $idAnioRegulatorio = $_POST['idAnioRegulatorio'];

        $archivoGuardado = null;

        if (
            isset($_FILES["archivo"]) &&
            $_FILES["archivo"]["error"] == UPLOAD_ERR_OK
        ) {

            $carpeta =
                "../public/uploads/ejecuciones/" .
                $idAnioRegulatorio;

            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $extension = pathinfo(
                $_FILES["archivo"]["name"],
                PATHINFO_EXTENSION
            );

            $nombreArchivo =
                uniqid() . "." . $extension;

            $rutaFisica =
                $carpeta . "/" . $nombreArchivo;

            if (
                move_uploaded_file(
                    $_FILES["archivo"]["tmp_name"],
                    $rutaFisica
                )
            ) {

                $archivoGuardado =
                    "uploads/ejecuciones/" .
                    $idAnioRegulatorio .
                    "/" .
                    $nombreArchivo;
            }
        }
        $data = [

            'idAnioRegulatorio' => $idAnioRegulatorio,

            'mes' => $_POST['fecha'],

            'programado' => 0,

            'ejecutado' => $_POST['monto'],

            'igv' => $_POST['igv'],

            'total' => $_POST['total'],

            'archivo' => $archivoGuardado,

            'fisico' => null

        ];

        // Solo agregar el archivo si el usuario subió uno
        if ($archivoGuardado != null) {

            $data['archivo'] = $archivoGuardado;
        }

        if (!empty($_POST['idEjecucionMensual'])) {

            $ok = $model->update(
                $_POST['idEjecucionMensual'],
                $data
            );
        } else {

            $ok = $model->create($data);
        }
        header("Content-Type: application/json");

        if ($ok) {

            echo json_encode([

                "success" => true,

                "mensaje" => !empty($_POST['idEjecucionMensual'])
                    ? "Ejecución mensual actualizada correctamente."
                    : "Ejecución mensual registrada correctamente."

            ]);
        } else {

            echo json_encode([

                "success" => false,

                "mensaje" => "No se pudo guardar la ejecución mensual."

            ]);
        }

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
    public function descargar()
    {
        global $conexion;

        $model = new EjecucionMensualModel($conexion);

        $id = $_GET['id'];


        $documento = $model->obtenerPorId($id);


        if (!$documento || empty($documento['archivo'])) {

            die("Archivo no encontrado");
        }


        $ruta = "../public/" . $documento['archivo'];


        if (!file_exists($ruta)) {

            die("No existe físicamente: " . $ruta);
        }


        header("Content-Type: application/pdf");

        header(
            "Content-Disposition: attachment; filename=\"" .
                basename($ruta) .
                "\""
        );

        header(
            "Content-Length: " . filesize($ruta)
        );


        readfile($ruta);

        exit;
    }
    public function download()
    {
        global $conexion;


        $model = new EjecucionMensualModel($conexion);


        $id = $_GET['id'];


        $data = $model->obtenerPorId($id);


        if (!$data || empty($data['archivo'])) {

            die("Archivo no encontrado");
        }


        $ruta = "../public/" . $data['archivo'];


        if (!file_exists($ruta)) {

            die("El archivo no existe");
        }


        header("Content-Type: application/pdf");

        header(
            "Content-Disposition: attachment; filename=\"" .
                basename($ruta) .
                "\""
        );


        readfile($ruta);


        exit;
    }
    public function ver()
    {
        global $conexion;

        $model = new EjecucionMensualModel($conexion);

        $id = $_GET['id'];

        $archivo = $model->obtenerArchivo($id);


        if (!$archivo) {

            die("Archivo no encontrado");
        }


        $ruta = "../public/" . $archivo['archivo'];


        if (!file_exists($ruta)) {

            die("El archivo físico no existe");
        }


        header("Content-Type: application/pdf");

        header(
            "Content-Disposition: inline; filename=\"" .
                basename($ruta) .
                "\""
        );


        readfile($ruta);

        exit;
    }
    /*
|--------------------------------------------------------------------------
| DESACTIVAR EJECUCIÓN MENSUAL
|--------------------------------------------------------------------------
*/
    public function delete()
    {

        global $conexion;


        $model = new EjecucionMensualModel($conexion);


        $id = $_GET['id'];


        $ok = $model->cambiarEstado($id);


        header('Content-Type: application/json');


        echo json_encode([

            "success" => $ok,

            "mensaje" => $ok
                ? "Ejecución eliminada correctamente"
                : "Error al desactivar"

        ]);


        exit;
    }
}
