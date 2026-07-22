        </main>
        <!-- =======================================
            DIÁLOGOS GLOBALES
        ======================================== -->
        <?php require_once "../app/Views/layouts/dialog.php"; ?>
        <!-- =======================================
            FOOTER
        ======================================== -->
        <footer
            class="mt-auto border-t border-slate-200 bg-white/90 backdrop-blur-sm">
            <div
                class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-3">
                <!-- Sistema -->
                <div class="text-center md:text-left">
                    <h3 class="text-sm font-semibold text-slate-700">
                        Roman UI
                    </h3>
                    <p class="text-xs text-slate-500">
                        Sistema de Gestión de Inversiones
                    </p>
                </div>
                <!-- Copyright -->
                <div
                    class="text-center text-xs text-slate-500">
                    © <?= date('Y') ?>
                    <span class="font-medium text-slate-700">
                        Roman UI
                    </span>
                    · Todos los derechos reservados.
                </div>
            </div>
        </footer>
        <!-- =======================================
            LIBRERÍAS
        ======================================== -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Simple DataTables -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <!-- =======================================
            JAVASCRIPT GLOBAL
        ======================================== -->
        <script src="<?= BASE_URL ?>assets/js/app.js"></script>
        <script src="<?= BASE_URL ?>assets/js/dialog.js"></script>
        <!-- =======================================
            JAVASCRIPT DEL MÓDULO
        ======================================== -->
        <?php if (isset($js)): ?>
            <script src="<?= BASE_URL ?>assets/js/<?= $js ?>"></script>
        <?php endif; ?>
        <!-- =======================================
            NOTIFICACIONES GLOBALES
        ======================================== -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    Dialog.toast({
                        tipo: <?= json_encode($_SESSION['tipo']) ?>,
                        titulo: <?= json_encode($_SESSION['mensaje']) ?>,
                        tiempo: 2200
                    });
                });
            </script>
            <?php
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo']);
            ?>
        <?php endif; ?>
    </body>
</html>