<?php

require_once "../config/conexion.php";
require_once "../app/Models/AreaModel.php";

class AreaController
{
    public function index()
    {
        global $conexion;

        $model = new AreaModel($conexion);

        $areas = $model->getAll();
        $gerencias = $model->getGerencias();

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/areas/index.php";
        require_once "../app/Views/layouts/footer.php";
    }

    public function store()
    {
        global $conexion;

        $model = new AreaModel($conexion);

        $data = [
            'idGerencias' => $_POST['idGerencias'],
            'siglasArea' => trim($_POST['siglasArea']),
            'nombreArea' => trim($_POST['nombreArea'])
        ];

        if ($model->existeArea($data['nombreArea'])) {

            $_SESSION['mensaje'] = "Ya existe esa área.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=areas");
            exit;
        }

        $ok = $model->create($data);

        if ($ok) {
            $_SESSION['mensaje'] = "Área registrada correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar área";
            $_SESSION['tipo'] = "error";
        }

        header("Location:index.php?url=areas");
        exit;
    }

    public function edit()
    {
        global $conexion;

        $model = new AreaModel($conexion);

        $area = $model->getById($_GET['id']);

        header('Content-Type: application/json');

        echo json_encode([
            'area' => $area
        ]);
    }

    public function update()
    {
        global $conexion;

        $model = new AreaModel($conexion);

        $data = [
            'idGerencias' => $_POST['idGerencias'],
            'siglasArea' => trim($_POST['siglasArea']),
            'nombreArea' => trim($_POST['nombreArea'])
        ];

        if ($model->existeArea($data['nombreArea'], $_POST['idAreas'])) {

            $_SESSION['mensaje'] = "Esa área ya existe.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=areas");
            exit;
        }

        $ok = $model->update($_POST['idAreas'], $data);

        if ($ok) {
            $_SESSION['mensaje'] = "Área actualizada correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar área";
            $_SESSION['tipo'] = "error";
        }

        header("Location:index.php?url=areas");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new AreaModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $ok = $model->cambiarEstado($id, $estado);

        if ($estado == 1) {
            $_SESSION['mensaje'] = "Área activada correctamente";
        } else {
            $_SESSION['mensaje'] = "Área deshabilitada correctamente";
        }

        $_SESSION['tipo'] = "success";

        header("Location:index.php?url=areas");
        exit;
    }
}