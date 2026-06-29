<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roman UI</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- FAVICON 
    <link rel="icon" href="<= BASE_URL ?>assets/img/favicon.ico">-->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png">
    <!-- CSS LOCAL (MVC SIMPLE) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/login.css">
</head>

<body>
    <div class="login-card">
        <div class="logo">
            R
        </div>

        <h2 class="login-title">
            Roman UI
        </h2>

        <p class="login-subtitle">
            Bienvenido nuevamente
        </p>

        <!-- MVC ACTION -->
        <form method="POST" action="index.php?url=auth">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input
                    type="text"
                    class="form-control"
                    name="usuario"
                    placeholder="Ingrese su usuario"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Ingrese su contraseña"
                        required>
                    <span class="input-group-text" id="btnPassword">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">Recordarme</label>
                </div>
                <a href="#">¿Olvidó su contraseña?</a>
            </div>

            <button class="btn-login">
                Ingresar
            </button>
        </form>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Flash Message -->
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
        ?>
    <?php endif; ?>
    <!-- JS Global -->
    <script src="<?= BASE_URL ?>assets/js/app.js"></script>
    <!-- PASSWORD TOGGLE -->
    <script>
        const btn = document.getElementById("btnPassword");
        const input = document.getElementById("password");

        btn.addEventListener("click", function() {
            if (input.type === "password") {
                input.type = "text";
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                input.type = "password";
                this.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });
    </script>
</body>

</html>