<?php

class UsuarioAreaModel
{
    private $db;


    public function __construct($conexion)
    {
        $this->db = $conexion;
    }


    /**
     * Listar áreas asignadas a un usuario
     */
    public function obtenerPorUsuario($idUser)
    {
        $sql = "
            SELECT 
                ua.idUsuariosAreas,
                ua.idUser,
                ua.idAreas,
                ua.fechaCreado,
                a.nombreArea
            FROM usuarios_areas ua
            INNER JOIN areas a 
                ON a.idAreas = ua.idAreas
            WHERE ua.idUser = ?
            ORDER BY a.nombreArea
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $idUser
        ]);


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * Listar usuarios asignados a un área
     */
    public function obtenerPorArea($idAreas)
    {
        $sql = "
            SELECT 
                ua.idUsuariosAreas,
                ua.idUser,
                ua.fechaCreado,
                u.nombre,
                u.apellido,
                u.usuario
            FROM usuarios_areas ua
            INNER JOIN usuarios u
                ON u.idUser = ua.idUser
            WHERE ua.idAreas = ?
            ORDER BY u.nombre
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $idAreas
        ]);


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * Asignar área a usuario
     */
    public function asignar($idUser, $idAreas)
    {
        $sql = "
            INSERT INTO usuarios_areas
            (
                idUser,
                idAreas,
                fechaCreado
            )
            VALUES
            (
                ?,
                ?,
                NOW()
            )
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([
            $idUser,
            $idAreas
        ]);
    }



    /**
     * Eliminar una asignación específica
     */
    public function eliminar($idUsuariosAreas)
    {
        $sql = "
            DELETE FROM usuarios_areas
            WHERE idUsuariosAreas = ?
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([
            $idUsuariosAreas
        ]);
    }



    /**
     * Sincronizar áreas seleccionadas desde el modal
     */
    public function sincronizar($idUser, $areas)
    {
        try {

            $this->db->beginTransaction();


            // Eliminar asignaciones actuales
            $sql = "
                DELETE FROM usuarios_areas
                WHERE idUser = ?
            ";


            $stmt = $this->db->prepare($sql);


            $stmt->execute([
                $idUser
            ]);



            // Registrar nuevas asignaciones
            foreach ($areas as $idAreas) {

                $this->asignar(
                    $idUser,
                    $idAreas
                );
            }



            $this->db->commit();


            return true;
        } catch (Exception $e) {


            $this->db->rollBack();


            return false;
        }
    }



    /**
     * Obtener todas las áreas disponibles
     */
    public function obtenerTodasLasAreas()
    {
        $sql = "
            SELECT
                idAreas,
                nombreArea
            FROM areas
            WHERE estadoArea = 1
            ORDER BY nombreArea
        ";


        $stmt = $this->db->prepare($sql);


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
