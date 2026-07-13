<?php

require_once "../config/conexion.php";
require_once "../app/Models/FondoModel.php";

class FondoController
{

    public function index()
    {
        global $conexion;

        $model = new FondoModel($conexion);

        $fondos = $model->getAll();


        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/fondos/index.php";
        require_once "../app/Views/layouts/footer.php";
    }



    public function store()
    {
        global $conexion;

        $model = new FondoModel($conexion);


        $data = [

            'codigoFondo' => trim($_POST['codigoFondo']),
            'nombreFondo' => trim($_POST['nombreFondo']),
            'descripcionFondo' => trim($_POST['descripcionFondo'])

        ];



        if ($model->existeFondo($data['codigoFondo'])) {


            $_SESSION['mensaje'] = "Ya existe ese código de fondo.";
            $_SESSION['tipo'] = "warning";


            header("Location:index.php?url=fondos");
            exit;
        }



        $ok = $model->create($data);



        if ($ok) {

            $_SESSION['mensaje'] = "Fondo registrado correctamente";
            $_SESSION['tipo'] = "success";
        } else {

            $_SESSION['mensaje'] = "Error al registrar fondo";
            $_SESSION['tipo'] = "error";
        }



        header("Location:index.php?url=fondos");
        exit;
    }





    public function edit()
    {
        global $conexion;


        $model = new FondoModel($conexion);


        $fondo = $model->getById($_GET['id']);


        header('Content-Type: application/json');


        echo json_encode([
            'fondo' => $fondo
        ]);
    }





    public function update()
    {
        global $conexion;


        $model = new FondoModel($conexion);



        $data = [

            'codigoFondo' => trim($_POST['codigoFondo']),
            'nombreFondo' => trim($_POST['nombreFondo']),
            'descripcionFondo' => trim($_POST['descripcionFondo'])

        ];




        if ($model->existeFondo($data['codigoFondo'], $_POST['idFondos'])) {


            $_SESSION['mensaje'] = "Ese código de fondo ya existe.";
            $_SESSION['tipo'] = "warning";


            header("Location:index.php?url=fondos");
            exit;
        }





        $ok = $model->update($_POST['idFondos'], $data);




        if ($ok) {

            $_SESSION['mensaje'] = "Fondo actualizado correctamente";
            $_SESSION['tipo'] = "success";
        } else {

            $_SESSION['mensaje'] = "Error al actualizar fondo";
            $_SESSION['tipo'] = "error";
        }




        header("Location:index.php?url=fondos");
        exit;
    }

    public function estado()
    {
        global $conexion;

        $model = new FondoModel($conexion);

        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $model->cambiarEstado($id, $estado);

        $_SESSION['mensaje'] = $estado == 1
            ? "Fondo activado correctamente."
            : "Fondo deshabilitado correctamente.";

        $_SESSION['tipo'] = "success";

        header("Location:index.php?url=fondos");
        exit;
    }
}
