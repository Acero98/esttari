<?php
require_once "../config/conexion.php";
require_once "../app/Models/SeguimientoModel.php";
require_once "../app/Models/AnioRegulatorioModel.php";
class SeguimientoController
{
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR SEGUIMIENTO DEL AÑO
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        global $conexion;
        $model =
            new SeguimientoModel($conexion);
        $anioModel =
            new AnioRegulatorioModel($conexion);
        $idAnio =
            $_GET['idAnioRegulatorio'] ?? null;
        if(!$idAnio){
            $_SESSION['mensaje'] =
            "Año regulatorio no encontrado.";
            $_SESSION['tipo']="warning";
            header("Location:index.php?url=inversiones");
            exit;
        }
        // Datos del año seleccionado
        $anio =
            $anioModel->getById($idAnio);
        // meses del año
        $seguimiento =
            $model->getResumenMensual($idAnio);
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/seguimiento/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
    /*
    |--------------------------------------------------------------------------
    | CREAR SEGUIMIENTO MENSUAL
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        global $conexion;
        $model =
            new SeguimientoModel($conexion);
        $data=[
            'idEjecucionMensual'
                => $_POST['idEjecucionMensual'],
            'producto'
                => trim($_POST['producto']),
            'estadoInver'
                => trim($_POST['estadoInver']),
            'acciones'
                => trim($_POST['acciones']),
            'fechas'
                => trim($_POST['fechas']),
            'situacion'
                => trim($_POST['situacion'])
        ];
        $ok =
            $model->create($data);
        if($ok){
            $_SESSION['mensaje']
            =
            "Seguimiento registrado correctamente";
            $_SESSION['tipo']="success";
        }
        else{
            $_SESSION['mensaje']
            =
            "Error al registrar seguimiento";
            $_SESSION['tipo']="error";
        }
        header(
            "Location:index.php?url=seguimiento&idAnioRegulatorio="
            .
            $_POST['idAnioRegulatorio']
        );
        exit;
    }
    /*
    |--------------------------------------------------------------------------
    | EDITAR
    |--------------------------------------------------------------------------
    */
    public function edit()
    {
        global $conexion;
        $model =
            new SeguimientoModel($conexion);
        $id =
            $_GET['id'];
        $seguimiento =
            $model->getById($id);
        header('Content-Type: application/json');
        echo json_encode([
            "seguimiento"=>$seguimiento
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR
    |--------------------------------------------------------------------------
    */
    public function update()
    {
        global $conexion;
        $model =
            new SeguimientoModel($conexion);
        $data=[
            'producto'
                => trim($_POST['producto']),
            'estadoInver'
                => trim($_POST['estadoInver']),
            'acciones'
                => trim($_POST['acciones']),
            'fechas'
                => trim($_POST['fechas']),
            'situacion'
                => trim($_POST['situacion'])
        ];
        $ok =
            $model->update(
                $_POST['idSeguimientoMensual'],
                $data
            );
        if($ok){
            $_SESSION['mensaje']
            =
            "Seguimiento actualizado correctamente";
            $_SESSION['tipo']="success";
        }
        else{
            $_SESSION['mensaje']
            =
            "Error al actualizar";
            $_SESSION['tipo']="error";
        }
        header(
            "Location:index.php?url=seguimiento&idAnioRegulatorio="
            .
            $_POST['idAnioRegulatorio']
        );
        exit;
    }
}