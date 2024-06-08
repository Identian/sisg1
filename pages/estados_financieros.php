<?php
$nump73=privilegios(73,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump73) {

/*$directoryftp="files/estados_contables/";
mkdir($directoryftp, 0777);
chmod($directoryftp, 0777);
*/


if ((isset($_POST["table"])) && ($_POST["table"] == "estado_contable")) {

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/estados_contables/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'daf-'.$_SESSION['snr'].'-'.date("YmdGis");

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
  

$insertSQL = sprintf("INSERT INTO estado_contable (nombre_estado_contable, 
id_tipo_estado_contable, mes, ano, fecha_publicacion, url, estado_estado_contable) 
VALUES (%s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($_POST["nombre_estado_contable"], "text"), 
GetSQLValueString($_POST["id_tipo_estado_contable"], "int"), 
GetSQLValueString($_POST["mes"], "text"), 
GetSQLValueString($_POST["ano"], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;

  
  
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
              <h3><?php echo existencia('estado_contable'); ?></h3>

              <p>Cantidad de documentos</p>
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
 <?php echo existencialimitada('estado_contable', 'fecha_publicacion', $realdate) ?></h3>
			 
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
              <h3>3</h3>
              <p>Tipos de estados contables</p>
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
<?php  if (1==$_SESSION['rol'] or 0<$nump73) { ?>
  
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
				  <th>TIPO</th>
				  <th>PUBLICACIÓN</th>
				  <th>AÑO</th>
				  <th>MES</th>
				  <th>ASUNTO</th>
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
 

$query4="SELECT * from estado_contable, tipo_estado_contable where estado_contable.id_tipo_estado_contable=tipo_estado_contable.id_tipo_estado_contable and estado_estado_contable=1 ".$infop." ORDER BY fecha_publicacion desc ";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_estado_contable'];
echo '<td>'.$row['nombre_tipo_estado_contable'].'</td>';
echo '<td>'.$row['fecha_publicacion'].'</td>';
echo '<td>'.$row['ano'].'</td>';
echo '<td>'.$row['mes'].'</td>';
echo '<td>'.$row['nombre_estado_contable'].'</td>';
echo '<td>';
echo ' <a href="files/estados_contables/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';

	if (1==$_SESSION['rol'] or 0<$nump73) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="estado_contable" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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


<?php if (1==$_SESSION['rol'] or 0<$nump73) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo estado contable</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65464563m1" enctype="multipart/form-data" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO:</label> 
<select class="form-control" name="id_tipo_estado_contable"  required>
<option value="" selected></option>
<?php echo lista('tipo_estado_contable'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AÑO:</label> 
<input type="number" class="form-control numero" name="ano"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MES:</label> 
<select class="form-control" name="mes"  required>
<option value="" selected></option>
<option value="Enero">Enero</option>
<option value="Febrero">Febrero</option>
<option value="Marzo">Marzo</option>
<option value="Abril">Abril</option>
<option value="Mayo">Mayo</option>
<option value="Junio">Junio</option>
<option value="Julio">Julio</option>
<option value="Agosto">Agosto</option>
<option value="Septiembre">Septiembre</option>
<option value="Octubre">Octubre</option>
<option value="Noviembre">Noviembre</option>
<option value="Diciembre">Diciembre</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> ASUNTO:</label> 
<textarea class="form-control" name="nombre_estado_contable"></textarea>
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
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO PDF:</label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span>
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



