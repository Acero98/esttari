<?php

require_once "../config/conexion.php";
require_once "../app/Models/UsuarioModel.php";

class UsuarioController
{
    public function index()
    {
        global $conexion;

        $model = new UsuarioModel($conexion);

        $usuarios = $model->getAll();
        $roles = $model->getRoles();

        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/usuarios/index.php";
        require_once "../app/Views/layouts/footer.php";
    }

    public function store()
    {
        global $conexion;

        $model = new UsuarioModel($conexion);

        $data = [
            'usuario'    => trim($_POST['usuario']),
            'contrasena' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'nombres'    => trim($_POST['nombres']),
            'apellidos'  => trim($_POST['apellidos']),
            'correo'     => trim($_POST['correo']),
            'idRol'      => $_POST['rol']
        ];

        if ($model->existeUsuario($data['usuario'])) {

            $_SESSION['mensaje'] = "Ya existe ese usuario.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=usuarios");
            exit;
        }

        $ok = $model->create($data);

        if ($ok) {
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar usuario";
            $_SESSION['tipo'] = "error";
        }

        header("Location: index.php?url=usuarios");
        exit;
    }

    public function edit()
    {
        global $conexion;

        $model = new UsuarioModel($conexion);

        $usuario = $model->getById($_GET['id']);
        $roles = $model->getRoles();

        header('Content-Type: application/json');

        echo json_encode([
            'usuario' => $usuario,
            'roles'   => $roles
        ]);
    }

    public function update()
    {
        global $conexion;

        $model = new UsuarioModel($conexion);

        $data = [
            'usuario'   => trim($_POST['usuario']),
            'nombres'   => trim($_POST['nombres']),
            'apellidos' => trim($_POST['apellidos']),
            'correo'    => trim($_POST['correo']),
            'idRol'     => $_POST['rol'],
            'contrasena' => ''
        ];

        if (!empty($_POST['password'])) {
            $data['contrasena'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        if ($model->existeUsuario($data['usuario'], $_POST['idUser'])) {

            $_SESSION['mensaje'] = "Ese usuario ya existe.";
            $_SESSION['tipo'] = "warning";

            header("Location:index.php?url=usuarios");
            exit;
        }

        $ok = $model->update($_POST['idUser'], $data);

        if ($ok) {
            $_SESSION['mensaje'] = "Usuario actualizado correctamente";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar usuario";
            $_SESSION['tipo'] = "error";
        }

        header("Location: index.php?url=usuarios");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new UsuarioModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $ok = $model->cambiarEstado($id, $estado);

        if ($estado == 1) {
            $_SESSION['mensaje'] = "Usuario activado correctamente";
        } else {
            $_SESSION['mensaje'] = "Usuario deshabilitado correctamente";
        }

        $_SESSION['tipo'] = "success";

        header("Location: index.php?url=usuarios");
        exit;
    }
}
