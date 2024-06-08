<?php

  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	   
$id_tipo_correspondencia='IE';	  
$id_tipo_documento='305'; 

$recibida='true';
$interno='false';	
$idestado=20;
$ruta_archivo = '1-'.$_SESSION['snr'].'-'.date("YmdGis");

	 
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.$id_tipo_correspondencia;
$query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
 }






$info3iris=explode($anoiris.$id_tipo_correspondencia, $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicado_salida='SNR'.$anoiris.$id_tipo_correspondencia.$info6iris;





$fechairis=date("Y-m-d H:i:s");



$fechaenvio=date("Y-m-d ").'00:00:00';

/*
$textoiris4=strip_tags('Cuenta de cobro'); //$_POST["descripcion_correspondencia"];

$string = preg_replace("/[\r\n|\n|\r]+/", " ", $textoiris4);
*/
$textoiris='Cuenta de cobro '.$namecontratista;



$consultab = sprintf("INSERT INTO correspondencia (
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
fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString('1', "text"), 
GetSQLValueString($id_tipo_documento, "text"), 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString('GCC - '.$cedulacontratista.'', "text"), 
GetSQLValueString('CUENTA DE COBRO '.$namecontratista.'', "text"), 
GetSQLValueString($idestado, "text"), 
GetSQLValueString(3, "int"), 
GetSQLValueString($recibida, "text"), 
GetSQLValueString($interno, "text"), 
GetSQLValueString('5,1642 ', "text"), 
GetSQLValueString('PERSONA NATURAL/'.$namecontratista.' [USUARIO]', "text"), 
GetSQLValueString('5,1600 ', "text"),   //1600	P-CUENTAS	P-CUENTAS GRUPO PRESUPUESTO
GetSQLValueString('P-CUENTAS GRUPO PRESUPUESTO / ', "text"), 
GetSQLValueString('2', "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechaenvio, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris, "text"),
GetSQLValueString('1642', "text"),
GetSQLValueString($fechairis, "text"));




$resultado = pg_query ($consultab);
pg_free_result($resultado);
pg_close($conexionpostgresql); 




  }
  
  ?>
  