<?php
$nump84=privilegios(84,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 1==$_SESSION['snr_tipo_oficina']) {
$id = $_GET['i'];


if (1==$_SESSION['rol'] or 302==$_SESSION['snr_grupo_area']) {
$area=intval($_POST["id_grupo_area"]);
$fecha_publicacion=$_POST["fecha_publicacion"];
$carea="";
} else {
$area=$_SESSION['snr_grupo_area'];	
$fecha_publicacion=date('Y-m-d');
$carea=" and id_grupo_area=".$area." ";
}





if (isset($_GET["i"]) && ""!=$_GET["i"]) {
$aviso=intval($_GET["i"]);

function porestado($valorc) {
global $mysqli;
$query4p = sprintf("SELECT * from notificacion_aviso where id_notificacion_aviso=".$valorc." and estado_notificacion_aviso=1 limit 1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['email'].'///'.$row4p['decision'];
return $resp;
$result4p->free();
}



function adjuntos($ede) {
global $mysqli;
$doci='';
$query = "SELECT * FROM notificacion_aviso_doc where id_notificacion_aviso=".$ede." and estado_notificacion_aviso_doc=1";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
    	$id_doc=$obj['id_notificacion_aviso_doc'];
$doci.= '<a href="https://www.supernotariado.gov.co/files/portal/notificacion/'.$obj['url'].'" target="_blank">'.$obj['nombre_notificacion_aviso_doc'].'</a><br>';
    }
return $doci;
$result->free();
}


$cuerposs=adjuntos($aviso);
  
//$emailu=$_POST["email"];

$des=porestado($aviso);
$desa=explode('///',$des);

$correouser=$desa[0];
$decision=$desa[1];

$emailu=$correouser;
$subject = 'Notificación por estado - SNR';
$cuerpo = ''; 
$cuerpo .= 'Cordial saludo. '."<br><br>"; 
$cuerpo .= 'Notificación: '.$decision."<br><br>"; 
$cuerpo .= 'Adjuntos:<br><br>';
$cuerpo .= $cuerposs;
$cuerpo .= '<br><br>Atentamente. '."<br>"; 
$cuerpo .= "<br><br>".'Superintendencia de Notariado y Registro'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
if (45==$area) {
$cabeceras .= 'Cc: notificacionesdisciplinariosdn@Supernotariado.gov.co' . "\r\n";
} else if (23==$area) {
$cabeceras .= 'Cc: procesos.disciplinarios@supernotariado.gov.co' . "\r\n";

} else {}
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($emailu,$subject,$cuerpo,$cabeceras);

$mensa=$emailu.$subject.$cuerpo.$cabeceras;

$updateSQL3 = sprintf("UPDATE notificacion_aviso SET 
email_envio=now()  
where 
id_notificacion_aviso=%s ".$carea." and email_envio is null and estado_notificacion_aviso=1",
GetSQLValueString($aviso, "int"));
$Result3 = mysql_query($updateSQL3, $conexion);
echo '<script type="text/javascript">swal(" OK !", " Registro  enviodo por correo.!", "success");</script>';
echo '<meta http-equiv="refresh" content="1;URL=notificacion_aviso.jsp" />';




} else {}










if (isset($_POST['fecha_auto']) && (0<$nump84 or 1==$_SESSION['rol'])) {
	


$insertSQL = sprintf("INSERT INTO notificacion_aviso (id_grupo_area, nombre_notificacion_aviso, auto, 
fecha_auto, cedula, expediente, folio, resolucion, tipo, iris, email, tipo_persona, decision, fecha_publicacion, estado_notificacion_aviso) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($area, "int"), 
GetSQLValueString($_POST["nombre_notificacion_aviso"], "text"), 
GetSQLValueString($_POST["auto"], "text"), 
GetSQLValueString($_POST["fecha_auto"], "date"), 
GetSQLValueString($_POST["cedula"], "int"), 
GetSQLValueString($_POST["expediente"], "text"), 
GetSQLValueString($_POST["folio"], "text"), 
GetSQLValueString($_POST["resolucion"], "text"), 
GetSQLValueString($_POST["tipo"], "text"), 
GetSQLValueString($_POST["iris"], "text"), 
GetSQLValueString($_POST["email"], "text"),
GetSQLValueString($_POST["tipo_persona"], "text"), 
GetSQLValueString($_POST["decision"], "text"), 
GetSQLValueString($fecha_publicacion, "date"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
//echo $insertSQL;
echo $insertado;
  

  
  
  
}








if ((isset($_POST["nombre_notificacion_aviso_doc"])) && ($_POST["nombre_notificacion_aviso_doc"] != "")) {
//echo $_POST["nombre_notificacion_aviso_doc"];
$tamano_archivo=20971520; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/portal/notificacion/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'notificacion-'.$_SESSION['snr'].'-'.$identi;

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
	
if (($extension2==$extension && 'pdf'==$extension2) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  

$insertSQL = sprintf("INSERT INTO notificacion_aviso_doc (id_notificacion_aviso, 
nombre_notificacion_aviso_doc, url, fecha_publicacion, estado_notificacion_aviso_doc) 
VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($_POST["id_notificacion_aviso"], "int"), 
GetSQLValueString($_POST["nombre_notificacion_aviso_doc"], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $insertado;
  
  
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
  
	
	






}
 else { }
 
 



?>
 
 


	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or 0<$nump84) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   
	   Notificación por aviso



</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">

<th>Fecha publicación</th>
<th>Desfijación</th>
<th>Estado</th>
<?php if (297==$_SESSION['snr_grupo_area']) { ?>
<th>Folio</th>
<th>Resolución</th>
<?php } else {  ?>
<th>Expediente / Folio</th>
<th>Auto / Resolución</th>
<?php } ?>
<th>Fecha</th>
<th>Tipo</th>
<th>Persona</th>
<?php if (1==$_SESSION['rol'] or 302==$_SESSION['snr_grupo_area']) { ?>
<th>Grupo</th>
<?php } else {} ?>
<th style="min-width:110px;"></th>	  




</tr>
</thead>
<tbody>
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {
					
				$infop='';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }	
				}
 
if (1==$_SESSION['rol'] or 302==$_SESSION['snr_grupo_area'])  {
  $infoarea="";
} else {
	$infoarea=" and id_grupo_area=".$area."";
}


$query4="SELECT * from notificacion_aviso where estado_notificacion_aviso=1 ".$infoarea." ".$infop." ORDER BY id_notificacion_aviso desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {



echo '<tr title="">';
$id_res=$row['id_notificacion_aviso'];
echo '<td>'.$row['fecha_publicacion'].'</td>';

if ('Por estado'==$row['tipo']) {
	echo '<td>'.$row['fecha_publicacion'].'</td>';
	echo '<td>Desfijado';
	
} else {

$fechaf=fechahabil($row['fecha_publicacion'], 5);
echo '<td>'.$fechaf.'</td>';
echo '<td>';
if ($fechaf>=$realdate) {
	echo 'Fijado';
} else {
	echo 'Desfijado';
}

}


echo ' <a style="color:#777;cursor: pointer" onclick="window.print()" title="Constancia"><span class="glyphicon glyphicon-print"></span></a>';
echo '</td>';
echo '<td>'.$row['expediente'].'</td>';
echo '<td>'.$row['auto'].'</td>';
echo '<td>'.$row['fecha_auto'].'</td>';
echo '<td>'.$row['tipo'];
if ('Por estado'==$row['tipo']) {
	echo ' / Decisión: '.$row['decision'];
} else {}

echo '</td>';
echo '<td>';
if (isset($row['cedula']))  {
echo $row['cedula'].' - ';
} else {} 
echo ''.$row['nombre_notificacion_aviso'].'</td>';

if (1==$_SESSION['rol'] or 302==$_SESSION['snr_grupo_area']) {

echo '<td>';
	$namearea=quees('grupo_area',$row['id_grupo_area']);
echo $namearea;
echo '</td>';
} else {}


echo '<td>';

	


	if (1==$_SESSION['rol'] or 0<$nump84) { 
	
	$queryv = sprintf("SELECT count(id_notificacion_aviso_doc) as cantidad FROM notificacion_aviso_doc where id_notificacion_aviso=".$id_res." and estado_notificacion_aviso_doc=1"); 
$selectv = mysql_query($queryv, $conexion);
$rowv = mysql_fetch_assoc($selectv);
echo $rowv['cantidad'];
mysql_free_result($selectv);

	if ('Por estado'==$row['tipo']) { 
	if (isset($row['email_envio'])) {
	echo ' <span title="'.$row['email_envio'].'">M enviado</span>';
	} else {
		
echo ' <a href="" class="buscar_anexo" id="'.$id_res.'" name="'.$row['expediente'].'" data-toggle="modal" data-target="#popupanexo"><span class="fa fa-file"></span></a> ';
	 
	echo ' <a href="notificacion_aviso&'.$id_res.'.jsp" class="enviar_correo">Email</a> ';
	
		echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="notificacion_aviso" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
 
 
	}
	
	
	
} else {
	echo ' <a href="" class="buscar_anexo" id="'.$id_res.'" name="'.$row['expediente'].'" data-toggle="modal" data-target="#popupanexo"><span class="fa fa-file"></span></a> ';
	 
		echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="notificacion_aviso" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
 
}
	
	} else {}
echo '</td>';
?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol'] or 0<$nump84) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
    

    
<form action="" method="POST" name="f245353454r65464563m1" >

<?php if (1==$_SESSION['rol'] or 302==$_SESSION['snr_grupo_area']) { ?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Grupo de trabajo:</label> 
<select class="form-control" name="id_grupo_area"  required>
<option></option>
<?php //echo lista('grupo_area'); ?>
<option value="45">Direccion de Vigilancia y Control Notarial</option>
<option value="14">Grupo de Administracion Judicial y de Jurisdiccion Coactiva</option>
<option value="32">Grupo de Control y Seguimiento Contractual</option>
<option value="298">Grupo de Formalizacion y Saneamiento de La Propiedad Inmueble</option>
<option value="42">Grupo de Inspeccion Vigilancia y Control Registral</option>
<option value="299">Grupo de Restitucion y Proteccion</option>
<option value="29">Grupo de Vinculacion y Evaluacion de Personal</option>
<option value="13">Grupo Juridico Registral Notarial y de Curadores Urbanos</option>
<option value="305">Grupo para el control y vigilancia de Curadores Urbanos</option>
<option value="12">Oficina Asesora Juridica</option>
<option value="23">Oficina de Control Disciplinario Interno</option>
<option value="19">Oficina de Control Interno</option>
<option value="25">Secretaria General</option>
<option value="48">SubDireccion de Apoyo Juridico Registral</option>
<option value="44">Superintendencia Delegada Para El Notariado</option>
<option value="41">Superintendencia Delegada Para El Registro</option>
<option value="297">Superintendencia Delegada para la Proteccion Restitucion y Formalizacion de Tierras</option>

</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha de publicación:</label> 
<input type="date" class="form-control" name="fecha_publicacion"  required>
</div>
<?php } else {} ?>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de persona:</label> 
<select class="form-control" name="tipo_persona" required>
<option selected></option>
<option>Investigado</option>
<option>Quejoso</option>
<option>Solicitante</option>
<option>Apoderado</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre del investigado, quejoso, solicitante o apoderado:</label> 
<input type="text" class="form-control" name="nombre_notificacion_aviso"  required>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Cédula (opcional):</label> 
<input type="text" class="form-control numero" name="cedula" >
</div>





<?php if (297==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {  ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 
Folio ó datos de antiguo sistema:
</label> 
<input type="text" class="form-control" name="expediente"  required>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 
Número de resolución:
</label> 
<input type="text" class="form-control" name="auto"  required>
</div>
<?php } else { ?>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 
Número del expediente:
</label> 
<input type="text" class="form-control" name="expediente"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 
Número del Auto:
</label> 
<input type="text" class="form-control" name="auto"  required>
</div>

<?php } ?> 

<!--
<div class="form-group text-left"> 
<label  class="control-label"> Tipo de notificación:</label> 
<select class="form-control" name="tipo" required>
<?php //echo lista('tipo_notificacion'); ?>
</select>
</div>
-->

<div class="form-group text-left"> 
<label  class="control-label"> Tipo de notificación:</label> 
<select class="form-control" name="tipo">
<option selected>Por aviso</option>
<option>Por estado</option>
<option>Por correo electronico</option>
<!--<option>Personal</option>
<option>Por conducta concluyente</option>
<option>Publicidad o notificación a terceros de quienes se desconozca su domicilio</option>-->
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha:</label> 
<input type="date" class="form-control" name="fecha_auto"  required>
</div>






<?php if (45==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {?>



<?php if (1==$_SESSION['rol']) { ?>
<div class="form-group text-left"> 
<label  class="control-label"> Radicado de iris:</label> 
<input type="text" class="form-control" name="iris">
</div>
<?php } else {} ?>



<div class="form-group text-left"> 
<label  class="control-label"> Correo electrónico <span style="color:#ff0000;">* Obligatorio para notificaciones por estado (Separados por , para más de 1.).</span></label> 
<input type="text" class="form-control" name="email">
</div>



<div class="form-group text-left"> 
<label  class="control-label"> Asunto / Decisión: <span style="color:#ff0000;">* Obligatorio para notificaciones por estado.</span></label> 
<textarea class="form-control" name="decision"></textarea>
</div>

<?php } else {} ?>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Guardar </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="popupanexo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Anexos</b></h4>
</div> 
<div class="ver_anexo" class="modal-body"> 

</div>
</div> 
</div> 
</div> 



<?php } else { }?>
<?php } else { }?>



