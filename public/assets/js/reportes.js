document.addEventListener("DOMContentLoaded", () => {
    const tabla =
        document.querySelector("#tablaEstadoGeneral");
    if (!tabla) return;
    new simpleDatatables.DataTable(
        tabla,
        {
            searchable: true,
            fixedHeight: true,
            perPage: 10,
            perPageSelect: [10, 15, 25, 50, 100],
            labels: {
                placeholder: "Buscar...",
                perPage: "Registros por página",
                noRows: "No existen registros",
                noResults: "No se encontraron resultados",
                info: "Mostrando {start} a {end} de {rows} registros"
            }
        }
    );
});
function exportarExcel() {
    let tabla =
        document.querySelector(
            "#tablaEstadoGeneral"
        );
    let filas =
        tabla.cloneNode(true);
    // quitar limitación visual del paginador
    filas.querySelectorAll(
        "tbody tr"
    ).forEach(
        tr => tr.style.display = ""
    );
    let libro =
        XLSX.utils.table_to_book(
            filas,
            {
                sheet: "Estado General"
            }
        );
    XLSX.writeFile(
        libro,
        "Reporte_Inversiones.xlsx"
    );
}
function exportarPDF() {
    const {
        jsPDF
    } = window.jspdf;
    let pdf =
        new jsPDF(
            "landscape",
            "mm",
            "a4"
        );
    pdf.text(
        "Reporte Estado General de Inversiones",
        14,
        15
    );
    pdf.autoTable({
        html: "#tablaEstadoGeneral",
        startY: 25,
        styles: {
            fontSize: 7
        }
    });
    pdf.save(
        "Reporte_Inversiones.pdf"
    );
}
function imprimirTabla() {
    let contenido =
        document.getElementById(
            "tablaEstadoGeneral"
        ).outerHTML;
    let ventana =
        window.open(
            "",
            "",
            "width=1200,height=800"
        );
    ventana.document.write(`
        <html>
        <head>
        <title>
        Reporte de Inversiones
        </title>
        <style>
        table{
            width:100%;
            border-collapse:collapse;
        }
        th,td{
            border:1px solid #ddd;
            padding:6px;
            font-size:12px;
        }
        th{
            background:#f3f4f6;
        }
        </style>
        </head>
        <body>
        <h3>
        Reporte Estado General de Inversiones
        </h3>
        ${contenido}
        </body>
        </html>
    `);
    ventana.document.close();
    ventana.print();
}

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