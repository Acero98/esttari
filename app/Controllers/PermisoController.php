<?php

require_once "../config/conexion.php";
require_once "../app/Models/PermisoModel.php";

class PermisoController
{
    public function index()
    {
        global $conexion;

        $model = new PermisoModel($conexion);

        $permisos = $model->getAll();

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/permisos/index.php";
        require_once "../app/Views/layouts/footer.php";
    }

    public function store()
    {
        global $conexion;

        $model = new PermisoModel($conexion);

        $data = [
            'permiso'    => trim($_POST['permiso']),
            'grupo'    => trim($_POST['grupo']),
            'ruta'  => trim($_POST['ruta']),
            'icono'     => trim($_POST['icono']),
            'orden'      => $_POST['orden']
        ];

        if ($model->existePermiso($data['permiso'])) {

            $_SESSION['mensaje'] = "Ya existe ese permiso.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=permisos");
            exit;
        }

        $ok = $model->create($data);

        if ($ok) {
            $_SESSION['mensaje'] = "Permiso registrado correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar permiso";
            $_SESSION['tipo'] = "error";
        }

        header("Location: index.php?url=permisos");
        exit;
    }

    public function edit()
    {
        global $conexion;

        $model = new PermisoModel($conexion);

        $permiso = $model->getById($_GET['id']);

        header('Content-Type: application/json');

        echo json_encode([
            'permiso' => $permiso
        ]);
    }

    public function update()
    {
        global $conexion;

        $model = new PermisoModel($conexion);

        $data = [
            'permiso'   => trim($_POST['permiso']),
            'grupo'   => trim($_POST['grupo']),
            'ruta' => trim($_POST['ruta']),
            'icono'    => trim($_POST['icono']),
            'orden'     => $_POST['orden']
        ];

        if (!empty($_POST['password'])) {
            $data['contrasena'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        if ($model->existePermiso($data['permiso'], $_POST['idPermiso'])) {

            $_SESSION['mensaje'] = "Ese permiso ya existe.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=permisos");
            exit;
        }

        $ok = $model->update($_POST['idPermiso'], $data);

        if ($ok) {
            $_SESSION['mensaje'] = "Permiso actualizado correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar permiso";
            $_SESSION['tipo'] = "error";
        }

        header("Location: index.php?url=permisos");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new PermisoModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $ok = $model->cambiarEstado($id, $estado);

        if ($estado == 1) {
            $_SESSION['mensaje'] = "Permiso activado correctamente";
        } else {
            $_SESSION['mensaje'] = "Permiso deshabilitado correctamente";
        }

        $_SESSION['tipo'] = "success";

        header("Location: index.php?url=permisos");
        exit;
    }
}
