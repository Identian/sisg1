<?php
if (isset($_GET['i']) && (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina']) && isset($_SESSION['id_vigilado']) && ""!=$_SESSION['id_vigilado'])) {

$id=intval($_GET['i']);


$idofici=$_SESSION['snr_tipo_oficina'];
$idvigilado=$_SESSION['id_vigilado'];


$querybun = sprintf("SELECT radicado FROM solicitud_pqrs where id_solicitud_pqrs=".$id." limit 1"); 
$selectbun = mysql_query($querybun, $conexion);
$rowbun = mysql_fetch_assoc($selectbun);
$inforadi=$rowbun['radicado'];



if (1==$_SESSION['rol']){
	$querybu = sprintf("SELECT count(id_requerir_pqrs) as totr FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1"); 
} else {
	$querybu = sprintf("SELECT count(id_requerir_pqrs) as totr FROM requerir_pqrs where id_tipo_oficina=".$idofici." and id_vigilado=".$idvigilado." and id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1"); 

}

$selectbu = mysql_query($querybu, $conexion);
$rowbu = mysql_fetch_assoc($selectbu);
if (0<$rowbu['totr']) {
	


if (isset($_POST['nombre_vigilado_pqrs'])) {
	
	if (""!=$_POST['nombre_vigilado_pqrs'] && 1==$_SESSION['snr_grupo_cargo']) {
	
	if (3==$idofici) {
	$nombre_vig=quees('notaria', $idvigilado);
} else if (4==$idofici) {
	$nombre_vig=quees('curaduria', $idvigilado);	
} else { }
	
	
	
$resp=$_POST['nombre_vigilado_pqrs'];

$radicado_requerimientof=$_POST['radicado_requerimientof'];

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
$radicado='SNR'.$anoiris.'ER'.$info6iris;

$idcorrespondenciaf=$idcorrespondencia+1;

//echo '<br>'.$radicado;

$fechairis=date("Y-m-d H:i:s");

$textoiris=strip_tags($_POST["nombre_vigilado_pqrs"]);




$consultab = sprintf("INSERT INTO correspondencia (idcorreoprioridad, idtipodocumento, codigo, referencia, asunto, 
idestado, idcorreovia, recibida, interna, deint, de, paraint, para, folios, anexos, contenido, 
fechaenvio, fecharecepcion, descripcion, creado, fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString('1', "text"), 
GetSQLValueString('334', "text"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString($radicado_requerimientof, "text"), 
GetSQLValueString('Respuesta a requerimiento', "text"), 
GetSQLValueString('8', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('Notaria '.$nombre_vig, "text"), 
GetSQLValueString('5,2506 ', "text"), 
GetSQLValueString('GVN / OPE_IMPR / MIGUEL ALFREDO GOMEZ CAICEDO [Usuario]', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris, "text"),
GetSQLValueString('2506', "text"),
GetSQLValueString($fechairis, "text"));


$resultado = pg_query ($consultab);


  pg_free_result($resultado);
  pg_close($conexionpostgresql);  

  }


  
$updateSQL7797k = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					   GetSQLValueString(7, "int"),
					   GetSQLValueString($id, "int"));
$Result17797k = mysql_query($updateSQL7797k, $conexion);



$updateSQL77 = sprintf("UPDATE requerir_pqrs SET respuesta_requerimiento=%s, radicado_respuesta=%s, fecha_respuestar=now() WHERE id_solicitud_pqrs=%s and estado_requerir_pqrs=1",                  
					  GetSQLValueString($resp, "text"),
					  GetSQLValueString($radicado, "text"),
					    GetSQLValueString($id, "int"));
$Result177 = mysql_query($updateSQL77, $conexion);
  
$to= 'vigilanciasdn@supernotariado.gov.co';
$subject = 'Superintendencia de Notariado y Registro';
$headers = "From: Supernotariado<notificadorD@supernotariado.gov.co>\r\n";
$headers .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = '';
$message .= 'Cordial saludo<br><br>';
$message .= 'La Notaria ha dado respuesta a la PQRS con radicado '.$radicado_requerimientof.' y de referencia: '.$inforadi.'<br><br>';
$message .= 'Puede visualizar la respuesta en la dirección web <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp" >https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a> <br><br>';
$message .= 'Superintendencia de Notariado y Registro.<br>';
mail($to, $subject, $message, $headers);
  
  
  
  echo $insertado;
  
	} else {
		
		echo '<script type="text/javascript">swal(" ERROR !", " La respuesta no puede estar vacia !", "error");</script>';

	}
  
  
} else { 



 }



if ((isset($_POST["nombre_respuesta_pqrs_documento"])) && ($_POST["nombre_respuesta_pqrs_documento"] != "")) { 


$tamano_archivo=10485760;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


//$directoryftp="files/";

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
  
  
$seguridad=md5($files);
  

$insertSQL5 = sprintf("INSERT INTO documento_pqrs (idcorrespondencia, id_ciudadano, id_funcionario, 
nombre_documento_pqrs, id_solicitud_pqrs, id_clase_documento, fecha_subida, 
carpeta, url_documento, extension, hash_documento, estado_documento_pqrs) 
VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s)", 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["ciudadadopqrs"], "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString('Respuesta de Notaria', "text"),
 GetSQLValueString($id, "int"), 
 GetSQLValueString(3, "int"), 
  GetSQLValueString($carpeta, "text"), 
 GetSQLValueString($files, "text"), 
 GetSQLValueString($extension, "text"), 
 GetSQLValueString($seguridad, "text"),
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL5, $conexion) ;



if (1==$_SESSION['rol']){
	$to= 'giovanni.ortegon@supernotariado.gov.co';
//echo	$files.$insertSQL5;
} else {
	$to= 'vigilanciasdn@supernotariado.gov.co';
}


$subject = 'Superintendencia de Notariado y Registro';
$headers = "From: Supernotariado<notificadorD@supernotariado.gov.co>\r\n";
$headers .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = '';
$message .= 'Cordial saludo<br><br>';
$message .= 'La Notaria ha adjuntado una respuesta con la referencia PQRSD: '.$inforadi.'<br><br>';
$message .= 'Puede acceder a la PQRSD mediante la dirección web <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp" >https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$id.'.jsp</a> <br><br>';
$message .= 'Superintendencia de Notariado y Registro.<br>';
mail($to, $subject, $message, $headers);


echo $insertado;

  
  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';

		}
	
	

} else { }









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
$estado_solicitud_pqrs=$row4['id_estado_solicitud'];

if (isset($row4['id_etnia']) && ""!=$row4['id_etnia']) {
$etnia=$row4['id_etnia'];
} else {
$etnia=6;	
}
} else { }
$result4->free();





$queryb = sprintf("SELECT * FROM requerir_pqrs where id_solicitud_pqrs=".$id." and estado_requerir_pqrs=1"); 
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);
$nombre_requerir_pqrs=$rowb['nombre_requerir_pqrs'];
$radicado_requerimiento=$rowb['radicado_requerimiento'];

?>	
	
	<div class="row">
<div class="col-md-9">
	<div class="box box-info">


 <div class="box-header with-border">
 <h3><center><b>REQUERIMIENTO DE LA SNR - PQRSD</b></center></h3>
                

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
<div class="row" >
<div style="text-align:right;">
</div>	



 <div class="col-md-6">
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
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';
echo '<b>Canal de entrada:</b> ';
echo ''.quees('canal_pqrs', $canal).'<br>';


?>
</div>
 <div class="col-md-6">
<?php
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
echo '<a href="https://pqrs.supernotariado.gov.co/pdf/'.$radicado.'.pdf"><img src="images/pdf.png"> Constancia</a>';
     
	 
?>
</div>




</div>

<div class="row" >
	 <div class="col-md-12">
	 
<?php 
echo '<br><b>Asunto</b> ';
echo $nombre_solicitud_pqrs.'<br><br>';

echo '<b>Descripción</b> '.$descripcion_solicitud_pqrs.'<br>';


$query = sprintf("SELECT * FROM documento_pqrs where nombre_documento_pqrs!='Constancia de la solicitud' and id_solicitud_pqrs='$idso' and id_clase_documento=1 and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

if (0<$totalRows){
	echo '<b>Documentos adjuntos del ciudadano</b> <br> ';
do {
	
      echo '<a href="files/'.$row['carpeta'].''.$row['url_documento'].'" target="_black"><img src="images/pdf.png"> '.$row['nombre_documento_pqrs'].'</a>';
      echo '<br>';


	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);





			
			?>	 

		</div>  
    </div>      
          
<hr>


<?php 
echo '<h3>'.$radicado_requerimiento.'</h3>';
echo '<div style="text-align:right;"><a href="pdf/requerimiento&'.$id.'.pdf" download="'.$rowb['radicado_requerimiento'].'.pdf"><img src="images/pdf.png"></a></div>';
echo $nombre_requerir_pqrs;

echo '<hr>';

if (isset($rowb['respuesta_requerimiento']) and ""!=$rowb['respuesta_requerimiento']) {
echo '<hr>';
echo '<div style="text-align:right;"><a href="pdf/respuestarequerimiento&'.$id.'.pdf" download="respuesta_'.$radicado_requerimiento.'.pdf"><img src="images/pdf.png"></a></div>';

echo $rowb['fecha_respuestar']; 
echo '<br>';
echo $rowb['radicado_respuesta']; 
echo '<br>';
echo $rowb['respuesta_requerimiento']; 
 } else { 
 
 
if (5==$estado_solicitud_pqrs) { } else {
	
if ((3==$_SESSION['snr_tipo_oficina'] and 1==$_SESSION['snr_grupo_cargo'])) {
	
//if (3==$_SESSION['snr_tipo_oficina'] or 1==$_SESSION['rol']) {
 ?>

<form action="" method="POST" name="form1" >
<div class="form-group text-left"> 
<label  class="control-label">RESPUESTA:</label> 
<br>
<textarea class="textarea" required name="nombre_vigilado_pqrs" id="texto_modelo_respuesta_pqrs2" style="width:100%;min-height:400px; "></textarea>
</div>
<div class="modal-footer">
<button type="submit" class="confirmarrespuestar btn btn-success">
<input type="hidden" name="table" value="vigilado_pqrs">
<input type="hidden" name="radicado_requerimientof" value="<?php echo $radicado_requerimiento; ?>">
<input type="hidden" name="ciudadadopqrs" value="<?php echo $id_ciudadano; ?>">

<span class="glyphicon glyphicon-ok">
</span> Enviar respuesta </button></div>
</form>



 <?php  
	} else {
		
		echo '<label  class="control-label">RESPUESTA:</label> <br>El Notario es el único que puede enviar la respuesta oficial.';
	}
 
 } }  ?>

<hr>
<?php if (isset($rowb['respuesta_requerimiento']) and ""!=$rowb['respuesta_requerimiento']) { } else { 

if (5==$estado_solicitud_pqrs) { } else {
	
if (3==$_SESSION['snr_tipo_oficina'] or 1==$_SESSION['rol']) {
?>
<hr>
Adjuntar documentos:

<form action="" method="POST" name="adjuntar_documento545435" enctype="multipart/form-data" >
<div class="row">
<div class="col-md-5">
<input type="hidden" name="nombre_respuesta_pqrs_documento" value="1">
<input type="file" name="file" class="adjuntar">
<input type="hidden" name="ciudadadopqrs" value="<?php echo $id_ciudadano; ?>">
</div>
<div class="col-md-7">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-paperclip"></span> Adjuntar anexos </button>
<span style="color:#777;">Documentos PDF inferiores a 10 Mb.</span>
<br>
<span style="color:#777;">Aquellos documentos que superen los 10 Mb deberán dividirse en archivos más pequeños inferiores a 10 Mb.</span>
</div>
</div>
</form>

<?php
} else {}

}
}


$query = sprintf("SELECT * FROM documento_pqrs where id_solicitud_pqrs=".$id." and id_clase_documento=3 and estado_documento_pqrs=1 order by id_documento_pqrs"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	$documento=1;
	echo '<label  class="control-label">Anexos:</label><br>';
	

	
	
do {
	
	
 if (1==$_SESSION['snr_grupo_cargo'] && !isset($rowb['respuesta_requerimiento'])) {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_pqrs" id="'.$row['id_documento_pqrs'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a> ';
} else { }

	
echo '<a title="'.$row['fecha_subida'].'" href="files/'.$row['carpeta'].''.$row['url_documento'].'" target="_blank"><img src="images/pdf.png"> ';


if (40<strlen($row['nombre_documento_pqrs'])){
echo trim(substr($row['nombre_documento_pqrs'],0,40)).' (...)';
} else {
echo $row['nombre_documento_pqrs'];
}

echo '</a> - Adjunto: ';

echo quees('funcionario', $row['id_funcionario']);






echo '<br>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 
	
	
} else { $documento=0;}	 
mysql_free_result($select);
?>


<br>
<br>
<div>
</div>		  
 </div>  			  

			
			
              <!-- /.table-responsive -->
            </div>
        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
		
		<div class="col-md-3">






		
<div class="box box-primary direct-chat direct-chat-warning" >
    <div class="box-header with-border">
                  <h3 class="box-title">


				  Tipificación
			
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
			echo ''.quees('categoria_oac', $row9['id_categoria_oac']).' / ';
			echo ''.quees('clase_oac', $row9['id_clase_oac']).' / ';
if (isset($row9['id_tema_oac']) && 0!= $row9['id_tema_oac']){ echo ''.quees('tema_oac', $row9['id_tema_oac']).' / '; } else { }
if (isset($row9['id_motivo_oac']) && 0!= $row9['id_motivo_oac']){ echo ''.quees('motivo_oac', $row9['id_motivo_oac']).'  -  '; } else { }
		
		
			
			
			echo '<hr>';
	}
	$result8->free();
?>
		</div>
		
	</div>	
</div>

		  
		  
		 

		 
<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
<h3 class="box-title">Requerimiento</h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">

<?php

	$fecha_req=$rowb['fecha_solicitudr'];
			echo '<span style="color:#777;">'.$fecha_req.'</span><br>';
       	echo '<span style="">'.quees('tipo_oficina', $rowb['id_tipo_oficina']).' - ';
		if (3==$rowb['id_tipo_oficina']) {
			echo quees('notaria', $rowb['id_vigilado']);
		} elseif (4==$rowb['id_tipo_oficina']) {
				echo quees('curaduria', $rowb['id_vigilado']);
		} else {}		
		echo '</span><br>';
		
		echo '<span style="font-size:12px;">Proyectado por ';
		
		echo quees('funcionario', $rowb['id_funcionario']);
		
		echo '</span><br>';
		
	
	$fecharnotario=fechahabil($fecha_req,5);
	$fecharfun=fechahabil($fecha_req,30);
	

	echo 'Tiempo: 5 dias habiles<br>Fecha de plazo para el notario: ';
	
	//echo $fecharnotario;
	
	
	
$fechavence1=explode("-", $fecharnotario);
	
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
 
 

document.write("<br><span id='evento" + id + "'></span> <br /> Tiempo restante en dias calendario: ");
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

	
	




		</div>
	</div>	
</div> 
 
 
		  
		  



		  
	
	</div>
	
	



        </div>
		
		<?php
		} else { echo 'No tienes acceso.'; }
		
		
		mysql_free_result($selectb);
		

		
		} else { echo ''; }
		
		?>