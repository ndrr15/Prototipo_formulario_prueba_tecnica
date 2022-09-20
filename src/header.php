<?php
include("../entorno.php");
include($libsdir."conexion.php");
ini_set('session.gc_maxlifetime', 14400);
ini_set('session.cookie_lifetime', 14400);
session_start();
register_globals();
$ln = new conexion($hostbd, $userbd, $passbd, $bd, $tipo_server, $puerto_mysql);
$plantilla = 'header.html';
$smarty -> display($plantilla);