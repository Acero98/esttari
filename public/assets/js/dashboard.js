document.addEventListener("DOMContentLoaded", function () {
    // =======================================
    // FILTROS DASHBOARD
    // =======================================
    const filtros = [
        "filtroEstudio",
        "filtroAnio",
        "filtroFondo",
        "filtroArea",
        "filtroInversion"
    ];
    filtros.forEach(id => {
        const elemento = document.getElementById(id);
        if (!elemento) return;
        elemento.addEventListener("change", function () {
            // ==============================
            // LIMPIAR FILTROS DEPENDIENTES
            // ==============================
            switch (id) {
                case "filtroEstudio":
                    document.getElementById("filtroAnio").value = "";
                    document.getElementById("filtroFondo").value = "";
                    document.getElementById("filtroArea").value = "";
                    document.getElementById("filtroInversion").value = "";
                    break;
                case "filtroAnio":
                    document.getElementById("filtroFondo").value = "";
                    document.getElementById("filtroArea").value = "";
                    document.getElementById("filtroInversion").value = "";
                    break;
                case "filtroFondo":
                    document.getElementById("filtroArea").value = "";
                    document.getElementById("filtroInversion").value = "";
                    break;
                case "filtroArea":
                    document.getElementById("filtroInversion").value = "";
                    break;
            }
            controlarFiltros();
            const params = new URLSearchParams();
            params.set("url", "dashboard");
            const estudio = document.getElementById("filtroEstudio").value;
            const anio = document.getElementById("filtroAnio").value;
            const fondo = document.getElementById("filtroFondo").value;
            const area = document.getElementById("filtroArea").value;
            const inversion = document.getElementById("filtroInversion").value;
            if (estudio) params.set("estudio", estudio);
            if (anio) params.set("anio", anio);
            if (fondo) params.set("fondo", fondo);
            if (area) params.set("area", area);
            if (inversion) params.set("inversion", inversion);
            window.location.href = "index.php?" + params.toString();
        });
    });
    // =======================================
    // LIMPIAR FILTROS
    // =======================================
    const limpiar = document.getElementById("limpiarFiltros");
    if (limpiar) {
        limpiar.addEventListener("click", function () {
            window.location.href = "index.php?url=dashboard";
        });
    }
    controlarFiltros();
});
function controlarFiltros() {
    const estudio =
        document.getElementById("filtroEstudio")?.value || "";
    const anio =
        document.getElementById("filtroAnio");
    const fondo =
        document.getElementById("filtroFondo");
    const area =
        document.getElementById("filtroArea");
    const inversion =
        document.getElementById("filtroInversion");
    // Año depende de Estudio
    if (anio) {
        anio.disabled = !estudio;
    }
    // Fondo depende de Estudio + Año
    if (fondo) {
        fondo.disabled = !(estudio && anio.value);
    }
    // Área depende de Estudio + Año + Fondo
    if (area) {
        area.disabled = !(estudio && anio.value && fondo.value);
    }
    // Inversión depende de Estudio + Año + Fondo + Área
    if (inversion) {
        inversion.disabled = !(
            estudio &&
            anio.value &&
            fondo.value &&
            area.value
        );
    }
}
// =======================================
// GRAFICO PRINCIPAL
// =======================================
document.addEventListener("DOMContentLoaded", function () {
    if (typeof graficoPrincipal === "undefined") return;
    if (!Array.isArray(graficoPrincipal)) return;
    const categorias = graficoPrincipal.map(item => item.anio);
    const series = [
        {
            name: "Programado",
            data: graficoPrincipal.map(item =>
                Number(item.programado)
            )
        },
        {
            name: "Ejecutado",
            data: graficoPrincipal.map(item =>
                Number(item.ejecutado)
            )
        }
    ];
    const options = {
        chart: {
            type: "bar",
            height: 360,
            toolbar: {
                show: false
            }
        },
        series: series,
        xaxis: {
            categories: categorias
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2
        },
        legend: {
            position: "top"
        },
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: "45%"
            }
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return "S/ " + Number(val).toLocaleString("es-PE");
                }
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "S/ " +
                        Number(val).toLocaleString(
                            "es-PE",
                            {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }
                        );
                }
            }
        }
    };
    new ApexCharts(
        document.querySelector("#graficoPrincipal"),
        options
    ).render();
});
// =======================================
// DISTRIBUCIÓN POR FONDO
// =======================================
document.addEventListener("DOMContentLoaded", function () {
    if (typeof graficoFondo === "undefined") return;
    const series = graficoFondo.map(item =>
        Number(item.total)
    );
    const labels = graficoFondo.map(item =>
        item.nombreFondo
    );
    const options = {
        chart: {
            type: "donut",
            height: 360
        },
        series: series,
        labels: labels,
        legend: {
            position: "bottom"
        },
        dataLabels: {
            enabled: true
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "S/ " +
                        Number(val).toLocaleString(
                            "es-PE",
                            {
                                minimumFractionDigits: 2
                            }
                        );
                }
            }
        }
    };
    new ApexCharts(
        document.querySelector("#graficoFondo"),
        options
    ).render();
});
// =======================================
// DISTRIBUCIÓN POR ÁREA
// =======================================
document.addEventListener("DOMContentLoaded", function () {
    if (typeof graficoArea === "undefined") return;
    const series = graficoArea.map(item =>
        Number(item.total)
    );
    const labels = graficoArea.map(item =>
        item.nombreArea
    );
    const options = {
        chart: {
            type: "donut",
            height: 360
        },
        series: series,
        labels: labels,
        legend: {
            position: "bottom"
        },
        dataLabels: {
            enabled: true
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "S/ " +
                        Number(val).toLocaleString(
                            "es-PE",
                            {
                                minimumFractionDigits: 2
                            }
                        );
                }
            }
        }
    };
    new ApexCharts(
        document.querySelector("#graficoArea"),
        options
    ).render();
});
// =======================================
// AVANCE FINANCIERO VS AVANCE FÍSICO
// =======================================
document.addEventListener("DOMContentLoaded", function () {
    if (typeof graficoAvance === "undefined") return;
    const categorias = graficoAvance.map(item =>
        item.anio
    );
    const series = [
        {
            name: "Avance Financiero (%)",
            data: graficoAvance.map(item =>
                Number(item.avanceFinanciero)
            )
        },
        {
            name: "Avance Físico (%)",
            data: graficoAvance.map(item =>
                Number(item.avanceFisico)
            )
        }
    ];
    const options = {
        chart: {
            type: "line",
            height: 360,
            toolbar: {
                show: false
            }
        },
        series: series,
        xaxis: {
            categories: categorias
        },
        yaxis: {
            max: 100,
            labels: {
                formatter: function (value) {
                    return value + "%";
                }
            }
        },
        stroke: {
            curve: "smooth",
            width: 3
        },
        markers: {
            size: 5
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            position: "top"
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value + "%";
                }
            }
        }
    };
    new ApexCharts(
        document.querySelector("#graficoAvance"),
        options
    ).render();
});
// =======================================
// TOP INVERSION PROGRAMADO
// =======================================
document.addEventListener("DOMContentLoaded", function () {
    if (typeof topProgramado === "undefined") return;
    const options = {
        chart: {
            type: "bar",
            height: 350,
            toolbar: {
                show: false
            }
        },
        series: [
            {
                name: "Programado",
                data: topProgramado.map(item =>
                    Number(item.total)
                )
            }
        ],
        xaxis: {
            categories: topProgramado.map(item =>
                item.descripcion
            )
        },
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 5,
                barHeight: "55%"
            }
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            y: {
                formatter: function(value){
                    return "S/ " +
                    value.toLocaleString("es-PE",
                    {
                        minimumFractionDigits:2
                    });
                }
            }
        }
    };
    new ApexCharts(
        document.querySelector("#topProgramadoChart"),
        options
    ).render();
});
// =======================================
// TOP INVERSION EJECUTADO
// =======================================
document.addEventListener("DOMContentLoaded", function () {
    if (typeof topEjecutado === "undefined") return;
    const options = {
        chart: {
            type: "bar",
            height: 350,
            toolbar: {
                show:false
            }
        },
        series:[
            {
                name:"Ejecutado",
                data: topEjecutado.map(item =>
                    Number(item.total)
                )
            }
        ],
        xaxis:{
            categories:topEjecutado.map(item =>
                item.descripcion
            )
        },
        plotOptions:{
            bar:{
                horizontal:true,
                borderRadius:5,
                barHeight:"55%"
            }
        },
        dataLabels:{
            enabled:false
        },
        tooltip:{
            y:{
                formatter:function(value){
                    return "S/ "+
                    value.toLocaleString("es-PE",
                    {
                        minimumFractionDigits:2
                    });
                }
            }
        }
    };
    new ApexCharts(
        document.querySelector("#topEjecutadoChart"),
        options
    ).render();
});