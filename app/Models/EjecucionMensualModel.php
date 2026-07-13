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
            fisico,
            fechaCreado
        )
        VALUES
        (
            :idAnioRegulatorio,
            :mes,
            :programado,
            :ejecutado,
            :fisico,
            NOW()
        )
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':idAnioRegulatorio' =>
            $data['idAnioRegulatorio'],
            ':mes' =>
            $data['mes'],
            ':programado' =>
            $data['programado'],
            ':ejecutado' =>
            $data['ejecutado'],
            ':fisico' =>
            $data['fisico']
        ]);
    }
    public function getByAnio($idAnioRegulatorio)
    {
        $sql = "
            SELECT
                idEjecucionMensual,
                mes,
                ejecutado,
                fisico
            FROM ejecucion_mensual
            WHERE idAnioRegulatorio = :id
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
            ejecutado
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
            fisico = :fisico,
            fechaActualizado = NOW()

        WHERE idEjecucionMensual = :id
    ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':mes' =>
            $data['mes'],

            ':programado' =>
            $data['programado'],

            ':ejecutado' =>
            $data['ejecutado'],

            ':fisico' =>
            $data['fisico'],

            ':id' =>
            $id

        ]);
    }
}
