<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SISTEMA_NOMBRE ?></title>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/output.css">

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-slate-200">
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img
                    src="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png"
                    class="w-20 h-20 mx-auto rounded-full shadow-lg">
                <!--
                <h1 class="mt-5 text-3xl font-bold text-slate-800">
                    <= SISTEMA_NOMBRE ?>
                </h1>

                 <p class="mt-2 text-slate-500">
                    <= SISTEMA_NOMBRE ?>
                </p> -->

            </div>

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8">

                <!-- Encabezado -->
                <div class="text-center mb-8">

                    <h2 class="text-2xl font-bold text-slate-800">
                        Iniciar sesión
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Ingrese sus credenciales para acceder al sistema.
                    </p>
                </div>

                <form method="POST"
                    action="index.php?url=auth"
                    class="space-y-6">
                    <!-- Usuario -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                            Usuario
                        </label>
                        <div class="relative">
                            <i class="bi bi-person absolute left-4 top-4 text-slate-400"></i>
                            <input
                                type="text"
                                name="usuario"
                                required
                                placeholder="Ingrese su usuario"
                                class="w-full rounded-xl border border-slate-300
                                py-3 pl-11 pr-4
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-100
                                outline-none
                                transition">
                        </div>
                    </div>
                    <!-- Password -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                            Contraseña
                        </label>
                        <div class="relative">
                            <i class="bi bi-lock absolute left-4 top-4 text-slate-400"></i>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="Ingrese su contraseña"
                                class="w-full rounded-xl border border-slate-300
                                py-3 pl-11 pr-14
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-100
                                outline-none
                                transition">
                            <button
                                type="button"
                                id="btnPassword"
                                class="absolute right-4 top-3 text-slate-500 hover:text-blue-600">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Recordarme 
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-slate-600">
                            <input
                                type="checkbox"
                                class="rounded border-slate-300">
                            Recordarme
                        </label>
                        <a
                            href="#"
                            class="text-blue-600 hover:text-blue-800">
                            ¿Olvidó su contraseña?
                        </a>
                    </div>-->
                    <!-- Botón -->
                    <button
                        type="submit"
                        class="w-full rounded-xl
                        bg-blue-600
                        py-3
                        text-white
                        font-semibold
                        shadow-lg
                        hover:bg-blue-700
                        hover:shadow-xl
                        transition">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Ingresar
                    </button>
                </form>
            </div>
            <div class="text-center mt-6 text-sm text-slate-500">
                © <?= date('Y') ?>
                <?= SISTEMA_DESARROLLADOR ?>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <script>
            window.flashMessage = {
                mensaje: <?= json_encode($_SESSION['mensaje']) ?>,
                tipo: <?= json_encode($_SESSION['tipo']) ?>
            };
        </script>
    <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo']);
    endif;
    ?>

    <script src="<?= BASE_URL ?>assets/js/app.js"></script>

    <script>
        const btn = document.getElementById("btnPassword");
        const input = document.getElementById("password");

        btn.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                btn.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                input.type = "password";
                btn.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });
    </script>

</body>

</html>