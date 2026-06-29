<?php

require_once "../config/conexion.php";
require_once "../app/Models/RolModel.php";

class RolController
{
    public function index()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $roles = $model->getAll();

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/roles/index.php";
        require_once "../app/Views/layouts/footer.php";
    }

    public function store()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $data = [
            'nombreRol'    => trim($_POST['nombreRol']),
            'descripcionRol'    => trim($_POST['descripcionRol'])
        ];

        if ($model->existeRol($data['nombreRol'])) {

            $_SESSION['mensaje'] = "Ya existe ese rol.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=roles");
            exit;
        }

        $ok = $model->create($data);

        if ($ok) {
            $_SESSION['mensaje'] = "Rol registrado correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar rol";
            $_SESSION['tipo'] = "error";
        }

        header("Location: index.php?url=roles");
        exit;
    }

    public function edit()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $nombreRol = $model->getById($_GET['id']);

        header('Content-Type: application/json');

        echo json_encode([
            'nombreRol' => $nombreRol
        ]);
    }

    public function update()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $data = [
            'nombreRol'   => trim($_POST['nombreRol']),
            'descripcionRol'   => trim($_POST['descripcionRol'])
        ];

        if ($model->existeRol($data['nombreRol'], $_POST['idRol'])) {

            $_SESSION['mensaje'] = "Ese rol ya existe.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=roles");
            exit;
        }

        $ok = $model->update($_POST['idRol'], $data);

        if ($ok) {
            $_SESSION['mensaje'] = "Rol actualizado correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar rol";
            $_SESSION['tipo'] = "error";
        }

        header("Location: index.php?url=roles");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $ok = $model->cambiarEstado($id, $estado);

        if ($estado == 1) {
            $_SESSION['mensaje'] = "Rol activado correctamente";
        } else {
            $_SESSION['mensaje'] = "Rol deshabilitado correctamente";
        }

        $_SESSION['tipo'] = "success";

        header("Location: index.php?url=roles");
        exit;
    }

    public function permisos()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $idRol = $_GET['id'];

        echo json_encode(
            $model->getPermisosRol($idRol)
        );
    }

    public function guardarPermisos()
    {
        global $conexion;

        $model = new RolModel($conexion);

        $idRol = $_POST['idRol'];
        $permisos = $_POST['permisos'] ?? [];

        $model->guardarPermisosRol($idRol, $permisos);

        $_SESSION['mensaje'] = "Permisos actualizados correctamente.";
        $_SESSION['tipo'] = "success";

        header("Location: index.php?url=roles");
        exit;
    }
}
