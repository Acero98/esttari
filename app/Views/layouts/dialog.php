<dialog
    id="dialogConfirmacion"
    class="m-auto p-0 rounded-2xl shadow-2xl backdrop:bg-black/50 backdrop:backdrop-blur-sm">

    <div class="w-[420px] max-w-[95vw] bg-white rounded-2xl overflow-hidden">

        <!-- Encabezado -->
        <div class="flex items-center gap-4 p-6 border-b">

            <div id="dialogIcono"
                class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">

                <i id="dialogIconoClase"
                    class="bi bi-exclamation-triangle text-red-600 text-2xl">
                </i>

            </div>

            <div>

                <h2
                    id="dialogTitulo"
                    class="text-lg font-bold text-slate-800">
                    Confirmación
                </h2>

                <p
                    id="dialogMensaje"
                    class="text-sm text-slate-500 mt-1">
                    Mensaje...
                </p>

            </div>

        </div>

        <!-- Botones -->

        <div id="dialogFooter" class="flex justify-end gap-3 p-5 bg-slate-50">

            <button
                id="dialogCancelar"
                class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                Cancelar

            </button>

            <button
                id="dialogAceptar"
                class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">

                Aceptar

            </button>

        </div>

    </div>

</dialog>