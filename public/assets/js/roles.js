document.addEventListener('DOMContentLoaded', () => {
    iniciarModalRol();
    iniciarModalEditarRol();
    iniciarModalPermisos();
    iniciarGuardarPermisos();
    iniciarEditarRol();
    iniciarRegistroRol();
    iniciarActualizarRol();
    iniciarCambiarEstado();
    iniciarPermisosRol();
    iniciarDataTable();
});
// =====================================
// DATA TABLES
// =====================================
function iniciarDataTable() {
    const tabla = document.querySelector("#tablaRoles");
    if (!tabla) return;
    new simpleDatatables.DataTable("#tablaRoles", {
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
// MODAL NUEVO ROL
// =====================================
function iniciarModalRol() {
    const modal = document.getElementById("modalRol");
    if (!modal) return;
    document.getElementById("abrirModalRol")
        ?.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        });
    document.getElementById("cerrarModalRol")
        ?.addEventListener("click", () => {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        });
    document.getElementById("cancelarModalRol")
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
// EDITAR ROL
// =====================================
function iniciarEditarRol() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnEditar");
        if (!btn) return;
        const id = btn.dataset.id;
        fetch("index.php?url=roles_edit&id=" + id)
            .then(res => res.json())
            .then(data => {
                const r = data.nombreRol;
                document.getElementById("edit_id").value = r.idRol;
                document.getElementById("edit_nombreRol").innerHTML = `
                    <i class="bi bi-person-badge text-violet-500"></i>
                    <span>${r.nombreRol}</span>`;
                document.getElementById("edit_descripcionRol").value = r.descripcionRol;
                // Mostrar modal Tailwind
                const modal = document.getElementById("modalEditar");
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
    });
}
// =====================================
// MODAL EDITAR ROL
// =====================================
function iniciarModalEditarRol() {
    const modal = document.getElementById("modalEditar");
    if (!modal) return;
    document.getElementById("cerrarModalEditar")
        ?.addEventListener("click", () => {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        });
    document.getElementById("cancelarModalEditar")
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
// MODAL PERMISOS
// =====================================
function iniciarModalPermisos() {
    const modal = document.getElementById("modalPermisos");
    if (!modal) return;
    document.getElementById("cerrarModalPermisos")
        ?.addEventListener("click", cerrar);
    document.getElementById("cancelarModalPermisos")
        ?.addEventListener("click", cerrar);
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            cerrar();
        }
    });
    function cerrar() {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }
}
function iniciarGuardarPermisos() {
    const form = document.getElementById("formPermisos");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Guardar permisos",
            mensaje: `
                ¿Desea guardar los permisos seleccionados para este rol?
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
// REGISTRAR ROL
// =====================================
function iniciarRegistroRol() {
    const form = document.getElementById("formRol");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Registrar rol",
            mensaje: `
                ¿Desea registrar este nuevo rol?
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
// ACTUALIZAR ROL
// =====================================
function iniciarActualizarRol() {
    const form = document.getElementById("formEditarRol");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "warning",
            titulo: "Actualizar rol",
            mensaje: `
                ¿Desea guardar los cambios realizados en este rol?
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
        const btn = e.target.closest(".btnEstado");
        if (!btn) return;
        const id = btn.dataset.id;
        const estado = btn.dataset.estado;
        const nombre = btn.dataset.nombre;
        const titulo = estado == 1
            ? "Activar rol"
            : "Deshabilitar rol";
        const mensaje = estado == 1
            ? `¿Desea activar el rol <b>${nombre}</b>?`
            : `¿Desea deshabilitar el rol <b>${nombre}</b>?`;
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
                    `index.php?url=roles_estado&id=${id}&estado=${estado}`;
            }
        });
    });
}
// =====================================
// PERMISOS DEL ROL
// =====================================
function iniciarPermisosRol() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnPermisos");
        if (!btn) return;
        const id = btn.dataset.id;
        const nombre = btn.dataset.nombre;
        fetch("index.php?url=roles_permisos&id=" + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById("idRolPermiso").value = id;
                document.getElementById("nombreRol").textContent = nombre;
                let html = "";
                let grupoActual = "";
                data.permisos.forEach(p => {
                    if (grupoActual !== p.grupo) {
                        if (grupoActual !== "") {
                            html += `
                                    </div>
                                </div>
                            `;
                        }
                        grupoActual = p.grupo;
                        html += `
                        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                            <div class="bg-slate-100 px-4 py-3 border-b border-slate-200">
                                <h3 class="font-semibold text-slate-700">
                                    ${grupoActual}
                                </h3>
                            </div>
                            <div class="p-4 space-y-3">
                        `;
                    }
                    const checked = data.asignados.includes(p.idPermiso)
                        ? "checked"
                        : "";
                    html += `
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                name="permisos[]"
                                value="${p.idPermiso}"
                                ${checked}
                                class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-slate-700 flex items-center gap-2">
                                <i class="${p.icono} text-blue-600"></i>
                                ${p.permiso}
                            </span>
                        </label>
                    `;
                });
                if (grupoActual !== "") {
                    html += `
                            </div>
                        </div>
                    `;
                }
                document.getElementById("contenedorPermisos").innerHTML = html;
                const modal = document.getElementById("modalPermisos");
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
    });
}