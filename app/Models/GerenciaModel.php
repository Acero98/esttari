<?php

class GerenciaModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // LISTAR GERENCIAS
    public function getAll()
    {
        $sql = "SELECT
                    idGerencias,
                    siglasGerencia,
                    nombreGerencia,
                    estadoGerencia,
                    fechaCreado,
                    fechaActualizado
                FROM gerencias
                ORDER BY nombreGerencia";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER GERENCIA
    public function getById($id)
    {
        $sql = "SELECT
                    idGerencias,
                    siglasGerencia,
                    nombreGerencia,
                    estadoGerencia
                FROM gerencias
                WHERE idGerencias = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // REGISTRAR
    public function create($data)
    {
        $sql = "INSERT INTO gerencias
                (
                    siglasGerencia,
                    nombreGerencia,
                    estadoGerencia,
                    fechaCreado
                )
                VALUES
                (
                    :siglasGerencia,
                    :nombreGerencia,
                    1,
                    NOW()
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':siglasGerencia' => $data['siglasGerencia'],
            ':nombreGerencia' => $data['nombreGerencia']
        ]);
    }

    // ACTUALIZAR
    public function update($id, $data)
    {
        $sql = "UPDATE gerencias
                SET
                    siglasGerencia = :siglasGerencia,
                    nombreGerencia = :nombreGerencia,
                    fechaActualizado = NOW()
                WHERE idGerencias = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':siglasGerencia' => $data['siglasGerencia'],
            ':nombreGerencia' => $data['nombreGerencia'],
            ':id' => $id
        ]);
    }

    // CAMBIAR ESTADO
    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE gerencias
                SET
                    estadoGerencia = :estado,
                    fechaActualizado = NOW()
                WHERE idGerencias = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $id
        ]);
    }

    // VALIDAR DUPLICADOS
    public function existeGerencia($nombreGerencia, $id = null)
    {
        if ($id == null) {

            $sql = "SELECT COUNT(*)
                    FROM gerencias
                    WHERE nombreGerencia = :nombreGerencia";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':nombreGerencia' => $nombreGerencia
            ]);

        } else {

            $sql = "SELECT COUNT(*)
                    FROM gerencias
                    WHERE nombreGerencia = :nombreGerencia
                    AND idGerencias <> :id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':nombreGerencia' => $nombreGerencia,
                ':id' => $id
            ]);

        }

        return $stmt->fetchColumn() > 0;
    }
}