<?php
class DashboardModel
{
    private $db;
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    private function construirWhere($filtros, &$params)
    {
        $where = " WHERE 1=1 ";
        if (!empty($filtros['estudio'])) {
            $where .= " AND ar.idEstudioTarifario = ? ";
            $params[] = $filtros['estudio'];
        }
        if (!empty($filtros['inversion'])) {
            $where .= " AND i.idInversiones = ? ";
            $params[] = $filtros['inversion'];
        }
        if (!empty($filtros['area'])) {
            $where .= " AND i.idAreas = ? ";
            $params[] = $filtros['area'];
        }
        if (!empty($filtros['fondo'])) {
            $where .= " AND i.idFondos = ? ";
            $params[] = $filtros['fondo'];
        }
        return $where;
    }
    private function agregarFiltroAnio($where, &$params, $filtros, $operador = "=")
    {
        if (!empty($filtros['anio'])) {
            $where .= " AND ar.anio {$operador} ? ";
            $params[] = $filtros['anio'];
        }
        return $where;
    }
    // BLOQUE 1 - KPIs GENERALES
    // BLOQUE 1 - KPIs GENERALES
    public function obtenerKPIs($filtros)
    {
        /*
    |--------------------------------------------------------------------------
    | FILTROS BASE
    |--------------------------------------------------------------------------
    */
        $params = [];
        $where = $this->construirWhere($filtros, $params);
        /*
        |--------------------------------------------------------------------------
        | 1. TOTAL GENERAL
        |--------------------------------------------------------------------------
        | Suma programado de todos los años
        |--------------------------------------------------------------------------
        */
        $sqlTotal = "
                    SELECT
                        COALESCE(SUM(ar.programado),0) AS total
                    FROM inversiones i
                    INNER JOIN anio_regulatorio ar
                        ON ar.idInversiones = i.idInversiones
                    $where
                    ";
        $stmt = $this->db->prepare($sqlTotal);
        $stmt->execute($params);
        $total = $stmt->fetchColumn();
        /*
        TOTAL PIM 
        */
        $sqlPimTotal = "
            SELECT
                COALESCE(SUM(ar.rdr + ar.et),0)
            FROM inversiones i
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones = i.idInversiones
            $where
        ";
        $stmt = $this->db->prepare($sqlPimTotal);
        $stmt->execute($params);
        $totalPim = $stmt->fetchColumn();
        /*
        TOTAL EJECUCION
        */
        $sqlEjecucionTotal = "
            SELECT
                COALESCE(SUM(em.ejecutado),0)
            FROM anio_regulatorio ar
            INNER JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio = ar.idAnioRegulatorio
            $where
        ";
        $stmt = $this->db->prepare($sqlEjecucionTotal);
        $stmt->execute($params);
        $totalEjecucion = $stmt->fetchColumn();
        /*
        TOTAL SALDO
        */
        $totalSaldo =
            $total - $totalEjecucion;
        /*
        |--------------------------------------------------------------------------
        | AVANCE TOTAL GENERAL
        |--------------------------------------------------------------------------
        */
        $avanceTotal =
            $total > 0
            ? round(
                ($totalEjecucion / $total) * 100,
                2
            )
            : 0;
        /*
        |--------------------------------------------------------------------------
        | 2. PIM
        |--------------------------------------------------------------------------
        | RDR + ET del año seleccionado
        |--------------------------------------------------------------------------
        */
        $paramsPim = $params;
        $wherePim = $this->agregarFiltroAnio(
            $where,
            $paramsPim,
            $filtros,
            "="
        );
        $sqlPim = "
            SELECT
                COALESCE(SUM(ar.rdr + ar.et),0) AS pim
            FROM inversiones i
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones = i.idInversiones
            $wherePim
            ";
        $stmt = $this->db->prepare($sqlPim);
        $stmt->execute($paramsPim);
        $pim = $stmt->fetchColumn();
        /*
        |--------------------------------------------------------------------------
        | 3. TOTAL ACUMULADO
        |--------------------------------------------------------------------------
        | Programado hasta el año seleccionado
        |--------------------------------------------------------------------------
        */
        $paramsAcumulado = $params;
        $whereAcumulado = $this->agregarFiltroAnio(
            $where,
            $paramsAcumulado,
            $filtros,
            "<="
        );
        $sqlAcumulado = "
                        SELECT
                            COALESCE(SUM(ar.programado),0)
                        FROM inversiones i
                        INNER JOIN anio_regulatorio ar
                            ON ar.idInversiones = i.idInversiones
                        $whereAcumulado
                        ";
        $stmt = $this->db->prepare($sqlAcumulado);
        $stmt->execute($paramsAcumulado);
        $totalAcumulado = $stmt->fetchColumn();
        /*
        |--------------------------------------------------------------------------
        | PIM ACUMULADO
        |--------------------------------------------------------------------------
        | RDR + ET hasta el año seleccionado
        |--------------------------------------------------------------------------
        */
        $sqlPimAcumulado = "
            SELECT
                COALESCE(SUM(ar.rdr + ar.et),0) AS pim
            FROM inversiones i
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones = i.idInversiones
            $whereAcumulado
        ";
        $stmt = $this->db->prepare($sqlPimAcumulado);
        $stmt->execute($paramsAcumulado);
        $pimAcumulado = $stmt->fetchColumn();
        /*
        |--------------------------------------------------------------------------
        | 4. EJECUCIÓN ACUMULADA
        |--------------------------------------------------------------------------
        | Se obtiene desde la suma de la ejecución mensual
        |--------------------------------------------------------------------------
        */
        $sqlEjecucion = "
                        SELECT
                            COALESCE(SUM(em.ejecutado),0) AS ejecutadoAcumulado
                        FROM anio_regulatorio ar
                        INNER JOIN inversiones i
                            ON i.idInversiones = ar.idInversiones
                        LEFT JOIN ejecucion_mensual em
                            ON em.idAnioRegulatorio = ar.idAnioRegulatorio
                        $whereAcumulado
                        ";
        $stmt = $this->db->prepare($sqlEjecucion);
        $stmt->execute($paramsAcumulado);
        $ejecucionAcumulada = $stmt->fetchColumn();
        /*
        |--------------------------------------------------------------------------
        | CÁLCULOS FINALES
        |--------------------------------------------------------------------------
        */
        // Acumulado hasta el año seleccionado
        $saldoAcumulado =
            $totalAcumulado - $ejecucionAcumulada;
        /*
        |--------------------------------------------------------------------------
        | AVANCE ACUMULADO
        |--------------------------------------------------------------------------
        */
        $avanceAcumulado =
            $totalAcumulado > 0
            ? round(
                ($ejecucionAcumulada / $total) * 100,
                2
            )
            : 0;
        /*
        |--------------------------------------------------------------------------
        | 5. SOLO AÑO SELECCIONADO
        |--------------------------------------------------------------------------
        | Datos únicamente del año elegido
        |--------------------------------------------------------------------------
        */
        $paramsAnio = $params;
        $whereAnio = $this->agregarFiltroAnio(
            $where,
            $paramsAnio,
            $filtros,
            "="
        );
        /*
        |--------------------------------------------------------------------------
        | INVERSION DEL AÑO
        |--------------------------------------------------------------------------
        */
        $sqlTotalAnio = "
            SELECT
                COALESCE(SUM(ar.programado),0)
            FROM inversiones i
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones = i.idInversiones
            $whereAnio
        ";
        $stmt = $this->db->prepare($sqlTotalAnio);
        $stmt->execute($paramsAnio);
        $totalAnio = $stmt->fetchColumn();
        /*
        |--------------------------------------------------------------------------
        | EJECUCIÓN DEL AÑO
        |--------------------------------------------------------------------------
        */
        $sqlEjecucionAnio = "
            SELECT
                COALESCE(SUM(em.ejecutado),0)
            FROM anio_regulatorio ar
            INNER JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio = ar.idAnioRegulatorio
            $whereAnio
        ";
        $stmt = $this->db->prepare($sqlEjecucionAnio);
        $stmt->execute($paramsAnio);
        $ejecucionAnio = $stmt->fetchColumn();
        /*
        |--------------------------------------------------------------------------
        | SALDO DEL AÑO
        |--------------------------------------------------------------------------
        */
        $saldoAnio =
            $totalAnio - $ejecucionAnio;
        /*
        |--------------------------------------------------------------------------
        | AVANCE DEL AÑO
        |--------------------------------------------------------------------------
        */
        $avanceAnio =
            $totalAnio > 0
            ? round(
                ($ejecucionAnio / $totalAnio) * 100,
                2
            )
            : 0;
        return [
            /*
            |--------------------------------------------------------------------------
            | BLOQUE 1 - TOTALES GENERALES
            |--------------------------------------------------------------------------
            */
            "total" => $total,
            "totalPim" => $totalPim,
            "totalEjecucion" => $totalEjecucion,
            "totalSaldo" => $totalSaldo,
            "avanceTotal" => $avanceTotal,
            /*
            |--------------------------------------------------------------------------
            | BLOQUE 2 - HASTA AÑO SELECCIONADO
            |--------------------------------------------------------------------------
            */
            "totalAcumulado" => $totalAcumulado,
            "pimAcumulado" => $pimAcumulado,
            "ejecucionAcumulada" => $ejecucionAcumulada,
            "saldoAcumulado" => $saldoAcumulado,
            "avanceAcumulado" => $avanceAcumulado,
            /*
            |--------------------------------------------------------------------------
            | BLOQUE 3 - SOLO AÑO SELECCIONADO
            |--------------------------------------------------------------------------
            */
            "totalAnio" => $totalAnio,
            "pimAnio" => $pim,
            "ejecucionAnio" => $ejecucionAnio,
            "saldoAnio" => $saldoAnio,
            "avanceAnio" => $avanceAnio
        ];
    }
    public function obtenerGraficoPrincipal($filtros)
    {
        /*
    |--------------------------------------------------------------------------
    | FILTROS BASE
    |--------------------------------------------------------------------------
    */
        $params = [];
        $where = $this->construirWhere($filtros, $params);
        /*
    |--------------------------------------------------------------------------
    | SI EXISTE AÑO
    |--------------------------------------------------------------------------
    | Mostrar el histórico hasta el año seleccionado
    |--------------------------------------------------------------------------
    */
        if (!empty($filtros['anio'])) {
            $where = $this->agregarFiltroAnio(
                $where,
                $params,
                $filtros,
                "<="
            );
        }
        /*
    |--------------------------------------------------------------------------
    | PROGRAMADO VS EJECUTADO POR AÑO
    |--------------------------------------------------------------------------
    | Respeta todos los filtros:
    | - Estudio Tarifario
    | - Año (<= seleccionado)
    | - Fondo
    | - Área
    | - Inversión
    |--------------------------------------------------------------------------
    */
        $sql = "
            SELECT
                ar.anio,
                COALESCE(SUM(ar.programado),0) AS programado,
                COALESCE(SUM(em.totalEjecutado),0) AS ejecutado
            FROM anio_regulatorio ar
            INNER JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            LEFT JOIN (
                SELECT
                    idAnioRegulatorio,
                    SUM(ejecutado) AS totalEjecutado
                FROM ejecucion_mensual
                GROUP BY idAnioRegulatorio
            ) em
                ON em.idAnioRegulatorio = ar.idAnioRegulatorio
            $where
            GROUP BY ar.anio
            ORDER BY ar.anio ASC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // FILTROS DEL DASHBOARD
    public function obtenerFiltros($filtros)
    {
        /*
    |--------------------------------------------------------------------------
    | ESTUDIO TARIFARIO
    |--------------------------------------------------------------------------
    */
        $sql = "
            SELECT
                idEstudioTarifario,
                codigo,
                nombre,
                anioInicio,
                anioFin
            FROM estudio_tarifario
            WHERE estado = 'ACTIVO'
            ORDER BY anioInicio ASC
            ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $estudios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*
        |--------------------------------------------------------------------------
        | AÑOS
        |--------------------------------------------------------------------------
        */
        $params = [];
        $sql = "
                SELECT DISTINCT
                    ar.anio
                FROM anio_regulatorio ar
                WHERE 1=1
                ";
        if (!empty($filtros['estudio'])) {
            $sql .= " AND ar.idEstudioTarifario = ? ";
            $params[] = $filtros['estudio'];
        }
        $sql .= "
                ORDER BY ar.anio ASC
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $anios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*
        |--------------------------------------------------------------------------
        | INVERSIONES
        |--------------------------------------------------------------------------
        */
        $params = [];
        $sql = "
                SELECT DISTINCT
                    i.idInversiones,
                    i.cui,
                    i.descripcion,
                    i.nombre
                FROM inversiones i
                INNER JOIN anio_regulatorio ar
                    ON ar.idInversiones = i.idInversiones
                WHERE 1=1
                ";
        if (!empty($filtros['estudio'])) {
            $sql .= "
                    AND ar.idEstudioTarifario = ?
                    ";
            $params[] = $filtros['estudio'];
        }
        if (!empty($filtros['anio'])) {
            $sql .= "
                    AND ar.anio = ?
                    ";
            $params[] = $filtros['anio'];
        }
        if (!empty($filtros['fondo'])) {
            $sql .= "
                    AND i.idFondos = ?
                    ";
            $params[] = $filtros['fondo'];
        }
        if (!empty($filtros['area'])) {
            $sql .= "
                    AND i.idAreas = ?
                    ";
            $params[] = $filtros['area'];
        }
        $sql .= "
                ORDER BY i.nombre ASC
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $inversiones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*
|--------------------------------------------------------------------------
| AREAS
|--------------------------------------------------------------------------
*/
        $params = [];
        $sql = "
                SELECT DISTINCT
                    a.idAreas,
                    a.siglasArea,
                    a.nombreArea
                FROM areas a
                INNER JOIN inversiones i
                    ON i.idAreas = a.idAreas
                INNER JOIN anio_regulatorio ar
                    ON ar.idInversiones = i.idInversiones
                WHERE 1=1
                ";
        if (!empty($filtros['estudio'])) {
            $sql .= "
                    AND ar.idEstudioTarifario = ?
                    ";
            $params[] = $filtros['estudio'];
        }
        if (!empty($filtros['anio'])) {
            $sql .= "
                    AND ar.anio = ?
                    ";
            $params[] = $filtros['anio'];
        }
        if (!empty($filtros['fondo'])) {
            $sql .= "
                    AND i.idFondos = ?
                    ";
            $params[] = $filtros['fondo'];
        }
        $sql .= "
                ORDER BY a.nombreArea ASC
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*
        |--------------------------------------------------------------------------
        | FONDOS
        |--------------------------------------------------------------------------
        */
        $params = [];
        $sql = "
                SELECT DISTINCT
                    f.idFondos,
                    f.codigoFondo,
                    f.nombreFondo
                FROM fondos f
                INNER JOIN inversiones i
                    ON i.idFondos = f.idFondos
                INNER JOIN anio_regulatorio ar
                    ON ar.idInversiones = i.idInversiones
                WHERE 1=1
                ";
        if (!empty($filtros['estudio'])) {
            $sql .= "
                    AND ar.idEstudioTarifario = ?
                    ";
            $params[] = $filtros['estudio'];
        }
        if (!empty($filtros['anio'])) {
            $sql .= "
                    AND ar.anio = ?
                    ";
            $params[] = $filtros['anio'];
        }
        $sql .= "
                ORDER BY f.nombreFondo ASC
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $fondos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [
            "estudios" => $estudios,
            "anios" => $anios,
            "inversiones" => $inversiones,
            "areas" => $areas,
            "fondos" => $fondos
        ];
    }
    public function obtenerGraficoFondo($filtros)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTROS BASE
        |--------------------------------------------------------------------------
        */
        $params = [];
        $where = $this->construirWhere($filtros, $params);
        /*
        |--------------------------------------------------------------------------
        | SI EXISTE AÑO
        |--------------------------------------------------------------------------
        | Para gráficos de distribución se usa "="
        |--------------------------------------------------------------------------
        */
        if (!empty($filtros['anio'])) {
            $where = $this->agregarFiltroAnio(
                $where,
                $params,
                $filtros,
                "="
            );
        }
        /*
    |--------------------------------------------------------------------------
    | DISTRIBUCIÓN POR FONDO
    |--------------------------------------------------------------------------
    */
        $sql = "
            SELECT
                f.nombreFondo,
                COALESCE(SUM(ar.programado),0) AS total
            FROM anio_regulatorio ar
            INNER JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            INNER JOIN fondos f
                ON f.idFondos = i.idFondos
            $where
            GROUP BY
                f.idFondos,
                f.nombreFondo
            ORDER BY
                total DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerGraficoArea($filtros)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTROS
        |--------------------------------------------------------------------------
        */
        $params = [];
        $where = $this->construirWhere($filtros, $params);
        /*
        |--------------------------------------------------------------------------
        | SI EXISTE AÑO
        |--------------------------------------------------------------------------
        */
        if (!empty($filtros['anio'])) {
            $where = $this->agregarFiltroAnio(
                $where,
                $params,
                $filtros,
                "="
            );
        }
        /*
        |--------------------------------------------------------------------------
        | DISTRIBUCIÓN POR ÁREA
        |--------------------------------------------------------------------------
        */
        $sql = "
            SELECT
                a.siglasArea,
                COALESCE(SUM(ar.programado),0) AS total
            FROM anio_regulatorio ar
            INNER JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            INNER JOIN areas a
                ON a.idAreas = i.idAreas
            $where
            GROUP BY
                a.idAreas,
                a.nombreArea
            ORDER BY
                total DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerGraficoAvance($filtros)
    {
        /*
    |--------------------------------------------------------------------------
    | FILTROS
    |--------------------------------------------------------------------------
    */
        $params = [];
        $where = $this->construirWhere($filtros, $params);
        /*
    |--------------------------------------------------------------------------
    | SI EXISTE AÑO
    |--------------------------------------------------------------------------
    | Mostrar histórico hasta el año seleccionado
    |--------------------------------------------------------------------------
    */
        if (!empty($filtros['anio'])) {
            $where = $this->agregarFiltroAnio(
                $where,
                $params,
                $filtros,
                "<="
            );
        }
        /*
    |--------------------------------------------------------------------------
    | AVANCE FINANCIERO VS AVANCE FÍSICO
    |--------------------------------------------------------------------------
    */
        $sql = "
            SELECT
                ar.anio,
                COALESCE(SUM(ar.programado),0) AS programado,
                COALESCE(SUM(em.totalEjecutado),0) AS ejecutado,
                ROUND(
                    (
                        COALESCE(SUM(em.totalEjecutado),0)
                        /
                        NULLIF(SUM(ar.programado),0)
                    ) * 100,
                    2
                ) AS avanceFinanciero,
                ROUND(
                    SUM(
                        ar.programado * ar.avanceFisico
                    )
                    /
                    NULLIF(
                        SUM(ar.programado),
                        0
                    ),
                    2
                ) AS avanceFisico
            FROM anio_regulatorio ar
            INNER JOIN inversiones i
                ON i.idInversiones = ar.idInversiones
            LEFT JOIN (
                SELECT
                    idAnioRegulatorio,
                    SUM(ejecutado) AS totalEjecutado
                FROM ejecucion_mensual
                GROUP BY idAnioRegulatorio
            ) em
                ON em.idAnioRegulatorio = ar.idAnioRegulatorio
        $where
            GROUP BY ar.anio
            ORDER BY ar.anio ASC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $datos = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $datos[] = [
                "anio" => $fila["anio"],
                "avanceFinanciero" =>
                (float)$fila["avanceFinanciero"],
                "avanceFisico" =>
                (float)$fila["avanceFisico"]
            ];
        }
        return $datos;
    }
    public function obtenerTopInversionProgramado($filtros)
    {
        /*
    |--------------------------------------------------------------------------
    | FILTROS
    |--------------------------------------------------------------------------
    */
        $params = [];
        $where = $this->construirWhere(
            $filtros,
            $params
        );
        /*
    |--------------------------------------------------------------------------
    | SI EXISTE AÑO
    |--------------------------------------------------------------------------
    | Acumulado hasta el año seleccionado
    |--------------------------------------------------------------------------
    */
        if (!empty($filtros['anio'])) {
            $where = $this->agregarFiltroAnio(
                $where,
                $params,
                $filtros,
                "<="
            );
        }
        $sql = "
            SELECT
                i.descripcion,
                COALESCE(SUM(ar.programado),0) AS total
            FROM inversiones i
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones = i.idInversiones
            $where
            GROUP BY
                i.idInversiones,
                i.descripcion
            ORDER BY
                total DESC
            LIMIT 10
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerTopInversionEjecutado($filtros)
    {
        /*
    |--------------------------------------------------------------------------
    | FILTROS
    |--------------------------------------------------------------------------
    */
        $params = [];
        $where = $this->construirWhere(
            $filtros,
            $params
        );
        /*
    |--------------------------------------------------------------------------
    | SI EXISTE AÑO
    |--------------------------------------------------------------------------
    */
        if (!empty($filtros['anio'])) {
            $where = $this->agregarFiltroAnio(
                $where,
                $params,
                $filtros,
                "<="
            );
        }
        $sql = "
            SELECT
                i.descripcion,
                COALESCE(
                    SUM(em.ejecutado),
                    0
                ) AS total
            FROM inversiones i
            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones = i.idInversiones
            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio = ar.idAnioRegulatorio
            $where
            GROUP BY
                i.idInversiones,
                i.descripcion
            ORDER BY
                total DESC
            LIMIT 10
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
