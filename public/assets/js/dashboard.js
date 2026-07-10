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
            // Si cambia el estudio, limpiar filtros inferiores
            if (id === "filtroEstudio") {
                document.getElementById("filtroAnio").value = "";
                document.getElementById("filtroFondo").value = "";
                document.getElementById("filtroArea").value = "";
                document.getElementById("filtroInversion").value = "";
            }
            const params = new URLSearchParams();

            params.set("url", "dashboard");

            const estudio = document.getElementById("filtroEstudio")?.value || "";
            const inversion = document.getElementById("filtroInversion")?.value || "";
            const area = document.getElementById("filtroArea")?.value || "";
            const fondo = document.getElementById("filtroFondo")?.value || "";
            const anio = document.getElementById("filtroAnio")?.value || "";


            if (estudio) {
                params.set("estudio", estudio);
            }

            if (inversion) {
                params.set("inversion", inversion);
            }

            if (area) {
                params.set("area", area);
            }

            if (fondo) {
                params.set("fondo", fondo);
            }

            if (anio) {
                params.set("anio", anio);
            }

            controlarFiltros();
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
// GRAFICO PROGRAMADO VS EJECUTADO ACUMULADO
// =======================================

document.addEventListener("DOMContentLoaded", function () {


    if (typeof graficoAcumulado !== "undefined") {


        const categorias =
            graficoAcumulado.map(
                item => item.anio
            );


        const programado =
            graficoAcumulado.map(
                item => Number(item.programado)
            );


        const ejecutado =
            graficoAcumulado.map(
                item => Number(item.ejecutado)
            );


        const options = {

            chart: {
                type: "bar",
                height: 350
            },


            series: [

                {
                    name: "Programado acumulado",
                    data: programado
                },

                {
                    name: "Ejecutado acumulado",
                    data: ejecutado
                }

            ],


            xaxis: {
                categories: categorias
            },


            dataLabels: {
                enabled: false
            }

        };


        const chart =
            new ApexCharts(
                document.querySelector("#graficoAcumulado"),
                options
            );


        chart.render();

    }


});