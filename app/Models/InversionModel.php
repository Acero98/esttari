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
                    i.idEstudioTarifario,
                    i.idFondos,
                    i.idAreas,
                    f.nombreFondo,
                    a.nombreArea,
                    i.cui,
                    i.descripcion,
                    i.estadoInversion,
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
                    idEstudioTarifario,
                    idFondos,
                    idAreas,
                    cui,
                    descripcion,
                    estadoInversion,
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
                    idEstudioTarifario,
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
                    :idEstudioTarifario,
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
            ':idEstudioTarifario'      => $data['idEstudioTarifario'],
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
                    idEstudioTarifario = :idEstudioTarifario,
                    idFondos = :idFondos,
                    idAreas = :idAreas,
                    cui = :cui,
                    descripcion = :descripcion,
                    estadoInversion = :estadoInversion,
                    nombre = :nombre
                    /*observaciones = :observaciones*/
                WHERE idInversiones = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':idEstudioTarifario'      => $data['idEstudioTarifario'],
            ':idFondos'      => $data['idFondos'],
            ':idAreas'       => $data['idAreas'],
            ':cui'           => empty(trim($data['cui'])) ? null : trim($data['cui']),
            ':descripcion'   => $data['descripcion'],
            ':estadoInversion' => $data['estadoInversion'],
            ':nombre'        => $data['nombre'],
            /*':observaciones' => $data['observaciones'],*/
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
    /*
|--------------------------------------------------------------------------
| LISTAR INVERSIONES SEGÚN USUARIO
|--------------------------------------------------------------------------
*/
    public function getByUsuario($idUser)
    {
        $sql = "
            SELECT
                i.idInversiones,
                i.idEstudioTarifario,
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
                ON f.idFondos = i.idFondos
            INNER JOIN areas a
                ON a.idAreas = i.idAreas
            INNER JOIN usuarios_areas ua
                ON ua.idAreas = i.idAreas
            WHERE ua.idUser = ?
            ORDER BY i.descripcion
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function usuarioTieneAcceso($idUser, $idInversion)
    {
        $sql = "
            SELECT COUNT(*)
            FROM inversiones i
            INNER JOIN usuarios_areas ua
                ON ua.idAreas = i.idAreas
            WHERE ua.idUser = ?
            AND i.idInversiones = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $idUser,
            $idInversion
        ]);
        return $stmt->fetchColumn() > 0;
    }
    public function listarPermitidas($usuario)
    {
        $sql = "
            SELECT 
                i.*,
                a.nombreArea,
                g.nombreGerencia
            FROM inversiones i
            INNER JOIN areas a
            ON a.idAreas=i.idAreas
            INNER JOIN gerencias g
            ON g.idGerencias=a.idGerencias
        ";
        // Roles que ven todo
        if (
            in_array(
                $usuario['idRol'],
                [1, 2]
            )
        ) {
            return $this->db
                ->query($sql)
                ->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function listarSegunUsuario($usuario)
    {
        $sql = "
            SELECT
                i.*,
                et.nombre AS nombreEstudioTarifario,
                et.anioInicio,
                et.anioFin,
                f.nombreFondo,
                a.nombreArea,
                a.siglasArea,
                g.nombreGerencia

            FROM inversiones i

            INNER JOIN estudio_tarifario et
                ON et.idEstudioTarifario = i.idEstudioTarifario

            INNER JOIN fondos f
                ON f.idFondos = i.idFondos

            INNER JOIN areas a
                ON a.idAreas = i.idAreas

            INNER JOIN gerencias g
                ON g.idGerencias = a.idGerencias
        ";

        $parametros = [];

        // Si no tiene acceso global, solo verá las inversiones
        // de las áreas que tiene asignadas.
        if (!in_array('ver_todas_inversiones', $_SESSION['permisos'])) {

            $sql .= "
                WHERE i.idAreas IN (
                    SELECT idAreas
                    FROM usuarios_areas
                    WHERE idUser = ?
                )
            ";

            $parametros[] = $usuario['idUser'];
        }

        $sql .= "
            ORDER BY
                f.nombreFondo,
                a.siglasArea,
                i.descripcion
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerEstudioTarifario($idInversion)
    {
        $sql = "
            SELECT idEstudioTarifario
            FROM inversiones
            WHERE idInversiones = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idInversion]);
        return $stmt->fetchColumn();
    }
    public function perteneceAlEstudio($idInversion, $idEstudioTarifario)
    {
        $sql = "
            SELECT COUNT(*)
            FROM inversiones
            WHERE idInversiones = ?
            AND idEstudioTarifario = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $idInversion,
            $idEstudioTarifario
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function getEstudiosTarifarios()
    {
        $sql = "
            SELECT
                idEstudioTarifario,
                nombre,
                anioInicio,
                anioFin
            FROM estudio_tarifario
            WHERE estado = 1
            ORDER BY anioInicio DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}
