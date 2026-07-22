document.addEventListener("DOMContentLoaded", () => {
    iniciarModalArea();
    iniciarModalEditarArea();
    iniciarEditarArea();
    iniciarRegistroArea();
    iniciarActualizarArea();
    iniciarCambiarEstado();
    iniciarDataTable();
});
// =====================================
// REGISTRAR ÁREA
// =====================================
function iniciarRegistroArea() {
    const form = document.getElementById("formArea");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Registrar área",
            mensaje: `
                ¿Desea registrar esta nueva área?
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
// MODAL NUEVA ÁREA
// =====================================
function iniciarModalArea() {
    const modal = document.getElementById("modalArea");
    const btnAbrir = document.getElementById("abrirModalArea");
    const btnCerrar = document.getElementById("cerrarModalArea");
    const btnCancelar = document.getElementById("cancelarModalArea");
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
// EDITAR ÁREA
// =====================================
function iniciarEditarArea() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnEditarArea");
        if (!btn) return;
        const id = btn.dataset.id;
        fetch("index.php?url=areas_edit&id=" + id)
            .then(res => res.json())
            .then(data => {
                const area = data.area;
                document.getElementById("edit_id").value = area.idAreas;
                document.getElementById("edit_idGerencias").value = area.idGerencias;
                document.getElementById("edit_siglasArea").value = area.siglasArea;
                document.getElementById("edit_nombreArea").value = area.nombreArea;
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
// ACTUALIZAR ÁREA
// =====================================
function iniciarActualizarArea() {
    const form = document.getElementById("formEditarArea");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "warning",
            titulo: "Actualizar área",
            mensaje: `
                ¿Desea guardar los cambios realizados en esta área?
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
        const btn = e.target.closest(".btnEstadoArea");
        if (!btn) return;
        const id = btn.dataset.id;
        const estado = btn.dataset.estado;
        const nombre = btn.dataset.nombre;
        const titulo = estado == 1
            ? "Activar área"
            : "Deshabilitar área";
        const mensaje = estado == 1
            ? `¿Desea activar el área <b>${nombre}</b>?`
            : `¿Desea deshabilitar el área <b>${nombre}</b>?`;
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
                    `index.php?url=areas_estado&id=${id}&estado=${estado}`;
            }
        });
    });
}
// =====================================
// MODAL EDITAR
// =====================================
function iniciarModalEditarArea() {
    const modal = document.getElementById("modalEditar");
    if (!modal) return;
    document.getElementById("cerrarModalEditar")
        ?.addEventListener("click", cerrar);
    document.getElementById("cancelarModalEditar")
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
    const tabla = document.querySelector("#tablaAreas");
    if (!tabla) return;
    new simpleDatatables.DataTable(tabla, {
        searchable: true,
        sortable: true,
        perPage: 10,
        perPageSelect: [5, 10, 25, 50],
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
            info: "Mostrando {start} a {end} de {rows} registros"
        }
    });
}