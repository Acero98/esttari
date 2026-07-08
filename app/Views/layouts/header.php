<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $titulo ?? 'Roman UI'; ?></title>

    <!-- Bootstrap Icons (puedes mantenerlo) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.min.css">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png">

    <!-- TU CSS PRINCIPAL (TAILWIND COMPILADO) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/output.css">

</head>

<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">