// FIX GLOBAL MODALS (Bootstrap)
document.addEventListener('hidden.bs.modal', function () {
    if (document.activeElement) {
        document.activeElement.blur();
    }
});


document.addEventListener("DOMContentLoaded", () => {

    if (window.flashMessage) {

        Swal.fire({
            icon: flashMessage.tipo,
            title: flashMessage.mensaje,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });

    }

});