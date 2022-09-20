<?php
class conexion
{
    public $ln = false;
    public $userbd;
    public $passwd;
    public $hostbd;
    public $conectado = false;
    public $tipo_server;
    public function __construct($userbd, $passwd, $hostbd,  $tipo)
    {
        $this->tipo_server = $tipo;
        $this->hostbd = $hostbd;
        $this->userbd = $userbd;
        $this->passwd = $passwd;
        $this->conectar();
    }
    public function conectar()
    {
        if ($this->tipo_server == "mysql") {
            try {
                //set_error_handler(create_function('errando', "throw new Exception(); return true;"));
                $conecta = mysqli_connect($this->servidor, $this->usuario, $this->password, $this->basedatos);
            } catch (Exception $e) {
                $this->msgbox("ERROR:", $e->getMessage());
                exit;
            }
            if (!$conecta) {
                die('Error de Conexión (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
            } else {
                $this->ln = $conecta;
                //$this->seleccionardb();
            }
            if (!mysqli_set_charset($this->ln, "utf8")) {
                printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($this->ln));
                exit();
            }
        }
        $this->conectado = $conecta;
    }
    public function query($sql, $echo = 0, $continuar = 0)
    {
        if ($this->conectado == true) {
            if ($echo) {
                echo "\n<div class='alert alert-success'>$sql</div>\n";
            }
            if ($this->tipo_server == "mysql") {
                try {
                    $consulta = mysqli_query($this->ln, "$sql");
                } catch (Exception $e) {
                    $this->msgbox("ERROR:", $e->getMessage(), 0);
                    exit;
                }
                if (!$consulta) {
                    $this->msgbox("ERROR DE MySQL : ", mysqli_connect_errno() . " " . mysqli_connect_error() . "<br>Consulta : $sql");
                    exit;
                }
            }
        } else {
            $this->msgbox("ERROR:", "NO HAY CONEXION CON LA BD (" . $this->servidor . "," . $this->basedatos . ")");
            exit;
        }
        return $consulta;
    }
    public function fetch($Consulta)
    {
        if ($Consulta) {
            if ($this->tipo_server == "mysql") {
                return mysqli_fetch_array($Consulta);
            }
        }
    }
    public function msgbox($titulo, $mensaje, $tipo = 0)
    {

        echo "<center><table border=1><tr bgcolor='#000000'><th><font color='#ffffff'>$titulo :</font></th></tr><tr bgcolor='#ff5555'><td>" . $mensaje . "</td></tr></table></center>";
    }
}
