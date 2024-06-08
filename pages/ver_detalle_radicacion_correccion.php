<?php
session_start();

if (107==$_SESSION['permiso107'] OR 1==$_SESSION['rol']) {
	
	
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=intval($_POST['option']);

require_once('../conf.php'); 


$query_update = "SELECT * FROM radicacion_curaduria, objeto_lic_curaduria where radicacion_curaduria.id_objeto_lic_curaduria=objeto_lic_curaduria.id_objeto_lic_curaduria and id_radicacion_curaduria = ".$id."  limit 1";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54432342344234543244353543243244r65464563m1" enctype="multipart/form-data">
<input  type="hidden" name="correccionrad" value="321" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN:</label> 
<?php echo $row_update['codigo_curaduria'];  ?>
<input  class="form-control numero" maxlength="4" name="numero_radicacion_curaduriac" value="<?php echo $row_update['numero_radicacion_curaduria']; ?>" 
 required>
</div>


<div class="form-group text-left"> 
<label  class="control-label">OBJETO DEL TRAMITE:</label> 

<select  class="form-control" name="id_objeto_lic_curaduria2" required>
	<?php
$actualizar5 = mysql_query("SELECT * FROM objeto_lic_curaduria WHERE estado_objeto_lic_curaduria=1 order by id_objeto_lic_curaduria", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
   echo '<option value="'.$row15['id_objeto_lic_curaduria'].'" ';
   if ($row_update['id_objeto_lic_curaduria']==$row15['id_objeto_lic_curaduria']) { echo 'selected'; } else {} 
   echo '>'.$row15['nombre_objeto_lic_curaduria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>
</select>

</div>


<div class="form-group text-left"> 
<label  class="control-label">OTRAS ACTUACIONES:</label> 
<select  class="form-control" name="actuacion2" required>

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



<div class="form-group text-left"> 
<label  class="control-label">Fecha radicación:</label> 
<input  type="date" class="form-control" name="fecha_radicacion_curaduriac" value="<?php echo $row_update['fecha_radicacion_curaduria']; ?>" 
 required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<select  class="form-control" name="radicacion_legal_updateadmin" required>
<option <?php if ('Si'==$row_update['radicacion_legal']) {echo 'selected'; } else {} ?>>Si</option>
<option <?php if ('No'==$row_update['radicacion_legal']) {echo 'selected'; } else {} ?>>No</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Fecha en legal y forma:</label> 
<input  type="date" class="form-control" name="fecha_cambio_legalc" value="<?php echo $row_update['fecha_cambio_legal']; ?>" >
</div>












<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Estado:</label> 
<select class="form-control"  name="estadoccc" required  >
<option <?php if ('Radicado'==$row_update['estado']) {echo 'selected'; } else {} ?>>Radicado</option>
<option <?php if ('Aprobado'==$row_update['estado']) {echo 'selected'; } else {} ?>>Aprobado</option>
<option <?php if ('Desistido'==$row_update['estado']) {echo 'selected'; } else {} ?>>Desistido</option>
<option <?php if ('Negado'==$row_update['estado']) { echo 'selected'; } else {} ?>>Negado</option>
<option <?php if ('Suspendido'==$row_update['estado']) {echo 'selected'; } else {} ?>>Suspendido</option>
<option <?php if ('Anulado'==$row_update['estado']) { echo 'selected'; } else {} ?>>Anulado</option>
</select>

</div>



<div class="form-group text-left"> 
<label  class="control-label">Fecha cambio de estado:</label> 
<input  type="date" class="form-control" name="fecha_cambio_estadoc" value="<?php echo $row_update['fecha_cambio_estado']; ?>" >
</div>



<div class="form-group text-left"> 
<label  class="control-label">Para Suspensión / fecha inicial:</label> 
<input type="date" class="form-control" name="fecha_ini_suspension" value="<?php echo $row_update['fecha_ini_suspension']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">Para Suspensión / fecha final:</label> 
<input type="date" class="form-control" name="fecha_fin_suspension" value="<?php echo $row_update['fecha_fin_suspension']; ?>" >
</div>






<div class="form-group text-left"> 
<label  class="control-label">Matriculas:</label> 
<input  type="text" class="form-control" name="matriculasc" value="<?php echo $row_update['matriculas']; ?>" >
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CORRECCIÓN:</label> 
<textarea  class="form-control" name="desc_correccion" maxlength="250" required><?php echo $row_update['desc_correccion']; ?></textarea>
</div>



<div class="form-group text-left"> 
<label  class="control-label">FORMULARIO UNICO NACIONAL O DOCUMENTO DE SOLICITUD:</label> 
<?php 
$nombre_filer = '../filesnr/radicacion_curaduria/'.$row_update['url'];
if (1<filesize($nombre_filer) and isset($row_update['url']) and ""!=$row_update['url']) {
echo '<a href="filesnr/radicacion_curaduria/'.$row_update['url'].'" target="_blank"><img src="images/pdf.png">Formulario actual</a>';
} else { 
 }
 ?>

<input  type="hidden" name="correcciones" value="<?php echo $row_update['correcciones']; ?>" >
<?php 

$nombre_filer2 = '../filesnr/radicacion_curaduria/'.$row_update['url_correccion'];
if (1<filesize($nombre_filer2) and isset($row_update['url_correccion']) and ""!=$row_update['url_correccion']) {
echo '<br><br><a href="filesnr/radicacion_curaduria/'.$row_update['url_correccion'].'" target="_blank"><img src="images/pdf.png">Corrección</a>';
} else { 
 }
 
 if (isset($row_update['correcciones'])) {
	 $cats=explode('/', $row_update['correcciones']);
	 
	 foreach($cats as $cat) {
    $cat = trim($cat);
    echo  '<a href="filesnr/radicacion_curaduria/'.$cat.'">Adjunto</a><br>';
}
	 
 } else {}
 ?>
 

<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
	
	
	var fsize = 15000;
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
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}
</script>


<br>
<label  class="control-label">ADJUNTAR CORRECCIÓN:</label> 
<input type="file" name="file" id="file"  onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 15 Mg</span>
<div id="imagePreview"></div>
</div>






<div class="modal-footer">
<input type="hidden"  name="id_radicacion_curaduria_correccion"  value="<?php  echo $row_update['id_radicacion_curaduria']; ?>">
<input type="hidden"  name="id_radicado"  value="<?php  echo $row_update['id_radicacion_curaduria']; ?>">

<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>

<br><br>
      </div>



<?php 
} else {}
mysql_free_result($update);
} else { }

 } else {}?>




