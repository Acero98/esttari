document.addEventListener('DOMContentLoaded', () => {
    iniciarModalGerencia();
    iniciarModalEditarGerencia();
    iniciarEditarGerencia();
    iniciarRegistroGerencia();
    iniciarActualizarGerencia();
    iniciarCambiarEstado();
    iniciarDataTable();
});
// =====================================
// REGISTRAR GERENCIA
// =====================================
function iniciarRegistroGerencia() {
    const form = document.getElementById("formGerencia");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Registrar gerencia",
            mensaje: `
                ¿Desea registrar esta nueva gerencia?
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
// MODAL NUEVA GERENCIA
// =====================================
function iniciarModalGerencia() {
    const modal = document.getElementById("modalGerencia");
    const btnAbrir = document.getElementById("abrirModalGerencia");
    const btnCerrar = document.getElementById("cerrarModalGerencia");
    const btnCancelar = document.getElementById("cancelarModalGerencia");
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
// EDITAR GERENCIA
// =====================================
function iniciarEditarGerencia() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnEditarGerencia");
        if (!btn) return;
        const id = btn.dataset.id;
        fetch("index.php?url=gerencias_edit&id=" + id)
            .then(res => res.json())
            .then(data => {
                const g = data.gerencia;
                document.getElementById("edit_id").value = g.idGerencias;
                document.getElementById("edit_siglasGerencia").value = g.siglasGerencia;
                document.getElementById("edit_nombreGerencia").value = g.nombreGerencia;
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
// ACTUALIZAR GERENCIA
// =====================================
function iniciarActualizarGerencia() {
    const form = document.getElementById("formEditarGerencia");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "warning",
            titulo: "Actualizar gerencia",
            mensaje: `
                ¿Desea guardar los cambios realizados en esta gerencia?
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
        const btn = e.target.closest(".btnEstadoGerencia");
        if (!btn) return;
        const id = btn.dataset.id;
        const estado = btn.dataset.estado;
        const nombre = btn.dataset.nombre;
        const titulo = estado == 1
            ? "Activar gerencia"
            : "Deshabilitar gerencia";
        const mensaje = estado == 1
            ? `¿Desea activar la gerencia <b>${nombre}</b>?`
            : `¿Desea deshabilitar la gerencia <b>${nombre}</b>?`;
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
                    `index.php?url=gerencias_estado&id=${id}&estado=${estado}`;
            }
        });
    });
}
// =====================================
// MODAL EDITAR GERENCIA
// =====================================
function iniciarModalEditarGerencia() {
    const modal = document.getElementById("modalEditar");
    if (!modal) return;
    document.getElementById("cerrarModalEditarGerencia")
        ?.addEventListener("click", cerrar);
    document.getElementById("cancelarModalEditarGerencia")
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
    const tabla = document.querySelector("#tablaGerencias");
    if (!tabla) return;
    new simpleDatatables.DataTable(tabla, {
        searchable: true,
        sortable: true,
        perPage: 10,
        perPageSelect: [5, 10, 25, 50],
        columns: [
            {
                select: 6,
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