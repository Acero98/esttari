<?php
require_once "../config/conexion.php";
require_once "../app/Models/EstudioTarifarioModel.php";
require_once "../app/Models/AnioRegulatorioModel.php";
require_once "../app/Models/InversionModel.php";
class AnioRegulatorioController
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR AÑOS REGULATORIOS DE UNA INVERSIÓN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        global $conexion;
        $model = new AnioRegulatorioModel($conexion);
        $inversionModel = new InversionModel($conexion);
        $idInversion = $_GET['idInversiones'] ?? null;
        if (!$idInversion) {
            $_SESSION['mensaje'] =
                "No se encontró la inversión.";
            $_SESSION['tipo'] = "warning";
            header("Location:index.php?url=inversiones");
            exit;
        }
        $inversion =
            $inversionModel->getById($idInversion);
        $anios =
            $model->getByInversion($idInversion);
        $estudioModel =
            new EstudioTarifarioModel($conexion);
        $estudiosTarifarios =
            $estudioModel->getAll();
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/anioregulatorio/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
    /*
    |--------------------------------------------------------------------------
    | DETALLE DEL AÑO REGULATORIO
    |--------------------------------------------------------------------------
    */
    public function detalle()
    {
        global $conexion;
        $model =
            new AnioRegulatorioModel($conexion);
        $id =
            $_GET['idAnioRegulatorio'] ?? null;
        if (!$id) {
            $_SESSION['mensaje'] =
                "Año regulatorio inválido.";
            $_SESSION['tipo'] = "warning";
            header("Location:index.php?url=inversiones");
            exit;
        }
        $anio =
            $model->getById($id);
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/anioregulatorio/detalle.php";
        require_once "../app/Views/layouts/footer.php";
    }
    /*
    |--------------------------------------------------------------------------
    | REGISTRAR AÑO REGULATORIO
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        global $conexion;

        $model = new AnioRegulatorioModel($conexion);


        $idInversion = $_POST['idInversiones'];


        $data = [

            'idEstudioTarifario' => $_POST['idEstudioTarifario'],

            'idInversiones' => $idInversion,

            'anio' => trim($_POST['anio']),

            'programado' => $_POST['programado'],

            'ejecutado' => $_POST['ejecutado'] ?? null,

            'rdr' => $_POST['rdr'] ?? 0,

            'et' => $_POST['et'] ?? 0,

            'avanceFisico' => $_POST['avanceFisico'] ?? null,

            'observaciones' => $_POST['observaciones'] ?? null

        ];



        /*
    |--------------------------------------------------------------------------
    | VALIDAR DUPLICADO
    |--------------------------------------------------------------------------
    */

        if ($model->existeAnio(
            $data['idInversiones'],
            $data['anio']
        )) {


            $_SESSION['mensaje'] =
                "Ya existe un año regulatorio registrado para esta inversión.";


            $_SESSION['tipo'] = "warning";


            header(
                "Location:index.php?url=anioregulatorio&idInversiones=" . $idInversion
            );

            exit;
        }



        /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

        $ok = $model->create($data);



        if ($ok) {


            $_SESSION['mensaje'] =
                "Año regulatorio registrado correctamente";


            $_SESSION['tipo'] = "success";
        } else {


            $_SESSION['mensaje'] =
                "Error al registrar año regulatorio";


            $_SESSION['tipo'] = "error";
        }



        header(
            "Location:index.php?url=anioregulatorio&idInversiones=" . $idInversion
        );

        exit;
    }
    /*
|--------------------------------------------------------------------------
| OBTENER AÑO REGULATORIO
|--------------------------------------------------------------------------
*/
    public function edit()
    {
        global $conexion;

        $model = new AnioRegulatorioModel($conexion);

        $anio = $model->getById($_GET['id']);

        header('Content-Type: application/json');

        echo json_encode([
            'anio' => $anio
        ]);
        exit;
    }
    /*
|--------------------------------------------------------------------------
| ACTUALIZAR AÑO REGULATORIO
|--------------------------------------------------------------------------
*/
    public function update()
    {
        global $conexion;

        $model = new AnioRegulatorioModel($conexion);

        $id = $_POST['idAnioRegulatorio'];

        $data = [

            'idEstudioTarifario' => $_POST['idEstudioTarifario'],

            'anio' => trim($_POST['anio']),

            'programado' => $_POST['programado'],

            'ejecutado' => $_POST['ejecutado'],

            'rdr' => $_POST['rdr'],

            'et' => $_POST['et'],

            'avanceFisico' => $_POST['avanceFisico'],

            'observaciones' => trim($_POST['observaciones'])

        ];

        $ok = $model->update($id, $data);

        if ($ok) {

            $_SESSION['mensaje'] =
                "Año regulatorio actualizado correctamente";

            $_SESSION['tipo'] = "success";
        } else {

            $_SESSION['mensaje'] =
                "Error al actualizar el año regulatorio";

            $_SESSION['tipo'] = "error";
        }

        header(
            "Location:index.php?url=anioregulatorio&idInversiones=" . $_POST['idInversiones']
        );

        exit;
    }
}
