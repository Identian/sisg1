<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	//echo $_POST['option'];
	require_once('../conf.php'); 
	require_once('listas.php');
	$nump62=privilegios(62,$_SESSION['snr']);
	
$info=explode('-', $_POST['option']);
$idbe=intval($info[0]);
$doc=intval($info[1]);


	
$query = sprintf("SELECT * FROM beneficio_notaria, notaria where id_beneficio_notaria=".$idbe." and beneficio_notaria.id_notaria=notaria.id_notaria and estado_beneficio_notaria=1 limit 1");
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
?>

<script>
/*
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
        fileInput.value = '';
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
}
*/
</script>
<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 8000;
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
	alert('Debe ser inferior a 8000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div style="padding:10px 10px 10px 10px">
<form action="" method="POST" name="form1" enctype="multipart/form-data">
<div class="form-group text-left"> 
<label  class="control-label">NOTARIA:</label> 
<?php echo $row['nombre_notaria']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Mes:</label> 
<?php echo $row['mes_beneficio'];  ?>
</div>

<div class="form-group text-left"> 
El archivo debe ser en formato PDF y ser menor a 8 Mb.
</div>





<?php  if (9==$doc) { ?>
<input type="hidden" name="doc" value="9">
<div class="form-group text-left"> 
<label  class="control-label">Anexar el certificado proferido por el contador público de la Notaría, mediante el cual se dé cuenta del pago de nómina realizado a los empleados del despacho notarial, en el mes inmediatamente anterior a aquel sobre el cual se busca el reconocimiento del apoyo económico estipulado en el Decreto Ley 805 de 2020
:</label> 
<input type="file" title="Solo PDF" id="file" onchange="return fileValidation()" required class="form-control" name="file"  >
</div>




<?php } else { } ?>

<div class="modal-footer">
<div id="imagePreview"></div>
<input type="hidden" name="idb" value="<?php echo $row['id_beneficio_notaria']; ?>">
<?php if (isset($row['id_analista']) && ""!=$row['id_analista']) { ?>
<input type="hidden" name="analistasnr" value="1">
<?php } else { ?>
<input type="hidden" name="analistasnr" value="0">
<?php } ?>
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" id="envio">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div></form>
</div>
<?php
mysql_free_result($select);
} else {}
?>