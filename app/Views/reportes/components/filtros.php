<!-- =====================================
     FILTROS
====================================== -->
<div class="bg-white rounded-xl shadow p-6 mb-6">
    <div class="flex items-center gap-2 mb-5">
        <i class="bi bi-funnel text-blue-600 text-xl"></i>
        <h2 class="font-semibold text-gray-700">
            Filtros de búsqueda
        </h2>
    </div>
    <form method="GET"
        action="index.php">
        <input
            type="hidden"
            name="url"
            value="reportes">
        <input
            type="hidden"
            name="tipoReporte"
            value="<?= $tipoReporte ?>">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- ESTUDIO TARIFARIO -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Estudio Tarifario
                </label>
                <select
                    name="idEstudioTarifario"
                    class="tom-select w-full rounded-lg border-gray-300 text-sm">
                    <option value="">
                        Todos
                    </option>
                    <?php foreach ($filtros["estudios"] as $item): ?>
                        <option
                            value="<?= $item["idEstudioTarifario"] ?>"
                            <?=
                            ($_GET["idEstudioTarifario"] ?? '')
                                ==
                                $item["idEstudioTarifario"]
                                ? 'selected'
                                : ''
                            ?>>
                            <?= $item["estudioTarifario"] . ' | ' . $item["anioInicio"] . ' - ' . $item["anioFin"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- FONDO -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Fondo
                </label>
                <select
                    name="idFondo"
                    class="tom-select w-full rounded-lg border-gray-300 text-sm">
                    <option value="">
                        Todos
                    </option>
                    <?php foreach ($filtros["fondos"] as $item): ?>
                        <option
                            value="<?= $item["idFondos"] ?>"
                            <?=
                            ($_GET["idFondo"] ?? '')
                                ==
                                $item["idFondos"]
                                ? 'selected'
                                : ''
                            ?>>
                            <?= $item["nombreFondo"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- AREA -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Área
                </label>
                <select
                    name="idArea"
                    class="tom-select w-full rounded-lg border-gray-300 text-sm">
                    <option value="">
                        Todas
                    </option>
                    <?php foreach ($filtros["areas"] as $item): ?>
                        <option
                            value="<?= $item["idAreas"] ?>"
                            <?=
                            ($_GET["idArea"] ?? '')
                                ==
                                $item["idAreas"]
                                ? 'selected'
                                : ''
                            ?>>
                            <?= $item["nombreArea"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- AÑO -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Año
                </label>
                <select
                    name="anio"
                    class="tom-select w-full rounded-lg border-gray-300 text-sm">
                    <option value="">
                        Todos
                    </option>
                    <?php foreach ($filtros["anios"] as $anioFiltro): ?>
                        <option
                            value="<?= $anioFiltro ?>"
                            <?=
                            ($_GET["anio"] ?? '')
                                ==
                                $anioFiltro
                                ? 'selected'
                                : ''
                            ?>>
                            <?= $anioFiltro ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- INVERSION -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Inversión
                </label>
                <select
                    name="idInversiones"
                    class="tom-select w-full rounded-lg border-gray-300 text-sm">
                    <option value="">
                        Todas
                    </option>
                    <?php foreach ($filtros["inversiones"] as $item): ?>
                        <option
                            value="<?= $item["idInversiones"] ?>"
                            <?=
                            ($_GET["idInversiones"] ?? '')
                                ==
                                $item["idInversiones"]
                                ? 'selected'
                                : ''
                            ?>>
                            <?= $item["descripcion"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- BOTONES -->
        <div class="mt-5 flex justify-end gap-3">
            <!-- <a href="index.php?url=reportes&tipoReporte=estadoGeneral" -->
            <a href="index.php?url=reportes"
                class="px-4 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 text-sm">
                <i class="bi bi-x-circle"></i>
                Limpiar
            </a>
            <button
                type="submit"
                name="buscar"
                value="1"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm cursor-pointer">
                <i class="bi bi-search"></i>
                Buscar
            </button>
        </div>
    </form>
</div>