<?php

class AuthModel
{

    private $db;


    public function __construct($conexion)
    {
        $this->db = $conexion;
    }


    // Datos principales del usuario
    public function obtenerUsuario($idUser)
    {

        $sql = "
            SELECT 
                u.idUser,
                u.idRol,
                r.nombreRol
            FROM usuarios u
            INNER JOIN roles r
            ON r.idRol = u.idRol
            WHERE u.idUser = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idUser]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    // Areas asignadas al usuario
    public function obtenerAreasUsuario($idUser)
    {

        $sql = "
            SELECT 
                a.idAreas,
                a.idGerencias,
                a.nombreArea
            FROM usuarios_areas ua

            INNER JOIN areas a
            ON a.idAreas = ua.idAreas

            WHERE ua.idUser = ?
        ";


        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idUser]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioSeguridad($idUser)
    {
        $sql = "
            SELECT 
                u.idUser,
                u.idRol,
                r.nombreRol,
                ua.idAreas,
                a.nombreArea,
                a.idGerencias
            FROM usuarios u

            INNER JOIN roles r
            ON r.idRol = u.idRol

            LEFT JOIN usuarios_areas ua
            ON ua.idUser = u.idUser

            LEFT JOIN areas a
            ON a.idAreas = ua.idAreas

            WHERE u.idUser = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idUser]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
