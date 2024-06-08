<?php
if (isset($_GET['i']) && "" != $_GET['i'] && 1==1) {
  $id = $_GET['i'];


$nump107 = privilegios(107, $_SESSION['snr']);

 if (0<$nump107) { 
$_SESSION['permiso107']=107;
 } else { $_SESSION['permiso107']=0; }  


if (0<$nump107 or 1==$_SESSION['rol'] or 4==$_SESSION['snr_tipo_oficina']) {
	

	
if (1==$_SESSION['rol'] or 0<$nump107) {
	
$query = sprintf("SELECT * FROM curaduria where id_curaduria=".$id."  and curaduria.estado_curaduria=1 limit 1"); 
	
} 
else {
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, situacion_curaduria where (situacion_curaduria.fecha_terminacion>='$realdate' or situacion_curaduria.fecha_terminacion is null) and curaduria.id_curaduria=situacion_curaduria.id_curaduria  and curaduria.id_curaduria=".$id." and situacion_curaduria.id_funcionario=".$idfun."  and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1"); 
	
}

$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$correo = $row1['correo_funcionario'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$ncuraduria=$row1['numero_curaduria'];
}
	
	

	
if (isset($_POST['actuacion']) && ""!=$_POST['nradicado']) {
	
	
	

$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/radicacion_curaduria/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'actuacion-'.$id.'-'.$identi;

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
  


$insertSQL = sprintf("INSERT INTO actuacion_curaduria (nradicado, id_curaduria, 
actuacion, fecha_radicacion, fecha_expedicion, direccion, 
matricula, titulares, unidades, areafinal, areaunidades, areacomun, nombre_proyecto, 
cantidadusos, unidadxcadauso, metroscmovi, 
url, nombre_actuacion_curaduria, estado_actuacion_curaduria) 
 
 VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
 
 GetSQLValueString($_POST["nradicado"], "text"),
GetSQLValueString($id, "int"),

GetSQLValueString($_POST["actuacion"], "text"), 
GetSQLValueString($_POST["fecha_radicacion"], "text"), 
GetSQLValueString($_POST["fecha_expedicion"], "text"), 
GetSQLValueString($_POST["direccion"], "text"), 
GetSQLValueString($_POST["matricula"], "text"), 
GetSQLValueString($_POST["titulares"], "text"), 
GetSQLValueString($_POST["unidades"], "text"), 
GetSQLValueString($_POST["areafinal"], "text"), 
GetSQLValueString($_POST["areaunidades"], "text"), 
GetSQLValueString($_POST["areacomun"], "text"), 
GetSQLValueString($_POST["nombre_proyecto"], "text"), 
GetSQLValueString($_POST["cantidadusos"], "text"), 
GetSQLValueString($_POST["unidadxcadauso"], "text"), 
GetSQLValueString($_POST["metroscmovi"], "text"), 

GetSQLValueString($files, "text"), 
GetSQLValueString($_POST["nombre_actuacion_curaduria"], "text"), 
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
	

mysql_free_result($update22);
}





 

?>


    <div class="row">
      <div class="col-md-12">


        <div class="box box-primary">
		  <div class="box-body box-profile">
Actuaciones administrativas de Curadurias conforme con Resolución 1026 - 2021 de MinVivienda.
			<strong>  &nbsp; /
	   <?php echo $name; 
	   echo ' - ';
	   echo quees('departamento', $id_departamento); 
	    echo ' - ';
	   echo nombre_municipio($id_municipio, $id_departamento); 

	   ?>
</strong> 


          </div>


  
        <div class="nav-tabs-custom">



	 
          

          <div class="tab-content">
		  
		  
		  
		 <!--  <form class="navbar-form" name="fotertrm5435435rter1erteg" method="post" action="">
<B>  Buscar</B> 
              <div class="input-group">
                <div class="input-group-btn">
                  <select class="form-control obligatoriocur" name="campo" required>
                    <option value="" selected> - - Buscar por: - - </option>

<option value="numero_actuacion_curaduria">Número de radicación (Últimos 4 digitos)</option>
<option value="cedulas">Cédulas</option>
<option value="matriculas">Matriculas</option>
mas30dias
                  </select>
                </div>
                <div class="input-group-btn">
                  <input type="text" name="buscar" placeholder="" class="form-control obligatoriocur" required></div>
              
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                </div>
              </div>

            </form>-->
			
			
		  
		  
		  
<?php  if (1==$_SESSION['rol'] or 0<$nump107 or 4==$_SESSION['snr_tipo_oficina']) { 
?>
<a href="" class="btn btn-success" data-toggle="modal" data-target="#popupnewlicencia">
<span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a> 
<br><br>	  
<?php } else {} ?>

		  
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <?php
  if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' limit 500";    
              } else {
                $infobus = " order by id_actuacion_curaduria desc"; // limit 600 
			  }
					

$queryn = "SELECT * FROM actuacion_curaduria where id_curaduria=".$id."  and estado_actuacion_curaduria=1 ".$infobus."";
$selectn = mysql_query($queryn, $conexion) ;
$row = mysql_fetch_assoc($selectn);
$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){
	
	
	
                    ?>
<!--
<style>
        .dataTables_filter {
          display: none;
        }
      </style>-->
	  
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
				<thead><tr align='center' valign='middle'>
				<th>Número</th>
<th>Actuacion</th><th>Radicacion</th><th>Expedicion</th><th>Direccion</th><th>Matricula</th>
<th>Titulares</th><th>Unidades</th><th>Area final</th><th>Area x unidad</th><th>Area comun</th>
<th>Proyecto</th><th>Cantidad usos</th><th>Unidad x uso</th><th>Metros en movimiento</th>
<th>Expediente</th>
				<th>Observación</th>
				<th style="width:70px;"></th>
				</tr></thead><tbody>
				
					  
                        <?php
						
						
						
                        do {
echo '<tr>';
$idv=$row['id_actuacion_curaduria'];
echo '<td>'.$row['nradicado'].'</td>';
echo '<td>'.$row['actuacion'].'</td>';
echo '<td>'.$row['fecha_radicacion'].'</td>';
echo '<td>'.$row['fecha_expedicion'].'</td>';
echo '<td>'.$row['direccion'].'</td>';
echo '<td>'.$row['matricula'].'</td>';
echo '<td>'.$row['titulares'].'</td>';
echo '<td>'.$row['unidades'].'</td>';
echo '<td>'.$row['areafinal'].'</td>';
echo '<td>'.$row['areaunidades'].'</td>';
echo '<td>'.$row['areacomun'].'</td>';
echo '<td>'.$row['nombre_proyecto'].'</td>';
echo '<td>'.$row['cantidadusos'].'</td>';
echo '<td>'.$row['unidadxcadauso'].'</td>';
echo '<td>'.$row['metroscmovi'].'</td>';
echo '<td><a href="filesnr/radicacion_curaduria/'.$row['url'].'" target="_blank"><i class="fa fa-file"></i></a></td>';
echo '<td>'.$row['nombre_actuacion_curaduria'].'</td>';
echo '<td>';
    if (1==$_SESSION['rol'] or 0<$nump107) { 
		echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="actuacion_curaduria" id="'.$idv.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	
echo '</td>';
                      echo '</tr>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>
						<script>
				$(document).ready(function() {
					$('#detallefun').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [500], [500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
                        
                      </tbody>
                    </table>
<?php } else { echo 'No existen registros'; } ?>
</div>
                </div>
              </div>
            </div>






            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>







 <div class="modal fade" id="popupnewlicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVA ACTUACIÓN</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for5445435354r65464563m1" enctype="multipart/form-data">



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN:</label> 
<input type="text" class="form-control " name="nradicado" value="" required  >

</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE ACTUACIÓN:</label> 
<select  class="form-control " name="actuacion" required id="actuacioncur">
<option selected></option>
<option>AJUSTE DE COTAS Y ÁREAS</option>
<option>CONCEPTO DE NORMA URBANISTICA</option>
<option>CONCEPTO DE USO DEL SUELO</option>
<option>COPIA CERTIFICADA DE PLANOS</option>
<option>APROBACION DE LOS PLANOS DE PROPIEDAD HORIZONTAL</option>
<option>AUTORIZACIÓN PARA EL MOVIMIENTO DE TIERRAS</option>
<option>APROBACIÓN DE PISCINAS</option>
<option>MODIFICACION DE PLANOS URBANISTICOS, DE LEGALIZACION Y DEMAS PLANOS QUE APROBARÓN DESARROLLOS O ASENTAMIENTOS</option>
<option>BIENES DESTINADOS A USO PUBLICO O CON VOCACIÓN DE USO PÚBLICO</option>
</select>
</div>

<div id="datosactuacionescur">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION:</label> 
<input type="text" class="form-control datepickera obligatoriocur" readonly="readonly" name="fecha_radicacion" value="" required  >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICION:</label> 
<input type="test"  class="form-control obligatoriocur datepickera" readonly="readonly" name="fecha_expedicion" required  >
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EJECUTORIA:</label> 
<input type="test"  class="form-control obligatoriocur datepickera" readonly="readonly" name="fecha_ejecutoria" required  >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DIRECCIÓN:</label> 
<input type="text" class="form-control obligatoriocur" name="direccion"  required>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MATRICULA:</label> 
<input type="text" class="form-control obligatoriocur" name="matricula"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TITULARES: (Separados por ,)</label> 
<textarea class="form-control obligatoriocur" name="titulares"  required></textarea>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número de unidades aprobadas:</label> 
<input type="text" class="form-control obligatoriocur numero" name="unidades"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Area final ajustada en métros cuadrados:</label> 
<input type="text" class="form-control obligatoriocur numero" name="areafinal"  required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Area de las uniadades aprobadas:</label> 
<input type="text" class="form-control obligatoriocur numero" name="areaunidades"  required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Area comun aprobada en metros cuadrados:</label> 
<input type="text" class="form-control obligatoriocur numero" name="areacomun"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> Nombre del proyecto o nombre de la propiedad horizontal:</label> 
<input type="text" class="form-control" name="nombre_proyecto"  >
</div>


<div class="form-group text-left"> 
<label  class="control-label"> Cantidad de usos:</label> 
<input type="text" class="form-control " name="cantidadusos"  >
</div>

<div class="form-group text-left"> 
<label  class="control-label"> Unidades por cada uso:</label> 
<input type="text" class="form-control" name="unidadxcadauso"  >
</div>

<div class="form-group text-left"> 
<label  class="control-label"> Metros Cúbicos autorizados para el movimiento:</label> 
<input type="text" class="form-control " name="metroscmovi"  >
</div>

</div>







<script>

function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
	
	
	var fsize = 15000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    //  alert(siezekiloByte+'<'+fsize);
	  
	  if  (siezekiloByte < fsize){
		  
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
        fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = 'Error por tipo de archivo';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        } 
    }
	
} else {
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}

</script>


<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> Expediente con acto administrativo:</label> 
<input type="file" name="file" id="file" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 15 Mg</span>
<div id="imagePreview"></div>
</div>



<div class="form-group text-left"> 
<label  class="control-label"> OBSERVACIONES:</label> 
<span style="color:#ff0000;"></span>
<textarea class="form-control obligatoriocur" name="nombre_actuacion_curaduria" ></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" >
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php 


  } else {  echo '';}
} else {  echo '';}
?>