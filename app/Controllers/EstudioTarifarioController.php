<?php
require_once "../config/conexion.php";
require_once "../app/Models/EstudioTarifarioModel.php";
class EstudioTarifarioController
{
    public function index()
    {
        global $conexion;
        $model = new EstudioTarifarioModel($conexion);
        $estudios = $model->getAll();
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/estudioTarifario/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
    public function store()
    {
        global $conexion;
        $model = new EstudioTarifarioModel($conexion);
        $data = [
            'codigo'     => trim($_POST['codigo']),
            'nombre'     => trim($_POST['nombre']),
            'anioInicio' => trim($_POST['anioInicio']),
            'anioFin'    => trim($_POST['anioFin']),
            'estado'     => 'ACTIVO'
        ];
        if($model->existeCodigo($data['codigo'])){
            $_SESSION['mensaje'] = "Ya existe ese código de estudio tarifario.";
            $_SESSION['tipo'] = "warning";
            header("Location:index.php?url=estudioTarifario");
            exit;
        }
        $ok = $model->create($data);
        if($ok){
            $_SESSION['mensaje'] = "Estudio tarifario registrado correctamente";
            $_SESSION['tipo'] = "success";
        }else{
            $_SESSION['mensaje'] = "Error al registrar estudio tarifario";
            $_SESSION['tipo'] = "error";
        }
        header("Location:index.php?url=estudioTarifario");
        exit;
    }
    public function edit()
    {
        global $conexion;
        $model = new EstudioTarifarioModel($conexion);
        $estudio = $model->getById($_GET['id']);
        header('Content-Type: application/json');
        echo json_encode($estudio);
    }
    public function update()
    {
        global $conexion;
        $model = new EstudioTarifarioModel($conexion);
        $data = [
            'codigo'     => trim($_POST['codigo']),
            'nombre'     => trim($_POST['nombre']),
            'anioInicio' => trim($_POST['anioInicio']),
            'anioFin'    => trim($_POST['anioFin'])
        ];
        if($model->existeCodigo(
                $data['codigo'],
                $_POST['idEstudioTarifario']
            )){
            $_SESSION['mensaje'] = "Ese código ya existe.";
            $_SESSION['tipo'] = "warning";
            header("Location:index.php?url=estudioTarifario");
            exit;
        }
        $ok = $model->update(
            $_POST['idEstudioTarifario'],
            $data
        );
        if($ok){
            $_SESSION['mensaje'] = "Estudio tarifario actualizado correctamente";
            $_SESSION['tipo'] = "success";
        }else{
            $_SESSION['mensaje'] = "Error al actualizar estudio tarifario";
            $_SESSION['tipo'] = "error";
        }
        header("Location:index.php?url=estudioTarifario");
        exit;
    }
    public function estado()
    {
        global $conexion;
        $model = new EstudioTarifarioModel($conexion);
        $id = $_GET['id'];
        $estado = $_GET['estado'];
        $ok = $model->cambiarEstado(
            $id,
            $estado
        );
        if($estado=="ACTIVO"){
            $_SESSION['mensaje'] = "Estudio tarifario activado correctamente";
        }else{
            $_SESSION['mensaje'] = "Estudio tarifario cerrado correctamente";
        }
        $_SESSION['tipo']="success";
        header("Location:index.php?url=estudioTarifario");
        exit;
    }
}