<?php
include "header.php";
$plantilla = "crearUsuario.html";
$queryConsultaBDAreas = consultaBaseDatos('AREAS');
while ($row = $ln->fetch($queryConsultaBDAreas)) {
    $smarty->append("DataArea", array(
        "NOMBREAREA" => $row['NOMBRE'],
        "IDAREA" => $row['ID']
    ));
}
$queryConsultaBDRoles = consultaBaseDatos('ROLES');
while ($row = $ln->fetch($queryConsultaBDRoles)) {
    $smarty->append("DataRoles", array(
        "NOMBREROLES" => $row['NOMBRE'],
        "IDROLES" => $row['ID']
    ));
}
$smarty->display($plantilla);

function consultaBaseDatos($tabla){
    global $ln;
    $consultaBD = "SELECT id as ID, nombre as NOMBRE FROM $tabla";
    return $ln->query($consultaBD);
}