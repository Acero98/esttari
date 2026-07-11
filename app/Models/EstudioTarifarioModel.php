<?php

class EstudioTarifarioModel
{

    private $db;


    public function __construct($conexion)
    {
        $this->db = $conexion;
    }




    public function getAll()
    {

        $sql = "SELECT 
                    idEstudioTarifario,
                    codigo,
                    nombre,
                    anioInicio,
                    anioFin,
                    estado,
                    fechaCreado
                FROM estudio_tarifario
                ORDER BY anioInicio DESC";


        return $this->db
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);

    }






    public function getById($id)
    {

        $sql = "SELECT
                    idEstudioTarifario,
                    codigo,
                    nombre,
                    anioInicio,
                    anioFin
                FROM estudio_tarifario
                WHERE idEstudioTarifario = :id
                LIMIT 1";


        $stmt = $this->db->prepare($sql);


        $stmt->execute([
            ':id'=>$id
        ]);


        return $stmt->fetch(PDO::FETCH_ASSOC);

    }







    public function create($data)
    {


        $sql = "INSERT INTO estudio_tarifario
                (
                    codigo,
                    nombre,
                    anioInicio,
                    anioFin,
                    estado,
                    fechaCreado
                )
                VALUES
                (
                    :codigo,
                    :nombre,
                    :anioInicio,
                    :anioFin,
                    :estado,
                    NOW()
                )";



        $stmt = $this->db->prepare($sql);



        return $stmt->execute([

            ':codigo'     => $data['codigo'],
            ':nombre'     => $data['nombre'],
            ':anioInicio' => $data['anioInicio'],
            ':anioFin'    => $data['anioFin'],
            ':estado'     => $data['estado']

        ]);

    }









    public function update($id,$data)
    {


        $sql = "UPDATE estudio_tarifario
                SET

                    codigo=:codigo,
                    nombre=:nombre,
                    anioInicio=:anioInicio,
                    anioFin=:anioFin

                WHERE idEstudioTarifario=:id";



        $stmt = $this->db->prepare($sql);



        return $stmt->execute([

            ':codigo'     => $data['codigo'],
            ':nombre'     => $data['nombre'],
            ':anioInicio' => $data['anioInicio'],
            ':anioFin'    => $data['anioFin'],
            ':id'         => $id

        ]);

    }









    public function cambiarEstado($id,$estado)
    {


        $sql = "UPDATE estudio_tarifario

                SET estado=:estado

                WHERE idEstudioTarifario=:id";



        $stmt = $this->db->prepare($sql);



        return $stmt->execute([

            ':estado'=>$estado,
            ':id'=>$id

        ]);

    }









    public function existeCodigo($codigo,$id=null)
    {


        if($id==null){


            $sql = "SELECT COUNT(*)

                    FROM estudio_tarifario

                    WHERE codigo=:codigo";



            $stmt=$this->db->prepare($sql);



            $stmt->execute([

                ':codigo'=>$codigo

            ]);



        }else{


            $sql = "SELECT COUNT(*)

                    FROM estudio_tarifario

                    WHERE codigo=:codigo

                    AND idEstudioTarifario <> :id";



            $stmt=$this->db->prepare($sql);



            $stmt->execute([

                ':codigo'=>$codigo,
                ':id'=>$id

            ]);

        }



        return $stmt->fetchColumn() > 0;


    }



}