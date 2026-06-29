document.addEventListener('DOMContentLoaded', () => {

    iniciarEditarUsuario();
    iniciarRegistroUsuario();
    iniciarActualizarUsuario();
    iniciarCambiarEstado();
    iniciarDataTable();

});


// =====================================
// EDITAR USUARIO
// =====================================
function iniciarEditarUsuario() {

    document.querySelectorAll('.btnEditar').forEach(btn => {

        btn.addEventListener('click', function () {

            let id = this.dataset.id;

            fetch('index.php?url=usuarios_edit&id=' + id)

                .then(res => res.json())

                .then(data => {

                    let u = data.usuario;
                    let roles = data.roles;

                    document.getElementById('edit_id').value = u.idUser;
                    document.getElementById('edit_usuario').value = u.usuario;
                    document.getElementById('edit_correo').value = u.correo;
                    document.getElementById('edit_nombres').value = u.nombres;
                    document.getElementById('edit_apellidos').value = u.apellidos;

                    let select = document.getElementById('edit_rol');
                    select.innerHTML = '';

                    roles.forEach(r => {
                        let selected = (r.idRol == u.idRol) ? 'selected' : '';
                        select.innerHTML += `
                            <option value="${r.idRol}" ${selected}>
                                ${r.nombreRol}
                            </option>
                        `;
                    });

                    // 🔥 IMPORTANTE (FIX ARIA-HIDDEN ERROR)
                    document.activeElement.blur();

                    const modalUsuario = bootstrap.Modal.getInstance(document.getElementById('modalUsuario'));
                    if (modalUsuario) modalUsuario.hide();

                    const modal = new bootstrap.Modal(
                        document.getElementById('modalEditar')
                    );

                    modal.show();
                });

        });

    });

}


// =====================================
// REGISTRAR USUARIO
// =====================================
function iniciarRegistroUsuario() {

    const form = document.getElementById('formUsuario');

    if (!form) return;

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        Swal.fire({

            title: '¿Registrar usuario?',
            text: 'Se guardará la información.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'

        }).then(result => {

            if (result.isConfirmed) {

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

        Swal.fire({

            title: '¿Guardar cambios?',
            text: 'Se actualizará la información.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            cancelButtonText: 'Cancelar'

        }).then(result => {

            if (result.isConfirmed) {

                form.submit();

            }

        });

    });

}


// =====================================
// CAMBIAR ESTADO
// =====================================
function iniciarCambiarEstado() {

    document.querySelectorAll('.btnEstado').forEach(btn => {

        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const estado = this.dataset.estado;
            const nombre = this.dataset.nombre;

            const accion = estado == 1 ? 'activar' : 'deshabilitar';

            Swal.fire({

                title: `¿Desea ${accion} este usuario?`,
                html: `<b>${nombre}</b>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'

            }).then((result) => {

                if (result.isConfirmed) {

                    window.location =
                        `index.php?url=usuarios_estado&id=${id}&estado=${estado}`;

                }

            });

        });

    });

}

// =====================================
// DATA TABLES
// =====================================
function iniciarDataTable() {

    const tabla = document.querySelector('#tablaUsuarios');

    if (!tabla) return;

    new DataTable(tabla, {

        responsive: true,
        autoWidth: false,

        pageLength: 10,

        order: [[0, 'desc']],

        columnDefs: [
            {
                orderable: false,
                targets: 7
            }
        ],

        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "No hay registros",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "No hay datos disponibles",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            }
        }

    });

}