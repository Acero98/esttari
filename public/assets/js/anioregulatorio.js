document.addEventListener('DOMContentLoaded', () => {
    iniciarModalAnioRegulatorio();
    iniciarRegistroAnioRegulatorio();
    iniciarEditarAnioRegulatorio();
    iniciarModalEditarAnioRegulatorio();
    iniciarActualizarAnioRegulatorio();
    iniciarModalEjecucionMensual();
    iniciarDataTable();
});
// =====================================
// REGISTRAR AÑO REGULATORIO
// =====================================
function iniciarRegistroAnioRegulatorio() {
    const form =
        document.getElementById("formAnioRegulatorio");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Registrar año regulatorio",
            mensaje: `
                ¿Desea registrar este año regulatorio?
                <br><br>
                La información será guardada en el sistema.
            `,
            textoAceptar: "Guardar",
            textoCancelar: "Cancelar",
            onAceptar() {
                form.submit();
            }
        });
    });
}
// =====================================
// MODAL NUEVO
// =====================================
function iniciarModalAnioRegulatorio() {
    const modal =
        document.getElementById("modalAnioRegulatorio");
    const btnAbrir =
        document.getElementById("abrirModalAnioRegulatorio");
    const btnCerrar =
        document.getElementById("cerrarModalAnioRegulatorio");
    const btnCancelar =
        document.getElementById("cancelarModalAnioRegulatorio");
    if (!modal || !btnAbrir) return;
    function abrir() {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }
    function cerrar() {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }
    btnAbrir.addEventListener("click", abrir);
    btnCerrar?.addEventListener("click", cerrar);
    btnCancelar?.addEventListener("click", cerrar);
    modal.addEventListener("click", (e) => {
        if (e.target === modal)
            cerrar();
    });
}
// =====================================
// EDITAR AÑO REGULATORIO
// =====================================
function iniciarEditarAnioRegulatorio() {
    document.addEventListener("click", function (e) {
        const btn =
            e.target.closest(".btnEditarAnio");
        if (!btn) return;
        const id =
            btn.dataset.id;
        fetch("index.php?url=anioregulatorio_edit&id=" + id)
            .then(res => res.json())
            .then(data => {
                //console.log(data);
                const a = data.anio;
                document.getElementById("edit_idAnioRegulatorio").value = a.idAnioRegulatorio;
                document.getElementById("edit_idEstudioTarifario").value = a.idEstudioTarifario;
                document.getElementById("edit_anio").value = a.anio;
                document.getElementById("edit_programado").value = a.programado;
                //document.getElementById("edit_ejecutado").value = a.ejecutado ?? 0;
                document.getElementById("edit_rdr").value = a.rdr;
                document.getElementById("edit_et").value = a.et;
                document.getElementById("edit_avanceFisico").value = a.avanceFisico ?? "";
                document.getElementById("edit_observaciones").value = a.observaciones ?? "";
                document.getElementById("edit_idInversiones").value = a.idInversiones;
                document.activeElement?.blur();
                const modal =
                    document.getElementById("modalEditarAnioRegulatorio");
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
    });
}
// =====================================
// ACTUALIZAR AÑO REGULATORIO
// =====================================
function iniciarActualizarAnioRegulatorio() {
    const form =
        document.getElementById(
            "formEditarAnioRegulatorio"
        );
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "warning",
            titulo: "Actualizar año regulatorio",
            mensaje: `
                ¿Desea guardar los cambios realizados?
                <br><br>
                La información será actualizada.
            `,
            textoAceptar: "Actualizar",
            textoCancelar: "Cancelar",
            onAceptar() {
                form.submit();
            }
        });
    });
}
// =====================================
// CERRAR MODAL EDITAR
// =====================================
function iniciarModalEditarAnioRegulatorio() {
    const modal =
        document.getElementById(
            "modalEditarAnioRegulatorio"
        );
    if (!modal) return;
    function cerrar() {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }
    document.getElementById(
        "cerrarModalEditarAnioRegulatorio"
    )
        ?.addEventListener(
            "click",
            cerrar
        );
    document.getElementById(
        "cancelarModalEditarAnioRegulatorio"
    )
        ?.addEventListener(
            "click",
            cerrar
        );
    modal.addEventListener(
        "click",
        function (e) {
            if (e.target === modal)
                cerrar();
        }
    );
}
// =====================================
// DATA TABLE
// =====================================
function iniciarDataTable() {
    const tabla =
        document.querySelector(
            "#tablaAnioRegulatorio"
        );
    if (!tabla) return;
    new simpleDatatables.DataTable(
        tabla,
        {
            searchable: true,
            sortable: true,
            perPage: 10,
            perPageSelect: [
                5,
                10,
                25,
                50
            ],
            columns: [
                {
                    select: 7,
                    sortable: false
                }
            ],
            labels: {
                placeholder: "Buscar...",
                perPage: "Mostrar",
                noRows: "No hay registros",
                noResults: "No se encontraron resultados",
                info:
                    "Mostrando {start} a {end} de {rows} registros"
            }
        }
    );
}

document.addEventListener("click", function (e) {
    const btn = e.target.closest(".btnEjecucion");
    if (!btn) return;
    const id = btn.dataset.id;
    const anio = btn.dataset.anio;
    const inversion = btn.dataset.inversion;
    document.getElementById(
        "idAnioRegulatorio"
    ).value = id;
    document.getElementById(
        "idInversiones"
    ).value = inversion;
    document.getElementById(
        "idEjecucionMensual"
    ).value = "";
    document.getElementById(
        "tituloModalEjecucion"
    ).innerHTML =
        "Ejecución Mensual";
    document.getElementById(
        "tituloAnio"
    ).innerHTML = anio;
    document.getElementById(
        "textoGuardar"
    ).innerHTML =
        "Guardar";
    cargarEjecuciones(id);
    abrirModalEjecucion();
});
// =====================================
// MODAL EJECUCIÓN MENSUAL
// =====================================
function abrirModalEjecucion() {
    const modal = document.getElementById(
        "modalEjecucionMensual"
    );
    if (!modal) return;
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}
function cerrarModalEjecucion() {
    const modal = document.getElementById(
        "modalEjecucionMensual"
    );
    if (!modal) return;
    limpiarFormularioEjecucion();
    modal.classList.remove("flex");
    modal.classList.add("hidden");
}
// =====================================
// MODAL EJECUCIÓN MENSUAL
// =====================================
function iniciarModalEjecucionMensual() {
    const modal =
        document.getElementById(
            "modalEjecucionMensual"
        );
    if (!modal) return;
    function cerrarModalEjecucion() {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }
    document.getElementById(
        "cerrarModalEjecucionMensual"
    )
        ?.addEventListener(
            "click",
            cerrarModalEjecucion
        );
    document.getElementById(
        "cancelarModalEjecucionMensual"
    )
        ?.addEventListener(
            "click",
            cerrarModalEjecucion
        );
    modal.addEventListener(
        "click",
        function (e) {
            if (e.target === modal) {
                cerrarModalEjecucion();
            }
        }
    );
}
function cargarEjecuciones(id) {
    fetch(
        "index.php?url=ejecucionmensual_lista&idAnioRegulatorio="
        + id
    )
        .then(res => res.json())
        .then(data => {
            let tbody =
                document.getElementById(
                    "listaEjecucionesMensuales"
                );
            tbody.innerHTML = "";
            if (data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="3"
                        class="px-4 py-6 text-center text-sm text-slate-500">
                        <i class="bi bi-calendar-x text-lg"></i>
                        <br>
                        No existen registros mensuales
                    </td>
                </tr>
            `;
                return;
            }
            data.forEach((e, index) => {

                tbody.innerHTML += `
                    <tr class="border-b hover:bg-slate-50 transition">

                        <!-- N° -->
                        <td class="px-4 py-3 text-center text-slate-500">
                            ${index + 1}
                        </td>

                        <!-- MES -->
                        <td class="px-4 py-3 font-medium text-slate-700">
                            ${nombreMes(e.mes)}
                        </td>

                        <!-- EJECUTADO -->
                        <td class="px-4 py-2">
                            <span
                                class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                S/ ${parseFloat(e.ejecutado).toFixed(2)}
                            </span>
                        </td>

                        <!-- ACCIÓN -->
                        <td class="px-4 py-2">
                            <button
                                type="button"
                                class="btnEditarEjecucion
                                inline-flex
                                p-2
                                rounded-lg
                                bg-amber-100
                                text-amber-600
                                hover:bg-amber-200
                                text-center
                                transition"
                                data-id="${e.idEjecucionMensual}"
                                title="Editar ejecución">

                                <i class="bi bi-pencil"></i>

                            </button>
                        </td>

                    </tr>
                `;

            });
        });
}
// =====================================
// EDITAR EJECUCIÓN
// =====================================
document.addEventListener(
    "click",
    function (e) {
        const btn =
            e.target.closest(
                ".btnEditarEjecucion"
            );
        if (!btn) return;
        e.preventDefault();
        editarEjecucion(
            btn.dataset.id
        );
    }
);
function nombreMes(numero) {
    const meses = [
        "",
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Setiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ];
    return meses[numero];
}
function editarEjecucion(id) {
    fetch(
        "index.php?url=ejecucionmensual_show&id="
        + id
    )
        .then(res => res.json())
        .then(data => {
            //console.log(data);
            document.getElementById(
                "idEjecucionMensual"
            ).value =
                data.idEjecucionMensual;
            document.getElementById(
                "mes"
            ).value =
                data.mes;
            document.getElementById(
                "ejecutado"
            ).value =
                data.ejecutado;
            document.getElementById(
                "tituloModalEjecucion"
            ).innerHTML =
                "Editar Ejecución";
            document.getElementById(
                "textoGuardar"
            ).innerHTML =
                "Actualizar";
            abrirModalEjecucion();
        });
}
function limpiarFormularioEjecucion() {
    document.getElementById(
        "idEjecucionMensual"
    ).value = "";
    document.getElementById(
        "mes"
    ).value = "";
    document.getElementById(
        "ejecutado"
    ).value = 0;
    document.getElementById(
        "tituloModalEjecucion"
    ).innerHTML =
        "Ejecución Mensual";
    document.getElementById(
        "textoGuardar"
    ).innerHTML =
        "Guardar";
}

// =====================================
// SEGUIMIENTO
// =====================================

// =====================================
// ABRIR MODAL SEGUIMIENTO
// =====================================
document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnSeguimiento");

    if (!btn) return;

    const id = btn.dataset.id;
    const anio = btn.dataset.anio;
    const inversion = btn.dataset.inversion;

    document.getElementById("idAnioRegulatorioSeguimiento").value = id;
    document.getElementById("idInversionesSeguimiento").value = inversion;
    document.getElementById("idSeguimientoMensual").value = "";

    document.getElementById("tituloAnioSeguimiento").innerHTML = anio;
    document.getElementById("tituloModalSeguimiento").innerHTML = "Seguimiento";
    document.getElementById("textoGuardarSeguimiento").innerHTML = "Guardar";

    limpiarFormularioSeguimiento();
    cargarSeguimientos(id);
    abrirModalSeguimiento();

});

function abrirModalSeguimiento() {

    const modal = document.getElementById("modalSeguimientoMensual");

    if (!modal) return;

    modal.classList.remove("hidden");
    modal.classList.add("flex");

}

function cerrarModalSeguimiento() {

    const modal = document.getElementById("modalSeguimientoMensual");

    if (!modal) return;

    limpiarFormularioSeguimiento();

    modal.classList.remove("flex");
    modal.classList.add("hidden");

}

function iniciarModalSeguimientoMensual() {

    const modal = document.getElementById("modalSeguimientoMensual");

    if (!modal) return;

    document.getElementById("cerrarModalSeguimiento")
        ?.addEventListener("click", cerrarModalSeguimiento);

    document.getElementById("cancelarModalSeguimiento")
        ?.addEventListener("click", cerrarModalSeguimiento);

    modal.addEventListener("click", function (e) {

        if (e.target === modal) {
            cerrarModalSeguimiento();
        }

    });

}

function cargarSeguimientos(id) {

    fetch("index.php?url=seguimientomensual_lista&idAnioRegulatorio=" + id)

        .then(res => res.json())

        .then(data => {
            //console.log(data);

            const tbody = document.getElementById("listaSeguimientosMensuales");

            tbody.innerHTML = "";

            if (data.length === 0) {

                tbody.innerHTML = `
                    <tr>
                        <td colspan="6"
                            class="px-4 py-6 text-center text-slate-500">

                            No existen seguimientos registrados

                        </td>
                    </tr>
                `;

                return;

            }

            data.forEach((s, index) => {

                tbody.innerHTML += `
                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-4 py-3 text-center">
                            ${index + 1}
                        </td>

                        <td class="px-4 py-3">
                            ${s.producto}
                        </td>

                        <td class="px-4 py-3">
                            ${s.estadoInver}
                        </td>

                        <td class="px-4 py-3">
                            ${s.acciones}
                        </td>

                        <td class="px-4 py-3">
                            ${s.fechas}
                        </td>

                        <td class="px-4 py-3">
                            ${s.situacion}
                        </td>

                        <td class="px-4 py-3">

                            <div class="flex items-center justify-center gap-2">

                                <!-- EDITAR -->
                                <button
                                    type="button"
                                    class="btnEditarSeguimiento inline-flex p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200"
                                    data-id="${s.idSeguimientoMensual}">

                                    <i class="bi bi-pencil"></i>

                                </button>


                                <!-- ELIMINAR -->
                                <button
                                    type="button"
                                    class="btnEliminarSeguimiento inline-flex p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200"
                                    data-id="${s.idSeguimientoMensual}">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </td>

                    </tr>
                `;

            });

        });

}

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnEliminarSeguimiento");

    if (!btn) return;

    eliminarSeguimiento(btn.dataset.id);

});

function eliminarSeguimiento(id) {

    if (!confirm("¿Está seguro de eliminar este seguimiento?")) {
        return;
    }


    fetch(
        "index.php?url=seguimientomensual_delete&id=" + id,
        {
            method: "GET"
        }
    )

    .then(res => res.json())

    .then(data => {

        if (data.success) {

            alert("Seguimiento eliminado correctamente");

            cargarSeguimientos(
                document.getElementById(
                    "idAnioRegulatorioSeguimiento"
                ).value
            );

        } else {

            alert("No se pudo eliminar");

        }

    });

}

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnEditarSeguimiento");

    if (!btn) return;

    editarSeguimiento(btn.dataset.id);

});

function editarSeguimiento(id) {

    fetch("index.php?url=seguimientomensual_show&id=" + id)

        .then(res => res.json())

        .then(data => {

            document.getElementById("idSeguimientoMensual").value =
                data.idSeguimientoMensual;

            document.getElementById("producto").value =
                data.producto;

            document.getElementById("estadoInver").value =
                data.estadoInver;

            document.getElementById("fechas").value =
                data.fechas;

            document.getElementById("situacion").value =
                data.situacion;

            document.getElementById("acciones").value =
                data.acciones;

            document.getElementById("tituloModalSeguimiento").innerHTML =
                "Editar Seguimiento";

            document.getElementById("textoGuardarSeguimiento").innerHTML =
                "Actualizar";

            abrirModalSeguimiento();

        });

}

function limpiarFormularioSeguimiento() {

    document.getElementById("idSeguimientoMensual").value = "";

    document.getElementById("producto").value = "";

    document.getElementById("estadoInver").value = "";

    document.getElementById("fechas").value = "";

    document.getElementById("situacion").value = "";

    document.getElementById("acciones").value = "";

    document.getElementById("tituloModalSeguimiento").innerHTML =
        "Seguimiento";

    document.getElementById("textoGuardarSeguimiento").innerHTML =
        "Guardar";

}

// INICIAR EVENTOS DEL MODAL
document.addEventListener("DOMContentLoaded", () => {

    iniciarModalSeguimientoMensual();

});