<div class="w-full px-4 md:px-6 xl:px-8 space-y-6">

    <!-- ENCABEZADO -->
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Bienvenido al Sistema
        </h1>

        <p class="text-slate-500 mt-2">
            Sistema de Seguimiento de Inversiones - EPS ILO S.A.
        </p>
    </div>

    <!-- TARJETAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Usuario -->
        <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Usuario
                    </p>

                    <h2 class="text-lg font-bold text-slate-800 mt-1">
                        <?= $_SESSION['nombres'] . ' ' . $_SESSION['apellidos'] ?>
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">

                    <i class="bi bi-person-circle text-3xl text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- Rol -->
        <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Rol
                    </p>

                    <h2 class="text-lg font-bold text-slate-800 mt-1">
                        <?= $_SESSION['nombreRol'] ?>
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">

                    <i class="bi bi-shield-check text-3xl text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- Fecha -->
        <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Fecha y Hora
                    </p>

                    <h2 class="text-base font-bold text-slate-800 mt-1">
                        <?= date("d/m/Y") ?>
                    </h2>

                    <p class="text-sm text-slate-500">
                        <?= date("H:i") ?>
                    </p>

                </div>

                <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center">

                    <i class="bi bi-clock-history text-3xl text-amber-600"></i>

                </div>

            </div>

        </div>

        <!-- Version -->
        <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Versión
                    </p>

                    <h2 class="text-lg font-bold text-slate-800 mt-1">
                        v1.0.0
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-full bg-purple-100 flex items-center justify-center">

                    <i class="bi bi-code-slash text-3xl text-purple-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- INFORMACIÓN -->
    <div class="bg-white rounded-xl shadow border border-slate-200">

        <div class="p-8">

            <div class="flex items-start gap-5">

                <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">

                    <i class="bi bi-building text-4xl text-blue-600"></i>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Sistema de Seguimiento de Inversiones
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Empresa Prestadora de Servicios de Saneamiento
                        <strong>EPS ILO S.A.</strong>
                    </p>

                    <p class="text-slate-600 mt-5 leading-7">

                        Bienvenido al sistema institucional para la gestión y seguimiento de inversiones.

                        Desde este sistema podrá acceder a los módulos que tiene asignados según su rol, permitiendo administrar información, generar reportes y realizar el seguimiento físico y financiero de los proyectos de inversión.

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- AVISOS 
    <div class="bg-white rounded-xl shadow border border-slate-200">

        <div class="px-6 py-4 border-b">

            <h3 class="text-lg font-semibold text-slate-800">

                <i class="bi bi-megaphone text-blue-600 me-2"></i>

                Comunicados

            </h3>

        </div>

        <div class="p-8 text-center">

            <i class="bi bi-chat-square-text text-5xl text-slate-300"></i>

            <p class="mt-4 text-slate-500">

                No existen comunicados disponibles.

            </p>

        </div>

    </div>-->

</div>