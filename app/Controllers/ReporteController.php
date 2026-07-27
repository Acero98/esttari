<?php
require_once "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

require_once "../config/conexion.php";
require_once "../app/Models/InversionModel.php";
require_once "../app/Models/ReporteModel.php";

class ReporteController
{
    /*
    |--------------------------------------------------------------------------
    | CENTRO DE REPORTES DE INVERSIÓN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        //reporte excel y pdf
        $accion =
            $_GET["accion"] ?? null;
        if ($accion == "excel") {
            $this->exportarExcel();
            exit;
        }
        if ($accion == "excelEjecutivo") {
            $this->exportarExcelEjecutivo();
            exit;
        }
        if ($accion == "pdf") {
            $this->exportarPDF();
            exit;
        }
        global $conexion;
        $model = new ReporteModel($conexion);
        $inversionModel = new InversionModel($conexion);
        // =====================================
        // FILTROS RECIBIDOS
        // =====================================
        $tipoReporte =
            $_GET["tipoReporte"] ?? null;
        $idEstudioTarifario =
            $_GET["idEstudioTarifario"] ?? null;
        $idFondo =
            $_GET["idFondo"] ?? null;
        $idArea =
            $_GET["idArea"] ?? null;
        $anio =
            $_GET["anio"] ?? null;
        $idInversion =
            $_GET["idInversiones"] ?? null;
        // =====================================
        // USUARIO ACTUAL
        // =====================================
        $idUsuario =
            $_SESSION["idUser"];
        $idRol =
            $_SESSION["idRol"];
        // =====================================
        // FILTROS DISPONIBLES
        // =====================================
        $filtros =
            $model->obtenerFiltros(
                $idUsuario,
                $idRol
            );
        // =====================================
        // SI VIENE INVERSIÓN
        // OBTENER ESTUDIO TARIFARIO
        // =====================================
        if (
            !$idEstudioTarifario &&
            $idInversion
        ) {
            $idEstudioTarifario =
                $inversionModel->obtenerEstudioTarifario(
                    $idInversion
                );
        }
        // =====================================
        // VALIDAR ACCESO A INVERSIÓN
        // =====================================
        if (
            $idInversion &&
            $idRol != 1 &&
            !$inversionModel->usuarioTieneAcceso(
                $idUsuario,
                $idInversion
            )
        ) {
            $_SESSION["mensaje"] =
                "No tiene permisos para acceder a esta inversión.";
            $_SESSION["tipo"] =
                "warning";
            header(
                "Location:index.php?url=reportes"
            );
            exit;
        }
        // =====================================
        // DATOS DEL REPORTE
        // =====================================
        $datosReporte = [];
        $totales = [
            "programado" => 0,
            "ejecutado" => 0,
            "saldo" => 0,
            "rdr" => 0,
            "et" => 0,
            "pim" => 0,
            "ejecucionAcumulada" => 0,
            "saldoAcumulado" => 0,
            "avanceFinanciero" => 0,
            "avanceFisico" => 0
        ];
        $resultado = $model->obtenerEstadoGeneral(
            $idEstudioTarifario,
            $idFondo,
            $idArea,
            $anio,
            $idInversion,
            $_SESSION["idUser"],
            $_SESSION["idRol"]
        );

        $datosReporte = $resultado["detalle"];
        $totales = $resultado["totales"];
        /*
        switch ($tipoReporte) {
            /*
            |--------------------------------------------------------------------------
            | ESTADO GENERAL
            |--------------------------------------------------------------------------
            
            case "estadoGeneral":
                $resultado =
                    $model->obtenerEstadoGeneral(
                        $idEstudioTarifario,
                        $idFondo,
                        $idArea,
                        $anio,
                        $idInversion,
                        $_SESSION["idUser"],
                        $_SESSION["idRol"]
                    );
                $datosReporte = $resultado["detalle"];
                $totales = $resultado["totales"];
                break;
            /*
            |--------------------------------------------------------------------------
            | PROGRAMADO VS EJECUTADO
            |--------------------------------------------------------------------------
            
            case "programadoEjecutado":
                /*
                    Pendiente
                
                break;
            /*
            |--------------------------------------------------------------------------
            | SEGUIMIENTOS
            |--------------------------------------------------------------------------
            
            case "seguimientos":
                /*
                    Pendiente
                
                break;
            /*
            |--------------------------------------------------------------------------
            | EJECUCIONES
            |--------------------------------------------------------------------------
            
            case "ejecuciones":
                /*
                    Pendiente
                
                break;
            /*
            |--------------------------------------------------------------------------
            | RESUMEN EJECUTIVO
            |--------------------------------------------------------------------------
            
            case "resumenEjecutivo":
                /*
                    Pendiente
                
                break;
        }*/
        // =====================================
        // VARIABLES PARA VISTA
        // =====================================
        $datos = $datosReporte;
        // =====================================
        // CARGAR VISTA
        // =====================================
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/layouts/navbar.php";
        require_once "../app/Views/reportes/index.php";
        require_once "../app/Views/layouts/footer.php";
    }
    /*
    |--------------------------------------------------------------------------
    | OBTENER DATOS PARA EXPORTACIÓN
    |--------------------------------------------------------------------------
    */
    private function obtenerDatosReporte()
    {
        global $conexion;
        $model =
            new ReporteModel($conexion);
        $idEstudioTarifario =
            $_GET["idEstudioTarifario"] ?? null;
        $idFondo =
            $_GET["idFondo"] ?? null;
        $idArea =
            $_GET["idArea"] ?? null;
        $anio =
            $_GET["anio"] ?? null;
        $idInversion =
            $_GET["idInversiones"] ?? null;
        $idUsuario =
            $_SESSION["idUser"];
        $idRol =
            $_SESSION["idRol"];
        return $model->obtenerEstadoGeneral(
            $idEstudioTarifario,
            $idFondo,
            $idArea,
            $anio,
            $idInversion,
            $idUsuario,
            $idRol
        );
    }

    private function exportarExcel()
    {
        $resultado =
            $this->obtenerDatosReporte();
        $datos =
            $resultado["detalle"];
        require_once "../vendor/autoload.php";
        $spreadsheet =
            new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet =
            $spreadsheet->getActiveSheet();
        $sheet->setTitle(
            "Estado General"
        );
        // =====================================
        // CABECERA
        // =====================================
        $columnas = [
            "A" => "#",
            "B" => "Inversión",
            "C" => "Área",
            "D" => "Fondo",
            "E" => "Año",
            "F" => "Programado",
            "G" => "Ejecutado",
            "H" => "Saldo",
            "I" => "RDR",
            "J" => "E.T.",
            "K" => "PIM",
            /*
            "L" => "Ejecución Acum.",
            "M" => "Saldo Acum.",
            */
            "L" => "Avance Físico",
            "M" => "Avance Financiero"
        ];
        foreach ($columnas as $col => $titulo) {
            $sheet->setCellValue(
                $col . "1",
                $titulo
            );
        }
        // =====================================
        // DATOS
        // =====================================
        $fila = 2;
        $numero = 1;
        $totalProgramado = 0;
        $totalEjecutado = 0;
        $totalSaldo = 0;
        $totalPim = 0;
        foreach ($datos as $item) {
            $totalProgramado += $item["programado"];
            $totalEjecutado += $item["ejecutado"];
            $totalSaldo += $item["saldo"];
            $totalPim += $item["pim"];
            $sheet->setCellValue(
                "A" . $fila,
                $numero++
            );
            $sheet->setCellValue(
                "B" . $fila,
                $item["descripcion"]
            );
            $sheet->setCellValue(
                "C" . $fila,
                $item["nombreArea"]
            );
            $sheet->setCellValue(
                "D" . $fila,
                $item["nombreFondo"]
            );
            $sheet->setCellValue(
                "E" . $fila,
                $item["anio"]
            );
            $sheet->setCellValue(
                "F" . $fila,
                $item["programado"]
            );
            $sheet->setCellValue(
                "G" . $fila,
                $item["ejecutado"]
            );
            $sheet->setCellValue(
                "H" . $fila,
                $item["saldo"]
            );
            $sheet->setCellValue(
                "I" . $fila,
                $item["rdr"]
            );
            $sheet->setCellValue(
                "J" . $fila,
                $item["et"]
            );
            $sheet->setCellValue(
                "K" . $fila,
                $item["pim"]
            );
            /*
            $sheet->setCellValue(
                "L" . $fila,
                $item["ejecucionAcumulada"]
            );
            $sheet->setCellValue(
                "M" . $fila,
                $item["saldoAcumulado"]
            );*/
            $sheet->setCellValue(
                "L" . $fila,
                $item["avanceFisico"] . "%"
            );
            $sheet->setCellValue(
                "M" . $fila,
                $item["avanceFinanciero"] . "%"
            );
            $fila++;
        }
        $sheet->setCellValue(
            "E" . $fila,
            "TOTAL GENERAL"
        );
        $sheet->setCellValue(
            "F" . $fila,
            $totalProgramado
        );
        $sheet->setCellValue(
            "G" . $fila,
            $totalEjecutado
        );
        $sheet->setCellValue(
            "H" . $fila,
            $totalSaldo
        );
        $sheet->setCellValue(
            "K" . $fila,
            $totalPim
        );
        // =====================================
        // AJUSTAR COLUMNAS
        // =====================================
        foreach (range('A', 'O') as $col) {
            $sheet
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }
        // Ajuste especial inversión
        $sheet
            ->getColumnDimension("B")
            ->setWidth(45);
        // =====================================
        // DESCARGA
        // =====================================
        header(
            "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        );
        header(
            "Content-Disposition: attachment; filename=Reporte_Inversiones.xlsx"
        );
        header(
            "Cache-Control: max-age=0"
        );
        $writer =
            new \PhpOffice\PhpSpreadsheet\Writer\Xlsx(
                $spreadsheet
            );
        $writer->save("php://output");
        exit;
    }

    private function exportarExcelEjecutivo()
    {
        /*
    |--------------------------------------------------------------------------
    | OBTENER FILTROS
    |--------------------------------------------------------------------------
    */

        $idEstudioTarifario = $_GET["idEstudioTarifario"] ?? null;
        $idFondo            = $_GET["idFondo"] ?? null;
        $idArea             = $_GET["idArea"] ?? null;
        $anio               = $_GET["anio"] ?? null;
        $idInversiones      = $_GET["idInversiones"] ?? null;

        /*
    |--------------------------------------------------------------------------
    | MODELO
    |--------------------------------------------------------------------------
    */

        //require_once "../app/Models/ReporteModel.php";
        global $conexion;
        $model = new ReporteModel($conexion);

        /*
    |--------------------------------------------------------------------------
    | DATOS DEL REPORTE
    |--------------------------------------------------------------------------
    */

        $resultado = $model->obtenerEstadoGeneralEjecutivo(

            $idEstudioTarifario,

            $idFondo,

            $idArea,

            $anio,

            $idInversiones,

            $_SESSION["idUser"],

            $_SESSION["idRol"]

        );

        $datos = $resultado["detalle"];

        $totales = $resultado["totales"];

        /*
    |--------------------------------------------------------------------------
    | AÑOS
    |--------------------------------------------------------------------------
    */

        $anios = $model->obtenerAniosReporteEjecutivo(

            $idEstudioTarifario,

            $idFondo,

            $idArea,

            $anio,

            $idInversiones,

            $_SESSION["idUser"],

            $_SESSION["idRol"]

        );

        /*
    |--------------------------------------------------------------------------
    | PHPSPREADSHEET
    |--------------------------------------------------------------------------
    */

        //require_once "../vendor/autoload.php";

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle("Estado General Ejecutivo");

        /*
    |--------------------------------------------------------------------------
    | ENCABEZADO
    |--------------------------------------------------------------------------
    */

        $ultimaColumna =
            \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                4 + (count($anios) * 8)
            );

        $sheet->mergeCells(
            "A1:" . $ultimaColumna . "1"
        );

        $sheet->mergeCells(
            "A2:" . $ultimaColumna . "2"
        );

        $sheet->mergeCells(
            "A3:" . $ultimaColumna . "3"
        );

        $sheet->setCellValue(
            "A1",
            "EPS ILO S.A."
        );

        $sheet->setCellValue(
            "A2",
            "SISTEMA DE GESTIÓN DE INVERSIONES"
        );

        $sheet->setCellValue(
            "A3",
            "REPORTE EJECUTIVO DE INVERSIONES"
        );

        $sheet->getStyle("A1:" . $ultimaColumna . "3")
            ->applyFromArray([

                "font" => [

                    "bold" => true,

                    "size" => 15,

                    "color" => [

                        "rgb" => "FFFFFF"

                    ]

                ],

                "alignment" => [

                    "horizontal" =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

                    "vertical" =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER

                ],

                "fill" => [

                    "fillType" =>
                    \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

                    "startColor" => [

                        "rgb" => "1F4E78"

                    ]

                ]

            ]);

        /*
    |--------------------------------------------------------------------------
    | INFORMACIÓN
    |--------------------------------------------------------------------------
    */

        $sheet->setCellValue("A5", "Usuario");
        $sheet->setCellValue("B5", $_SESSION["nombres"]);

        $sheet->setCellValue("A6", "Fecha");

        $sheet->setCellValue(
            "B6",
            date("d/m/Y H:i:s")
        );

        $sheet->setCellValue("A7", "Reporte");

        $sheet->setCellValue(
            "B7",
            "Estado General Ejecutivo"
        );

        /*
    |--------------------------------------------------------------------------
    | RESUMEN
    |--------------------------------------------------------------------------
    */

        $sheet->mergeCells("A9:D9");

        $sheet->setCellValue(
            "A9",
            "RESUMEN EJECUTIVO"
        );

        $sheet->getStyle("A9:D9")
            ->applyFromArray([

                "font" => [

                    "bold" => true,

                    "color" => [

                        "rgb" => "FFFFFF"

                    ]

                ],

                "alignment" => [

                    "horizontal" =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER

                ],

                "fill" => [

                    "fillType" =>
                    \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

                    "startColor" => [

                        "rgb" => "4472C4"

                    ]

                ]

            ]);

        $sheet->setCellValue("A10", "Programado");
        $sheet->setCellValue("B10", $totales["programado"]);

        $sheet->setCellValue("A11", "Ejecutado");
        $sheet->setCellValue("B11", $totales["ejecutado"]);

        $sheet->setCellValue("A12", "Saldo");
        $sheet->setCellValue("B12", $totales["saldo"]);

        $sheet->setCellValue("A13", "PIM");
        $sheet->setCellValue("B13", $totales["pim"]);
        
        $avanceFinancieroTotal =
            isset($totales["avanceFinanciero"]) &&
            $totales["avanceFinanciero"] !== ""
            ? $totales["avanceFinanciero"] / 100
            : 0;

        $avanceFisicoTotal =
            isset($totales["avanceFisico"]) &&
            $totales["avanceFisico"] !== ""
            ? $totales["avanceFisico"] / 100
            : 0;

        $sheet->setCellValue("A14", "Avance Financiero");
        $sheet->setCellValue(
            "B14",
            $avanceFinancieroTotal
        );

        $sheet->setCellValue("A15", "Avance Fisico");
        $sheet->setCellValue(
            "B15",
            $avanceFisicoTotal
        );

        $sheet->getStyle("B14:B15")
            ->getNumberFormat()
            ->setFormatCode("0.00%");

        /*
    |--------------------------------------------------------------------------
    | INICIO DE TABLA
    |--------------------------------------------------------------------------
    */

        $filaInicioTabla = 18;

        /*
|--------------------------------------------------------------------------
| ENCABEZADOS FIJOS
|--------------------------------------------------------------------------
*/

        $sheet->mergeCells("A{$filaInicioTabla}:A" . ($filaInicioTabla + 1));
        $sheet->mergeCells("B{$filaInicioTabla}:B" . ($filaInicioTabla + 1));
        $sheet->mergeCells("C{$filaInicioTabla}:C" . ($filaInicioTabla + 1));
        $sheet->mergeCells("D{$filaInicioTabla}:D" . ($filaInicioTabla + 1));

        $sheet->setCellValue("A{$filaInicioTabla}", "N°");
        $sheet->setCellValue("B{$filaInicioTabla}", "INVERSIÓN");
        $sheet->setCellValue("C{$filaInicioTabla}", "ÁREA");
        $sheet->setCellValue("D{$filaInicioTabla}", "FONDO");

        /*
|--------------------------------------------------------------------------
| CABECERA DINÁMICA
|--------------------------------------------------------------------------
*/

        $columna = 5; // Columna E

        foreach ($anios as $anio) {

            $inicio =
                \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                    $columna
                );

            $fin =
                \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                    $columna + 7
                );

            /*
    |--------------------------------------------------------------------------
    | TÍTULO DEL AÑO
    |--------------------------------------------------------------------------
    */

            $sheet->mergeCells(
                $inicio .
                    $filaInicioTabla .
                    ":" .
                    $fin .
                    $filaInicioTabla
            );

            $sheet->setCellValue(
                $inicio . $filaInicioTabla,
                $anio
            );

            /*
    |--------------------------------------------------------------------------
    | SUBCOLUMNAS
    |--------------------------------------------------------------------------
    */

            $subFila = $filaInicioTabla + 1;

            $sheet->setCellValueByColumnAndRow($columna,     $subFila, "Programado");
            $sheet->setCellValueByColumnAndRow($columna + 1, $subFila, "PIM");
            $sheet->setCellValueByColumnAndRow($columna + 2, $subFila, "Ejecutado");
            $sheet->setCellValueByColumnAndRow($columna + 3, $subFila, "Saldo");
            $sheet->setCellValueByColumnAndRow($columna + 4, $subFila, "RDR");
            $sheet->setCellValueByColumnAndRow($columna + 5, $subFila, "E.T.");
            $sheet->setCellValueByColumnAndRow($columna + 6, $subFila, "Av. Fin.");
            $sheet->setCellValueByColumnAndRow($columna + 7, $subFila, "Av. Fís.");

            $columna += 8;
        }

        /*
|--------------------------------------------------------------------------
| ESTILO CABECERA
|--------------------------------------------------------------------------
*/

        $ultimaColumna =
            \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                4 + (count($anios) * 8)
            );

        $sheet->getStyle(
            "A{$filaInicioTabla}:{$ultimaColumna}" . ($filaInicioTabla + 1)
        )->applyFromArray([

            "font" => [

                "bold" => true,

                "color" => [

                    "rgb" => "FFFFFF"

                ]

            ],

            "alignment" => [

                "horizontal" =>
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

                "vertical" =>
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER

            ],

            "fill" => [

                "fillType" =>
                \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

                "startColor" => [

                    "rgb" => "2F75B5"

                ]

            ],

            "borders" => [

                "allBorders" => [

                    "borderStyle" =>
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN

                ]

            ]

        ]);

        $sheet->getRowDimension($filaInicioTabla)
            ->setRowHeight(25);

        $sheet->getRowDimension($filaInicioTabla + 1)
            ->setRowHeight(35);

        /*
|--------------------------------------------------------------------------
| LLENAR TABLA
|--------------------------------------------------------------------------
*/

        $fila = $filaInicioTabla + 2;

        $numero = 1;

        foreach ($datos as $inversion) {

            $sheet->setCellValue(
                "A" . $fila,
                $numero++
            );

            $sheet->setCellValue(
                "B" . $fila,
                $inversion["descripcion"]
            );

            $sheet->setCellValue(
                "C" . $fila,
                $inversion["nombreArea"]
            );

            $sheet->setCellValue(
                "D" . $fila,
                $inversion["nombreFondo"]
            );

            $columna = 5;

            foreach ($anios as $anio) {

                if (isset($inversion["anios"][$anio])) {

                    $dato = $inversion["anios"][$anio];

                    $avanceFinanciero =
                        isset($dato["avanceFinanciero"]) &&
                        $dato["avanceFinanciero"] !== ""
                        ? $dato["avanceFinanciero"] / 100
                        : 0;


                    $avanceFisico =
                        isset($dato["avanceFisico"]) &&
                        $dato["avanceFisico"] !== ""
                        ? $dato["avanceFisico"] / 100
                        : 0;


                    $sheet->setCellValueByColumnAndRow(
                        $columna,
                        $fila,
                        $dato["programado"]
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 1,
                        $fila,
                        $dato["pim"]
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 2,
                        $fila,
                        $dato["ejecutado"]
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 3,
                        $fila,
                        $dato["saldo"]
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 4,
                        $fila,
                        $dato["rdr"]
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 5,
                        $fila,
                        $dato["et"]
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 6,
                        $fila,
                        $avanceFinanciero
                    );

                    $sheet->setCellValueByColumnAndRow(
                        $columna + 7,
                        $fila,
                        $avanceFisico
                    );
                } else {

                    for ($i = 0; $i < 8; $i++) {

                        $sheet->setCellValueByColumnAndRow(
                            $columna + $i,
                            $fila,
                            ""
                        );
                    }
                }

                $columna += 8;
            } // FIN foreach ($anios as $anio)

            $fila++;
        } // FIN foreach ($datos as $inversion)

        /*
|--------------------------------------------------------------------------
| FORMATO TABLA
|--------------------------------------------------------------------------
*/

        $ultimaFila = $fila - 1;


        $sheet->getStyle(
            "A{$filaInicioTabla}:{$ultimaColumna}{$ultimaFila}"
        )
            ->applyFromArray([

                "borders" => [

                    "allBorders" => [

                        "borderStyle" =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN

                    ]

                ]

            ]);

        /*
|--------------------------------------------------------------------------
| FORMATO MONEDA
|--------------------------------------------------------------------------
*/

        for ($col = 5; $col <= 4 + (count($anios) * 8); $col++) {

            for ($i = 0; $i < count($anios); $i++) {

                $colMonto = $col + ($i * 8);


                $sheet->getStyleByColumnAndRow(
                    $colMonto,
                    $filaInicioTabla + 2,
                    $colMonto,
                    $ultimaFila
                )
                    ->getNumberFormat()
                    ->setFormatCode('#,##0.00');
            }
        }

        /*
|--------------------------------------------------------------------------
| FORMATO PORCENTAJES
|--------------------------------------------------------------------------
*/

        foreach ($anios as $index => $anio) {


            $colAvFin =
                5 + ($index * 8) + 6;


            $colAvFis =
                5 + ($index * 8) + 7;


            $sheet->getStyleByColumnAndRow(
                $colAvFin,
                $filaInicioTabla + 2,
                $colAvFin,
                $ultimaFila
            )
                ->getNumberFormat()
                ->setFormatCode("0.00%");


            $sheet->getStyleByColumnAndRow(
                $colAvFis,
                $filaInicioTabla + 2,
                $colAvFis,
                $ultimaFila
            )
                ->getNumberFormat()
                ->setFormatCode("0.00%");
        }

        /*
|--------------------------------------------------------------------------
| ANCHO DE COLUMNAS
|--------------------------------------------------------------------------
*/

        $sheet->getColumnDimension("A")
            ->setWidth(8);


        $sheet->getColumnDimension("B")
            ->setWidth(45);


        $sheet->getColumnDimension("C")
            ->setWidth(25);


        $sheet->getColumnDimension("D")
            ->setWidth(20);


        for ($i = 5; $i <= 4 + (count($anios) * 8); $i++) {


            $colLetra =
                \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);


            $sheet->getColumnDimension($colLetra)
                ->setWidth(14);
        }

        /*
|--------------------------------------------------------------------------
| CONGELAR PANELES
|--------------------------------------------------------------------------
*/

        $sheet->freezePane("E20");

        /*
|--------------------------------------------------------------------------
| DESCARGAR EXCEL
|--------------------------------------------------------------------------
*/

        $nombreArchivo =
            "Reporte_Ejecutivo_Inversiones_" .
            date("Ymd_His") .
            ".xlsx";

        ob_end_clean();

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );


        header(
            'Content-Disposition: attachment; filename="' . $nombreArchivo . '"'
        );


        header(
            'Cache-Control: max-age=0'
        );


        $writer =
            new \PhpOffice\PhpSpreadsheet\Writer\Xlsx(
                $spreadsheet
            );

        ob_start();

        $writer =
            new \PhpOffice\PhpSpreadsheet\Writer\Xlsx(
                $spreadsheet
            );

        $writer->save("php://output");
        
        ob_end_flush();

        exit;
    }

    private function exportarPDF()
    {
        $resultado =
            $this->obtenerDatosReporte();
        $datos =
            $resultado["detalle"];
        $html = '
        <html>
        <head>
        <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        h2{
            text-align:center;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        th{
            background:#e5e7eb;
            border:1px solid #999;
            padding:5px;
        }
        td{
            border:1px solid #ccc;
            padding:5px;
        }
        .numero{
            text-align:right;
        }
        </style>
        </head>
        <body>
        <h2>
            Reporte General de Inversiones
        </h2>
        <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Inversión</th>
            <th>Área</th>
            <th>Fondo</th>
            <th>Año</th>
            <th>Programado</th>
            <th>Ejecutado</th>
            <th>Saldo</th>
            <th>PIM</th>
        </tr>
        </thead>
        <tbody>';
        $numero = 1;
        $totalProgramado = 0;
        $totalEjecutado = 0;
        $totalSaldo = 0;
        $totalPim = 0;
        foreach ($datos as $item) {
            $totalProgramado += $item["programado"];
            $totalEjecutado += $item["ejecutado"];
            $totalSaldo += $item["saldo"];
            $totalPim += $item["pim"];
            $html .= '
            <tr>
                <td>
                    ' . $numero++ . '
                </td>
                <td>
                    ' . $item["descripcion"] . '
                </td>
                <td>
                    ' . $item["siglasArea"] . '
                </td>
                <td>
                    ' . $item["codigoFondo"] . '
                </td>
                <td>
                    ' . $item["anio"] . '
                </td>
                <td class="numero">
                    S/ ' . number_format(
                $item["programado"],
                2
            ) . '
                </td>
                <td class="numero">
                    S/ ' . number_format(
                $item["ejecutado"],
                2
            ) . '
                </td>
                <td class="numero">
                    S/ ' . number_format(
                $item["saldo"],
                2
            ) . '
                </td>
                <td class="numero">
                    S/ ' . number_format(
                $item["pim"],
                2
            ) . '
                </td>
            </tr>';
        }
        $html .= '
        <tr>
        <td colspan="5">
        <b>
        TOTAL GENERAL
        </b>
        </td>
        <td>
        <b>
        S/ ' . number_format(
            $totalProgramado,
            2
        ) . '
        </b>
        </td>
        <td>
        <b>
        S/ ' . number_format(
            $totalEjecutado,
            2
        ) . '
        </b>
        </td>
        <td>
        <b>
        S/ ' . number_format(
            $totalSaldo,
            2
        ) . '
        </b>
        </td>
        <td>
        <b>
        S/ ' . number_format(
            $totalPim,
            2
        ) . '
        </b>
        </td>
        </tr>
        ';
        $html .= '
        </tbody>
        </table>
        </body>
        </html>';
        $dompdf =
            new \Dompdf\Dompdf();
        $dompdf->loadHtml(
            $html
        );
        $dompdf->setPaper(
            "A4",
            "landscape"
        );
        $dompdf->render();
        $dompdf->stream(
            "Reporte_Inversiones.pdf",
            [
                "Attachment" => true
            ]
        );
        exit;
    }
}
