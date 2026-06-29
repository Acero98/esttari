<nav class="navbar navbar-expand-lg bg-white border-bottom py-2">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>index.php?url=dashboard">

            <img src="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png"
                width="36"
                class="me-2">

            Roman UI

        </a>

        <button
            class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?url=dashboard">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?url=inversiones">
                        <i class="bi bi-building"></i>
                        Inversiones
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?url=fondos">
                        <i class="bi bi-wallet2"></i>
                        Fondos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?url=reportes">
                        <i class="bi bi-bar-chart"></i>
                        Reportes
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-shield-lock"></i>
                        Seguridad
                    </a>

                    <ul class="dropdown-menu">
                        <?php if (permiso('usuarios')): ?>
                        <li>
                            <a class="dropdown-item"
                                href="index.php?url=usuarios">
                                <i class="bi bi-people"></i>
                                Usuarios
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a class="dropdown-item"
                                href="index.php?url=roles">
                                <i class="bi bi-person-badge"></i>
                                Roles
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="index.php?url=permisos">
                                <i class="bi bi-key"></i>
                                Permisos
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
            <div class="dropdown">
                <button
                    class="btn btn-light dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    <?= $_SESSION['nombres'] ?? 'Usuario'; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            Mi Perfil
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger"
                            href="index.php?url=logout">
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>