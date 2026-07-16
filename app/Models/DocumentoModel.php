<?php

class DocumentoModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // LISTAR DOCUMENTOS
    public function getByInversion($idInversiones)
    {
        $sql = "SELECT
                    idDocumento,
                    tipoDocumento,
                    nombreOriginal,
                    nombreGuardado,
                    ruta,
                    tipoMime,
                    tamanio,
                    observacion,
                    fechaRegistro
                FROM documentos_inversion
                WHERE idInversiones = :id
                AND estado = 1
                ORDER BY fechaRegistro DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $idInversiones
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GUARDAR DOCUMENTO
    public function create($data)
    {
        $sql = "INSERT INTO documentos_inversion
                (
                    idInversiones,
                    tipoDocumento,
                    nombreOriginal,
                    nombreGuardado,
                    ruta,
                    tipoMime,
                    tamanio,
                    observacion,
                    estado,
                    fechaRegistro
                )
                VALUES
                (
                    :idInversiones,
                    :tipoDocumento,
                    :nombreOriginal,
                    :nombreGuardado,
                    :ruta,
                    :tipoMime,
                    :tamanio,
                    :observacion,
                    1,
                    NOW()
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }
    // OBTENER DOCUMENTO
    public function getById($id)
    {
        $sql = "SELECT *
            FROM documentos_inversion
            WHERE idDocumento = :id
            LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $sql = "UPDATE documentos_inversion
            SET estado = 0
            WHERE idDocumento = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}
