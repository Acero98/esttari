<?php
class FondoModel
{
    private $db;
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    public function getAll()
    {
        $sql = "
            SELECT *
            FROM fondos
            ORDER BY nombreFondo
        ";
        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id)
    {
        $sql = "
            SELECT *
            FROM fondos
            WHERE idFondos = :id
            LIMIT 1
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $sql = "
            INSERT INTO fondos
            (
                codigoFondo,
                nombreFondo,
                descripcionFondo,
                fechaCreado
            )
            VALUES
            (
                :codigoFondo,
                :nombreFondo,
                :descripcionFondo,
                NOW()
            )
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':codigoFondo' => $data['codigoFondo'],
            ':nombreFondo' => $data['nombreFondo'],
            ':descripcionFondo' => $data['descripcionFondo']
        ]);
    }
    public function update($id, $data)
    {
        $sql = "
            UPDATE fondos
            SET
                codigoFondo=:codigoFondo,
                nombreFondo=:nombreFondo,
                descripcionFondo=:descripcionFondo,
                fechaActualiuzado=NOW()
            WHERE idFondos=:id
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':codigoFondo' => $data['codigoFondo'],
            ':nombreFondo' => $data['nombreFondo'],
            ':descripcionFondo' => $data['descripcionFondo'],
            ':id' => $id
        ]);
    }
    public function existeFondo($codigoFondo, $id = null)
    {
        if ($id == null) {
            $sql = "
                SELECT COUNT(*)
                FROM fondos
                WHERE codigoFondo=:codigoFondo
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':codigoFondo' => $codigoFondo
            ]);
        } else {
            $sql = "
                SELECT COUNT(*)
                FROM fondos
                WHERE codigoFondo=:codigoFondo
                AND idFondos<>:id
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':codigoFondo' => $codigoFondo,
                ':id' => $id
            ]);
        }
        return $stmt->fetchColumn() > 0;
    }
    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE fondos
            SET estadoFondo = :estado
            WHERE idFondos = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $id
        ]);
    }
}
