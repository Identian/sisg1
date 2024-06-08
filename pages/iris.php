<?php
$userpostgres 		= "postgres";
$passwordpostgres 	= "postgres";
$dbpostgres			= "SNR";
$portpostgres 		= "5432";
$hostpostgres 		= "192.168.10.22";


$conexionpostgres = pg_pconnect("host=" . $hostpostgres . " port=" . $portpostgres . " dbname=" . $dbpostgres . " user=" . $userpostgres . " password=" . $passwordpostgres . "") or die("No se ha podido conectar");


function GetSQLValueString($valor, $info) {
	return $valor;
}


function siguienteiris($tipo, $anoiris)
{
$query = "SELECT codigo FROM correspondencia where codigo like '%$tipo%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
//$num_resultados = pg_num_rows ($resultado);
 $val = pg_fetch_result($resultado, 0, 0);
   $info3iris = explode($anoiris.$tipo, $val);
    $info4iris = intval($info3iris[1]);
    $info5iris = $info4iris + 1;
    $info6iris = trim(substr('000000' . $info5iris, -6));
    $radicado = 'SNR'.$anoiris.$tipo.$info6iris;
  pg_free_result($resultado);
  return $radicado;
}

function iris($id_tipo_correspondencia,
  $referencia,
  $id_tipo_documento,
  $de,
  $deint,
  $para,
  $paraint,
  $asunto_correspondencia,
  $descripcion_correspondencia,
  $ruta_archivo,
  $info
) {

  if ('ER' == $id_tipo_correspondencia) {
    $recibida = 'true';
    $interno = 'false';
    $idestado = '8';
  } else if ('IE' == $id_tipo_correspondencia) {
    $recibida = 'false';
    $interno = 'true';
    $idestado = '20';
  } else if ('EE' == $id_tipo_correspondencia) {
    $recibida = 'false';
    $interno = 'false';
    $idestado = '15';
  } else {
    exit;
  }

  $fechairis = date("Y-m-d H:i:s");
  $fechaenvio = date("Y-m-d ") . '00:00:00';
  $string = strip_tags($descripcion_correspondencia);
  $textoiris = $asunto_correspondencia . ': ' . $string . '';
  $anoiris = date("Y");
  $radicado_salida = siguienteiris($id_tipo_correspondencia, $anoiris);

  $Insertpg = "INSERT INTO correspondencia (
      idcorreoprioridad, 
      idtipodocumento, 
      codigo, 
      referencia, 
      asunto, 
      idestado, 
      idcorreovia, 
      recibida, 
      interna, 
      deint, 
      de, 
      paraint, 
      para,  
      folios, 
      anexos, 
      contenido, 
      fechaenvio, 
      fecharecepcion, 
      descripcion, 
      creado, 
      fcreado) VALUES (1, " . $id_tipo_documento . ", '" . $radicado_salida . "', '" . $referencia . "', 
  '" . $asunto_correspondencia . "', " . $idestado . ", 3, " . $recibida . ", " . $interno . ", '5, " . $deint . "', '" . $de . ", [USUARIO]', '5," . $paraint . " ', '" . $para . " / ', 1, 1, 1, '" . $fechaenvio . "', '" . $fechairis . "', '" . $textoiris . "', " . $deint . ", '" . $fechairis . "')";

  $resultadopg = pg_query($Insertpg); 
	
	
	return $radicado_salida;
 

}


$anoiris=date("Y");
echo siguienteiris('ER', $anoiris)

?>