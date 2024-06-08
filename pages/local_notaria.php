<?php
$nump83=privilegios(83,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump83 && (isset($_GET['i']) && "" != $_GET['i'])) {
$id = $_GET['i'];

	
if ((isset($_POST["nombre_registro_foto_n"])) && ($_POST["nombre_registro_foto_n"] != "")) {

$tamano_archivo=1048576; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'jpg', 'png');


$directoryftp="filesnr/registro_foto_notaria/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'notaria-'.$_SESSION['snr'].'-'.$identi;

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
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  

$insertSQL = sprintf("INSERT INTO registro_foto_n (id_notaria, nombre_registro_foto_n, url, fecha_publicacion, 
estado_registro_foto_n) 
VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['nombre_registro_foto_n'], "text"), 
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

 
 

}
?>
 
 


<?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>	 

	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or 0<$nump83) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   
	   Registro de información del local
	<!--
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="mes">Mes</option>
<option value="ano">Año</option>
<option value="nombre_tipo_estado_contable">Tipo de estado contable</option>
		  </select>
</div>
<div class="input-group-btn">
<input type="text" name="buscar" placeholder="" class="form-control" required ></div>
   
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>-->


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">
<th>Fecha</th>
<th>Tipo</th>
<th>Imagen</th>
<th style=""></th>	  
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
 

$query4="SELECT * from registro_foto_n where estado_registro_foto_n=1 ".$infop." ORDER BY id_registro_foto_n desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_registro_foto_n'];
echo '<td>'.$row['fecha_publicacion'].'</td>';
echo '<td>'.$row['nombre_registro_foto_n'].'</td>';

	echo '<td><a href="filesnr/registro_foto_notaria/'.$row['url'].'" target="_blank"><span class="fa fa-file"></span></td>';
echo '<td>';
	if (1==$_SESSION['rol'] or 0<$nump83) { 
	
	//echo '<a href="" class="buscar_banner" id="'.$id_res.'" data-toggle="modal" data-target="#popupcorrespondencia"><span class="fa fa-edit"></span></a> ';
	
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="registro_foto_n" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
									//'excelHtml5'
									
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


<?php if (1==$_SESSION['rol'] or 0<$nump83) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO REGISTRO FOTOGRAFICO</h4>
      </div>
      <div class="modal-body">
    
<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.png)$/i;
	
	var fsize = 2000;
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
	alert('Debe ser inferior a 2000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
  
}
</script>
    
<form action="" method="POST" name="for543534345353454r65464563m1" enctype="multipart/form-data" >




<div class="form-group text-left"> 
<label  class="control-label">Registro:</label> 
<select class="form-control" name="nombre_registro_foto_n" required>
<option value="" selected></option>
<option>Resolución de cambio de local</option>
<option>Fachada</option>
<option>Dirección</option>
<option>Iluminación</option>
<option>Concepto de uso de suelo - curaduria</option>
<option>Acceso-discapacidad-rampa</option>
<option>Protocolo notarial</option>
<option>Sistemas de ventilación - aire acondicionado</option>
<option>Areas de desplazamiento</option>
<option>Baño al servicio al publico - con discapacidad</option>
<option>Ventanilla preferencial</option>
</select>
</div>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> Imagen (pdf, jpg, png):</label> 
<input type="file" name="file" id="file" title="" value="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Inferior a 2 Mg</span>
<!--<div id="imagePreview"></div>-->
</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Cargar </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>






<!--
<div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Configuración</label></h4>
</div> 
<div class="ver_banner" class="modal-body"> 





</div>
</div> 
</div> 
</div> 
-->


<?php } else { }?>



