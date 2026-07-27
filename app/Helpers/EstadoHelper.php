<?php

function estadoInversion($estado)
{
    $estados = [

        1 => [
            "texto" => "Nuevo",
            "descripcion" => "La inversión fue registrada y está pendiente del inicio de actividades.",
            "color" => "bg-violet-100 text-violet-700",
            "icono" => "bi-stars",

            "bg" => "bg-violet-50",
            "border" => "border-violet-200",
            "iconBg" => "bg-violet-100",
            "iconColor" => "text-violet-600",
            "textColor" => "text-violet-700"
        ],

        2 => [
            "texto" => "En planificación",
            "descripcion" => "Se encuentra elaborando estudios, expedientes o programación.",
            "color" => "bg-blue-100 text-blue-700",
            "icono" => "bi-pencil-square",

            "bg" => "bg-blue-50",
            "border" => "border-blue-200",
            "iconBg" => "bg-blue-100",
            "iconColor" => "text-blue-600",
            "textColor" => "text-blue-700"
        ],

        3 => [
            "texto" => "En proceso",
            "descripcion" => "Se realizan gestiones técnicas o administrativas.",
            "color" => "bg-amber-100 text-amber-700",
            "icono" => "bi-hourglass-split",

            "bg" => "bg-amber-50",
            "border" => "border-amber-200",
            "iconBg" => "bg-amber-100",
            "iconColor" => "text-amber-600",
            "textColor" => "text-amber-700"
        ],

        4 => [
            "texto" => "En ejecución",
            "descripcion" => "La inversión se encuentra en ejecución física o financiera.",
            "color" => "bg-emerald-100 text-emerald-700",
            "icono" => "bi-play-circle-fill",

            "bg" => "bg-emerald-50",
            "border" => "border-emerald-200",
            "iconBg" => "bg-emerald-100",
            "iconColor" => "text-emerald-600",
            "textColor" => "text-emerald-700"
        ],

        5 => [
            "texto" => "En seguimiento",
            "descripcion" => "La inversión continúa y requiere monitoreo periódico.",
            "color" => "bg-cyan-100 text-cyan-700",
            "icono" => "bi-clipboard2-data-fill",

            "bg" => "bg-cyan-50",
            "border" => "border-cyan-200",
            "iconBg" => "bg-cyan-100",
            "iconColor" => "text-cyan-600",
            "textColor" => "text-cyan-700"
        ],

        6 => [
            "texto" => "Retrasado",
            "descripcion" => "La inversión presenta retrasos respecto al cronograma establecido.",
            "color" => "bg-orange-100 text-orange-700",
            "icono" => "bi-exclamation-triangle-fill",

            "bg" => "bg-orange-50",
            "border" => "border-orange-200",
            "iconBg" => "bg-orange-100",
            "iconColor" => "text-orange-600",
            "textColor" => "text-orange-700"
        ],

        7 => [
            "texto" => "Finalizado",
            "descripcion" => "La inversión culminó satisfactoriamente.",
            "color" => "bg-green-100 text-green-700",
            "icono" => "bi-check-circle-fill",

            "bg" => "bg-green-50",
            "border" => "border-green-200",
            "iconBg" => "bg-green-100",
            "iconColor" => "text-green-600",
            "textColor" => "text-green-700"
        ],

        8 => [
            "texto" => "Suspendido",
            "descripcion" => "La inversión fue suspendida temporalmente.",
            "color" => "bg-red-100 text-red-700",
            "icono" => "bi-pause-circle-fill",

            "bg" => "bg-red-50",
            "border" => "border-red-200",
            "iconBg" => "bg-red-100",
            "iconColor" => "text-red-600",
            "textColor" => "text-red-700"
        ],

        9 => [
            "texto" => "Cancelado",
            "descripcion" => "La inversión fue cancelada y no continuará.",
            "color" => "bg-slate-200 text-slate-700",
            "icono" => "bi-x-circle-fill",

            "bg" => "bg-slate-100",
            "border" => "border-slate-300",
            "iconBg" => "bg-slate-200",
            "iconColor" => "text-slate-700",
            "textColor" => "text-slate-700"
        ]

    ];

    return $estados[$estado] ?? [
        "texto" => "Sin estado",
        "descripcion" => "No se ha definido un estado para la inversión.",
        "color" => "bg-slate-100 text-slate-600",
        "icono" => "bi-question-circle",

        "bg" => "bg-slate-50",
        "border" => "border-slate-200",
        "iconBg" => "bg-slate-100",
        "iconColor" => "text-slate-500",
        "textColor" => "text-slate-600"
    ];
}
