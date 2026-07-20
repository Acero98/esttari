<div class="bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden mt-6">


    <!-- Cabecera -->
    <div class="px-6 py-5 bg-gradient-to-r from-emerald-50 to-green-50 border-b border-slate-200">

        <div class="flex items-center gap-3">


            <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center">

                <i class="bi bi-cash-coin text-emerald-600 text-xl"></i>

            </div>


            <div>

                <h2 class="text-lg font-bold text-slate-800">

                    Ejecuciones Recientes

                </h2>


                <p class="text-sm text-slate-500">

                    Últimos movimientos de ejecución financiera registrados.

                </p>

            </div>


        </div>


    </div>



    <!-- Tabla -->
    <div class="p-6">


        <div class="overflow-x-auto rounded-xl border border-slate-200">


            <table class="min-w-full text-sm">


                <thead class="bg-slate-100 text-slate-700">


                    <tr>


                        <th class="px-4 py-3 text-center font-semibold">

                            N°

                        </th>


                        <th class="px-4 py-3 text-center font-semibold">

                            Año Regulatorio

                        </th>


                        <th class="px-4 py-3 text-left font-semibold">

                            Fecha

                        </th>


                        <th class="px-4 py-3 text-right font-semibold">

                            Monto Ejecutado

                        </th>


                    </tr>


                </thead>



                <tbody class="divide-y divide-slate-100">


                    <?php foreach ($ejecucionesRecientes as $index => $item): ?>


                        <tr class="hover:bg-emerald-50 transition">


                            <td class="px-4 py-3 text-center">


                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-100 text-slate-700 font-semibold">

                                    <?= $index + 1 ?>

                                </span>


                            </td>



                            <td class="px-4 py-3 text-center">


                                <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold text-xs">


                                    <?= $item['anio'] ?>


                                </span>


                            </td>




                            <td class="px-4 py-3 text-slate-600">


                                <div class="flex items-center gap-2">


                                    <i class="bi bi-calendar3 text-slate-400"></i>


                                    <?= date(
                                        'd/m/Y',
                                        strtotime($item['mes'])
                                    ) ?>


                                </div>


                            </td>




                            <td class="px-4 py-3 text-right">


                                <span class="font-bold text-emerald-600">


                                    S/
                                    <?= number_format(
                                        $item['total'],
                                        2
                                    ) ?>


                                </span>


                            </td>



                        </tr>


                    <?php endforeach; ?>


                </tbody>


            </table>


        </div>


    </div>


</div>