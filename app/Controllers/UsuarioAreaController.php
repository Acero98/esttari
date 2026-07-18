<?php

require_once "../config/conexion.php";
require_once "../app/Models/UsuarioAreaModel.php";


class UsuarioAreaController
{

    /**
     * Listar áreas asignadas a un usuario
     */
    public function listar()
    {
        global $conexion;

        $model = new UsuarioAreaModel($conexion);


        $idUser = $_GET["idUser"] ?? null;


        if (!$idUser) {

            echo json_encode([
                "success" => false,
                "mensaje" => "Usuario no especificado"
            ]);

            exit;
        }


        echo json_encode([
            "success" => true,
            "data" => $model->obtenerPorUsuario($idUser)
        ]);

        exit;
    }



    /**
     * Guardar áreas asignadas al usuario
     */
    public function guardar()
    {
        global $conexion;

        $model = new UsuarioAreaModel($conexion);


        $idUser = $_POST["idUser"] ?? null;

        $areas = $_POST["areas"] ?? [];


        if (!$idUser) {

            echo json_encode([
                "success" => false,
                "mensaje" => "Usuario no válido"
            ]);

            exit;
        }


        if (!is_array($areas)) {

            $areas = [];
        }


        if ($model->sincronizar($idUser, $areas)) {

            echo json_encode([
                "success" => true,
                "mensaje" => "Áreas actualizadas correctamente."
            ]);
        } else {

            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudieron actualizar las áreas."
            ]);
        }


        exit;
    }



    /**
     * Eliminar asignación usuario-área
     */
    public function eliminar()
    {
        global $conexion;

        $model = new UsuarioAreaModel($conexion);


        $idUsuarioArea = $_POST["idUsuarioArea"] ?? null;


        if (!$idUsuarioArea) {

            echo json_encode([
                "success" => false,
                "mensaje" => "Asignación no especificada."
            ]);

            exit;
        }


        if ($model->eliminar($idUsuarioArea)) {

            echo json_encode([
                "success" => true,
                "mensaje" => "Área eliminada correctamente."
            ]);
        } else {

            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo eliminar el área."
            ]);
        }


        exit;
    }



    /**
     * Listar usuarios por área
     */
    public function usuariosPorArea()
    {
        global $conexion;

        $model = new UsuarioAreaModel($conexion);


        $idAreas = $_GET["idAreas"] ?? null;


        if (!$idAreas) {

            echo json_encode([
                "success" => false,
                "mensaje" => "Área no especificada."
            ]);

            exit;
        }


        echo json_encode([
            "success" => true,
            "data" => $model->obtenerPorArea($idAreas)
        ]);

        exit;
    }



    /**
     * Listar todas las áreas disponibles
     */
    public function areas()
    {
        global $conexion;

        $model = new UsuarioAreaModel($conexion);


        echo json_encode([
            "success" => true,
            "data" => $model->obtenerTodasLasAreas()
        ]);

        exit;
    }
}
