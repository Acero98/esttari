<?php

class UsuarioModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // LOGIN
    public function login($usuario)
    {
        $sql = "SELECT
                    u.idUser,
                    u.usuario,
                    u.contrasena,
                    u.nombres,
                    u.apellidos,
                    u.correo,
                    u.estado,
                    u.idRol,
                    r.nombreRol
                FROM usuarios u
                LEFT JOIN roles r
                    ON u.idRol = r.idRol
                WHERE u.usuario = :usuario
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //ROL-PERMISOS
    public function getPermisosRol($idRol)
    {
        $sql = "SELECT
                p.permiso,
                p.ruta
            FROM rol_permiso rp
            INNER JOIN permisos p
                ON rp.idPermiso = p.idPermiso
            WHERE rp.idRol = :idRol
                AND p.estado = 1
            ORDER BY p.orden";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":idRol", $idRol);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // LISTAR USUARIOS
    public function getAll()
    {
        $sql = "SELECT
                    u.idUser,
                    u.usuario,
                    u.nombres,
                    u.apellidos,
                    u.correo,
                    u.fechaCreado,
                    u.estado,
                    u.idRol,
                    r.nombreRol
                FROM usuarios u
                LEFT JOIN roles r
                    ON u.idRol = r.idRol
                ORDER BY u.nombres";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER USUARIO
    public function getById($id)
    {
        $sql = "SELECT
                    u.idUser,
                    u.usuario,
                    u.nombres,
                    u.apellidos,
                    u.correo,
                    u.estado,
                    u.idRol,
                    r.nombreRol
                FROM usuarios u
                LEFT JOIN roles r
                    ON u.idRol = r.idRol
                WHERE u.idUser = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // LISTA DE ROLES
    public function getRoles()
    {
        $sql = "SELECT
                    idRol,
                    nombreRol
                FROM roles
                ORDER BY nombreRol";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO usuarios
            (
                usuario,
                contrasena,
                nombres,
                apellidos,
                correo,
                idRol,
                estado,
                fechaCreado
            )
            VALUES
            (
                :usuario,
                :contrasena,
                :nombres,
                :apellidos,
                :correo,
                :idRol,
                1,
                NOW()
            )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':usuario'    => $data['usuario'],
            ':contrasena' => $data['contrasena'],
            ':nombres'    => $data['nombres'],
            ':apellidos'  => $data['apellidos'],
            ':correo'     => $data['correo'],
            ':idRol'      => $data['idRol']
        ]);
    }

    public function update($id, $data)
    {
        if (!empty($data['contrasena'])) {

            $sql = "UPDATE usuarios
                SET
                    usuario=:usuario,
                    nombres=:nombres,
                    apellidos=:apellidos,
                    correo=:correo,
                    contrasena=:contrasena,
                    idRol=:idRol
                WHERE idUser=:id";
        } else {

            $sql = "UPDATE usuarios
                SET
                    usuario=:usuario,
                    nombres=:nombres,
                    apellidos=:apellidos,
                    correo=:correo,
                    idRol=:idRol
                WHERE idUser=:id";
        }

        $stmt = $this->db->prepare($sql);

        $params = [
            ':usuario'   => $data['usuario'],
            ':nombres'   => $data['nombres'],
            ':apellidos' => $data['apellidos'],
            ':correo'    => $data['correo'],
            ':idRol'     => $data['idRol'],
            ':id'        => $id
        ];

        if (!empty($data['contrasena'])) {
            $params[':contrasena'] = $data['contrasena'];
        }

        return $stmt->execute($params);
    }

    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE usuarios
            SET estado = :estado
            WHERE idUser = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id'     => $id
        ]);
    }

    public function existeUsuario($usuario, $id = null)
    {
        if ($id == null) {

            $sql = "SELECT COUNT(*) FROM usuarios
                WHERE usuario = :usuario";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':usuario' => $usuario
            ]);
        } else {

            $sql = "SELECT COUNT(*) FROM usuarios
                WHERE usuario = :usuario
                AND idUser <> :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':usuario' => $usuario,
                ':id' => $id
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }
}
