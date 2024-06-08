<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }


if (24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {

$nump89=privilegios(89,$_SESSION['snr']);


 if (isset($_POST["finalizarsolicitud"]) && ""!=$_POST["finalizarsolicitud"]) {
$updateSQL7799 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(2, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) or die(mysql_error());
echo $insertado;
} else {} 





$actualizarkf = mysql_query("SELECT idcorrespondencia, url_documento FROM documento_pqrs where nombre_documento_pqrs='Constancia de la solicitud' and id_solicitud_pqrs='$id' and estado_documento_pqrs=1", $conexion) or die(mysql_error());
$row1kf = mysql_fetch_assoc($actualizarkf);
$idcorrespondenciaff = $row1kf['idcorrespondencia'];
$url_documento = $row1kf['url_documento'];

$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


$file = $directoryftp.$url_documento;  
$remote_file = 'Correo/'.$idcorrespondenciaff.'/Files/'.$url_documento;


if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
 echo "";
} else {
 echo "";
}
ftp_close($conn_id);




if ((isset($_POST["mail"])) && ($_POST["mail"] != "")) { 
/*
sprintf("INSERT INTO email_enviado (id_email_enviado,) VALUES (%s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["nombre_respuesta_pqrs"], "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());


   
$emailu="giova900@gmail.com";
$subject = 'PQRS';
$cuerpo = '';
$cuerpo .= 'RESPUESTA DE PQRS enviada a '.$emailu."\n\n"; 
$cabeceras = 'From: Supernotariado<notificadorD@supernotariado.gov.co>';
mail($emailu,$subject,$cuerpo,$cabeceras);
echo $emailenviado;
*/
}


?>
<?php

global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}
	
$query4 = sprintf("SELECT * FROM solicitud_pqrs, categoria_pqrs, ciudadano, tipo_respuesta where solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and  ciudadano.id_tipo_respuesta=tipo_respuesta.id_tipo_respuesta and ciudadano.id_ciudadano=ciudadano.id_ciudadano and categoria_pqrs.id_categoria_pqrs=categoria_pqrs.id_categoria_pqrs and solicitud_pqrs.id_solicitud_pqrs='$id' and estado_solicitud_pqrs=1 limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
if (0<count($row4)){
$idso = $row4['id_solicitud_pqrs'];
$radicado = $row4['radicado'];
$estado_solicitud_pqrs=$row4['id_estado_solicitud'];
$fecha_radicado = $row4['fecha_radicado'];
$nombre_solicitud_pqrs = $row4['nombre_solicitud_pqrs'];
$descripcion_solicitud_pqrs = $row4['descripcion_solicitud'];
$categoria = $row4['nombre_categoria_pqrs'];
$nombre = $row4['nombre_ciudadano'];
$identificacion = $row4['identificacion'];
$correo_ciudadano = $row4['correo_ciudadano'];
$direccion_ciudadano = $row4['direccion_ciudadano'];
$erespuesta=$row4['nombre_tipo_respuesta'];
$id_ciudadano=$row4['id_ciudadano'];
$dep=$row4['id_departamento'];
$mun=$row4['id_municipio'];
$tipod=$row4['id_tipo_documento'];
$telefono=$row4['telefono_ciudadano'];
$etnia=$row4['id_etnia'];

$id_estado_solicitud=$row4['id_estado_solicitud'];
$id_canal_pqrs=$row4['id_canal_pqrs'];


$de_certicamara=intval($row4['de_certicamara']);


} else { }
$result4->free();

?>

	
	
	<?php

if ((isset($_POST["nombre_documento_pqrs"])) && ($_POST["nombre_documento_pqrs"] != "")) {
	

	
$tamano_archivo=8388608;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'mp3', 'wav', 'wma', 'mp4');

$ruta_archivo = $id.'-'.date("YmdGis");


$carpeta='pqrs/'.$anoactualcompleto.'/';
 
$directoryftp='files/'.$carpeta;


	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombre = strtolower($_FILES['file']['name']);
$info = pathinfo($nombre); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombre);
$extension2= end($array_archivo);


if ($tamano_archivo>$tam_archivo) {
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
 // chmod($files,0777);
  $nombrebre_orig= ucwords($nombre);
  
  
$seguridad=md5($files.$id_ciudadano);
  


  
  
  
  
$idradi=strip_tags($radicado);
$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
$query = "SELECT * FROM correspondencia where codigo= '$idradi' "; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$idcorrespondencia=$row['idcorrespondencia'];
 }
 
//echo $idcorrespondencia; 
	  
	  
$dateiris=date("Y-m-d H:i:s");

$actualizark = mysql_query("SELECT count(id_documento_pqrs) as cuentadoc  FROM documento_pqrs where id_solicitud_pqrs='$idso' and estado_documento_pqrs=1", $conexion) or die(mysql_error());
$row1k = mysql_fetch_assoc($actualizark);
$cuentadoc = $row1k['cuentadoc'];


$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


if (1==$cuentadoc) {

$remotef = 'Correo/'.$idcorrespondencia.'/Files';
if (ftp_mkdir($conn_id, $remotef)) {
 echo "";
} else {
 echo "";
}


} else {}





$insertSQL = sprintf("INSERT INTO documento_pqrs (idcorrespondencia, id_ciudadano, nombre_documento_pqrs, id_solicitud_pqrs, id_clase_documento, carpeta, 
fecha_subida, url_documento, extension, hash_documento, estado_documento_pqrs) 
VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s)", 
GetSQLValueString($idcorrespondencia, "int"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString($_POST["nombre_documento_pqrs"], "text"),
 GetSQLValueString($id, "int"), 
 GetSQLValueString(1, "int"), 
 GetSQLValueString($carpeta, "text"), 
 GetSQLValueString($files, "text"), 
 GetSQLValueString($extension, "text"), 
 GetSQLValueString($seguridad, "text"),
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());




$file = $directoryftp.$files;  
$remote_file = 'Correo/'.$idcorrespondencia.'/Files/'.$files;


if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
 echo "";
} else {
 echo "";
}
ftp_close($conn_id);





$consultab = sprintf("INSERT INTO correspondenciacontenido (idcorrespondencia, idtipodocumento, idsubclasedocumento, indice, upd, mostrar, nombre, extension, dir, pag, crc, audita, fechaaudita, audita2, fechaaudita2, creado, fcreado, modificado, fmodificado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($idcorrespondencia, "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('0', "text"),
GetSQLValueString($cuentadoc, "text"), //incremental
GetSQLValueString('0', "text"),
GetSQLValueString('f', "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString('Pdf', "text"),
GetSQLValueString('2', "text"),
GetSQLValueString('1', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('1607', "text"),
GetSQLValueString($dateiris, "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"));

  
$resultado = pg_query ($consultab);

  pg_free_result($resultado);
  pg_close($conexionpostgresql);  
}


  echo $insertado;
  
  
  
  
  
  } else { 
  
    echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

	
			}
} else { 

 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 5 Megas permitidos.</div>';

		}
	
	



		
} else {}
?>








	
	<div class="row">
<div class="col-md-9">
	<div class="box box-info">




 <div class="box-header with-border">
                  <h3 class="box-title">Radicado: <b style="font-size:21px;"><?php echo $radicado; ?></b></h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
<div class="row" >
	 <div class="col-md-6">
	 
	  <?php  
	$nump89=privilegios(89,$_SESSION['snr']);

	if (1==$_SESSION['rol'] or 0<$nump89) { 
	if (1==$estado_solicitud_pqrs ) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="solicitud_pqrs" id="'.$id.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a><br>';
	}else{}

	} else {}
	  ?>
	 
			<?php
		


echo '<b>Nombre:</b> '.$nombre.'<br>';
echo '<b>Tipo de documento:</b> ';
echo ''.quees('tipo_documento', $tipod).'<br>';
echo '<b>Identificación:</b> '.$identificacion.'<br>';
echo '<b>Etnia:</b> ';
echo ''.quees('etnia', $etnia).'<br>';
echo '<b>E-mail:</b> '.$correo_ciudadano.'<br>';
echo '<b>Telefono:</b> '.$telefono.'<br>';
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';


echo '<b>Estado:</b> ';
echo ''.quees('estado_solicitud', $id_estado_solicitud).'<br>';
echo '<b>Canal:</b> ';
echo ''.quees('canal_pqrs', $id_canal_pqrs).'<br>';

?>
</div>
 <div class="col-md-6">
<?php
echo '<b>Emisi&oacute;n de respuesta:</b> '.$erespuesta.'<br>';
echo '<b>Departamento:</b> ';
echo ''.quees('departamento', $dep).'<br>';
echo '<b>Municipio:</b> ';
echo ''.quees('municipio', $mun).'<br>';

echo '<b>Fecha de radicado:</b> ';
echo $fecha_radicado.'<br>';
echo '<b>Tipo de PQRSD:</b> ';
echo $categoria.'<br>';
echo '<b>Radicado:</b> ';
echo ''.$radicado.'<br>';
echo '<a href="https://servicios.supernotariado.gov.co/pqrs/pdf/'.$radicado.'.pdf"><img src="images/pdf.png"> Constancia</a>';
?>

</div>
</div>








<div class="row" >
	 <div class="col-md-12">
<?php 
echo '<br><b>Asunto:</b> ';
echo $nombre_solicitud_pqrs.'<br><br>';

echo '<b>Descripción</b> '.$descripcion_solicitud_pqrs.'<br>';

?>

</div>  
    </div>      
          




<hr>


<?php if (4<=$id_estado_solicitud) { } else { ?>
<div class="row">
<div class="col-md-12">
<label  class="control-label">Adjuntar documentos: </label>  <span style="color:#ff0000;">Inferior a 8 Megas</span>
</div>
</div>


<form action="" method="POST" name="for4345113454m1ftregg" enctype="multipart/form-data" >
<div class="row">
<div class="col-md-7">
<input type="hidden" name="nombre_documento_pqrs" value="<?php echo 'Adjunto_'.$radicado.'_'.date("YmdHis"); ?>">
<input type="file" name="file">
</div>
<div class="col-md-5">
<button type="submit" class="btn btn-danger">
<span class="glyphicon glyphicon-paperclip"></span> Adjuntar documento </button>
</div>
</div>
</form>
<?php  } ?>


<div class="row">
<div class="col-md-12">


<?php
$query = sprintf("SELECT * FROM documento_pqrs where nombre_documento_pqrs!='Constancia de la solicitud' and id_solicitud_pqrs='$idso' and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<br><b>Documentos adjuntos</b><br><br>';
	
do {
	
	
	if ((1==$_SESSION['rol'] or 0<$nump89) && (5>$id_estado_solicitud)) {
 echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_pqrs" id="'.$row['id_documento_pqrs'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a> ';
       		
	} else {}
	
      echo '<a href="files/'.$row['carpeta'].''.$row['url_documento'].'" target="_black"><i class="glyphicon glyphicon-download-alt"></i> '.$row['nombre_documento_pqrs'].'</a>';
       echo '<br>';
  
	  
	   
	   
      echo 'Fecha: '.$row['fecha_subida'].'<br>';


	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);


?>






<?php 



if (0<$de_certicamara) {
	

$radicado=$de_certicamara;

$ftp_server = "192.168.10.22";
$ftp_user_name = "verpdfsisg"; 
$ftp_user_pass = "test2018*"; 



$actualizar57 = mysql_query("SELECT * FROM doc_cert, radi_cert WHERE doc_cert.radi_cert=radi_cert.radi_cert and radi_cert.id_radi_cert=".$radicado." and estado_doc_cert=1", $conexion) or die(mysql_error());
$row157 = mysql_fetch_assoc($actualizar57);
$total557 = mysql_num_rows($actualizar57);
if (0<$total557) {
 do { 
 
 if ('192.168.202.7'==$iplocal) {
 echo '<img src="images/pdf.png"> <a href="ftp://'.$ftp_user_name.':'.$ftp_user_pass.'@'.$ftp_server.'/PQRS/'.$row157['nombre_doc_cert'].'" target="_blank">Anexo</a><br>';   
 } else {
	 
 echo  'Subido: '.$row157['fecha_doc_cert'].' / Expediente: '.$row157['expediente'].' - '.$row157['nombre_doc_cert'].'<br>';		  	 
 }
 
    
 } while ($row157 = mysql_fetch_assoc($actualizar57)); 
  mysql_free_result($actualizar57);
} else { }


} else { }
?>


</div>




<div>
<?php
if (1==$id_estado_solicitud) {
?>
<br>
<br>
<form action="" method="POST" name="for434dsffrtret5113454m1ftregg"  >
<div class="row">
<div class="col-md-12">
<center>
<input type="hidden" name="finalizarsolicitud" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Finalizar solicitud</button>
</center>
</div>
</div>
</form>
<?php } else {} ?>
</div>


</div>
			
	

<br>
<br>		  
 </div>  			  

			
			
              <!-- /.table-responsive -->
            </div>
        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
		
		<div class="col-md-3">
	  

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
$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id_ciudadano."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1 order by id_solicitud_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
			echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
			
			

	}
	$result8->free();
?>


		<?php
$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1", $conexion) or die(mysql_error());
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
?>




				</div>
			</div>	
	</div>
	</div>
	
	
<?php } else {} ?>
