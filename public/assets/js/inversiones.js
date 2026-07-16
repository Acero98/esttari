document.addEventListener("DOMContentLoaded", () => {

    iniciarModalInversion();
    iniciarModalEditarInversion();
    iniciarModalDocumentos();
    iniciarRegistroDocumento();

    iniciarEditarInversion();
    iniciarRegistroInversion();
    iniciarActualizarInversion();
    iniciarCambiarEstado();
    iniciarDataTable();

});

// =====================================
// REGISTRAR INVERSIÓN
// =====================================
function iniciarRegistroInversion() {

    const form = document.getElementById("formInversion");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        Dialog.confirm({

            tipo: "info",

            titulo: "Registrar inversión",

            mensaje: `
                ¿Desea registrar esta nueva inversión?
                <br><br>
                Se guardará la información en el sistema.
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
// MODAL NUEVA INVERSIÓN
// =====================================
function iniciarModalInversion() {

    const modal = document.getElementById("modalInversion");
    const btnAbrir = document.getElementById("abrirModalInversion");
    const btnCerrar = document.getElementById("cerrarModalInversion");
    const btnCancelar = document.getElementById("cancelarModalInversion");

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

    modal.addEventListener("click", function (e) {
        if (e.target === modal) cerrar();
    });

}

// =====================================
// EDITAR INVERSIÓN
// =====================================
function iniciarEditarInversion() {

    document.addEventListener("click", function (e) {

        const btn = e.target.closest(".btnEditarInversion");

        if (!btn) return;

        const id = btn.dataset.id;

        fetch("index.php?url=inversiones_edit&id=" + id)

            .then(res => res.json())

            .then(data => {

                const i = data.inversion;

                document.getElementById("edit_id").value = i.idInversiones;
                document.getElementById("edit_idFondos").value = i.idFondos;
                document.getElementById("edit_idAreas").value = i.idAreas;
                document.getElementById("edit_cui").value = i.cui ?? "";
                document.getElementById("edit_descripcion").value = i.descripcion;
                document.getElementById("edit_nombre").value = i.nombre;
                document.getElementById("edit_observaciones").value = i.observaciones ?? "";

                if (document.activeElement) {
                    document.activeElement.blur();
                }

                const modal = document.getElementById("modalEditar");

                modal.classList.remove("hidden");
                modal.classList.add("flex");

            });

    });

}

// =====================================
// ACTUALIZAR INVERSIÓN
// =====================================
function iniciarActualizarInversion() {

    const form = document.getElementById("formEditarInversion");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        Dialog.confirm({

            tipo: "warning",

            titulo: "Actualizar inversión",

            mensaje: `
                ¿Desea guardar los cambios realizados en esta inversión?
                <br><br>
                La información será actualizada en el sistema.
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
// CAMBIAR ESTADO
// =====================================
function iniciarCambiarEstado() {

    document.addEventListener("click", function (e) {

        const btn = e.target.closest(".btnEstadoInversion");

        if (!btn) return;

        const id = btn.dataset.id;
        const estado = btn.dataset.estado;
        const nombre = btn.dataset.nombre;

        const titulo = estado == 1
            ? "Activar inversión"
            : "Deshabilitar inversión";

        const mensaje = estado == 1
            ? `¿Desea activar la inversión <b>${nombre}</b>?`
            : `¿Desea deshabilitar la inversión <b>${nombre}</b>?`;

        const textoAceptar = estado == 1
            ? "Activar"
            : "Deshabilitar";

        Dialog.confirm({

            tipo: estado == 1 ? "success" : "danger",

            titulo,
            mensaje,

            textoAceptar,
            textoCancelar: "Cancelar",

            onAceptar() {

                window.location =
                    `index.php?url=inversiones_estado&id=${id}&estado=${estado}`;

            }

        });

    });

}

// =====================================
// MODAL EDITAR
// =====================================
function iniciarModalEditarInversion() {

    const modal = document.getElementById("modalEditar");

    if (!modal) return;

    document.getElementById("cerrarModalEditarInversion")
        ?.addEventListener("click", cerrar);

    document.getElementById("cancelarModalEditarInversion")
        ?.addEventListener("click", cerrar);

    modal.addEventListener("click", function (e) {
        if (e.target === modal) cerrar();
    });

    function cerrar() {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }

}

// =====================================
// DATA TABLE
// =====================================
function iniciarDataTable() {

    const tabla = document.querySelector("#tablaInversiones");

    if (!tabla) return;

    new simpleDatatables.DataTable(tabla, {

        searchable: true,
        sortable: true,

        perPage: 10,
        perPageSelect: [5, 10, 25, 50],

        columns: [
            {
                select: 8,
                sortable: false
            }
        ],

        labels: {
            placeholder: "Buscar...",
            perPage: "Mostrar",
            noRows: "No hay registros",
            noResults: "No se encontraron resultados",
            info: "Mostrando {start} a {end} de {rows} registros"
        }

    });

}

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnDocumentos");

    if (!btn) return;

    document.getElementById("idInversionDocumento").value = btn.dataset.id;

    document.getElementById("tituloDocumento").innerHTML = btn.dataset.nombre;

    cargarDocumentos(btn.dataset.id);
    abrirModalDocumentos();

});

function abrirModalDocumentos() {

    const modal = document.getElementById("modalDocumentos");

    if (!modal) return;

    modal.classList.remove("hidden");

    modal.classList.add("flex");

}

function cerrarModalDocumentos() {

    const modal = document.getElementById("modalDocumentos");

    if (!modal) return;

    modal.classList.remove("flex");

    modal.classList.add("hidden");

}

function iniciarModalDocumentos() {

    const modal = document.getElementById("modalDocumentos");

    if (!modal) return;

    document
        .getElementById("cerrarModalDocumentos")
        ?.addEventListener("click", cerrarModalDocumentos);

    document
        .getElementById("cancelarModalDocumentos")
        ?.addEventListener("click", cerrarModalDocumentos);

    modal.addEventListener("click", function (e) {

        if (e.target === modal) {

            cerrarModalDocumentos();

        }

    });

}

function cargarDocumentos(id) {

    fetch(
        "index.php?url=documento_lista&idInversiones=" + id
    )

        .then(res => res.json())

        .then(data => {

            let tbody =
                document.getElementById("listaDocumentos");

            tbody.innerHTML = "";

            if (data.length === 0) {

                tbody.innerHTML = `
                <tr>

                    <td colspan="5"
                        class="px-4 py-6 text-center text-slate-500">

                        No existen documentos registrados

                    </td>

                </tr>
            `;

                return;

            }

            data.forEach((d, index) => {

                tbody.innerHTML += `

            <tr class="border-b hover:bg-slate-50">

                <td class="px-4 py-2 text-center">

                    ${index + 1}

                </td>

                <td class="px-4 py-2">

                    ${d.tipoDocumento}

                </td>

                <td class="px-4 py-2">

                    ${d.nombreOriginal}

                </td>

                <td class="px-4 py-2">

                    ${d.fechaRegistro}

                </td>

                <td class="px-4 py-2">
                    <div class="flex justify-center gap-2">

                        <!-- Ver -->
                        <button
                            type="button"
                            class="btnVerDocumento inline-flex p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                            data-ruta="${d.ruta}"
                            title="Ver PDF">

                            <i class="bi bi-eye"></i>

                        </button>

                        <!-- Descargar -->
                        <button
                            type="button"
                            class="btnDescargarDocumento inline-flex p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition"
                            data-id="${d.idDocumento}"
                            data-nombre="${d.nombreOriginal}"
                            title="Descargar">

                            <i class="bi bi-download"></i>

                        </button>

                        <!-- Eliminar -->
                        <button
                            type="button"
                            class="btnEliminarDocumento inline-flex p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                            data-id="${d.idDocumento}"
                            data-nombre="${d.nombreOriginal}"
                            title="Eliminar">

                            <i class="bi bi-trash"></i>

                        </button>

                    </div>
                </td>

            </tr>

            `;

            });

        });

}

const form = document.getElementById("formDocumento");

function iniciarRegistroDocumento() {

    const form = document.getElementById("formDocumento");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        Dialog.confirm({

            tipo: "info",

            titulo: "Subir documento",

            mensaje: `
                ¿Desea subir este documento PDF?
                <br><br>
                El archivo será almacenado en el sistema.
            `,

            textoAceptar: "Subir",
            textoCancelar: "Cancelar",

            onAceptar() {

                const datos = new FormData(form);

                fetch("index.php?url=documento_store", {

                    method: "POST",

                    body: datos

                })

                    .then(res => res.json())

                    .then(res => {

                        if (res.success) {

                            cargarDocumentos(
                                document.getElementById("idInversionDocumento").value
                            );

                            form.reset();

                            Dialog.alert({

                                tipo: "success",

                                titulo: "Documento registrado",

                                mensaje: res.mensaje

                            });

                        } else {

                            Dialog.alert({

                                tipo: "danger",

                                titulo: "Error",

                                mensaje: res.mensaje

                            });

                        }

                    });

            }

        });

    });

}

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnVerDocumento");

    if (!btn) return;

    window.open(btn.dataset.ruta, "_blank");

});

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnDescargarDocumento");

    if (!btn) return;

    window.location =
        "index.php?url=documento_download&id=" +
        btn.dataset.id;

});

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".btnEliminarDocumento");

    if (!btn) return;

    Dialog.confirm({

        tipo: "danger",

        titulo: "Eliminar documento",

        mensaje: `
            ¿Desea eliminar el documento
            <b>${btn.dataset.nombre}</b>?
            <br><br>
            Esta acción eliminará el archivo del sistema.
        `,

        textoAceptar: "Eliminar",
        textoCancelar: "Cancelar",

        onAceptar() {

            fetch("index.php?url=documento_delete", {

                method: "POST",

                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },

                body: "id=" + btn.dataset.id

            })

                .then(res => res.json())

                .then(res => {

                    if (res.success) {

                        cargarDocumentos(
                            document.getElementById("idInversionDocumento").value
                        );

                        Dialog.alert({

                            tipo: "success",

                            titulo: "Documento eliminado",

                            mensaje: res.mensaje

                        });

                    } else {

                        Dialog.alert({

                            tipo: "danger",

                            titulo: "Error",

                            mensaje: res.mensaje

                        });

                    }

                });

        }

    });

});