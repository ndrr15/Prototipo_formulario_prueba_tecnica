<?php
setlocale(LC_TIME, "Spanish");
date_default_timezone_set("America/Bogota");
define('DS', DIRECTORY_SEPARATOR);
define('PATH_BASE', str_replace('\\', '/', dirname(__FILE__)));
define('PATH_BASE_FM', str_replace('\\', '/', dirname(__FILE__)));
set_time_limit(0);
$rootdir    	= PATH_BASE.DS;
$filedir		= $rootdir."files".DS."docs".DS."";	 				// Directorio de Archivos Adjuntos
$clsdir 		= $rootdir."cls".DS;      							// Directorio de Clases
$includedir 	= $rootdir."inc".DS; 								// Directorio de Librerias de Terceros
$imagedir		= $rootdir."img".DS;								// Directorio de Imagenes
$libsdir	    = $rootdir."libs".DS;								// Directorio de Librerias Creadas
$notierror 	= 1;

/* CONFIGURACION BASE DE DATOS PRINCIPAL*/
$hostbd = "LOCALHOST:1521/xe";
$tipo_server = "oracle";
$connection_string = $hostbd;
$userbd_oci = 'PRUEBAS';
$passwd_oci = 'tkoxmtiymtk';

define("SMARTY_DIR", $includedir . "smarty" . DS . "libs" . DS);
require(SMARTY_DIR . "Smarty.class.php");
$smarty = new Smarty();
$smarty->template_dir =  $rootdir . "html" . DS;
$smarty->compile_dir  =  $rootdir . "html_c" . DS;
$smarty->config_dir   =  $rootdir . DS . "css" . DS;
$smarty->cache_dir    =  $rootdir . "cache" . DS;
$smarty->compile_check = "true";

function register_globals($order = 'egpfcs')
	{
		global $reg_glob;
		if($reg_glob=="off"){
			// define a subroutine
			if(!function_exists('register_global_array'))
			{
				function register_global_array(array $superglobal)
				{
					foreach($superglobal as $varname => $value)
					{
						global $$varname;
						$$varname = $value;
					}
				}
			}
			
			$order = explode("\r\n", trim(chunk_split($order, 1)));
			foreach($order as $k)
			{
				switch(strtolower($k))
				{
					case 'e':    register_global_array($_SESSION);    break;
					case 'g':    register_global_array($_GET);        break;
					case 'p':	 register_global_array($_POST);      break;
					case 'f':	 register_global_array($_FILES);     break;
					case 'c':    register_global_array($_COOKIE);    break;
					case 's':    register_global_array($_SERVER);    break;
				}
			}
		}
	}