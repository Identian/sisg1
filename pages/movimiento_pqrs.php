<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
$id = $_GET['i'];

function tiporadicado($idmov){
global $mysqli;
$query = "SELECT tiporadicado FROM tipo_mov_pqrs where id_tipo_mov_pqrs=".$idmov." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
return $idmov.$row['tiporadicado'];
$result->free();
}

//ECHO tiporadicado(3);

if (isset($_GET['e']) && "" != $_GET['e']) {
	
	$numr=(rand(10,99));
	
	
	$ider=$_GET['e'];
	$iden=explode('-',$ider);
	$ide=$iden[0];
	$idtipo=$iden[1];
	
	$varradicado=tiporadicado($idtipo);
	
	$radi='SNR2021'.$varradicado.'0635'.$numr;  // EE PARA SALIDAS
	
	
	
	if (2==$idtipo or 4==$idtipo or 6==$idtipo or 9==$idtipo or 11==$idtipo) {
	$estadopqrsd=5;
	
	$updateSQL7799 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString($estadopqrsd, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) ;

$insertSQL = sprintf("INSERT INTO respuesta_pqrs (id_solicitud_pqrs, id_funcionario, nombre_respuesta_pqrs, fecha_respuesta, estado_respuesta_pqrs) VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString('test', "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


	} else {
	$estadopqrsd=2;
		}
	
$updateSQL7799 = sprintf("UPDATE movimiento_pqrs SET radicado=%s WHERE id_movimiento_pqrs=%s and estado_movimiento_pqrs=1",                  
					  GetSQLValueString($radi, "text"),
					  GetSQLValueString($ide, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) ;



  


echo $actualizado;
} else {}



 if ((isset($_POST["nombre_movimiento_pqrs"])) && ($_POST["nombre_movimiento_pqrs"] != "")) { 

$id_tipo_mov_pqrs=$_POST["id_tipo_mov_pqrs"];
$textopqrsmov= limpiar($_POST["nombre_movimiento_pqrs"]);


	
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
	
 
$query_update = sprintf("select count(id_movimiento_pqrs) as cantidad FROM movimiento_pqrs 
where id_solicitud_pqrs=".$id." and radicado is not null and id_tipo_mov_pqrs=3 and estado_movimiento_pqrs=1");
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$cantidad=$row_update['cantidad'];
 if (4==$id_tipo_mov_pqrs && 1>$cantidad){

	  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Debe realizarce traslado primero a la Notaria.</div>';
   
 } else {

$insertSQL = sprintf("INSERT INTO movimiento_pqrs (id_solicitud_pqrs, id_funcionario, id_notaria, 
fecha_publicacion, nombre_movimiento_pqrs, url, id_tipo_mov_pqrs, estado_movimiento_pqrs) 
VALUES (%s, %s,  %s, now(), %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["id_notaria_mov"], "int"), 
GetSQLValueString($textopqrsmov, "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($id_tipo_mov_pqrs, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);



 if (4==$id_tipo_mov_pqrs){

	 
 } else { }

 


if (1==$id_tipo_mov_pqrs or 3==$id_tipo_mov_pqrs or 7==$id_tipo_mov_pqrs) {
$correomov=correooficina(3,$_POST["id_notaria_mov"]);
} else {
$correomov=$_POST["email_ciudadano"];
}


if (5==$id_tipo_mov_pqrs) {
$correocopia=',vigilanciasdn@supernotariado.gov.co';
} else {
$correocopia='';
 }

$correof="giovanni.ortegon@supernotariado.gov.co".$correocopia;
//$correof=$correomov.$correocopia;
$subject = 'Mensaje sobre PQRSD de la Superintendencia';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= $textopqrsmov; 
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correof,$subject,$cuerpo,$cabeceras);


echo $actualizado;

 }
 } else {}




$query_update = sprintf("select * FROM solicitud_pqrs, estado_solicitud, ciudadano where solicitud_pqrs.id_estado_solicitud=estado_solicitud.id_estado_solicitud and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and id_solicitud_pqrs = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);
?>


	
<div class="row">
<div class="col-md-9">
<div class="box box-success">
<div class="box-header with-border">

<?php 

$radicado=$row_update['radicado'];

echo 'RADICADO: <a href="solicitud_pqrs&'.$row_update['id_solicitud_pqrs'].'.jsp" target="blank">'.$radicado.'</a><br>';
echo 'Ciudadano: '.$row_update['nombre_ciudadano'].'<br>';
$correoc=$row_update['correo_ciudadano'];
echo 'Correo: '.$correoc.'<br>';
echo 'Identificación: '.$row_update['identificacion'].'<br>';
echo 'Estado: '.$row_update['nombre_estado_solicitud'].'<br>';

 ?>
	





</div>
</div>
</div>
<div class="col-md-3">
<div class="box box-success">
<div class="box-header with-border">

<a href="" id="<?php echo $radicado; ?>" class="btn ventana1" STYLE="background:#B40404;color:#fff;" data-toggle="modal" data-target="#popupcontrol" >
<span class="glyphicon glyphicon-inbox"></span> MOVIMIENTO NOTARIAL</a>

</div>
</div>
</div>
</div>


<?php
$query_update = sprintf("select solicitud_pqrs.id_solicitud_pqrs, radicado, tipo_req_tras, id_vigilado, terminos_notaria, correo_oficina, 
radicado_requerimiento, fecha_solicitudr, fecha_respuestar, id_requerir_pqrs, nombre_requerir_pqrs, respuesta_requerimiento, respuesta_pre_ciudadano, radicado_ciudadano 
FROM requerir_pqrs, solicitud_pqrs WHERE requerir_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and estado_requerir_pqrs=1 AND requerir_pqrs.id_solicitud_pqrs = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);
?>
<div class="row">
<div class="col-md-12">
<div class="box box-warning">
<div class="box-header with-border">
<B>
<?php
echo 'FUENTE: <a href="solicitud_pqrs&'.$row_update['id_solicitud_pqrs'].'.jsp" target="blank">Ver</a><br>';
?>
</b>

<div  class="modal-body"><div class="form-group text-left"> 
<label  class="control-label">TIPO:</label>   
<?php if (0==$row_update['tipo_req_tras']) {
echo 'Requerimiento';
} else {
	echo 'Traslado';
}
	?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TERMINOS DE NOTARIA:</label>   
<?php echo $row_update['terminos_notaria']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE SOLICITUD:</label>   
<?php echo $row_update['fecha_solicitudr']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">VIGILADO:</label>   
<?php echo quees('notaria',$row_update['id_vigilado']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CORREO DE OFICINA:</label>   
<?php echo $row_update['correo_oficina']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TEXTO DEL MOVIMIENTO REQUERIR DE PQRS:</label>   
<?php echo $row_update['nombre_requerir_pqrs']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RESPUESTA:</label>   
<?php echo $row_update['respuesta_requerimiento']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RESPUESTA AL CIUDADANO:</label>   
<?php echo $row_update['respuesta_pre_ciudadano']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RADICADO DE REQUERIMIENTO:</label>   
<?php echo $row_update['radicado_requerimiento']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RADICADO DE CIUDADANO:</label>   
<?php echo $row_update['radicado_ciudadano']; $radicado=$row_update['radicado_ciudadano']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE ENVIO AL CIUDADANO:</label>   
<?php echo $row_update['fecha_enviociudadano']; $fecha_radicado=$row_update['fecha_enviociudadano']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RADICADO DE RESPUESTA:</label>   
<?php echo $row_update['radicado_respuesta']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA DE RESPUESTAR:</label> 
<?php echo $row_update['fecha_respuestar']; ?>  
</div>


<?php

$query = sprintf("SELECT * FROM documento_pqrs where id_solicitud_pqrs=".$id." and id_clase_documento=3 and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<div class="form-group text-left"> <label  class="control-label">Anexos:</label>';
do {
echo '<a title="'.$row['fecha_subida'].' - HASH: '.$row['hash_documento'].'" href="files/'.$row['carpeta'].''.$row['url_documento'].'" target="_blank"><img src="images/pdf.png"> ';
echo 'Anexo </a><br> ';
	 } while ($row = mysql_fetch_assoc($select)); 
	 ECHO '</div>';
} else { 
}	 
mysql_free_result($select);

?>


</div>
</div>
</div>
</div>
</div>
<?PHP } ELSE {} ?>



<?php

$queryk = sprintf("SELECT * from movimiento_pqrs, tipo_mov_pqrs where  movimiento_pqrs.id_tipo_mov_pqrs=tipo_mov_pqrs.id_tipo_mov_pqrs and id_solicitud_pqrs=".$id." and estado_movimiento_pqrs=1"); 
$selectk = mysql_query($queryk, $conexion);
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk){
do {
echo '<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">';

if (isset($rowk['radicado'])) { echo '<b>Radicado: '.$rowk['radicado'].'</b><br>'; } else {
echo '<div class="text-right">
<a  id="'.$rowk['id_movimiento_pqrs'].'" class="btn buscar_detalle_movimiento" STYLE="background:#F39C3F;color:#fff;" data-toggle="modal" data-target="#popupdetalle" >
Modificar
</a> 
<a class="confirmationnot btn btn-sucess" href="movimiento_pqrs&'.$id.'&'.$rowk['id_movimiento_pqrs'].'-'.$rowk['id_tipo_mov_pqrs'].'.jsp"  STYLE="background:#4BA75B;color:#fff;">
Aprobar
</a>
</div>';
}


	if (isset($rowk['id_notaria'])) {
		echo 'Notaria: ';
	echo quees('notaria',$rowk['id_notaria']);
	echo '<br>';
	} else {}
	

	echo 'Tipo: '.$rowk['nombre_tipo_mov_pqrs'].'<br> ';
	echo 'Fecha: '.$rowk['fecha_publicacion'].'<br> ';
	echo 'Descripción: '.$rowk['nombre_movimiento_pqrs'].'<br>';
	if (isset($rowk['url'])) {
	echo ' <a href="filesnr/requerimientos/'.$rowk['url'].'" target="_blank">Documento anexo</a> ';
	} else {}
	echo '</div>
</div>
</div>
</div>';
	 } while ($rowk = mysql_fetch_assoc($selectk)); 
	 

	 
} else {
	
}	 

mysql_free_result($selectk);
?>





<div class="modal fade" id="popupdetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICAR:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body">
<form action="" method="post">
<textarea spellcheck="true" lang="es" class="form-control" name="nombre_movimiento_pqrs" id="texto_trasladar">
<div id="ver_detalle_movimiento">
		
</div>
</textarea>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="mod_movimiento" value="1">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>

</form>


</div>
</div>
</div>
</div>



<div class="modal fade" id="popupcontrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MOVIMIENTO NOTARIAL:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1F545455345345GDG" enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label">NOTARIA:</label> 
<select class="form-control"  name="id_notaria_mov" >
<option selected></option>
<?php echo lista('notaria');  ?>
</SELECT>
</div>

<!--
	<div class="form-group text-left ubicacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>DEPARTAMENTO:</label> 
<select  class="form-control"  id="id_departamento_req2" required>
<option value="" selected></option>
<?php //echo lista('departamento');  ?>
</select>
</div>
<div class="form-group text-left ubicacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>MUNICIPIO:</label> 
<select  class="form-control"  id="id_municipio_req2" required>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>NOTARIA:</label> 
<select class="form-control" id="ver_ofi2" name="id_notaria_mov" required>
</SELECT>
</div>
-->
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPO DE MOVIMIENTO:</label> 
<select class="form-control" name="id_tipo_mov_pqrs" required>
<option selected></option>
<?PHP
echo lista('tipo_mov_pqrs');
?>
</SELECT>
</div>


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
Referencia: Radicado <?php echo $radicado; ?>


<br><br>
Respetado/a señor/a.
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">
<div id="texto_movimiento">
</div>
<br><br>
Atentamente,
<br><br>
<br>
SOL MILENA GUERRA ZAPATA<br>
Directora de Vigilancia y Control Notarial
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


<div class="form-group text-left">
<label  class="control-label"> Anexo:</label> 
<input type="file" name="file" id="file" onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 5 Mg</span>
<div id="imagePreview"></div>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"
><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="email_ciudadano" value="<?php echo $correoc; ?>">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>

</form>
</div>
</div> 
</div> 
</div>

<?php

} else {}
} else {}
?>