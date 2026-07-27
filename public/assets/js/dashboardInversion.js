document
    .getElementById("filtroEstudio")
    ?.addEventListener("change", function () {

        document.getElementById("filtroInversion").selectedIndex = 0;

    });
/*document
    .getElementById("filtroEstudio")
    ?.addEventListener("change", function () {
        document.getElementById("filtroInversion").selectedIndex = 0;
        this.form.submit();
    });

document
    .getElementById("filtroInversion")
    ?.addEventListener("change", function () {
        this.form.submit();
    });*/
document.addEventListener(
    "DOMContentLoaded",
    function () {
        const datos = evolucionAnual;
        if (
            !datos ||
            datos.length === 0
        ) {
            return;
        }
        const categorias =
            datos.map(
                item => item.anio
            );
        const programado =
            datos.map(
                item => Number(item.programado)
            );
        const ejecutado =
            datos.map(
                item => Number(item.total)
            );
        const options = {
            chart: {
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                }
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
                categories: categorias
            },
            yaxis: {
                labels: {
                    formatter: function (valor) {
                        return "S/ " +
                            (valor / 1000000)
                                .toFixed(1) +
                            " M";
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (valor) {
                    if (valor >= 1000000) {
                        return "S/ " +
                            (valor / 1000000)
                                .toFixed(1) +
                            " M";
                    }
                    return "S/ " +
                        valor.toLocaleString(
                            'es-PE'
                        );
                },
                style: {
                    fontSize: '11px'
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadius: 5
                }
            },
            colors: [
                '#2563eb',
                '#10b981'
            ],
            tooltip: {
                y: {
                    formatter: function (valor) {
                        return "S/ " +
                            valor.toLocaleString(
                                'es-PE',
                                {
                                    minimumFractionDigits: 2
                                }
                            );
                    }
                }
            },
            legend: {
                position: "top",
                horizontalAlign: "center"
            },
            grid: {
                borderColor: '#e5e7eb'
            }
        };
        const chart =
            new ApexCharts(
                document.querySelector(
                    "#graficoEvolucionAnual"
                ),
                options
            );
        chart.render();
    }
);
const opciones = {
    chart: {
        type: 'bar',
        height: 300,
        toolbar: {
            show: false
        }
    },
    series: [
        {
            name: 'Avance Financiero',
            data: avanceFinanciero
        },
        {
            name: 'Avance Físico',
            data: avanceFisico
        }
    ],
    xaxis: {
        categories: categoriasAvance,
        title: {
            text: 'Año Regulatorio'
        },
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    yaxis: {
        min: 0,
        max: 100,
        tickAmount: 5,
        title: {
            text: 'Avance (%)'
        },
        labels: {
            formatter: function (value) {
                return value + "%";
            }
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (value) {
            return value.toFixed(0) + "%";
        },
        style: {
            fontSize: '11px'
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "70%",
            borderRadius: 5
        }
    },
    colors: [
        '#2563eb',
        '#10b981'
    ],
    tooltip: {
        y: {
            formatter: function (value) {
                return value.toFixed(2) + "%";
            }
        }
    },
    legend: {
        position: "top",
        horizontalAlign: "center"
    },
    grid: {
        borderColor: '#e5e7eb'
    }
};
new ApexCharts(
    document.querySelector("#graficoAvances"),
    opciones
).render();

document.querySelectorAll(".tom-select").forEach(function (elemento) {

    new TomSelect(elemento, {
        create: false,
        allowEmptyOption: true,
        placeholder: "Seleccione...",
        maxOptions: 500,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

});