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
        $saldoAcumulado =
            $total - $ejecucionAcumulada;
        $avance =
            $total > 0
            ? round(
                ($ejecucionAcumulada / $total) * 100,
                2
            )
            : 0;

        return [
            "total" => $total,
            "pim" => $pim,
            "totalAcumulado" => $totalAcumulado,
            "ejecucionAcumulada" => $ejecucionAcumulada,
            "saldoAcumulado" => $saldoAcumulado,
            "avance" => $avance
        ];
    }

    public function obtenerGraficoProgramadoVsEjecutado($filtros)
    {
        $params = [];
        $where = $this->construirWhere($filtros, $params);

        $where = $this->agregarFiltroAnio(
            $where,
            $params,
            $filtros,
            "<="
        );

        $sql = "
            SELECT
                COALESCE(SUM(ar.programado),0) AS programado,
                COALESCE(SUM(em.ejecutado),0) AS ejecutado

            FROM inversiones i

            INNER JOIN anio_regulatorio ar
                ON ar.idInversiones=i.idInversiones

            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio=ar.idAnioRegulatorio

            $where
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerGraficoAcumuladoPorAnio($filtros)
    {
        $params = [];
        $where = $this->construirWhere($filtros, $params);
        $sql = "
                SELECT
                    ar.anio,
                    COALESCE(SUM(ar.programado),0) AS programado,
                    COALESCE(SUM(em.ejecutado),0) AS ejecutado

                FROM anio_regulatorio ar

                INNER JOIN inversiones i
                    ON i.idInversiones = ar.idInversiones

                LEFT JOIN ejecucion_mensual em
                    ON em.idAnioRegulatorio = ar.idAnioRegulatorio
                $where
                GROUP BY ar.anio
                ORDER BY ar.anio ASC
                ";


        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $programadoAcumulado = 0;
        $ejecutadoAcumulado = 0;

        $resultado = [];

        foreach ($datos as $fila) {
            $programadoAcumulado += $fila['programado'];
            $ejecutadoAcumulado += $fila['ejecutado'];
            $resultado[] = [
                "anio" => $fila['anio'],
                "programado" => $programadoAcumulado,
                "ejecutado" => $ejecutadoAcumulado
            ];
        }
        return $resultado;
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
                nombre
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
                    f.codigo,
                    f.nombre

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
                ORDER BY f.nombre ASC
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
}
