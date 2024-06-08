<?php

$nump111=privilegios(111,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 






if ((isset($_POST["celular_funcionario"])) && (""!=$_POST["celular_funcionario"]) && 
(1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina'])) {
	
	

	
	
	
		$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where (id_cargo=1 or id_cargo=2 or id_cargo=4 or id_cargo=6) and estado_funcionario=1 and id_funcionario=".$_SESSION['snr'].""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {

	
	
	
	$query = sprintf("SELECT count(id_encuentrocultural) as tencuentrocultural FROM encuentrocultural where estado_encuentrocultural=1 and id_funcionario=".$_SESSION['snr'].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tencuentrocultural']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene inscripción activa.</div>';
	
} else {



$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/encuentrocultural/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'encuentrocultural-'.$_SESSION['snr'].''.date("YmdGis");

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
  
  
$insertSQL = sprintf("INSERT INTO encuentrocultural (
nombre_encuentrocultural, id_funcionario, categoria,  modalidad, grupo, url, estado_encuentrocultural) 
VALUES (now(), %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"),
GetSQLValueString($_POST['categoria'], "text"),
GetSQLValueString($_POST['modalidad'], "text"),
GetSQLValueString($_POST['grupo'], "text"),
GetSQLValueString($files, "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $insertado;
  
  

  $updateSQL = sprintf("UPDATE funcionario SET  celular_funcionario=%s WHERE id_funcionario=%s and estado_funcionario=1",
                  
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
				
					    GetSQLValueString($_SESSION['snr'], "int"));
  $Result1 = mysql_query($updateSQL, $conexion);

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
              <h3><?php echo existencia('encuentrocultural'); ?></h3>

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
<b>  Inscripción a Encuentro Cultural 2022:</b>

<br>
<b>Objetivo: </b>
"Fomentar en los funcionarios el valor por la cultural, el folclor y el arte. <br>
Promover espacios de participación artística y cultural en la entidad, que fomenten la práctica de las actividades artísticas y culturales."					<br>
<br>
Declaro que la información que he suministrado es verídica y doy mi consentimiento expreso e irrevocable al GRUPO DE BIENESTAR , GESTIÓN DEL CONOCIMIENTO Y EVALUACIÓN DEL DESEMPEÑO DE LA SUPERINTENDENCIA DE NOTARIADO Y REGISTRO para:
<br>
<br>a) Consultar, en cualquier tiempo toda la información relevante para acreditar el beneficio otorgado.
<br>b) Reportar cualquier anomalía o incumplimiento de las condiciones estipuladas para el mismo si los hubiere, de tal forma que éstas presenten una información veraz, pertinente, completa, actualizada y exacta de los requisitos estipulados en la Resolución Nº01437 de 2020.
c) Conservar la información, durante el período necesario señalado en la política de tratamiento de datos.
  </p>
  
  
<?php  if (1==2) { // or 3>$_SESSION['snr_tipo_oficina']?>
  
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
		<th>Celular</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				 	 <th>Categoria</th>
					  <th>Modalidad</th>
					   <th>Grupo</th>
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
$query4="SELECT * from encuentrocultural, funcionario where encuentrocultural.id_funcionario=funcionario.id_funcionario and estado_encuentrocultural=1 ".$infop." ORDER BY id_encuentrocultural desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from encuentrocultural, funcionario where encuentrocultural.id_funcionario=funcionario.id_funcionario and estado_encuentrocultural=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_encuentrocultural desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_encuentrocultural'];
echo '<td>'.$row['nombre_encuentrocultural'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';


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
echo $row['categoria'];
echo '</td>';
echo '<td>';
echo $row['modalidad'];
echo '</td>';
echo '<td>';
echo $row['grupo'];
echo '</td>';

echo '<td>';
//echo ' <a href="" class="buscarencuentrocultural" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarencuentrocultural"> <i class="fa fa-edit"></i></a> ';
echo ' <a href="filesnr/encuentrocultural/'.$row['url'].'" target="_blank" > <i class="fa fa-file"></i></a> ';


//or 0<$nump111
	if (1==$_SESSION['rol'] or 0<$nump111) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="encuentrocultural" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';




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
        
<form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label> 
<input type="text" class="form-control numero"  name="celular_funcionario" placeholder="Solo números" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Categoria:</label> 
<select class="form-control"  name="categoria"  required>
<option selected></option>
<option>Individual</option>
<option>Grupal</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Modalidad:</label> 
<select class="form-control"  name="modalidad"  required>
<option selected></option>		
<option>Danza Folclórica</option>
<option>Danza Ritmo Latino</option>
<option>Pintura	Fotografía</option>
<option>Canto</option>
<option>Instrumenral </option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Nombre del Grupo (para las categorías grupales):</label> 
<input type="text" class="form-control "  name="grupo"  >
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
<label  class="control-label"><span style="color:#ff0000;">*</span> <b>Carnet de Vacunación:</b><br>
</label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span>
<div id="imagePreview"></div>
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





<div class="modal fade" id="popupactualizarencuentrocultural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div id="ver_actualizarencuentrocultural" class="modal-body"> 

</div>
</div> 
</div> 
</div>



	  



<?php } else { }


} else {} ?>



