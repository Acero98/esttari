<header
    class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm"
    x-data="{ openMobile: false }">
    <div class="h-16 lg:h-[72px] px-4 lg:px-6 flex items-center justify-between">
        <!-- IZQUIERDA -->
        <div class="flex items-center gap-4">
            <!-- Botón menú -->
            <button
                @click="openMobile = !openMobile"
                class="md:hidden flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 hover:bg-blue-100 hover:text-blue-600 transition">
                <i
                    class="bi"
                    :class="openMobile ? 'bi-x-lg' : 'bi-list'">
                </i>
            </button>
            <!-- Logo -->
            <a
                href="index.php?url=bienvenida"
                class="flex items-center gap-3 group">
                <div
                    class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-100 to-cyan-100 border border-blue-200 flex items-center justify-center shadow-sm group-hover:shadow transition">
                    <img
                        src="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png"
                        class="w-7 h-7"
                        alt="Logo">
                </div>
                <div class="hidden sm:block">
                    <h1 class="font-bold text-slate-800 leading-none">
                        <?= SISTEMA_DESARROLLADOR ?>
                    </h1>
                    <p class="text-xs text-slate-500">
                        <?= SISTEMA_NOMBRE ?>
                    </p>
                </div>
            </a>
        </div>
        <!-- MENÚ MÓVIL -->
        <div
            x-show="openMobile"
            x-transition.opacity
            class="fixed inset-0 bg-black/40 z-40 md:hidden"
            @click="openMobile=false">
        </div>
        <div
            x-show="openMobile"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 w-72 h-screen bg-white shadow-2xl z-50 md:hidden overflow-y-auto">
            <!-- Cabecera -->
            <div class="px-6 py-5 border-b bg-gradient-to-r from-blue-50 to-cyan-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-xl bg-white shadow flex items-center justify-center">
                            <img
                                src="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png"
                                class="w-8 h-8">
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">
                                Roman UI
                            </h2>
                            <p class="text-xs text-slate-500">
                                Sistema de Gestión de Inversiones
                            </p>
                        </div>
                    </div>
                    <button
                        @click="openMobile=false"
                        class="w-9 h-9 rounded-lg hover:bg-slate-100">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <!-- Menú -->
            <nav class="p-4 space-y-1">
                <?php if (permiso('usuarios')): ?>
                <a
                    href="index.php?url=dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard Gerencial
                </a>
                <?php endif; ?>
                <a
                    href="index.php?url=dashboardInversion"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="bi bi-bar-chart-line"></i>
                    Dashboard Inversión
                </a>
                <a
                    href="index.php?url=inversiones"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="bi bi-folder2-open"></i>
                    Inversiones
                </a>
                <a
                    href="index.php?url=reportes"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    Reportes
                </a>
                <?php if (permiso('usuarios')): ?>
                <div class="border-t my-4"></div>
                <p class="px-4 pb-2 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                    Gestión
                </p>
                <a
                    href="index.php?url=estudioTarifario"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                    <i class="bi bi-journal-bookmark"></i>
                    Estudios Tarifarios
                </a>
                <a
                    href="index.php?url=fondos"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                    <i class="bi bi-wallet2"></i>
                    Fondos
                </a>
                <a
                    href="index.php?url=gerencias"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                    <i class="bi bi-diagram-3"></i>
                    Gerencias
                </a>
                <a
                    href="index.php?url=areas"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                    <i class="bi bi-grid"></i>
                    Áreas
                </a>
                    <div class="border-t my-4"></div>
                    <p class="px-4 pb-2 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                        Seguridad
                    </p>
                    <a
                        href="index.php?url=usuarios"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                        <i class="bi bi-people"></i>
                        Usuarios
                    </a>
                    <a
                        href="index.php?url=roles"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                        <i class="bi bi-person-badge"></i>
                        Roles
                    </a>
                    <a
                        href="index.php?url=permisos"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50">
                        <i class="bi bi-shield-lock"></i>
                        Permisos
                    </a>
                <?php endif; ?>
            </nav>
        </div>
        <!-- LOGO 
        <div class="flex items-center gap-3 flex-shrink-0">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-sky-100 to-blue-200 border border-sky-200 shadow-sm">
                <img
                    src="<= BASE_URL ?>assets/img/OlivaTech-Circulo.png"
                    class="w-7 h-7"
                    alt="Logo">
            </div>
            <div class="hidden sm:block leading-tight">
                <h1 class="text-base font-bold text-slate-800">
                    Roman UI
                </h1>
                <p class="text-xs text-slate-500">
                    Sistema de Gestión de Inversiones
                </p>
            </div>
        </div> -->
        <!-- MENÚ PRINCIPAL -->
        <nav class="hidden lg:flex items-center gap-2 text-sm font-medium">
            <!-- DASHBOARDS -->
            <div class="relative" x-data="{ open:false }">
                <button
                    @click="open=!open"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-sky-50 hover:text-sky-700 transition">
                    <i class="bi bi-speedometer2"></i>
                    Dashboards
                    <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <div
                    x-show="open"
                    x-transition
                    @click.outside="open=false"
                    class="absolute left-0 mt-3 w-64 rounded-2xl border border-slate-200 bg-white shadow-xl overflow-hidden z-50">
                    <div class="px-4 py-3 bg-slate-50 border-b">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Dashboards Ejecutivos
                        </p>
                    </div>
                    <div class="p-2">
                        <?php if (permiso('usuarios')): ?>
                            <a
                                href="index.php?url=dashboard"
                                class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-sky-50 hover:text-sky-700 transition">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard Gerencial
                            </a>
                        <?php endif; ?>
                        <a
                            href="index.php?url=dashboardInversion"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-sky-50 hover:text-sky-700 transition">
                            <i class="bi bi-bar-chart-line"></i>
                            Dashboard de Inversiones
                        </a>
                    </div>
                </div>
            </div>
            <!-- INVERSIONES -->
            <a
                href="index.php?url=inversiones"
                class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="bi bi-bank"></i>
                Inversiones
            </a>
            <!-- REPORTES -->
            <a
                href="index.php?url=reportes"
                class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition">
                <i class="bi bi-file-earmark-bar-graph"></i>
                Reportes
            </a>
            <!-- GESTIÓN -->
             <?php if (permiso('usuarios')): ?>
            <div class="relative" x-data="{ open:false }">
                <button
                    @click="open=!open"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-violet-50 hover:text-violet-700 transition">
                    <i class="bi bi-gear"></i>
                    Gestión
                    <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <div
                    x-show="open"
                    x-transition
                    @click.outside="open=false"
                    class="absolute left-0 mt-3 w-64 rounded-2xl border border-slate-200 bg-white shadow-xl overflow-hidden z-50">
                    <div class="px-4 py-3 bg-slate-50 border-b">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Gestión de Registros
                        </p>
                    </div>
                    <div class="p-2">
                        <a
                            href="index.php?url=estudioTarifario"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-violet-50 hover:text-violet-700 transition">
                            <i class="bi bi-journal-bookmark"></i>
                            Estudio Tarifario
                        </a>
                        <a
                            href="index.php?url=fondos"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-violet-50 hover:text-violet-700 transition">
                            <i class="bi bi-wallet2"></i>
                            Fondos
                        </a>
                        <a
                            href="index.php?url=gerencias"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-violet-50 hover:text-violet-700 transition">
                            <i class="bi bi-diagram-3"></i>
                            Gerencias
                        </a>
                        <a
                            href="index.php?url=areas"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-violet-50 hover:text-violet-700 transition">
                            <i class="bi bi-grid"></i>
                            Áreas
                        </a>
                    </div>
                </div>
            </div>
            <!-- SEGURIDAD -->
            
                <div class="relative" x-data="{ open:false }">
                    <button
                        @click="open=!open"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-slate-600 hover:bg-red-50 hover:text-red-700 transition">
                        <i class="bi bi-shield-lock"></i>
                        Seguridad
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div
                        x-show="open"
                        x-transition
                        @click.outside="open=false"
                        class="absolute left-0 mt-3 w-64 rounded-2xl border border-slate-200 bg-white shadow-xl overflow-hidden z-50">
                        <div class="px-4 py-3 bg-slate-50 border-b">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Gestión de Acceso
                            </p>
                        </div>
                        <div class="p-2">
                            <a
                                href="index.php?url=usuarios"
                                class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-red-50 hover:text-red-700 transition">
                                <i class="bi bi-people"></i>
                                Usuarios
                            </a>
                            <a
                                href="index.php?url=roles"
                                class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-red-50 hover:text-red-700 transition">
                                <i class="bi bi-person-badge"></i>
                                Roles
                            </a>
                            <a
                                href="index.php?url=permisos"
                                class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-red-50 hover:text-red-700 transition">
                                <i class="bi bi-key"></i>
                                Permisos
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </nav>
        <!-- USUARIO -->
        <div class="relative" x-data="{ open: false }">
            <button
                @click="open = !open"
                class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 shadow-sm hover:bg-slate-50 hover:shadow transition">
                <!-- Avatar -->
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-sky-400 to-blue-600 text-white font-semibold">
                    <?= strtoupper(substr($_SESSION['nombres'] ?? 'U', 0, 1)); ?>
                </div>
                <!-- Información -->
                <div class="hidden sm:flex flex-col text-left leading-tight">
                    <span class="text-sm font-semibold text-slate-800">
                        <?= $_SESSION['nombres'] ?? 'Usuario'; ?>
                    </span>
                    <span class="text-xs text-slate-500">
                        <?= $_SESSION['nombreRol'] ?? 'Usuario'; ?>
                    </span>
                </div>
                <i class="bi bi-chevron-down text-xs text-slate-500"></i>
            </button>
            <!-- MENÚ -->
            <div
                x-show="open"
                x-transition
                @click.outside="open = false"
                class="absolute right-0 mt-3 w-72 bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden z-50">
                <!-- CABECERA -->
                <div class="px-5 py-4 bg-gradient-to-r from-sky-50 to-blue-50 border-b">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-sky-400 to-blue-600 text-white text-xl font-bold">
                            <?= strtoupper(substr($_SESSION['nombres'] ?? 'U', 0, 1)); ?>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                <?= $_SESSION['nombres'] ?? 'Usuario'; ?>
                            </h3>
                            <p class="text-sm text-slate-500">
                                <?= $_SESSION['nombreRol'] ?? 'Usuario'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- OPCIONES 
                <div class="p-2">
                    <a
                        href="#"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-100 transition">
                        <i class="bi bi-person text-sky-600"></i>
                        <div>
                            <p class="font-medium text-slate-700">
                                Mi perfil
                            </p>
                            <p class="text-xs text-slate-500">
                                Ver información personal
                            </p>
                        </div>
                    </a>
                    <a
                        href="#"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-100 transition">
                        <i class="bi bi-gear text-violet-600"></i>
                        <div>
                            <p class="font-medium text-slate-700">
                                Configuración
                            </p>
                            <p class="text-xs text-slate-500">
                                Preferencias del sistema
                            </p>
                        </div>
                    </a>
                </div>-->
                <!-- FOOTER -->
                <div class="border-t p-2">
                    <a
                        href="index.php?url=logout"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="font-medium">
                            Cerrar sesión
                        </span>
                    </a>
                </div>
            </div>
        </div>
</header>
<main class="flex-1 p-4 md:p-6">