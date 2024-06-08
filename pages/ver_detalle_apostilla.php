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
	
	
	var fsize = 10000;
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
	alert('Debe ser inferior a 10000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}
</script>

    
<form action="" method="POST" name="for54364563m1" enctype="multipart/form-data" >
<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span><B> DOCUMENTO DESCARGADO PREVIAMENTE CON FIRMA DIGITAL <span class="fa fa-file-pdf-o" style="color:red"></span>:</B></label> 
<br><span style="color:#B40404;">Recuerde que la firma digital debe ser del Notario que creo el mismo registro de Apostilla.</span><br><br>
<input type="file" name="file" id="file" title="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">PDF Inferior a 10 Mg</span>
<div id="imagePreview"></div>
</div>
<div class="modal-footer">
<input type="hidden" name="id_apostilla_firmada" value="<?php echo $ed; ?>" required>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Cargar </button>
</div>

</form>

<br><br>
      </div>



<?php } else { }?>



