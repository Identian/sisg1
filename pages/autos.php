<?php
/*$carp="files/autos/";
chmod($carp,0777);*/
$nump70=privilegios(70,$_SESSION['snr']);

if (3>$_SESSION['snr_tipo_oficina']) { 


if ((isset($_POST["id_archivo"])) && ($_POST["id_archivo"] != "")) { 

$updateSQL = sprintf("UPDATE archivo SET fecha_publicacion=%s, fecha_desfijacion=%s, nombre_archivo=%s, numero_archivo=%s, 
 id_normatividad=%s, codificado=1 where id_archivo=%s and estado_archivo=1",
GetSQLValueString($_POST["fecha_publicacion"], "date"),
GetSQLValueString($_POST["fecha_desfijacion"], "date"),
 GetSQLValueString($_POST["nombre_archivo"], "text"), 
 GetSQLValueString($_POST["numero_archivo"], "int"), 
 GetSQLValueString($_POST["id_normatividad"], "int"), 
 GetSQLValueString($_POST["id_archivo"], "int")
 );
$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;
} else { }


if ((isset($_POST["table"])) && ($_POST["table"] == "autos") && (1==$_SESSION['rol'] or 0<$nump70)) {

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/autos/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'auto-'.$_POST["codigo_oficina"].'-'.date("YmdGis");

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
  
//  echo $_POST["num_autos"].'-'.$_POST["id_tipo_oficina"].'-'.$_POST["codigo_oficina"].'-'.$_POST["nombre_autos"];
  
$insertSQL = sprintf("INSERT INTO archivo (
numero_archivo, codigo_archivo, nombre_archivo, fecha_desfijacion, fecha_publicacion, id_tipo_oficina, codigo_oficina, tipo, carpeta, 
url, id_normatividad, codificado, estado_archivo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["numero_archivo"], "text"), 
GetSQLValueString($_POST["codigo_archivo"], "text"), 
GetSQLValueString($_POST["nombre_archivo"], "text"), 
GetSQLValueString($_POST["fecha_desfijacion"], "date"), 
GetSQLValueString($_POST["fecha_publicacion"], "date"), 
GetSQLValueString($_POST["id_tipo_oficina"], "int"), 
GetSQLValueString($_POST["codigo_oficina"], "int"), 
GetSQLValueString('autos', "text"),
GetSQLValueString('autos', "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"),
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

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existenciaunica('archivo', 'id_normatividad', 1); ?></h3>

              <p>Autos</p>
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
             
 <h3><?php echo existencia('normatividad'); ?></h3>
			  
              <p>Tipos de normatividad</p>
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
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or 0<$nump70) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">

<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="numero_archivo">Expediente</option>
  <option value="codigo_archivo">Matriculas</option>
  <option value="nombre_archivo">Asunto</option>
   <option value="fecha_publicacion">Fecha (YYYY-MM-DD)</option>
<!--<option value="nombre_tipo_oficina">Oficina</option>-->
		  </select>
</div><!-- /btn-group -->
<div class="input-group-btn">
<input type="text" name="buscar" placeholder="" class="form-control" required ></div>
    <!-- /input-group -->
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			<style>


.dataTables_filter {
display:none;
}



.dataTables_paginate {
display:none;
}

			</style> 
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
				  <th>OFICINA</th>
				    <th>EXPEDIENTE</th>
				   <th>MATRICULAS</th>
				    <th>DESFIJACIÓN</th>
				   <th>PUBLICACIÓN</th>
				 
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
 

$query4="SELECT * from archivo where estado_archivo=1 ".$infop." and id_normatividad=1 ORDER BY fecha_publicacion desc  LIMIT 200 OFFSET ".$pagina.""; //

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_archivo'];
echo '<td>';
/*
if (isset($row['codigo_oficina'])){
	echo quees('oficina_registro',$row['codigo_oficina']);
} else { }
*/

if (isset($row['id_tipo_oficina']) && ""!=$row['id_tipo_oficina']) {
	
$idt=$row['id_tipo_oficina'];
$cod=$row['codigo_oficina'];
echo quees('tipo_oficina', $idt);
echo ' / ';

if (1==$idt) {
echo quees('area', $cod);
} else if (2==$idt) {
	echo quees('oficina_registro', $cod);
} else { }
} else { }



echo '</td>';
echo '<td>'.$row['numero_archivo'].'</td>';
echo '<td>'.$row['codigo_archivo'].'</td>';
echo '<td>'.$row['fecha_desfijacion'].'</td>';
echo '<td>'.$row['fecha_publicacion'].'</td>';

echo '<td>';

$resul=intval($row['codificado']);

if (0==$resul) {
	
echo utf8_encode($row['nombre_archivo']);
} else {
	echo $row['nombre_archivo'];
}
echo '</td>';
echo '<td>';
echo ' <a href="files/'.$row['carpeta'].'/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';

	if (1==$_SESSION['rol'] or 0<$nump70) { 
	
	
	echo ' <a href="" class="buscararchivo" id="'.$id_res.'" title="'.$id_res.'" data-toggle="modal" data-target="#popupbuscararchivo"><span class="fa fa-edit"></span></a> &nbsp; ';
	
	
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="archivo" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
							"url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 4, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			
 <?php
/*
 if (isset($_POST['buscar'])) { } else {
	 
$selectfrz = mysql_query("select count(id_autos) as cuenta from autos where estado_autos=1", $conexion);
$rowfrz = mysql_fetch_assoc($selectfrz);
$totalr=$rowfrz['cuenta'];
if (200<$totalr) {
$maxp=$totalr/200;
$maxp2=intval($maxp);
$maxp3=$maxp2*200;
  
 if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
		
		
echo '<hr>Paginación:  &nbsp;  <a href="instrucciones_administrativas.jsp">Inicio</a> &nbsp;  ';

if (200<$pagina) {
$menosp=$pagina-200;
echo ' <a href="instrucciones_administrativas&'.$menosp.'.jsp">Anterior</a> &nbsp;  ';	
} else {
echo '';
}


if ($pagina<$maxp3) {
$masp=$pagina+200;
echo '<a href="instrucciones_administrativas&'.$masp.'.jsp">Siguiente</a> &nbsp; ';
} else {
echo '';
}


echo '<a href="instrucciones_administrativas&'.$maxp3.'.jsp">Final</a> ';
	
		
	 } else {

	 

echo '<hr>Paginación:  &nbsp;  <a href="instrucciones_administrativas&200.jsp">Siguiente</a> &nbsp; 
<a href="instrucciones_administrativas&'.$maxp3.'.jsp">Final</a> ';
		
	 }
	 
} else {}
		 } */
	 ?>
		 
		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol'] or 0<$nump70) { ?>





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
        
<form action="" method="POST" name="for54354r65464563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPO DE OFICINA:</label> 
<select  class="form-control" name="id_tipo_oficina" id="id_tipo_oficina2" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_tipo_oficina, nombre_tipo_oficina FROM tipo_oficina where id_tipo_oficina in (1, 2) and estado_tipo_oficina=1 order by id_tipo_oficina"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_tipo_oficina'].'">'.$row['nombre_tipo_oficina'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 

mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OFICINA:</label> 
<select  class="form-control" name="codigo_oficina" id="listado_oficinas" required>
</select>
</div>




<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>OFICINA DE REGISTRO:</label> 
<select  class="form-control" name="codigo_oficina" required>
<option value="" selected></option>
<?php //echo lista('oficina_registro'); ?>
</select>
</div>-->


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EXPEDIENTE:</label> 
<input type="text" class="form-control" name="numero_archivo"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MATRICULAS:</label> 
<input type="text" class="form-control" name="codigo_archivo"  required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA PUBLICACIÓN:</label> 
<input type="text" class="form-control datepicker" name="fecha_publicacion"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label">FECHA DE DESFIJACIÓN:</label> 
<input type="text" class="form-control datepicker" name="fecha_desfijacion">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ASUNTO / TEMA:</label> 
<textarea class="form-control" name="nombre_archivo" required></textarea>
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
<input type="hidden" name="table" value="autos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>









<div class="modal fade" id="popupbuscararchivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div class="ver_buscararchivo" class="modal-body"> 

</div>
</div> 
</div> 
</div>


<?php } else { }


} else {} ?>



