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
                document.getElementById("edit_usuario").value = u.usuario;
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