<?php

$url = $_GET['url'] ?? 'login';

/*
|-------------------------
| LOGIN
|-------------------------
*/
if ($url == 'login') {

    require_once "../app/Controllers/AuthController.php";

    $controller = new AuthController();
    $controller->login();
}

/*
|-------------------------
| PROCESAR LOGIN
|-------------------------
*/
elseif ($url == 'auth') {

    require_once "../app/Controllers/AuthController.php";

    $controller = new AuthController();
    $controller->auth();
}

/*
|-------------------------
| DASHBOARD
|-------------------------
*/
elseif ($url == 'dashboard') {

    require_once "../app/Controllers/DashboardController.php";

    $controller = new DashboardController();
    $controller->index();
}

elseif ($url == 'usuarios') {

    autorizar('usuarios');

    require_once "../app/Controllers/UsuarioController.php";

    $controller = new UsuarioController();
    $controller->index();
}

elseif ($url == 'usuarios_store') {

    require_once "../app/Controllers/UsuarioController.php";

    $controller = new UsuarioController();
    $controller->store();
}

elseif ($url == 'usuarios_edit') {

    require_once "../app/Controllers/UsuarioController.php";

    $controller = new UsuarioController();
    $controller->edit();
}

elseif ($url == 'usuarios_update') {

    require_once "../app/Controllers/UsuarioController.php";

    $controller = new UsuarioController();
    $controller->update();
}

elseif ($url == 'usuarios_estado') {

    require_once "../app/Controllers/UsuarioController.php";

    $controller = new UsuarioController();
    $controller->estado();
}

elseif ($url == 'permisos') {

    autorizar('permisos');

    require_once "../app/Controllers/PermisoController.php";

    $controller = new PermisoController();
    $controller->index();
}

elseif ($url == 'permisos_store') {

    require_once "../app/Controllers/PermisoController.php";

    $controller = new PermisoController();
    $controller->store();
}

elseif ($url == 'permisos_edit') {

    require_once "../app/Controllers/PermisoController.php";

    $controller = new PermisoController();
    $controller->edit();
}

elseif ($url == 'permisos_update') {

    require_once "../app/Controllers/PermisoController.php";

    $controller = new PermisoController();
    $controller->update();
}

elseif ($url == 'permisos_estado') {

    require_once "../app/Controllers/PermisoController.php";

    $controller = new PermisoController();
    $controller->estado();
}

elseif ($url == 'roles') {

    autorizar('roles');

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->index();
}

elseif ($url == 'roles_store') {

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->store();
}

elseif ($url == 'roles_edit') {

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->edit();
}

elseif ($url == 'roles_update') {

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->update();
}

elseif ($url == 'roles_estado') {

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->estado();
}

elseif ($url == 'roles_permisos') {

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->permisos();

}

elseif ($url == 'roles_permisos_guardar') {

    require_once "../app/Controllers/RolController.php";

    $controller = new RolController();
    $controller->guardarPermisos();

}

elseif ($url == 'logout') {

    session_destroy();

    header("Location: index.php?url=login");
}
/*
|-------------------------
| 404
|-------------------------
*/
else {

    echo "404 - Página no encontrada";
}