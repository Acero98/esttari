<?php

class PermisoModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // LISTAR PERMISOS
    public function getAll()
    {
        $sql = "SELECT
                    idPermiso,
                    permiso,
                    grupo,
                    ruta,
                    icono,
                    orden,
                    fechaCreado,
                    estado
                FROM permisos
                ORDER BY permiso";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER USUARIO
    public function getById($id)
    {
        $sql = "SELECT
                    idPermiso,
                    permiso,
                    grupo,
                    ruta,
                    icono,
                    orden
                FROM permisos
                WHERE idPermiso = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO permisos
            (
                permiso,
                grupo,
                ruta,
                icono,
                orden,
                estado,
                fechaCreado
            )
            VALUES
            (
                :permiso,
                :grupo,
                :ruta,
                :icono,
                :orden,
                1,
                NOW()
            )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':permiso'    => $data['permiso'],
            ':grupo' => $data['grupo'],
            ':ruta'    => $data['ruta'],
            ':icono'  => $data['icono'],
            ':orden'     => $data['orden']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE permisos
            SET
                permiso=:permiso,
                grupo=:grupo,
                ruta=:ruta,
                icono=:icono,
                orden=:orden
            WHERE idPermiso=:id";
        

        $stmt = $this->db->prepare($sql);

        $params = [
            ':permiso'   => $data['permiso'],
            ':grupo'   => $data['grupo'],
            ':ruta' => $data['ruta'],
            ':icono'    => $data['icono'],
            ':orden'     => $data['orden'],
            ':id'        => $id
        ];

        return $stmt->execute($params);
    }

    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE permisos
            SET estado = :estado
            WHERE idPermiso = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id'     => $id
        ]);
    }

    public function existePermiso($permiso, $id = null)
    {
        if ($id == null) {

            $sql = "SELECT COUNT(*) FROM permisos
                WHERE permiso = :permiso";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':permiso' => $permiso
            ]);
        } else {

            $sql = "SELECT COUNT(*) FROM permisos
                WHERE permiso = :permiso
                AND idPermiso <> :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':permiso' => $permiso,
                ':id' => $id
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }
}
