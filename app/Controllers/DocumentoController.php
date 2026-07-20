<?php
require_once "../config/conexion.php";
require_once "../app/Models/DocumentoModel.php";
class DocumentoController
{
    public function lista()
    {
        global $conexion;
        $model = new DocumentoModel($conexion);
        $id = $_GET["idInversiones"];
        echo json_encode(
            $model->getByInversion($id)
        );
    }
    public function store()
    {
        global $conexion;
        $model = new DocumentoModel($conexion);
        if (!isset($_FILES["archivo"])) {
            die("No se recibió ningún archivo.");
        }
        $idInversiones = $_POST["idInversiones"];
        $tipoDocumento = $_POST["tipoDocumento"];
        $observacion = $_POST["observacion"];
        $archivo = $_FILES["archivo"];
        if ($archivo["error"] != UPLOAD_ERR_OK) {
            die("Error al subir el archivo.");
        }
        if ($archivo["type"] != "application/pdf") {
            die("Solo se permiten archivos PDF.");
        }
        $carpeta = "uploads/documentos/" . $idInversiones;
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $extension = pathinfo(
            $archivo["name"],
            PATHINFO_EXTENSION
        );
        $nombreGuardado =
            uniqid() . "." . $extension;
        $ruta =
            $carpeta .
            "/" .
            $nombreGuardado;
        if (!move_uploaded_file($archivo["tmp_name"], $ruta)) {
            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo guardar el archivo."
            ]);
            exit;
        }
        $data = [
            "idInversiones" => $idInversiones,
            "tipoDocumento" => $tipoDocumento,
            "nombreOriginal" => $archivo["name"],
            "nombreGuardado" => $nombreGuardado,
            "ruta" => $ruta,
            "tipoMime" => $archivo["type"],
            "tamanio" => $archivo["size"],
            "observacion" => $observacion
        ];
        if ($model->create($data)) {
            echo json_encode([
                "success" => true,
                "mensaje" => "Documento registrado correctamente."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo registrar el documento."
            ]);
        }
        exit;
    }
    public function download()
    {
        global $conexion;
        $model = new DocumentoModel($conexion);
        $id = $_GET["id"];
        $doc = $model->getById($id);
        if (!$doc) {
            exit("Documento no encontrado.");
        }
        $ruta = $doc["ruta"];
        if (!file_exists($ruta)) {
            exit("El archivo no existe.");
        }
        header("Content-Type: application/pdf");
        header(
            'Content-Disposition: attachment; filename="' .
                $doc["nombreOriginal"] .
                '"'
        );
        readfile($ruta);
        exit;
    }
    public function delete()
    {
        global $conexion;
        $model = new DocumentoModel($conexion);
        $id = $_POST["id"];
        $doc = $model->getById($id);
        if (!$doc) {
            echo json_encode([
                "success" => false,
                "mensaje" => "Documento no encontrado."
            ]);
            exit;
        }
        // Eliminar archivo físico
        $rutaFisica = dirname(__DIR__, 2) . "/public/" . $doc["ruta"];
        if (file_exists($rutaFisica)) {
            unlink($rutaFisica);
        }
        if ($model->delete($id)) {
            echo json_encode([
                "success" => true,
                "mensaje" => "Documento eliminado correctamente."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo eliminar el documento."
            ]);
        }
        exit;
    }
}
