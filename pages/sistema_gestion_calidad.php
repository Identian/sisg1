<?php
$nump77=privilegios(77,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) {

/*$directoryftp="files/estados_contables/";
mkdir($directoryftp, 0777);
chmod($directoryftp, 0777);
*/


if ((isset($_POST["nombre_proceso"])) && ($_POST["nombre_proceso"] != "") && (1==$_SESSION['rol'] OR 0<$nump77)) {


$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'jpg');


$directoryftp="files/portal/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'sgc-'.$_SESSION['snr'].'-'.date("YmdGis");

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
  

$insertSQL = sprintf("INSERT INTO sistemagc (macroproceso, nombre_macroproceso, nombre_proceso, 
nombre_procedimiento, sistema_gestion, tipo_documento, codigo_documento, fecha_documento, 
version, nombre_sistemagc, url, fecha_publicacion, estado_sistemagc) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($_POST["macroproceso"], "text"), 
GetSQLValueString($_POST["nombre_macroproceso"], "text"), 
GetSQLValueString($_POST["nombre_proceso"], "text"), 
GetSQLValueString($_POST["nombre_procedimiento"], "text"), 
GetSQLValueString($_POST["sistema_gestion"], "text"), 
GetSQLValueString($_POST["tipo_documento"], "text"), 
GetSQLValueString($_POST["codigo_documento"], "text"), 
GetSQLValueString($_POST["fecha_documento"], "date"), 
GetSQLValueString($_POST["version"], "text"), 
GetSQLValueString($_POST["nombre_sistemagc"], "text"), 
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

 
 function listap($table) {
global $mysqli;
$query = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  estado_".$table."=1 order by id_".$table." ASC ";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
	//$infoid='id_'.$table;
	$infonombre='nombre_'.$table;
	
        printf ('<option>%s</option>', $obj[$infonombre]);
    }

$result->free();

}


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('sistemagc'); ?></h3>

              <p>Cantidad de registros</p>
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
 <?php  echo existenciaunica('sistemagc', 'fecha_publicacion', $realdate) ?></h3>
			 
              <p>Documentos registrados hoy</p>
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
              <h3><?php echo existencia('macroproceso'); ?></h3>
              <p>Macroprocesos</p>
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
<?php  if (1==$_SESSION['rol'] or 0<$nump77) { ?>
  
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
				  <th>Tipo Macroproceso</th>
				  <th>Nombre Macroproceso</th>
				  <th>Proceso</th>
				  <th>Procedimiento</th>
				  <th>Sistema de gestión</th>
				  <th>Tipo de documento</th>
				  <th>Nombre</th>
				
<th style="width:35px;"></th>	  
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
 

$query4="SELECT * from sistemagc where estado_sistemagc=1 ".$infop." ORDER BY fecha_publicacion desc ";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_sistemagc'];
echo '<td>'.$row['macroproceso'].'</td>';
echo '<td>'.$row['nombre_macroproceso'].'</td>';
echo '<td>'.$row['nombre_proceso'].'</td>';
echo '<td>'.$row['nombre_procedimiento'].'</td>';
echo '<td>'.$row['sistema_gestion'].'</td>';
echo '<td>'.$row['tipo_documento'].'</td>';
echo '<td>'.$row['nombre_sistemagc'].'</td>';
echo '<td>';
echo ' <a href="files/portal/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';

	if (1==$_SESSION['rol'] or 0<$nump77) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="sistemagc" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
						"aaSorting": [[ 1, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol'] or 0<$nump77) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">SISTEMA DE GESTIÓN DE CALIDAD</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for5435353454r65464563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE MACROPROCESO:</label> 
<select name="macroproceso" class="form-control" required>
<option value="" selected></option>
<?php echo listap('tipo_macroproceso'); ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DE MACROPROCESO:</label> 
<select class="form-control" name="nombre_macroproceso"  required>
<option selected></option>
<?php echo listap('macroproceso'); ?>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL PROCESO:</label> 
<!--<input type="text" class="form-control" name="nombre_proceso"  required>-->
<select name="nombre_proceso" class="form-control" required>
<option value="" selected></option>
<?php echo listap('proceso'); ?>
</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL PROCEDIMIENTO:</label> 
<select class="form-control" name="nombre_procedimiento"  required>
<option value="" selected></option>
<?php echo listap('procedimiento'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SISTEMA DE GESTION:</label> 
<select name="sistema_gestion" class="form-control" required>
<option value="" selected></option>
<?php echo listap('sistema_gestion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label> 
<select name="tipo_documento" class="form-control" required>
<option value="" selected></option>
<?php echo listap('tipo_vrsdocumento'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CODIGO DEL DOCUMENTO:</label> 
<input type="text" class="form-control" name="codigo_documento"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DEL DOCUMENTO:</label> 
<input type="text" class="form-control" name="nombre_sistemagc"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DEL DOCUMENTO:</label> 
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_documento"   >
</div>
<div class="form-group text-left"> 
<label  class="control-label">VERSION:</label> 
<input type="text" class="form-control" name="version"  >
</div>



<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 10000;
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
	alert('Debe ser inferior a 10000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO (PDF, EXCEL, WORD):</label> 
<input type="file" name="file" id="file" title="" value="" required>
<span style="color:#B40404;font-size:13px;">Inferior a 10 Mg</span>
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


<?php } else { }


} else {} ?>



