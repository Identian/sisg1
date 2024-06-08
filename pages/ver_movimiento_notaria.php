<?php
if (isset($_GET['i']) && "" != $_GET['i'] && 1==2) {
$id = $_GET['i'];
$query_update = sprintf("select solicitud_pqrs.id_solicitud_pqrs, radicado, tipo_req_tras, id_vigilado, terminos_notaria, correo_oficina, 
radicado_requerimiento, fecha_solicitudr, fecha_respuestar, id_requerir_pqrs, nombre_requerir_pqrs, respuesta_requerimiento, respuesta_pre_ciudadano, radicado_ciudadano 
FROM requerir_pqrs, solicitud_pqrs WHERE requerir_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and estado_requerir_pqrs=1 AND id_requerir_pqrs = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);
?>
<div class="row">
<div class="col-md-9">
<div class="box box-primary">
<div class="box-header with-border">
<B>PQRSD: 
<?php echo '<a href="solicitud_pqrs&'.$row_update['id_solicitud_pqrs'].'.jsp" target="blank">'.$row_update['radicado'].'</a>'; ?>
		</b>

<hr>
<b>Control de movimiento</b>
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


</div>

</div>
</div>
</div>


<div class="col-md-3">

<div class="box box-primary direct-chat direct-chat-danger" >
    <div class="box-header with-border">
            <h3 class="box-title">
Seguimiento</h3>
		<div class="box-tools pull-right">       
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
  </button></div>
                </div>
 <div class="box-body" >

<div  class="modal-body" >
<a href="" id="" class="btn btn-success ventana1" data-toggle="modal" data-target="#popupokrespuesta" style="width:100%;">
<span class="glyphicon glyphicon-inbox"></span> Movimiento Notaria</a>
<br>
<br>


<?php

/*
$query489 = sprintf("SELECT * FROM retorno_pqrs where id_solicitud_pqrs=1 and estado_retorno_pqrs=1 order by id_retorno_pqrs desc"); 
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
	
	*/

			?>

		</div>
	</div>	
</div> 
</div>


</div>



<br>

<?php
if ((isset($_POST["tipo_seguimiento"])) && (""!=$_POST["tipo_seguimiento"])) {

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/requerimientos/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'requerimiento-'.$_SESSION['snr'].'-'.date("YmdGis");

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
  
	
	
	$insertSQL = sprintf("INSERT INTO movimiento_requerir_pqrs (tipo_seguimiento, nombre_movimiento_requerir_pqrs, 
id_requerir_pqrs, id_funcionario, url, fecha_publicacion, estado_movimiento_requerir_pqrs) 
VALUES (%s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($_POST["tipo_seguimiento"], "text"), 
GetSQLValueString($_POST["nombre_movimiento_requerir_pqrs"], "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION["snr"], "int"), 
GetSQLValueString($files, "text"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;

echo $insertado;
   
   

} else { }


?>

<hr>
<script type="text/javascript">
function info(){
var name32=prompt("Corregir:","")
//if (''!=name32 or ){
if (1<=name32.length){
location.href='ver_movimiento_notaria&<?php echo $id; ?>&'+name32; 
 return true;
  }
 else {
 return false;
}
}


</script>

<?php
$queryr = sprintf("SELECT * FROM movimiento_requerir_pqrs where id_requerir_pqrs=".$id." and estado_movimiento_requerir_pqrs=1 order by id_movimiento_requerir_pqrs"); 
$selectr = mysql_query($queryr, $conexion);
$rowr = mysql_fetch_assoc($selectr);
$totalRowsr = mysql_num_rows($selectr);
if (0<$totalRowsr){
do {
	?>
	
	<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">

<div class="col-md-3">
<a href="" onclick="info()" id="2" class="btn btn-primary" style="width:100%">
<span class="glyphicon glyphicon-pencil"></span>  Corregir
</a>
</div>
<div class="col-md-3">
<form action="" method="POST" name="ftrf3445435hy234truyuy<?php echo $rowr['id_movimiento_requerir_pqrs']; ?>">
<input type="hidden" name="vistob_pqrs" value="1">
<input type="hidden" name="seccion" value="2">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-ok"></span>  Visto bueno</button>
</form>
</div>
<div class="col-md-3"> 
<a href="" class="btn btn-warning" style="width:100%" >
<span class="glyphicon glyphicon-pencil"></span>    Modificar</a>
</div>
<div class="col-md-3"> 
<form action="" method="POST" name="f22345345trfhy234try">
<input type="hidden" name="aprobar_requerir_pqrs" value="1">
<input type="hidden" name="seccion" value="2">
<button type="submit" class="btn btn-success" style="width:100%">
<span class="glyphicon glyphicon-envelope"></span>  Aprobar y enviar</button>
</form>
</div>
<br><br>
	<?php
	
	echo '<b>'.$rowr['tipo_seguimiento'].'</b> &nbsp;  &nbsp; ';
		echo 'Fecha: '.$rowr['fecha_publicacion'].' &nbsp;  &nbsp;  &nbsp; Autor: ';
			echo '  '.quees('funcionario', $rowr['id_funcionario']);
	
	
	if (isset($rowr['url']) && ""!=$rowr['url']) {	
echo ' &nbsp;  &nbsp; <a href="filesnr/requerimientos/'.$rowr['url'].'" target="_blank">Adjunto</a>';
	} else {}
	echo '<br>'.$rowr['nombre_movimiento_requerir_pqrs'];
		

echo '<br></div>
</div>
</div>
</div>';
	 } while ($rowr = mysql_fetch_assoc($selectr)); 
} else {}	 
mysql_free_result($selectr);
?>
</div>












<div class="modal fade" id="popupokrespuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Ok Respuesta:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1F435435G42343DG" enctype="multipart/form-data">
<div class="form-group text-left"> 
<label  class="control-label">Mensaje:</label> 
<input type="hidden" name="tipo_seguimiento" value="ok respuesta">
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="texto_acto_admin_x_licencia" >
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file"> 
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















<div class="modal fade" id="popupconminacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Conminación Notaria:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FGDG" enctype="multipart/form-data">
<div class="form-group text-left"> 
<input type="hidden" name="tipo_seguimiento" value="Conminacion Notaria">
<label  class="control-label">Mensaje:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="texto_requerir" >
<?php
$fec9= $diam.' de '.mese($mesm).' de '.$anom;
echo 'Bogotá, '.$fec9.'';
?>
<br><br>
Doctor/a<br>
Notario/a <br><br>

	
Referencia: Radicado <?php echo $radicado; ?> 
<br><br>
Respetado/a Señor/a Notario/a:
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">


Mediante el radicado de la referencia fue recibida una PETICIÓN, suscrita por el/a señor/a xxxx, relacionada con la presunta afectación en la adecuada prestación del Servicio Público Notarial, cuyo texto puede consultar haciendo clic en el botón que encontrará en la parte inferior del presente correo. Así, teniendo presente que los notarios han sido investidos por la Constitución y la ley para dar cumplimiento a las funciones previstas en el artículo 3 del Decreto 960 de 1970 y las demás normas que lo complementan, se pone en su conocimiento la comunicación con radicado SNR2021ERxxxxx, para que dé una respuesta de fondo al usuario, la cual deberá ser remitida a la dirección de notificación electrónica o física suministrada por este; y adjuntarse en el botón que encontrará en la parte inferior del presente correo. Los soportes o anexos que excedan de 10 Mb deberán ser enviados con copia a esta Dirección a través del correo vigilanciasdn@supernotariado.gov.co.
<br><br>
Lo anterior, con el fin de que la Superintendencia de Notariado y Registro, en desarrollo de las funciones asignadas y previstas en los Decretos 960 de 1970, 2723 de 2014 y en la Circular xxx haga el seguimiento correspondiente y ejerza la vigilancia sobre la respuesta que se brinde al usuario, de manera que se ajuste a los presupuestos normativos aplicables al caso particular; asimismo, que sea de fondo, congruente y oportuna en los términos de la Ley 1755 de 2015, otorgando una solución conforme a derecho que garantice la adecuada prestación del servicio público notarial a su cargo.

</p><br><br>
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
<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file" > 
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











<div class="modal fade" id="popupconminacionciu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Conminación Ciudadano:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="fo2rm132424FGDG" enctype="multipart/form-data">
<input type="hidden" name="tipo_seguimiento" value="Conminacion Ciudadano">
<div class="form-group text-left"> 

<label  class="control-label">MENSAJE:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="texto_info_ciudadano">

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

	
Referencia: Respuesta del Requerimiento <?php echo $radicado; ?> 
<br><br>
Respetado/a señor/a, reciba un atento saludo.
<br><br>
<p align="justify" style="text-align: justify; text-justify: inter-word;">

En respuesta al radicado de la referencia, se informa que el notario es un particular que presta un servicio público consistente en dar fe pública de los actos, negocios y de las declaraciones que ante él presenten los usuarios.
<br><br>
Por este motivo, teniendo en cuenta que el notario es el prestador del servicio y quien puede otorgar una solución directa, oportuna y eficaz a través de la cual se atiendan sus inconformidades y se salvaguarden sus derechos, la comunicación con radicado SNR2021ERXXXXX será puesta en conocimiento de aquel, con el fin de que le brinde una respuesta de fondo, congruente, en tiempo y que se ajuste a la normatividad que rige la materia.
<br><br>
Así damos por concluido el asunto, no sin antes señalar que la Superintendencia de Notariado y Registro en ejercicio de sus funciones hará el seguimiento correspondiente y ejercerá la vigilancia sobre la respuesta que se brinde, verificando que se ajuste a los presupuestos normativos aplicables al caso y que cumpla con los criterios antes señalados.
<br><br>
Cabe resaltar que la Delegada para el Notariado está presta a recibir sus solicitudes e inconformidades y a tomar las medidas pertinentes para mejorar la prestación del servicio público notarial.

</p>

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

<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file"> 
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










<div class="modal fade" id="popupcontrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Traslado a Control:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FG42343DG" enctype="multipart/form-data">
<div class="form-group text-left"> 
<input type="hidden" name="tipo_seguimiento" value="Traslado a Control">
<label  class="control-label">Mensaje:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="asunto_control" >
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file"> 
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









<div class="modal fade" id="popupreqnotaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Requerimiento a Notaria:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FG42342342343DG" enctype="multipart/form-data">
<div class="form-group text-left"> 
<input type="hidden" name="tipo_seguimiento" value="Requerimiento a Notaria">
<label  class="control-label">Mensaje:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="texto_modelo_respuesta_pqrs" >
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file"> 
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













<div class="modal fade" id="popupreqciu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Requerimiento a Ciudadano:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FG423424343DG" enctype="multipart/form-data">
<div class="form-group text-left"> 
<input type="hidden" name="tipo_seguimiento" value="Requerimiento a Ciudadano">
<label  class="control-label">Mensaje:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="respuesta_pre_ciudadano" >
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file"> 
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






<div class="modal fade" id="popuprespciu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Respuesta a Ciudadano:</b> <span class="licenciac" ></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1FG423424343DG" enctype="multipart/form-data">
<div class="form-group text-left"> 
<input type="hidden" name="tipo_seguimiento" value="Respuesta a Ciudadano">
<label  class="control-label">Mensaje:</label> 
<textarea spellcheck="true" lang="es"  class="form-control" name="nombre_movimiento_requerir_pqrs" id="texto_modelo_respuesta_pqrs2" >
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Adjuntar documento:</label> 
<input type="file" value="" name="file" id="file"> 
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
}}
?>
