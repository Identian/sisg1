<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

function mese($argk)
{
if ('01'==$argk) { 
$ar23r = 'Enero';
} else if ('02'==$argk) {
$ar23r = 'Febrero';
} else if ('03'==$argk) {
$ar23r = 'Marzo';
} else if ('04'==$argk) {
$ar23r = 'Abril';
} else if ('05'==$argk) {
$ar23r = 'Mayo';
} else if ('06'==$argk) {
$ar23r = 'Junio';
} else if ('07'==$argk) {
$ar23r = 'Julio';
} else if ('08'==$argk) {
$ar23r = 'Agosto';
} else if ('09'==$argk) {
$ar23r = 'Septiembre';
} else if ('10'==$argk) {
$ar23r = 'Octubre';
} else if ('11'==$argk) {
$ar23r = 'Noviembre';
} else if ('12'==$argk) {
$ar23r = 'Diciembre';
} else {
$ar23r = '';
}
return $ar23r;
}

$anom=date("Y");
$mesm=date("m");
$diam=date("d");


$parametro=$_POST['option'];
$actualizar5 = mysql_query("SELECT * FROM modelo_respuesta_pqrs WHERE id_modelo_respuesta_pqrs='$parametro' and estado_modelo_respuesta_pqrs=1 limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {





$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';


   echo ''.$row15['modelo_respuesta_pqrs'].'';




} else {}
 mysql_free_result($actualizar5);
} else {}
?>