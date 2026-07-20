<?php

class DashboardInversionModel
{

    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function obtenerInversiones()
    {
        $sql = "

            SELECT

                idInversiones,
                descripcion

            FROM inversiones

            WHERE estado = 1

            ORDER BY descripcion

        ";

        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerInformacionGeneral($idInversion)
    {
        $sql = "
            SELECT
                i.idInversiones,
                i.nombre,
                i.descripcion,
                i.cui,
                i.estado,
                i.fechaCreado,

                a.nombreArea,
                g.nombreGerencia,
                f.nombreFondo,

                et.idEstudioTarifario,
                et.nombre AS nombreEstudio,
                et.anioInicio,
                et.anioFin,

                CONCAT(
                    et.nombre,
                    ' (',
                    et.anioInicio,
                    ' - ',
                    et.anioFin,
                    ')'
                ) AS estudioTarifario,

                GROUP_CONCAT(
                    DISTINCT CONCAT(
                        u.nombres,
                        ' ',
                        u.apellidos
                    )
                    ORDER BY u.nombres
                    SEPARATOR ', '
                ) AS responsables

            FROM inversiones i

            INNER JOIN areas a
                ON a.idAreas = i.idAreas

            INNER JOIN gerencias g
                ON g.idGerencias = a.idGerencias

            INNER JOIN fondos f
                ON f.idFondos = i.idFondos

            INNER JOIN (
                SELECT
                    idInversiones,
                    idEstudioTarifario
                FROM anio_regulatorio
                GROUP BY
                    idInversiones,
                    idEstudioTarifario
            ) ar
                ON ar.idInversiones = i.idInversiones

            INNER JOIN estudio_tarifario et
                ON et.idEstudioTarifario = ar.idEstudioTarifario

            LEFT JOIN usuarios_areas ua
                ON ua.idAreas = i.idAreas

            LEFT JOIN usuarios u
                ON u.idUser = ua.idUser

            WHERE i.idInversiones = ?

            GROUP BY
                i.idInversiones,
                i.nombre,
                i.descripcion,
                i.cui,
                i.estado,
                i.fechaCreado,
                a.nombreArea,
                g.nombreGerencia,
                f.nombreFondo,
                et.idEstudioTarifario,
                et.nombre,
                et.anioInicio,
                et.anioFin
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idInversion]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerResumenAniosRegulatorios($idInversion)
    {
        $sql = "
            SELECT
                ar.idAnioRegulatorio,
                ar.anio,

                ar.programado,
                ar.avanceFisico,

                COALESCE(
                    SUM(em.total),
                    0
                ) AS total,

                (
                    ar.programado -
                    COALESCE(SUM(em.total),0)
                ) AS saldo,

                (
                    COALESCE(ar.rdr,0) +
                    COALESCE(ar.et,0)
                ) AS pim

            FROM anio_regulatorio ar

            LEFT JOIN ejecucion_mensual em
                ON em.idAnioRegulatorio = ar.idAnioRegulatorio

            WHERE ar.idInversiones = ?

            GROUP BY
                ar.idAnioRegulatorio,
                ar.anio,
                ar.programado,
                ar.rdr,
                ar.et

            ORDER BY ar.anio
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idInversion]);

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $programadoAcumulado = 0;
        $ejecutadoAcumulado = 0;


        foreach ($resultado as &$fila) {

            $programadoAcumulado += $fila['programado'];
            $ejecutadoAcumulado += $fila['total'];


            if ($programadoAcumulado > 0) {

                $fila['avanceFinanciero'] =
                    ($ejecutadoAcumulado / $programadoAcumulado) * 100;
            } else {

                $fila['avanceFinanciero'] = 0;
            }
        }


        return $resultado;
    }

    public function obtenerInversionesPorEstudio(
        $idEstudioTarifario,
        $idFondo
    ) {
        $sql = "
            SELECT
                i.idInversiones,
                i.nombre,
                i.descripcion

            FROM inversiones i

            WHERE 
                i.idEstudioTarifario = ?

            AND
                i.idFondos = ?

            AND
                i.estado = 1

            ORDER BY i.nombre
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $idEstudioTarifario,
            $idFondo
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEstudiosTarifarios()
    {
        $sql = "
            SELECT
                idEstudioTarifario,
                nombre,
                anioInicio,
                anioFin
            FROM estudio_tarifario
            WHERE estado = 'Activo'
            ORDER BY anioInicio DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerInversionesPorEstudioUsuario(
        $idEstudioTarifario,
        $idFondo,
        $idUsuario
    ) {
        $sql = "
            SELECT DISTINCT
                i.idInversiones,
                i.nombre,
                i.descripcion

            FROM inversiones i

            INNER JOIN usuarios_areas ua
                ON ua.idAreas = i.idAreas

            WHERE
                i.idEstudioTarifario = ?

            AND
                i.idFondos = ?

            AND
                ua.idUser = ?

            AND
                i.estado = 1

            ORDER BY i.nombre
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $idEstudioTarifario,
            $idFondo,
            $idUsuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calcularTotalesInversion(array $resumenAnios)
    {
        $totales = [
            'programado' => 0,
            'total' => 0,
            'saldo' => 0,
            'pim' => 0
        ];

        foreach ($resumenAnios as $fila) {

            $totales['programado'] += $fila['programado'];
            $totales['total'] += $fila['total'];
            $totales['saldo'] += $fila['saldo'];
            $totales['pim'] += $fila['pim'];
        }

        return $totales;
    }
    public function obtenerFondosPorEstudio($idEstudioTarifario)
    {
        $sql = "
            SELECT DISTINCT
                f.idFondos,
                f.nombreFondo

            FROM fondos f

            INNER JOIN inversiones i
                ON i.idFondos = f.idFondos

            WHERE i.idEstudioTarifario = ?

            AND f.estadoFondo = 1

            ORDER BY f.nombreFondo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idEstudioTarifario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEjecucionesRecientes($idInversion)
    {
        $sql = "
            SELECT
                ar.anio,
                em.mes,
                em.total
                
            FROM ejecucion_mensual em


            INNER JOIN anio_regulatorio ar
                ON ar.idAnioRegulatorio = em.idAnioRegulatorio


            WHERE ar.idInversiones = ?

            AND em.estado = 1


            ORDER BY em.mes DESC

            LIMIT 5
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $idInversion
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUltimoSeguimiento($idInversion)
    {
        $sql = "
            SELECT
                ar.anio,
                sm.estadoInver,
                sm.acciones,
                sm.fechas,
                sm.situacion
            FROM seguimiento_mensual sm

            INNER JOIN anio_regulatorio ar
                ON ar.idAnioRegulatorio = sm.idAnioRegulatorio

            WHERE ar.idInversiones = ?

            AND sm.estado = 1

            AND sm.fechas = (

                SELECT MAX(sm2.fechas)

                FROM seguimiento_mensual sm2

                INNER JOIN anio_regulatorio ar2
                    ON ar2.idAnioRegulatorio = sm2.idAnioRegulatorio

                WHERE ar2.idInversiones = ?

                AND sm2.estado = 1

            )

            ORDER BY sm.idSeguimientoMensual ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $idInversion,
            $idInversion
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
