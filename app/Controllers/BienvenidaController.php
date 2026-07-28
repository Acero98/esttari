<?php

require_once "../config/conexion.php";

class BienvenidaController
{
    public function index()
    {
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/bienvenida/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
}