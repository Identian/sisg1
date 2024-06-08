<?php
/*
$nump95=privilegios(95,$_SESSION['snr']);
if (isset($_POST['fecha'])){ 
$fechan=$_POST['fecha'];
 } else {
$fechan=date('Y-m-d');  
 } 


	   

} else {
$idorip=$_SESSION['id_oficina_registro'];
}

*/



if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=0;  
 } 
 
 

$nump110=privilegios(110,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 



if ((isset($_POST["fecha_inicial"])) && (""!=$_POST["fecha_final"]) && 
(1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina'])) {
	
	
if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
$funcionarioedl=$_SESSION['snr']; //$_POST["id_funcionario"];
 } else {
$idorip=0;  
$funcionarioedl=$_SESSION['snr'];
 } 
	
	
	
		$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where (id_cargo=2 or id_cargo=4 or id_cargo=6) and estado_funcionario=1 and id_funcionario=".$funcionarioedl.""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {

	
	
	
	$query = sprintf("SELECT count(id_cuenta_cobro) as tcuenta_cobro FROM cuenta_cobro where estado_cuenta_cobro=1 and id_funcionario=".$funcionarioedl.""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tcuenta_cobro']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene un registro EDL.</div>';
	
} else {
	
	

$tamano_archivo=11534336;
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
  

$insertSQL = sprintf("INSERT INTO cuenta_cobro (
nombre_cuenta_cobro, id_funcionario, fecha_inicial, fecha_final, nota, fecha_cuenta_cobro, url, estado_cuenta_cobro) 
VALUES (%s, %s, %s, %s, %s, now(), %s, %s)", 

GetSQLValueString($_POST["nombre_cuenta_cobro"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString($_POST["fecha_inicial"], "date"),
GetSQLValueString($_POST["fecha_final"], "date"),
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
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para funcionarios de de carrera ó provisionales. Si identifica inconsistencias, reportarlo a sandram.gomez@supernotariado.gov.co para actualizar el perfil.</div>';	
} 




}
 else { }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('cuenta_cobro'); ?></h3>

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
  
  
  
  <div class="col-md-12">
<?php  if (1==$_SESSION['rol'] or 1==$_SESSION['snr_tipo_oficina']) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> Radicación cuentas de cobro vigencia 2022 (<a href="https://www.supernotariado.gov.co/files/snrcirculares/circular-38-20220201111523.pdf" target="_blank">Circular 038 de 2022</a>
	  

	  </h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Reportado</th>
				  <th>Funcionario</th>
			
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
					
				$infop='';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }
				
				}
 


if (1==$_SESSION['rol'] or 0<$nump110) {
$query4="SELECT * from cuenta_cobro, funcionario where cuenta_cobro.id_funcionario=funcionario.id_funcionario and estado_cuenta_cobro=1 ".$infop." ORDER BY id_cuenta_cobro desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from cuenta_cobro, funcionario where cuenta_cobro.id_funcionario=funcionario.id_funcionario and estado_cuenta_cobro=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_cuenta_cobro desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_cuenta_cobro'];
echo '<td>'.$row['fecha_real'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

echo '<td>'.$row['fecha_inicial'].'</td>';
echo '<td>'.$row['fecha_final'].'</td>';
echo '<td>'.$row['nota'].'</td>';
echo '<td>'.$row['nombre_cuenta_cobro'].'</td>';
echo '<td>';
echo ' <a href="filesnr/edl/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
	if (1==$_SESSION['rol'] or 0<$nump110) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="cuenta_cobro" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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


<?php if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { ?>





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
if (isset($_GET['i']) && 2==3) { 
//$idorip;
?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Funcionario:</label> 
<select class="form-control"  name="id_funcionario" required>
<option selected></option>
<?php
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
?>

</select>
</div>


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

Conforme a la circular 38  favor anexar los siguientes soportes en el orden de la circular:
 

Formato informe de supervisión y/o cumplimiento contrato prestación de servicios, solicitud y autorización de pago. (ANEXO)
Formato de retención en la fuente año gravable 2022 y sus anexos en caso de ser necesario. (ANEXO)
Planilla de seguridad social debidamente liquidada del mes vencido al que está cobrando, o afiliación a EPS y AFP, según sea el caso. Si el contratista es pensionado deberá aportar certificación o resolución de reconocimiento de pensión.
Copia de condiciones adicionales del contrato de prestación de servicios.
Copia de póliza y pantallazo de SECOP II de aprobación de la misma.
Acta de inicio debidamente suscrita por el supervisor y el contratista.
Afiliación o certificación en la que conste que se encuentra activo en la ARL
Pantallazo publicación carpeta .ZIP evidencias del mes correspondiente.

 <?php }
?>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha inicial: (Usar calendario)</label> 
<input type="text" class="form-control datepicker"  name="fecha_inicial" readonly required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha final:</label> 
<input type="text" class="form-control datepicker"  name="fecha_final" readonly required>
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
	alert('Debe ser inferior a 5000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO PDF FIRMADO POR EVALUADO Y EVALUADOR: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 5 Mg</span>

<div id="imagePreview"></div>
</div>



<div class="form-group text-left"> 
<label  class="control-label">Descripción:</label> 
<textarea class="form-control" name="nombre_cuenta_cobro"></textarea>
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




<?php } else { }


} else {} ?>



