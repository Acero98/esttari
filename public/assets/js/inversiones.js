document.addEventListener("DOMContentLoaded", () => {

    iniciarModalInversion();
    iniciarModalEditarInversion();

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