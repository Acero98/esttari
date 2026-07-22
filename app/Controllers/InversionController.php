<?php

require_once "../config/conexion.php";
require_once "../app/Models/InversionModel.php";

class InversionController
{
    public function index()
    {
        global $conexion;

        $model = new InversionModel($conexion);

        $inversiones = $model->listarSegunUsuario([
            'idUser' => $_SESSION['idUser'],
            'idRol'  => $_SESSION['idRol']
        ]);
        $estudios = $model->getEstudiosTarifarios();
        $fondos = $model->getFondos();
        $areas = $model->getAreas();

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/inversiones/index.php";
        require_once "../app/Views/layouts/footer.php";
    }

    public function store()
    {
        global $conexion;

        $model = new InversionModel($conexion);

        $data = [
            'idEstudioTarifario' => $_POST['idEstudioTarifario'],
            'idFondos'      => $_POST['idFondos'],
            'idAreas'       => $_POST['idAreas'],
            'cui'           => trim($_POST['cui']),
            'descripcion'   => trim($_POST['descripcion']),
            'nombre'        => trim($_POST['nombre']),
            'observaciones' => trim($_POST['observaciones'])
        ];

        if (!empty($data['cui']) && $model->existeCui($data['cui'])) {

            $_SESSION['mensaje'] = "Ya existe una inversión con ese CUI.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=inversiones");
            exit;
        }

        $ok = $model->create($data);

        if ($ok) {
            $_SESSION['mensaje'] = "Inversión registrada correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar inversión";
            $_SESSION['tipo'] = "error";
        }

        header("Location:index.php?url=inversiones");
        exit;
    }

    public function edit()
    {
        global $conexion;

        $model = new InversionModel($conexion);

        $inversion = $model->getById($_GET['id']);

        header("Content-Type: application/json");

        echo json_encode([
            "inversion" => $inversion
        ]);
    }

    public function update()
    {
        global $conexion;

        $model = new InversionModel($conexion);

        $data = [
            'idEstudioTarifario' => $_POST['idEstudioTarifario'],
            'idFondos'      => $_POST['idFondos'],
            'idAreas'       => $_POST['idAreas'],
            'cui'                => empty(trim($_POST['cui'])) ? null : trim($_POST['cui']),
            'descripcion'   => trim($_POST['descripcion']),
            'nombre'        => trim($_POST['nombre']),
            //'observaciones' => trim($_POST['observaciones'])
        ];

        if (!empty($data['cui']) && $model->existeCui($data['cui'], $_POST['idInversiones'])) {

            $_SESSION['mensaje'] = "Ya existe una inversión con ese CUI.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=inversiones");
            exit;
        }

        $ok = $model->update($_POST['idInversiones'], $data);

        if ($ok) {
            $_SESSION['mensaje'] = "Inversión actualizada correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar inversión";
            $_SESSION['tipo'] = "error";
        }

        header("Location:index.php?url=inversiones");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new InversionModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $ok = $model->cambiarEstado($id, $estado);

        if ($estado == 1) {
            $_SESSION['mensaje'] = "Inversión activada correctamente";
        } else {
            $_SESSION['mensaje'] = "Inversión deshabilitada correctamente";
        }

        $_SESSION['tipo'] = "success";

        header("Location:index.php?url=inversiones");
        exit;
    }
}
