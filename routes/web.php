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
//ESTUDIO TARIFARIO
elseif ($url == 'estudioTarifario') {
    autorizar('estudioTarifario');
    require_once "../app/Controllers/EstudioTarifarioController.php";
    $controller = new EstudioTarifarioController();
    $controller->index();
}
elseif ($url == 'estudioTarifario_store') {
    require_once "../app/Controllers/EstudioTarifarioController.php";
    $controller = new EstudioTarifarioController();
    $controller->store();
}
elseif ($url == 'estudioTarifario_edit') {
    require_once "../app/Controllers/EstudioTarifarioController.php";
    $controller = new EstudioTarifarioController();
    $controller->edit();
}
elseif ($url == 'estudioTarifario_update') {
    require_once "../app/Controllers/EstudioTarifarioController.php";
    $controller = new EstudioTarifarioController();
    $controller->update();
}
elseif ($url == 'estudioTarifario_estado') {
    require_once "../app/Controllers/EstudioTarifarioController.php";
    $controller = new EstudioTarifarioController();
    $controller->estado();
}
/*
|-------------------------
| FONDOS
|-------------------------
*/
elseif ($url == 'fondos') {
    autorizar('fondos');
    require_once "../app/Controllers/FondoController.php";
    $controller = new FondoController();
    $controller->index();
}
elseif ($url == 'fondos_store') {
    require_once "../app/Controllers/FondoController.php";
    $controller = new FondoController();
    $controller->store();
}
elseif ($url == 'fondos_edit') {
    require_once "../app/Controllers/FondoController.php";
    $controller = new FondoController();
    $controller->edit();
}
elseif ($url == 'fondos_update') {
    require_once "../app/Controllers/FondoController.php";
    $controller = new FondoController();
    $controller->update();
}
elseif ($url == 'fondos_estado') {
    require_once "../app/Controllers/FondoController.php";
    $controller = new FondoController();
    $controller->estado();
}
/*
|-------------------------
| GERENCIAS
|-------------------------
*/
elseif ($url == 'gerencias') {
    autorizar('gerencias');
    require_once "../app/Controllers/GerenciaController.php";
    $controller = new GerenciaController();
    $controller->index();
}
elseif ($url == 'gerencias_store') {
    require_once "../app/Controllers/GerenciaController.php";
    $controller = new GerenciaController();
    $controller->store();
}
elseif ($url == 'gerencias_edit') {
    require_once "../app/Controllers/GerenciaController.php";
    $controller = new GerenciaController();
    $controller->edit();
}
elseif ($url == 'gerencias_update') {
    require_once "../app/Controllers/GerenciaController.php";
    $controller = new GerenciaController();
    $controller->update();
}
elseif ($url == 'gerencias_estado') {
    require_once "../app/Controllers/GerenciaController.php";
    $controller = new GerenciaController();
    $controller->estado();
}
/*
|-------------------------
| ÁREAS
|-------------------------
*/
elseif ($url == 'areas') {
    autorizar('areas');
    require_once "../app/Controllers/AreaController.php";
    $controller = new AreaController();
    $controller->index();
}
elseif ($url == 'areas_store') {
    require_once "../app/Controllers/AreaController.php";
    $controller = new AreaController();
    $controller->store();
}
elseif ($url == 'areas_edit') {
    require_once "../app/Controllers/AreaController.php";
    $controller = new AreaController();
    $controller->edit();
}
elseif ($url == 'areas_update') {
    require_once "../app/Controllers/AreaController.php";
    $controller = new AreaController();
    $controller->update();
}
elseif ($url == 'areas_estado') {
    require_once "../app/Controllers/AreaController.php";
    $controller = new AreaController();
    $controller->estado();
}
/*
|-------------------------
| INVERSIONES
|-------------------------
*/
elseif ($url == 'inversiones') {
    autorizar('inversiones');
    require_once "../app/Controllers/InversionController.php";
    $controller = new InversionController();
    $controller->index();
}
elseif ($url == 'inversiones_store') {
    require_once "../app/Controllers/InversionController.php";
    $controller = new InversionController();
    $controller->store();
}
elseif ($url == 'inversiones_edit') {
    require_once "../app/Controllers/InversionController.php";
    $controller = new InversionController();
    $controller->edit();
}
elseif ($url == 'inversiones_update') {
    require_once "../app/Controllers/InversionController.php";
    $controller = new InversionController();
    $controller->update();
}
elseif ($url == 'inversiones_estado') {
    require_once "../app/Controllers/InversionController.php";
    $controller = new InversionController();
    $controller->estado();
}
/*
|-------------------------
| AÑO REGULATORIO
|-------------------------
*/
elseif ($url == 'anioregulatorio') {
    autorizar('anioregulatorio');
    require_once "../app/Controllers/AnioRegulatorioController.php";
    $controller = new AnioRegulatorioController();
    $controller->index();
}
elseif ($url == 'anioregulatorio_store') {
    require_once "../app/Controllers/AnioRegulatorioController.php";
    $controller = new AnioRegulatorioController();
    $controller->store();
}
elseif ($url == 'anioregulatorio_edit') {
    require_once "../app/Controllers/AnioRegulatorioController.php";
    $controller = new AnioRegulatorioController();
    $controller->edit();
}
elseif ($url == 'anioregulatorio_update') {
    require_once "../app/Controllers/AnioRegulatorioController.php";
    $controller = new AnioRegulatorioController();
    $controller->update();
}
/*
|-------------------------
| EJECUCIÓN MENSUAL
|-------------------------
*/
elseif ($url == 'ejecucionmensual_store') {
    require_once "../app/Controllers/EjecucionMensualController.php";
    $controller = new EjecucionMensualController();
    $controller->store();
}
elseif ($url == 'ejecucionmensual_lista') {
    require_once "../app/Controllers/EjecucionMensualController.php";
    $controller = new EjecucionMensualController();
    $controller->lista();
}
elseif ($url == 'ejecucionmensual_show') {
    require_once "../app/Controllers/EjecucionMensualController.php";
    $controller = new EjecucionMensualController();
    $controller->show();
}

/*
|-------------------------
| SEGUIMIENTO MENSUAL
|-------------------------
*/
elseif ($url == 'seguimientomensual_store') {
    require_once "../app/Controllers/SeguimientoMensualController.php";
    $controller = new SeguimientoMensualController();
    $controller->store();
}
elseif ($url == 'seguimientomensual_lista') {
    require_once "../app/Controllers/SeguimientoMensualController.php";
    $controller = new SeguimientoMensualController();
    $controller->lista();
}
elseif ($url == 'seguimientomensual_show') {
    require_once "../app/Controllers/SeguimientoMensualController.php";
    $controller = new SeguimientoMensualController();
    $controller->show();
}
elseif ($url == 'seguimientomensual_delete') {

    require_once "../app/Controllers/SeguimientoMensualController.php";

    $controller = new SeguimientoMensualController();

    $controller->delete();

}

/*
|-------------------------
| DOCUMENTOS
|-------------------------
*/
elseif ($url == 'documento_store') {

    require_once "../app/Controllers/DocumentoController.php";

    $controller = new DocumentoController();

    $controller->store();

}
elseif ($url == 'documento_lista') {

    require_once "../app/Controllers/DocumentoController.php";

    $controller = new DocumentoController();

    $controller->lista();

}
elseif ($url == 'documento_download') {

    require_once "../app/Controllers/DocumentoController.php";

    $controller = new DocumentoController();

    $controller->download();

}
elseif ($url == 'documento_delete') {

    require_once "../app/Controllers/DocumentoController.php";

    $controller = new DocumentoController();

    $controller->delete();

}
//EJECUCION MENSUAL
elseif ($url == 'ejecucionmensual_descargar') {

    require_once "../app/Controllers/EjecucionMensualController.php";

    $controller = new EjecucionMensualController();

    $controller->descargar();

}
elseif ($url == 'ejecucionmensual_download') {

    require_once "../app/Controllers/EjecucionMensualController.php";

    $controller = new EjecucionMensualController();

    $controller->download();

}
elseif ($url == 'ejecucionmensual_ver') {

    require_once "../app/Controllers/EjecucionMensualController.php";

    $controller = new EjecucionMensualController();

    $controller->ver();

}
elseif ($url == 'ejecucionmensual_delete') {

    require_once "../app/Controllers/EjecucionMensualController.php";

    $controller = new EjecucionMensualController();

    $controller->delete();

}
//USUARIO_AREAS
elseif ($url == 'usuarioarea_lista') {
    require_once "../app/Controllers/UsuarioAreaController.php";
    $controller = new UsuarioAreaController();
    $controller->listar();
}
elseif ($url == 'usuarioarea_guardar') {
    require_once "../app/Controllers/UsuarioAreaController.php";
    $controller = new UsuarioAreaController();
    $controller->guardar();
}
elseif ($url == 'usuarioarea_eliminar') {
    require_once "../app/Controllers/UsuarioAreaController.php";
    $controller = new UsuarioAreaController();
    $controller->eliminar();
}
elseif ($url == 'usuarioarea_por_area') {
    require_once "../app/Controllers/UsuarioAreaController.php";
    $controller = new UsuarioAreaController();
    $controller->usuariosPorArea();
}
elseif ($url == 'usuarioarea_areas') {
    require_once "../app/Controllers/UsuarioAreaController.php";
    $controller = new UsuarioAreaController();
    $controller->areas();
}

// DASHBOARD EJECUTIVO DE INVERSIÓN
elseif ($url == 'dashboardInversion') {
    autorizar('dashboardInversion');
    require_once "../app/Controllers/DashboardInversionController.php";
    $controller = new DashboardInversionController();
    $controller->index();
}

// REPORTES
elseif ($url == 'reportes') {

    autorizar('reportes');

    require_once "../app/Controllers/ReporteController.php";

    $controller = new ReporteController();
    $controller->index();
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