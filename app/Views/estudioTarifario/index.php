<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">


    <!-- Encabezado -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Estudios Tarifarios
            </h1>

            <p class="text-sm text-slate-500">
                Gestiona los estudios tarifarios del sistema
            </p>
        </div>


        <button
            id="abrirModalEstudio"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

            <i class="bi bi-plus-lg"></i>
            Nuevo Estudio

        </button>

    </div>



    <!-- Tabla -->

    <div class="bg-white rounded-xl shadow border border-slate-200">

        <div class="overflow-x-auto">

            <div class="p-6">


                <table
                    id="tablaEstudios"
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
                                Periodo
                            </th>

                            <th class="px-4 py-3">
                                Estado
                            </th>

                            <th class="px-4 py-3">
                                Creado
                            </th>

                            <th class="px-4 py-3">
                                Acciones
                            </th>


                        </tr>


                    </thead>



                    <tbody class="divide-y divide-slate-200">


                        <?php foreach ($estudios as $index => $e): ?>


                            <tr class="hover:bg-slate-50 transition">


                                <td class="px-4 py-3">
                                    <?= $index + 1 ?>
                                </td>



                                <td class="px-4 py-3 font-medium text-slate-700">
                                    <?= $e['codigo'] ?>
                                </td>



                                <td class="px-4 py-3">
                                    <?= $e['nombre'] ?>
                                </td>



                                <td class="px-4 py-3">

                                    <?= $e['anioInicio'] ?>
                                    -
                                    <?= $e['anioFin'] ?>

                                </td>



                                <td class="px-4 py-3">


                                    <?php if ($e['estado'] == "ACTIVO"): ?>

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                            ACTIVO

                                        </span>


                                    <?php else: ?>

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">

                                            CERRADO

                                        </span>


                                    <?php endif; ?>


                                </td>




                                <td class="px-4 py-3">

                                    <?= $e['fechaCreado'] ?>

                                </td>



                                <td class="px-4 py-3">


                                    <div class="flex items-center gap-2">


                                        <!-- EDITAR -->

                                        <button

                                            class="btnEditarEstudio inline-flex items-center justify-center p-2 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200"

                                            data-id="<?= $e['idEstudioTarifario'] ?>">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>



                                        <!-- CAMBIAR ESTADO -->


                                        <?php if ($e['estado'] == "ACTIVO"): ?>


                                            <button

                                                class="btnEstadoEstudio inline-flex items-center justify-center p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200"

                                                data-id="<?= $e['idEstudioTarifario'] ?>"

                                                data-estado="CERRADO"

                                                data-nombre="<?= $e['nombre'] ?>">


                                                <i class="bi bi-x-lg"></i>


                                            </button>


                                        <?php else: ?>


                                            <button

                                                class="btnEstadoEstudio inline-flex items-center justify-center p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200"

                                                data-id="<?= $e['idEstudioTarifario'] ?>"

                                                data-estado="ACTIVO"

                                                data-nombre="<?= $e['nombre'] ?>">


                                                <i class="bi bi-check2"></i>


                                            </button>


                                        <?php endif; ?>


                                    </div>


                                </td>



                            </tr>



                        <?php endforeach; ?>


                    </tbody>


                </table>


            </div>

        </div>

    </div>


</div>





<!-- MODAL NUEVO ESTUDIO -->

<div

    id="modalEstudio"

    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">


    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">



        <div class="flex justify-between items-center px-6 py-5 border-b">


            <h2 class="text-xl font-bold text-slate-800">

                Nuevo Estudio Tarifario

            </h2>


            <button id="cerrarModalEstudio">

                <i class="bi bi-x-lg"></i>

            </button>


        </div>



        <form
            id="formEstudio"
            method="POST"
            action="index.php?url=estudioTarifario_store">



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



                    <div>

                        <label class="block text-sm mb-2">

                            Año Inicio

                        </label>


                        <input

                            type="number"

                            name="anioInicio"

                            required

                            class="w-full border rounded-lg px-4 py-2">


                    </div>



                    <div>

                        <label class="block text-sm mb-2">

                            Año Fin

                        </label>


                        <input

                            type="number"

                            name="anioFin"

                            required

                            class="w-full border rounded-lg px-4 py-2">


                    </div>


                </div>


            </div>




            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">


                <button
                    type="button"
                    id="cancelarModalEstudio"
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

<!-- MODAL EDITAR ESTUDIO -->

<div
    id="modalEditarEstudio"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">


    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4">


        <div class="flex justify-between items-center px-6 py-5 border-b">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar Estudio Tarifario
                </h2>

                <p class="text-sm text-slate-500">
                    Actualice la información del estudio.
                </p>
            </div>


            <button id="cerrarModalEditarEstudio">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>



        <form
            method="POST"
            action="index.php?url=estudioTarifario_update">


            <input
                type="hidden"
                name="idEstudioTarifario"
                id="edit_idEstudio">


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <div>

                        <label class="block text-sm mb-2">
                            Código
                        </label>

                        <input
                            type="text"
                            id="edit_codigo"
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
                            id="edit_nombre"
                            name="nombre"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>



                    <div>

                        <label class="block text-sm mb-2">
                            Año Inicio
                        </label>

                        <input
                            type="number"
                            id="edit_anioInicio"
                            name="anioInicio"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>



                    <div>

                        <label class="block text-sm mb-2">
                            Año Fin
                        </label>

                        <input
                            type="number"
                            id="edit_anioFin"
                            name="anioFin"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>


                </div>

            </div>




            <div class="flex justify-end gap-3 px-6 py-5 bg-slate-50 rounded-b-2xl">


                <button
                    type="button"
                    id="cancelarModalEditarEstudio"
                    class="px-5 py-2 border rounded-lg">

                    Cancelar

                </button>


                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg">

                    <i class="bi bi-save"></i>

                    Guardar cambios

                </button>


            </div>


        </form>


    </div>


</div>


<?php
$titulo = "Estudio Tarifario";
$js = "estudioTarifario.js";
?>