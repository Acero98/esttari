document.addEventListener('DOMContentLoaded', () => {

    iniciarModalPermiso();
    iniciarModalEditarPermiso();

    iniciarEditarPermiso();
    iniciarRegistroPermiso();
    iniciarActualizarPermiso();
    iniciarCambiarEstado();
    iniciarDataTable();

});

// =====================================
// REGISTRAR PERMISO
// =====================================
function iniciarRegistroPermiso() {

    const form = document.getElementById("formPermiso");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        Dialog.confirm({

            tipo: "info",

            titulo: "Registrar permiso",

            mensaje: `
                ¿Desea registrar este nuevo permiso?
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

function iniciarModalPermiso() {

    const modal = document.getElementById("modalPermiso");
    const btnAbrir = document.getElementById("abrirModalPermiso");
    const btnCerrar = document.getElementById("cerrarModalPermiso");
    const btnCancelar = document.getElementById("cancelarModalPermiso");

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
        if (e.target === modal) cerrar();
    });
}

// =====================================
// EDITAR PERMISO
// =====================================
function iniciarEditarPermiso() {

    document.addEventListener("click", function (e) {

        const btn = e.target.closest(".btnEditar");

        if (!btn) return;

        const id = btn.dataset.id;

        fetch("index.php?url=permisos_edit&id=" + id)

            .then(res => res.json())

            .then(data => {

                const p = data.permiso;

                document.getElementById("edit_id").value = p.idPermiso;
                document.getElementById("edit_permiso").value = p.permiso;
                document.getElementById("edit_grupo").value = p.grupo;
                document.getElementById("edit_ruta").value = p.ruta;
                document.getElementById("edit_icono").value = p.icono;
                document.getElementById("edit_orden").value = p.orden;

                // cerrar foco activo (evita bugs visuales)
                if (document.activeElement) {
                    document.activeElement.blur();
                }

                // abrir modal Tailwind
                const modal = document.getElementById("modalEditar");

                modal.classList.remove("hidden");
                modal.classList.add("flex");

            });

    });

}

// =====================================
// ACTUALIZAR PERMISO
// =====================================
function iniciarActualizarPermiso() {

    const form = document.getElementById("formEditarPermiso");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        Dialog.confirm({

            tipo: "warning",

            titulo: "Actualizar permiso",

            mensaje: `
                ¿Desea guardar los cambios realizados en este permiso?
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
// CAMBIAR ESTADO PERMISO
// =====================================
function iniciarCambiarEstado() {

    document.addEventListener("click", function (e) {

        const btn = e.target.closest(".btnEstado");

        if (!btn) return;

        const id = btn.dataset.id;
        const estado = btn.dataset.estado;
        const nombre = btn.dataset.nombre;

        const titulo = estado == 1
            ? "Activar permiso"
            : "Deshabilitar permiso";

        const mensaje = estado == 1
            ? `¿Desea activar el permiso <b>${nombre}</b>?`
            : `¿Desea deshabilitar el permiso <b>${nombre}</b>?`;

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
                    `index.php?url=permisos_estado&id=${id}&estado=${estado}`;

            }

        });

    });

}

function iniciarModalEditarPermiso() {

    const modal = document.getElementById("modalEditar");

    if (!modal) return;

    document.getElementById("cerrarModalEditarPermiso")
        ?.addEventListener("click", cerrar);

    document.getElementById("cancelarModalEditarPermiso")
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
// DATA TABLES
// =====================================
function iniciarDataTable() {

    const tabla = document.querySelector('#tablaPermisos');

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