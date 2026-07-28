document.addEventListener('DOMContentLoaded', () => {
    iniciarModalUsuario();
    iniciarModalEditar();
    iniciarEditarUsuario();
    iniciarRegistroUsuario();
    iniciarActualizarUsuario();
    iniciarCambiarEstado();
    iniciarDataTable();
});
// =====================================
// MODAL NUEVO USUARIO
// =====================================
function iniciarModalUsuario() {
    const modal = document.getElementById("modalUsuario");
    if (!modal) return;
    const abrir = document.getElementById("abrirModalUsuario");
    const cerrar = document.getElementById("cerrarModalUsuario");
    const cancelar = document.getElementById("cancelarModalUsuario");
    abrir?.addEventListener("click", () => {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    });
    cerrar?.addEventListener("click", () => {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    });
    cancelar?.addEventListener("click", () => {
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
// EDITAR USUARIO
// =====================================
function iniciarEditarUsuario() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnEditar");
        if (!btn) return;
        const id = btn.dataset.id;
        fetch("index.php?url=usuarios_edit&id=" + id)
            .then(res => res.json())
            .then(data => {
                const u = data.usuario;
                const roles = data.roles;
                document.getElementById("edit_id").value = u.idUser;
                document.getElementById("edit_usuario").innerHTML =
                    `<i class="bi bi-person-circle text-blue-500"></i>
                    <span>${u.usuario}</span>`;
                document.getElementById("edit_dni").value = u.dni;
                document.getElementById("edit_correo").value = u.correo;
                document.getElementById("edit_nombres").value = u.nombres;
                document.getElementById("edit_apellidos").value = u.apellidos;
                const select = document.getElementById("edit_rol");
                select.innerHTML = "";
                roles.forEach(r => {
                    const option = document.createElement("option");
                    option.value = r.idRol;
                    option.textContent = r.nombreRol;
                    if (r.idRol == u.idRol) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });
                document.getElementById("modalEditar").classList.remove("hidden");
                document.getElementById("modalEditar").classList.add("flex");
            });
    });
}
// =====================================
// MODAL EDITAR USUARIO
// =====================================
function iniciarModalEditar() {
    const modal = document.getElementById("modalEditar");
    if (!modal) return;
    document.getElementById("cerrarModalEditar")?.addEventListener("click", () => {
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    });
    document.getElementById("cancelarModalEditar")?.addEventListener("click", () => {
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
// REGISTRAR USUARIO
// =====================================
function iniciarRegistroUsuario() {
    const form = document.getElementById('formUsuario');
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        Dialog.confirm({
            tipo: "info",
            titulo: "Registrar usuario",
            mensaje: "¿Desea registrar este usuario?",
            textoAceptar: "Guardar",
            textoCancelar: "Cancelar",
            onAceptar() {
                form.submit();
            }
        });
    });
}
// =====================================
// ACTUALIZAR USUARIO
// =====================================
function iniciarActualizarUsuario() {
    const form = document.getElementById('formEditarUsuario');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Actualizar usuario",
            mensaje: "¿Desea guardar los cambios realizados?",
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
            ? "Activar usuario"
            : "Deshabilitar usuario";
        const mensaje = estado == 1
            ? `¿Desea activar al usuario <b>${nombre}</b>?`
            : `¿Desea deshabilitar al usuario <b>${nombre}</b>?`;
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
                    `index.php?url=usuarios_estado&id=${id}&estado=${estado}`;
            }
        });
    });
}
// =====================================
// DATA TABLES
// =====================================
function iniciarDataTable() {
    const tabla = document.querySelector("#tablaUsuarios");
    if (!tabla) return;
    new simpleDatatables.DataTable("#tablaUsuarios", {
        searchable: true,
        sortable: true,
        perPage: 10,
        perPageSelect: [5, 10, 25, 50],
        labels: {
            placeholder: "Buscar...",
            perPage: "Mostrar",
            noRows: "No hay registros",
            noResults: "No se encontraron resultados",
            info: "Mostrando {start} a {end} de {rows} registros"
        }
    });
}
//USUARIOS_AREAS
document.addEventListener('DOMContentLoaded', () => {
    iniciarModalUsuarioArea();
    iniciarEditarUsuarioArea();
    iniciarGuardarUsuarioArea();
});
// =====================================
// MODAL USUARIO AREA
// =====================================
function iniciarModalUsuarioArea() {
    const modal = document.getElementById("modalUsuarioArea");
    if (!modal) return;
    document.getElementById("cerrarModalUsuarioArea")
        ?.addEventListener("click", cerrarModalUsuarioArea);
    document.getElementById("cancelarModalUsuarioArea")
        ?.addEventListener("click", cerrarModalUsuarioArea);
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            cerrarModalUsuarioArea();
        }
    });
}
// =====================================
// ABRIR MODAL Y CARGAR AREAS
// =====================================
function iniciarEditarUsuarioArea() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btnAreas");
        if (!btn) return;
        //console.log("Botón áreas presionado");
        const idUser = btn.dataset.id;
        document.getElementById("idUsuarioArea").value = idUser;
        cargarAreasUsuario(idUser);
        const modal = document.getElementById("modalUsuarioArea");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    });
}
// =====================================
// CARGAR AREAS DEL USUARIO
// =====================================
function cargarAreasUsuario(idUser) {
    fetch(
        "index.php?url=usuarioarea_lista&idUser=" + idUser
    )
        .then(res => res.json())
        .then(data => {
            //console.log("RESPUESTA COMPLETA:");
            //console.log(data);
            const lista = document.getElementById("listaAreas");
            lista.innerHTML = "";
            if (!data.success) {
                return;
            }
            data.data.forEach(area => {
                const div = document.createElement("div");
                div.className =
                    "flex items-center gap-2";
                div.innerHTML = `
                <input
                    type="checkbox"
                    name="areas[]"
                    value="${area.idArea}"
                    id="area_${area.idArea}"
                    class="rounded border-gray-300"
                    checked
                >
                <label 
                    for="area_${area.idArea}"
                    class="text-sm text-gray-700"
                >
                    ${area.nombreArea}
                </label>
            `;
                lista.appendChild(div);
            });
            cargarTodasLasAreasAsignables(
                idUser,
                data.data
            );
        });
}
// =====================================
// CARGAR TODAS LAS AREAS DISPONIBLES
// =====================================
function cargarTodasLasAreasAsignables(idUser, asignadas) {
    fetch(
        "index.php?url=usuarioarea_areas"
    )
        .then(res => res.json())
        .then(response => {
            //console.log("AREAS DISPONIBLES:", response);
            const lista =
                document.getElementById("listaAreas");
            lista.innerHTML = "";
            const areas = response.data ?? response;
            areas.forEach(area => {
                const marcado = asignadas.some(
                    a => a.idAreas == area.idAreas
                );
                const div = document.createElement("div");
                div.className =
                    "flex items-center gap-2";
                div.innerHTML = `
                <input
                    type="checkbox"
                    name="areas[]"
                    value="${area.idAreas}"
                    id="area_${area.idAreas}"
                    class="rounded border-gray-300"
                    ${marcado ? "checked" : ""}
                >
                <label 
                    for="area_${area.idArea}"
                    class="text-sm text-gray-700"
                >
                    ${area.nombreArea}
                </label>
            `;
                lista.appendChild(div);
            });
            //marcarAreasUsuario(idUser);
        })
        .catch(error => {
            console.error(
                "Error cargando áreas:",
                error
            );
        });
}
// =====================================
// MARCAR AREAS ACTUALES
// =====================================
/*
function marcarAreasUsuario(idUser) {
    fetch(
        "index.php?url=usuarioarea_lista&idUser=" + idUser
    )
        .then(res => res.json())
        .then(data => {
            if (!data.success)
                return;
            data.data.forEach(area => {
                const check =
                    document.getElementById(
                        "area_" + area.idAreas
                    );
                if (check) {
                    check.checked = true;
                }
            });
        });
}*/
// =====================================
// GUARDAR AREAS
// =====================================
function iniciarGuardarUsuarioArea() {
    const form =
        document.getElementById("formUsuarioArea");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Dialog.confirm({
            tipo: "info",
            titulo: "Actualizar áreas",
            mensaje:
                "¿Desea guardar las áreas asignadas al usuario?",
            textoAceptar: "Guardar",
            textoCancelar: "Cancelar",
            onAceptar() {
                const datos =
                    new FormData(form);
                fetch(
                    "index.php?url=usuarioarea_guardar",
                    {
                        method: "POST",
                        body: datos
                    }
                )
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Dialog.alert({
                                tipo: "success",
                                titulo: "Se registro correctamente.",
                                mensaje: data.message
                            });
                            cerrarModalUsuarioArea();
                        }
                    });
            }
        });
    });
}
// =====================================
// CERRAR MODAL
// =====================================
function cerrarModalUsuarioArea() {
    const modal =
        document.getElementById("modalUsuarioArea");
    if (!modal) return;
    modal.classList.remove("flex");
    modal.classList.add("hidden");
}