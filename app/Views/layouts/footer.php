</div>

<footer class="footer">

    <div class="container">

        <span>
            © <?= date('Y') ?> Roman UI
        </span>

    </div>

</footer>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Query -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JS Global -->
<script src="<?= BASE_URL ?>assets/js/app.js"></script>

<!-- JS de cada módulo -->
<?php if (isset($js)): ?>
    <script src="<?= BASE_URL ?>assets/js/<?= $js ?>"></script>
<?php endif; ?>

<!-- 🔥 MENSAJE GLOBAL (AQUÍ VA EL ALERT) -->
<?php if (isset($_SESSION['mensaje'])): ?>

    <script>
        Swal.fire({
            icon: '<?= $_SESSION['tipo'] ?>',
            title: '<?= addslashes($_SESSION['mensaje']) ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>

<?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo']);
endif;
?>

</body>

</html>