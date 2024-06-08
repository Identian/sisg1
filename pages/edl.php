<?php
$nump110=privilegios(110,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 

if (isset($_GET['i']) && (1==$_SESSION['rol'] or 0<$nump110)) { 
$idorip=$_GET['i'];
$funcionarioedl=$_GET['i']; 
 } else {
$idorip=0;  
$funcionarioedl=$_SESSION['snr'];
 } 


if ((isset($_POST["nota"])) && (""!=$_POST["nota"]) && 
(1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina'])) {
	
	

	
	
	if (1==$_SESSION['rol'] or 0<$nump110) { 

$queryt = sprintf("SELECT id_funcionario, id_vinculacion FROM funcionario where id_vinculacion in (2, 3, 4) and estado_funcionario=1 and id_funcionario=".$funcionarioedl.""); 
	} else {
	$queryt = sprintf("SELECT id_funcionario, id_vinculacion  FROM funcionario where id_vinculacion in (2, 3, 4) and estado_funcionario=1 and id_funcionario=".$funcionarioedl.""); 	
	}
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['id_funcionario']) {

	$vinculacion=$rowtt['id_vinculacion'];
	
$infop=explode("-", $_POST['periodo']);
	$ano_periodo=intval($infop[0]);
	$id_periodos_edl=intval($infop[1]);
	
	
	$query = sprintf("SELECT count(id_evaluacion_edl) as tevaluacion_edl FROM evaluacion_edl where ano=".$ano_periodo." and periodo=".$id_periodos_edl." and estado_evaluacion_edl=1 and id_funcionario=".$funcionarioedl.""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tevaluacion_edl']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene registros EDL en dicho periodo.</div>';
	
} else {
	
	

$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/edl/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'edl-'.$_SESSION['snr'].''.date("YmdGis");

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
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  

if (2023==$ano_periodo && 1==$id_periodos_edl) {
	
	
	
	 if (2==$vinculacion) {
$fecha_inicio="2023-01-01";
$fecha_final="2023-06-30";
 } else if (3==$vinculacion) {
$fecha_inicio="2023-02-01";
$fecha_final="2024-07-31";
 } else if (4==$vinculacion) {
$fecha_inicio="2023-02-01";
$fecha_final="2024-07-31";
 } else {}
 
 
 
} else if (2023==$ano_periodo && 2==$id_periodos_edl) {

 if (2==$vinculacion) {
$fecha_inicio="2023-07-01";
$fecha_final="2023-12-31";
 } else if (3==$vinculacion) {
$fecha_inicio="2023-08-01";
$fecha_final="2024-01-31";
 } else if (4==$vinculacion) {
$fecha_inicio="2023-08-01";
$fecha_final="2024-01-31";
 } else {}
 
} else {}
 
	

$insertSQL = sprintf("INSERT INTO evaluacion_edl (
ano, periodo, nombre_evaluacion_edl, id_funcionario, fecha_inicial, fecha_final, nota, fecha_evaluacion_edl, url, estado_evaluacion_edl) 
VALUES (%s, %s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($ano_periodo, "int"), 
GetSQLValueString($id_periodos_edl, "int"), 
GetSQLValueString($_POST["nombre_evaluacion_edl"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString($fecha_inicio, "date"),
GetSQLValueString($fecha_final, "date"),
GetSQLValueString($_POST["nota"], "text"),
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

} else {
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para funcionarios provisionales. Si identifica inconsistencias, reportarlo a sandram.gomez@supernotariado.gov.co para actualizar el perfil.</div>';	
} 




}
 else { }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('evaluacion_edl'); ?></h3>

              <p>Edl</p>
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
             
 <h3>5</h3>
			  
              <p>Regionales</p>
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
              <h3>195</h3>
              <p>Oficinas de registro</p>
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
  
  
  
  <div class="col-md-6">
<?php  


$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2024-03-05 07:00:00");
$fecha_limite = strtotime("2024-03-06 23:59:59");



//$os=array("1026250273", "1136882942", "51550312", "51628145", "52897377", "1016029559");


//if ((in_array($_SESSION['cedula_funcionario'], $os) && $fecha_actual<=$fecha_limite) or 1==$_SESSION['rol'] or 0<$nump110)
//if (1==$_SESSION['rol'] or 0<$nump110)
	// if (3>$_SESSION['snr_tipo_oficina']) 
			
if (($fecha_actual<=$fecha_limite && (2==$_SESSION['vinculacion'] or 4==$_SESSION['vinculacion'] or 3==$_SESSION['vinculacion'])) or 1==$_SESSION['rol'] or 0<$nump110) { //or 1==$_SESSION['rol'] or 0<$nump110

?>
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>

<?php } else { } ?>	
 Cargar el formato de calificación firmado por las partes en un solo documento PDF. 
 <a href="files/snrcirculares/circular-90-2023030881518.pdf" target="_blank">Circular</a> &nbsp;  &nbsp; 
	  <a href="files/portal/intranet/portal-instructivo_edl_provisionales_2022.pdf" target="_blank">Manual</a>
	 
	  </h3>
	  
<?php // } else {} ?>
	  </div>
	  
	  
	  <div class="col-md-6">
	<!--  <form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="cedula_funcionario">Cedula</option>
		 
		   
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>-->
</div>


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

	<!--<style>
    .dataTables_filter {
          display: none;
        }
	
      </style>	-->	
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Reportado</th>

 <th>Cédula</th>
				  <th>Funcionario</th>
				  <th>Vinculación</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				   <th>Periodo</th>
				   <th>Fecha inicial</th>
				  <th>Fecha final</th>	
<th>Calificación</th>				  
				   <th>Descripción</th>		
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {
					
				$infop=' and ano>2022 ';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }
				
				}
 


if (1==$_SESSION['rol'] or 0<$nump110) {
$query4="SELECT * from evaluacion_edl, funcionario, vinculacion where funcionario.id_vinculacion=vinculacion.id_vinculacion and evaluacion_edl.id_funcionario=funcionario.id_funcionario and estado_evaluacion_edl=1 ".$infop." ORDER BY id_evaluacion_edl desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from evaluacion_edl, funcionario, vinculacion where funcionario.id_vinculacion=vinculacion.id_vinculacion and evaluacion_edl.id_funcionario=funcionario.id_funcionario and estado_evaluacion_edl=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_evaluacion_edl desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_evaluacion_edl'];
echo '<td>'.$row['fecha_evaluacion_edl'].'</td>';

echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['nombre_vinculacion'].'</td>';
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}


echo '<td>'.$row['ano'].'-'.$row['periodo'].'</td>';

echo '<td>'.$row['fecha_inicial'].'</td>';
echo '<td>'.$row['fecha_final'].'</td>';
echo '<td>'.$row['nota'].'';

if (1==$_SESSION['rol'] or 0<$nump110) {
echo ' <a href="" title="Confrontar" id="'.$row['ano'].'-'.$row['periodo'].'-'.$row['id_funcionario'].'" class="ver_confrontar" data-toggle="modal" data-target="#popupconfrontar">
<span class="fa fa-search"></span></a>';
} else {}

echo '</td>';
echo '<td>'.$row['nombre_evaluacion_edl'].'</td>';
echo '<td>';
echo ' <a href="filesnr/edl/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
	if (1==$_SESSION['rol'] or 0<$nump110 or $row['id_funcionario']==$funcionarioedl) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="evaluacion_edl" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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


<?php if (3>$_SESSION['snr_tipo_oficina']) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65345345464324324563m1" enctype="multipart/form-data" >

<?php
if (isset($_GET['i']) && (1==$_SESSION['rol'] or 0<$nump110)) { 
?>

<div class="form-group text-left"> 
<label  class="control-label">Nombre:</label> 
<input type="hidden" name="id_funcionario" value="<?php echo $idorip; ?>">
<input type="text" class="form-control" readonly value="<?php echo quees('funcionario',$idorip); ?>">
</div>
<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Funcionario:</label> 
<select class="form-control"  name="id_funcionario" required>
<option selected></option>
<?php
/*
$query = sprintf("SELECT * FROM funcionario where id_oficina_registro=".$idorip." and estado_funcionario=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
		echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>

</select>
</div>-->



<?php } else { ?>



<div class="form-group text-left"> 
<label  class="control-label">Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Cargo:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>



 <div class="form-group text-left"> 
<label  class="control-label">Vinculación:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('vinculacion',$_SESSION['vinculacion']); ?>">
</div>



 <?php }
?>




<div class="form-group text-left"> 
<label  class="control-label">Periodo</label> 
<select name="periodo" class="form-control">
<option selected></option>
<?php
/*
$array=array('17957498', '1010040455', '7164562', '64581216', '66753249', '1010218422', '33338891', '1116433689', '1006318642', '37316084', '1054990700', '72239776', '33750621', '51859756', '1036613962', '1128278266', '73107163', '1054548131', '1019020494', '1016050413', '1057606069', '94316965', '27534474', '1020734150'); 
if (in_array($_SESSION['cedula_funcionario'], $array)) {
	echo '<option>2023-1</option>';
} else {}
	*/
?>
<option>2023-1</option>
<option>2023-2</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Calificación definitiva: </label> 
<input type="text" class="form-control numerodecimal"  name="nota" placeholder="Solo números y punto"  maxlength="6" required>
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

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO PDF FIRMADO POR EVALUADO Y EVALUADOR: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>

<div id="imagePreview"></div>
</div>



<div class="form-group text-left"> 
<label  class="control-label">Descripción / observación:</label> 
<textarea class="form-control" name="nombre_evaluacion_edl"></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>








<div class="modal fade bd-example-modal-lg" id="popupconfrontar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>EDL </b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestaconfrontar" class="modal-body">

	
   </div>
    </div>
  </div>
</div>




<?php } else { }


} else {} ?>



