<?php

/*
|--------------------------------------------------------------------------
| CONFIGURACIÓN GENERAL
|--------------------------------------------------------------------------
*/

define("BASE_URL", "/esttari/public/");

/*
|--------------------------------------------------------------------------
| EMPRESA
|--------------------------------------------------------------------------
*/

define("EMPRESA_NOMBRE", "EPS ILO S.A.");
define("EMPRESA_RUC", "20154469941"); // Verificar
define("EMPRESA_SIGLAS", "EPS ILO");
define("EMPRESA_DIRECCION", "Ilo, Moquegua");
define("EMPRESA_TELEFONO", "(053) XXXXXXX");
define("EMPRESA_EMAIL", "mesa.partes@epsilo.com.pe");
define("EMPRESA_WEB", "https://www.epsilo.com.pe");

/*
|--------------------------------------------------------------------------
| SISTEMA
|--------------------------------------------------------------------------
*/

define("SISTEMA_NOMBRE", "Sistema de Gestión de Inversiones");
define("SISTEMA_SIGLAS", "SGI");
define("SISTEMA_VERSION", "1.0.0");
define("SISTEMA_DESARROLLADOR", "Roman Acero");
define("SISTEMA_ENTIDAD", EMPRESA_NOMBRE);

/*
|--------------------------------------------------------------------------
| DOCUMENTOS
|--------------------------------------------------------------------------
*/

define("DOCUMENTO_MONEDA", "S/");
define("DOCUMENTO_ZONA_HORARIA", "America/Lima");

date_default_timezone_set(DOCUMENTO_ZONA_HORARIA);
