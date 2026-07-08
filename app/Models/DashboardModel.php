<?php

class DashboardModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function obtenerKPIs($filtros = [])
    {
        $where = "WHERE 1=1";

        if (!empty($filtros['area'])) {
            $where .= " AND idAreas = " . intval($filtros['area']);
        }

        if (!empty($filtros['fondo'])) {
            $where .= " AND idFondos = " . intval($filtros['fondo']);
        }

        if (!empty($filtros['anio'])) {
            $where .= " AND periodoAnio = '" . $filtros['anio'] . "'";
        }

        // KPIs principales
        $sql = "SELECT
                COUNT(*) AS programas,
                SUM(montoTotal) AS montoTotal,
                SUM(ejecutadoAcum) AS ejecutado,
                SUM(saldo) AS saldo
            FROM inversiones
            $where";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $kpis = $stmt->fetch(PDO::FETCH_ASSOC);

        // áreas
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM areas WHERE estadoArea = 1");
        $stmt->execute();
        $kpis['areas'] = $stmt->fetchColumn();

        // fondos
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM fondos");
        $stmt->execute();
        $kpis['fondos'] = $stmt->fetchColumn();

        // 🔥 ejecución REAL (mejorada)
        $sqlEjec = "SELECT 
                    SUM(ejecutado) / NULLIF(SUM(programado),0) * 100 AS ejecucion
                FROM ejecucion_mensual
                WHERE 1=1";

        if (!empty($filtros['anio'])) {
            $sqlEjec .= " AND anio = '" . $filtros['anio'] . "'";
        }

        $stmt = $this->db->prepare($sqlEjec);
        $stmt->execute();

        $kpis['ejecucion'] = round($stmt->fetchColumn() ?? 0, 2);

        return $kpis;
    }

    public function obtenerFiltros()
    {
        // Programas
        $stmt = $this->db->query("
        SELECT
            idInversiones,
            nombre
        FROM inversiones
        ORDER BY nombre
        ");

        $programas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Oficinas
        $stmt = $this->db->query("
        SELECT
            idAreas,
            nombreArea
        FROM areas
        WHERE estadoArea = 1
        ORDER BY nombreArea
        ");

        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fondos
        $stmt = $this->db->query("
        SELECT
            idFondos,
            nombre
        FROM fondos
        ORDER BY nombre
        ");

        $fondos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Años
        $stmt = $this->db->query("
        SELECT DISTINCT
            anio
        FROM montos_anuales
        ORDER BY anio DESC
        ");

        $anios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'programas' => $programas,
            'areas' => $areas,
            'fondos' => $fondos,
            'anios' => $anios
        ];
    }

    public function obtenerGraficoPresupuesto($filtros = [])
    {
        $where = "WHERE 1=1";

        if (!empty($filtros['programa'])) {
            $where .= " AND idInversiones = " . intval($filtros['programa']);
        }

        if (!empty($filtros['area'])) {
            $where .= " AND idAreas = " . intval($filtros['area']);
        }

        if (!empty($filtros['fondo'])) {
            $where .= " AND idFondos = " . intval($filtros['fondo']);
        }

        if (!empty($filtros['anio'])) {
            $where .= " AND periodoAnio = '" . $filtros['anio'] . "'";
        }

        $sql = "
        SELECT
            SUM(montoTotal) AS presupuesto,
            SUM(ejecutadoAcum) AS ejecutado
        FROM inversiones
        $where
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerGraficoFondos($filtros = [])
    {
        $where = "WHERE 1=1";

        if (!empty($filtros['programa'])) {
            $where .= " AND i.idInversiones = " . intval($filtros['programa']);
        }

        if (!empty($filtros['area'])) {
            $where .= " AND i.idAreas = " . intval($filtros['area']);
        }

        if (!empty($filtros['anio'])) {
            $where .= " AND i.periodoAnio = '" . $filtros['anio'] . "'";
        }

        $sql = "
        SELECT
            f.nombre,
            SUM(i.montoTotal) AS monto
        FROM inversiones i
        INNER JOIN fondos f
            ON i.idFondos = f.idFondos
        $where
        GROUP BY f.idFondos
        ORDER BY monto DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEjecucionMensual($anio = null)
    {
        $where = "WHERE 1=1";

        if (!empty($anio)) {
            $where .= " AND anio = '" . $anio . "'";
        }

        $sql = "
        SELECT
            mes,
            SUM(programado) AS programado,
            SUM(ejecutado) AS ejecutado
        FROM ejecucion_mensual
        $where
        GROUP BY mes
        ORDER BY mes ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function obtenerProcesos()
    {
        $sql = "
        SELECT
            idProcesos,
            idInversiones,
            estado,
            inicioProg,
            finProg,
            inicioReal,
            finReal
        FROM procesos
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];

        foreach ($data as &$p) {

            $inicioProg = $p['inicioProg'];
            $finProg    = $p['finProg'];
            $inicioReal = $p['inicioReal'];
            $finReal    = $p['finReal'];

            $p['status'] = 'OK';

            // ❌ ATRASO
            if (!empty($finReal) && $finReal > $finProg) {
                $p['status'] = 'DELAY';
            }

            // ⚠ ALERTA (inicio en límite o muy justo)
            elseif (!empty($inicioReal) && $inicioReal >= $finProg) {
                $p['status'] = 'WARNING';
            }

            // ✔ OK (todo dentro de rango)
            else {
                $p['status'] = 'OK';
            }
        }

        return $data;
    }
}
