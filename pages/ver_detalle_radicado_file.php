<?php
session_start();

if (isset($_POST['option']) and ""!=$_POST['option']) {
$idgg=intval($_POST['option']);

require_once('../conf.php'); 


$query_update = "SELECT * FROM radicacion_curaduria, objeto_lic_curaduria where radicacion_curaduria.id_objeto_lic_curaduria=objeto_lic_curaduria.id_objeto_lic_curaduria and id_radicacion_curaduria = ".$idgg." and estado_radicacion_curaduria=1 limit 1";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54432342344234543244353543243244r65464563m1" enctype="multipart/form-data">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN:</label> 

<input  class="form-control numero" maxlength="4" name="numero_completo" value="<?php echo $row_update['codigo_curaduria'].$row_update['numero_radicacion_curaduria']; ?>" 
readonly  required>
</div>





<div class="form-group text-left"> 
<label  class="control-label">OBJETO DEL TRAMITE:</label> 
<input type="text" class="form-control" value="<?php echo $row_update['nombre_objeto_lic_curaduria']; ?>" readonly required>  


</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OTRAS ACTUACIONES:</label> 
<input  class="form-control" name="actuacion2" value="<?php echo $row_update['actuacion']; ?>" 
readonly required>
</div>


<br>

<div class="form-group text-left"> 
<label  class="control-label">FORMULARIO UNICO NACIONAL O DOCUMENTO DE SOLICITUD:</label> 
<?php 
$nombre_filer = '../filesnr/radicacion_curaduria/'.$row_update['url'];
if (1<filesize($nombre_filer)) {
$tam=1;
} else { 
$tam=0;
 }

if (!isset($row_update['url']) or 0==$tam or 107==$_SESSION['permiso107'] OR 1==$_SESSION['rol']) { ?>
<br>
<?php 
if ((107==$_SESSION['permiso107'] OR 1==$_SESSION['rol']) && (1==1)) { ?>
Revisar: <a href="filesnr/radicacion_curaduria/<?php echo $row_update['url']; ?>" target="_blank"><img src="images/pdf.png">Formato actual</a>
<?php } else {}?>
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
<label  class="control-label"><span style="color:#ff0000;">*</span>ADJUNTAR:</label> 
<input type="file" name="file" id="file" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 15 Mg</span>
<div id="imagePreview"></div>
<?php } else { ?>

<a href="filesnr/radicacion_curaduria/<?php echo $row_update['url']; ?>" target="_blank"><img src="images/pdf.png">Formato actual</a>
<br><br>
<?php }  ?>

</div>


<div class="modal-footer">
<input type="hidden"  name="id_radicacion_curaduria_file"  value="<?php  echo $row_update['id_radicacion_curaduria']; ?>">
<input type="hidden"  name="id_radicado"  value="<?php  echo $row_update['id_radicacion_curaduria']; ?>">
<button type="submit" class="btn btn-success" title="<?php echo $idgg; ?>">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>

</form>

<br><br>
      </div>



<?php 
} else {}
mysql_free_result($update);
} else { }?>



