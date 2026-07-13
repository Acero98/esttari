<?php
class SeguimientoModel
{
    private $db;
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    // OBTENER TODO EL SEGUIMIENTO DEL AÑO
    public function getResumenMensual($idAnioRegulatorio)
    {
        $sql = "SELECT
                em.idEjecucionMensual,
                em.mes,
                em.programado,
                em.ejecutado,
                em.fisico,
                sm.idSeguimientoMensual,
                sm.producto,
                sm.estadoInver,
                sm.acciones,
                sm.fechas,
                sm.situacion
              FROM ejecucion_mensual em
              LEFT JOIN seguimiento_mensual sm
                ON sm.idEjecucionMensual =
                   em.idEjecucionMensual
              WHERE em.idAnioRegulatorio=:id
              ORDER BY CAST(em.mes AS UNSIGNED)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $idAnioRegulatorio
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // OBTENER MESES DE EJECUCIÓN
    public function getEjecuciones($idAnioRegulatorio)
    {
        $sql = "SELECT *
              FROM ejecucion_mensual
              WHERE idAnioRegulatorio=:id
              ORDER BY CAST(mes AS UNSIGNED)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $idAnioRegulatorio
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // GUARDAR SEGUIMIENTO
    public function create($data)
    {
        $sql = "INSERT INTO seguimiento_mensual
        (
            idEjecucionMensual,
            producto,
            estadoInver,
            acciones,
            fechas,
            situacion,
            fechaCreado
        )
        VALUES
        (
            :idEjecucionMensual,
            :producto,
            :estadoInver,
            :acciones,
            :fechas,
            :situacion,
            NOW()
        )";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':idEjecucionMensual' => $data['idEjecucionMensual'],
            ':producto' => $data['producto'],
            ':estadoInver' => $data['estadoInver'],
            ':acciones' => $data['acciones'],
            ':fechas' => $data['fechas'],
            ':situacion' => $data['situacion']
        ]);
    }
    // OBTENER SEGUIMIENTO POR ID
    public function getById($id)
    {
        $sql = "SELECT *
              FROM seguimiento_mensual
              WHERE idSeguimientoMensual=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // ACTUALIZAR
    public function update($id, $data)
    {
        $sql = "UPDATE seguimiento_mensual
              SET
                producto=:producto,
                estadoInver=:estadoInver,
                acciones=:acciones,
                fechas=:fechas,
                situacion=:situacion,
                fechaActualizado=NOW()
              WHERE idSeguimientoMensual=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':producto' => $data['producto'],
            ':estadoInver' => $data['estadoInver'],
            ':acciones' => $data['acciones'],
            ':fechas' => $data['fechas'],
            ':situacion' => $data['situacion'],
            ':id' => $id
        ]);
    }
}
