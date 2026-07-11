<?php

class FondoModel
{
    private $db;


    public function __construct($conexion)
    {
        $this->db = $conexion;
    }



    public function getAll()
    {

        $sql = "
            SELECT *
            FROM fondos
            ORDER BY nombre
        ";


        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getById($id)
    {

        $sql = "
            SELECT *
            FROM fondos
            WHERE idFondos = :id
            LIMIT 1
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);


        return $stmt->fetch(PDO::FETCH_ASSOC);
    }





    public function create($data)
    {

        $sql = "
            INSERT INTO fondos
            (
                codigo,
                nombre,
                descripcion,
                fechaCreado
            )
            VALUES
            (
                :codigo,
                :nombre,
                :descripcion,
                NOW()
            )
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':codigo' => $data['codigo'],
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion']

        ]);
    }





    public function update($id, $data)
    {

        $sql = "
            UPDATE fondos
            SET
                codigo=:codigo,
                nombre=:nombre,
                descripcion=:descripcion,
                fechaActualiuzado=NOW()

            WHERE idFondos=:id
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':codigo' => $data['codigo'],
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':id' => $id

        ]);
    }





    public function existeFondo($codigo, $id = null)
    {


        if ($id == null) {


            $sql = "
                SELECT COUNT(*)
                FROM fondos
                WHERE codigo=:codigo
            ";


            $stmt = $this->db->prepare($sql);


            $stmt->execute([
                ':codigo' => $codigo
            ]);
        } else {


            $sql = "
                SELECT COUNT(*)
                FROM fondos
                WHERE codigo=:codigo
                AND idFondos<>:id
            ";


            $stmt = $this->db->prepare($sql);


            $stmt->execute([

                ':codigo' => $codigo,
                ':id' => $id

            ]);
        }



        return $stmt->fetchColumn() > 0;
    }
}
