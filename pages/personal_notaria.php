<?php
if (1==$_SESSION['rol'] and isset($_GET["i"])) {
	
if (isset($_GET['i'])) {
	$id=$_GET['i'];
} else {
	$id=1;
}

} else {

if (isset($_SESSION['posesionnotaria']) && ""!= $_SESSION['posesionnotaria']) {
$id=$_SESSION['posesionnotaria'];
} else {
$idvigilado=$_SESSION['id_vigilado'];
$personal=privilegiosnotariado($idvigilado, 11, $_SESSION['snr']);
if (""!=$idvigilado && 0!=$idvigilado && 0<$personal) {
	$id=$idvigilado;
} else {
	$id=0;
}
}
}




if (isset($id) and ""!=$id and 0!=$id){





if (isset($_GET['e']) && ""!=$_GET['e']) {
	
$idemp=intval($_GET['e']);
$query88577 = "UPDATE funcionario SET id_rol=6, alias_iduca=NULL, fecha_salida='$realdate' WHERE id_funcionario=".$idemp." and id_notaria_f=".$id."";  
$result44343247 = $mysqli->query($query88577);

} else {}




	
if ((isset($_POST["cedula_funcionario"])) && ($_POST["cedula_funcionario"] != "")) {

$tamano_archivo=1048576; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/hv/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'snr-'.$_POST["cedula_funcionario"].'-'.$identi;

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
  
	
	

   
    $ced_fu = trim($_POST["cedula_funcionario"]);
    $selecty = mysql_query("select id_funcionario from funcionario where cedula_funcionario='$ced_fu'", $conexion);
    $rowy = mysql_fetch_assoc($selecty);
    $totalRowsy = mysql_num_rows($selecty);
    if (0 < $totalRowsy) {

////////



 $update = sprintf("UPDATE funcionario set nombre_funcionario=%s, id_notaria_f=%s, sexo=%s, correo_funcionario=%s, 
clave_funcionario=%s, fecha_ingreso=%s, profesion=%s, telefono_funcionario=%s, id_rol=%s, id_grupo_area=%s, 
 id_cargo_nomina_encargo=%s, id_cargo_nomina_titular=%s, desc_cargo=%s, 
id_nivel_academico=%s, id_tipo_oficina=%s, id_cargo=%s, id_vinculacion=%s, foto_funcionario=%s, hv_funcionario=%s, 
lider_pqrs=%s where cedula_funcionario=%s and id_cargo!=1",
    
        GetSQLValueString($_POST["nombre_funcionario"], "text"),
		GetSQLValueString($id, "int"),
		GetSQLValueString($_POST["sexo"], "text"),
        GetSQLValueString(trim($_POST["correo_funcionario"]), "text"),
        GetSQLValueString(md5('12345'), "text"),
		GetSQLValueString($_POST["fecha_ingreso"], "date"),
		GetSQLValueString($_POST["profesion"], "text"),
		GetSQLValueString($_POST["telefono"], "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(301, "int"),
		GetSQLValueString(44, "int"),
        GetSQLValueString(44, "int"),
		GetSQLValueString($_POST["cargo"], "text"),
		GetSQLValueString($_POST["id_nivel_academico"], "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(3, "int"),
		GetSQLValueString($_POST["id_vinculacion"], "int"),
        GetSQLValueString('avatar.png', "text"),
		GetSQLValueString($files, "text"),
        GetSQLValueString(0, "int"),
		GetSQLValueString(intval($_POST["cedula_funcionario"]), "text")
      );
      $Resultp = mysql_query($update, $conexion);
      echo $insertado;
///////

    } else {


      $insertSQL = sprintf(
        "INSERT INTO funcionario (cedula_funcionario, nombre_funcionario, id_notaria_f, sexo, correo_funcionario, 
clave_funcionario, fecha_ingreso, profesion, telefono_funcionario, id_rol, id_grupo_area, 
 id_cargo_nomina_encargo, id_cargo_nomina_titular, desc_cargo, 
id_nivel_academico, id_tipo_oficina, id_cargo, id_vinculacion, foto_funcionario, hv_funcionario, 
lider_pqrs, estado_funcionario) 
		VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString(trim($_POST["cedula_funcionario"]), "text"),
        GetSQLValueString($_POST["nombre_funcionario"], "text"),
		GetSQLValueString($id, "int"),
		GetSQLValueString($_POST["sexo"], "text"),
        GetSQLValueString(trim($_POST["correo_funcionario"]), "text"),
        GetSQLValueString(md5('12345'), "text"),
		GetSQLValueString($_POST["fecha_ingreso"], "date"),
		GetSQLValueString($_POST["profesion"], "text"),
		GetSQLValueString($_POST["telefono"], "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(301, "int"),
		GetSQLValueString(44, "int"),
        GetSQLValueString(44, "int"),
		GetSQLValueString($_POST["cargo"], "text"),
		GetSQLValueString($_POST["id_nivel_academico"], "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(3, "int"),
		GetSQLValueString($_POST["id_vinculacion"], "int"),
        GetSQLValueString('avatar.png', "text"),
		GetSQLValueString($files, "text"),
        GetSQLValueString(0, "int"),
        GetSQLValueString(1, "int")
      );
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
      echo $insertado;
    }





}
 else { }

 
 


?>
 

<?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>

	
	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or ""!=$id) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   
Personal de la Notaria

</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">
 <th>Cedula</th>
              <th>Nombre</th>
			   <th>Estado</th>
              <th>Correo</th>
			  <th>Vinculación</th>
			  <th>Fecha de ingreso</th>
			 
              <th></th>  
</tr>
</thead>
<tbody>
<?php 
$query4="SELECT * FROM funcionario, vinculacion where funcionario.id_vinculacion=vinculacion.id_vinculacion and id_notaria_f=".$id." and id_tipo_oficina=3 and estado_funcionario=1 and fecha_ingreso is not null ORDER BY id_funcionario desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {


$id_res=$row['id_funcionario'];

if (3==$row['id_rol']) {
	$namei= 'Activo <a href="personal_notaria&'.$id.'&'.$id_res.'.jsp"><span class="fa fa-trash"></span></a>';
	$subr='';
	$salida='';
} else {
	$namei= 'Inactivo';
	$subr=' style="text-decoration: line-through;" ';
	$salida=' - '.$row['fecha_salida'];
}




echo '<tr>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td '.$subr.'>'.$row['nombre_funcionario'].'</td>';
echo '<td>';
echo $namei;
echo '</td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
echo '<td>'.$row['nombre_vinculacion'].'</td>';
echo '<td>'.$row['fecha_ingreso'].$salida.' </td>';
//echo '<td><a href="filesnr/hv/'.$row['hv_funcionario'].'" target="_blank"><i class="fa fa-file"></i></a></td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"><span class="glyphicon glyphicon-user"></span></a>';


if (1==$_SESSION['rol']) {
		echo ' <a href="nomina_empleado&'.$row['id_funcionario'].'.jsp" target="_blank"><i class="fa fa-file"></i></a>';

} else {}


if (isset($row['hv_funcionario'])) {
	echo ' <a href="filesnr/hv/'.$row['hv_funcionario'].'" target="_blank"><img src="images/pdf.png"></a>';
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
									//'excelHtml5'
									
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


<?php if (1==$_SESSION['rol'] or ""!=$id) { ?>





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
    

    
<form action="" method="POST" name="for54352342aar65464563m1" enctype="multipart/form-data" >


<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CEDULA:</label>
              <input type="text" class="form-control numero" name="cedula_funcionario" required>
            </div>
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label>
              <input type="text" class="form-control" name="nombre_funcionario" required>
            </div>
			
			 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>SEXO:</label>
              <select class="form-control" name="sexo" required>
                <option value="" selected></option>
               <option value="F">Femenino</option>
			    <option value="M">Masculino</option>
				
              </select>
            </div>
			
			
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CORREO:</label>
              <input type="email" class="form-control" name="correo_funcionario" required>
            </div>

<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> TELEFONO:</label>
              <input type="text" class="form-control numero" name="telefono_funcionario" required>
            </div>
			

           <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INGRESO:</label>
              <input type="text" class="form-control datepickera" name="fecha_ingreso" required>
            </div>
			

<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>VINCULACIÓN:</label>
              <select class="form-control" name="id_vinculacion" required>
                <option value="" selected></option>
                      <?php 

$query = sprintf("SELECT * FROM vinculacion where estado_vinculacion=1 and id_vinculacion in (5, 8, 9, 10) order by id_vinculacion"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_vinculacion'].'">'.$row['nombre_vinculacion'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
				?>
              </select>
            </div>
			
           
		   
		   
<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CARGO:</label>
              <input type="text" class="form-control " name="cargo" required>
            </div>
			
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>NIVEL ACADEMICO:</label>
              <select class="form-control" name="id_nivel_academico" required>
                <option value="" selected></option>
                <?php 

$query = sprintf("SELECT * FROM nivel_academico where estado_nivel_academico=1 and id_nivel_academico!=12 order by id_nivel_academico"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_nivel_academico'].'">'.$row['nombre_nivel_academico'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
				?>
              </select>
            </div>


<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> PROFESION:</label>
              <input type="text" class="form-control " name="profesion" required>
            </div>
			

<script>


function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
	
	
	var fsize = 5000;
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
	alert('Debe ser inferior a 5000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}
</script>

<div class="form-group text-left">
<label  class="control-label"> Hoja de vida en PDF:</label> 
<input type="file" name="file" id="file"  onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 5 Mg</span>
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






<!--
<div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Configuración</label></h4>
</div> 
<div class="ver_banner" class="modal-body"> 





</div>
</div> 
</div> 
</div> 
-->


<?php } else { }

} else { echo 'No tiene acceso'; }?>



