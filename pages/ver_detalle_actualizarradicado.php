<?php
session_start();

if (isset($_POST['option']) and ""!=$_POST['option']) {
$idradicadogg=intval($_POST['option']);

//echo $id;
require_once('../conf.php'); 


$query_update = "SELECT * FROM radicacion_curaduria where id_radicacion_curaduria = ".$idradicadogg." and estado_radicacion_curaduria=1 limit 1";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54432423454324435354r65464563m1" >

<?php //if (107==$_SESSION['permiso107']) { echo '...'; } else { echo ''; }  ?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN:</label> 
<?php echo $row_update['codigo_curaduria']; ?>
<input  class="form-control numero" maxlength="4" name="numero_completo" value="<?php echo $row_update['numero_radicacion_curaduria']; ?>" 
<?php if (107==$_SESSION['permiso107'] or 1==$_SESSION['rol']) { } else { echo 'readonly'; }  ?>
  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE TRAMITE:</label> 


<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
	});
	</script>
<select class="form-control js-example-basic-multiple" style="width:440px;" required name="tipo_licencia2[]" multiple>
	<?php
	
$palabra=explode(",",$row_update['tipo_licencia']);

echo '<optgroup label="Inicialmente">';
foreach($palabra as $key) {  
if (""!=$key) {   
echo '<option selected="selected">'.$key.'</option>'; 	
} else {}
}

echo '</optgroup>';
	echo '<optgroup label="Actualizar">';
$actualizar5 = mysql_query("SELECT * FROM tipo_licencia WHERE estado_tipo_licencia=1", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
   echo '<option value="'.$row15['nombre_tipo_licencia'].'" ';
   echo '>'.$row15['nombre_tipo_licencia'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
echo '</optgroup>';
?>
</select>

</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OBJETO DEL TRAMITE:</label> 
<select class="form-control"  required name="verdadero_objeto2">
<option></option>
<option <?php if ('Inicial'==$row_update['verdadero_objeto']) { echo 'selected'; } else {} ?>>Inicial</option>
<option <?php if ('Modificación de licencia vigente'==$row_update['verdadero_objeto']) { echo 'selected'; } else {} ?>>Modificación de licencia vigente</option>
<option <?php if ('Revalidación'==$row_update['verdadero_objeto']) { echo 'selected'; } else {} ?>>Revalidación</option>

</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OTRAS ACTUACIONES:</label> 
<SELECT  class="form-control" name="actuacion2" >

<option selected><?php echo $row_update['actuacion']; ?></option>
<option>NO PRESENTA</option>
<option>AJUSTE DE AREAS</option>
<option>CONCEPTO DE NORMA URBANISTICA</option>
<option>CONCEPTO DE USO DEL SUELO</option>
<option>COPIA CERTIFICADA DE PLANOS</option>
<option>APROBACION DE LOS PLANOS DE PROPIEDAD HORIZONTAL</option>
<option>AUTORIZACIÓN PARA EL MOVIMIENTO DE TIERRAS</option>
<option>APROBACIÓN DE PISCINAS</option>
<option>MODIFICACION DE PLANOS URBANISTICOS, DE LEGALIZACION Y DEMAS PLANOS QUE APROBARÓN DESARROLLOS O ASENTAMIENTOS</option>
<option>BIENES DESTINADOS A USO PUBLICO O CON VOCACIÓN DE USO PÚBLICO</option>
</select>
</div>

<?php
/*
if ('No'==$row_update['radicacion_legal']) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<?php 
if ('Desistido'==$row_update['estado'] or 'Negado'==$row_update['estado']) { ?>
<input type="text" class="form-control" readonly name="radicacion_legal_update" value="<?php echo $row_update['radicacion_legal']; ?>"  >
<?php 	
} else {
	?>

<select  class="form-control" name="radicacion_legal_update" required>
<option <?php if ('Si'==$row_update['radicacion_legal']) {echo 'selected'; } else {} ?>>Si</option>
<option <?php if ('No'==$row_update['radicacion_legal']) {echo 'selected'; } else {} ?>>No</option>
</select>
<?php } ?>
</div>

<?php } else { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<input type="text" class="form-control" readonly name="radicacion_legal_update" value="<?php echo $row_update['radicacion_legal']; ?>"  >
</div>
<?php } */ ?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<select  class="form-control" name="radicacion_legal_update" required>
<option <?php if ('Si'==$row_update['radicacion_legal']) {echo 'selected'; } else {} ?>>Si</option>
<option <?php if ('No'==$row_update['radicacion_legal']) {echo 'selected'; } else {} ?>>No</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION:</label> 
<input type="date" class="form-control" readonly name="fecha_radicacion_curaduria///////////" value="<?php echo $row_update['fecha_radicacion_curaduria']; ?>" required>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  FECHA CAMBIO A LEGAL Y DEBIDA FORMA:</label> 
<input  type="date" class="form-control" name="fecha_cambio_legal" value="<?php if (isset($row_update['fecha_cambio_legal']) && 'Si'==$row_update['radicacion_legal']) { echo $row_update['fecha_cambio_legal']; } else { echo ''; } ?>" >
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTADO:</label> 
<select class="form-control"  name="estado_r" required  >
<option <?php if ('Radicado'==$row_update['estado']) {echo 'selected'; } else {} ?>>Radicado</option>
<option <?php if ('Aprobado'==$row_update['estado']) {echo 'selected'; } else {} ?>>Aprobado</option>
<option <?php if ('Desistido'==$row_update['estado']) {echo 'selected'; } else {} ?>>Desistido</option>
<option <?php if ('Negado'==$row_update['estado']) {echo 'selected'; } else {} ?>>Negado</option>
<option <?php if ('Suspendido'==$row_update['estado']) {echo 'selected'; } else {} ?>>Suspendido</option>
<option <?php if ('Anulado'==$row_update['estado']) {echo 'selected'; } else {} ?>>Anulado</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  FECHA CAMBIO DE ESTADO:</label> 
<input  type="date" class="form-control" name="fecha_cambio_estadoc" value="<?php echo $row_update['fecha_cambio_estado']; ?>" >
</div>



<div class="form-group text-left"> 
<label  class="control-label">CÉDULA DEL TITULAR DE LA LICENCIA (Para varias separar con ,):</label> 
<input type="text" class="form-control" name="cedulas2" value="<?php echo $row_update['cedulas']; ?>" required>

</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MATRICULA INMOBILIARIA (Para varias separar con ,):</label> 
<input  type="text"  class="form-control" name="matriculas2" value="<?php echo $row_update['matriculas']; ?>" required>
</div>



<?php 
if (1==$_SESSION['rol'] or 3184==$_SESSION['snr']) {
	?>
<div class="form-group text-left"> 
<label  class="control-label"> PRESENTA FOTOGRAFIA DE LA VALLA:</label> 
<input  type="date"  class="form-control" name="fotovalla" value="<?php echo $row_update['fotovalla']; ?>" >
</div>

<div class="form-group text-left"> 
<label  class="control-label"> NOTIFICACIÓN A VECINOS COLINDANTES:</label> 
<select  class="form-control" name="notivecinos" >
<option><?php echo $row_update['notivecinos']; ?></option>
<option>Si</option>
<option>No aplica</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> FECHA DE NOTIFICACIÓN A VECINOS COLINDANTES:</label> 
<input  type="date"  class="form-control" name="fechanotivecinos" value="<?php echo $row_update['fechanotivecinos']; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"> ACTA DE OBSERVACIONES:</label> 
<select  class="form-control" name="actaobserva" >
<option><?php echo $row_update['actaobserva']; ?></option>
<option>Si</option>
<option>No</option>
<option>No aplica</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> FECHA COMUNICACIÓN DEL ACTA DE OBSERVACIONES:</label> 
<input type="date"  class="form-control" name="fechaactaobserva" value="<?php echo $row_update['fechaactaobserva']; ?>" >
</div>

<div class="form-group text-left"> 
<label  class="control-label">TIENE RESPUESTA DEL ACTA DE OBSERVACIONES:</label> 
<select  class="form-control" name="respuestaobserva">
<option><?php echo $row_update['respuestaobserva']; ?></option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">ACTA DE VIABILIDAD (ARTÍCULO 2,2,6,1,2,3,1):</label> 
<select  class="form-control" name="actaviabilidad" >
<option><?php echo $row_update['actaviabilidad']; ?></option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> FECHA DE LA COMUNICACIÓN DEL ACTA DE VIABILIDAD:</label> 
<input type="date"  class="form-control" name="fechaactaviabilidad" value="<?php echo $row_update['fechaactaviabilidad']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label"> ALLEGA PAGOS:</label> 
<select  class="form-control" name="pagos" >
<option><?php echo $row_update['pagos']; ?></option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">EXPEDICIÓN DEL ACTO ADMINISTRATIVO:</label> 
<select  class="form-control" name="expeactoadmin" >
<option><?php echo $row_update['expeactoadmin']; ?></option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> NOTIFICACIÓN DEL ACTO ADMINISTRATIVO:</label> 
<select  class="form-control" name="notiactoadmin">
<option><?php echo $row_update['notiactoadmin']; ?></option>
<option>Si</option>
<option>No</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"> RECURSOS:</label> 
<select  class="form-control" name="recurso" >
<option><?php echo $row_update['recurso']; ?></option>
<option>Confirma Reposición</option>
<option>Revoca Reposición</option>
<option>Confirma Apelación</option>
<option>Revoca Apelación</option>
<option>No aplica</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA DE PRESENTACIÓN DEL RECURSO:</label> 
<input  type="date"  class="form-control" name="fechapresrecurso" value="<?php echo $row_update['fechapresrecurso']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA QUE RESUELVE EL RECURSO DE REPOSICIÓN:</label> 
<input type="date"  class="form-control" name="fecharecursorepo" value="<?php echo $row_update['fecharecursorepo']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA QUE RESUELVE EL RECURSO DE APELACIÓN:</label> 
<input type="date"  class="form-control" name="fecharecursoape" value="<?php echo $row_update['fecharecursoape']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA QUE RESUELVE EL RECURSO DE APELACIÓN:</label> 
<input  type="date"  class="form-control" name="fecharesrecursoape" value="<?php echo $row_update['fecharesrecursoape']; ?>">
</div>


<?php } else {} ?>



<div class="form-group text-left"> 
<label  class="control-label">OBSERVACIONES:</label> 

<textarea  class="form-control" name="nombre_radicacion_curaduria" >
<?php echo $row_update['nombre_radicacion_curaduria']; ?></textarea>

</div> 


<div class="form-group text-left"> 
<label  class="control-label">FORMULARIO UNICO NACIONAL O DOCUMENTO DE SOLICITUD:</label> 

<a href="filesnr/radicacion_curaduria/<?php echo $row_update['url']; ?>" target="_blank">Formato</a>

</div>


<div class="modal-footer">
<input type="hidden"  name="id_radicacion_curaduria"  value="<?php  echo $row_update['id_radicacion_curaduria']; ?>">
<input type="hidden"  name="id_radicado"  value="<?php  echo $row_update['id_radicacion_curaduria']; ?>">
<button type="submit" class="btn btn-success" title="<?php echo $idradicadogg; ?>">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>

</form>

<br><br>
      </div>



<?php 

mysql_free_result($row_update);
} else { }
} else { }

?>



