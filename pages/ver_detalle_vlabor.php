<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
require_once('../conf.php'); 
session_start();

$id=intval($_POST['option']);


$query235 = "SELECT cedula_funcionario, nombre_funcionario  FROM funcionario, vlabor WHERE funcionario.id_funcionario=vlabor.id_funcionario and id_vlabor=".$id." limit 1";
$result235 = mysql_query($query235);	
 $row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
	$cedulaa=$row['cedula_funcionario'];
	$namefun=$row['nombre_funcionario'];



 ?>
<div style="padding: 10px 10px 10px 10px">
<?php echo $namefun; ?>
<br>

<form action="" method="post" name="ewr43ewrew435435r3243244353455435ewr" enctype="multipart/form-data">
<br>

<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 15000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension pdf');
        fileInput.value = '';
        return false;
		
		
    }else{
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO EN PDF: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>

<div id="imagePreview"></div>
</div>

<div class="modal-footer">
<button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-ok"></span> Agregar</button>
<input type="hidden" name="idvlabor" value="<?php echo $id; ?>">
</form>

</div>
<?php

	} else { }
mysql_free_result($result235);


} else {}
?>


