<?php

$titulo = "Dashboard";
require_once "../app/Views/layouts/header.php";
require_once "../app/Views/layouts/navbar.php";

?>

<div class="container py-4">

    <h4 class="mb-4">Resumen General</h4>

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Inversiones</h6>
                    <h3>12</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Fondos</h6>
                    <h3>3</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Ejecución %</h6>
                    <h3>31%</h3>
                </div>
            </div>
        </div>

    </div>

</div>

<?php

require_once "../app/Views/layouts/footer.php";
