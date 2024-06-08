<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$ed=$_POST['option'];
require_once('../conf.php'); 

?>
 

<div style="padding: 10px 10px 10px 10px">
    
<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 20000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 20000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
  
}
</script>
    
<form action="" method="POST" name="for54364563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de documento:</label> 
<select class="form-control" name="nombre_notificacion_aviso_doc"  required>
<option></option>
<option>Formato de notificación por aviso</option>
<option>Decisión que se notifica</option>
<option>Resolución reanudando término</option>
<option>Auto aclaratorio</option>
<option>Acto administrativo</option>
<option>Por estado</option>
<option title="Este documento se carga una vez transcurridos cinco (5) días.">Constancia de fijación y desfijación</option>

</select>
</div>


<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> Documento PDF:</label> 
<input type="file" name="file" id="file" title="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Inferior a 20 Mg</span>
<div id="imagePreview"></div>
</div>
<div class="modal-footer">
<input type="hidden" name="id_notificacion_aviso" value="<?php echo $ed; ?>" required>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Cargar </button>
</div>

</form>

<?php
$query = sprintf("SELECT * FROM notificacion_aviso_doc where id_notificacion_aviso=".$ed." and estado_notificacion_aviso_doc=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<ol>';
do {
	$id_doc=$row['id_notificacion_aviso_doc'];
	echo '<li>'.$row['nombre_notificacion_aviso_doc'].' - <a href="files/portal/notificacion/'.$row['url'].'" target="_blank">Ver</a>';
	//echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="notificacion_aviso_doc" id="'.$id_doc.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	
	echo '</li>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 echo '<ol>';
} else {}	 
mysql_free_result($select);
?>

<br><br>
      </div>



<?php } else { }?>



