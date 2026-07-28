<?php

require_once "../config/conexion.php";
require_once "../app/Models/UsuarioModel.php";

class AuthController
{
    public function login()
    {
        require_once "../app/Views/login.php";
    }

    public function auth()
    {
        global $conexion;

        $model = new UsuarioModel($conexion);

        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $user = $model->login($usuario);

        if (!$user) {
            $_SESSION['mensaje'] = "El usuario no existe.";
            $_SESSION['tipo'] = "error";

            header("Location: index.php?url=login");
            exit;
        }

        // Verificar si el usuario está activo
        if ($user['estado'] != 1) {
            $_SESSION['mensaje'] = "Su cuenta se encuentra deshabilitada.";
            $_SESSION['tipo'] = "warning";

            header("Location: index.php?url=login");
            exit;
        }

        // Verificar contraseña
        if (!password_verify($password, $user['contrasena'])) {
            $_SESSION['mensaje'] = "Usuario o contraseña incorrectos.";
            $_SESSION['tipo'] = "error";

            header("Location: index.php?url=login");
            exit;
        }

        if (empty($user['idRol'])) {

            $_SESSION['mensaje'] = "Su usuario no tiene un rol asignado. Comuníquese con el administrador.";
            $_SESSION['tipo'] = "warning";

            header("Location: index.php?url=login");
            exit;
        }

        $rol = $model->rolActivo($user['idRol']);

        if (!$rol || $rol['estado'] != 1) {

            $_SESSION['mensaje'] = "El rol asignado a su usuario está deshabilitado.";
            $_SESSION['tipo'] = "warning";

            header("Location: index.php?url=login");
            exit;
        }

        $permisos = $model->getPermisosRol($user['idRol']);

        if (count($permisos) == 0) {

            $_SESSION['mensaje'] = "El rol asignado no tiene permisos configurados.";
            $_SESSION['tipo'] = "warning";

            header("Location: index.php?url=login");
            exit;
        }

        // Crear sesión
        $_SESSION['idUser'] = $user['idUser'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['nombres'] = $user['nombres'];
        $_SESSION['apellidos'] = $user['apellidos'];
        $_SESSION['correo'] = $user['correo'];
        $_SESSION['idRol'] = $user['idRol'];
        $_SESSION['nombreRol'] = $user['nombreRol'];

        // Guardar solo las rutas en la sesión
        $rutas = array_column($permisos, 'ruta');

        $_SESSION['permisos'] = $rutas;

        header("Location: index.php?url=bienvenida");
        exit;
    }
}
