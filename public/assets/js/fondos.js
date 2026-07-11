document.addEventListener('DOMContentLoaded', () => {

    iniciarDataTable();

    iniciarModalFondo();

    iniciarModalEditarFondo();

    iniciarEditarFondo();

    iniciarRegistroFondo();

    iniciarActualizarFondo();

});


// =====================================
// DATA TABLE
// =====================================
function iniciarDataTable() {

    const tabla = document.querySelector("#tablaFondos");

    if (!tabla) return;


    new simpleDatatables.DataTable("#tablaFondos", {

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
// MODAL NUEVO FONDO
// =====================================
function iniciarModalFondo() {


    const modal = document.getElementById("modalFondo");


    if (!modal) return;



    document.getElementById("abrirModalFondo")
        ?.addEventListener("click", () => {


            modal.classList.remove("hidden");

            modal.classList.add("flex");


        });



    document.getElementById("cerrarModalFondo")
        ?.addEventListener("click", cerrar);



    document.getElementById("cancelarModalFondo")
        ?.addEventListener("click", cerrar);



    modal.addEventListener("click", e => {


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
// MODAL EDITAR FONDO
// =====================================
function iniciarModalEditarFondo() {


    const modal = document.getElementById("modalEditarFondo");


    if (!modal) return;



    document.getElementById("cerrarModalEditarFondo")
        ?.addEventListener("click", cerrar);



    document.getElementById("cancelarModalEditarFondo")
        ?.addEventListener("click", cerrar);



    modal.addEventListener("click", e => {


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
// EDITAR FONDO
// =====================================
function iniciarEditarFondo() {

    document.addEventListener("click", function (e) {

        const btn = e.target.closest(".btnEditarFondo");

        if (!btn) return;


        const id = btn.dataset.id;


        fetch("index.php?url=fondos_edit&id=" + id)

            .then(res => res.json())

            .then(data => {


                const fondo = data.fondo;


                document.getElementById("edit_idFondos").value =
                    fondo.idFondos;


                document.getElementById("edit_codigo").value =
                    fondo.codigo;


                document.getElementById("edit_nombre").value =
                    fondo.nombre;


                document.getElementById("edit_descripcion").value =
                    fondo.descripcion;



                const modal = document.getElementById("modalEditarFondo");


                modal.classList.remove("hidden");

                modal.classList.add("flex");


            });


    });

}





// =====================================
// REGISTRAR FONDO
// =====================================
function iniciarRegistroFondo() {


    const form =
        document.querySelector("#modalFondo form");



    if (!form) return;



    form.addEventListener("submit", function (e) {


        e.preventDefault();



        Dialog.confirm({


            tipo: "info",


            titulo: "Registrar fondo",


            mensaje: `

                ¿Desea registrar este nuevo fondo?

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
// ACTUALIZAR FONDO
// =====================================
function iniciarActualizarFondo() {



    const form =
        document.querySelector("#modalEditarFondo form");



    if (!form) return;




    form.addEventListener("submit", function (e) {



        e.preventDefault();



        Dialog.confirm({



            tipo: "warning",



            titulo: "Actualizar fondo",



            mensaje: `

                ¿Desea guardar los cambios realizados?

                <br><br>

                La información será actualizada.

            `,



            textoAceptar: "Actualizar",



            textoCancelar: "Cancelar",




            onAceptar() {


                form.submit();



            }



        });



    });



}