<?php

// $hostname_conexion = "192.168.80.11";
// $database_conexion = "sisg";
// $username_conexion = "sisg";
// $password_conexion = "C0l0mb1@19*";


$hostname_conexion = "192.168.80.175";
$database_conexion = "sisg";
$username_conexion = "root";
$password_conexion = "M01ses8o8o";

// $hostname_conexion2 = "192.168.80.12";
//$hostname_conexion2 = "localhost";

$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion);
mysql_select_db($database_conexion, $conexion);

$userpostgres 		= "postgres";
$passwordpostgres 	= "postgres";
$dbpostgres			= "SNR";
$portpostgres 		= "5432";
$hostpostgres 		= "192.168.10.22";

$conexionpostgres 	= "host=".$hostpostgres." port=".$portpostgres." dbname=".$dbpostgres." user=".$userpostgres." password=".$passwordpostgres."";
$ftp_server = "192.168.10.22";
$ftp_user_name = "SISG";
$ftp_user_pass = "SISG2018";
$directoryftp  = 'documentos/';

$ftp_server = "192.168.10.22";
$ftp_user_name2 = "usuarioftpdesian";
$ftp_user_pass2 = "claveftpdesian";



if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



$nousuario='<script type="text/javascript">swal(" ERROR !", " No existe la cuenta.. !", "error");</script>';

$claveinvalida='<script type="text/javascript">swal(" ERROR !", " Clave incorrecta. !", "error");</script>';

$operaioninvalida='<script type="text/javascript">swal(" ERROR !", " Operación invalida. !", "error");</script>';

$repetido='<script type="text/javascript">swal(" ERROR !", " El registro YA existe en el sistema. !", "error");</script>';

$insertado= '<script type="text/javascript">swal(" OK !", " Registrado Correctamente  !", "success");</script>';

$emailenviado= '<script type="text/javascript">swal(" OK !", " E-mail enviado Correctamente. !", "success");</script>';

$actualizado= '<script type="text/javascript">swal(" OK !", " Registro actualizado Correctamente. !", "success");</script>';

$error= '<script type="text/javascript">swal(" ERROR !", " NO registrado Contacte a su administrador. !", "error");</script>';

$hecho= '<script type="text/javascript">swal(" OK !", " Registro  Cerrado Correctamente. !", "success");</script>';

$usuariorepetido = '<script type="text/javascript">swal(" ERROR !", " La identificación ó correo electrónico introducido, ya existe en el sistema. !", "error");</script>';

$nopermitido='<script type="text/javascript">swal(" ERROR !", " Operación no permitida !", "error");</script>';

$doc_no_tipo='<script type="text/javascript">swal(" ERROR !", " El formato del archivo adjunto no es permitido. !", "error");</script>';

$doc_tam= '<script type="text/javascript">swal(" ERROR !", " El archivo Supera los 4 Megas Permitidos. !", "error");</script>';

$okgarantia = '<script type="text/javascript">swal(" OK !", " Enviado Correctamente  !", "success");</script>';

$fechainiciomayor ='<script type="text/javascript">swal(" ERROR!", " La fecha de inicio NO puede ser posterior fecha final IVA !", "error"); </script>';

$fecharepetida='<script type="text/javascript">swal(" ERROR!", " Este periodo Ya se encuentra Registrado !", "error"); </script>';

$facturarepetida='<script type="text/javascript">swal(" ERROR!", " Este periodo Ya se encuentra Registrado !", "error"); </script>';

$anulada='<script type="text/javascript">swal(" ANULADA!", " Factura Anulada Correctamente !", "warning"); </script>';

$expensacerrada= '<script type="text/javascript">swal(" OK !", " La Tarifa de Vigilancia Ha sido Cerrada Correctamente  !", "success");</script>';

$expensaaprobada= '<script type="text/javascript">swal(" OK !", " La Tarifa de Vigilancia Ha sido Aprobada Correctamente  !", "success");</script>';

$documentocargado= '<script type="text/javascript">swal(" OK !", " Se ha Cargado el Documento Correctamente   !", "success");</script>';


$masivocargado='<script type="text/javascript">swal(" OK !", " Archivo cargado. !", "success");</script>';


$faltandatos = '<script type="text/javascript">swal(" ADVERTENCIA !", " Reporte los datos Faltantes. !", "error");</script>';

$causante_doble = '<script type="text/javascript">swal(" ADVERTENCIA !", " Causante Reportado en otra Notaria. !", "warning");</script>';




$realdate= date("Y-m-d");
$anoactual=date("y");
$anoactualcompleto=date("Y");
//$realdate= "2014-02-24";


function minu($arg)
{
$ar23=ucwords(strtolower($arg));
return $ar23;
}




function GetUserIP2() {
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];
        return $_SERVER["REMOTE_ADDR"];
    }
    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');
    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');
    return getenv('REMOTE_ADDR');
}
$iplocal=GetUserIP2();




function deiris($deiris)
{
$deirisa= explode("[", $deiris);
$deirisb=$deirisa[0];
$deirisc= explode("/", $deirisb);
$deirisd=$deirisc[0];
$deirise=$deirisc[1];
$deirisf=$deirisd.'</td><td>'.$deirise;
return $deirisf;
}




function limpfecha($argu)
{
if (!isset($argu) or ("0000-00-00"==$argu)) {
$argum = "";
} else {
$argum =$argu;
}
return $argum;
}


function retiro($nacim)
{
$separacion= explode("-", $nacim);
$anon=$separacion[0];
$mesn=$separacion[1];
$dian=$separacion[2];
$masedad=$anon+65;
$retiro=$masedad.'-'.$mesn.'-'.$dian;
return $retiro;
}


function limpiar($ar)
{
$ar3=strtolower($ar);
$data = array("<a href=", "<script", "</script>","<meta", "onload=", "onmouseover=", "onerror=", "j&#X41vascript", "onmouseout=", "onrelease=", "onchangue=", "onclick=", "onunload=", "onmousedown=", "onmousemove=", "ondblclick=", "onkeydown=", "onkeypress=", "onkeyup=", "onfocus=", "onblur=", "onsubmit=", "onabort=", "ondragdrop=", "onselect=", "<input", "<textarea", "<select", "<frame", "<iframe", "<form", "%3c", "%3e", "<img", "javascript:", "'");
$counta = 0;
foreach ($data as $substring) {
$counta += substr_count($ar3, $substring);
}
if (0<$counta){
$ar2=str_replace($data, "", $ar3);
} else {
$ar2=$ar;
}
return $ar2;
}






$ano= date("Y");
$ano1=substr($ano, -1, 1);
$mes= date("m");
if ("01"==$mes){$mes1="A";}
elseif ("02"==$mes){$mes1="E";}
elseif ("03"==$mes){$mes1="I";}
elseif ("04"==$mes){$mes1="U";}
elseif ("05"==$mes){$mes1="1";}
elseif ("06"==$mes){$mes1="2";}
elseif ("07"==$mes){$mes1="3";}
elseif ("08"==$mes){$mes1="4";}
elseif ("09"==$mes){$mes1="5";}
elseif ("10"==$mes){$mes1="6";}
elseif ("11"==$mes){$mes1="7";}
elseif ("12"==$mes){$mes1="8";}
$dia= date("d");
if ("01"==$dia){$dia1="A";}
elseif ("02"==$dia){$dia1="B";}
elseif ("03"==$dia){$dia1="C";}
elseif ("04"==$dia){$dia1="D";}
elseif ("05"==$dia){$dia1="E";}
elseif ("06"==$dia){$dia1="F";}
elseif ("07"==$dia){$dia1="G";}
elseif ("08"==$dia){$dia1="H";}
elseif ("09"==$dia){$dia1="I";}
elseif ("10"==$dia){$dia1="J";}
elseif ("11"==$dia){$dia1="K";}
elseif ("12"==$dia){$dia1="L";}
elseif ("13"==$dia){$dia1="M";}
elseif ("14"==$dia){$dia1="N";}
elseif ("15"==$dia){$dia1="P";}
elseif ("16"==$dia){$dia1="Q";}
elseif ("17"==$dia){$dia1="R";}
elseif ("18"==$dia){$dia1="S";}
elseif ("19"==$dia){$dia1="T";}
elseif ("20"==$dia){$dia1="U";}
elseif ("21"==$dia){$dia1="V";}
elseif ("22"==$dia){$dia1="W";}
elseif ("23"==$dia){$dia1="X";}
elseif ("24"==$dia){$dia1="Y";}
elseif ("25"==$dia){$dia1="Z";}
elseif ("26"==$dia){$dia1="1";}
elseif ("27"==$dia){$dia1="2";}
elseif ("28"==$dia){$dia1="3";}
elseif ("29"==$dia){$dia1="4";}
elseif ("30"==$dia){$dia1="5";}
elseif ("31"==$dia){$dia1="6";}
$hora= date("H");
if ("01"==$hora){$hora1="A";}
elseif ("02"==$hora){$hora1="B";}
elseif ("03"==$hora){$hora1="C";}
elseif ("04"==$hora){$hora1="D";}
elseif ("05"==$hora){$hora1="E";}
elseif ("06"==$hora){$hora1="F";}
elseif ("07"==$hora){$hora1="G";}
elseif ("08"==$hora){$hora1="H";}
elseif ("09"==$hora){$hora1="I";}
elseif ("10"==$hora){$hora1="J";}
elseif ("11"==$hora){$hora1="K";}
elseif ("12"==$hora){$hora1="L";}
elseif ("13"==$hora){$hora1="M";}
elseif ("14"==$hora){$hora1="N";}
elseif ("15"==$hora){$hora1="P";}
elseif ("16"==$hora){$hora1="Q";}
elseif ("17"==$hora){$hora1="R";}
elseif ("18"==$hora){$hora1="S";}
elseif ("19"==$hora){$hora1="T";}
elseif ("20"==$hora){$hora1="U";}
elseif ("21"==$hora){$hora1="V";}
elseif ("22"==$hora){$hora1="W";}
elseif ("23"==$hora){$hora1="X";}
elseif ("24"==$hora){$hora1="Y";}
elseif ("00"==$hora){$hora1="Z";}
$minuto= date("i");



/*
if (01==$minuto){$minuto1="A";}
elseif (02==$minuto){$minuto1="B";}
elseif (03==$minuto){$minuto1="C";}
elseif (04==$minuto){$minuto1="D";}
elseif (05==$minuto){$minuto1="E";}
elseif (06==$minuto){$minuto1="F";}
elseif (07==$minuto){$minuto1="G";}
elseif (08==$minuto){$minuto1="H";}
elseif (09==$minuto){$minuto1="I";}
elseif (10==$minuto){$minuto1="J";}
elseif (11==$minuto){$minuto1="K";}
elseif (12==$minuto){$minuto1="L";}
elseif (13==$minuto){$minuto1="M";}
elseif (14==$minuto){$minuto1="N";}
elseif (15==$minuto){$minuto1="O";}
elseif (16==$minuto){$minuto1="P";}
elseif (17==$minuto){$minuto1="Q";}
elseif (18==$minuto){$minuto1="R";}
elseif (19==$minuto){$minuto1="S";}
elseif (20==$minuto){$minuto1="T";}
elseif (21==$minuto){$minuto1="U";}
elseif (22==$minuto){$minuto1="V";}
elseif (23==$minuto){$minuto1="W";}
elseif (24==$minuto){$minuto1="X";}
elseif (25==$minuto){$minuto1="Y";}
elseif (26==$minuto){$minuto1="Z";}
elseif (27==$minuto){$minuto1="1";}
elseif (28==$minuto){$minuto1="2";}
elseif (29==$minuto){$minuto1="3";}
elseif (30==$minuto){$minuto1="4";}
elseif (31==$minuto){$minuto1="5";}
elseif (32==$minuto){$minuto1="6";}
elseif (33==$minuto){$minuto1="7";}
elseif (34==$minuto){$minuto1="8";}
elseif (35==$minuto){$minuto1="9";}
elseif (36==$minuto){$minuto1="0";}
elseif (37==$minuto){$minuto1="-";}
elseif (38==$minuto){$minuto1="_";}
elseif (39==$minuto){$minuto1="%";}
elseif (40==$minuto){$minuto1="&";}
elseif (41==$minuto){$minuto1="#";}
elseif (42==$minuto){$minuto1="?";}
elseif (43==$minuto){$minuto1="¿";}
elseif (44==$minuto){$minuto1="+";}
elseif (45==$minuto){$minuto1="<";}
elseif (46==$minuto){$minuto1=">";}
elseif (47==$minuto){$minuto1="=";}
elseif (48==$minuto){$minuto1="(";}
elseif (49==$minuto){$minuto1=")";}
elseif (50==$minuto){$minuto1="$";}
elseif (51==$minuto){$minuto1="11";}
elseif (52==$minuto){$minuto1="12";}
elseif (53==$minuto){$minuto1="13";}
elseif (54==$minuto){$minuto1="14";}
elseif (55==$minuto){$minuto1="15";}
elseif (56==$minuto){$minuto1="16";}
elseif (57==$minuto){$minuto1="17";}
elseif (58==$minuto){$minuto1="18";}
elseif (59==$minuto){$minuto1="19";}
elseif (60==$minuto){$minuto1="20";}
*/
$aleatorio = chr(rand(ord("A"), ord("Z")));
$maleatorio = chr(rand(ord("A"), ord("Z")));
$identi = $ano1.$mes1.$dia1.$hora1.$minuto.$aleatorio.$maleatorio;






?>