<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$ed=$_POST['option'];
require_once('../conf.php'); 

?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script>

 $(document).ready(function(){

 
			
				$('.borrar_f').on('click', function () {
				 var opcion = confirm('¿Estas seguro de eliminar el registro?');		 
				 var may =this.id;
				 var mayk =this.name;
	
		        if(opcion == true) {

                 document.getElementById("borrarregistro").value=may;
				 document.getElementById("borrardetabla").value=mayk;				 
				 
                 document.forms["formulario_borrar"].submit();
            	 } else {
		         return false;
	             }
	            });	
				
				})
 </script>
 
 
 <form method="POST" action="" name="formulario_borrar">
<input type="hidden" name="borrarregistro" id="borrarregistro" value="">
<input type="hidden" name="borrardetabla" id="borrardetabla" value="">
</form>


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
	alert('Debe ser inferior a 10000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
  
}
</script>
    
<form action="" method="POST" name="for56545644364563m1" enctype="multipart/form-data" >

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL DOCUMENTO DE SOPORTE:</label> 
<input type="text"  class="form-control" name="nombre_soporte_posesion_notaria"  required >
</div>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO DE SOPORTE:</label> 
<input type="file" name="file" id="file" title="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">PDF Inferior a 10 Mg</span>
<div id="imagePreview"></div>
</div>
<div class="modal-footer">
<input type="hidden" name="id_posesion_notaria" value="<?php echo $ed; ?>" required>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Cargar </button>
</div>

</form>

<br><br>




<?php
$query = sprintf("SELECT * FROM soporte_posesion_notaria where id_posesion_notaria=".$ed." and  estado_soporte_posesion_notaria=1 order by id_soporte_posesion_notaria"); 

$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){
echo 'Documentos ('.$totalRows.') :<br><ul>';
do {

	echo '<li><a href="filesnr/soporteposesion/'.$row['url_soporte'].'" target="_blank">'.$row['nombre_soporte_posesion_notaria'].'</a>';
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="soporte_posesion_notaria" id="'.$row['id_soporte_posesion_notaria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

	echo '</li>';

	 } while ($row = mysql_fetch_assoc($select)); 
echo '</ul>';
} else {}	 

mysql_free_result($select);

?>


      </div>



<?php } else { }?>



