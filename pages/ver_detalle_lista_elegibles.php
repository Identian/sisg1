<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
require_once('../conf.php'); 
session_start();



 $id=intval($_POST['option']);


$query235 = "SELECT * FROM elegible_curaduria WHERE id_elegible_curaduria=".$id." and estado_elegible_curaduria=1 limit 1";
$result235 = mysql_query($query235);	
 $row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
 ?>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script>
      $(document).ready(function(){



 	 $('#tiporesultadoelegible').change(function() {
        var martcortc=document.getElementById("tiporesultadoelegible").value;
		 if ('Desistimiento'==martcortc) {	
        $('#filetiporesultado').removeAttr( 'style' );
		  } else {
		 $('#filetiporesultado').attr( 'style','display:none;' );
		  }
    });
	
	 })
 </script>
<div style="padding: 10px 10px 10px 10px">

<br>

<form action="" method="post" name="ewr43e353455435ewr" enctype="multipart/form-data">

<input type="hidden" name="id_elegible_curaduriatt" value="<?php echo $row['id_elegible_curaduria']; ?>" >

<div class="form-group text-left"> 
<label  class="control-label">Cedula:</label> 
<input type="text" class="form-control numero" name="cedula" value="<?php echo $row['elegible']; ?>" >
</div>


<div class="form-group text-left"> 
<label  class="control-label">Tipo de resultado:</label> 
<select class="form-control " name="tipo" id="tiporesultadoelegible" value="<?php echo $row['tipo']; ?>">
<option selected><?php echo $row['tipo']; ?></option>
<option value="Posesión">Posesión</option>
<option value="Desistimiento">Desistimiento</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Porcentaje:</label> 
<input type="text" class="form-control" name="porcentaje" value="<?php echo $row['porcentaje']; ?>" >
</div>


<div class="form-group text-left"> 
<label  class="control-label">Convocatoria:</label> 
<input type="text" class="form-control " name="convocatoriat" value="<?php echo $row['convocatoria']; ?>" >
</div>



<div class="form-group text-left"> 
<label  class="control-label">Municipio:</label> 
<select class="form-control " name="municipio" >
<option selected><?php echo $row['municipio']; ?></option>
<option>Armenia</option>
<option>Barrancabermeja</option>
<option>Barranquilla</option>
<option>Bello</option>
<option>Bogotá</option>
<option>Bucaramanga</option>
<option>Buenaventura</option>
<option>Buga</option>
<option>Cúcuta</option>
<option>Cajicá;</option>
<option>Cali</option>
<option>Cartagena</option>
<option>Cartago</option>
<option>Cota</option>
<option>Dosquebradas</option>
<option>Duitama</option>
<option>Envigado</option>
<option>Floridablanca</option>
<option>Funza</option>
<option>Fusagasugá;</option>
<option>Girón</option>
<option>Ibagué</option>
<option>Itagui</option>
<option>Manizales</option>
<option>Medellín</option>
<option>Montería</option>
<option>Mosquera</option>
<option>Neiva</option>
<option>Palmira</option>
<option>Pasto</option>
<option>Pereira</option>
<option>Piedecuesta</option>
<option>Popayán</option>
<option>Puerto Colombia</option>
<option>Rionegro</option>
<option>Santa Marta</option>
<option>Sincelejo</option>
<option>Soacha</option>
<option>Sogamoso</option>
<option>Soledad</option>
<option>Tocancipá</option>
<option>Tuluá</option>
<option>Tunja</option>
<option>Valledupar</option>
<option>Villavicencio</option>
<option>Yopal</option>
<option>Yumbo</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label">Fecha de publicación:</label> 
<input type="text" class="form-control datepicker" name="fecha" value="<?php echo $row['fecha_publicacion']; ?>" >
</div>



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

<div class="form-group text-left" id="filetiporesultado" style="display:none;">
<label  class="control-label"><span style="color:#ff0000;">*</span> Acto de desistimiento: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" >
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>

<div id="imagePreview"></div>
</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="estado_contable">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>


</form>

</div>
<?php

	} else { }
mysql_free_result($result235);


} else {}
?>


