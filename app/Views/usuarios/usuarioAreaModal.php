<!-- MODAL ASIGNAR ÁREAS A USUARIO -->
<div
    id="modalUsuarioArea"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl mx-4 max-h-[90vh] flex flex-col">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <h3 class="text-lg font-semibold text-gray-800">
                Asignar Áreas al Usuario
            </h3>

            <button
                id="cerrarModalUsuarioArea"
                class="text-gray-500 hover:text-gray-700">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>


        <!-- BODY -->
        <form id="formUsuarioArea">

            <div class="p-6">


                <input
                    type="hidden"
                    id="idUsuarioArea"
                    name="idUser">


                <label class="block mb-3 text-sm font-medium text-gray-700">
                    Seleccione las áreas asignadas
                </label>


                <div
                    id="listaAreas"
                    class="grid grid-cols-2 gap-3 max-h-60 overflow-y-auto border rounded-lg p-4">

                    <!-- Carga dinámica por JS -->

                </div>


            </div>


            <!-- FOOTER -->
            <div class="flex justify-end gap-3 px-6 py-4 border-t">


                <button
                    type="button"
                    id="cancelarModalUsuarioArea"
                    class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Cancelar
                </button>


                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Guardar
                </button>


            </div>


        </form>


    </div>

</div>