<?php

class SeguimientoMensualModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR
    |--------------------------------------------------------------------------
    */
    public function create($data)
    {
        $sql = "
            INSERT INTO seguimiento_mensual
            (
                idAnioRegulatorio,
                producto,
                estadoInver,
                acciones,
                fechas,
                situacion,
                fechaCreado
            )
            VALUES
            (
                :idAnioRegulatorio,
                :producto,
                :estadoInver,
                :acciones,
                :fechas,
                :situacion,
                NOW()
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idAnioRegulatorio' => $data['idAnioRegulatorio'],
            ':producto'          => $data['producto'],
            ':estadoInver'       => $data['estadoInver'],
            ':acciones'          => $data['acciones'],
            ':fechas'             => $data['fechas'],
            ':situacion'         => $data['situacion']
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR POR AÑO REGULATORIO
    |--------------------------------------------------------------------------
    */
    public function getByAnio($idAnioRegulatorio)
    {
        $sql = "
            SELECT
                idSeguimientoMensual,
                producto,
                estadoInver,
                acciones,
                fechas,
                situacion
            FROM seguimiento_mensual
            WHERE idAnioRegulatorio = :id AND estado = 1
            ORDER BY fechas ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $idAnioRegulatorio
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | OBTENER POR ID
    |--------------------------------------------------------------------------
    */
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT
                idSeguimientoMensual,
                idAnioRegulatorio,
                producto,
                estadoInver,
                acciones,
                fechas,
                situacion
            FROM seguimiento_mensual
            WHERE idSeguimientoMensual = ?
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR
    |--------------------------------------------------------------------------
    */
    public function update($id, $data)
    {
        $sql = "
            UPDATE seguimiento_mensual
            SET
                producto = :producto,
                estadoInver = :estadoInver,
                acciones = :acciones,
                fechas = :fechas,
                situacion = :situacion,
                fechaActualizado = NOW()
            WHERE idSeguimientoMensual = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':producto'    => $data['producto'],
            ':estadoInver' => $data['estadoInver'],
            ':acciones'    => $data['acciones'],
            ':fechas'       => $data['fechas'],
            ':situacion'   => $data['situacion'],
            ':id'          => $id
        ]);
    }
    public function delete($id)
    {
        $sql = "
            UPDATE seguimiento_mensual
            SET estado = 0
            WHERE idSeguimientoMensual = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}
