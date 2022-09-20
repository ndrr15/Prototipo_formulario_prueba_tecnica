<?php
error_reporting(1);
include "../entorno.php";
include ($libsdir."conexion.php");
$ln = new conexion($hostbd, $userbd, $passbd, $bd, $tipo_server, $puerto_mysql);
session_start();
register_globals();
$jsondata = array();
switch ($_POST['opcion']) {
    case 'addNewEmployee':
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $descripcion = $_POST['descripcion'];
        $area = $_POST['area'];
        $sex = $_POST['sex'];
        $boletin = $_POST['boletin'];
        $validate = validateEmployee($email);
        if ($validate == 1) {
            $error = 1;
            $msg = "El usuario se encuentra registrado";
        } else {
            insertEmployee($fullName, $email, $sex, $area, $boletin, $descripcion);
            $error = 0;
            $msg = "El usuario se ha ingresado correctamente";
            $jsondata["msg"] = $msg;
        }
        break;
    case "deleteUsuario":
        $id = $_POST["id"];
        $sql = "delete from EMPLEADO where id = $id";
        $queryDelete = $ln->query($sql);
        break;
    default:
        break;
}
function validateEmployee($email)
{
    global $ln;
    $consultaValidate = "SELECT COUNT(*) as COUNT FROM EMPLEADO WHERE email = '$email'";
    $queryValidate = $ln->query($consultaValidate);
    if ($row = $ln->fetch($queryValidate)) {
        if ($row['COUNT'] != 0) {
            return 1;
        }
    }
    return 0;
}
function insertEmployee($fullName, $email, $sex, $area, $boletin, $descripcion)
{
    global $ln;
    $consultaInsertar = "INSERT INTO EMPLEADO (NOMBRE,
                                                EMAIL, 
                                                SEXO,
                                                AREA_ID,
                                                BOLETIN,
                                                DESCRIPCION)
                                    VALUES ('$fullName', '$email', '$sex', $area, $boletin,'$descripcion')";
    $insertarUsuario = $ln->query($consultaInsertar);
}
$jsondata["error"] = $error;
$jsondata["msg"] = $msg;
echo json_encode($jsondata);
