<?php

function autenticado()
{
    return isset($_SESSION['idUser']);
}

function requiereLogin()
{
    if (!autenticado()) {
        header("Location: index.php?url=login");
        exit;
    }
}

function permiso($permiso)
{
    if (!isset($_SESSION['permisos'])) {
        return false;
    }

    return in_array($permiso, $_SESSION['permisos']);
}

function autorizar($permiso)
{
    requiereLogin();

    if (!permiso($permiso)) {
        header("Location: index.php?url=bienvenida");
        exit;
    }
}