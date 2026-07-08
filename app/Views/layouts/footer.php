        </main>

        <?php require_once "../app/Views/layouts/dialog.php"; ?>

        <footer class="text-center text-xs text-slate-400 py-4 border-t bg-white shrink-0">
            © <?= date('Y') ?> Roman UI
        </footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- JS GLOBAL -->
<script src="<?= BASE_URL ?>assets/js/app.js"></script>
<script src="<?= BASE_URL ?>assets/js/dialog.js"></script>

<!-- JS POR MÓDULO -->
<?php if (isset($js)): ?>
    <script src="<?= BASE_URL ?>assets/js/<?= $js ?>"></script>
<?php endif; ?>

<!-- ALERT GLOBAL -->
<?php if (isset($_SESSION['mensaje'])): ?>

<script>

document.addEventListener("DOMContentLoaded", () => {
    Dialog.toast({
        tipo: <?= json_encode($_SESSION['tipo']) ?>,
        titulo: <?= json_encode($_SESSION['mensaje']) ?>,
        tiempo: 2000
    });
});

</script>

<?php
unset($_SESSION['mensaje']);
unset($_SESSION['tipo']);
endif;
?>

</body>
</html>