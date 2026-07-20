<?php
class EjecucionMensualModel
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
            INSERT INTO ejecucion_mensual
            (
                idAnioRegulatorio,
                mes,
                programado,
                ejecutado,
                igv,
                total,
                archivo,
                fisico,
                fechaCreado
            )
            VALUES
            (
                :idAnioRegulatorio,
                :mes,
                :programado,
                :ejecutado,
                :igv,
                :total,
                :archivo,
                :fisico,
                NOW()
            )
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':idAnioRegulatorio' => $data['idAnioRegulatorio'],
            ':mes'               => $data['mes'],
            ':programado'        => $data['programado'],
            ':ejecutado'         => $data['ejecutado'],
            ':igv'               => $data['igv'],
            ':total'             => $data['total'],
            ':archivo'           => $data['archivo'] ?? null,
            ':fisico'            => $data['fisico']
        ]);
    }
    public function getByAnio($idAnioRegulatorio)
    {
        $sql = "
            SELECT
                idEjecucionMensual,
                mes,
                ejecutado,
                igv,
                total,
                archivo,
                fisico
            FROM ejecucion_mensual
            WHERE idAnioRegulatorio = :id
            AND estado = 1
            ORDER BY mes ASC
            ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $idAnioRegulatorio
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT
                idEjecucionMensual,
                idAnioRegulatorio,
                mes,
                ejecutado,
                igv,
                total,
                archivo
            FROM ejecucion_mensual
            WHERE idEjecucionMensual = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $data)
    {
        $sql = "
            UPDATE ejecucion_mensual
            SET
                mes = :mes,
                programado = :programado,
                ejecutado = :ejecutado,
                igv = :igv,
                total = :total,
                fisico = :fisico
        ";
        // Solo actualizar el archivo si se subió uno nuevo
        if (isset($data['archivo'])) {
            $sql .= ",
                archivo = :archivo
            ";
        }
        $sql .= "
            ,
            fechaActualizado = NOW()
            WHERE idEjecucionMensual = :id
        ";
        $stmt = $this->db->prepare($sql);
        $params = [
            ':mes' => $data['mes'],
            ':programado' => $data['programado'],
            ':ejecutado' => $data['ejecutado'],
            ':igv' => $data['igv'],
            ':total' => $data['total'],
            ':fisico' => $data['fisico'],
            ':id' => $id
        ];
        if (isset($data['archivo'])) {
            $params[':archivo'] = $data['archivo'];
        }
        return $stmt->execute($params);
    }
    public function obtenerArchivo($id)
    {
        $sql = "
        SELECT archivo
        FROM ejecucion_mensual
        WHERE idEjecucionMensual = ?
    ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // =====================================
    // DESACTIVAR EJECUCIÓN MENSUAL
    // =====================================
    public function cambiarEstado($id)
    {
        $sql = "
            DELETE FROM ejecucion_mensual
            WHERE idEjecucionMensual = :id
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
