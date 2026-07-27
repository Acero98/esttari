<?php
class ReporteModel
{
    private $db;
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    /*
    |--------------------------------------------------------------------------
    | REPORTE GENERAL DE INVERSIONES
    |--------------------------------------------------------------------------
    */
    public function obtenerReporteInversiones(
        $idEstudioTarifario,
        $idFondo,
        $idArea,
        $anio,
        $idInversiones
    ) {
        $sql = "
            SELECT
                i.idInversiones,
                i.nombre,
                i.descripcion,
                et.nombre AS estudioTarifario,
                et.anioInicio,
                et.anioFin,
                f.nombreFondo,
                a.nombreArea,
                ar.anio,
                ar.programado,
                COALESCE(
                    SUM(em.total),
                    0
                ) AS ejecutado,
                (
                    ar.programado -
                    COALESCE(SUM(em.total),0)
                ) AS saldo
            FROM inversiones i
            INNER JOIN estudio_tarifario et
                ON et.idEstudioTarifario =
                i.idEstudioTarifario
            INNER JOIN fondos f
                ON f.idFondos =
                i.idFondos
            INNER JOIN areas a
                ON a.idAreas =
                i.idAreas
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones =
                i.idInversiones
            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio =
                ar.idAnioRegulatorio
            WHERE 1=1
        ";
        $parametros = [];
        if ($idEstudioTarifario) {
            $sql .= "
                AND i.idEstudioTarifario = ?
            ";
            $parametros[] =
                $idEstudioTarifario;
        }
        if ($idFondo) {
            $sql .= "
                AND i.idFondos = ?
            ";
            $parametros[] =
                $idFondo;
        }
        if ($idArea) {
            $sql .= "
                AND i.idAreas = ?
            ";
            $parametros[] =
                $idArea;
        }
        if ($anio) {
            $sql .= "
                AND ar.anio = ?
            ";
            $parametros[] =
                $anio;
        }
        if ($idInversiones) {
            $sql .= "
                AND i.idInversiones = ?
            ";
            $parametros[] =
                $idInversiones;
        }
        $sql .= "
            GROUP BY
                i.idInversiones,
                i.nombre,
                i.descripcion,
                et.nombre,
                f.nombreFondo,
                a.nombreArea,
                ar.anio,
                ar.programado
            ORDER BY
                ar.anio
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /*
    |--------------------------------------------------------------------------
    | ESTADO GENERAL DE INVERSIONES
    |--------------------------------------------------------------------------
    |
    | Super Admin:
    |   Todas las inversiones
    |
    | Otros usuarios:
    |   Solo inversiones de sus áreas asignadas
    |
    |--------------------------------------------------------------------------
    */
    public function obtenerEstadoGeneral(
        $idEstudioTarifario,
        $idFondo,
        $idArea,
        $anio,
        $idInversiones,
        $idUsuario,
        $idRol
    ) {
        $sql = "
            SELECT
                i.idInversiones,
                i.nombre,
                i.descripcion,
                et.nombre AS estudioTarifario,
                et.anioInicio,
                et.anioFin,
                f.codigoFondo,
                f.nombreFondo,
                a.siglasArea,
                a.nombreArea,
                ar.anio,
                ar.programado,
                COALESCE(
                    ar.rdr,
                    0
                ) AS rdr,
                COALESCE(
                    ar.et,
                    0
                ) AS et,
                (
                    COALESCE(ar.rdr,0)
                    +
                    COALESCE(ar.et,0)
                ) AS pim,
                COALESCE(
                    SUM(em.total),
                    0
                ) AS ejecutado,
                (
                    ar.programado -
                    COALESCE(SUM(em.total),0)
                ) AS saldo,
                ar.avanceFisico
            FROM inversiones i
            INNER JOIN estudio_tarifario et
                ON et.idEstudioTarifario =
                i.idEstudioTarifario
            INNER JOIN fondos f
                ON f.idFondos =
                i.idFondos
            INNER JOIN areas a
                ON a.idAreas =
                i.idAreas
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones =
                i.idInversiones
            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio =
                ar.idAnioRegulatorio
        ";
        $parametros = [];
        /*
        |--------------------------------------------------------------------------
        | FILTRO POR ÁREA DEL USUARIO
        |--------------------------------------------------------------------------
        */
        if ($idRol != 1) {
            $sql .= "
                INNER JOIN usuarios_areas ua
                    ON ua.idAreas =
                    i.idAreas
            ";
        }
        $sql .= "
            WHERE 1=1
        ";
        if ($idRol != 1) {
            $sql .= "
                AND ua.idUser = ?
            ";
            $parametros[] =
                $idUsuario;
        }
        if ($idEstudioTarifario) {
            $sql .= "
                AND i.idEstudioTarifario = ?
            ";
            $parametros[] =
                $idEstudioTarifario;
        }
        if ($idFondo) {
            $sql .= "
                AND i.idFondos = ?
            ";
            $parametros[] =
                $idFondo;
        }
        if ($idArea) {
            $sql .= "
                AND i.idAreas = ?
            ";
            $parametros[] =
                $idArea;
        }
        if ($anio) {
            $sql .= "
                AND ar.anio = ?
            ";
            $parametros[] =
                $anio;
        }
        if ($idInversiones) {
            $sql .= "
                AND i.idInversiones = ?
            ";
            $parametros[] =
                $idInversiones;
        }
        $sql .= "
            GROUP BY
                i.idInversiones,
                i.nombre,
                i.descripcion,
                et.nombre,
                f.codigoFondo,
                f.nombreFondo,
                a.nombreArea,
                ar.anio,
                ar.programado,
                ar.rdr,
                ar.et,
                ar.avanceFisico
            ORDER BY
                i.descripcion,
                ar.anio
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $inversionActual = null;
        $programadoAcumulado = 0;
        $ejecutadoAcumulado = 0;
        foreach ($datos as &$fila) {
            // Si cambia de inversión, reiniciar acumulados
            if ($inversionActual != $fila["idInversiones"]) {
                $inversionActual = $fila["idInversiones"];
                $programadoAcumulado = 0;
                $ejecutadoAcumulado = 0;
            }
            $programadoAcumulado += $fila["programado"];
            $ejecutadoAcumulado += $fila["ejecutado"];
            $fila["ejecucionAcumulada"] =
                $ejecutadoAcumulado;
            $fila["saldoAcumulado"] =
                $programadoAcumulado -
                $ejecutadoAcumulado;
            if ($programadoAcumulado > 0) {
                $fila["avanceFinanciero"] =
                    round(
                        (
                            $ejecutadoAcumulado /
                            $programadoAcumulado
                        ) * 100,
                        2
                    );
            } else {
                $fila["avanceFinanciero"] = 0;
            }
        }
        unset($fila);
        /*
|--------------------------------------------------------------------------
| TOTALES DEL REPORTE
|--------------------------------------------------------------------------
*/
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
        /*
|--------------------------------------------------------------------------
| SUMATORIAS GENERALES
|--------------------------------------------------------------------------
*/
        foreach ($datos as $fila) {
            $totales["programado"] += $fila["programado"] ?? 0;
            $totales["ejecutado"] += $fila["ejecutado"] ?? 0;
            $totales["saldo"] += $fila["saldo"] ?? 0;
            $totales["rdr"] += $fila["rdr"] ?? 0;
            $totales["et"] += $fila["et"] ?? 0;
            $totales["pim"] += $fila["pim"] ?? 0;
        }
        /*
|--------------------------------------------------------------------------
| ÚLTIMO ACUMULADO POR INVERSIÓN
|--------------------------------------------------------------------------
|
| Se toma únicamente el último registro de cada inversión para evitar
| sumar varias veces los acumulados de los años anteriores.
|
*/
        $acumulados = [];
        foreach ($datos as $fila) {
            $acumulados[$fila["idInversiones"]] = [
                "ejecucionAcumulada" =>
                $fila["ejecucionAcumulada"],
                "saldoAcumulado" =>
                $fila["saldoAcumulado"]
            ];
        }
        foreach ($acumulados as $item) {
            $totales["ejecucionAcumulada"] +=
                $item["ejecucionAcumulada"];
            $totales["saldoAcumulado"] +=
                $item["saldoAcumulado"];
        }
        /*
|--------------------------------------------------------------------------
| AVANCE FINANCIERO GENERAL
|--------------------------------------------------------------------------
*/
        if ($totales["programado"] > 0) {
            $totales["avanceFinanciero"] =
                round(
                    (
                        $totales["ejecutado"] /
                        $totales["programado"]
                    ) * 100,
                    2
                );
        } else {
            $totales["avanceFinanciero"] = 0;
        }
        /*
|--------------------------------------------------------------------------
| AVANCE FÍSICO PROMEDIO
|--------------------------------------------------------------------------
*/
        $totalFisico = 0;
        $cantidadFisico = 0;
        foreach ($datos as $fila) {
            if (
                isset($fila["avanceFisico"]) &&
                $fila["avanceFisico"] !== ""
            ) {
                $totalFisico +=
                    floatval($fila["avanceFisico"]);
                $cantidadFisico++;
            }
        }
        $totales["avanceFisico"] =
            $cantidadFisico > 0
            ? round(
                $totalFisico / $cantidadFisico,
                2
            )
            : 0;
        /*
|--------------------------------------------------------------------------
| RETORNAR RESULTADO
|--------------------------------------------------------------------------
*/
        return [
            "detalle" => $datos,
            "totales" => $totales
        ];
    }
    public function obtenerEstadoGeneralEjecutivo(
        $idEstudioTarifario,
        $idFondo,
        $idArea,
        $anio,
        $idInversiones,
        $idUsuario,
        $idRol
    ) {

        $resultado = $this->obtenerEstadoGeneral(
            $idEstudioTarifario,
            $idFondo,
            $idArea,
            $anio,
            $idInversiones,
            $idUsuario,
            $idRol
        );

        $detalle = $resultado["detalle"];
        $datos = [];
        foreach ($detalle as $fila) {
            $id = $fila["idInversiones"];
            if (!isset($datos[$id])) {
                $datos[$id] = [
                    "idInversiones" => $id,
                    "descripcion" => $fila["descripcion"],
                    "nombreArea" => $fila["nombreArea"],
                    "nombreFondo" => $fila["nombreFondo"],
                    "estudioTarifario" => $fila["estudioTarifario"],
                    "anioInicio" => $fila["anioInicio"],
                    "anioFin" => $fila["anioFin"],
                    "anios" => []
                ];
            }

            $datos[$id]["anios"][$fila["anio"]] = [
                "programado" => $fila["programado"],
                "ejecutado" => $fila["ejecutado"],
                "saldo" => $fila["saldo"],
                "rdr" => $fila["rdr"],
                "et" => $fila["et"],
                "pim" => $fila["pim"],
                "avanceFisico" => $fila["avanceFisico"],
                "avanceFinanciero" => $fila["avanceFinanciero"]
            ];
        }

        return [
            "detalle" => array_values($datos),
            "totales" => $resultado["totales"]
        ];
    }
    public function obtenerAniosReporteEjecutivo(
        $idEstudioTarifario,
        $idFondo,
        $idArea,
        $anio,
        $idInversiones,
        $idUsuario,
        $idRol
    ) {

        $sql = "
        SELECT DISTINCT
            ar.anio
        FROM inversiones i

        INNER JOIN anio_regulatorio ar
            ON ar.idInversiones = i.idInversiones
    ";

        $parametros = [];

        if ($idRol != 1) {

            $sql .= "
            INNER JOIN usuarios_areas ua
                ON ua.idAreas = i.idAreas
        ";
        }

        $sql .= "
        WHERE 1 = 1
    ";

        if ($idRol != 1) {

            $sql .= "
            AND ua.idUser = ?
        ";

            $parametros[] = $idUsuario;
        }

        if ($idEstudioTarifario) {

            $sql .= "
            AND i.idEstudioTarifario = ?
        ";

            $parametros[] = $idEstudioTarifario;
        }

        if ($idFondo) {

            $sql .= "
            AND i.idFondos = ?
        ";

            $parametros[] = $idFondo;
        }

        if ($idArea) {

            $sql .= "
            AND i.idAreas = ?
        ";

            $parametros[] = $idArea;
        }

        if ($anio) {

            $sql .= "
            AND ar.anio = ?
        ";

            $parametros[] = $anio;
        }

        if ($idInversiones) {

            $sql .= "
            AND i.idInversiones = ?
        ";

            $parametros[] = $idInversiones;
        }

        $sql .= "
        ORDER BY ar.anio
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function obtenerFiltros(
        $idUsuario,
        $idRol
    ) {
        $sql = "
            SELECT
                i.idInversiones,
                i.nombre,
                i.descripcion,
                et.idEstudioTarifario,
                et.nombre AS estudioTarifario,
                et.anioInicio,
                et.anioFin,
                f.idFondos,
                f.nombreFondo,
                a.idAreas,
                a.nombreArea,
                ar.anio
            FROM inversiones i
        ";
        $parametros = [];
        /*
        |--------------------------------------------------------------------------
        | CONTROL DE ACCESO POR ÁREA
        |--------------------------------------------------------------------------
        |
        | Super Admin:
        |   Todas las inversiones
        |
        | Otros roles:
        |   Solo inversiones de sus áreas asignadas
        |
        |--------------------------------------------------------------------------
        */
        if ($idRol != 1) {
            $sql .= "
                INNER JOIN usuarios_areas ua
                    ON ua.idAreas = i.idAreas
            ";
        }
        $sql .= "
            INNER JOIN estudio_tarifario et
                ON et.idEstudioTarifario =
                i.idEstudioTarifario
            INNER JOIN fondos f
                ON f.idFondos =
                i.idFondos
            INNER JOIN areas a
                ON a.idAreas =
                i.idAreas
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones =
                i.idInversiones
            WHERE 1=1
        ";
        if ($idRol != 1) {
            $sql .= "
                AND ua.idUser = ?
            ";
            $parametros[] = $idUsuario;
        }
        $sql .= "
            ORDER BY
                et.nombre,
                ar.anio,
                f.nombreFondo,
                a.nombreArea
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [
            "estudios" =>
            array_values(
                array_reduce(
                    $datos,
                    function ($resultado, $item) {

                        $resultado[$item["idEstudioTarifario"]] = [

                            "idEstudioTarifario" =>
                            $item["idEstudioTarifario"],

                            "estudioTarifario" =>
                            $item["estudioTarifario"],

                            "anioInicio" =>
                            $item["anioInicio"],

                            "anioFin" =>
                            $item["anioFin"]

                        ];

                        return $resultado;
                    },
                    []
                )
            ),
            "fondos" =>
            array_values(
                array_reduce(
                    $datos,
                    function ($resultado, $item) {
                        $resultado[$item["idFondos"]] = [
                            "idFondos" =>
                            $item["idFondos"],
                            "nombreFondo" =>
                            $item["nombreFondo"]
                        ];
                        return $resultado;
                    },
                    []
                )
            ),
            "areas" =>
            array_values(
                array_reduce(
                    $datos,
                    function ($resultado, $item) {
                        $resultado[$item["idAreas"]] = [
                            "idAreas" =>
                            $item["idAreas"],
                            "nombreArea" =>
                            $item["nombreArea"]
                        ];
                        return $resultado;
                    },
                    []
                )
            ),
            "anios" =>
            array_values(
                array_unique(
                    array_column(
                        $datos,
                        "anio"
                    )
                )
            ),
            "inversiones" =>
            array_values(
                array_reduce(
                    $datos,
                    function ($resultado, $item) {
                        $resultado[$item["idInversiones"]] = [
                            "idInversiones" =>
                            $item["idInversiones"],
                            "descripcion" =>
                            $item["descripcion"]
                        ];
                        return $resultado;
                    },
                    []
                )
            )
        ];
    }
}
