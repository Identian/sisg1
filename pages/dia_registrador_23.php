<?php
$nump111=privilegios(111,$_SESSION['snr']);


if (3>$_SESSION['snr_tipo_oficina']) { 



if ((isset($_POST["celular_funcionario"])) && (""!=$_POST["celular_funcionario"]) && 
(1==$_SESSION['rol'] or 13>=$_SESSION['id_cargo_nomina_encargo'])) {
	
	

	
	
	
		$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where id_cargo_nomina_encargo<=13 and id_tipo_oficina<3 and estado_funcionario=1 and id_funcionario=".$_SESSION['snr'].""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {

	
	
	
	$query = sprintf("SELECT count(id_dia_registrador_23) as tdia_registrador_23 FROM dia_registrador_23 where estado_dia_registrador_23=1 and id_funcionario=".$_SESSION['snr'].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tdia_registrador_23']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene inscripción activa.</div>';
	
} else {



$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/diaregistrador/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'dia_registrador-'.$_SESSION['snr'].''.date("YmdGis");

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
  
  
$insertSQL = sprintf("INSERT INTO dia_registrador_23 (id_funcionario, 
ciudad_origen,  transporte, camiseta, alimento, nombre_alimento, alergia, nombre_alergia, movilidad,
nombre_movilidad, url, estado_dia_registrador_23) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"),
GetSQLValueString($_POST['ciudad_origen'], "text"),
GetSQLValueString($_POST['transporte'], "text"),
GetSQLValueString($_POST['camiseta'], "text"),
GetSQLValueString($_POST['alimento'], "text"),
GetSQLValueString($_POST['nombre_alimento'], "text"),
GetSQLValueString($_POST['alergia'], "text"),
GetSQLValueString($_POST['nombre_alergia'], "text"),
GetSQLValueString($_POST['movilidad'], "text"),
GetSQLValueString($_POST['nombre_movilidad'], "text"),
GetSQLValueString($files, "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $insertado;
  
  

  $updateSQL = sprintf("UPDATE funcionario SET  celular_funcionario=%s, fecha_nacimiento=%s WHERE id_funcionario=%s and estado_funcionario=1",
                  
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
				GetSQLValueString($_POST["fecha_nacimiento"], "date"),
					    GetSQLValueString($_SESSION['snr'], "int"));
  $Result1 = mysql_query($updateSQL, $conexion);




$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN DE INSCRIPCIÓN AL DIA DEL REGISTRADOR 2023';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente la inscripción al dia del registrador 2023.<br><br>';

$cuerpo2 .= $corre."<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);




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
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para Registradores, Directivos, Asesores y Directores Regionales. Si identifica inconsistencias, reportarlo a talento humano para actualizar el perfil.</div>';	
} 




}
 else { }

 
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('dia_registrador_23'); ?></h3>

              <p>Registros</p>
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
 
  
  <p>
<b>  Inscripción al dia del Registrador 2023:</b>

<br>

<br>
<b>
<a href="" target="_blank">Terminos y condiciones.</a></b>
  </p>
  
  
<?php 


$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-07-10 08:00:00");
$fecha_limite = strtotime("2023-11-08 17:00:00");

if ($fecha_limite>=$fecha_actual && 3>$_SESSION['snr_tipo_oficina']) {

 ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> 
	  
	  
	 <?php if (isset($_GET['i'])) { 
	 echo ' / ';
//echo quees('oficina_registro',$idorip);
 } else {
 
 } 
 ?>
	  </h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Inscripción</th>
		<th>Funcionario</th>
		<th>Cedula</th>
		<th>Fecha nacimiento</th>
		
		
		<th>Celular</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				 	 <th>Ciudad</th>
					 <th>Transporte</th>
					 <th>Camiseta</th>
					 <th>Rest. Alimentos</th>
					 <th>Cúal alimento</th>
					 <th>Alergia</th>
					 <th>Cúal alergia</th>
					 <th>Rest. movilidad</th>
					 <th>Cúal movilidad</th>
		
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
 


if (1==$_SESSION['rol'] or 0<$nump111) {
$query4="SELECT * from dia_registrador_23, funcionario where dia_registrador_23.id_funcionario=funcionario.id_funcionario and estado_dia_registrador_23=1 ".$infop." ORDER BY id_dia_registrador_23 desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from dia_registrador_23, funcionario where dia_registrador_23.id_funcionario=funcionario.id_funcionario and estado_dia_registrador_23=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_dia_registrador_23 desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_dia_registrador_23'];
echo '<td>'.$row['fecha_dia_registrador_23'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';

echo '<td>';
echo $row['fecha_nacimiento'];
echo '</td>';


echo '<td>';
echo $row['celular_funcionario'];
echo '</td>';


if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';		
}



echo '<td>';
echo $row['ciudad_origen'];
echo '</td>';


echo '<td>';
echo $row['transporte'];
echo '</td>';

echo '<td>';
echo $row['camiseta'];
echo '</td>';

echo '<td>';
echo $row['alimento'];
echo '</td>';

echo '<td>';
echo $row['nombre_alimento'];
echo '</td>';

echo '<td>';
echo $row['alergia'];
echo '</td>';

echo '<td>';
echo $row['nombre_alergia'];
echo '</td>';

echo '<td>';
echo $row['movilidad'];
echo '</td>';

echo '<td>';
echo $row['nombre_movilidad'];
echo '</td>';


echo '<td>';
//echo ' <a href="" class="buscardia_registrador_23" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizardia_registrador_23"> <i class="fa fa-edit"></i></a> ';
echo ' <a href="filesnr/diaregistrador/'.$row['url'].'" target="_blank" > <i class="fa fa-file"></i></a> ';


//or 0<$nump111
	if (1==$_SESSION['rol'] or 0<$nump111) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="dia_registrador_23" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';


	} else {}
echo '</td>';
?>
      
                  </tr>
                <?php } 
				
				$result->free();
				?>

				
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
        
<form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha de nacimiento: <?php 
if (isset($_SESSION['fecha_nacimiento'])) {
$edadc= calculaedad ($_SESSION['fecha_nacimiento']);
echo $edadc.' años';
} else {}
?></label>
 
<input type="text" class="form-control datepickera"  name="fecha_nacimiento" value="<?php echo $_SESSION['fecha_nacimiento']; ?>" required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label> 
<input type="text" class="form-control numero"  name="celular_funcionario" placeholder="Solo números" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ciudad de origen:</label> 
<input type="text" class="form-control "  name="ciudad_origen" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de transporte:</label> 
<select class="form-control"  name="transporte"  required>
<option selected></option>
<option>Aéreo</option>
<option>Terrestre</option>
<option>Mixto (aéreo y terrestre)</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Talla de Camiseta :</label> 
<select class="form-control"  name="camiseta" required>
<option selected></option>	
<option>XS</option>
<option>S</option>
<option>M</option>
<option>L</option>
<option>XL</option>
<option>XXL</option>
<option>XXXL</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Restricción de alimentos:</label> 
<select class="form-control"  name="alimento"  required>
<option selected></option>
<option>Si</option>
<option>No</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"> En caso que si tenga restricción de alimentos, cúal:</label> 
<input type="text" class="form-control"  name="nombre_alimento" >
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Alergias:</label> 
<select class="form-control"  name="alergia"  required>
<option selected></option>
<option>Si</option>
<option>No</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> En caso que si tenga alergias, cúal:</label> 
<input type="text" class="form-control"  name="nombre_alergia"  >
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Presenta alguna restricción de movilidad:</label> 
<select class="form-control"  name="movilidad"  required>
<option selected></option>
<option>Si</option>
<option>No</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> En caso que si presente alguna restricción de movilidad, cúal:</label> 
<input type="text" class="form-control"  name="nombre_movilidad"  >
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
<label  class="control-label"><span style="color:#ff0000;">*</span> <b>En un PDF adjuntar fotocopia de la cedula al 150%:</b><br>

</label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span> 
<div id="imagePreview"></div>
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



	  



<?php } else { }


} else {} ?>



