document.addEventListener('DOMContentLoaded', () => {

    iniciarEditarRol();
    iniciarRegistroRol();
    iniciarActualizarRol();
    iniciarCambiarEstado();
    iniciarDataTable();
    iniciarPermisosRol();

});


// =====================================
// EDITAR USUARIO
// =====================================
function iniciarEditarRol() {

    document.querySelectorAll('.btnEditar').forEach(btn => {
        btn.addEventListener('click', function () {
            let id = this.dataset.id;
            fetch('index.php?url=roles_edit&id=' + id)
                .then(res => res.json())
                .then(data => {
                    //console.log(data); // 👈 IMPORTANTE

                    let r = data.nombreRol;

                    document.getElementById('edit_id').value = r.idRol;
                    document.getElementById('edit_nombreRol').value = r.nombreRol;
                    document.getElementById('edit_descripcionRol').value = r.descripcionRol;

                    // 🔥 IMPORTANTE (FIX ARIA-HIDDEN ERROR)
                    document.activeElement.blur();

                    const modalRol = bootstrap.Modal.getInstance(document.getElementById('modalRol'));
                    if (modalRol) modalRol.hide();

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
function iniciarRegistroRol() {

    const form = document.getElementById('formRol');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        Swal.fire({

            title: '¿Registrar rol?',
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
function iniciarActualizarRol() {

    const form = document.getElementById('formEditarRol');
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

                title: `¿Desea ${accion} este rol?`,
                html: `<b>${nombre}</b>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location =
                        `index.php?url=roles_estado&id=${id}&estado=${estado}`;
                }
            });
        });
    });

}

// =====================================
// DATA TABLES
// =====================================
function iniciarDataTable() {

    const tabla = document.querySelector('#tablaRoles');
    if (!tabla) return;
    new DataTable(tabla, {
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        order: [[0, 'desc']],
        columnDefs: [
            {
                orderable: false,
                targets: 5
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

function iniciarPermisosRol() {

    document.querySelectorAll('.btnPermisos').forEach(btn => {
        btn.addEventListener('click', function () {
            let id = this.dataset.id;
            let nombre = this.dataset.nombre;

            fetch('index.php?url=roles_permisos&id=' + id)
                .then(res => res.json())
                .then(data => {
                    //console.log(data);
                    document.getElementById('idRolPermiso').value = id;
                    document.getElementById('nombreRol').innerHTML = nombre;

                    let html = '';
                    let grupoActual = '';

                    data.permisos.forEach(p => {
                        if (grupoActual !== p.grupo) {
                            if (grupoActual !== '') {
                                html += `
                                        </div>
                                    </div>
                                </div>
                                `;
                            }

                            grupoActual = p.grupo;
                            html += `

                            <div class="col-lg-4 col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-primary text-white fw-bold">
                                        ${grupoActual}
                                    </div>
                                    <div class="card-body">
                            `;
                        }

                        let checked = data.asignados.includes(p.idPermiso)
                            ? 'checked'
                            : '';

                        html += `
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[]"
                                    value="${p.idPermiso}"
                                    ${checked}>

                                <label class="form-check-label">
                                    <i class="${p.icono} me-2"></i>
                                    ${p.permiso}
                                </label>
                            </div>
                        `;
                    });

                    if (grupoActual !== '') {
                        html += `
                                </div>
                            </div>
                        </div>
                        `;
                    }

                    document.getElementById('contenedorPermisos').innerHTML = html;
                    new bootstrap.Modal(
                        document.getElementById('modalPermisos')
                    ).show();
                });
        });
    });

}