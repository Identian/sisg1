<?php
$nump104=privilegios(104,$_SESSION['snr']);

if ((1==$_SESSION['rol'] or 0<$nump104) and isset($_GET["i"])){
$id=intval($_GET['i']);

//if ((3==$_SESSION['snr_tipo_oficina'] and 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol']) { 


} else if (1==$_SESSION['snr_grupo_cargo'] && 0<$_SESSION['posesionnotaria'] && (3==$_SESSION['snr_tipo_oficina'] and 1==$_SESSION['snr_grupo_cargo']) && 0<$_SESSION['id_vigilado']) {
$id=$_SESSION['snr'];
} else { $id=''; }



if (isset($id) && ''!==$id) {



if ((isset($_POST["fecha_certificado"])) && ($_POST["fecha_certificado"] != "") && (1==$_SESSION['rol'] or 0<$nump104)) {

$tamano_archivo=11534336; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'doc', 'docx',);


$directoryftp="filesnr/certificaciones/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'cert-'.$id.'-'.$identi;

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
  

$insertSQL = sprintf("INSERT INTO certificado_funcionario 
(id_funcionario, nombre_certificado_funcionario, url, fecha_certificado, oficina, codigo_oficina, 
estado_certificado_funcionario) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['nombre_certificado_funcionario'], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST['fecha_certificado'], "date"), 
GetSQLValueString(3, "int"), 
GetSQLValueString($_SESSION['id_vigilado'], "int"), 
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
  
	
	
} else { }

 
 
 if (isset($_POST["destino"]) && ''!=$_POST["destino"]) {
 
 $urlx='cert-'.$id.'-'.$identi.'';
 
 $insertSQL = sprintf("INSERT INTO certificado_funcionario (id_funcionario, nombre_certificado_funcionario, url, destino, 
 codigo_oficina, fecha_certificado, estado_certificado_funcionario) 
VALUES (%s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString('Certificado automático', "text"), 
GetSQLValueString($urlx, "text"), 
GetSQLValueString($_POST['destino'], "text"), 
GetSQLValueString($_SESSION['id_vigilado'], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

 $_SESSION['clavefirma']=78756;
//echo '<script type="text/javascript">swal(" OK !", " <a href="pdf/tiemposervicio&'.$urlx.'">Descargar.</a> ", "success");</script>';

	echo '<meta http-equiv="refresh" content="0;URL=https://sisg.supernotariado.gov.co/pdf/tiemposervicio&'.$urlx.'.pdf" />';


	
 } else { } 
  
 

?>
 
 

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<div class="col-md-8">
<?php				

$query = sprintf("SELECT * FROM gaj_tutela where id_gaj_tutela=".$id." and estado_gaj_tutela=1 limit 1");
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
			do {
echo 'JUZGADO: '.$row['juzgado'].'<br>';
echo 'AÑO: '.$row['ano_radicado'].'<br>';
echo 'RADICADO: '.$row['radicado'].'<br>';
} while ($row = mysql_fetch_assoc($select));
} else {}
mysql_free_result($select);


?>         
          
		  </div>
		  <div class="col-md-4">


		  </div>
</div>
</div>
</div>




</div>

	
	

	
<div class="row">
<div class="col-md-8">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
  

   
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nueva actividad
      </button>
	  

	  </div>
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">
<th>Observación</th>
<th style=""></th>	  
</tr>
</thead>
<tbody>
<?php 

$query4="SELECT * from gaj_tutela_detalle where fk_id_gaj_tutela=".$id." and estado_gaj_tutela_detalle=1 ORDER BY id_gaj_tutela_detalle";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_gaj_tutela_detalle'];

echo '<td>'.$row['observacion_gaj_tutela_detalle'].'</td>';

echo '<td>';
	if (1==$_SESSION['rol']) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="gaj_tutela_detalle" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
</div> 



<div class="col-md-4">
<div class="box box-primary">
<div class="box-header with-border">
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#miModal1">+</button> 
Accionados
</div>
</div>



<div class="box box-primary">
<div class="box-header with-border">
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#miModal2">+</button> 
Accionantes
</div>
</div>



<div class="box box-primary">
<div class="box-header with-border">
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#miModal3">+</button> 
Asignaciones
</div>
</div>




</div>
  
  




<!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->



 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVA</h4>
      </div>
      <div class="modal-body">
    
<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
	
	
	var fsize = 10000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    //  alert(siezekiloByte+'<'+fsize);
	  
	  if  (siezekiloByte < fsize){
		  

        //Image preview
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
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}
</script>
    
<form action="" method="POST" name="for543534345353454r65464563m1" enctype="multipart/form-data" >



<div class="form-group text-left">
<label  class="control-label"> Actividad:</label> 
<select name="fk_tutela_opcion" class="form-control">
<option value=""></option>
<?php
$query = "SELECT * FROM gaj_tutela_opcion";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id_gaj_tutela_opcion'] . "'>" . $row['nombre_gaj_tutela_opcion'] . "</option>";
}
$result->free();
$mysqli->close();
?>
</select>
							
</div>



<div class="form-group text-left">
<label  class="control-label"> Fecha de ejecución:</label> 
<input type="text" name="fecha_certificado" class="form-control datepicker" value=""  >

</div>

<div class="form-group text-left">
<label  class="control-label"> Observaciones:</label> 
<textarea type="text" name="nombre_certificado_funcionario" class="form-control"></textarea>

</div>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> Documento (Solo pdf o word ):</label> 
<input type="file" name="file" id="file" multiple title="" value="" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Inferior a 10 Mg</span>
<div id="imagePreview"></div>
</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Cargar </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="miModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo</h4>
      </div>
      <div class="modal-body" >
	  1
	 
	  </div> 
</div> 
</div> 
</div> 







<div class="modal fade" id="miModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo</h4>
      </div>
      <div class="modal-body" >
	  2
	 
	  </div> 
</div> 
</div> 
</div> 





<div class="modal fade" id="miModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo</h4>
      </div>
      <div class="modal-body" >
	  3
	 
	  </div> 
</div> 
</div> 
</div> 





<?php 
} else { echo 'Solo para notarios con oficinas de primera categoria.'; }
?>
