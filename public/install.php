<?php

require_once "../config/conexion.php";

$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios
(
    usuario,
    contrasena,
    nombres,
    apellidos,
    correo,
    estado,
    fechaCreado
)
VALUES
(
    :usuario,
    :contrasena,
    :nombres,
    :apellidos,
    :correo,
    1,
    NOW()
)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    ":usuario"=>"admin",
    ":contrasena"=>$password,
    ":nombres"=>"Roman",
    ":apellidos"=>"Administrador",
    ":correo"=>"admin@empresa.com"
]);

$idUser = $conexion->lastInsertId();

$sql = "INSERT INTO usuario_rol
(
    idUser,
    idRol,
    fechaCreado
)
VALUES
(
    :idUser,
    1,
    NOW()
)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    ":idUser"=>$idUser
]);

echo "Administrador creado.";