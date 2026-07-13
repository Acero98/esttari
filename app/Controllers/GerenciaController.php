<?php

require_once "../config/conexion.php";
require_once "../app/Models/GerenciaModel.php";

class GerenciaController
{
    public function index()
    {
        global $conexion;

        $model = new GerenciaModel($conexion);

        $gerencias = $model->getAll();

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/gerencias/index.php";
        require_once "../app/Views/layouts/footer.php";
    }

    public function store()
    {
        global $conexion;

        $model = new GerenciaModel($conexion);

        $data = [
            'siglasGerencia' => trim($_POST['siglasGerencia']),
            'nombreGerencia' => trim($_POST['nombreGerencia'])
        ];

        if ($model->existeGerencia($data['nombreGerencia'])) {

            $_SESSION['mensaje'] = "Ya existe esa gerencia.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=gerencias");
            exit;
        }

        $ok = $model->create($data);

        if ($ok) {
            $_SESSION['mensaje'] = "Gerencia registrada correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar gerencia";
            $_SESSION['tipo'] = "error";
        }

        header("Location:index.php?url=gerencias");
        exit;
    }

    public function edit()
    {
        global $conexion;

        $model = new GerenciaModel($conexion);

        $gerencia = $model->getById($_GET['id']);

        header('Content-Type: application/json');

        echo json_encode([
            'gerencia' => $gerencia
        ]);
    }

    public function update()
    {
        global $conexion;

        $model = new GerenciaModel($conexion);

        $data = [
            'siglasGerencia' => trim($_POST['siglasGerencia']),
            'nombreGerencia' => trim($_POST['nombreGerencia'])
        ];

        if ($model->existeGerencia($data['nombreGerencia'], $_POST['idGerencias'])) {

            $_SESSION['mensaje'] = "Esa gerencia ya existe.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=gerencias");
            exit;
        }

        $ok = $model->update($_POST['idGerencias'], $data);

        if ($ok) {
            $_SESSION['mensaje'] = "Gerencia actualizada correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar gerencia";
            $_SESSION['tipo'] = "error";
        }

        header("Location:index.php?url=gerencias");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new GerenciaModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $ok = $model->cambiarEstado($id, $estado);

        if ($estado == 1) {
            $_SESSION['mensaje'] = "Gerencia activada correctamente";
        } else {
            $_SESSION['mensaje'] = "Gerencia deshabilitada correctamente";
        }

        $_SESSION['tipo'] = "success";

        header("Location:index.php?url=gerencias");
        exit;
    }
}