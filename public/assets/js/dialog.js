const Dialog = (() => {

    const dialog = document.getElementById("dialogConfirmacion");

    const titulo = document.getElementById("dialogTitulo");

    const mensaje = document.getElementById("dialogMensaje");

    const aceptar = document.getElementById("dialogAceptar");

    const cancelar = document.getElementById("dialogCancelar");

    let accionAceptar = null;

    cancelar.onclick = () => {

        dialog.close();

    };

    aceptar.onclick = () => {

        dialog.close();

        if (accionAceptar) {

            accionAceptar();

        }

    };

    return {

        confirm(config) {

            titulo.textContent = config.titulo;

            mensaje.innerHTML = config.mensaje;

            aceptar.textContent = config.textoAceptar ?? "Aceptar";

            cancelar.textContent = config.textoCancelar ?? "Cancelar";

            accionAceptar = config.onAceptar;

            dialog.showModal();

        }

    };

})();