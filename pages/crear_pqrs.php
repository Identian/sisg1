<?php
if ((isset($_POST["nombre_movimiento_pqrs"])) && ($_POST["nombre_movimiento_pqrs"] != "")) {

$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.'ER';
$query = "SELECT idcorrespondencia, codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
$idcorrespondencia=$row['idcorrespondencia'];
 }

//echo $info2iris;


$info3iris=explode($anoiris.'ER', $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicadon='SNR'.$anoiris.'ER'.$info6iris;

$idcorrespondenciaf=$idcorrespondencia+1;

//echo '<br>'.$radicado;


$textoiris=strip_tags($_POST["nombre_movimiento_pqrs"]);

$fecha_radicado=$_POST["fecha_radicado"].' '.$_POST["hora_radicado"];
$fechairis=date("Y-m-d H:i:s");

$consultab = sprintf("INSERT INTO correspondencia (idcorreoprioridad, idtipodocumento, codigo, referencia, asunto, 
idestado, idcorreovia, recibida, interna, deint, de, paraint, para, folios, anexos, contenido, fechaenvio, fecharecepcion, 
descripcion, creado, fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString('1', "text"), 
GetSQLValueString('334', "text"), 
GetSQLValueString($radicadon, "text"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString('Traslado de PQRSD a Notaria', "text"), 
GetSQLValueString('8', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('ARCHIVO SDN VC', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('ARCHIVO SDN VC', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris, "text"),
GetSQLValueString('1972', "text"),
GetSQLValueString($fechairis, "text"));


$resultado = pg_query ($consultab);


  pg_free_result($resultado);
  pg_close($conexionpostgresql);  

  }
  


$insertSQL41 = sprintf("INSERT INTO solicitud_pqrs (id_estado_solicitud, id_tipo_oficina2, id_canal_pqrs, id_categoria_pqrs, radicado, 
fecha_radicado, id_ciudadano, nombre_solicitud_pqrs, pqrs_direccionada, descripcion_solicitud, estado_solicitud_pqrs, de_certicamara) 
VALUES (%s, %s, %s, %s, %s, now(), %s, %s %s, %s, %s, %s)", 
GetSQLValueString(2, "int"), 
GetSQLValueString(3, "int"),
GetSQLValueString(1, "int"), 
GetSQLValueString(2, "int"), 
GetSQLValueString($radicadon, "text"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString('Traslado de PQRSD a Notaria', "text"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["nombre_movimiento_pqrs"], "text"),
GetSQLValueString(1, "int"),
GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL41, $conexion);
//echo $insertSQL41;



$actualizar = mysql_query("SELECT id_solicitud_pqrs FROM solicitud_pqrs WHERE radicado='$radicadon' and estado_solicitud_pqrs=1 limit 1", $conexion);
$row1b = mysql_fetch_assoc($actualizar);
$idpqrs = $row1b['id_solicitud_pqrs'];



$actualizarbb = mysql_query("SELECT id_categoria_oac, id_clase_oac, id_tema_oac, id_motivo_oac FROM solicitud_pqrs, clasificacion_pqrs WHERE solicitud_pqrs.id_solicitud_pqrs=clasificacion_pqrs.id_solicitud_pqrs and radicado='$radicado' and estado_clasificacion_pqrs=1 and estado_solicitud_pqrs=1 limit 1", $conexion);
$row1 = mysql_fetch_assoc($actualizarbb);



$insertSQL42 = sprintf("INSERT INTO clasificacion_pqrs (id_solicitud_pqrs, nombre_clasificacion_pqrs, id_categoria_oac, id_clase_oac, id_tema_oac, id_motivo_oac, fecha_clasificacion, id_funcionario, estado_clasificacion_pqrs) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($idpqrs, "int"), 
GetSQLValueString('x', "text"), 
GetSQLValueString($row1['id_categoria_oac'], "int"),
 GetSQLValueString($row1['id_clase_oac'], "int"), 
 GetSQLValueString($row1['id_tema_oac'], "int"), 
 GetSQLValueString($row1['id_motivo_oac'], "int"), 
 GetSQLValueString($_SESSION['snr'], "int"), 
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL42, $conexion) ;

echo $insertSQL42;



$insertSQL43 = sprintf("INSERT INTO asignacion_pqrs (id_solicitud_pqrs, id_tipo_oficina, id_departamento, codigo_municipio, codigo_oficina, nombre_asignacion_pqrs, fecha_asignacion, id_consolidar, estado_asignacion_pqrs, marca_retorno) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($idpqrs, "int"), 
GetSQLValueString(3, "int"),
 GetSQLValueString(11, "int"), 
 GetSQLValueString(001, "int"), 
 GetSQLValueString($_POST["id_notaria_mov"], "int"), 
 GetSQLValueString('Traslado de PQRS a Notaria', "text"), 
 GetSQLValueString(0, "int"), 
 GetSQLValueString(1, "int"),
 GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL43, $conexion);

echo $insertSQL43;

$funnotar=notariotitular($_POST["id_notaria_mov"]);

$insertSQLdd85 = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, 
estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($funnotar, "int"),
GetSQLValueString($idpqrs, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_SESSION['snr'], "int"));  
$Resultdd8 = mysql_query($insertSQLdd85, $conexion);
echo $insertSQLdd85;

/*
if (isset($_POST["documentoscert"]) && ""!=$_POST["documentoscert"]) {

$arraydoc=explode("%", $_POST["documentoscert"]);
	
foreach($arraydoc as $doc4) {

if (""!=$doc4) {

$seguridad=md5($radicado22.'.pdf'.$id_ciudadano);

$insertSQL77 = sprintf("INSERT INTO documento_pqrs (idcorrespondencia, id_ciudadano, nombre_documento_pqrs, id_solicitud_pqrs, id_clase_documento, fecha_subida, url_documento, extension, hash_documento, estado_documento_pqrs) VALUES (%s, %s, %s, %s, %s, now(), %s, %s, %s, %s)", 
GetSQLValueString($idcorrespondenciaf, "int"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString('Importado de certicamara', "text"),
 GetSQLValueString($uri77, "int"), 
 GetSQLValueString(1, "int"), 
 GetSQLValueString($doc4, "text"), 
 GetSQLValueString('.pdf', "text"), 
 GetSQLValueString($seguridad, "text"),
 GetSQLValueString(1, "int"));
$Result77 = mysql_query($insertSQL77, $conexion) or die(mysql_error());


} else {}
}
}
*/


echo $insertado;
//echo '<meta http-equiv="refresh" content="0;URL=pdf/snr_solicitud.php?q='.$uri77.'" />';


//echo '<meta http-equiv="refresh" content="0;URL=anexos_pqrs&'.$uri77.'.jsp" />';


	
mysql_free_result($select);



} else { }

?>