document.addEventListener('DOMContentLoaded', () => {
    iniciarDataTable();
    iniciarModalEstudio();
    iniciarModalEditarEstudio();
    iniciarRegistroEstudio();
    iniciarEditarEstudio();
    iniciarActualizarEstudio();
    iniciarCambiarEstado();
});
// =====================================
// DATA TABLE
// =====================================
function iniciarDataTable() {
    const tabla = document.querySelector("#tablaEstudios");
    if (!tabla) return;
    new simpleDatatables.DataTable("#tablaEstudios", {
        searchable: true,
        sortable: true,
        perPage: 10,
        perPageSelect: [5, 10, 25, 50],
        columns: [
            {
                select: 5,
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
// =====================================
// MODAL NUEVO
// =====================================
function iniciarModalEstudio() {
    const modal = document.getElementById("modalEstudio");
    if (!modal) return;
    document.getElementById("abrirModalEstudio")
        ?.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        });
    document.getElementById("cerrarModalEstudio")
        ?.addEventListener("click", cerrar);
    document.getElementById("cancelarModalEstudio")
        ?.addEventListener("click", cerrar);
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            cerrar();
        }
    });
    function cerrar() {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }
}
// =====================================
// MODAL EDITAR
// =====================================
function iniciarModalEditarEstudio() {
    const modal = document.getElementById("modalEditarEstudio");
    if (!modal) return;
    document.getElementById("cerrarModalEditarEstudio")
        ?.addEventListener("click", () => {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        });
    document.getElementById("cancelarModalEditarEstudio")
        ?.addEventListener("click", () => {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        });
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        }
    });
}
// =====================================
// REGISTRAR
// =====================================
function iniciarRegistroEstudio() {
    const form = document.getElementById("formEstudio");
    if (!form) return;
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Registrar estudio tarifario",
            mensaje: `
            ¿Desea registrar este nuevo estudio tarifario?
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
// EDITAR
// =====================================
function iniciarEditarEstudio() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnEditarEstudio");
        if (!btn) return;
        const id = btn.dataset.id;
        fetch("index.php?url=estudioTarifario_edit&id=" + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById("edit_idEstudio").value =
                    data.idEstudioTarifario;
                document.getElementById("edit_codigo").value =
                    data.codigo;
                document.getElementById("edit_nombre").value =
                    data.nombre;
                document.getElementById("edit_anioInicio").value =
                    data.anioInicio;
                document.getElementById("edit_anioFin").value =
                    data.anioFin;
                const modal =
                    document.getElementById("modalEditarEstudio");
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
    });
}
// =====================================
// ACTUALIZAR
// =====================================
function iniciarActualizarEstudio() {
    const form = document.getElementById("formEditarEstudio");
    if (!form) return;
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        Dialog.confirm({
            tipo: "warning",
            titulo: "Actualizar estudio tarifario",
            mensaje: `
            ¿Desea guardar los cambios realizados?
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
    document.addEventListener("click", (e) => {
        const btn = e.target.closest(".btnEstadoEstudio");
        if (!btn) return;
        const id = btn.dataset.id;
        const estado = btn.dataset.estado;
        const nombre = btn.dataset.nombre;
        const activar = estado === "ACTIVO";
        Dialog.confirm({
            tipo: activar ? "success" : "danger",
            titulo: activar
                ? "Activar estudio"
                : "Deshabilitar estudio",
            mensaje:
                activar
                    ?
                    `¿Desea activar <b>${nombre}</b>?`
                    :
                    `¿Desea deshabilitar <b>${nombre}</b>?`,
            textoAceptar: activar
                ? "Activar"
                : "Deshabilitar",
            textoCancelar: "Cancelar",
            onAceptar() {
                window.location =
                    `index.php?url=estudioTarifario_estado&id=${id}&estado=${estado}`;
            }
        });
    });
}