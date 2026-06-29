<?php

$host = "localhost";
$db   = "bd_seprin";
$user = "root";
$pass = "QvcPeru23$";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Error de conexión: " . $e->getMessage());
}