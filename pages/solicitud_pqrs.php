<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }

$actualizar6 = mysql_query("SELECT valor FROM configuracion WHERE id_configuracion=14 limit 1", $conexion) or die(mysql_error());
$row16 = mysql_fetch_assoc($actualizar6);
$valor = $row16['valor'];

if (0==$valor) { ?>
<div class="row">
<div class="col-md-12" >
<div class="panel panel-default">
  <div class="panel-body">
<h4>El sistema de gestión documental se encuentra en mantenimiento. Lamentamos el inconveniente.</h4>
<br>		
</div>
</div>
</div>
</div>
<?php
} else {
	
$nump89=privilegios(89,$_SESSION['snr']);

$consultaghyyoo = mysql_query("SELECT count(id_asignacion_pqrs_funcionario) as sigrupo FROM asignacion_pqrs_funcionario where id_funcionario=".$_SESSION['snr']." and id_solicitud_pqrs=".$id." and estado_asignacion_pqrs_funcionario=1 limit 1", $conexion) or die(mysql_error());
$row1ghyyoo = mysql_fetch_assoc($consultaghyyoo);
$sigrupo=intval($row1ghyyoo['sigrupo']);


if (isset($_POST['id_ciudadanopqrs']) && ""!=$_POST['id_ciudadanopqrs'] && (1==$_SESSION['rol'] OR 0<$nump89)) {
	$idciudadanopqrs=intval($_POST['id_ciudadanopqrs']);
$updateSQL77998 = sprintf("UPDATE solicitud_pqrs SET id_ciudadano=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1 and id_estado_solicitud!=5",                  
					  GetSQLValueString($idciudadanopqrs, "int"),
					  GetSQLValueString($id, "int"));
$Result177998 = mysql_query($updateSQL77998, $conexion) ;
 
echo $actualizado;
} else {}



if (isset($_POST['fecha_radicado_corregir']) && ""!=$_POST['fecha_radicado_corregir'] && (1==$_SESSION['rol'] OR 0<$nump89)) {
	$fecha_radicado_corregir=$_POST['fecha_radicado_corregir'];
$updateSQL77998 = sprintf("UPDATE solicitud_pqrs SET fecha_radicado=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1 and id_estado_solicitud!=5",                  
					  GetSQLValueString($fecha_radicado_corregir, "date"),
					  GetSQLValueString($id, "int"));
$Result177998 = mysql_query($updateSQL77998, $conexion) ;
 
echo $actualizado;
} else {}






$querybf = sprintf("SELECT * FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1 order by id_requerir_pqrs desc limit 1"); 
$selectbf = mysql_query($querybf, $conexion);
$rowbf = mysql_fetch_assoc($selectbf);
$totalRowsbf = mysql_num_rows($selectbf);
if (0<$totalRowsbf) { 
$nombre_requerir_pqrs=$rowbf['nombre_requerir_pqrs'];
$respuesta_pre_ciudadano=$rowbf['respuesta_pre_ciudadano'];
} else { }


 if (isset($_POST["correccion_pqrs"]) && ""!=$_POST["correccion_pqrs"]) {
	 
	  if (1==$_POST["seccion"]){
$updateSQL7799 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(2, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) or die(mysql_error());
	  } else {}

$insertSQL = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"), 
GetSQLValueString($_POST["nombre_correccion_pqrs"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(2, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;


$query = sprintf("SELECT correo_funcionario FROM asignacion_pqrs_funcionario, funcionario where  asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and id_solicitud_pqrs=".$id." and estado_asignacion_pqrs_funcionario=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$correosasignados='';
do {
$correosasignados.= $row['correo_funcionario'].',';
	 } while ($row = mysql_fetch_assoc($select));

$correosasignadossi=substr($correosasignados, 0, -1);
$emailu=$correosasignadossi; 
$subject = 'Nueva acción sobre PQRS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una nueva acción sobre una PQRS."; 
$cuerpo .= "<br><br>"; 

 if (1==$_POST["seccion"]){
	 $cuerpo .= "Corregir: ".$_POST["nombre_correccion_pqrs"]; 
	 $cuerpo .= "<br><br>"; 
 } else { }


$cuerpo .= '<br>Puede ver la acción en la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


	 
} else {}	 
mysql_free_result($select);


 } else {}

 
 
 
 
if (isset($_POST["vistob_pqrs"]) && ""!=$_POST["vistob_pqrs"]) {
	 
	 if (1==$_POST["seccion"]){
$updateSQL7799 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(4, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) or die(mysql_error());

	 } else {}

$insertSQL = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"),
GetSQLValueString('<span class="glyphicon glyphicon-ok"></span>', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());




$consultayv = mysql_query("SELECT correo_funcionario FROM asignacion_pqrs_funcionario, funcionario where id_cargo=1 and asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and id_solicitud_pqrs=".$id." and estado_asignacion_pqrs_funcionario=1 limit 1", $conexion) or die(mysql_error());
$row1yv = mysql_fetch_assoc($consultayv);
$nnyv = mysql_num_rows($consultayv);
if (0<$nnyv) {
$emailu=$row1yv['correo_funcionario'];

$subject = 'Visto bueno de PQRS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado un visto bueno a una PQRS."; 
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);



} else {}


echo $insertado;

 } else {}
 
 
 


 
 
 
 if ((isset($_POST["id_tipologiapqrs_notaria"])) && ($_POST["id_tipologiapqrs_notaria"] != "")) { 

$insertSQLi = sprintf("INSERT INTO clasificacionpqrs_dvcn (id_solicitud_pqrs, 
id_tipologiapqrs_notaria, id_tipo_oficina, id_vigilado, 
fecha_clasificacionpqrs_dvcn, estado_clasificacionpqrs_dvcn) 
VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_tipologiapqrs_notaria"], "int"), 
GetSQLValueString($_POST["id_tipo_oficina"], "int"),
GetSQLValueString($_POST["id_vigilado"], "int"),
GetSQLValueString(1, "int"));
$Resulti = mysql_query($insertSQLi, $conexion);
echo $insertado;



} else { }





if ((isset($_POST["nombre_requerir_pqrs"])) && ($_POST["nombre_requerir_pqrs"] != "")) { 
$nombre_requerir_pqrsi=$_POST["nombre_requerir_pqrs"];
$id_requerir_pqrsi=$_POST["id_requerir_pqrs"];
$insertSQLi = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"),
GetSQLValueString('Modificado', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(3, "int"));
$Resulti = mysql_query($insertSQLi, $conexion) or die(mysql_error());
$updateSQL7799i = sprintf("UPDATE requerir_pqrs SET nombre_requerir_pqrs=%s WHERE id_requerir_pqrs=%s and id_solicitud_pqrs=%s and estado_requerir_pqrs=1",                  
					  GetSQLValueString($nombre_requerir_pqrsi, "text"),
					  GetSQLValueString($id_requerir_pqrsi, "int"),
					  GetSQLValueString($id, "int"));
$Result17799i = mysql_query($updateSQL7799i, $conexion) or die(mysql_error());
echo $actualizado;
} else { }






if ((isset($_POST["respuesta_pre_ciudadano"])) && ($_POST["respuesta_pre_ciudadano"] != "")) { 
$respuesta_pre_ciudadanoi=$_POST["respuesta_pre_ciudadano"];
$id_requerir_pqrsi=$_POST["id_requerir_pqrs"];
$insertSQLi = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"),
GetSQLValueString('Modificado', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(3, "int"));
$Resulti = mysql_query($insertSQLi, $conexion) or die(mysql_error());
$updateSQL7799i = sprintf("UPDATE requerir_pqrs SET respuesta_pre_ciudadano=%s WHERE id_requerir_pqrs=%s and id_solicitud_pqrs=%s and estado_requerir_pqrs=1",                  
					  GetSQLValueString($respuesta_pre_ciudadanoi, "text"),
					  GetSQLValueString($id_requerir_pqrsi, "int"),
					  GetSQLValueString($id, "int"));
$Result17799i = mysql_query($updateSQL7799i, $conexion) or die(mysql_error());
echo $actualizado;
} else { }






 if ((isset($_POST["motivo_requerimiento"])) && (""!=$_POST["motivo_requerimiento"])) {

 
 $infonot=intval($_POST["codigo_oficina_req"]);
$consultay = mysql_query("SELECT * FROM notaria WHERE id_notaria=".$infonot." and estado_notaria=1 limit 1", $conexion) or die(mysql_error());
$row1y = mysql_fetch_assoc($consultay);
$nny = mysql_num_rows($consultay);
if (0<$nny) {
$correo_notaria=$row1y['email_notaria'];
$nombre_notaria=$row1y['nombre_notaria'];
	} else {}
 

$insertSQL = sprintf("INSERT INTO requerir_pqrs (id_solicitud_pqrs, nombre_requerir_pqrs, respuesta_pre_ciudadano, id_funcionario, id_tipo_oficina, id_vigilado, correo_oficina, estado_requerir_pqrs) VALUES 
(%s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['motivo_requerimiento'], "text"), 
GetSQLValueString($_POST['respuesta_pre_ciudadano_nueva'], "text"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["id_tipo_oficina_req"], "int"), 
GetSQLValueString($_POST["codigo_oficina_req"], "int"), 
GetSQLValueString($correo_notaria, "text"), 
GetSQLValueString(1, "int"));


$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;



$insertSQLi = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(2, "int"),
GetSQLValueString('Creado', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(5, "int"));
$Resulti = mysql_query($insertSQLi, $conexion) or die(mysql_error());


} else {}











 
 
 if ((isset($_POST["nombre_respuesta_pqrs2"])) && ($_POST["nombre_respuesta_pqrs2"] != "")) { 

$id_respuesta= $_POST["id_res"];
$textopqrs2= limpiar($_POST["nombre_respuesta_pqrs2"]);


$updateSQL = sprintf("UPDATE respuesta_pqrs SET nombre_respuesta_pqrs=%s WHERE id_respuesta_pqrs=%s and id_solicitud_pqrs=%s and estado_respuesta_pqrs=1",
	GetSQLValueString($textopqrs2, "text"),  
	GetSQLValueString($id_respuesta, "int"),  	
	GetSQLValueString($id, "int"));
    $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

$insertSQL = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"),
GetSQLValueString('Modificado', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(3, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());




$updateSQL7799 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(4, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) or die(mysql_error());

  
echo $actualizado;


} else { }












if (isset($_POST['respuesta_pqrs'])) {
$id=$_POST['respuesta_pqrs'];
    $updateSQL77 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s, radicado_respuesta=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(1, "int"),
					  GetSQLValueString($radicado_salida, "text"),
					    GetSQLValueString($id, "int"));
  $Result177 = mysql_query($updateSQL77, $conexion) or die(mysql_error());
} else {  }
	
	
	
	
	
	
	
	
	if (isset($_POST['cambio_notaria_requerimiento']) && ""!=$_POST['cambio_notaria_requerimiento']) {
     $cambio_notaria_requerimiento=$_POST['cambio_notaria_requerimiento'];
    $updateSQL77uu = sprintf("UPDATE requerir_pqrs SET id_vigilado=%s WHERE id_solicitud_pqrs=%s and estado_requerir_pqrs=1",                  
					  GetSQLValueString($cambio_notaria_requerimiento, "int"),
					   GetSQLValueString($id, "int"));
  $Result177uu = mysql_query($updateSQL77uu, $conexion) or die(mysql_error());
  echo $actualizado;
} else {  }
	
	
	
	
	
if ((isset($_POST["table"])) && ($_POST["table"] == "conocimiento_pqrs")) { 

if (1==$_POST["id_tipo_oficina"]) {
$id_areaf=$_POST["id_area"];
$query = sprintf("SELECT funcionario.id_funcionario, funcionario.correo_funcionario FROM funcionario, grupo_area, area where area.id_area=".$id_areaf." and funcionario.id_cargo=1 and funcionario.id_grupo_area=grupo_area.id_grupo_area and area.id_area=grupo_area.id_area and estado_funcionario=1 limit 1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$id_jefe=$row['id_funcionario'];
$correo_jefe=$row['correo_funcionario'];
mysql_free_result($select);
} else {
	

$id_areaf=$_POST["id_notaria"];

$query = sprintf("SELECT id_funcionario, email_notaria FROM notaria, posesion_notaria where posesion_notaria.id_notaria=notaria.id_notaria and posesion_notaria.id_notaria=".$id_areaf." and estado_notaria=1 and fecha_fin is null and estado_posesion_notaria=1  limit 1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$id_jefe=$row['id_funcionario'];
$correo_jefe=$row['email_notaria'];
mysql_free_result($select);
//$id_jefe=1026;
//$correo_jefe='giovanni.ortegon@supernotariado.gov.co';


} 

$insertSQL = sprintf("INSERT INTO conocimiento_pqrs (
id_solicitud_pqrs,  
id_funcionario, 
id_tipo_oficina, 
id_area, 
id_area_jefe, 
correo_envio, 
fecha_conocimiento_pqrs, 
nombre_conocimiento_pqrs, 
estado_conocimiento_pqrs) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["id_tipo_oficina"], "int"),
GetSQLValueString($id_areaf, "int"), 
GetSQLValueString($id_jefe, "int"), 
GetSQLValueString($correo_jefe, "text"), 
GetSQLValueString($_POST["nombre_conocimiento_pqrs"], "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

//echo $insertSQL;

$radicado_pqrsf=cualpqrs($id);

$subject = 'Conocimiento de PQRSD';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que la Superintendencia de Notariado y Registro pone en su conocimiento la PQRSD ".$radicado_pqrsf."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';

$cuerpo .= '<br><br>'.$_POST["nombre_conocimiento_pqrs"];
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
if (3==$_POST["id_tipo_oficina"]) {
} else {
mail($correo_jefe,$subject,$cuerpo,$cabeceras);
}




echo $insertado;
} else { }
	



if (isset($_POST["confirmacion_conminacion"])) {

$conocimiento_pqrs=quees('conocimiento_pqrs',$_POST["id_conocimiento_pqrs"]);



$correoff=$_POST["confirmacion_conminacion"];
$updateSQL77979 = sprintf("UPDATE conocimiento_pqrs SET confirmacion=1 WHERE id_solicitud_pqrs=%s and estado_conocimiento_pqrs=1",                  		  
					   GetSQLValueString($id, "int"));
$Result177979 = mysql_query($updateSQL77979, $conexion);


$radicado_pqrsf=cualpqrs($id);

$subject = 'Conminación de PQRSD';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "La Dirección de Vigilancia y Control Notarial de la Superintendencia de Notariado y Registro informa una Conminación de la PQRSD: ".$radicado_pqrsf."<br>";	

$cuerpo .= '<br><br>'.$conocimiento_pqrs;
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correoff,$subject,$cuerpo,$cabeceras);


} else {}
	
	
	
$infoval='';
$infoval2='';
	
if ($_SESSION['snr_tipo_oficina']<3 or 0<$sigrupo) {

global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}
	
$query4 = sprintf("SELECT * FROM solicitud_pqrs, categoria_pqrs, ciudadano, tipo_respuesta where solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and  ciudadano.id_tipo_respuesta=tipo_respuesta.id_tipo_respuesta and ciudadano.id_ciudadano=ciudadano.id_ciudadano and categoria_pqrs.id_categoria_pqrs=solicitud_pqrs.id_categoria_pqrs and solicitud_pqrs.id_solicitud_pqrs='$id' and estado_solicitud_pqrs=1 limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
if (0<count($row4)){
$idso = $row4['id_solicitud_pqrs'];
$radicado = $row4['radicado'];
$fecha_radicado = $row4['fecha_radicado'];
$nombre_solicitud_pqrs = $row4['nombre_solicitud_pqrs'];
$descripcion_solicitud_pqrs = $row4['descripcion_solicitud'];
$categoria = $row4['nombre_categoria_pqrs'];
$nombre = $row4['nombre_ciudadano'];
$identificacion = $row4['identificacion'];
$correo_ciudadano = $row4['correo_ciudadano'];
$direccion_ciudadano = $row4['direccion_ciudadano'];
$idrespuesta=$row4['id_tipo_respuesta'];
$erespuesta=$row4['nombre_tipo_respuesta'];
$id_ciudadano=$row4['id_ciudadano'];
$dep=$row4['id_departamento'];
$mun=$row4['id_municipio'];
$tipod=$row4['id_tipo_documento'];
$telefono=$row4['telefono_ciudadano'];
$canal=$row4['id_canal_pqrs'];
$sexociudadano=$row4['sexo'];
$estado_solicitud_pqrs=$row4['id_estado_solicitud'];




if (isset($row4['id_etnia']) && ""!=$row4['id_etnia']) {
$etnia=$row4['id_etnia'];
} else {
$etnia=6;	
}



if (isset($row4['idcorreocontactoiris']) && ""!=$row4['idcorreocontactoiris']) {
$idcorreocontactoiris=$row4['idcorreocontactoiris'];
} else {
$idcorreocontactoiris=0;	
}





} else { }
$result4->free();







if ((isset($_POST["aprobar_requerir_pqrs"])) && (""!=$_POST["aprobar_requerir_pqrs"])) {
	

if (isset($_SESSION['username_iris']) and "0"!=$_SESSION['username_iris']) {

  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
	 
$username_iris=$_SESSION['username_iris'];
	 
$queryi = "SELECT idusuario, nombre, apellido FROM usuario where username='$username_iris' limit 1"; 
$resultadoi = pg_query ($queryi);
$num_resultadosi = pg_num_rows ($resultadoi);
	
	 if (0<$num_resultadosi) {	
 
	 
$querybfk = sprintf("SELECT * FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1 limit 1"); 
$selectbfk = mysql_query($querybfk, $conexion) or die(mysql_error());
$rowbfk = mysql_fetch_assoc($selectbfk);
$totalRowsbfk = mysql_num_rows($selectbfk);
if (0<$totalRowsbfk) { 
$nombre_requerir_pqrsk=$rowbfk['nombre_requerir_pqrs'];
$correo_oficinak=$rowbfk['correo_oficina'];
} else {
	
}
	 
	 
 
for ($i=0; $i<$num_resultadosi; $i++)
   {
$rowi = pg_fetch_array ($resultadoi);
$id_iris=$rowi['idusuario'];
$nombre_iris=$rowi['nombre'];
$apellido_iris=$rowi['apellido'];
 }
$nombrec_iris=$nombre_iris.' '.$apellido_iris;

	// echo '<script>alert("'.$nombrec_iris.'-'.$id_iris.'");</script>';
	 
	  
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.'EE';
$query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
 }

$info3iris=explode($anoiris.'EE', $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicado_salida='SNR'.$anoiris.'EE'.$info6iris;

$fechairis=date("Y-m-d H:i:s");
$fechaenvio=date("Y-m-d ").'00:00:00';
$textoiris=strip_tags($nombre_requerir_pqrsk);
//$string = preg_replace("/[\r\n|\n|\r]+/", " ", $textoiris);
$textoiris4=$radicado.': '.$textoiris;

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
GetSQLValueString('235', "text"), 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString('Requerimiento PQRS', "text"), 
GetSQLValueString('14', "text"), 
GetSQLValueString('3', "text"), 
GetSQLValueString('false', "text"), 
GetSQLValueString('false', "text"), 
GetSQLValueString('5,'.$id_iris.' ', "text"), 
GetSQLValueString($nombrec_iris.' [USUARIO]', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($nombre_notaria.' / '.$nombre_funcionario.'', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris4, "text"),
GetSQLValueString($id_iris, "text"),
GetSQLValueString($fechairis, "text"));

$resultado = pg_query ($consultab);

  pg_free_result($resultado);
  pg_close($conexionpostgresql);  


	
$updateSQL7797 = sprintf("UPDATE requerir_pqrs SET fecha_solicitudr=now(), radicado_requerimiento=%s WHERE  id_solicitud_pqrs=%s and estado_requerir_pqrs=1",                  
					   GetSQLValueString($radicado_salida, "text"),
					   GetSQLValueString($id, "int"));
$Result17797 = mysql_query($updateSQL7797, $conexion);




$updateSQL7797ktf = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s, dias_ampliacion=%s, fecha_inicio_ampliacion=now() WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                   
                    GetSQLValueString(6, "int"), 					  
					  GetSQLValueString(30, "int"), 
					   GetSQLValueString($id, "int"));
$Result17797ktf = mysql_query($updateSQL7797ktf, $conexion);



  
$insertSQL = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"),
GetSQLValueString('<span class="glyphicon glyphicon-ok"></span>', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(4, "int"));
$Result = mysql_query($insertSQL, $conexion);



$emailu=$correo_oficinak; 

$subject = 'Requerimiento de la Superintendencia de Notariado y Registro '.$radicado_salida.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'><br>";
$cuerpo .= $nombre_requerir_pqrsk.""; 
$cuerpo .='<br>Puede ver la PQRSD del ciudadano en la URL: <a href="https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado.'.pdf">https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado.'.pdf</a>';
$cuerpo .='<br><br>Para dar respuesta debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/requerimiento_respuesta&'.$id.'.jsp">https://sisg.supernotariado.gov.co/requerimiento_respuesta&'.$id.'.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);







echo '<script type="text/javascript">swal(" OK !", " Requerimiento enviado. !", "success");</script>';



 } else {  echo '<script>alert("No se encontro el usuario en IRIS");</script>';  }
  
   }


} else { echo '<script>alert("No tiene registrado usuario de IRIS en el sistema.");</script>'; }

} else { }










if ((isset($_POST["aprobar_mensaje_ciudadano"])) && (""!=$_POST["aprobar_mensaje_ciudadano"])) {
	

if (isset($_SESSION['username_iris']) and "0"!=$_SESSION['username_iris']) {

  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
	 
$username_iris=$_SESSION['username_iris'];
	 
$queryi = "SELECT idusuario, nombre, apellido FROM usuario where username='$username_iris' limit 1"; 
$resultadoi = pg_query ($queryi);
$num_resultadosi = pg_num_rows ($resultadoi);
	
	 if (0<$num_resultadosi) {	
 
	 
$querybfk = sprintf("SELECT * FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1 limit 1"); 
$selectbfk = mysql_query($querybfk, $conexion) or die(mysql_error());
$rowbfk = mysql_fetch_assoc($selectbfk);
$totalRowsbfk = mysql_num_rows($selectbfk);
if (0<$totalRowsbfk) { 
$respuesta_pre_ciudadanok=$rowbfk['respuesta_pre_ciudadano'];
$id_requerir_pqrsk=$rowbfk['id_requerir_pqrs'];
} else {}
	 
	 
 
for ($i=0; $i<$num_resultadosi; $i++)
   {
$rowi = pg_fetch_array ($resultadoi);
$id_iris=$rowi['idusuario'];
$nombre_iris=$rowi['nombre'];
$apellido_iris=$rowi['apellido'];
 }
$nombrec_iris=$nombre_iris.' '.$apellido_iris;

	// echo '<script>alert("'.$nombrec_iris.'-'.$id_iris.'");</script>';
	 
	  
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.'EE';
$query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
 }

$info3iris=explode($anoiris.'EE', $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicado_salida='SNR'.$anoiris.'EE'.$info6iris;

$fechairis=date("Y-m-d H:i:s");
$fechaenvio=date("Y-m-d ").'00:00:00';
$textoiris=strip_tags($respuesta_pre_ciudadanok);
//$string = preg_replace("/[\r\n|\n|\r]+/", " ", $textoiris);
$textoiris4=$radicado.': '.$textoiris;

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
GetSQLValueString('235', "text"), 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString('Respuesta preliminar PQRS', "text"), 
GetSQLValueString('15', "text"), 
GetSQLValueString('3', "text"), 
GetSQLValueString('false', "text"), 
GetSQLValueString('false', "text"), 
GetSQLValueString('5,'.$id_iris.' ', "text"), 
GetSQLValueString($nombrec_iris.' [USUARIO]', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($nombre.' / ', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris4, "text"),
GetSQLValueString($id_iris, "text"),
GetSQLValueString($fechairis, "text"));

$resultado = pg_query ($consultab);

  pg_free_result($resultado);
  pg_close($conexionpostgresql);  


	
$updateSQL7797 = sprintf("UPDATE requerir_pqrs SET fecha_enviociudadano=now(), radicado_ciudadano=%s WHERE  id_solicitud_pqrs=%s and estado_requerir_pqrs=1",                  
					   GetSQLValueString($radicado_salida, "text"),
					   GetSQLValueString($id, "int"));
$Result17797 = mysql_query($updateSQL7797, $conexion);

  
$insertSQL = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["seccion"], "int"),
GetSQLValueString('<span class="glyphicon glyphicon-ok"></span>', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(4, "int"));
$Result = mysql_query($insertSQL, $conexion);




$updateSQL7797kt = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s, dias_ampliacion=%s, fecha_inicio_ampliacion=now(), texto_ampliacion=%s WHERE id_solicitud_pqrs=%s and dias_ampliacion is null and estado_solicitud_pqrs=1",                   
                    GetSQLValueString(6, "int"), 					  
					  GetSQLValueString(30, "int"), 
                      GetSQLValueString($respuesta_pre_ciudadanok, "text"), 
					   GetSQLValueString($id, "int"));
$Result17797kt = mysql_query($updateSQL7797kt, $conexion);




$emailuc=$correo_ciudadano; 


$subject = 'Respuesta preliminar de la Superintendencia de Notariado y Registro '.$radicado_salida.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'><br>";
$cuerpo .= $respuesta_pre_ciudadanok.""; 
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$infoacuse1=base64_encode($emailuc);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado_salida;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailuc,$subject,$cuerpo,$cabeceras);




echo '<script type="text/javascript">swal(" OK !", "Mensaje preliminar enviado. !", "success");</script>';



 } else {  echo '<script>alert("No se encontro el usuario en IRIS");</script>';  }
  
   }


} else { echo '<script>alert("No tiene registrado usuario de IRIS en el sistema.");</script>'; }

} else { }







if ((isset($_POST["nombre_respuesta_pqrs_documento"])) && ($_POST["nombre_respuesta_pqrs_documento"] != "")) { 



$tamano_archivo=5242880;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');

 $carpeta='pqrs/'.$anoactualcompleto.'/';
 
$directoryftp='files/'.$carpeta;


$ruta_archivo = $id.'-'.date("YmdGis");


	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  

 
$seguridad=md5($files.$id_ciudadano);

 

$insertSQL5 = sprintf("INSERT INTO documento_pqrs (idcorrespondencia, id_ciudadano, id_funcionario, nombre_documento_pqrs, id_solicitud_pqrs, id_clase_documento, carpeta, 
fecha_subida, url_documento, extension, hash_documento, estado_documento_pqrs) 
VALUES (%s, %s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s)", 
GetSQLValueString(1, "int"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["nombre_respuesta_pqrs_documento"], "text"),
 GetSQLValueString($id, "int"), 
 GetSQLValueString(2, "int"), 
 GetSQLValueString($carpeta, "text"), 
 GetSQLValueString($files, "text"), 
 GetSQLValueString($extension, "text"), 
 GetSQLValueString($seguridad, "text"),
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL5, $conexion);

echo $insertado;

  
  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';

		}
	
	



} else { }







if ((isset($_POST["nombre_respuesta_pqrs"])) && ($_POST["nombre_respuesta_pqrs"] != "")) { 

$texto1pqrs=limpiar($_POST["nombre_respuesta_pqrs"]);


$consultaghyyoor = mysql_query("SELECT count(id_respuesta_pqrs) as tres FROM respuesta_pqrs where id_solicitud_pqrs=".$id." and estado_respuesta_pqrs=1", $conexion);
$row1ghyyoor = mysql_fetch_assoc($consultaghyyoor);
$tres=$row1ghyyoor['tres'];

if (0<$tres) { 
echo $repetido;
} else {



$insertSQL = sprintf("INSERT INTO respuesta_pqrs (id_solicitud_pqrs, id_funcionario, nombre_respuesta_pqrs, fecha_respuesta, estado_respuesta_pqrs, radicado_entrada) VALUES (%s, %s, %s, now(), %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($texto1pqrs, "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString($radicado, "text"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

 
$updateSQL7799 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(4, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) or die(mysql_error());
  
  
  
  
  
  
$insertSQL33 = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString('Creado', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(5, "int"));
$Result33 = mysql_query($insertSQL33, $conexion) or die(mysql_error());


  
  
  
  
echo $insertado;

}




} else { }





if ((isset($_POST["enviar_pqrs"])) && ($_POST["enviar_pqrs"] == $id) && (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['rol'])) { 



$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.'EE';
$query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
 }

//echo $info2iris;


$info3iris=explode($anoiris.'EE', $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicado_salida='SNR'.$anoiris.'EE'.$info6iris;


//echo '<br>'.$radicado;

$fechairis=date("Y-m-d H:i:s");

$textoiris=strip_tags($_POST["respuesta_pqrs_full"]);



$consultab = sprintf("INSERT INTO correspondencia (idcorreoprioridad, idtipodocumento, codigo, referencia, asunto, idestado, idcorreovia, recibida, interna, deint, de, paraint, para, folios, anexos, contenido, fechaenvio, fecharecepcion, descripcion, creado, fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString('1', "text"), 
GetSQLValueString('334', "text"), 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString('Respuesta: '.$nombre_solicitud_pqrs, "text"), 
GetSQLValueString('19', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($_SESSION['snr_nombre'], "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('Oficina de atencion al ciudadano', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris, "text"),
GetSQLValueString('1642', "text"),
GetSQLValueString($fechairis, "text"));

$resultado = pg_query ($consultab);



$consultabact = sprintf("update correspondencia set idestado=%s where codigo=%s", 
 GetSQLValueString('16', "text"),
GetSQLValueString($radicado, "text"));
$resultadoact = pg_query ($consultabact);



  pg_free_result($resultado);
  pg_close($conexionpostgresql);  

  }
  

  
$consultaghyyooro = mysql_query("SELECT count(id_respuesta_pqrs) as treso FROM respuesta_pqrs where id_solicitud_pqrs=".$id." and radicado_salida='$radicado_salida' and estado_respuesta_pqrs=1", $conexion);
$row1ghyyooro = mysql_fetch_assoc($consultaghyyooro);
$treso=$row1ghyyooro['treso'];

if (0<$treso) { 

} else {
	
	




  $updateSQL = sprintf("UPDATE respuesta_pqrs SET radicado_salida=%s, id_funcionario_reviso=%s, fecha_envio=now() WHERE id_solicitud_pqrs=%s and estado_respuesta_pqrs=1",
                    GetSQLValueString($radicado_salida, "text"),  
                    GetSQLValueString($_SESSION['snr'], "int"),                     
					 GetSQLValueString($id, "int"));
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  
    $updateSQL77 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s, radicado_respuesta=%s, fecha_respuestaf=now() WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(5, "int"),
					  GetSQLValueString($radicado_salida, "text"),
					    GetSQLValueString($id, "int"));
  $Result177 = mysql_query($updateSQL77, $conexion) or die(mysql_error());
  

  

$insertSQL983 = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion)  VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString('Aprobado y enviado.', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(4, "int"));
$Result983 = mysql_query($insertSQL983, $conexion);

  
  
$emailu=$correo_ciudadano;


$subject = 'Respuesta PQRSD de la Superintendencia de Notariado y Registro / '.$radicado_salida.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'><br>";
$cuerpo .= 'La Superintendencia de Notariado y Registro ha dado respuesta a su PQRS identificada con el radicado '.$radicado.'.'."<br>"; 
$cuerpo .= 'Puede ver la respuesta en el siguiente enlace:<br><a href="https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado_salida.'.pdf">https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado_salida.'.pdf</a><br>'; 
$cuerpo .= 'Recuerde que puede ver las PQRSD en su cuenta personal mediante la URL:<br><a href="https://servicios.supernotariado.gov.co/pqrs/">https://servicios.supernotariado.gov.co/pqrs/</a><br>'; 
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';  
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);



  
echo '<div id="insertado" class="alert aviso"  style="background:#b9f4b5;color:#057205;" role="alert"><a class="close cerrar" style="text-decoration:none;">&times;</a>Respuesta enviada <b>correctamente.</b></div>';
echo '<meta http-equiv="refresh" content="0;URL=pdf/snr.php?q='.$id.'" />';

}


//} else { echo '<script>alert("En este momento no hay conexión con IRIS, por favor intenete luego.");</script>'; }

} else { }



?>



<?php


if ((isset($_POST["asignarnuevof"])) && ($_POST["asignarnuevof"] != "")) { 

$id_funcionacc8=$_POST["asignarnuevof"];

$querydd = sprintf("SELECT asignacion_pqrs_funcionario.id_funcionario, funcionario.correo_funcionario FROM funcionario, asignacion_pqrs_funcionario where funcionario.id_funcionario=asignacion_pqrs_funcionario.id_funcionario and funcionario.id_funcionario=".$id_funcionacc8." and asignacion_pqrs_funcionario.id_solicitud_pqrs=".$id." and funcionario.estado_funcionario=1 and estado_asignacion_pqrs_funcionario=1"); 
$selectdd = mysql_query($querydd, $conexion) or die(mysql_error());
$rowdd = mysql_fetch_assoc($selectdd);
$totalRowsdd = mysql_num_rows($selectdd);
if (0<$totalRowsdd){ 
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El funcionario <b>ya tiene</b> la PQRS asignada.</div>';

 } else {
do {

$insertSQLdd8 = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($id_funcionacc8, "int"),
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString(2319, "int"));  
$Resultdd8 = mysql_query($insertSQLdd8, $conexion) or die(mysql_error());



/*$subject = 'Nueva PQRS';
$cuerpo = '';
$cuerpo .= 'Se ha asignado una nueva PQRS ('.$radicado.') a su perfil.'."\n\n"; 
$cuerpo .= 'Entra en https://sisg.supernotariado.gov.co para dar respuesta.'."\n\n"; 
$cabeceras = 'From: Supernotariado<notificadorD@supernotariado.gov.co>';
mail($emailu,$subject,$cuerpo,$cabeceras);*/

$emailu=$rowdd["correo_funcionario"];
$subject = 'Nueva PQRS asignada: '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que le ha sido asignada una nueva PQRSD con el radicado ".$radicado."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);








echo $insertado;

	 } while ($rowdd = mysql_fetch_assoc($selectdd)); 

} 	 

mysql_free_result($selectdd);




} else { }
?>




<?php


if ((isset($_POST["table"])) && ($_POST["table"] == "asignacion_pqrs_funcionario")) { 

$id_funcionacc=$_POST["id_funcionario_grupo"];

$querydd = sprintf("SELECT asignacion_pqrs_funcionario.id_funcionario, funcionario.correo_funcionario FROM funcionario, asignacion_pqrs_funcionario where funcionario.id_funcionario=asignacion_pqrs_funcionario.id_funcionario and funcionario.id_funcionario=".$id_funcionacc." and asignacion_pqrs_funcionario.id_solicitud_pqrs=".$id." and funcionario.estado_funcionario=1 and estado_asignacion_pqrs_funcionario=1 limit 1"); 
$selectdd = mysql_query($querydd, $conexion) or die(mysql_error());
$rowdd = mysql_fetch_assoc($selectdd);
$totalRowsdd = mysql_num_rows($selectdd);
if (0<$totalRowsdd){
	echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El funcionario <b>ya tiene</b> la PQRS asignada.</div>';

 } else {
	 
		

if (1==$_SESSION['rol'] or (1==$_SESSION['snr_tipo_oficina'] and 45==$_SESSION['snr_grupo_area'])) {
		
		
$query = "SELECT id_asignacion_pqrs_funcionario FROM asignacion_pqrs_funcionario, funcionario where 
asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and 
funcionario.id_cargo=4 and funcionario.id_tipo_oficina=1 and lider_pqrs!=1 and id_grupo_area=45 and 
asignacion_pqrs_funcionario.id_solicitud_pqrs=".$id." 
and estado_funcionario=1 and estado_asignacion_pqrs_funcionario=1"; 
$select = mysql_query($query, $conexion) or die(mysql_error());
$rowr = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

do {
$idelim=intval($rowr['id_asignacion_pqrs_funcionario']);
$updateSQL = sprintf("update asignacion_pqrs_funcionario set estado_asignacion_pqrs_funcionario=0 where id_asignacion_pqrs_funcionario=%s",                    
GetSQLValueString($idelim, "int"));
$Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  
	 } while ($rowr = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);


		

  

} else {}
	
	
		
	 
do {

$insertSQLdd = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, motivo_asignacion, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($id_funcionacc, "int"),
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_POST["motivo_asignacion"], "text"),
GetSQLValueString($_SESSION['snr'], "int"));
$Resultdd = mysql_query($insertSQLdd, $conexion) or die(mysql_error());


$reghtpo = mysql_query("SELECT correo_funcionario FROM funcionario where id_funcionario=".$id_funcionacc." and estado_funcionario=1 limit 1", $conexion) or die(mysql_error());
$rowcco = mysql_fetch_assoc($reghtpo);
$emailu=$rowcco['correo_funcionario'];

$subject = 'Nueva PQRS asignada: '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que le ha sido asignada una nueva PQRSD con el radicado ".$radicado."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);




echo $insertado;

	 } while ($rowdd = mysql_fetch_assoc($selectdd)); 

	 
	 

	 
	 
	 
	 
	 
} 	 

mysql_free_result($selectdd);


} else { }
?>



<div class="modal fade"  id="historialasignaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Historial de asignaciones:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<div class="form-group text-left"> 
<label  class="control-label">Usuarios relacionados con la PQRS:</label> 
<?php
$query = sprintf("SELECT * FROM funcionario, asignacion_pqrs_funcionario where funcionario.id_funcionario=asignacion_pqrs_funcionario.id_funcionario and id_solicitud_pqrs=".$id.""); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

if (0<$totalRows){
	do {
	echo '<li>';
	echo '<b>De:</b> ';
	echo quees('funcionario', $row['id_funcionario_asigna']);
	
	if (1==$row['id_tipo_oficina']) {
	echo ' / ';
	echo quegrupoes($row['id_funcionario_asigna']);
	} else {}
		
	echo ' <b>Para:</b> '.$row['nombre_funcionario'].' ';
	
		if (1==$row['id_tipo_oficina']) {
	echo ' / ';
	echo quegrupoes($row['id_funcionario']);
	} else {}
	
	
	echo ' <b>Fecha:</b> '.$row['fecha_asignacion_funcionario'];
	
	if (1==$row['estado_asignacion_pqrs_funcionario']) {  
	echo ' / Asignación activa';
	} else {
	echo ' / Asignación eliminada';
	}
	echo '</li>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</div>
</div>
</div> 
</div> 
</div> 







<div class="modal fade" id="popupasignarpqrs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ASIGNAR PQRS - RADICADO:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1255764652">
<input type="hidden" name="table" value="asignacion_pqrs_funcionario" >
<?php if (1==$_SESSION['snr_tipo_oficina']) { ?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> GRUPOS:</label> 

<select  class="form-control" name="id_grupo" id="id_grupo" required>
<option selected></option>
<?php
$areaf=$_SESSION['snr_area'];
$query = sprintf("SELECT * FROM grupo_area where id_area='$areaf' and estado_grupo_area=1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

if (0<$totalRows){
	do {
	echo '<option value="'.$row['id_grupo_area'].'">'.$row['nombre_grupo_area'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FUNCIONARIO:</label> 
<select  class="form-control" name="id_funcionario_grupo" id="id_funcionario_grupo" required>

</select>
</div>
<?php } else if (2==$_SESSION['snr_tipo_oficina']) { ?>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FUNCIONARIO:</label> 
<?php
$id_oficina_registro=$_SESSION['id_oficina_registro'];
$query7 = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_oficina_registro='$id_oficina_registro' and id_cargo!=1 and estado_funcionario=1"); 
$select7 = mysql_query($query7, $conexion);
$row7 = mysql_fetch_assoc($select7);
$totalRows7 = mysql_num_rows($select7);
?>

<select  class="form-control" name="id_funcionario_grupo" id="id_funcionario_grupo" required>
<option selected></option>
<?php
if (0<$totalRows7){
	do {
	echo '<option value="'.$row7['id_funcionario'].'">'.$row7['nombre_funcionario'].'</option>';
	 } while ($row7 = mysql_fetch_assoc($select7)); 
} else {}	 
mysql_free_result($select7);
?>
</select>
</div>



<?php } else  { }   ?>
<div class="form-group text-left"> 
<label  class="control-label"> MOTIVO:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="motivo_asignacion"></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok">
</span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 

<?php


if ((isset($_POST["table"])) && ($_POST["table"] == "clasificacion_pqrs")) { 

if ((isset($_POST["id_tema_oac"])) && ($_POST["id_tema_oac"] != "")) {$_POST["id_tema_oac"]=$_POST["id_tema_oac"]; } else { $_POST["id_tema_oac"]=0;}
if ((isset($_POST["id_motivo_oac"])) && ($_POST["id_motivo_oac"] != "")) {$_POST["id_motivo_oac"]=$_POST["id_motivo_oac"]; } else { $_POST["id_motivo_oac"]=0;}

$cuantoclasi=existenciaunica('clasificacion_pqrs', 'id_solicitud_pqrs', $id);
if (0<$cuantoclasi) {
	echo $repetido;
} else {

$claseo=$_POST["id_clase_oac"];
$insertSQL = sprintf("INSERT INTO clasificacion_pqrs (id_solicitud_pqrs, nombre_clasificacion_pqrs, id_categoria_oac, id_clase_oac, id_tema_oac, id_motivo_oac, fecha_clasificacion, id_funcionario, estado_clasificacion_pqrs) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString('x', "text"), 
GetSQLValueString($_POST["id_categoria_oac"], "int"),
 GetSQLValueString($claseo, "int"), 
 GetSQLValueString($_POST["id_tema_oac"], "int"), 
 GetSQLValueString($_POST["id_motivo_oac"], "int"), 
 GetSQLValueString($_SESSION['snr'], "int"), 
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;
echo $insertado;

$updateSQL = "UPDATE solicitud_pqrs SET id_clase_oact=".$claseo.", fecha_vence=".$numero_cuenta." WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
$Result1 = mysql_query($updateSQL, $conexion);
mysql_free_result($Result1);


}
} else { }
?>


<div class="modal fade" id="popupclasificarpqrs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>CLASIFICAR RADICADO:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form122">
<input type="hidden" name="table" value="clasificacion_pqrs" >
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CATEGORIA:</label> 
<select  class="form-control" name="id_categoria_oac" id="id_categoria_oac" required>
<option selected></option>
<?php echo lista('categoria_oac');  ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CLASE:</label> 
<select  class="form-control" name="id_clase_oac" id="id_clase_oac" required>

</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> MOTIVO:</label> 
<select  class="form-control" name="id_tema_oac" id="id_tema_oac">

</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"> ASUNTO:</label> 
<select  class="form-control" name="id_motivo_oac" id="id_motivo_oac">

</select>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 





<?php
if ((isset($_POST["codigo_oficina"])) && ($_POST["codigo_oficina"] != "") and 'asignacion_pqrs'==$_POST["table"]) { 

if (1==$_POST["id_tipo_oficina"]) {
	$depa='11';
	$muna='001';
} else {
	$depa=$_POST["id_departamento"];
	$muna=$_POST["codigo_municipio"];
}


$id_solicitud_pqrs=$_POST["id_solicitud_pqrs"];
$id_tipo_oficina=$_POST["id_tipo_oficina"];
$codigo_oficina=$_POST["codigo_oficina"];


//$querybby = sprintf("SELECT id_asignacion_pqrs FROM asignacion_pqrs where id_solicitud_pqrs=".$id." and id_tipo_oficina=".$id_tipo_oficina." and codigo_oficina=".$codigo_oficina." and estado_asignacion_pqrs=1"); 

$querybby = sprintf("SELECT id_asignacion_pqrs FROM asignacion_pqrs where id_solicitud_pqrs=".$id." and estado_asignacion_pqrs=1"); 

$selectbby = mysql_query($querybby, $conexion);
$rowdduu = mysql_fetch_assoc($selectbby);
$totalRowsbby = mysql_num_rows($selectbby);
if (0<$totalRowsbby){ 

	echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>La oficina <b>ya tiene</b> direccionada la PQRS.</div>';



 } else {
	 
	 
	 
if (3==$estado_solicitud_pqrs){  
	   $updateSQL7797 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(2, "int"),
					  GetSQLValueString($id, "int"));
  $Result17797 = mysql_query($updateSQL7797, $conexion) or die(mysql_error());

} else { }

  
  
  
  
  

$insertSQL = sprintf("INSERT INTO asignacion_pqrs (id_solicitud_pqrs, id_tipo_oficina, id_departamento, codigo_municipio, codigo_oficina, nombre_asignacion_pqrs, fecha_asignacion, id_consolidar, estado_asignacion_pqrs, marca_retorno) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_tipo_oficina"], "int"),
 GetSQLValueString($depa, "int"), 
 GetSQLValueString($muna, "int"), 
 GetSQLValueString($_POST["codigo_oficina"], "text"), 
 GetSQLValueString($_POST["nombre_asignacion_pqrs"], "text"), 
 GetSQLValueString(0, "int"), 
 GetSQLValueString(1, "int"),
 GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL, $conexion);
mysql_free_result($Result);

echo $insertado;


	$updatecc = "UPDATE solicitud_pqrs SET pqrs_direccionada=1 WHERE id_solicitud_pqrs=".$id." and estado_solicitud_pqrs=1";                
	$Resultcc = mysql_query($updatecc, $conexion);
	mysql_free_result($Resultcc);



if (1===intval($_POST["id_tipo_oficina"])) {

$area=$_POST["codigo_oficina"];


$querybb = sprintf("SELECT funcionario.id_funcionario, correo_funcionario FROM funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and grupo_area.id_area='$area' and (funcionario.id_cargo=1 or funcionario.lider_pqrs=1) and estado_funcionario=1 order by id_funcionario"); 
$selectbb = mysql_query($querybb, $conexion) or die(mysql_error());
$rowbb = mysql_fetch_assoc($selectbb);
$totalRowsbb = mysql_num_rows($selectbb);
if (0<$totalRowsbb){
do {
	
$idfssss=$rowbb['id_funcionario'];

$insertSQLbb = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($idfssss, "int"),
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_SESSION['snr'], "int"));
$Resultbb = mysql_query($insertSQLbb, $conexion) or die(mysql_error());



$emailu=$rowbb['correo_funcionario'];

$subject = 'Nueva PQRS asignada: '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que le ha sido asignada una nueva PQRSD con el radicado ".$radicado."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


	 } while ($rowbb = mysql_fetch_assoc($selectbb)); 

} else {}	 

mysql_free_result($selectbb);

} else if (2===intval($_POST["id_tipo_oficina"])) {






$query = sprintf("SELECT funcionario.id_funcionario, correo_funcionario FROM oficina_registro, funcionario where oficina_registro.id_oficina_registro='$codigo_oficina' and oficina_registro.id_oficina_registro=funcionario.id_oficina_registro and (funcionario.id_cargo=1 or funcionario.lider_pqrs=1) and estado_oficina_registro=1 order by funcionario.id_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
$idfssss=$row['id_funcionario'];

$insertSQL = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($idfssss, "int"),
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_SESSION['snr'], "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());


$emailu=$row['correo_funcionario'];

$subject = 'Nueva PQRS asignada: '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que le ha sido asignada una nueva PQRSD con el radicado ".$radicado."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);







$ofiorip33=intval($codigo_oficina);
$queryop="SELECT nombre_oficina_registro FROM oficina_registro WHERE id_oficina_registro=".$ofiorip33." limit 1";
$selectop = mysql_query($queryop, $conexion);
$rowop = mysql_fetch_assoc($selectop);
$nombre_oripzxx=$rowop['nombre_oficina_registro'].'';
mysql_free_result($selectop);

//$nombre_oripzxx=quees('oficina_registro', $ofiorip);

//$nombre_oripzxx = quees('oficina_registro', $_POST["codigo_oficina"]);



$subject = 'Información automática - PQRSD '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>


<br>
Bogota, D.C., ".$realdate."
<br>
<br>
Señor<br>
".$nombre."<br>
Dirección<br>
Ciudad<br>
<br>
Asunto: Direccionamiento radicado No. ".$radicado."<br>
<br>
Respetado Señor (a) ".$nombre.":<br>
<br>
De manera atenta nos permitimos informarle que su PQRSD con radicado No. ".$radicado." ha sido direccionado  el dia ".$realdate.",  a la Oficina de Registro de Instrumentos Públicos ".$nombre_oripzxx.", quien es la Oficina competente para dar respuesta a su petición, queja ó reclamo, según el caso.
<br>
En el evento de presentar inconformidad con la respuesta dada a su (petición, queja o reclamo, según el caso), por parte de la Oficina de Registro, deberá presentar su queja o reclamo ingresando a la siguiente dirección electrónica: https://servicios.supernotariado.gov.co/pqrs/ o dirigirla al siguiente correo: correspondencia@supernotariado.gov.co, anexando la respuesta dada a su petición por parte de la Oficina de Registro correspondiente, con el fin de que su reclamo o queja sea puesto en conocimiento de la Superintendencia Delegada para el Registro o de la Oficina de Control Disciplinario Interno, según el caso. 
<br>
<br>
Cordial Saludo,
<br><br>Oficina de Atención al Ciudadano";
$infoacuse1=base64_encode($correo_ciudadano);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correo_ciudadano,$subject,$cuerpo,$cabeceras);
	
	
	

} else if (3===intval($_POST["id_tipo_oficina"])) {

$notaria=$_POST["codigo_oficina"];

$query = sprintf("SELECT funcionario.id_funcionario, email_notaria FROM notaria where id_notaria='$notaria' "); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	

$idfssss=$row['id_funcionario'];

$insertSQL = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($idfssss, "int"),
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_SESSION['snr'], "int"));
$Result = mysql_query($insertSQL, $conexion) ;


$emailu=$row['email_notaria'];

$subject = 'Nueva PQRS asignada: '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que le ha sido asignada una nueva PQRSD con el radicado ".$radicado."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);





} else if (4===intval($_POST["id_tipo_oficina"])) {

$curaduria=$_POST["codigo_oficina"];

$query = sprintf("SELECT funcionario.id_funcionario, correo_funcionario FROM funcionario, curaduria where funcionario.id_funcionario=curaduria.id_funcionario and curaduria.id_curaduria='$curaduria' and estado_curaduria=1 order by funcionario.id_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$rowy = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
$idfssssy=$rowy['id_funcionario'];

$insertSQL = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), $s)", 
GetSQLValueString('PQRS', "text"),
GetSQLValueString($idfssssy, "int"),
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_SESSION['snr'], "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());


$emailu=$rowy['correo_curaduria'];

$subject = 'Nueva PQRS asignada: '.$radicado.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Vicky te informa que le ha sido asignada una nueva PQRSD con el radicado ".$radicado."<br>";
$cuerpo .= '<br>Debe ir a la URL: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a><br>';
$cuerpo .= '<br>';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);




} else { }



}
} else { }
?>


<div class="modal fade" id="popupdireccionarpqrs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>DIRECCIONAR RADICADO:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FGDG">

<div class="form-group text-center"> 
SE DEBE DIRECCIONAR A UNA SOLA OFICINA O AREA.
</div>


<div class="form-group text-left ubicacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>DEPARTAMENTO:</label> 
<select  class="form-control" name="id_departamento" id="id_departamento" required>
<option value="" selected></option>
<?php echo lista('departamento');  ?>
</select>
</div>
<div class="form-group text-left ubicacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>MUNICIPIO:</label> 
<select  class="form-control" name="codigo_municipio" id="id_municipio" required>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPO DE OFICINA:</label> 
<select  class="form-control" name="id_tipo_oficina" id="id_tipo_oficina" required>
<option value="" selected></option>
<?php 

$queryk = sprintf("SELECT id_tipo_oficina, nombre_tipo_oficina FROM tipo_oficina where gestionado_oac=1 and estado_tipo_oficina=1 order by id_tipo_oficina"); 
$selectk = mysql_query($queryk, $conexion) or die(mysql_error());
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk){
do {
	echo '<option value="'.$rowk['id_tipo_oficina'].'">'.$rowk['nombre_tipo_oficina'].'</option>';
	 } while ($rowk = mysql_fetch_assoc($selectk)); 
} else {}	 
mysql_free_result($selectk);
 ?>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OFICINA:</label> 
<select disabled class="form-control codigo_oficina" name="codigo_oficina" id="codigo_oficina" required>
</select>
</div>
<?php /* if (24 == $_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) { 
echo '<div class="form-group text-left"> 
<label  class="control-label">DEBE CONSOLIDAR:</label> 
<br /><input type="radio" name="id_consolidar"  value="1" > SI       
<input type="radio"  name="id_consolidar"  value="0"> NO
</div>
'; } else {} */ ?>
<div class="form-group text-left"> 
<label  class="control-label">MOTIVO DE ASIGNACIÓN:</label> 
<textarea spellcheck="true" lang="es" class="form-control" name="nombre_asignacion_pqrs" ></textarea>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="asignacion_pqrs">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div></form>



</div>
</div> 
</div> 
</div> 














<div class="modal fade" id="popupparaconocimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>PARA CONOCIMIENTO:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="fo345345rm1">
<div class="form-group text-left"> 
<?php if (45==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {?>
<label  class="control-label"><span style="color:#ff0000;">*</span>Notaria:</label> 
<input type="hidden" name="id_tipo_oficina" value="3">
<select  class="form-control" name="id_notaria" required>
<option value="" selected></option>
<?php 
$query = sprintf("SELECT id_notaria, nombre_notaria, nombre_departamento FROM notaria, departamento where notaria.id_departamento=departamento.id_departamento and  estado_notaria=1 order by nombre_departamento, nombre_notaria"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_notaria'].'">'.$row['nombre_departamento'].' - '.$row['nombre_notaria'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
 ?>
</select>
<?php } else {?>
<label  class="control-label"><span style="color:#ff0000;">*</span>AREA:</label> 
<input type="hidden" name="id_tipo_oficina" value="1">
<select  class="form-control" name="id_area" required>
<option value="" selected></option>
<?php 
$query = sprintf("SELECT id_area, nombre_area FROM area where id_area!=21 and estado_area=1 order by nombre_area"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
 ?>
</select>

<?php } ?>

</div>
<div class="form-group text-left"> 
<label  class="control-label">DESCRIPCIÓN:</label> 
<textarea spellcheck="true" lang="es" class="form-control" id="texto_para_conocimiento" name="nombre_conocimiento_pqrs">
<?php
if (45==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Doctor/a<br>
Notario/a <br><br>

	
Referencia: Conminación con ocasión al radicado <?php echo $radicado; ?> de fecha <?php 
echo date("Y-m-d",strtotime($fecha_radicado.""));?>
<br><br>
Respetado/a Señor/a Notario/a:
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">

En consideración al radicado de la referencia, fue recibida QUEJA suscrita por el señor/a <?php echo $nombre; ?> , mediante la cual informó sobre presuntas irregularidades en la prestación del servicio público notarial por parte del Despacho a su cargo, indicando que, XXXXX  y respecto de la cual, es preciso hacer las siguientes recomendaciones:
<br><br>
La Superintendencia de Notariado y Registro, en desarrollo de las competencias conferidas en el Decreto 2723 de 2014, tiene dentro de su misión el ejercer la orientación, inspección, vigilancia y control sobre el servicio público notarial en los términos establecidos en las normas vigentes; y en virtud de dicho mandato, esta Superintendencia tiene la facultad de emprender acciones encaminadas a velar porque el servicio notarial se preste en forma oportuna y eficaz.
<br><br>
Del mismo modo, esta Entidad está autorizada para examinar la conducta de los notarios, en procura de asegurar que el desempeño de sus deberes se enmarque dentro de los valores de honestidad, rectitud e imparcialidad, en correspondencia con la naturaleza de las funciones que les fueron confiadas. 
<br><br>
En consecuencia, en aquellos eventos en que la Dirección de Vigilancia y Control Notarial advierta la ocurrencia de actos u omisiones que resulten contrarios al ordenamiento jurídico, debe actuar de manera articulada con la Delegada para el Notariado, a efectos de adoptar los correctivos o imponer las sanciones que fueren necesarias.
No obstante, pueden presentarse casos en los cuales la conducta bajo estudio no tiene la entidad suficiente para afectar de manera sustancial el deber funcional, por tratarse de hechos que si bien contrarían el orden administrativo, lo hacen en menor grado, caso en el cual se puede prescindir de la acción disciplinaria, por resultar desproporcionada frente a los fines que la inspiran; en su lugar la Dirección de Vigilancia y Control Notarial está habilitada para adoptar las medidas que estime necesarias para mitigar el riesgo y asegurar la correcta prestación del servicio notarial, acorde con lo dispuesto en el numeral 7 del artículo 26 del Decreto 2723 de 2014.
En virtud de lo expuesto, y al evaluar los hechos advertidos en la queja elevada por el/la señor/a <?php echo $nombre; ?>, se le conmina a la adopción de medidas internas tendientes a XXXX . 

</p><br><br>
Atentamente,
<br><br>
<br>
MIGUEL ALFREDO GOMEZ CAICEDO (E)<br>
Director de Vigilancia y Control Notarial

<br><br>
<br>


Proyecto: 
<?php echo $_SESSION['snr_nombre']; ?><br>
<?php echo quees('grupo_area', $_SESSION['snr_grupo_area']); ?>
<br>
<?php } else {} ?>

</textarea>
</div>

<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="conocimiento_pqrs">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>
</form>

</div>
</div> 
</div> 
</div> 
















<div class="modal fade" id="popupclasificacioninterna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>CLASIFICACIÓN:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1435ewtr435FGDG">

<?php
if (45==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {
	echo '<input type="hidden" name="id_tipo_oficina" id="id_tipo_oficina_req2" value="3">';
} else {}
	?>
	

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPOLOGIA:</label> 
<select class="form-control" name="id_tipologiapqrs_notaria" required>
<option selected></option>
<?PHP
echo lista('tipologiapqrs_notaria');
?>
</SELECT>
</div>
	
	

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="requerir_pqrs">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>
</form>



</div>
</div> 
</div> 
</div> 






<div class="modal fade" id="popuprequerir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Requerimiento a Notaria:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FGDG">

<?php
if (45==$_SESSION['snr_grupo_area'] or 44==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {
	echo '<input type="hidden" name="id_tipo_oficina_req" id="id_tipo_oficina_req" value="3">';
	?>
	
	<div class="form-group text-left ubicacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>DEPARTAMENTO:</label> 
<select  class="form-control" name="dep" id="id_departamento_req" required>
<option value="" selected></option>
<?php echo lista('departamento');  ?>
</select>
</div>
<div class="form-group text-left ubicacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>MUNICIPIO:</label> 
<select  class="form-control buscar_ofi" name="mun" id="id_municipio_req" required>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>OFICINA:</label> 
<select class="form-control" id="ver_ofi" name="codigo_oficina_req" required>
</SELECT>
</div>
	
	
	
	<?php
} else if (297==$_SESSION['snr_grupo_area'] ){
echo '<input type="hidden" name="id_tipo_oficina_req" id="id_tipo_oficina_req" value="4">';
echo '
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>OFICINA:</label> 
<select class="form-control" name="codigo_oficina_req" required>'; ?>

<?php echo lista('curaduria', 100); ?>

<?php echo '</SELECT></div>';
	
} else {
	
}
?>





<div class="form-group text-left"> 
<label  class="control-label">REQUERIMIENTO A LA NOTARIA:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="motivo_requerimiento" id="texto_requerir">
<?php
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Doctor/a<br>
Notario/a <br><br>

	
Referencia: Radicado <?php echo $radicado; ?> de fecha <?php 
echo date("Y-m-d",strtotime($fecha_radicado.""));?>
<br><br>
Respetados señores:
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">



Mediante el radicado de la referencia fue recibida una comunicación suscrita por el/la señor/a <?php echo $nombre; ?>, relacionada con una posible afectación de la adecuada prestación del servicio público notarial, con ocasión a que presuntamente XXX, cuyo texto puede consultar haciendo clic en el link que encontrará en la parte inferior del presente correo. 
 <br> <br>
Con la finalidad de dar una respuesta de fondo al peticionario, se solicita muy respetuosamente se pronuncie sobre los hechos relacionados en la referida comunicación; aportando los documentos y/o soportes que respalden sus consideraciones. 
 <br> <br>
La información solicitada debe ser proporcionada en un término ÚNICO de cinco (05) días hábiles, los cuales se contarán a partir del día siguiente al recibo de este requerimiento, la respuesta deberá ser tramitada ingresando al link respectivo que encontrará en la parte inferior del presente correo. 
 <br> <br>
<u>Los soportes o anexos que excedan de 10 Mb deberán ser enviados, mediante archivo comprimido o mediante documentos cargados a la nube, al correo electrónico vigilanciasdn@supernotariado.gov.co. 
 </u><br> <br>
Para todos los efectos legales, se recuerda la obligación de dar oportuna contestación a este requerimiento, teniendo cuenta lo preceptuado en el numeral 3 del artículo 79 de la Ley 1952 de 2019. 
<br> <br><br>
</p>
Atentamente,
<br><br>
<br>
MIGUEL ALFREDO GOMEZ CAICEDO (E)<br>
Director de Vigilancia y Control Notarial

<br><br>
<br>


Proyecto: 
<?php echo $_SESSION['snr_nombre']; ?><br>
<?php echo quees('grupo_area', $_SESSION['snr_grupo_area']); ?>
<br>
</textarea>

</div>
<div class="form-group text-left"> 
<label  class="control-label">CIUDADANO:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="respuesta_pre_ciudadano_nueva" id="texto_info_ciudadano">

<?php
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Señor/a<br>
<?php 
echo $nombre.'<br>';
echo $correo_ciudadano.'<br>';
echo $direccion_ciudadano.'<br>';
echo quees('municipio', $mun);
?>
<br><br>
Referencia: Respuesta preliminar al radicado <?php echo $radicado; ?> de fecha <?php 
echo date("Y-m-d",strtotime($fecha_radicado.""));?>
<br><br>
Respetado/a señor/a, reciba un atento saludo.
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">
En respuesta al radicado descrito en la referencia, la Dirección de Vigilancia y Control Notarial, en desarrollo de las facultades otorgadas en el numeral 4 del artículo 26 del Decreto 2723 de 2014, pone de presente que dicha petición fue remitida a la Notaría descrita en su petición, lo anterior, con la finalidad de que se brinden las explicaciones del caso ante esta Dirección. 
 <br><br>
Consecuentemente, se informa que una vez sea obtenido el respectivo pronunciamiento por parte de la Notaría, se brindará una respuesta de fondo a su solicitud, de conformidad con lo dispuesto en el parágrafo del articulo 14 de la Ley Estatutaria 1755 de 2015. 
 <br><br>
Cabe resaltar que la Dirección de Vigilancia y Control Notarial está presta a recibir sus solicitudes e inconformidades y tomar las acciones pertinentes para mejorar la prestación del servicio público notarial. 
<br><br>
</p>

<br><br>
Atentamente,
<br><br>
<br>
MIGUEL ALFREDO GOMEZ CAICEDO<br>
Director (E) de Vigilancia y Control Notarial

<br><br>
<br>


Proyecto: 
<?php echo $_SESSION['snr_nombre']; ?><br>
<?php echo quees('grupo_area', $_SESSION['snr_grupo_area']); ?>
<br>
</textarea>

</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="requerir_pqrs">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>
</form>



</div>
</div> 
</div> 
</div> 











<?php
if ((isset($_POST["retornar_motivo"])) && ($_POST["retornar_motivo"] != "")) { 



$id_tipo_oficina=$_SESSION['snr_tipo_oficina'];


if (1==$id_tipo_oficina){
$codigo_oficina=$_SESSION['snr_area'];
} else if (2==$id_tipo_oficina){
$codigo_oficina=$_SESSION['id_oficina_registro'];
} else {
$codigo_oficina='0000';
}



$querybby = sprintf("SELECT id_retorno_pqrs FROM retorno_pqrs where id_solicitud_pqrs=".$id." and id_tipo_oficina=".$id_tipo_oficina." and codigo_oficina=".$codigo_oficina." and estado_retorno_pqrs=1"); 
$selectbby = mysql_query($querybby, $conexion) or die(mysql_error());
$rowdduu = mysql_fetch_assoc($selectbby);
$totalRowsbby = mysql_num_rows($selectbby);
if (0<$totalRowsbby){ 

	echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>La PQRS <b>ya ha sido retornada a OAC.</b></div>';


} else {




$retornar_motivo=$_POST["retornar_motivo"];


$insertSQL = sprintf("INSERT INTO retorno_pqrs (id_solicitud_pqrs, id_tipo_oficina, codigo_oficina, nombre_retorno_pqrs, fecha_retorno_pqrs, estado_retorno_pqrs) VALUES (%s, %s, %s, %s, now(), %s)", 
                         GetSQLValueString($id, "int"),
						GetSQLValueString($id_tipo_oficina, "int"),
					   GetSQLValueString($codigo_oficina, "int"),
					   GetSQLValueString($retornar_motivo, "text"),
					   GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


  $updateccf = "UPDATE solicitud_pqrs SET pqrs_direccionada=0 WHERE id_solicitud_pqrs=".$id." and estado_solicitud_pqrs=1";                
	$Resultccf = mysql_query($updateccf, $conexion);
	mysql_free_result($Resultccf);
  
    $updateSQL779 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(3, "int"),
					  GetSQLValueString($id, "int"));
  $Result1779 = mysql_query($updateSQL779, $conexion);
  mysql_free_result($Result1779);
  
  
      $updateSQL7798 = sprintf("UPDATE asignacion_pqrs SET estado_asignacion_pqrs=%s WHERE id_solicitud_pqrs=%s and id_tipo_oficina=%s and codigo_oficina=%s",                  
					  GetSQLValueString(0, "int"),
					  GetSQLValueString($id, "int"),
					   GetSQLValueString($id_tipo_oficina, "int"),
					  GetSQLValueString($codigo_oficina, "int") );
  $Result17798 = mysql_query($updateSQL7798, $conexion) ;
  mysql_free_result($Result17798);
  
  
  
    $updateSQL7796 = sprintf("UPDATE respuesta_pqrs SET estado_respuesta_pqrs=0 WHERE id_solicitud_pqrs=%s and estado_respuesta_pqrs=1",                  
					 	  GetSQLValueString($id, "int"));
  $Result17796 = mysql_query($updateSQL7796, $conexion);
  mysql_free_result($Result17796);
  
  
$tipo_oficina=$_SESSION['snr_tipo_oficina'];
if (1==$tipo_oficina){
$codigo_oficinayy=intval($_SESSION['snr_area']);
$querykl = sprintf("SELECT id_funcionario FROM funcionario, grupo_area where id_tipo_oficina=1 and funcionario.id_grupo_area=grupo_area.id_grupo_area and  grupo_area.id_area=".$codigo_oficinayy." and estado_funcionario=1 and estado_grupo_area=1"); 

} else if (2==$tipo_oficina){
$codigo_oficinayy=intval($_SESSION['id_oficina_registro']);
$querykl = sprintf("SELECT id_funcionario FROM funcionario where id_tipo_oficina=2 and id_oficina_registro=".$codigo_oficinayy." and estado_funcionario=1"); 

} else {
$querykl = sprintf("SELECT id_funcionario FROM funcionario where id_tipo_oficina=0"); 
	}

 
$selectkl = mysql_query($querykl, $conexion) or die(mysql_error());
$rowkl = mysql_fetch_assoc($selectkl);
$totalRowskl = mysql_num_rows($selectkl);
if (0<$totalRowskl){
do {
	$idfuncionarior=$rowkl['id_funcionario'];
	
  $updateSQL7798p = sprintf("UPDATE asignacion_pqrs_funcionario SET estado_asignacion_pqrs_funcionario=%s WHERE id_solicitud_pqrs=%s and id_funcionario=%s and estado_asignacion_pqrs_funcionario=1",                  
					  GetSQLValueString(0, "int"),
					  GetSQLValueString($id, "int"),
					    GetSQLValueString($idfuncionarior, "int"));
  $Result17798p = mysql_query($updateSQL7798p, $conexion) or die(mysql_error());
  
  
	 } while ($rowkl = mysql_fetch_assoc($selectkl)); 
} else {}	 
mysql_free_result($selectkl);

  
  
  
  echo $insertado;
}

} else { }
?>




<div class="modal fade" id="popupretornar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>RETORNAR RADICADO:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="fqorrm12ewr55764652">
<label  class="control-label">Motivo por el cual retorna la PQRSD a la Oficina de Atención al Ciudadano: </label>
<br>
<textarea spellcheck="true" lang="es"  class="form-control" name="retornar_motivo" required></textarea>


<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 





<div class="modal fade" id="popupcorreccion_pqrs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Correccion:</b></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="forWE2345TRWETm1" onsubmit="">

<div class="form-group text-left"> 
<label  class="control-label">Descripción de la corrección</label> 
<textarea class="form-control" name="nombre_correccion_pqrs" ></textarea>
<input type="hidden" name="seccion" id="seccion" value="">

</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="correccion_pqrs"  value="1">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div></form>


</div>
</div> 
</div> 
</div> 


<?php
if (isset($_POST['crearusuarioeniris']) and ""!=$_POST['crearusuarioeniris']) {
	
	
$idcorreoempresa = 4110;  
$cargo = '';  
$fax = '';  
$movil ='';
$creado = 1642;  
$fcreado = date("Y-m-d");  
$modificado = 0;  
$fmodificado = date("Y-m-d");  


$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 

$querypp = "SELECT idcorreocontacto FROM correocontacto order by idcorreocontacto desc limit 1"; 
$resultadopp = pg_query ($querypp);
$num_resultados = pg_num_rows ($resultadopp);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$rowkk = pg_fetch_array ($resultadopp);
$cuenta=$rowkk['idcorreocontacto'];
 }


$incremental=$cuenta+1;


$consultab = sprintf("INSERT INTO correocontacto (idcorreoempresa, codigo, nombre, ndocumento, cargo, telefono, fax, movil, mail, mailpersonal, descripcion, creado, fcreado, modificado, fmodificado ) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 


GetSQLValueString('4110', "text"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString($nombre, "text"), 
GetSQLValueString($identificacion, "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($telefono, "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($correo_ciudadano, "text"), 
GetSQLValueString($correo_ciudadano, "text"), 
GetSQLValueString($direccion_ciudadano, "text"), 
GetSQLValueString(1642, "int"), 
GetSQLValueString($fcreado, "date"), 
GetSQLValueString(0, int), 
GetSQLValueString($fmodificado, "date"));


$resultado = pg_query ($consultab);


  pg_free_result($resultado);
  

  pg_close($conexionpostgresql);  

  }
  

  
  
  $queryll = " INSERT INTO correocontacto ( idcorreocontacto, idcorreoempresa, codigo, nombre, ndocumento, cargo, telefono, fax, movil, mail, mailpersonal, descripcion, creado, fcreado, 
modificado, fmodificado )  VALUES ( '$incremental', '$idcorreoempresa', '$id_ciudadano', '$nombre', '$identificacion', '$cargo', '$telefono', '$fax', '$movil', '$correo_ciudadano', 
'$correo_ciudadano', '$direccion_ciudadano', '$creado', '$fcreado', '$modificado', '$fmodificado' ) "; 
$resultll = mysql_query($queryll); 



  $updateSQLm = sprintf("UPDATE ciudadano SET idcorreocontactoiris=%s WHERE id_ciudadano=%s and estado_ciudadano=1 and id_ciudadano!=21373",   
                      GetSQLValueString($incremental, "int"),  
					 GetSQLValueString($id_ciudadano, "int"));
  $Result1m = mysql_query($updateSQLm, $conexion) or die(mysql_error());
  
  echo $insertado;
  
 echo '<meta http-equiv="refresh" content="1; url=solicitud_pqrs&'.$id.'.jsp">';
  
  } else {}
  ?>




   <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php $actualizar55 = mysql_query("SELECT count(id_solicitud_pqrs) as tota FROM solicitud_pqrs where estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row155 = mysql_fetch_assoc($actualizar55);
echo $row155['tota'];
mysql_free_result($actualizar55);
 ?>
 </h3>

              <p>Total de PQRS</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> 
<?php $actualizar55c = mysql_query("SELECT COUNT(id_solicitud_pqrs) as totac FROM clasificacion_pqrs where estado_clasificacion_pqrs=1", $conexion);
$row155c = mysql_fetch_assoc($actualizar55c);
$clasificadopqrs=$row155c['totac'];
echo $clasificadopqrs;
mysql_free_result($actualizar55c);
 ?>
</h3>

              <p>PQRS Clasificadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<?php $actualizar55ca = mysql_query("SELECT COUNT(id_solicitud_pqrs) as totaca FROM asignacion_pqrs where estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
$row155ca = mysql_fetch_assoc($actualizar55ca);
echo $row155ca['totaca'];
mysql_free_result($actualizar55ca);
 ?>
</h3>

              <p>PQRS Direccionadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
           
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3><?php echo existenciaunica('solicitud_pqrs', 'id_estado_solicitud', 3); ?></h3>
              <p>PQRS RETORNADAS A OAC.</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
           
			
          </div>
        </div>
		
	 
      </div>
	  
	  
	  
	  
	  
	  
	
	
	<div class="row">
<div class="col-md-9">
	<div class="box box-info">


 <div class="box-header with-border">
                  <h3 class="box-title">Radicado de entrada: <b style="font-size:20px;"><?php echo $radicado; ?></b></h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
<div class="row" >
<?php




if (1==$_SESSION['rol'] or (1==$_SESSION['snr_lider_pqrs'] and (24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'])))
	{
echo '<div style="text-align:right;"><a href="ciudadano&'.$id_ciudadano.'.jsp" title="Actualizar datos del Ciudadano"><i class="glyphicon glyphicon-pencil"></i></a></div>';
} else {
echo '';	
}
?>
	 <div class="col-md-6">
	 
	 
	 <?php if (5==$estado_solicitud_pqrs ) { } else { 
	
	if (1==$_SESSION['rol'] or 0<$nump89) { 
	if (1==$estado_solicitud_pqrs ) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="solicitud_pqrs" id="'.$id.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a><br>';
	}else{}
	echo '<form action="" method="post"><b>Identificador ciudadano:</b> <input type="text" value="'.$id_ciudadano.'" name="id_ciudadanopqrs"><input type="submit" value="Cambiar"></form>';
	
	} else {}
	 } ?>
			<?php
		


echo '<b>Nombre:</b> '.$nombre.'<br>';
echo '<b>Tipo de documento:</b> ';
echo ''.quees('tipo_documento', $tipod).'<br>';
echo '<b>Identificación:</b> '.$identificacion.'<br>';
echo '<b>Etnia:</b> ';
echo ''.quees('etnia', $etnia).'<br>';

if ("correotrazadepqrs@supernotariado.gov.co"==$correo_ciudadano) {
	echo '';
} else {
echo '<b>E-mail:</b> '.$correo_ciudadano.'<br>';	
}




echo '<b>Telefono:</b> '.$telefono.'<br>';
echo '<b>Sexo:</b> '.$sexociudadano.'<br>';
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';
echo '<b>Canal de entrada:</b> ';
echo ''.quees('canal_pqrs', $canal).'';


if (1==$_SESSION['rol'] or 24==$_SESSION['snr_grupo_area'] or 44==$_SESSION['snr_grupo_area'] or 45==$_SESSION['snr_grupo_area'])
	{
		
		
		if (0==$idcorreocontactoiris){ 
	echo '<form action="" method="POST" name="forfwerer5TRWETm1"><input type="hidden" name="crearusuarioeniris" value="1"><b>En Iris:</b> No, <input class="btn btn-xs btn-warning" type="submit" value="Incluir en IRIS"></form>';	
		} else {	
		echo '<br><b>En Iris:</b> Si';
}

} else {
echo '<br>';	
}

?>
</div>
 <div class="col-md-6">
<?php


if (5==$estado_solicitud_pqrs ) { } else { 
	
	if (1==$_SESSION['rol'] or 0<$nump89) { 
//	echo '<form action="" method="post"><b>Fecha de radicado:</b> <input required type="text" value="'.$fecha_radicado.'" name="fecha_radicado_corregir"><input type="submit" value="Cambiar"></form>';
	
	} else {}
	 }
	 


echo '<b>Emisi&oacute;n de respuesta: </b>';

if (2==$idrespuesta) {
echo '<span style="color:#ff0000;font-weight: bold;">'.$erespuesta.'</span><br>';
} else {
echo ''.$erespuesta.'<br>';
}

echo '<b>Departamento:</b> ';
echo ''.quees('departamento', $dep).'<br>';
echo '<b>Municipio:</b> ';

echo ''.quees('municipio', $mun).'<br>';


echo '<b>Fecha de radicado:</b> ';
echo $fecha_radicado.'<br>';
echo '<b>Tipo de PQRSD:</b> ';
echo $categoria.'<br>';
echo '<b>Estado:</b> ';
echo ''.quees('estado_solicitud', $estado_solicitud_pqrs).'<br>';
echo '<b>Radicado:</b> ';
echo ''.$radicado.'<br>';
echo '<a href="https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado.'.pdf"><img src="images/pdf.png"> Constancia</a>';
      
?>
</div>
</div>

<?php
if (2==$idrespuesta && 5==$estado_solicitud_pqrs) {
echo '<div class="row" >
	 <div class="col-md-12">
	 <br>
	 <div class="alert " role="alert" style="background:#B40404;color:#fff;"> 
	 <b>La PQRS no puedo ser enviada por correo electrónico </b> dado que el solicitante requirió que la respuesta sea 
	 enviada a la dirección de residencia.
	 <div class="salert"></div>
	 </div>

	 </div></div>';
} else { }
?>


<div class="row" >
	 <div class="col-md-12">
<?php 
echo '<br><b>Asunto</b> ';
echo $nombre_solicitud_pqrs.'<br><br>';

echo '<b>Descripción</b> '.$descripcion_solicitud_pqrs.'<br>';


if (1==$_SESSION['rol']) {
echo '<hr>';
$text = $descripcion_solicitud_pqrs;
$n_caracteres=strlen(strip_tags($text));
$n_palabras=str_word_count(strip_tags($text));

$str=strip_tags($text);
$str0=strtolower($str);
$str1=str_replace(".", ". ", $str0);

$comillas='"';
$data = array($comillas, "‘", "@", "%", "#", "$", "(", ")",  "'", "’", "la", "como", "para", "que", ".", ",", ";", "-", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "*");
$str2=str_replace($data, "", $str1);
/*
$w = explode(' ', $str2);
array_multisort(array_map('strlen', $w), SORT_DESC, SORT_NUMERIC, $w);
//echo $str;
echo "<hr>Palabras más largas: ";
echo $w[0];
echo ", ";
echo $w[1];
echo ", ";
echo $w[2];
*/


echo '<span style="color:#6699cc;">Análisis del documento:</span> ';

$arraycero = array();
$arrayuno = array();
$arraydos = array();
$arraytres = array();
$arraycuatro = array();

$tags = explode(' ',$str2);
foreach($tags as $key1) { 
if (3<strlen($key1)) {  
$rep=substr_count($str2, $key1);
//echo $rep.', ';
if (6<$rep){
array_push($arraycero, $key1);         
}
elseif (6==$rep){
array_push($arrayuno, $key1);         
}
elseif (5==$rep){
array_push($arraydos, $key1);              
}
elseif (4==$rep){
array_push($arraytres, $key1);              
}
elseif (3==$rep){
array_push($arraycuatro, $key1);              
}
else { echo '';         
}
   
}	else { echo '';}
}

//var_dump($arraycero);
echo '<br /><span style="color:#777;">Número de letras: '.$n_caracteres;
echo '<br />Número de palabras: '.$n_palabras.'</span>';

if (0<count($arraycero)){
echo '<br /><span style="color:#777;">Palabras con más de 6 apariciones: </span>';
$rcero = array_unique($arraycero);
foreach($rcero as $nivelcero) { 
echo $nivelcero.', ';
}
}

if (0<count($arrayuno)){
echo '<br /><span style="color:#777;">Palabras con 6 apariciones: </span>';
$runo = array_unique($arrayuno);
foreach($runo as $niveluno) { 
echo $niveluno.', ';
}
}
if (0<count($arraydos)){
echo '<br /><span style="color:#777;">Palabras con 5 apariciones: </span>';
$rdos = array_unique($arraydos);
foreach($rdos as $niveldos) { 
echo $niveldos.', ';
}
}
if (0<count($arraytres)){
echo '<br /><span style="color:#777;">Palabras con 4 apariciones: </span>';
$rtres = array_unique($arraytres);
foreach($rtres as $niveltres) { 
echo $niveltres.', ';
}
}
if (0<count($arraycuatro)){
echo '<br /><span style="color:#777;">Palabras con 3 apariciones: </span>';
$rcuatro = array_unique($arraycuatro);
foreach($rcuatro as $nivelcuatro) { 
echo $nivelcuatro.', ';
}
}



echo '<hr>';
} else {}

$query = sprintf("SELECT * FROM documento_pqrs where nombre_documento_pqrs!='Constancia de la solicitud' and id_solicitud_pqrs='$idso' and id_clase_documento=1 and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

	echo '<br><b>Documentos adjuntos</b>  ';
	
if (1==$_SESSION['rol'] or 24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'])
{
	echo '<a href="anexos_pqrs&'.$id.'.jsp"><span class="glyphicon glyphicon-edit"></span></a>';
} else { }


if (0<$totalRows){

echo '<br><br>';
	
	
do {
	
      echo '<a href="files/'.$row['carpeta'].''.$row['url_documento'].'" target="_black"><img src="images/pdf.png"> '.$row['nombre_documento_pqrs'].'</a>';
       echo '<br>';
      echo 'Subido: '.$row['fecha_subida'].'<br><br>';


	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);





			
			?>
			
		</div>  
    </div>      
     <hr>


<?php
$querybf = sprintf("SELECT * FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1 order by id_requerir_pqrs desc limit 1"); 
$selectbf = mysql_query($querybf, $conexion) or die(mysql_error());
$rowbf = mysql_fetch_assoc($selectbf);
$totalRowsbf = mysql_num_rows($selectbf);
if (0<$totalRowsbf) { 

$nombre_requerir_pqrs=$rowbf['nombre_requerir_pqrs'];
$respuesta_pre_ciudadano=$rowbf['respuesta_pre_ciudadano'];
$id_requerir_pqrs=$rowbf['id_requerir_pqrs'];
$correo_oficina=$rowbf['correo_oficina'];
?>
<hr>
<div>
<h4><b>Requerimiento</b></h4>

<?php if (isset($rowbf['radicado_requerimiento'])) { ECHO '<H3>'.$rowbf['radicado_requerimiento'].'</H3>'; 
echo '<div style="text-align:right;"><a href="pdf/requerimiento&'.$id.'.pdf" download="'.$rowbf['radicado_requerimiento'].'.pdf"><img src="images/pdf.png"></a></div>';

} else {

if (5==$estado_solicitud_pqrs) { 

} else {
	?>
<div class="row" >
<div class="col-md-3">
<?php if (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['rol'] or 1==$_SESSION['snr_grupo_cargo']) { ?>
<a href="" id="2" class="btn btn-primary botonseccion" data-toggle="modal" data-target="#popupcorreccion_pqrs" style="width:100%;">
<span class="glyphicon glyphicon-pencil"></span>  Corregir
</a>
<?php } else { } ?>
</div>
<div class="col-md-3">
<?php if (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['rol'] or 1==$_SESSION['snr_grupo_cargo']) { ?>
<form action="" method="POST" name="ftrf45435hy234truyuy">
<input type="hidden" name="vistob_pqrs" value="1">
<input type="hidden" name="seccion" value="2">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-ok"></span>  Visto bueno</button>
</form>
<?php } else { } ?>
</div>
<div class="col-md-3"> 
<a href="solicitud_pqrs&<?php echo $id; ?>&2.jsp" class="btn btn-warning" style="width:100%" >
<span class="glyphicon glyphicon-pencil"></span>    Modificar</a>
<BR><BR>
<BR>
</div>
<div class="col-md-3"> 
<?php if ((1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['rol']) && ""!=$correo_ciudadano) { ?>
<form action="" method="POST" name="f22345345trfhy234try">
<input type="hidden" name="aprobar_requerir_pqrs" value="1">
<input type="hidden" name="seccion" value="2">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-envelope"></span>  Aprobar y enviar</button>
</form>
<?php } else {} ?>
<BR>
</div>
</div>
<?php } } ?>
<div class="row" >
<div class="col-md-12">
<?php
$query = sprintf("SELECT * FROM correccion_pqrs, tipo_accion where seccion=2 and correccion_pqrs.id_tipo_accion=tipo_accion.id_tipo_accion and id_solicitud_pqrs=".$id." and estado_correccion_pqrs=1 order by id_correccion_pqrs"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo 'Acciones:<ol>';
do {
	echo '<li><b>'.$row['nombre_tipo_accion'].'</b> de ';
	echo quees('funcionario', $row['id_funcionario']);
	
	echo ' / '.$row['fecha_correccion_pqrs'].'</span>: '.$row['nombre_correccion_pqrs'].'</li>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 	echo '</ol>';
} else {}	 
mysql_free_result($select);

 ?>

</div>
</div>
<hr>
<?php if (isset($_GET['e']) and 2==$_GET['e'] && 5>$estado_solicitud_pqrs) { ?>

<label  class="control-label">MODIFICAR REQUERIMIENTO:</label> 
<form action="solicitud_pqrs&<?php echo $id; ?>.jsp" method="POST" name="f34o23434r44m1f456456tregg">
<div class="form-group text-left" spellcheck="true" lang="es" > 
<textarea class="textarea" name="nombre_requerir_pqrs" id="nombre_requerir_pqrs" style="min-height:400px; " spellcheck="true" lang="es" >
<?php 
echo $nombre_requerir_pqrs; 
?>
</textarea>
</div>
<div class="modal-footer">
<input type="hidden" name="seccion"  value="2">
<input type="hidden" name="id_requerir_pqrs"  value="<?php echo $id_requerir_pqrs; ?>">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Modificar</button></div>
</form>

<?php } else {

echo $nombre_requerir_pqrs;

}	?>




</div>
<hr>
<hr>
<div>

<h4><b>Respuesta preliminar a ciudadano</b></h4>
<?php if (isset($rowbf['radicado_ciudadano'])) { ECHO '<H3>'.$rowbf['radicado_ciudadano'].'</H3>'; 
echo '<div style="text-align:right;"><a href="pdf/preliminar&'.$id.'.pdf" download="'.$rowbf['radicado_ciudadano'].'.pdf"><img src="images/pdf.png"></a></div>';

} else { 

if (5==$estado_solicitud_pqrs) { 
} else {
?>
<div class="row" >
<div class="col-md-3">
<?php if (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['rol'] or 1==$_SESSION['snr_grupo_cargo']) { ?>
<a href="" id="3" class="btn btn-primary botonseccion"  data-toggle="modal" data-target="#popupcorreccion_pqrs" style="width:100%;">
<span class="glyphicon glyphicon-pencil"></span>  Corregir
</a>
<?php } else { } ?>
</div>
<div class="col-md-3">
<?php if (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['rol'] or 1==$_SESSION['snr_grupo_cargo']) {?>
<form action="" method="POST" name="f234trf45435hy234try">
<input type="hidden" name="vistob_pqrs" value="1">
<input type="hidden" name="seccion" value="3">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-ok"></span>  Visto bueno</button>
</form>
<?php } else { } ?>
</div>
<div class="col-md-3"> 
<a href="solicitud_pqrs&<?php echo $id; ?>&3.jsp" class="btn btn-warning" style="width:100%" >
<span class="glyphicon glyphicon-pencil"></span>   &nbsp; Modificar</a>
<BR><BR>
<BR>
</div>
<div class="col-md-3"> 
<?php if ((1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['rol']) && ""!=$correo_ciudadano) { ?>
<form action="" method="POST" name="ft3423rfhy234try">
<input type="hidden" name="aprobar_mensaje_ciudadano" value="1">
<input type="hidden" name="seccion" value="3">
<input type="hidden" name="correo_ciudadano" value="<?php echo $correo_ciudadano; ?>">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-envelope"></span>  Aprobar y enviar</button>
</form>
<?php } else {} ?>
<BR>
</div>
</div>
<?php } } ?>
<div class="row" >
<div class="col-md-12">
<?php
$query = sprintf("SELECT * FROM correccion_pqrs, tipo_accion where seccion=3 and correccion_pqrs.id_tipo_accion=tipo_accion.id_tipo_accion and id_solicitud_pqrs=".$id." and estado_correccion_pqrs=1 order by id_correccion_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo 'Acciones:<ol>';
do {
	echo '<li><b>'.$row['nombre_tipo_accion'].'</b> de ';
	echo quees('funcionario', $row['id_funcionario']);
	
	echo ' / '.$row['fecha_correccion_pqrs'].'</span>: '.$row['nombre_correccion_pqrs'].'</li>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 	echo '</ol>';
} else {}	 
mysql_free_result($select);

 ?>

</div>
</div>
<hr>
<?php if (isset($_GET['e']) and 3==$_GET['e'] && 5>$estado_solicitud_pqrs) { ?>

<label  class="control-label">MODIFICAR RESPUESTA AL CIUDADANO:</label> 
<form action="solicitud_pqrs&<?php echo $id; ?>.jsp" method="POST" name="fo342543523434r44m1f456456tregg">
<div class="form-group text-left" spellcheck="true" lang="es" > 
<textarea class="textarea" name="respuesta_pre_ciudadano" id="respuesta_pre_ciudadano" style="min-height:400px; " spellcheck="true" lang="es" >
<?php 
echo $respuesta_pre_ciudadano; 
?>
</textarea>
</div>
<div class="modal-footer">
<input type="hidden" name="seccion"  value="3">
<input type="hidden" name="id_requerir_pqrs"  value="<?php echo $id_requerir_pqrs; ?>">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Modificar</button></div>
</form>

<?php } else {

echo $respuesta_pre_ciudadano;

}	?>



</div>


<?php
$queryb = sprintf("SELECT * FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1"); 
$selectb = mysql_query($queryb, $conexion) or die(mysql_error());
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);
$nombre_requerir_pqrs=$rowb['nombre_requerir_pqrs'];
$radicado_requerimiento=$rowb['radicado_requerimiento'];


if (0<$totalRowsb) {
	
	
	//if ((isset($rowb['respuesta_requerimiento']) and ""!=$rowb['respuesta_requerimiento'] ) or (isset($rowb['radicado_respuesta']))) {
		
		echo '<hr><h4><b>Respuesta del requerimiento</b></h4>';
		
		
echo '<hr>';


if ((isset($rowb['respuesta_requerimiento']) and ""!=$rowb['respuesta_requerimiento'] ) or (isset($rowb['radicado_respuesta']))) {

echo '<div style="text-align:right;"><a href="pdf/respuestarequerimiento&'.$id.'.pdf" download="respuesta_'.$radicado_requerimiento.'.pdf"><img src="images/pdf.png"></a></div>';

echo $rowb['fecha_respuestar']; 
echo '<br><h3>';
echo $rowb['radicado_respuesta']; 
echo '</h3><br>';
echo $rowb['respuesta_requerimiento']; 
echo '<br>';
} else {
	echo '<h3>NO EXISTE RESPUESTA DE TEXTO DEL NOTARIO';
	
}



$query = sprintf("SELECT * FROM documento_pqrs where id_solicitud_pqrs=".$id." and id_clase_documento=3 and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo ', SI ADJUNTOS</h3>';
	$documento=1;
	echo '<br><label  class="control-label">Anexos:</label><br>';
	
do {
	
	
echo '<a title="'.$row['fecha_subida'].' - HASH: '.$row['hash_documento'].'" href="files/'.$row['carpeta'].''.$row['url_documento'].'" target="_blank"><img src="images/pdf.png"> ';


if (40<strlen($row['nombre_documento_pqrs'])){
echo trim(substr($row['nombre_documento_pqrs'],0,40)).' (...)';
} else {
echo $row['nombre_documento_pqrs'];
}

echo '</a> ';
if (isset($row['id_funcionario'])) {
	echo '- Adjunto: ';
echo quees('funcionario', $row['id_funcionario']);
} else { }

/*
if (isset($row1['radicado_salida']) or ""!=$row1['radicado_salida']) {
	} else {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_pqrs" id="'.$row['id_documento_pqrs'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
}
*/

echo '<br>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 
	
	
} else { 

$documento=0;
echo '</h3>';
}	 
mysql_free_result($select);






 //} else { }
	 
	



} else {}
?>

<hr>
<hr>
<h4><b>Respuesta de fondo</b></h4>
<?php	 
} else { }




mysql_free_result($selectbf);




$consultag = mysql_query("SELECT id_clasificacion_pqrs FROM clasificacion_pqrs WHERE id_solicitud_pqrs=".$id." and estado_clasificacion_pqrs=1 limit 1", $conexion);
$row1g = mysql_fetch_assoc($consultag);
$nng = mysql_num_rows($consultag);


if (0<$nng) {




$consulta = mysql_query("SELECT id_respuesta_pqrs, nombre_respuesta_pqrs, id_funcionario, id_funcionario_reviso FROM respuesta_pqrs WHERE id_solicitud_pqrs='$id' and estado_respuesta_pqrs=1 limit 1", $conexion);
$row1 = mysql_fetch_assoc($consulta);
$nn = mysql_num_rows($consulta);
if (0<$nn) {
 

 if (isset($_GET['e']) and 1==$_GET['e']) { } else { ?>
<div class="row" >
<div class="col-md-12"> 
<?php 

if (5==$estado_solicitud_pqrs) {
echo 'Radicado de salida: <b style="font-size:20px;">'.$row4['radicado_respuesta'].'</b>';
echo '<br>Fecha de respuesta: '.$row4['fecha_respuestaf'].'';
	} else { }
?>
</div>
</div>

<div class="row" >
<div class="col-md-2">
<?php
if (0<$sigrupo && 4==$estado_solicitud_pqrs && ((1==$_SESSION['rol']) or (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'])))
	{
	?>
<a href="" id="1" class="btn btn-primary botonseccion" data-toggle="modal" data-target="#popupcorreccion_pqrs" style="width:100%;">
 <span class="glyphicon glyphicon-pencil"></span>  Corregir
   </a>
<?php 

 } else {}
 ?>

</div>



<div class="col-md-2">
<?php
if (0<$sigrupo && 4==$estado_solicitud_pqrs && ((1==$_SESSION['rol']) or (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'])))
	{
	?>

 <form action="" method="POST" name="ftrf45435fgq435hy234try">
<input type="hidden" name="vistob_pqrs" value="1">
<input type="hidden" name="seccion" value="1">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-ok"></span>  Visto bueno</button>
</form>


<?php 

 } else {}
 ?>

</div>



<div class="col-md-3"> 
<?php 
if (0<$sigrupo) {

if (5==$estado_solicitud_pqrs) { } else {
?>
<a href="solicitud_pqrs&<?php echo $id; ?>&1.jsp" class="btn btn-warning" style="width:100%" >
<span class="glyphicon glyphicon-pencil"></span>   &nbsp; Modificar</a>
<?php 
}
 } else {} ?>
<BR><BR>
<BR>
</div>
<div class="col-md-3"> 
<?php if ((1 == intval($_SESSION['rol'])) or (1==$_SESSION['snr_grupo_cargo']) or (24 == $_SESSION['snr_grupo_area'] and 1==$_SESSION['snr_lider_pqrs']) or (1==$_SESSION['snr_lider_pqrs'] and 1==intval($_SESSION['aprueba_pqrs']))) {
?>


<?php 

if ((0<$sigrupo or 1 ==$_SESSION['rol']) && ""!=$correo_ciudadano) {

if (4==$estado_solicitud_pqrs and ((1 ==$_SESSION['rol']) or (1==$_SESSION['snr_grupo_cargo']) or (1==$_SESSION['aprueba_pqrs']) or (24 == $_SESSION['snr_grupo_area'] and 1==$_SESSION['snr_lider_pqrs']))) { 
?>
<form action="" method="POST" name="ftrfhy234try">
<input type="hidden" name="enviar_pqrs" value="<?php echo $id; ?>">
<input type="hidden" name="seccion" value="1">
<input type="hidden" name="respuesta_pqrs_full" value="<?php echo strip_tags($row1['nombre_respuesta_pqrs']);  ?>">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-envelope"></span>  Aprobar y enviar</button>
</form>
<BR>

<?php

} else { } 


} else { 

if (4==$estado_solicitud_pqrs) {
	 echo '<span style="color:#6699cc;">BORRADOR</span>'; 
} else {
	
	
}


}
 ?>

<?php } else {} ?>
</div>
<div class="col-md-2"> 
<?php 


if (5==$estado_solicitud_pqrs ) { ?>
<a href="https://servicios.supernotariado.gov.co/pqrs/pdf/<?php echo $row4['radicado_respuesta']; ?>.pdf" download="<?php echo $row4['radicado_respuesta']; ?>.pdf" class="btn btn-danger" style="width:100%" >
<span class="glyphicon glyphicon-file"></span>   &nbsp; PDF </a>
<?php } else {

if (0<$sigrupo) {
	?>
<a href="pdf/pqrs&<?php echo $id; ?>.pdf" style="width:100%" >
<img src="images/pdf.png"> Ver borrador de respuesta </a>



<?php 

 } else {}
 
} 

?>
<BR><BR>
</div>
</div>
<?php } ?>



<div class="row" >
<div class="col-md-12">
<?php
$query = sprintf("SELECT * FROM correccion_pqrs, tipo_accion where seccion=1 and correccion_pqrs.id_tipo_accion=tipo_accion.id_tipo_accion and id_solicitud_pqrs=".$id." and estado_correccion_pqrs=1 order by id_correccion_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo 'Acciones:<ol>';
do {
	echo '<li><b>'.$row['nombre_tipo_accion'].'</b> de ';
	echo quees('funcionario', $row['id_funcionario']);
	
	echo ' / '.$row['fecha_correccion_pqrs'].'</span>: '.$row['nombre_correccion_pqrs'].'</li>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 	echo '</ol>';
} else {}	 
mysql_free_result($select);

 ?>

</div>
</div>


<div class="row" >

<?php if (isset($_GET['e']) and 1==$_GET['e']) { ?>



<?php if (5==$estado_solicitud_pqrs) { } else { 



if (0<$sigrupo) {
	
?>
	
<div class="col-md-12" >
<label  class="control-label">MODIFICAR RESPUESTA:</label> 
<form action="solicitud_pqrs&<?php echo $id; ?>.jsp" method="POST" name="for44m1f456456tregg">
<div class="form-group text-left" spellcheck="true" lang="es" > 
<textarea  class="textarea" name="nombre_respuesta_pqrs2" id="texto_modelo_respuesta_pqrs2" style="min-height:400px; " spellcheck="true" lang="es" >
<?php 
echo $row1['nombre_respuesta_pqrs']; 
?>
</textarea>
</div>

<div class="modal-footer">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Modificar respuesta </button></div>
<input type="hidden" name="id_res"  value="<?php echo $row1['id_respuesta_pqrs']; ?>">
<input type="hidden" name="seccion"  value="1">
</form>
</div>
<?php 
} else {}


} ?>	
	
	
<?php } else { ?>





<div class="col-md-12" style="background:#f1f1f1;padding: 15px 15px 15px 15px;"> 

<?php 



echo $row1['nombre_respuesta_pqrs'];
echo '<br><br><br>'; 


 if (5==$estado_solicitud_pqrs) {
echo ''.quees('funcionario', $row1['id_funcionario_reviso']).'';
//if (1==$row1['encargado']) { echo ' (E) '; } else { }


if (2==tipooficinafun($row1['id_funcionario_reviso'])) { 
echo '<br>OFICINA DE REGISTRO DE INSTRUMENTOS PÚBLICOS';
} else {	
echo '<br>SUPERINTENDENCIA DE NOTARIADO Y REGISTRO';
}


	} else {
		
	}

echo '<br><br>Proyecto<br>';
echo quees('funcionario', $row1['id_funcionario']);

if (2==tipooficinafun($row1['id_funcionario'])) { 
echo '<br>OFICINA DE REGISTRO DE INSTRUMENTOS PÚBLICOS';
} else {	
echo '<br>SUPERINTENDENCIA DE NOTARIADO Y REGISTRO';
}


 ?>


 </div>
<?php } ?>

</div>
	

	<hr>
<?php 



if (0<$sigrupo) {
	


if (5==$estado_solicitud_pqrs) { } else {
?>
<div class="row">
<div class="col-md-12">
<label  class="control-label">Adjuntar documentos: </label>  <span style="color:#ff0000;">Solo admite documento PDF inferior a 4 Megas</span>
</div>
</div>


<form action="" method="POST" name="for4345113454m1ftregg" enctype="multipart/form-data" >
<div class="row">
<div class="col-md-7">
<input type="hidden" name="nombre_respuesta_pqrs_documento" value="<?php echo 'Adjunto_'.$radicado.'_'.date("YmdHis"); ?>">
<input type="file" name="file">
</div>
<div class="col-md-5">
<button type="submit" class="btn btn-danger">
<span class="glyphicon glyphicon-paperclip"></span> Adjuntar documento </button>
</div>
</div>
</form>
<?php } 


}


 } else {



if (0<$sigrupo && 0<$nng && (2==$estado_solicitud_pqrs or 6==$estado_solicitud_pqrs or 7==$estado_solicitud_pqrs or 8==$estado_solicitud_pqrs)) {


	?>
<div class="row botonrespuesta" >
<div class="col-md-12 text-center">  
		<a id="respuesta" class="btn btn-lg btn-success" style="width:80%;">
		          <span class="glyphicon glyphicon-ok"></span>  RESPONDER </a>
	</div>
</div>
	
<div class="row formulariorespuesta" style="display:none;">
<div class="col-md-12 text-center">
<!--
Modelos de respuesta:
<select class="form-control" id="modelo_respuesta_pqrs">
<?php //echo lista('modelo_respuesta_pqrs');  ?>
</select>
<br>
-->

<form action="" method="POST" name="for44m1ftregg">
<div class="form-group text-left" spellcheck="true" lang="es" > 
<label  class="control-label">RESPUESTA:</label> 
<textarea class="textarea" name="nombre_respuesta_pqrs" id="texto_modelo_respuesta_pqrs" style="min-height:400px;" spellcheck="true" lang="es" >
<?php
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Señor(a) 
<br>
<?php echo $nombre; 
?>
<br>
<br>
ASUNTO: Respuesta al radicado <?php echo $radicado; ?>
<br><br>
Respetado(a) señor(a):
<br><br>

</textarea>
</div>

<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear respuesta </button>
</div>
</form>
<hr>


<div class="row">
<div class="col-md-12">
<label  class="control-label">Adjuntar documentos: </label>  <span style="color:#ff0000;">Solo admite documento PDF inferior a 4 Megas</span>
</div>
</div>
<form action="" method="POST" name="for4345113454m1ftregg" enctype="multipart/form-data" >
<div class="row">
<div class="col-md-7">
<input type="hidden" name="nombre_respuesta_pqrs_documento" value="<?php echo 'Adjunto_'.$radicado.'_'.date("YmdHis"); ?>">
<input type="file" name="file">
</div>
<div class="col-md-5">
<button type="submit" class="btn btn-danger">
<span class="glyphicon glyphicon-paperclip"></span> Adjuntar documento </button>
</div>
</div>
</form>

</div>
</div>

<?php 

} else {}

}
}
?>
<br>
<br>
<div>
<?php


$query = sprintf("SELECT * FROM documento_pqrs where id_solicitud_pqrs='$idso' and id_clase_documento=2 and id_ciudadano='$id_ciudadano' and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	$documento=1;
	echo '<label  class="control-label">Documentos:</label><br>';
	
do {
	
	
echo '<a title="'.$row['fecha_subida'].' - HASH: '.$row['hash_documento'].'" href="files/'.$row['carpeta'].$row['url_documento'].'" target="_blank"><img src="images/pdf.png"> ';


if (40<strlen($row['nombre_documento_pqrs'])){
echo trim(substr($row['nombre_documento_pqrs'],0,40)).' (...)';
} else {
echo $row['nombre_documento_pqrs'];
}

echo '</a>';

if (0<$sigrupo or 1==$_SESSION['rol']) {
if (5==$estado_solicitud_pqrs) { } else {
	
if (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['rol'] or 1==$_SESSION['snr_grupo_cargo']) {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_pqrs" id="'.$row['id_documento_pqrs'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else { }

}
} else {}

echo '<br>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 
	
	
} else { $documento=0;}	 
mysql_free_result($select);
?>
</div>		  
 </div>  			  

	
			
              <!-- /.table-responsive -->
            </div>
        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
<div class="col-md-3">
<div class="box box-primary direct-chat direct-chat-danger" >
    <div class="box-header with-border">
            <h3 class="box-title">
			
<?php	  


if ((2>=$_SESSION['snr_tipo_oficina']) && (((1==$_SESSION['snr_grupo_cargo'] or  1==intval($_SESSION['aprueba_pqrs'])) and (0<$sigrupo)) or 1==$_SESSION['rol'])) { 

 if (5==$estado_solicitud_pqrs) { echo 'RETORNA A OAC.'; } else { ?>
  
		<a href="" id="<?php echo $radicado; ?>" class="btn btn-danger ventana1" class="ventana1" data-toggle="modal" data-target="#popupretornar" style="width:100%;">
	    
	
	    
		<span class=""></span>  RETORNAR PQRS A OAC. </a>
		
		<?php } } else { echo 'RETORNA A OAC.'; }?> 
		
		
			</h3>
		<div class="box-tools pull-right">       
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
  </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">

<?php


$query489 = sprintf("SELECT * FROM retorno_pqrs where id_solicitud_pqrs=".$id." and estado_retorno_pqrs=1 order by id_retorno_pqrs desc"); 
$result89 = $mysqli->query($query489);

	while($row99 = $result89->fetch_array(MYSQLI_ASSOC)) {
		
	
			echo ''.quees('tipo_oficina', $row99['id_tipo_oficina']).'<br>';
		
		echo '<span style="color:#B40404">';
if (1==$row99['id_tipo_oficina']) { echo ''.quees('area', $row99['codigo_oficina']).':<br>'; }
elseif (2==$row99['id_tipo_oficina']) { echo ''.quees('oficina_registro', $row99['codigo_oficina']).':<br>'; }
elseif (3==$row99['id_tipo_oficina']) { echo ''.quees('notaria', $row99['codigo_oficina']).':<br>'; }
elseif (4==$row99['id_tipo_oficina']) { echo ''.quees('curaduria', $row99['codigo_oficina']).':<br>'; }
else {}	


			
			echo '</span> "<i>'.$row99['nombre_retorno_pqrs'].'</i>"';
			 echo '<br>'.$row99['fecha_retorno_pqrs'].'<hr>'; 
	}
	$result89->free();
	
	

			?>

		</div>
	</div>	
</div>  
		   
		
		
		
		
		
		
		
		
		
		
<div class="box box-primary direct-chat direct-chat-warning" >
    <div class="box-header with-border">
                  <h3 class="box-title">
<?php  if (((24 == $_SESSION['snr_grupo_area'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'])) or 1==$_SESSION['rol']) and 1<$estado_solicitud_pqrs) { ?>

<?php if (5==$estado_solicitud_pqrs) { echo 'CLASIFICACIÓN DE  PQRSD'; } else { ?>
		   <a href="" id="<?php echo $radicado; ?>" class="btn btn-primary ventana1" class="ventana1" data-toggle="modal" data-target="#popupclasificarpqrs" style="width:100%;">
		          <span class=""></span> CLASIFICAR PQRSD </a>
<?php } ?>
<?php } else { ?>
CLASIFICACIÓN DE  PQRSD
<?php } ?>
				  
			
				  </h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
<?php
$query48 = sprintf("SELECT * FROM clasificacion_pqrs where id_solicitud_pqrs=".$id." and estado_clasificacion_pqrs=1 order by id_clasificacion_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		echo '<span style="color:#777;">'.$row9['fecha_clasificacion'].'</span><br>';
	if (5!=$estado_solicitud_pqrs && (1==$_SESSION['rol'] or ((1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['snr_grupo_cargo']) and 24==$_SESSION['snr_grupo_area'])))
		{	echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="clasificacion_pqrs" id="'.$row9['id_clasificacion_pqrs'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a> '; } else {}
			echo ''.quees('categoria_oac', $row9['id_categoria_oac']).' / ';
			echo ''.quees('clase_oac', $row9['id_clase_oac']).': ';
			$dias_terminos=dias_terminos($row9['id_clase_oac'],$fecha_radicado);
			//echo '<b>'.$dias_terminos.' dias.</b> / ';
if (isset($row9['id_tema_oac']) && 0!= $row9['id_tema_oac']){ echo ''.quees('tema_oac', $row9['id_tema_oac']).' / '; } else { }
if (isset($row9['id_motivo_oac']) && 0!= $row9['id_motivo_oac']){ echo ''.quees('motivo_oac', $row9['id_motivo_oac']).'  -  '; } else { }
		
			

	
if (1<$dias_terminos and 5!=$estado_solicitud_pqrs){
	
	if (6==$estado_solicitud_pqrs or 7==$estado_solicitud_pqrs) {  
	echo '<br>Se ampliaron los terminos.';
	} else {
	
	echo '(<b>Terminos: '.$dias_terminos.' dias habiles</b>)<br>';

	
	$fechavence=fechahabil($fecha_radicado,$dias_terminos);


	
$fechavence1=explode("-", $fechavence);
	
$anof=$fechavence1[0];
$mesf=$fechavence1[1];
$diaf=$fechavence1[2];
			?>
			
			
			<script type="text/javascript">

function ocultar() {

}
    var ayo = <?php echo $anof; ?>;
	var mes = <?php echo $mesf; ?>; 
	var dia = <?php echo $diaf; ?>;
	var hora = 23;
	var minuto = 59;
	var segundo = 59;
	
 
	var id;
	if (!id) { id = 1; }
	else { id++; }
 
 

document.write("Vence: <span id='evento" + id + "'></span> <br /> Tiempo restante: ");
document.write("<span style='color:#990000;' id='contar" + id + "'></span>");
	

setInterval('contar('+ayo+','+mes+','+dia+','+hora+','+minuto+','+segundo+',' + id + ')',1000);




function contar(ayo,mes,dia,hora,minuto,segundo,id) {
	var dif = ayo + '-' + mes + '-' + dia + ' &nbsp;/&nbsp; ' + hora + ':';
	if (minuto < 10) { dif+='0'; }
	dif+=minuto + ':';
	
	if (segundo < 10) { dif+='0'; }
	dif+=segundo;
	
	document.getElementById('evento' + id).innerHTML=dif
	var a = new Date();
	dif = new Date(ayo,mes - 1,dia,hora,minuto,segundo);
	dif = (dif.getTime() - a.getTime())/1000;
	if (dif < 0) { document.getElementById('contar' + id).innerHTML="<font color='#777'> Ya vencio</font>";
	document.getElementById('examen').style.display='none';
    setTimeout("paso();",100);
	
	}
	else {
		dia= Math.floor(dif/60/60/24);
		hora= Math.floor((dif - dia*60*60*24)/60/60);
		minuto= Math.floor((dif - dia*60*60*24 - hora*60*60)/60);
		segundo= Math.floor(dif - dia*60*60*24 - hora*60*60 - minuto*60);
		var txt = '';
		if (dia > 0) {
			txt=dia+' d&iacute;a';
			if (dia != 1) { txt+='s'; }
			txt+= ', ';
		}
		if (hora > 0 || dia > 0) {
			txt+=hora+' hora';
			if (hora != 1) { txt+='s'; }
			txt+= ', ';
		}
		if (minuto > 0 || hora > 0 || dia > 0) {
			txt+=minuto+' minuto';
			if (minuto != 1) { txt+='s'; }
			txt+= ', ';
		}
		txt+=segundo+' segundo';
		if (segundo != 1) { txt+='s'; }
		document.getElementById('contar' + id).innerHTML=txt;
	}
}
</script>
			
			
<?php
} 
			
}	else {
	
	
	echo '(<b>Terminos: '.$dias_terminos.' dias habiles</b>)<br>';

	$fechavence=fechahabil($fecha_radicado,$dias_terminos);
	echo $fechavence;
	
}	
			
			
			
			echo '<hr>';
	}
	$result8->free();
?>
		</div>
	</div>	
</div>

		  
		  
		 

<?php
if (isset($_POST['desvincular_asignacion_pqrs']) && ""!=$_POST['desvincular_asignacion_pqrs'] && (1==$_SESSION['rol'] or 41==$_SESSION['snr_grupo_area']))  {
$infodes=intval($_POST['desvincular_asignacion_pqrs']);
$updateSQL77 = sprintf("UPDATE asignacion_pqrs SET estado_asignacion_pqrs=%s WHERE id_asignacion_pqrs=%s and id_solicitud_pqrs=%s and estado_asignacion_pqrs=1",                  
					  GetSQLValueString(0, "int"),
					  GetSQLValueString($infodes, "int"),
					  GetSQLValueString($id, "int"));
$Result177 = mysql_query($updateSQL77, $conexion) or die(mysql_error());
	
$queryk = sprintf("SELECT funcionario.id_funcionario FROM asignacion_pqrs_funcionario, funcionario where asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and funcionario.id_tipo_oficina=1 and funcionario.id_grupo_area=41 and asignacion_pqrs_funcionario.id_solicitud_pqrs=".$id." and estado_asignacion_pqrs_funcionario=1 and estado_funcionario=1"); 
$selectk = mysql_query($queryk, $conexion) or die(mysql_error());
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk)
{
	do {
	$fundevincula=intval($rowk['id_funcionario']);
	
$updateSQL77 = sprintf("UPDATE asignacion_pqrs_funcionario SET estado_asignacion_pqrs_funcionario=%s WHERE id_funcionario=%s and id_solicitud_pqrs=%s and estado_asignacion_pqrs_funcionario=1",                  
					  GetSQLValueString(0, "int"),
					  GetSQLValueString($fundevincula, "int"),
					  GetSQLValueString($id, "int"));
$Result177 = mysql_query($updateSQL77, $conexion) or die(mysql_error());
	
	 } while ($rowk = mysql_fetch_assoc($selectk)); 
} else {
}	 
mysql_free_result($selectk);



	
} else {}
?>
		 
		  

		  
<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
                  <h3 class="box-title">

				  
<?php
$numclasi=existenciaunica('clasificacion_pqrs', 'id_solicitud_pqrs', $id);
if (0<$numclasi) {
?>
				  
<?php  if (((24 == $_SESSION['snr_grupo_area']) and (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['snr_grupo_cargo']))  or 1==$_SESSION['rol']) { ?>



<?php

if (5==$estado_solicitud_pqrs) { echo '<span class="glyphicon glyphicon-inbox"></span>  DIRECCIONAMIENTO'; } else { 

$nasignacion=existenciaunica('asignacion_pqrs', 'id_solicitud_pqrs', $id);
if (0<$nasignacion) {  echo '<span class="glyphicon glyphicon-inbox"></span> DIRECCIONAMIENTO'; } else {
?>
	<a href="" id="<?php echo $radicado; ?>" class="btn btn-warning ventana1" class="ventana1" data-toggle="modal" data-target="#popupdireccionarpqrs" href="" style="width:100%;">
	    <span class="glyphicon glyphicon-inbox"></span>  DIRECCIONAMIENTO</a>
<?php
} 

 } } else { echo ' <span class="glyphicon glyphicon-inbox"></span> DIRECCIONAMIENTO'; } ?>

<?php
} else { echo 'Se debe clasificar para poder direccionar.'; }
?>

				  </h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
<?php
$query48 = sprintf("SELECT * FROM asignacion_pqrs where id_solicitud_pqrs=".$id." and estado_asignacion_pqrs=1  order by id_asignacion_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
		
echo ''.quees('tipo_oficina', $row9['id_tipo_oficina']);
	if (1==$_SESSION['rol'] && 5!=$estado_solicitud_pqrs) {		
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="asignacion_pqrs" id="'.$row9['id_asignacion_pqrs'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
			echo '<br>';
		
if (1==$row9['id_tipo_oficina']) { echo ''.quees('area', $row9['codigo_oficina']).' ';





if ((1==$_SESSION['rol'] or (41==$_SESSION['snr_grupo_area'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs']))) and 9==$row9['codigo_oficina']){ 
echo '<form method="POST" action="" name="formulario_desvincular">
<input type="hidden" name="desvincular_asignacion_pqrs" value="'.$row9['id_asignacion_pqrs'].'">';
echo '<button type="submit" class="confirmadesvincular">
<span class="glyphicon glyphicon-trash" style="color:#ff0000;cursor: pointer"></span>
</button></form>';
} else {
	echo '<br>';
}

echo ''; }
elseif (2==$row9['id_tipo_oficina']) { echo ''.quees('oficina_registro', $row9['codigo_oficina']).'<br>'; }
elseif (3==$row9['id_tipo_oficina']) { echo ''.quees('notaria', $row9['codigo_oficina']).'<br>'; }
elseif (4==$row9['id_tipo_oficina']) { echo ''.quees('curaduria', $row9['codigo_oficina']).'<br>'; }
else {}		

			echo ''.$row9['fecha_asignacion'].'';
			
			if (isset($row9['nombre_asignacion_pqrs'])){
			echo '<br>"<i>'.$row9['nombre_asignacion_pqrs'].'</i>"';
			} else {}
			
			
			
			
			
			
			if (1==$row9['id_consolidar']) { echo ' <span class="label label-danger">Consolida</span>'; } else {}
			
			if (1==$row9['marca_retorno']) { echo ' <span class="label label-danger">Retornada a OAC - '.$row9['fecha_retorno'].'</span>'; 
			
			echo '<br>"<i>'.$row9['retorno_pqrs'].'</i>"<hr>';
			
			} else {}
			
			
			echo'<hr>';
	}
	$result8->free();
?>



		</div>
	</div>	
</div>  
		  
		  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
<?php 

if (isset($_POST['dias_ampliados']) && ((0<$sigrupo && 1==$_SESSION['snr_grupo_cargo'] && 3>$_SESSION['snr_tipo_oficina']) or 1==$_SESSION['rol'])) {
	
$dias_ampliados=$_POST['dias_ampliados'];
$ampliacion_terminos=$_POST['ampliacion_terminos'];
	

$updateSQL77997 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s, dias_ampliacion=%s, fecha_inicio_ampliacion=now(), texto_ampliacion=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(6, "int"),
					  GetSQLValueString($dias_ampliados, "int"), 
                      GetSQLValueString($ampliacion_terminos, "text"), 
					  GetSQLValueString($id, "int"));
$Result177997 = mysql_query($updateSQL77997, $conexion);



$insertSQLhh = sprintf("INSERT INTO correccion_pqrs (id_solicitud_pqrs, id_funcionario, 
seccion, fecha_correccion_pqrs, nombre_correccion_pqrs, estado_correccion_pqrs, id_tipo_accion) VALUES (%s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString('Ampliación de terminos', "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(6, "int"));
$Resulthh = mysql_query($insertSQLhh, $conexion);


  
echo $insertado;


$emailur=$correo_ciudadano; 
$subject = 'Ampliación de terminos en la PQRS'.$radicado;
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "La Superintendencia de Notariado y Registro informa que se ha realizado una ampliación de terminos en la PQRS.".$radicado." por ".$dias_ampliados." dias a partir de hoy."; 
$cuerpo .= "<br><br>"; 
$cuerpo .= $ampliacion_terminos;

$infoacuse1=base64_encode($emailur);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$cuerpo .= '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';

$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur,$subject,$cuerpo,$cabeceras);


} else {}	 
mysql_free_result($Result3355);




	?>


<div class="modal fade" id="popupampliacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>AMPLIACIÓN DE TERMINOS</b> </h4>
<br>
Este formulario envia un correo al ciudadano con la información que va a reportar.
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1F5454543245345345GDG">

<?php
$valt2=$dias_terminos*2;
?>
<div class="form-group text-left"> 
<label  class="control-label">Número de dias que quiere ampliar (Hasta <?php echo $valt2;?> dias):</label>
<select class="form-control" name="dias_ampliados" required>
<option value="" selected></option>
<?php


for ($x = 1; $x<=$valt2; $x+=1) {
  echo '<option value="'.$x.'">'.$x.'</option>';
}
?>
</select>
</div>
<div class="form-group text-left"> 
<!--<label  class="control-label">RESPUESTA AL CIUDADANO:</label>--> <!--respuesta_pre_ciudadano_nueva-->
<textarea required spellcheck="true" lang="es" class="form-control" name="ampliacion_terminos" id="texto_ampliacion_terminos">
<?php
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Señor/a<br>
<?php 
echo $nombre.'<br>';
echo $correo_ciudadano.'<br>';
echo $direccion_ciudadano.'<br>';
echo quees('municipio', $mun);
?>
<br><br>
Referencia: AMPLIACION DE TERMINOS RADICADO <?php echo $radicado; ?>
 <!--de fecha-->
 <?php 
//echo date("Y-m-d",strtotime($fecha_radicado.""));?>
<br><br>
Respetado/a señor/a.
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">
De manera atenta nos permitimos informarle que se hace necesario ampliar los terminos de respuesta de su peticion por los siguientes motivos:
<br><br>
<br><br>
Atentamente,
<br><br>
<br>

<?php echo $_SESSION['snr_nombre']; ?><br>
<?php echo quees('grupo_area', $_SESSION['snr_grupo_area']); ?>
<br>
</textarea>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="requerir_pqrs">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>
</form>
</div>
</div> 
</div> 
</div>




<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
<h3 class="box-title">
<?php 

$querybn = sprintf("SELECT count(id_solicitud_pqrs) as totreqc FROM solicitud_pqrs where id_solicitud_pqrs=".$id." and dias_ampliacion is not null and fecha_inicio_ampliacion is not null and estado_solicitud_pqrs=1"); 
$selectbn = mysql_query($querybn, $conexion);
$rowbn = mysql_fetch_assoc($selectbn);

if (0<$rowbn['totreqc']) { 
echo ' AMPLIACIÓN DE TERMINOS';
} else {
	
	

if (5!=$estado_solicitud_pqrs && 2<$dias_terminos && (1==$_SESSION['rol'] or 8116==$_SESSION['snr'] or 6477==$_SESSION['snr'] or (0<$sigrupo and 1==$_SESSION['snr_grupo_cargo'] && 1==$_SESSION['snr_tipo_oficina']))) { ?>
<a href="" id="<?php echo $radicado; ?>" class="btn ventana1" STYLE="background:#B40404;color:#fff;" data-toggle="modal" data-target="#popupampliacion" >
<span class="glyphicon glyphicon-inbox"></span>  AMPLIACIÓN DE TERMINOS</a>
<?php } else { echo ' AMPLIACIÓN DE TERMINOS'; }
}
  ?>
</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
<?php
$queryt = sprintf("SELECT dias_ampliacion, fecha_inicio_ampliacion FROM solicitud_pqrs where id_solicitud_pqrs=".$id." and dias_ampliacion is not null and fecha_inicio_ampliacion is not null and estado_solicitud_pqrs=1"); 
$selectt = mysql_query($queryt, $conexion);
$rowt = mysql_fetch_assoc($selectt);
$totalRowst = mysql_num_rows($selectt);
if (0<$totalRowst){
do {
	echo 'Fecha de ampliación: '.$rowt['fecha_inicio_ampliacion'].'<br>';
echo 'Dias ampliados: '.$rowt['dias_ampliacion'].'<br>';
echo 'Fecha de vencimiento: ';
	$nuevafechavence=fechahabil($rowt['fecha_inicio_ampliacion'],$rowt['dias_ampliacion']);
echo $nuevafechavence;

	 } while ($rowt = mysql_fetch_assoc($selectt)); 

} else {}	 

mysql_free_result($selectt);

//}
?>


<br>

		</div>
	</div>	
</div> 












		
<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
<h3 class="box-title">
<?php if (((24==$_SESSION['snr_grupo_area'] or 45==$_SESSION['snr_grupo_area']) or 1==$_SESSION['rol']) && 2<$dias_terminos && 5!=$estado_solicitud_pqrs) { ?>
<a href="" id="<?php echo $radicado; ?>" class="btn ventana1" STYLE="background:#ddc700;color:#fff;" data-toggle="modal" data-target="#popupparaconocimiento" >
<span class="glyphicon glyphicon-inbox"></span>  PARA CONOCIMIENTO</a>
<?php } else { echo 'PARA CONOCIMIENTO'; }
 ?>
</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">

<?php

$queryb = sprintf("SELECT * FROM conocimiento_pqrs where id_solicitud_pqrs=".$id." and estado_conocimiento_pqrs=1"); 
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);

if (0<$totalRowsb){
do {
	
	
	echo '<span style="color:#777;font-size:12px;">'.$rowb['fecha_conocimiento_pqrs'].'</span>';
	if (1==$rowb['id_tipo_oficina']) {
	ECHO '<br>Para: '; 
	echo quees('area',$rowb['id_area']);
	} else {
		
		if (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['rol']) {
		if (1==$rowb['confirmacion']) { echo ' <b>Enviado</b><br>';} else {
		echo '<form action="" method="post"><input type="hidden" name="id_conocimiento_pqrs" value="'.$rowb['id_conocimiento_pqrs'].'"><input type="hidden" name="confirmacion_conminacion" value="'.$rowb['correo_envio'].'"><input type="submit" value="Confirmar" style="background:#ff000;"></form>';
		} 
	} else {}
		
		ECHO 'Para: '; 
	echo quees('notaria',$rowb['id_area']);
	}
	echo '<br>De: ';
	
	echo quees('funcionario',$rowb['id_funcionario']);
	
	echo '<br>"';
	
	echo $rowb['nombre_conocimiento_pqrs'].'"<hr>';
	
	} while ($rowb = mysql_fetch_assoc($selectb)); 
} else {}	 
mysql_free_result($selectb);


	
	
?>




		</div>
	</div>	
</div>  








 


		

		  <div class="box box-primary direct-chat direct-chat-danger" >
    <div class="box-header with-border">
            <h3 class="box-title">
			
			<?php
if (0<$numclasi) {
?>
	
			
<?php
if ((1==intval($_SESSION['snr_lider_pqrs'])) or (1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol']) {
?>
    <?php if (5==$estado_solicitud_pqrs) { echo '<span class="glyphicon glyphicon-user"></span> ASIGNACIONES PQRSD'; } else {

if (0<$sigrupo or 1==$_SESSION['rol']) {

	?>
	<br />
	 <a href="" id="<?php echo $radicado; ?>" class="btn btn-info ventana1" class="ventana1" data-toggle="modal" data-target="#popupasignarpqrs" href="" style="width:100%;">
 <span class="glyphicon glyphicon-user"></span>  ASIGNACIONES PQRSD </a>
				  
<?php
} else {
	echo '<span class="glyphicon glyphicon-user"></span> ASIGNACIONES PQRSD';
}

	}

} else {
	echo '<span class="glyphicon glyphicon-user"></span>  ASIGNACIONES PQRSD';
	
}

 ?>
 
 <?php
} else { echo 'Se debe clasificar para poder asignar.'; }
?>


			</h3>
		<div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
				
<?php  
$nump116=privilegios(116,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump116) { ?>

			
 <?php if (5==$estado_solicitud_pqrs) { } else { ?>
<input class="numero" id="consultaf" value="" style="width:150px;" placeholder="Cedula" required>
<button type="button" class="btn btn-xs btn-warning" id="botonconsultaf">
<span class="glyphicon glyphicon-search"></span></button>
<form action="" method="POST" name="forasdm4354351FGDG">
<div id="resultadoconsultaf">
</div>
</form>
<hr>
<?php }  ?>

<?php } else { } ?>
				
				

<?php
$query48 = sprintf("SELECT lider_pqrs, nombre_funcionario, fecha_asignacion_funcionario, motivo_asignacion, nombre_cargo, id_funcionario_asigna, id_grupo_area, id_asignacion_pqrs_funcionario 
 FROM asignacion_pqrs_funcionario, funcionario, cargo where funcionario.id_cargo=cargo.id_cargo and asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and  id_solicitud_pqrs=".$id." and estado_asignacion_pqrs_funcionario=1 and estado_funcionario=1 order by id_asignacion_pqrs_funcionario desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
echo 'De: ';
echo quees('funcionario', $row9['id_funcionario_asigna']).' ';

echo '<br>';		

				
echo 'Para: <span title="'.$row9['nombre_cargo'].' ';


if (1==$row9['lider_pqrs']) {
	echo ' - Lider PQRS';
} else {
		
}

echo '">'.$row9['nombre_funcionario'].'</span> ';


if (5==$estado_solicitud_pqrs){ } else {
if ((((297== $_SESSION['snr_grupo_area'] or 12== $_SESSION['snr_grupo_area'] or 13== $_SESSION['snr_grupo_area'] or 14== $_SESSION['snr_grupo_area'] OR 24 == $_SESSION['snr_grupo_area'] OR 45 == $_SESSION['snr_grupo_area']) and (1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['snr_grupo_cargo']))  and (5!=$estado_solicitud_pqrs and (305==$row9['id_grupo_area'] or 12==$row9['id_grupo_area'] or 13==$row9['id_grupo_area'] or 14==$row9['id_grupo_area'] or 24==$row9['id_grupo_area'] OR 45==$row9['id_grupo_area']))) or (1==$_SESSION['rol'])) {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="asignacion_pqrs_funcionario" id="'.$row9['id_asignacion_pqrs_funcionario'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else { }
}


echo '<br>';
echo ''.$row9['fecha_asignacion_funcionario'].'';

if (isset($row9['motivo_asignacion']) && ""!=$row9['motivo_asignacion']) {
echo '<br>"<i>'.$row9['motivo_asignacion'].'</i>"';
} else {}



			echo'<hr>';
	}
	$result8->free();
?>


 <a href=""  data-toggle="modal" data-target="#historialasignaciones">
+ Info.</a>
 
 
		</div>
	</div>	
</div>


		





		
<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
<h3 class="box-title">
REVISIÓN DEL ÁREA
</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">

				
				<?php 
if (5!=$estado_solicitud_pqrs && ((0<$sigrupo && 45==$_SESSION['snr_grupo_area'] && (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs']) ) or 1==$_SESSION['rol'])) { 



if (isset($_POST['nombre_revision_pqrs']) && ""!=$_POST['nombre_revision_pqrs']) {

$insertSQLi = sprintf("INSERT INTO revision_pqrs (id_solicitud_pqrs, id_funcionario, nombre_revision_pqrs, fecha_revision_pqrs, estado_revision_pqrs) VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST['nombre_revision_pqrs'], "text"), 
GetSQLValueString(1, "int"));
$Resulti = mysql_query($insertSQLi, $conexion) or die(mysql_error());
echo $insertado;
} else {}

?>

<form action="" method="POST" name="for453451FG254DG">
<select name="nombre_revision_pqrs" required style="width:170px;">
<option value="" selected></option>
<option value="Revisión">Revisión</option>
<option value="Corrección">Corrección</option>
</select>
<button type="submit" class="btn btn-xs btn-warning">
<span class="fa fa-calendar-check-o"></span></button>
</form>



<?php } else { echo ' '; }  





$querybrr = sprintf("SELECT nombre_funcionario, nombre_revision_pqrs, fecha_revision_pqrs FROM revision_pqrs, funcionario where revision_pqrs.id_funcionario=funcionario.id_funcionario and id_solicitud_pqrs=".$id." and estado_revision_pqrs=1 order by id_revision_pqrs desc"); 
$selectbrr = mysql_query($querybrr, $conexion) or die(mysql_error());
$rowblrr = mysql_fetch_assoc($selectbrr);
$totalRowsbrr = mysql_num_rows($selectbrr);

if (0<$totalRowsbrr) {
	echo '<br>';
 do { 
 

			echo '<b>'.$rowblrr['nombre_revision_pqrs'].'</b> - '.$rowblrr['fecha_revision_pqrs'].'<br>'.$rowblrr['nombre_funcionario'].'<hr>';
 
 } while ($rowblrr = mysql_fetch_assoc($selectbrr)); 

  

} else {}
  mysql_free_result($selectbrr);

?>

</div>
	</div>	
</div>







		

		
<div class="box box-warning direct-chat direct-chat-warning" >
<div class="box-header with-border">
<h3 class="box-title">
<?php 
if (5!=$estado_solicitud_pqrs && ((0<$sigrupo && 45==$_SESSION['snr_grupo_area'] && (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs']) ) or 1==$_SESSION['rol'])) { ?>
<a href="" id="<?php echo $radicado; ?>" class="btn ventana1" STYLE="background:#6699cc;color:#fff;" data-toggle="modal" data-target="#popupclasificacioninterna" >
<span class="glyphicon glyphicon-inbox"></span> CLASIFICACIÓN</a>
<?php } else { echo ' CLASIFICACIÓN'; }
//} ?>
</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
<div  class="modal-body" style="max-height:250px;">
<?php
$queryk = sprintf("SELECT id_clasificacionpqrs_dvcn, id_vigilado, nombre_notaria, nombre_tipologiapqrs_notaria, nombre_clasificacionpqrs_dvcn, fecha_clasificacionpqrs_dvcn FROM clasificacionpqrs_dvcn, notaria, tipologiapqrs_notaria WHERE clasificacionpqrs_dvcn.id_vigilado=notaria.id_notaria and clasificacionpqrs_dvcn.id_tipologiapqrs_notaria=tipologiapqrs_notaria.id_tipologiapqrs_notaria 
and clasificacionpqrs_dvcn.id_solicitud_pqrs=".$id." and estado_clasificacionpqrs_dvcn=1"); 
$selectk = mysql_query($queryk, $conexion);
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk){
do {
	if ( 5!=$estado_solicitud_pqrs && ((0<$sigrupo && 45==$_SESSION['snr_grupo_area'] && (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs']) ) or 1==$_SESSION['rol'])) { 
			//echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="clasificacionpqrs_dvcn" id="'.$rowk['id_clasificacionpqrs_dvcn'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
			} else {}

	echo 'Tipo: '.$rowk['nombre_tipologiapqrs_notaria'].'. ';
	echo '<i>'.$rowk['fecha_clasificacionpqrs_dvcn'].'</i>, ';
	echo '<hr>';
	$supervigilado=$rowk['id_vigilado'];
	 } while ($rowk = mysql_fetch_assoc($selectk)); 
} else {
	$supervigilado=0;
}	 
mysql_free_result($selectk);
?>
</div>
</div>	
</div>

		
		
		
		
		
		
		
		


		


		
		
		
		


<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
<h3 class="box-title">
<?php 
$querybn = sprintf("SELECT count(id_requerir_pqrs) as totreq FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1 limit 1"); 
$selectbn = mysql_query($querybn, $conexion) or die(mysql_error());
$rowbn = mysql_fetch_assoc($selectbn);

if (0<$rowbn['totreq']) { 
echo 'Requerimiento proyectado';
} else {
	

if (5!=$estado_solicitud_pqrs && ((0<$sigrupo && (45==$_SESSION['snr_grupo_area'] or 44==$_SESSION['snr_grupo_area'])) or 1==$_SESSION['rol'])) { ?>
<a href="" id="<?php echo $radicado; ?>" class="btn ventana1" STYLE="background:#ccc;color:#fff;" data-toggle="modal" data-target="#popuprequerir" >
<span class="glyphicon glyphicon-inbox"></span>  REQUERIMIENTO</a>
<?php } else { echo 'Requerimiento'; }
}  ?>
</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">

<?php

$queryb = sprintf("SELECT * FROM requerir_pqrs where requerir_pqrs.id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1 limit 1"); 
$selectb = mysql_query($queryb, $conexion) or die(mysql_error());
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);

if (0<$totalRowsb) {
	
	     	echo '<span style="">'.quees('tipo_oficina', $rowb['id_tipo_oficina']).' - ';
		if (3==$rowb['id_tipo_oficina']) {
			
			
if (5!=$estado_solicitud_pqrs &&  ((0<$sigrupo && (45==$_SESSION['snr_grupo_area'] or 44==$_SESSION['snr_grupo_area']) && 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol'])) {
	


echo '<form action="" method="POST" name="for45345145435FG254DG"><select name="cambio_notaria_requerimiento">';			
$query = sprintf("SELECT id_notaria, nombre_notaria FROM notaria where estado_notaria=1 order by nombre_notaria"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_notaria'].'" ';
		
		if ($row['id_notaria']==$rowb['id_vigilado']) { echo 'selected'; } else {}
	
	echo '>'.$row['nombre_notaria'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

echo '</select><button type="submit" class="fa fa-retweet">
</button>
</form>';
		}  else {
			
			echo quees('notaria', $rowb['id_vigilado']);
		}
			
			
			
		} elseif (4==$rowb['id_tipo_oficina']) {
				echo quees('curaduria', $rowb['id_vigilado']);
		} else {}		
		echo '</span>';
		
		
	
	
	if (isset($rowb['fecha_solicitudr'])) {
		

	$fecha_req=$rowb['fecha_solicitudr'];
			echo '<br><span style="font-size:12px;">'.$fecha_req.'</span><br>';
  
		
		echo '<span style="font-size:12px;">Proyectado por ';
		
		echo quees('funcionario', $rowb['id_funcionario']);
		
		echo '</span><br>';
		
	
	$fecharnotario=fechahabil($fecha_req,5);
	
	//$fecharfun=fechahabil($fecha_req,60);
	

	echo 'Fecha de plazo para el notario: '.$fecharnotario;
	
	/*
	if (1==$_SESSION['rol'] or ((1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['snr_grupo_cargo']) and 45==$_SESSION['snr_grupo_area'])) {
	echo '<br>Fecha de plazo para la respuesta: '.$fecharfun;
	} else { }
	*/
	
	} else { }
	
	
if (isset($rowb['respuesta_requerimiento']) and ""!=$rowb['respuesta_requerimiento']) {
echo '<br>Fecha de respuesta: '.$rowb['fecha_respuestar'].' '; 
} else {}


} else {}

mysql_free_result($selectb);
?>


<br>

		</div>
	</div>	
</div> 








<?php
if (5!=$estado_solicitud_pqrs && ((0<$sigrupo && 45==$_SESSION['snr_grupo_area'] && (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs']) ) or 1==$_SESSION['rol'])) { ?>


<div class="modal fade" id="popupcontrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>NUEVA PQRS:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1F545455345345GDG" enctype="multipart/form-data">


	<div class="form-group text-left ubicacion"> 
<label  class="control-label">DEPARTAMENTO:</label> 
<select  class="form-control"  id="id_departamento_req2" >
<option value="" selected></option>
<?php echo lista('departamento');  ?>
</select>
</div>
<div class="form-group text-left ubicacion"> 
<label  class="control-label">MUNICIPIO:</label> 
<select  class="form-control"  id="id_municipio_req2" >
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOTARIA:</label> 
<select class="form-control" id="ver_ofi2" name="id_notaria_mov">
</SELECT>
</div>
<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>NOTARIA:</label> 
<select class="form-control"  name="id_notaria_mov" required>
<option selected></option>
<?php //echo lista('notaria');  ?>
</SELECT>
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPO DE MOVIMIENTO:</label> 
<select class="form-control" name="id_tipo_mov_pqrs" required>
<option selected></option>
<?PHP
//echo lista('tipo_mov_pqrs');
?>
</SELECT>
</div>
-->

<div class="form-group text-left"> 
<textarea spellcheck="true" lang="es" class="form-control" name="nombre_movimiento_pqrs" id="texto_control_ciudadano">

<?php
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Señor/a<br>
<?php 
/*echo $nombre.'<br>';
echo $correo_ciudadano.'<br>';
echo $direccion_ciudadano.'<br>';
echo quees('municipio', $mun);
*/
?>
<br><br>

Referencia: Traslado por competencia radicado <?php echo $radicado; ?>


<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">
<!--<div id="texto_movimiento">
</div>-->
Respetado/a Doctor/a:
<br><br>
Mediante el radicado de la referencia fue recibida ante esta Dirección petición suscrita por <?php echo $nombre; ?>, mediante la cual solicita XXXXXX, por consiguiente, toda vez que el objeto del requerimiento se relaciona con las competencias otorgadas al despacho a su cargo, en virtud de lo dispuesto por el Decreto Ley 960 de 1970 y demás normas que lo complementen, se traslada por competencia la presente.
<br><br>
La anterior remisión se realiza en atención a lo dispuesto por el artículo 21 de la Ley 1755 de 2015, y para tales efectos se adjunta al presente oficio los antecedentes del radicado de la referencia. 
<br><br>



<BR>Enlace de la PQRS original: <br>
https://servicios.supernotariado.gov.co/pqrs/pdf/<?php echo $radicado; ?>.pdf

<br><br>
Atentamente,
<br><br>
<br>
MIGUEL ALFREDO GOMEZ CAICEDO (E)<br>
Director de Vigilancia y Control Notarial
<br><br>
<br>
Proyecto: 
<?php echo $_SESSION['snr_nombre']; ?><br>
<?php echo quees('grupo_area', $_SESSION['snr_grupo_area']); ?>
<br>
</textarea>
</div>




<script>


function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
	
	
	var fsize = 5000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    //  alert(siezekiloByte+'<'+fsize);
	  
	  if  (siezekiloByte < fsize){
		  
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
        fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = 'Error por tipo de archivo';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        } 
    }
	
} else {
	alert('Debe ser inferior a 5000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}
</script>

<!--
<div class="form-group text-left">
<label  class="control-label"> Anexo:</label> 
<input type="file" name="file" id="file" onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 5 Mg</span>
<div id="imagePreview"></div>
</div>-->



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="email_ciudadano" value="<?php echo $correo_ciudadano; ?>">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>

</form>
</div>
</div> 
</div> 
</div>




<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
<h3 class="box-title">
<?php if ((0<$sigrupo && 45==$_SESSION['snr_grupo_area']) or 1==$_SESSION['rol']) { 


 if ((isset($_POST["nombre_movimiento_pqrs"])) && ($_POST["nombre_movimiento_pqrs"] != "")) { 

//$id_tipo_mov_pqrs=$_POST["id_tipo_mov_pqrs"];

	
$tamano_archivo=1048576; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/requerimientos/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'movimiento-'.$id.'-'.$identi;

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;


if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
    } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		

} else { 
$files='';	
	}
	
$inforpqrs=$_POST["nombre_movimiento_pqrs"];
//.'<br>Enlace principal de la PQRS: https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado.'.pdf';

$urip='https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado.'.pdf';
require_once('crear_pqrs.php');
//$radicadon='SNR2021ER099999';
//$idpqrs=130000;

$insertSQL = sprintf("INSERT INTO movimiento_pqrs (id_solicitud_pqrs, radicado, id_funcionario, id_notaria, 
fecha_publicacion, nombre_movimiento_pqrs, url, id_tipo_mov_pqrs, estado_movimiento_pqrs) 
VALUES (%s, %s,  %s,  %s, now(), %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($radicadon, "text"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["id_notaria_mov"], "int"), 
GetSQLValueString($inforpqrs, "text"), 
GetSQLValueString($urip, "text"), 
GetSQLValueString(3, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);




/*
$insertSQL = sprintf("INSERT INTO respuesta_pqrs 
(id_solicitud_pqrs, id_funcionario, nombre_respuesta_pqrs, fecha_respuesta,
 estado_respuesta_pqrs) VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($textopqrsmov, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


if (1==$id_tipo_mov_pqrs or 3==$id_tipo_mov_pqrs or 7==$id_tipo_mov_pqrs) {
$correomov=correooficina(3,$_POST["id_notaria_mov"]);
} else {
$correomov=$_POST["email_ciudadano"];
}
*/




$correomov=correooficina(3,$_POST["id_notaria_mov"]);
//$correomov='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Asignación de la PQRS '.$radicadon.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= $_POST["nombre_movimiento_pqrs"]; 
$cuerpo .='<br><br>Finalmente, se informa que la respuesta al ciudadano deberá ser tramitada y firmada a través de la plataforma SISG.
<br><br>Enlace para dar respuesta: <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$idpqrs.'.jsp">https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$idpqrs.'.jsp</a>';


$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correomov,$subject,$cuerpo,$cabeceras);


echo $insertado;


	/*
$query7c = sprintf("SELECT MAX(radicacion_control) as maxc FROM control_disciplinario"); 
$select7c = mysql_query($query7c, $conexion);
$row7c = mysql_fetch_assoc($select7c);
$totalRows7c = mysql_num_rows($select7c);
$numc2=$row7c['maxc']+1;
$numc=intval($numc2);
mysql_free_result($select7c);

$insertSQLc = sprintf("INSERT INTO control_disciplinario (id_tipo_oficina, id_tipo_control_notariado, ano, radicacion_control, id_solicitud_pqrs, id_funcionario, fecha_control_disciplinario, nombre_control_disciplinario, estado_control_disciplinario) 
VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString(3, "int"), 
GetSQLValueString(28, "int"),
GetSQLValueString(2019, "int"),  
GetSQLValueString($numc, "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"),
GetSQLValueString('PQRS', "text"), 
GetSQLValueString(1, "int"));
$Resultc = mysql_query($insertSQLc, $conexion);
*/
  



} else { }




?>
<a href="" id="<?php echo $radicado; ?>" class="btn ventana1" STYLE="background:#B40404;color:#fff;" data-toggle="modal" data-target="#popupcontrol" >
<span class="glyphicon glyphicon-inbox"></span> CREAR PQRS </a>
<?php } else { echo ' CREAR PQRS'; }

  ?>
</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
<?php
$queryk = sprintf("SELECT * from movimiento_pqrs, tipo_mov_pqrs where movimiento_pqrs.id_tipo_mov_pqrs=tipo_mov_pqrs.id_tipo_mov_pqrs and id_solicitud_pqrs=".$id." and estado_movimiento_pqrs=1"); 
$selectk = mysql_query($queryk, $conexion);
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk){
do {
if (isset($rowk['id_notaria'])) {
		echo '<i>';
	echo quees('notaria',$rowk['id_notaria']);
	echo '</i> ';
	} else {}
	//echo 'Tipo: '.$rowk['nombre_tipo_mov_pqrs'].'. ';
	echo '<i>'.$rowk['fecha_publicacion'].'</i>, ';
	//echo ' <a href="#" target="_blank"><img src="images/pdf.png"></a> ';
	if (isset($rowk['radicado'])) {
		echo '<br><b>Radicado: '.$rowk['radicado'].'</b>';
	//echo ' <a href="filesnr/requerimientos/'.$rowk['url'].'" target="_blank">Documento</a> ';
	} else {}
	echo '<hr>';
	 } while ($rowk = mysql_fetch_assoc($selectk));  
	 //echo '<a href="movimiento_pqrs&'.$id.'.jsp" target="_blank">Seguimiento</a><br>'; 
} else {
}	 
mysql_free_result($selectk);
?>


<br>

		</div>
	</div>	
</div> 

<?php
} else {}
?>


		
		  
		  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">Otras PQRS del mismo Ciudadano</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
			

<?php

if (21373==$id_ciudadano or 3==$id_ciudadano) {
$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id_ciudadano."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1  order by solicitud_pqrs.id_solicitud_pqrs desc limit 1"); 

	} else {

$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id_ciudadano."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1  order by solicitud_pqrs.id_solicitud_pqrs desc limit 10"); 


$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
			echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a> ';
		if (5==$row9['id_estado_solicitud']) { 
			echo '<i class="glyphicon glyphicon-ok verde" title="Finalizada"></i><br>'; 
			echo '<span style="color:#aaa;">Proyecto: ';
			echo quienrespondio($row9['id_solicitud_pqrs']);
			echo '</span>';
			} else 
			{ echo '<i class="glyphicon glyphicon-warning-sign" style="color:#F39C12;" title="En tramite"></i>';
		}
			echo '<br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
			
			

	}
	$result8->free();




$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1 limit 10", $conexion);
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/radicado_anterior&'.$row157ll['id_radi_cert'].'.jsp">Certicamara '.$row157ll['radi_cert'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row157ll['fecha_radi_cert'].'</span><br>';
			echo $row157ll['nombre_radi_cert'].'<hr>';
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}

}
?>

<a href="info_ciudadano&<?php echo $id_ciudadano; ?>.jsp">Ver todas las PQRS del ciudadano</a>
<br><br>
				</div>
			</div>	
	</div>
	</div>
	
<?php  } else {   ?>
<div class="row">
<div class="col-md-12">
  <div class="box box-info">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>No tienes acceso a la PQRS</h3>
              </div>
            </div>
          </div>
        </div>
</div>

<?php } 	?>
	
<?php 


 }
 
 mysql_free_result($actualizar6);
 
?>