<?php

function permiso($permiso)
{
    if (!isset($_SESSION['permisos'])) {
        return false;
    }

    return in_array($permiso, $_SESSION['permisos']);
}

function autorizar($permiso)
{
    if (!permiso($permiso)) {
        header("Location: index.php?url=bienvenida");
        exit;
    }
}