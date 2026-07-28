<?php

class RolModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM roles ORDER BY nombreRol";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    idRol,
                    nombreRol,
                    descripcionRol
                FROM roles
                WHERE idRol = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO roles 
            (
                nombreRol,
                descripcionRol,
                estado, 
                fechaCreado
            )
            VALUES 
            (
                :nombreRol,
                :descripcionRol,
                1, 
                NOW()
            )";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombreRol' => $data['nombreRol'],
            ':descripcionRol' => $data['descripcionRol']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE roles
            SET
                /*nombreRol=:nombreRol,*/
                descripcionRol=:descripcionRol
            WHERE idRol=:id";


        $stmt = $this->db->prepare($sql);

        $params = [
            //':nombreRol'   => $data['nombreRol'],
            ':descripcionRol'   => $data['descripcionRol'],
            ':id'        => $id
        ];

        return $stmt->execute($params);
    }

    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE roles
            SET estado = :estado
            WHERE idRol = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id'     => $id
        ]);
    }

    public function existeRol($rol, $id = null)
    {
        if ($id == null) {

            $sql = "SELECT COUNT(*) FROM roles
                WHERE nombreRol = :nombreRol";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombreRol' => $rol
            ]);
        } else {

            $sql = "SELECT COUNT(*) FROM roles
                WHERE nombreRol = :nombreRol
                AND idRol <> :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombreRol' => $rol,
                ':id' => $id
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }

    public function getPermisosRol($idRol)
    {
        // Todos los permisos activos
        $sql = "SELECT
                idPermiso,
                permiso,
                grupo,
                icono,
                ruta,
                orden
            FROM permisos
            WHERE estado = 1
            ORDER BY grupo, orden";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $permisos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Permisos asignados al rol
        $sql = "SELECT idPermiso
        FROM rol_permiso
        WHERE idRol = :idRol";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":idRol", $idRol);
        $stmt->execute();

        $asignados = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return [
            'permisos' => $permisos,
            'asignados' => $asignados
        ];
    }

    public function guardarPermisosRol($idRol, $permisos)
    {
        try {

            $this->db->beginTransaction();

            // Eliminar todos los permisos actuales del rol
            $sql = "DELETE FROM rol_permiso
                WHERE idRol = :idRol";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":idRol", $idRol);
            $stmt->execute();

            // Insertar nuevamente los permisos seleccionados
            if (!empty($permisos)) {

                $sql = "INSERT INTO rol_permiso
                    (idRol, idPermiso)
                    VALUES
                    (:idRol, :idPermiso)";

                $stmt = $this->db->prepare($sql);

                foreach ($permisos as $idPermiso) {

                    $stmt->bindParam(":idRol", $idRol);
                    $stmt->bindParam(":idPermiso", $idPermiso);
                    $stmt->execute();
                }
            }

            $this->db->commit();

            return true;
        } catch (PDOException $e) {

            $this->db->rollBack();

            throw $e;
        }
    }
}
