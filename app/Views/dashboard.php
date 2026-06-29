<?php
$titulo = "Dashboard";
require_once "../app/Views/layouts/header.php";
require_once "../app/Views/layouts/navbar.php";
?>

<div class="space-y-6">

    <!-- Título -->
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Resumen General</h1>
        <p class="text-sm text-slate-500">Panel principal del sistema</p>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Inversiones -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Inversiones</p>
                    <h2 class="text-3xl font-bold text-slate-800">12</h2>
                </div>
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-building text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Fondos -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Fondos</p>
                    <h2 class="text-3xl font-bold text-slate-800">3</h2>
                </div>
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-wallet2 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Ejecución -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Ejecución %</p>
                    <h2 class="text-3xl font-bold text-slate-800">31%</h2>
                </div>
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-graph-up text-xl"></i>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require_once "../app/Views/layouts/footer.php"; ?>