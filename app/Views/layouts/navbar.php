<header class="bg-white border-b px-6 py-3 flex items-center justify-between" x-data="{ openMobile: false }">

    <button @click="openMobile = !openMobile"
        class="md:hidden bg-slate-100 px-3 py-2 rounded-lg">
        <i class="bi bi-list"></i>
    </button>

    <div x-show="openMobile"
        class="md:hidden absolute top-16 left-0 w-full bg-white border-b shadow-lg p-4 z-50">

        <a href="index.php?url=dashboard" class="block py-2">Dashboard</a>
        <a href="index.php?url=inversiones" class="block py-2">Inversiones</a>
        <a href="index.php?url=fondos" class="block py-2">Fondos</a>
        <a href="index.php?url=reportes" class="block py-2">Reportes</a>

        <div class="border-t my-2"></div>

        <p class="text-xs text-slate-400">Seguridad</p>

        <?php if (permiso('usuarios')): ?>
            <a href="index.php?url=usuarios" class="block py-2">Usuarios</a>
        <?php endif; ?>

        <a href="index.php?url=roles" class="block py-2">Roles</a>
        <a href="index.php?url=permisos" class="block py-2">Permisos</a>

    </div>

    <!-- LOGO -->
    <div class="flex items-center gap-3">
        <img src="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png" class="w-8 h-8">
        <span class="font-bold text-slate-800">Roman UI</span>
    </div>

    <!-- MENÚ PRINCIPAL -->
    <nav class="hidden md:flex items-center gap-6 text-sm text-slate-600">

        <a href="index.php?url=dashboard" class="hover:text-slate-900">Dashboard</a>
        <a href="index.php?url=inversiones" class="hover:text-slate-900">Inversiones</a>
        <a href="index.php?url=fondos" class="hover:text-slate-900">Fondos</a>
        <a href="index.php?url=reportes" class="hover:text-slate-900">Reportes</a>

        <!-- MEGA MENU SEGURIDAD -->
        <div class="relative" x-data="{ open: false }">

            <button @click="open = !open"
                class="hover:text-slate-900 flex items-center gap-1">
                Seguridad
                <i class="bi bi-chevron-down text-xs"></i>
            </button>

            <!-- DROPDOWN -->
            <div x-show="open"
                @click.outside="open = false"
                class="absolute left-0 mt-3 w-[320px] bg-white border rounded-xl shadow-lg p-4 z-50">

                <h3 class="text-xs text-slate-400 uppercase mb-2">Gestión de acceso</h3>

                <?php if (permiso('usuarios')): ?>
                    <a href="index.php?url=usuarios"
                        class="block px-2 py-1 rounded hover:bg-slate-100">
                        Usuarios
                    </a>
                <?php endif; ?>

                <a href="index.php?url=roles"
                    class="block px-2 py-1 rounded hover:bg-slate-100">
                    Roles
                </a>

                <a href="index.php?url=permisos"
                    class="block px-2 py-1 rounded hover:bg-slate-100">
                    Permisos
                </a>

            </div>
        </div>

    </nav>

    <!-- USUARIO -->
    <div class="relative" x-data="{ open: false }">

        <button
            @click="open = !open"
            class="flex items-center gap-2 bg-slate-100 px-3 py-2 rounded-lg hover:bg-slate-200">
            <i class="bi bi-person-circle"></i>
            <?= $_SESSION['nombres'] ?? 'Usuario'; ?>
            <i class="bi bi-chevron-down text-xs"></i>
        </button>

        <!-- Menú -->
        <div
            x-show="open"
            @click.outside="open = false"
            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-2 z-50">

            <a href="index.php?url=perfil"
                class="block px-4 py-2 hover:bg-slate-100">
                <i class="bi bi-person me-2"></i>
                Mi perfil
            </a>

            <hr>

            <a href="index.php?url=logout"
                class="block px-4 py-2 text-red-600 hover:bg-red-50">
                <i class="bi bi-box-arrow-right me-2"></i>
                Cerrar sesión
            </a>

        </div>

    </div>

</header>

<main class="p-6 flex-1">