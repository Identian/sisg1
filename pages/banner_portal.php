<?php
$nump79=privilegios(79,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump79) {



if ((isset($_POST["publicado"])) && ($_POST["publicado"] != "")) { 

$query = sprintf("SELECT count(id_banner_portal) as totb FROM banner_portal where activo=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
if (0<$row['totb']){
$prin=0;
} else {
$prin=$_POST["activo"];
}	 
mysql_free_result($select);



$updateSQL = sprintf("UPDATE banner_portal SET 
orden=%s, publicado=%s, activo=%s, enlace=%s 
where id_banner_portal=%s",
GetSQLValueString($_POST["orden"], "int"), 
GetSQLValueString($_POST["publicado"], "int"), 
GetSQLValueString($prin, "int"), 
GetSQLValueString($_POST["enlace"], "text"), 
GetSQLValueString($_POST["banner"], "int"));

$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;
} else { }
	
	
	

if ((isset($_POST["enlace"])) && ($_POST["enlace"] != "")) {

$tamano_archivo=1048576; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('jpg', 'png');


$directoryftp="files/portal/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'banner-'.$identi;

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
  

$insertSQL = sprintf("INSERT INTO banner_portal (orden, nombre_banner_portal, enlace, publicado, activo, 
estado_banner_portal) 
VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST['orden'], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST['enlace'], "text"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(0, "int"), 
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
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php $totalb= existencia('banner_portal'); echo $totalb; ?></h3>

              <p>Cantidad de banners</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>
 <?php echo existencialimitada('banner_portal', 'publicado', 0) ?></h3>
			 
              <p>Publicados</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
			<h3>
       <?php echo existencialimitada('banner_portal', 'publicado', 1) ?>
			 </h3>
              <p>No publicado</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or 0<$nump79) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   <?php
	   $query = sprintf("SELECT count(id_banner_portal) as totb FROM banner_portal where activo=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
if (0<$row['totb']){
echo '';
} else {
echo '<b>IMPORTANTE! Falta banner principal.</b>';
}	 
mysql_free_result($select);
?>
	   
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
  <th>Orden</th>
    <th>Pub.</th>
 <th>Enlace</th>
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
 

$query4="SELECT * from banner_portal where estado_banner_portal=1 ".$infop." ORDER BY id_banner_portal desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_banner_portal'];
echo '<td>'.$row['orden'].'</td>';
echo '<td>';

if (1==$row['publicado']) {
	echo 'Si';
	
	if (1==$row['activo']) {
	echo ' <b>Principal</b>';
} else {
	echo '';
}

	
	
} else {
	echo 'No';
}
	
	echo '</td>';
	echo '<td>'.$row['enlace'].'</td>';
	echo '<td><a href="https://www.supernotariado.gov.co/files/portal/'.$row['nombre_banner_portal'].'" target="_blank"><span class="fa fa-file"></span></a></td>';
echo '<td>';
	if (1==$_SESSION['rol'] or 0<$nump79) { 
	
	echo '<a href="" class="buscar_banner" id="'.$id_res.'" data-toggle="modal" data-target="#popupcorrespondencia"><span class="fa fa-edit"></span></a> ';
	if (1==$row['activo']) { } else {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="banner_portal" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	}
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
									'excelHtml5'
									
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


<?php if (1==$_SESSION['rol'] or 0<$nump79) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">ARCHIVOS</h4>
      </div>
      <div class="modal-body">
    
<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.png)$/i;
	
	var fsize = 1000;
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
	alert('Debe ser inferior a 1000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
  
}
</script>
    
<form action="" method="POST" name="for5435345353454r65464563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label">Orden:</label> 
<input type="text" class="form-control" name="orden" value="" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Enlace:</label> 
<input type="text" class="form-control" name="enlace" placeholder="" required>
</div>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> BANNER (jpg, png):</label> 
<input type="file" name="file" id="file" title="" value="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Inferior a 1 Mg</span>
<!--<div id="imagePreview"></div>-->
</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>







<div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Configurar Banner</label></h4>
</div> 
<div class="ver_banner" class="modal-body"> 





</div>
</div> 
</div> 
</div> 


<?php } else { }?>



