<div class="max-w-7xl mx-auto p-6 space-y-6">


    <!-- Encabezado -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Fondos
            </h1>

            <p class="text-sm text-slate-500">
                Gestiona los fondos del sistema
            </p>

        </div>


        <button
            id="abrirModalFondo"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

            <i class="bi bi-plus-lg"></i>
            Nuevo Fondo

        </button>

    </div>



    <!-- Tabla -->

    <div class="bg-white rounded-xl shadow border border-slate-200">

        <div class="overflow-x-auto">

            <div class="p-6">


                <table
                    id="tablaFondos"
                    class="min-w-full text-sm text-left whitespace-nowrap">


                    <thead class="bg-slate-100 text-slate-700 uppercase text-xs">

                        <tr>

                            <th class="px-4 py-3">
                                N°
                            </th>

                            <th class="px-4 py-3">
                                Código
                            </th>

                            <th class="px-4 py-3">
                                Nombre
                            </th>

                            <th class="px-4 py-3">
                                Descripción
                            </th>

                            <th class="px-4 py-3">
                                Fecha Creación
                            </th>

                            <th class="px-4 py-3">
                                Acciones
                            </th>

                        </tr>

                    </thead>



                    <tbody class="divide-y divide-slate-200">


                        <?php foreach ($fondos as $index => $f): ?>


                            <tr class="hover:bg-slate-50 transition">


                                <td class="px-4 py-3">
                                    <?= $index + 1 ?>
                                </td>


                                <td class="px-4 py-3 font-medium text-slate-700">
                                    <?= $f['codigo'] ?>
                                </td>


                                <td class="px-4 py-3">
                                    <?= $f['nombre'] ?>
                                </td>


                                <td class="px-4 py-3">
                                    <?= $f['descripcion'] ?>
                                </td>


                                <td class="px-4 py-3">
                                    <?= $f['fechaCreado'] ?>
                                </td>



                                <td class="px-4 py-3">


                                    <button

                                        class="btnEditarFondo inline-flex items-center justify-center p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200"

                                        data-id="<?= $f['idFondos'] ?>">


                                        <i class="bi bi-pencil-square"></i>


                                    </button>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                    </tbody>


                </table>


            </div>

        </div>

    </div>


</div>





<!-- MODAL NUEVO FONDO -->

<div

    id="modalFondo"

    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">


    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">



        <div class="flex justify-between items-center px-6 py-5 border-b">


            <h2 class="text-xl font-bold text-slate-800">

                Nuevo Fondo

            </h2>


            <button id="cerrarModalFondo">

                <i class="bi bi-x-lg"></i>

            </button>


        </div>




        <form

            method="POST"

            action="index.php?url=fondos_store">


            <div class="p-6">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <div>

                        <label class="block text-sm mb-2">
                            Código
                        </label>

                        <input

                            type="text"

                            name="codigo"

                            required

                            class="w-full border rounded-lg px-4 py-2">


                    </div>



                    <div>

                        <label class="block text-sm mb-2">
                            Nombre
                        </label>

                        <input

                            type="text"

                            name="nombre"

                            required

                            class="w-full border rounded-lg px-4 py-2">


                    </div>



                    <div class="md:col-span-2">

                        <label class="block text-sm mb-2">
                            Descripción
                        </label>

                        <input

                            type="text"

                            name="descripcion"

                            class="w-full border rounded-lg px-4 py-2">


                    </div>


                </div>


            </div>




            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">


                <button

                    type="button"

                    id="cancelarModalFondo"

                    class="px-5 py-2 border rounded-lg">

                    Cancelar

                </button>



                <button

                    type="submit"

                    class="px-5 py-2 bg-blue-600 text-white rounded-lg">

                    <i class="bi bi-save"></i>

                    Guardar

                </button>


            </div>


        </form>


    </div>


</div>





<!-- MODAL EDITAR FONDO -->

<div

    id="modalEditarFondo"

    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">


    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">


        <div class="flex justify-between items-center px-6 py-5 border-b">

            <h2 class="text-xl font-bold text-slate-800">
                Editar Fondo
            </h2>


            <button id="cerrarModalEditarFondo">

                <i class="bi bi-x-lg"></i>

            </button>


        </div>




        <form

            method="POST"

            action="index.php?url=fondos_update">


            <input

                type="hidden"

                name="idFondos"

                id="edit_idFondos">


            <div class="p-6">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <div>

                        <label class="block text-sm mb-2">
                            Código
                        </label>

                        <input

                            type="text"

                            name="codigo"

                            id="edit_codigo"

                            class="w-full border rounded-lg px-4 py-2">


                    </div>



                    <div>

                        <label class="block text-sm mb-2">
                            Nombre
                        </label>

                        <input

                            type="text"

                            name="nombre"

                            id="edit_nombre"

                            class="w-full border rounded-lg px-4 py-2">


                    </div>



                    <div class="md:col-span-2">

                        <label class="block text-sm mb-2">
                            Descripción
                        </label>

                        <input

                            type="text"

                            name="descripcion"

                            id="edit_descripcion"

                            class="w-full border rounded-lg px-4 py-2">


                    </div>


                </div>


            </div>




            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">


                <button

                    type="button"

                    id="cancelarModalEditarFondo"

                    class="px-5 py-2 border rounded-lg">

                    Cancelar

                </button>



                <button

                    type="submit"

                    class="px-5 py-2 bg-blue-600 text-white rounded-lg">

                    Guardar cambios

                </button>


            </div>


        </form>


    </div>


</div>





<?php

$titulo = "Fondos";

$js = "fondos.js";

?>