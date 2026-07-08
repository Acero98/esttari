document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // PRESUPUESTO (RESUMEN)
    // =========================
    const presupuesto = window.graficoPresupuesto || {};

    const categorias = ["Presupuesto", "Ejecutado"];

    const montos = [
        Number(presupuesto.presupuesto || 0),
        Number(presupuesto.ejecutado || 0)
    ];

    new ApexCharts(document.querySelector("#graficoPresupuesto"), {
        chart: { type: 'bar', height: 350 },
        series: [{ name: 'Presupuesto', data: montos }],
        xaxis: { categories: categorias },
        dataLabels: { enabled: false }
    }).render();


    // =========================
    // FONDOS (ESTE SÍ ES ARRAY)
    // =========================
    const fondos = window.graficoFondos || [];

    const categoriasFondos = fondos.map(i => i.nombre);
    const valoresFondos = fondos.map(i => parseFloat(i.monto));

    new ApexCharts(document.querySelector("#graficoFondos"), {
        chart: { type: 'pie', height: 350 },
        series: valoresFondos,
        labels: categoriasFondos
    }).render();


    // =========================
    // EJECUCIÓN MENSUAL
    // =========================
    const ejecucion = window.graficoEjecucionMensual || [];

    const meses = ejecucion.map(i => i.mes);
    const programado = ejecucion.map(i => Number(i.programado || 0));
    const ejecutado = ejecucion.map(i => Number(i.ejecutado || 0));

    new ApexCharts(document.querySelector("#graficoEjecucionMensual"), {
        chart: {
            type: 'line',
            height: 350
        },
        series: [
            {
                name: 'Programado',
                data: programado
            },
            {
                name: 'Ejecutado',
                data: ejecutado
            }
        ],
        xaxis: {
            categories: meses
        },
        stroke: {
            curve: 'smooth'
        },
        dataLabels: {
            enabled: false
        }
    }).render();

    // =========================
    // EJECUCIÓN MENSUAL
    // =========================
    const procesos = window.procesos || [];

    const container = document.getElementById("listaProcesos");

    procesos.forEach(p => {

        let icon = "✔";
        let color = "text-green-600";
        let bg = "bg-green-500";

        if (p.status === "WARNING") {
            icon = "⚠";
            color = "text-yellow-600";
            bg = "bg-yellow-500";
        }

        if (p.status === "DELAY") {
            icon = "✖";
            color = "text-red-600";
            bg = "bg-red-500";
        }

        const item = document.createElement("div");

        item.innerHTML = `
            <div class="flex justify-between items-center mb-1">
                <span class="text-sm font-medium ${color}">
                    ${icon} Proceso #${p.idProcesos}
                </span>

                <span class="text-xs text-gray-500">
                    ${p.inicioProg} → ${p.finProg}
                </span>
            </div>

            <div class="h-2 w-full bg-gray-200 rounded">
                <div class="${bg} h-2 rounded w-full"></div>
            </div>
        `;

        container.appendChild(item);
    });

});