<?php
class AnioRegulatorioModel
{
    private $db;
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    // LISTAR AÑOS POR INVERSIÓN
    public function getByInversion($idInversion)
    {
        $sql = "SELECT
                    ar.idAnioRegulatorio,
                    ar.anio,
                    ar.programado,
                    ar.ejecutado,
                    ar.rdr,
                    ar.et,
                    ar.avanceFisico,
                    ar.observaciones,
                    et.nombre AS estudioTarifario,
                    et.anioInicio,
                    et.anioFin
                FROM anio_regulatorio ar
                LEFT JOIN estudio_tarifario et
                    ON et.idEstudioTarifario = ar.idEstudioTarifario
                WHERE ar.idInversiones = :idInversion
                ORDER BY ar.anio";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':idInversion' => $idInversion
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // OBTENER AÑO REGULATORIO
    public function getById($id)
    {
        $sql = "SELECT
                ar.*,
                i.nombre AS inversion,
                et.nombre AS estudioTarifario,
                et.anioInicio,
                et.anioFin
            FROM anio_regulatorio ar
            LEFT JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            LEFT JOIN estudio_tarifario et
                ON et.idEstudioTarifario = i.idEstudioTarifario
            WHERE ar.idAnioRegulatorio=:id
            LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $sql = "INSERT INTO anio_regulatorio
    (
        idEstudioTarifario,
        idInversiones,
        anio,
        programado,
        ejecutado,
        rdr,
        et,
        avanceFisico,
        observaciones,
        fechaCreado
    )
    VALUES
    (
        :idEstudioTarifario,
        :idInversiones,
        :anio,
        :programado,
        :ejecutado,
        :rdr,
        :et,
        :avanceFisico,
        :observaciones,
        NOW()
    )";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':idEstudioTarifario' => $data['idEstudioTarifario'],
            ':idInversiones' => $data['idInversiones'],
            ':anio' => $data['anio'],
            ':programado' => $data['programado'],
            ':ejecutado' => $data['ejecutado'],
            ':rdr' => $data['rdr'],
            ':et' => $data['et'],
            ':avanceFisico' => $data['avanceFisico'],
            ':observaciones' => $data['observaciones']
        ]);
    }
    public function existeAnio($idInversiones, $anio)
    {
        $sql = "
        SELECT COUNT(*)
        FROM anio_regulatorio
        WHERE idInversiones=:id
        AND anio=:anio
    ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $idInversiones,
            ':anio' => $anio
        ]);
        return $stmt->fetchColumn() > 0;
    }
    public function update($id, $data)
    {
        $sql = "UPDATE anio_regulatorio
            SET
                anio = :anio,
                programado = :programado,
                ejecutado = :ejecutado,
                rdr = :rdr,
                et = :et,
                avanceFisico = :avanceFisico,
                observaciones = :observaciones,
                fechaActualizado = NOW()
            WHERE idAnioRegulatorio = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':anio' => $data['anio'],
            ':programado' => $data['programado'],
            ':ejecutado' => $data['ejecutado'],
            ':rdr' => $data['rdr'],
            ':et' => $data['et'],
            ':avanceFisico' => $data['avanceFisico'],
            ':observaciones' => $data['observaciones'],
            ':id' => $id
        ]);
    }
    public function obtenerEstudioTarifarioPorInversion($idInversion)
    {
        $sql = "
            SELECT
                et.idEstudioTarifario,
                et.nombre,
                et.anioInicio,
                et.anioFin
            FROM inversiones i
            INNER JOIN estudio_tarifario et
                ON et.idEstudioTarifario = i.idEstudioTarifario
            WHERE i.idInversiones = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idInversion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
