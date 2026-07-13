<?php

class AreaModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // LISTAR ÁREAS
    public function getAll()
    {
        $sql = "SELECT
                    a.idAreas,
                    a.idGerencias,
                    g.nombreGerencia,
                    a.siglasArea,
                    a.nombreArea,
                    a.estadoArea,
                    a.fechaCreado,
                    a.fechaActualizado
                FROM areas a
                INNER JOIN gerencias g
                    ON g.idGerencias = a.idGerencias
                ORDER BY a.nombreArea";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER ÁREA
    public function getById($id)
    {
        $sql = "SELECT
                    idAreas,
                    idGerencias,
                    siglasArea,
                    nombreArea
                FROM areas
                WHERE idAreas = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // COMBO GERENCIAS
    public function getGerencias()
    {
        $sql = "SELECT
                    idGerencias,
                    nombreGerencia
                FROM gerencias
                WHERE estadoGerencia = 1
                ORDER BY nombreGerencia";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // REGISTRAR
    public function create($data)
    {
        $sql = "INSERT INTO areas
                (
                    idGerencias,
                    siglasArea,
                    nombreArea,
                    estadoArea,
                    fechaCreado
                )
                VALUES
                (
                    :idGerencias,
                    :siglasArea,
                    :nombreArea,
                    1,
                    NOW()
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idGerencias' => $data['idGerencias'],
            ':siglasArea'  => $data['siglasArea'],
            ':nombreArea'  => $data['nombreArea']
        ]);
    }

    // ACTUALIZAR
    public function update($id, $data)
    {
        $sql = "UPDATE areas
                SET
                    idGerencias = :idGerencias,
                    siglasArea = :siglasArea,
                    nombreArea = :nombreArea,
                    fechaActualizado = NOW()
                WHERE idAreas = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idGerencias' => $data['idGerencias'],
            ':siglasArea'  => $data['siglasArea'],
            ':nombreArea'  => $data['nombreArea'],
            ':id'          => $id
        ]);
    }

    // CAMBIAR ESTADO
    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE areas
                SET estadoArea = :estado
                WHERE idAreas = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id'     => $id
        ]);
    }

    // VALIDAR NOMBRE REPETIDO
    public function existeArea($nombre, $id = null)
    {
        if ($id == null) {

            $sql = "SELECT COUNT(*)
                    FROM areas
                    WHERE nombreArea = :nombreArea";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':nombreArea' => $nombre
            ]);

        } else {

            $sql = "SELECT COUNT(*)
                    FROM areas
                    WHERE nombreArea = :nombreArea
                    AND idAreas <> :id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':nombreArea' => $nombre,
                ':id' => $id
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }
}