<?php

$nump118=privilegios(118,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump118) {

/*$directoryftp="files/estados_contables/";
mkdir($directoryftp, 0777);
chmod($directoryftp, 0777);
*/

function sintildes($valor){

	return $valor;
}



if ((isset($_POST["name_file"])) && ($_POST["name_file"] != "")) {

$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'jpg', 'png');


$directoryftp="files/portal/intranet/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'portal-'.$_POST["name_file"];

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

$files2 = $ruta_archivo.'.'.$extension;
$query = sprintf("SELECT count(id_archivo_portal) as tot FROM archivo_portal where nombre_archivo_portal='$files2' and estado_archivo_portal=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
if (0<$row['tot']) {
echo '<script type="text/javascript">swal(" ERROR!", " El nombre del archivo ya se encuentra registrado !", "error"); </script>';
} else {


if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  

$insertSQL = sprintf("INSERT INTO archivo_portal (tipo_archivo_portal, id_contenido, fecha_archivo_portal, nombre_archivo_portal, 
estado_archivo_portal) 
VALUES (%s, %s, now(), %s, %s)", 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST['tipo_archivo'], "int"), 
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
		
		
		
		
}
mysql_free_result($select);

		
	
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
              <h3><?php echo existencia('archivo_portal'); ?></h3>

              <p>Cantidad de links</p>
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
			<?php
			/*
			function token($iduser) {
    // $url='http://localhost:81'; // local http://testportal.supernotariado.gov.co/
    $url='http://testportal.supernotariado.gov.co'; // prod
    // $url='http://test.digitalizacionnotarial.gov.co'; // test

    $llave = '6d9347298ec49cbace225072fcefdb0d';
    $cabecera = ['typ' => 'JWT', 'alg' => 'HS256'];
    $cabecera = json_encode($cabecera);
    $cabecera = base64_encode($cabecera);
    $data = ['id_funcionario' => '5572','correo'=>'sisg@supernotariado.gov.co'];
    $data = json_encode($data);
    $data = base64_encode($data);
    $firma = hash_hmac('sha256', '$cabecera.$data', $llave);
    $token = $cabecera.$data.$firma;

   $final= '<form action="'.$url.'/virtual_lg.php" method="post" target="_blank">
            <input type="hidden" name="token" value="'.$token.'" />
            <input type="submit" value="Info" class="small-box-footer" >
            </form>'; 
return $final;				
}
echo token('630010003');
*/
			?>
          <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>
 <?php echo existencialimitada('archivo_portal', 'tipo_archivo_portal', 1) ?></h3>
			 
              <p>Links antiguos</p>
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
       <?php echo existencialimitada('archivo_portal', 'tipo_archivo_portal', 0) ?>
			 </h3>
              <p>Links nuevos</p>
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
<?php  if (1==$_SESSION['rol'] or 0<$nump118) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
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
 <th>Fecha Carga</th>
 <th>Tipo</th>
<th>URL</th>
<th></th>
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
 

$query4="SELECT * from archivo_portal, contenido_publicacion where estado_archivo_portal=1 ".$infop." and id_contenido in (58, 59, 60, 61) and archivo_portal.id_contenido=contenido_publicacion.id_contenido_publicacion ORDER BY id_archivo_portal desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_archivo_portal'];

echo '<td>'.$row['fecha_archivo_portal'].'</td>';


echo '<td>'.$row['nombre_contenido_publicacion'].'</td>';
	echo '<td><a href="https://servicios.supernotariado.gov.co/files/portal/intranet/'.$row['nombre_archivo_portal'].'" target="_blank">https://servicios.supernotariado.gov.co/files/portal/intranet/'.$row['nombre_archivo_portal'].'</a></td>';
	echo '<td><a href="https://servicios.supernotariado.gov.co/files/portal/intranet/'.$row['nombre_archivo_portal'].'" target="_blank"><img src="images/pdf.png"></a></td>';



echo '<td>';
	if (1==$_SESSION['rol'] or 0<$nump118) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="archivo_portal" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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


<?php if (1==$_SESSION['rol'] or 0<$nump118) { ?>





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
	
	var fsize = 15000;
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
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
  
}
</script>
    
<form action="" method="POST" name="for5435353454r65464563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DEL ARCHIVO:</label> 
<input type="text" class="form-control sololetras" name="name_file" placeholder="En lugar de espacio: _" >
</div>


<div class="form-group text-left"> 
<label  class="control-label">TIPO DE ARCHIVO:</label> 
<select class="form-control " name="tipo_archivo" >
<option value="" selected></option>
<option value="58">Manuales</option>
<option value="59">Papeleria</option>
<option value="60">Noticias</option>
<option value="61">Directorio</option>
</select>
</div>




<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO (PDF, EXCEL, WORD, IMAGEN):</label> 
<input type="file" name="file" id="file" title="" value="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Inferior a 15 Mg</span>
<a href="https://smallpdf.com/es/comprimir-pdf" style="color:#B40404;" target="_blank">Comprimir</a>
<!--<div id="imagePreview"></div>-->
</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="estado_contable">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php } else { }?>



