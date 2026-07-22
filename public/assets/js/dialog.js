const Dialog = (() => {
    const dialogFooter = document.getElementById("dialogFooter");
    const dialog = document.getElementById("dialogConfirmacion");
    const titulo = document.getElementById("dialogTitulo");
    const mensaje = document.getElementById("dialogMensaje");
    const aceptar = document.getElementById("dialogAceptar");
    const cancelar = document.getElementById("dialogCancelar");
    const dialogIcono = document.getElementById("dialogIcono");
    const dialogIconoClase = document.getElementById("dialogIconoClase");
    let accionAceptar = null;
    cancelar.onclick = () => dialog.close();
    aceptar.onclick = () => {
        dialog.close();
        if (accionAceptar) {
            accionAceptar();
        }
    };
    function resetStyles() {
        dialogFooter.classList.remove("hidden");
        cancelar.classList.remove("hidden");
        aceptar.classList.remove("hidden");
        dialogIcono.className =
            "w-12 h-12 rounded-full flex items-center justify-center";
        dialogIconoClase.className = "";
        aceptar.className =
            "px-4 py-2 rounded-lg text-white";
    }
    return {
        confirm(config) {
            cancelar.classList.remove("hidden");
            titulo.textContent = config.titulo;
            mensaje.innerHTML = config.mensaje;
            aceptar.textContent = config.textoAceptar ?? "Aceptar";
            cancelar.textContent = config.textoCancelar ?? "Cancelar";
            accionAceptar = config.onAceptar;
            resetStyles();
            // ICONO
            switch (config.tipo) {
                case "success":
                    dialogIcono.classList.add("bg-green-100");
                    dialogIconoClase.className = "bi bi-check-circle text-green-600 text-2xl";
                    aceptar.classList.add("bg-green-600", "hover:bg-green-700");
                    break;
                case "warning":
                    dialogIcono.classList.add("bg-yellow-100");
                    dialogIconoClase.className = "bi bi-exclamation-circle text-yellow-600 text-2xl";
                    aceptar.classList.add("bg-yellow-500", "hover:bg-yellow-600");
                    break;
                case "info":
                    dialogIcono.classList.add("bg-blue-100");
                    dialogIconoClase.className = "bi bi-info-circle text-blue-600 text-2xl";
                    aceptar.classList.add("bg-blue-600", "hover:bg-blue-700");
                    break;
                default:
                    dialogIcono.classList.add("bg-red-100");
                    dialogIconoClase.className = "bi bi-exclamation-triangle text-red-600 text-2xl";
                    aceptar.classList.add("bg-red-600", "hover:bg-red-700");
            }
            dialog.showModal();
        },
        alert(config) {
            titulo.textContent = config.titulo;
            mensaje.innerHTML = config.mensaje ?? "";
            accionAceptar = null;
            resetStyles();
            // 👇 OCULTAR TODO EL FOOTER (no solo botones)
            dialogFooter.classList.add("hidden");
            switch (config.tipo) {
                case "success":
                    dialogIcono.classList.add("bg-green-100");
                    dialogIconoClase.className = "bi bi-check-circle text-green-600 text-2xl";
                    break;
                case "error":
                    dialogIcono.classList.add("bg-red-100");
                    dialogIconoClase.className = "bi bi-x-circle text-red-600 text-2xl";
                    break;
                default:
                    dialogIcono.classList.add("bg-blue-100");
                    dialogIconoClase.className = "bi bi-info-circle text-blue-600 text-2xl";
            }
            dialog.showModal();
            setTimeout(() => {
                dialog.close();
                // 👇 RESTAURAR FOOTER
                dialogFooter.classList.remove("hidden");
            }, config.tiempo ?? 2000);
        },
        toast(config) {
            titulo.textContent = config.titulo;
            mensaje.innerHTML = config.mensaje ?? "";
            resetStyles();
            dialogFooter.classList.add("hidden");
            cancelar.classList.add("hidden");
            aceptar.classList.add("hidden");
            // icono
            dialogIcono.className =
                "w-12 h-12 rounded-full flex items-center justify-center";
            switch (config.tipo) {
                case "success":
                    dialogIcono.classList.add("bg-green-100");
                    dialogIconoClase.className =
                        "bi bi-check-circle text-green-600 text-2xl";
                    break;
                case "error":
                    dialogIcono.classList.add("bg-red-100");
                    dialogIconoClase.className =
                        "bi bi-x-circle text-red-600 text-2xl";
                    break;
                default:
                    dialogIcono.classList.add("bg-blue-100");
                    dialogIconoClase.className =
                        "bi bi-info-circle text-blue-600 text-2xl";
            }
            dialog.showModal();
            // 👇 AUTO CIERRE
            setTimeout(() => {
                dialog.close();
                dialogFooter.classList.remove("hidden");
                cancelar.classList.remove("hidden");
                aceptar.classList.remove("hidden");
            }, config.tiempo ?? 2000);
        }
    };
})();