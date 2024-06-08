<?php
$nump6=privilegios(6,$_SESSION['snr']);
if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 0<$_SESSION['posesionnotaria'] && 1<$_SESSION['id_categoria_notaria'])) { 

if (1==$_SESSION['rol'] or 0<$nump6) {
	$id=intval($_GET['i']);
} else {
	$id=$_SESSION['id_vigilado'];
}

			  
if (isset($_POST["id_funcionario_notario"]) && $_POST["id_funcionario_notario"] != "") { 




$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/documento_permiso/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'permiso-'.$_SESSION['snr'].''.date("YmdGis");

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
  


	//`file_acta`	`file_solicitud` 
	
$idencargado=$_POST["id_encargado"];

$insertSQL = sprintf("INSERT INTO permiso (origen, id_funcionario, id_notaria, id_funcionario_encargado, fecha_creacion, estado_permiso, 
cedula_encargado, nombre_encargado, fecha_acto, numero_acto, fecha_acta, numero_acta, file_acto) 
VALUES (%s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["id_funcionario_notario"], "int"),
GetSQLValueString($id, "int"),
GetSQLValueString($idencargado, "int"),
GetSQLValueString(1, "int"),

GetSQLValueString($_POST["cedula_encargado"], "int"),
GetSQLValueString($_POST["nombre_encargado"], "text"),
GetSQLValueString($_POST["fecha_acto"], "date"),
GetSQLValueString($_POST["numero_acto"], "int"),
GetSQLValueString($_POST["fecha_acta"], "date"),
GetSQLValueString($_POST["numero_acta"], "int"),
GetSQLValueString($files, "text")
);
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
  
	



} else {} 

?>
<div class="row">
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('permiso'); ?></h3>

              <p>Total de registro a nivel nacional</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="entidades_reparto.jsp" class="small-box-footer">Ir a Entidades <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="https://sisg.supernotariado.gov.co/xls/reparto_notarial.xls" class="small-box-footer">Descargar Reporte <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php echo existencia('notaria'); ?></h3>
			  
              <p>Notarias</p>
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
              <h3><?php //echo cuenta('1','52','8','1');?>195</h3>
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

  
<br>
<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo permiso o licencia
      </button> &nbsp; 
	  
	  
	  <a href="personal_notaria&<?php echo $id; ?>.jsp" target="_blank"><button type="button" class="btn btn-xs btn-warning" ><span class="glyphicon glyphicon-plus-sign"></span>
        Agregar personal
      </button></a>

	  
	  
	  
	  
	  &nbsp;   &nbsp;   &nbsp; NOTARIA: 
	  <?php 
  		 if (1==$_SESSION['rol'] && isset($_GET['i'])) {
			 $id=$_GET['i'];
  echo '<a href="notaria&'.$id.'.jsp">'.quees('notaria', $id).'</a>';


  } else {	
  $id=$_SESSION['posesionnotaria'];
   echo '<a href="notaria&'.$id.'.jsp">'.quees('notaria', $_SESSION['posesionnotaria']).'</a>';

	
  }
 ?>
 
	  
	  
  




  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
            <tr>
			 <th>Acto Admin</th>
			  <th>Fecha acto</th>
			  <th>Acta posesión</th>
			  <th>Fecha acta</th>
              <th>Notario</th>
             <th>Encargado</th>
			 <th>Ingreso</th>
			 <th>Acto administrativo</th>
			
              <th>Estado</th>
			  <th style="width:80px;"></th>
            </tr>
   </thead>
<tbody>

				
<?php 

$query4="SELECT * FROM funcionario, permiso where permiso.id_funcionario=funcionario.id_funcionario and permiso.id_notaria=".$id." and estado_permiso=1 order by id_permiso desc";

$result = $mysqli->query($query4);
while($rownvb = $result->fetch_array()) {
?>  
<tr>

            <?php

echo '<td>'.$rownvb['numero_acto'].'</td>';
echo '<td>'.$rownvb['fecha_acto'].'</td>';
echo '<td>'.$rownvb['numero_acta'].'</td>';
echo '<td>'.$rownvb['fecha_acta'].'</td>';


echo '<td>'.$rownvb['nombre_funcionario'].'</td>';

echo '<td>';
if (isset($rownvb['id_funcionario_encargado']) && 0!=$rownvb['id_funcionario_encargado']) {
echo quees('funcionario', $rownvb['id_funcionario_encargado']);
} else {
	

	}
echo '</td>';

echo '<td>';
if (0==$rownvb['origen']) {
	echo 'SNR';
} else {
	echo 'Notarias';
}
echo '</td>';

echo '<td>';

echo '<a href="filesnr/documento_permiso/'.$rownvb['file_acto'].'" target="_blank">Acto</a>';

echo '</td>';





echo '<td>';
if (isset($rownvb['aprobacion'])) {
	
	if (1==$rownvb['aprobacion']) {
	echo 'Aprobada';
	} else {
		echo 'No aprobada';
	}
} else {
	echo 'En tramite';
}
echo '</td>';
echo '<td><a href="" id="'.$rownvb['id_permiso'].'" class="consultapermiso" data-toggle="modal" data-target="#resultadopermisolicencia"><i class="glyphicon glyphicon-search"></i></a> ';


	
	if (1==1) {
	echo ' <a href="permiso_notarios&'.$rownvb['id_permiso'].'.jsp"><i class="glyphicon glyphicon-pencil"></i></a> ';
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



<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
    

    
<form action="" method="POST" name="for543534345353454r65464563m1"  enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label"> Notario titular:</label> 
<select  type="text" class="form-control" name="id_funcionario_notario">
	<?php				  
$query9 = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n where id_cargo=1 and posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_tipo_nombramiento_n=tipo_nombramiento_n.id_tipo_nombramiento_n and id_notaria=".$id." and estado_funcionario=1 and estado_posesion_notaria=1 group by funcionario.id_funcionario order by fecha_inicio desc");
$select9 = mysql_query($query9, $conexion);
$row9 = mysql_fetch_assoc($select9);

do {
	
echo '<option value="'.$row9['id_funcionario'].'"';

if ($row9['id_funcionario']==$id_notario) {
echo 'selected'; 
} else { echo '';}
echo '>'.$row9['nombre_funcionario'].'</option>';

} while ($row9 = mysql_fetch_assoc($select9));
mysql_free_result($select9);

 

?>

</select>
</div>



   <div class="form-group text-left">
<label class="control-label"><span style="color:#ff0000;">*</span> ENCARGADO: 
</label>
<select  type="text" class="form-control" name="id_encargado">
<option></option>
     	<?php				  
$query9 = sprintf("SELECT * FROM funcionario where id_tipo_oficina=3 and id_cargo!=1 and id_notaria_f=".$id." and estado_funcionario=1  group by funcionario.id_funcionario");
$select9 = mysql_query($query9, $conexion);
$row9 = mysql_fetch_assoc($select9);

do {
	
echo '<option value="'.$row9['id_funcionario'].'"';

echo '>'.$row9['nombre_funcionario'].' &nbsp; &nbsp; &nbsp; <i><span style="color:#ccc;">';

if(1==$row9['encargado_notaria']) { echo 'Autorizado por SNR'; } else { echo 'Sin revisión por SNR';  }

echo '</span></i></option>';

} while ($row9 = mysql_fetch_assoc($select9));
mysql_free_result($select9);


?>
</select>
<a href="personal_notaria&<?php echo $id; ?>.jsp" target="_blank" class="btn btn-xs btn-warning fa fa-user" >+</a>
		
		
            </div>
			
			
		
			
			
			


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha del acto administrativo</label> 
<input type="text" class="form-control datepickera" name="fecha_acto" readonly required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número del acto administrativo</label> 
<input type="text" class="form-control numero" name="numero_acto" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha del acta de posesión</label> 
<input type="text" class="form-control datepickera" name="fecha_acta" readonly required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número del acta de posesión</label> 
<input type="text" class="form-control numero" name="numero_acta" required>
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
<label  class="control-label"><span style="color:#ff0000;">*</span> Acto administrativo en PDF: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>

<div id="imagePreview"></div>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onclick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>



















<div class="modal fade bd-example-modal-lg" id="popupreparto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Actualizar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="ver_cambio_reparto" class="modal-body">

   </div>
    </div>
  </div>
</div>






<div class="modal fade" id="resultadopermisolicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Detalles del permiso o licencia</h4>
      </div>
      <div class="modal-body" id="resultadopermiso">
	  
	 
	  </div> 
</div> 
</div> 
</div> 





<?php
} else {
	ECHO 'Solo para Notarias de 2 y 3 categoria.';
} ?>



