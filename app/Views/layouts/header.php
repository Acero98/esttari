<!DOCTYPE html>
<html lang="es">

<head>
    <!-- =======================================
        METADATOS
    ======================================== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo ?? 'SSI'; ?></title>
    <meta
        name="description"
        content="Sistema de Gestión de Inversiones - Roman UI">
    <meta
        name="theme-color"
        content="#0f172a">
    <meta
        name="mobile-web-app-capable"
        content="yes">
    <meta
        name="apple-mobile-web-app-status-bar-style"
        content="default">
    <!-- =======================================
        FUENTE
    ======================================== 
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com">
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">-->
    <!-- Fuente -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/inter.css">
    <!-- =======================================
        ICONOS
    ======================================== 
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">-->

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/bootstrap-icons.min.css">
    <!-- =======================================
        SIMPLE DATATABLES
    ======================================== 
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.min.css">-->

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/simple-datatables.css">
    <!-- =======================================
        ALPINE JS
    ======================================== 
    <script
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
        defer></script>-->
    <script
        defer
        src="<?= BASE_URL ?>assets/js/alpine.min.js"></script>
    <!-- Select2 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">-->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/select2.min.css">
    <!-- Tom Select
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">-->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/tom-select.css">
    <!-- =======================================
        FAVICON
    ======================================== -->
    <link
        rel=" icon"
        type="image/png"
        href="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png">
    <link
        rel="apple-touch-icon"
        href="<?= BASE_URL ?>assets/img/OlivaTech-Circulo.png">
    <!-- =======================================
        ESTILOS
    ======================================== -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/output.css">
</head>

<body
    class="
            min-h-screen
            bg-gradient-to-br
            from-slate-100
            via-slate-50
            to-blue-50
            text-slate-800
            antialiased
            flex
            flex-col
            overflow-x-hidden
        "
    style="font-family:'Inter',sans-serif;">