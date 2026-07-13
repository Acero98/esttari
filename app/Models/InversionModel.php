<?php

class InversionModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // LISTAR INVERSIONES
    public function getAll()
    {
        $sql = "SELECT
                    i.idInversiones,
                    i.idFondos,
                    i.idAreas,
                    f.nombreFondo,
                    a.nombreArea,
                    i.cui,
                    i.descripcion,
                    i.nombre,
                    i.observaciones,
                    i.estado,
                    i.fechaCreado
                FROM inversiones i
                INNER JOIN fondos f
                    ON i.idFondos = f.idFondos
                INNER JOIN areas a
                    ON i.idAreas = a.idAreas
                ORDER BY i.descripcion";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER INVERSIÓN
    public function getById($id)
    {
        $sql = "SELECT
                    idInversiones,
                    idFondos,
                    idAreas,
                    cui,
                    descripcion,
                    nombre,
                    observaciones
                FROM inversiones
                WHERE idInversiones = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // LISTAR FONDOS
    public function getFondos()
    {
        $sql = "SELECT
                    idFondos,
                    nombreFondo
                FROM fondos
                WHERE estadoFondo = 1
                ORDER BY nombreFondo";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // LISTAR ÁREAS
    public function getAreas()
    {
        $sql = "SELECT
                    idAreas,
                    nombreArea
                FROM areas
                WHERE estadoArea = 1
                ORDER BY nombreArea";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // REGISTRAR
    public function create($data)
    {
        $sql = "INSERT INTO inversiones
                (
                    idFondos,
                    idAreas,
                    cui,
                    descripcion,
                    nombre,
                    observaciones,
                    estado,
                    fechaCreado
                )
                VALUES
                (
                    :idFondos,
                    :idAreas,
                    :cui,
                    :descripcion,
                    :nombre,
                    :observaciones,
                    1,
                    NOW()
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idFondos'      => $data['idFondos'],
            ':idAreas'       => $data['idAreas'],
            ':cui'           => empty($data['cui']) ? null : $data['cui'],
            ':descripcion'   => $data['descripcion'],
            ':nombre'        => $data['nombre'],
            ':observaciones' => $data['observaciones']
        ]);
    }

    // ACTUALIZAR
    public function update($id, $data)
    {
        $sql = "UPDATE inversiones
                SET
                    idFondos = :idFondos,
                    idAreas = :idAreas,
                    cui = :cui,
                    descripcion = :descripcion,
                    nombre = :nombre,
                    observaciones = :observaciones
                WHERE idInversiones = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idFondos'      => $data['idFondos'],
            ':idAreas'       => $data['idAreas'],
            ':cui'           => $data['cui'],
            ':descripcion'   => $data['descripcion'],
            ':nombre'        => $data['nombre'],
            ':observaciones' => $data['observaciones'],
            ':id'            => $id
        ]);
    }

    // CAMBIAR ESTADO
    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE inversiones
                SET estado = :estado
                WHERE idInversiones = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id'     => $id
        ]);
    }

    // VALIDAR CUI
    public function existeCui($cui, $id = null)
    {
        if (empty($cui)) {
            return false;
        }

        if ($id == null) {

            $sql = "SELECT COUNT(*)
                    FROM inversiones
                    WHERE cui = :cui";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':cui' => $cui
            ]);

        } else {

            $sql = "SELECT COUNT(*)
                    FROM inversiones
                    WHERE cui = :cui
                    AND idInversiones <> :id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':cui' => $cui,
                ':id'  => $id
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }
}