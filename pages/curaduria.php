<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];



$nump2=privilegios(2,$_SESSION['snr']);
$nump3=privilegios(3,$_SESSION['snr']);


if (isset($_GET["e"]) && ""!=$_GET["e"]) {

$vari=explode('-',$_GET["e"]);
$varuser=$vari[0];
$varestado=$vari[1];
$updateSQL3 = sprintf("UPDATE relacion_curaduria SET 
estado_activo=%s 
where 
id_curaduria=%s and id_relacion_curaduria=%s",
GetSQLValueString($varestado, "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($varuser, "int"));
$Result3 = mysql_query($updateSQL3, $conexion);


$querygvv = sprintf("SELECT id_funcionario FROM relacion_curaduria where id_curaduria=".$id." and id_relacion_curaduria=".$varuser." limit 1");
$selectgvv = mysql_query($querygvv, $conexion);
$rowvv = mysql_fetch_assoc($selectgvv);
$idfunc=$rowvv['id_funcionario'];
mysql_free_result($selectgvv);


$updateSQL3 = sprintf("UPDATE funcionario SET 
fecha_salida=now()  
where id_funcionario=%s", 
GetSQLValueString($idfunc, "int"));
$Result3 = mysql_query($updateSQL3, $conexion);





echo $actualizado;
} else { }







if ((isset($_POST["actualizacion_curaduria"])) && (""!=$_POST["actualizacion_curaduria"]) && (0<$nump3 or 1==$_SESSION['rol'])) { 

if (1==$_POST["id_tipo_nombramiento"]) {
$fecha_actual=$_POST["fecha_acta_posesion"];
//$fecha_terminacion = date('Y-m-d', strtotime('+5 year', strtotime($fecha_actual)));	
$fecha_terminacion=$_POST["fecha_terminacion"];
} else {
$fecha_terminacion=$_POST["fecha_terminacion"];
}



if (2==$_POST["id_tipo_nombramiento"]) {
$fecha_actual=$_POST["fecha_acta_posesion"];
$fecha_terminacion = date('Y-m-d', strtotime('+10 year', strtotime($fecha_actual)));	
} else {
$fecha_terminacion=$_POST["fecha_terminacion"];
}





$identificadora=$id.'-'.$identi;
$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$directoryftp="filesnr/curadurias/";
if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {
$ruta_archivo = $identificadora;
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);
if ($tamano_archivo>=intval($tam_archivo2)) {
if (($extension2==$extension) ) { 
  $files1 = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files1);
  $nombrebre_orig= ucwords($nombrefile);
  } else {
$files1='';	  
 }
} else { 
$files1='';	
		}
} else { 
$files1='';	
	}	






$identificadora2=$id.'-acta'.$identi;
$tamano_archivo2=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo2 = array('pdf');
$directoryftp2="filesnr/curadurias/";
if (isset($_FILES['fileacta']['name']) && ""!=$_FILES['fileacta']['name']) {
$ruta_archivo2 = $identificadora2;
$archivo2 = $_FILES['fileacta']['tmp_name'];
$tam_archivo2= filesize($archivo2);
$tam_archivo22= $_FILES['fileacta']['size'];
$nombrefile2 = strtolower($_FILES['fileacta']['name']);
$info2 = pathinfo($nombrefile2); 
$extension2=$info2['extension'];
$array_archivo2 = explode('.',$nombrefile2);
$extension22= end($array_archivo2);
if ($tamano_archivo2>=intval($tam_archivo22)) {
if (($extension22==$extension2) ) { 
  $filesacta1 = $ruta_archivo2.'.'.$extension2;
  $mover_archivos2 = move_uploaded_file($archivo2, $directoryftp2.$filesacta1);
  $nombrebre_orig2= ucwords($nombrefile2);
  } else {
$filesacta1='';	  
 }
} else { 
$filesacta1='';	
		}
} else { 
$filesacta1='';	
	}	







$updateSQL = sprintf("UPDATE situacion_curaduria SET 
id_funcionario=%s, 
id_curaduria=%s, 
id_tipo_acto=%s, 
nombre_situacion_curaduria=%s, 
modalidad_seleccion=%s, 
entidad_designa=%s, 
id_tipo_nombramiento=%s, 
fecha_nombramiento=%s, 
n_acta_posesion=%s, 
fecha_acta_posesion=%s, 
fecha_terminacion=%s, 
estado_situacion_curaduria=%s, 
experiencia=%s, 
anos_experiencia=%s, 
direccion_notificacion=%s, 
url_nombramiento=%s,  
url_posesion=%s   
where 
id_situacion_curaduria=%s",
GetSQLValueString($_POST["id_funcionario"], "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_tipo_acto"], "int"), 
GetSQLValueString($_POST["nombre_situacion_curaduria"], "text"), 
GetSQLValueString($_POST["modalidad_seleccion"], "text"), 
GetSQLValueString($_POST["entidad_designa"], "text"), 
GetSQLValueString($_POST["id_tipo_nombramiento"], "int"), 
GetSQLValueString($_POST["fecha_nombramiento"], "date"), 
GetSQLValueString($_POST["n_acta_posesion"], "int"), 
GetSQLValueString($_POST["fecha_acta_posesion"], "date"), 
GetSQLValueString($fecha_terminacion, "date"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["experiencia"], "text"), 
GetSQLValueString($_POST["anos_experiencia"], "int"), 
GetSQLValueString($_POST["direccion_notificacion"], "text"), 
GetSQLValueString($files1, "text"), 
GetSQLValueString($filesacta1, "text"), 
GetSQLValueString($_POST["id_situacion_curaduria"], "int"));
$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;
} else { }
	
	
	
	
if ((isset($_POST["table"])) && ($_POST["table"] == "curaduria") && (0<$nump2 or 1==$_SESSION['rol'])) { 
$updateSQL = sprintf("UPDATE curaduria SET nombre_curaduria=%s, 
 telefono_curaduria=%s, celular_curaduria=%s, 
direccion_curaduria=%s,  id_municipio=%s, municipio_exigencia=%s, 
id_departamento=%s, correo_curaduria=%s, 
paginaweb_curaduria=%s, latitud_c=%s, longitud_c=%s where id_curaduria=%s",
GetSQLValueString($_POST["nombre_curaduria"], "text"),  
GetSQLValueString($_POST["telefono_curaduria"], "text"), 
GetSQLValueString($_POST["celular_curaduria"], "text"), 
GetSQLValueString($_POST["direccion_curaduria"], "text"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["municipio_exigencia"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"),  
GetSQLValueString($_POST["correo_curaduria"], "text"), 
GetSQLValueString($_POST["paginaweb_curaduria"], "text"), 
GetSQLValueString($_POST["latitud_c"], "text"), 
GetSQLValueString($_POST["longitud_c"], "text"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;


} else { }
	
	
	


if ((isset($_POST["nueva_situacion"])) && ($_POST["nueva_situacion"] != "") && (0<$nump3 or 1==$_SESSION['rol'])) { 

$querygvv = sprintf("SELECT count(id_situacion_curaduria) as totalc FROM situacion_curaduria where fecha_terminacion is null and id_curaduria=".$id." and estado_situacion_curaduria=1");
$selectgvv = mysql_query($querygvv, $conexion) or die(mysql_error());
$rowvv = mysql_fetch_assoc($selectgvv);
if (1>$rowvv['totalc'] or (isset($_POST["fecha_terminacion"]) and ""!=$_POST["fecha_terminacion"])) { 



if (1==$_POST["id_tipo_nombramiento"]) {
$fecha_actual=$_POST["fecha_acta_posesion"];
$fecha_terminacion = date('Y-m-d', strtotime('+5 year', strtotime($fecha_actual)));	
} else {
$fecha_terminacion=$_POST["fecha_terminacion"];
}



///////////////FILES




$identificadora=$id.'-'.$identi;
$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$directoryftp="filesnr/curadurias/";
if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {
$ruta_archivo = $identificadora;
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);
if ($tamano_archivo>=intval($tam_archivo2)) {
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  $nombrebre_orig= ucwords($nombrefile);
  } else {
$files='';	  
 }
} else { 
$files='';	
		}
} else { 
$files='';	
	}	






$identificadora2=$id.'-acta'.$identi;
$tamano_archivo2=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo2 = array('pdf');
$directoryftp2="filesnr/curadurias/";
if (isset($_FILES['fileacta']['name']) && ""!=$_FILES['fileacta']['name']) {
$ruta_archivo2 = $identificadora2;
$archivo2 = $_FILES['fileacta']['tmp_name'];
$tam_archivo2= filesize($archivo2);
$tam_archivo22= $_FILES['fileacta']['size'];
$nombrefile2 = strtolower($_FILES['fileacta']['name']);
$info2 = pathinfo($nombrefile2); 
$extension2=$info2['extension'];
$array_archivo2 = explode('.',$nombrefile2);
$extension22= end($array_archivo2);
if ($tamano_archivo2>=intval($tam_archivo22)) {
if (($extension22==$extension2) ) { 
  $filesacta = $ruta_archivo2.'.'.$extension2;
  $mover_archivos2 = move_uploaded_file($archivo2, $directoryftp2.$filesacta);
  $nombrebre_orig2= ucwords($nombrefile2);
  } else {
$filesacta='';	  
 }
} else { 
$filesacta='';	
		}
} else { 
$filesacta='';	
	}	







$insertSQL = sprintf("INSERT INTO situacion_curaduria (
id_funcionario, 
id_curaduria, 
id_tipo_acto, 
nombre_situacion_curaduria, 
modalidad_seleccion, 
entidad_designa, 
id_tipo_nombramiento, 
fecha_nombramiento, 
n_acta_posesion, 
fecha_acta_posesion, 
estado_situacion_curaduria, 
experiencia, 
fecha_terminacion, 
anos_experiencia, 
direccion_notificacion, 
url_nombramiento, 
url_posesion 
) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["id_funcionario"], "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_tipo_acto"], "int"), 
GetSQLValueString($_POST["nombre_situacion_curaduria"], "text"), 
GetSQLValueString($_POST["modalidad_seleccion"], "text"), 
GetSQLValueString($_POST["entidad_designa"], "text"), 
GetSQLValueString($_POST["id_tipo_nombramiento"], "int"), 
GetSQLValueString($_POST["fecha_nombramiento"], "date"), 
GetSQLValueString($_POST["n_acta_posesion"], "int"), 
GetSQLValueString($_POST["fecha_acta_posesion"], "date"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["experiencia"], "text"), 
GetSQLValueString($fecha_terminacion, "text"), 
GetSQLValueString($_POST["anos_experiencia"], "int"), 
GetSQLValueString($_POST["direccion_notificacion"], "text"),
GetSQLValueString($files, "text"),
GetSQLValueString($filesacta, "text")

);
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;


} else { echo '<script>alert("Solo debe existir un solo curador sin fecha de terminación");</script>'; }

} else { }
	
	
	
	

  
$query = sprintf("SELECT * FROM curaduria where id_curaduria=".$id." limit 1"); 
$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$totalRows_update = mysql_num_rows($select);
if (0<$totalRows_update){

$name = $row1['nombre_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$municipio_exigencia = $row1['municipio_exigencia'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];

$paginaweb_curaduria = $row1['paginaweb_curaduria'];

if (isset($row1['latitud_c']) && ""!=$row1['latitud_c']) {
$latitud_c = $row1['latitud_c'];
} else {
$latitud_c = '4.61302102';
}


if (isset($row1['longitud_c']) && ""!=$row1['longitud_c']) {
$longitud_c = $row1['longitud_c'];
} else {
$longitud_c = '-74.0718627';
}




$infomun=numero_municipio($id_departamento,$id_municipio);

    if (1 == $_SESSION['rol'] or 0<$nump2) {
    ?>

      <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
            </div>
            <div id="nuevaAventura" class="modal-body">

             
<form action="" method="POST" name="form1">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DE CURADURIA:</label>   
<input type="text" class="form-control" required  name="nombre_curaduria"  required value="<?php echo $name; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CORREO DE CURADURIA:</label>   
<input type="email" class="form-control" required  name="correo_curaduria" value="<?php echo $correo_curaduria; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PAGINA WEB DE LA CURADURIA:</label>   
<input type="text" class="form-control" required  name="paginaweb_curaduria" value="<?php echo $paginaweb_curaduria; ?>">
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TELEFONO DE CURADURIA:</label>   
<input type="text" class="form-control" required  name="telefono_curaduria"  required value="<?php echo $tele; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CELULAR DE CURADURIA:</label>   
<input type="text" class="form-control" required  name="celular_curaduria"  required value="<?php echo $celu; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DIRECCION DE CURADURIA:</label>   
<input type="text" class="form-control" required  name="direccion_curaduria"  required value="<?php echo $dire; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DEPARTAMENTO:</label>   
<select  class="form-control" required  name="id_departamento" id="id_departamento">
<option value=""></option>
<?php echo listapordefecto('departamento', 40, $id_departamento); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MUNICIPIO:</label>   
<select  class="form-control" required  name="id_municipio" id="id_municipio">
<?php if (isset($id_municipio) && ""!=$id_municipio) { ?>
<option value="<?php echo $id_municipio; ?>" selected><?php echo nombre_municipio($id_municipio, $id_departamento); ?></option>
<?php } else {} ?>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EL MUNICIPIO TIENE EXIGENCIAS ESPECIFICAS:</label>   
<select  class="form-control" required  name="municipio_exigencia" >
<option value="<?php echo $municipio_exigencia; ?>" selected><?php echo $municipio_exigencia; ?></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> LATITUD:</label>   
<input type="text" class="form-control" required  name="latitud_c"  required value="<?php echo $latitud_c; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> LONGITUD:</label>   
<input type="text" class="form-control" required  name="longitud_c"  required value="<?php echo $longitud_c; ?>">
</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="curaduria">
<span class="glyphicon glyphicon-ok">
</span> Actualizar</button></div></form>


             

            </div>
          </div>
        </div>
      </div>

    <?php
    } else {
    }


    ?>


   






    <div class="row">
      <div class="col-md-4">


        <div class="box box-primary">
          <div class="box-body box-profile">

            
			<?php 
if (1==$_SESSION['rol'] or (0<$nump2)){ ?>
 &nbsp; <a href=""  data-toggle="modal" data-target="#popup">
<button type="button" class="btn btn-warning btn-xs" >Actualizar</button>
	</a>
<?php } else { }?>
	</div>
	
              <ul class="nav nav-pills nav-stacked">
			 
<li><a ><i class="glyphicon glyphicon-home"></i> Curaduria     <span class="pull-right"> <?php echo $name; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-envelope"></i> <span class="pull-right"> <?php echo $correo_curaduria; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Departamento     <span class="pull-right"><?php echo quees('departamento', $id_departamento); ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Municipio <span class="pull-right"><?php echo nombre_municipio($id_municipio, $id_departamento); ?></span></a></li>

<li><a ><i class="glyphicon glyphicon-map-marker"></i> El Municipio tiene exigencias especificas <span class="pull-right"><?php echo $municipio_exigencia; ?></span></a></li>

<li><a ><i class="glyphicon glyphicon-earphone"></i> Telefono <span class="pull-right"><?php echo $tele; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-phone"></i> Celular <span class="pull-right"><?php echo $celu; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-home"></i> Dirección <span class="pull-right"><?php echo $dire; ?></span></a></li>
 <br><br><li class="list-group-item">
                <b>Geolocalización:</b> <?php echo $latitud_c; ?>, <?php echo $longitud_c; ?>
              </li>

            </ul>



<div id="mapid" style="width: 100%; min-height: 315px;border: 2px #333;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>
<br><br>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

		  <script>

	var mymap = L.map('mapid').setView([<?php echo $latitud_c; ?>, <?php echo $longitud_c; ?>], 12);  // toda colombia 6

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		
	
		maxZoom: 18,
		attribution: 'OpenStreetMap' +
			'' +
			'',
		id: 'open.streets'
	}).addTo(mymap);

	
<?php if ('4.61302102'!=$latitud_c) { ?>
	L.marker([<?php echo $latitud_c; ?>, <?php echo $longitud_c; ?>]).addTo(mymap)
   .bindPopup('<?php echo $name; ?>');
<?php } else {} ?>
   



</script>



          </div>
          <!-- /.box-body -->

        </div>




     
      <!-- /.col -->
      <div class="col-md-8">
        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab"><b>Curador</b></a></li>
          
              <li><a href="#encuesta" data-toggle="tab"><b>Personal</b></a></li>
          
		  <?php if (1==$_SESSION['rol']  or (0<$nump3)){?>
         <li><a href="#settings" data-toggle="tab"><b>Licencias</b></a></li>
          
		   <li><a href="#listado" data-toggle="tab"><b>Lista de elegibles</b></a></li>
          <?php } else {}?>
		  
		   <li><a href="#faltast" data-toggle="tab"><b>Faltas temporales</b></a></li>
		   
		   
		    <li><a href="#faltasa" data-toggle="tab"><b>Faltas absolutas</b></a></li>
			
			
          </ul>

          <div class="tab-content">
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">
<?php
if (1==$_SESSION['rol']  or (0<$nump3)){ ?>
 &nbsp; <a href=""  data-toggle="modal" data-target="#miModal">
<button type="button" class="btn btn-success btn-xs" >+ Nuevo</button>
</a>	 
<?php
 } else {}
 
    

$queryg = sprintf("SELECT * FROM situacion_curaduria, tipo_acto where situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto and id_curaduria=".$id." and estado_situacion_curaduria=1");
$selectg = mysql_query($queryg, $conexion);
$rowcc = mysql_fetch_assoc($selectg);
$totalRows_regg = mysql_num_rows($selectg);

if (0<$totalRows_regg) { 


?>



<table id="lista" class="table  table-bordered"><thead>
<tr align='center' valign='middle'>
<th>CURADOR</th>
<th>TIPO DE ACTO</th>
<th>NÚMERO DE ACTO</th>
<th>NOMBRAMIENTO</th>
<th>POSESION</th>
<th>FECHA-TERMINACION</th>
<th></th>
<th style="width:100px;"></th>
</tr></thead><tbody>
<?php
if (0<$totalRows_regg) {
do {
	echo '<tr>';
echo '<td>';
echo quees('funcionario', $rowcc['id_funcionario']);
echo '</td>';
echo '<td>'.$rowcc['nombre_tipo_acto'].'</td>';
echo '<td>'.$rowcc['nombre_situacion_curaduria'].'</td>';
echo '<td>'.$rowcc['fecha_nombramiento'].'</td>';
echo '<td>'.$rowcc['fecha_acta_posesion'].'</td>';
echo '<td>';
if (isset($rowcc['fecha_terminacion']) and ""!=$rowcc['fecha_terminacion']) {
	echo $rowcc['fecha_terminacion'];
} else {
	echo '<span class="btn btn-xs btn-primary"> Activo</span>';
}

$fechaac=date('Y-m-d');
if ($rowcc['fecha_acta_posesion']<=$fechaac && $rowcc['fecha_terminacion']>=$fechaac) {
	$userc=$rowcc['id_funcionario'];
} else {}


echo '</td>';

echo '<td style="width:70px;">';

if (isset($rowcc['url_nombramiento'])) {
	echo '  &nbsp; <a title="Decreto de nombramiento" href="filesnr/curadurias/'.$rowcc['url_nombramiento'].'" ><span class="fa fa-file" ></span></a> &nbsp; ';
} else {}

if (isset($rowcc['url_posesion'])) {
	echo '  &nbsp; <a title="Acta de posesion" href="filesnr/curadurias/'.$rowcc['url_posesion'].'" ><span class="fa fa-file" style="color:#C5903D;"></span></a> &nbsp; ';
} else { }
	echo '</td>';



echo '<td>';


 if (1==$_SESSION['rol'] or 0<$nump3) { 
 echo '<a href="usuario&'.$rowcc['id_funcionario'].'.jsp"><span class="glyphicon glyphicon-user"></span></a> ';
 } else {}
 
 $percur=permisopruebacuraduria($id);
 if (0<$percur) {
	 

echo '<a  href="documentos&'.$rowcc['id_funcionario'].'&'.$id.'.jsp"><span class="glyphicon glyphicon-file" style="color:#E08E0B;"></span></a> ';
 } else {}

 if (1==$_SESSION['rol'] or 0<$nump3) { 
echo '<a  href="" id="'.$rowcc['id_situacion_curaduria'].'" class="actualizar_situacionc" data-toggle="modal" data-target="#actualizarsituacion"><i class="glyphicon glyphicon-pencil"></i></a>';
 } else { }
  
  echo '</td></tr>';


} while ($rowcc = mysql_fetch_assoc($selectg));
mysql_free_result($selectg);

} else {}

echo '</tbody></table>';

}
mysql_free_result($select);
  
?>           




                  </div>
                </div>
              </div>
            </div>





           
              <div class="tab-pane" id="encuesta">

                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                    <?php 





function experienciac($user) {
	
global $mysqli;
$profesional=array();
$relacionada=array();

$query4="select * from documento_funcionario, tipo_adjunto, tipo_subadjunto where tipo_adjunto.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and documento_funcionario.id_tipo_subadjunto=tipo_subadjunto.id_tipo_subadjunto and documento_funcionario.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and id_funcionario=".$user." and estado_documento_funcionario=1 ";
$result = $mysqli->query($query4);

while($row = $result->fetch_array()) {
	
	
	      if (isset($row['fecha_inicial']) && isset($row['fecha_documento'])) {
               
                $ani= calculatiempo($row['fecha_inicial'], $row['fecha_documento']);
               
              } else if (isset($row['fecha_documento'])) {
               
                $ani= calculaedad($row['fecha_documento']);
              
              } else {
				 $ani=0;
              }
			  
	
	
If (isset($row['computa']) && 1==intval($row['estado_rev'])) {
If ('Si'==$row['computa']) {
	array_push($relacionada, $ani);
} else {
	array_push($profesional, $ani);
}
} else {}


 } 
 
 $result->free();
			
$pro=array_sum($profesional);
$rel=array_sum($relacionada);
			
$infor='Experiencia profesional: '.$pro.' años <br>Experiencia relacionada: '.$rel.' años '; 
			
return $infor;		
}


 if (0<$percur) {
	 echo '<a href="personal_curaduria&'.$id.'.jsp" class="btn btn-xs btn-success">+ Personal</a><br>';
 }




if (1==$_SESSION['snr_tipo_oficina']) {
$selectu = mysql_query("SELECT id_curador, profesion, funcionario.id_funcionario, nombre_funcionario, estado_activo, tipo_relacion, requisitos_curaduria, id_relacion_curaduria 
 FROM relacion_curaduria, funcionario where relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_curaduria=".$id." and estado_relacion_curaduria=1  ", $conexion);
} else {
	$selectu = mysql_query("SELECT id_curador, profesion, funcionario.id_funcionario, nombre_funcionario, estado_activo, tipo_relacion, requisitos_curaduria, id_relacion_curaduria 
 FROM relacion_curaduria, funcionario where relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_curaduria=".$id." and relacion_curaduria.id_curador=".$_SESSION['snr']." and estado_relacion_curaduria=1 ", $conexion);
}



$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
if (0<$totalRowsu){
	echo '<table class="table table-bordered"><tr><th>Nombre</th>
	<th>Cumple requisitos como curador</th>
	<th>Relación</th><th>Asociado a</th><th>Profesión</th>
	<th>Formación</th><th>Experiencia</th><th></th></tr>';
do {

$idfun=$rowu['id_funcionario'];

echo '<tr>';

	
	
	echo '<td>'.$rowu['nombre_funcionario'].' </td>
	<td> '.$rowu['requisitos_curaduria'].' </td>';
	
	echo '<td>'.$rowu['tipo_relacion'].'</td>';
	
	echo '<td>';
	
	if (isset($rowu['id_curador']) && ""!=$rowu['id_curador']) {
		echo quees('funcionario',$rowu['id_curador']);
	} else {}
		echo '</td>';
	
	echo '<td>'.$rowu['profesion'].'</td>';

	
	echo '<td>';
	$selectuq = mysql_query("SELECT nombre_nivel_academico FROM  documento_funcionario, nivel_academico 
	where 
	nivel_academico.id_nivel_academico=documento_funcionario.id_nivel_academico  
	 and id_funcionario=".$idfun." and estado_rev=1 and estado_nivel_academico=1 order by nivel_academico.id_nivel_academico desc", $conexion);
$rowuq = mysql_fetch_assoc($selectuq);
$totalRowsuq = mysql_num_rows($selectuq);
if (0<$totalRowsuq){

do {

echo ''.$rowuq['nombre_nivel_academico'].' / ';



 } while ($rowuq = mysql_fetch_assoc($selectuq)); 

} else { } 
mysql_free_result($selectuq);

echo '</td>';




echo '<td>';
echo experienciac($idfun);
echo '</td>';




echo '<td>';

 if (1==$_SESSION['rol'] or 0<$nump3) { 
echo '<a href="usuario&'.$idfun.'.jsp" target="_blank"><span class="fa fa-user"></span></a>';
 } else {}
 
 
echo ' <a href="documentos&'.$idfun.'&'.$id.'.jsp" target="_blank"><span class="fa fa-file"></span></a> ';



if (1==$_SESSION['rol'] or 0<$nump3 or (1==$_SESSION['snr_grupo_cargo'] && 4==$_SESSION['snr_tipo_oficina'])) { 

if (1==$rowu['estado_activo']) { 
	echo ' <a href="curaduria&'.$id.'&'.$rowu['id_relacion_curaduria'].'-0.jsp">Activo</a> ';
} else {
	echo ' <a href="curaduria&'.$id.'&'.$rowu['id_relacion_curaduria'].'-1.jsp">Inactivo</a> ';
}

} else {
	
	
	
	
}
	

if (1==$_SESSION['rol'] or 0<$nump3) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="relacion_curaduria" id="'.$rowu['id_relacion_curaduria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	echo '</td>';
	echo '</tr>';
	
	
	
	
	
	
	


 } while ($rowu = mysql_fetch_assoc($selectu)); 
 echo '</table>';
} else {  } 
mysql_free_result($selectu);








?>
 
            

                    </div>
                  </div>
                </div>
              </div>
          

  <?php if (1==$_SESSION['rol']  or (0<$nump3)){?>

            <div class="tab-pane" id="settings">

                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                    <div id="chart" style="width:100%"></div>
		
                   

                    </div>
                  </div>
                </div>
              </div>






<div class="tab-pane" id="listado">

                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                   
 <?php 

 echo '<a href="lista_elegibles_curadurias.jsp">Listas de elegibles</a>';

 echo '<br><a href="control_lista_elegibles.jsp">Control de listas de elegibles</a>';


 /*
$selectu = mysql_query("SELECT * FROM curador_elegible, funcionario, municipio where curador_elegible.id_funcionario=funcionario.id_funcionario and curador_elegible.codigo_municipio=".$id_municipio." and curador_elegible.id_departamento=".$id_departamento." and curador_elegible.codigo_municipio=municipio.codigo_municipio and curador_elegible.id_departamento=municipio.id_departamento and estado_curador_elegible=1 ", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);

if (0<$totalRowsu){
	
	
	echo '<table class="table"><tr><td>Usuario</td><td>Convocatoria</td><td>Municipio</td><td>Porcentaje</td><td>Documento</td><td>Estado</td><td></td></tr>';
do {

echo '<tr>';

	
	echo ' <td>'.$rowu['nombre_funcionario'].' </td>
	<td>'.$rowu['nombre_curador_elegible'].' </td>
	<td>'.$rowu['nombre_municipio'].' </td>
	<td>'.$rowu['porcentaje'].'</td>
	<td>
	<a href="filesnr/elegibles/'.$rowu['documento_curador_elegible'].'" target="_blank">
	Documento</a></td><td>';
	


$querygs = sprintf("SELECT count(id_funcionario) as total FROM situacion_curaduria, tipo_acto where situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto  and id_funcionario=".$rowu['id_funcionario']." and estado_situacion_curaduria=1 AND fecha_acta_posesion<='$realdate' AND fecha_terminacion>='$realdate' ");
$selectgs = mysql_query($querygs, $conexion);
$rowccs = mysql_fetch_assoc($selectgs);
if (0<$rowccs['total']) {
	echo 'En funciones';
} else {
	echo 'Sin funciones';
}
mysql_free_result($selectgs);


	
	echo '</td><td><a href="usuario&'.$rowu['id_funcionario'].'.jsp" target="_blank">
	<span class="fa fa-user"></span></a></td></tr>';


 } while ($rowu = mysql_fetch_assoc($selectu)); 
 echo '</table>';
} else { } 
mysql_free_result($selectu);


*/
?>


                    </div>
                  </div>
                </div>
              </div>
<?php } else {} ?>









<div class="tab-pane" id="faltast">

                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                   
 <?php 

 if (0<$percur or 1==$_SESSION['rol'] or 0<$nump3) {
	 //if (1==$_SESSION['rol'] or 0<$nump3) {

if (isset($_POST['tipo_falta']) && ""!=$_POST['tipo_falta']) {


$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/faltascuradurias/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'falta-'.$_SESSION['snr'].'-'.$identi;

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
  
 



$insertSQL44 = sprintf("INSERT INTO faltas_curaduria 
(id_curaduria, id_funcionario, tipo_falta, tipo_documento, nombre_faltas_curaduria, acto, fecha_acto, url, fecha_iniciof, 
fecha_termina, encargadoc, estado_faltas_curaduria) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_funcionarioc"], "int"), 
GetSQLValueString($_POST["tipo_falta"], "int"), 
GetSQLValueString($_POST["tipo_documento"], "text"), 
GetSQLValueString($_POST["nombre_faltas_curaduria"], "text"), 
GetSQLValueString($_POST["acto"], "text"), 
GetSQLValueString($_POST["fecha_acto"], "date"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST["fecha_iniciof"], "date"), 
GetSQLValueString($_POST["fecha_termina"], "date"), 
GetSQLValueString($_POST["encargado"], "text"), 
GetSQLValueString(1, "int"));
$Result4 = mysql_query($insertSQL44, $conexion);
echo $insertado;

echo $insertSQL44;

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






	 ?>
	 
	 <a href=""  data-toggle="modal" data-target="#miModalft">
<button type="button" class="btn btn-success btn-xs" >+ Nuevo</button>
</a>

<br>

 
 <?php 
 
 if (1==$_SESSION['snr_tipo_oficina']) {
 
$selectu = mysql_query("SELECT * FROM faltas_curaduria, funcionario where tipo_falta=1 and faltas_curaduria.id_funcionario=funcionario.id_funcionario and faltas_curaduria.id_curaduria=".$id." and estado_faltas_curaduria=1 order by fecha_acto", $conexion);
 } else {
$selectu = mysql_query("SELECT * FROM faltas_curaduria, funcionario where tipo_falta=1 and faltas_curaduria.id_funcionario=funcionario.id_funcionario and faltas_curaduria.id_curaduria=".$id." and faltas_curaduria.id_funcionario=".$_SESSION['snr']." and estado_faltas_curaduria=1 order by fecha_acto", $conexion);
 	 
 }



$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
if (0<$totalRowsu){
	echo '<table class="table table-bordered"><tr><td>Usuario</td><td>Tipo</td><td>Acto</td><td>Fecha del acto</td><td>Fecha inicio</td><td>Fecha terminación</td><td>Encargado</td><td>File</td><td></td></tr>';
do {
echo '<tr>';
echo ' <td>'.$rowu['nombre_funcionario'].' </td><td>'.$rowu['nombre_faltas_curaduria'].'</td><td>'.$rowu['acto'].' </td>
<td>'.$rowu['fecha_acto'].' </td>
<td>'.$rowu['fecha_iniciof'].' </td>
 <td>'.$rowu['fecha_termina'].' </td>
 
 <td>'.$rowu['encargadoc'].' </td>
 
  <td><a href="filesnr/faltascuradurias/'.$rowu['url'].'" target="_blank"><i class="fa fa-file"></i></a> </td>';
  
 
 if (1==$_SESSION['rol'] or 0<$nump3) { 
 echo '<td>';
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="faltas_curaduria" id="'.$rowu['id_faltas_curaduria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	echo '</td>';
	} else {}
	
 
echo '</tr>';
 } while ($rowu = mysql_fetch_assoc($selectu)); 
 echo '</table>';
} else { } 
mysql_free_result($selectu);
  } else {}
?>


                    </div>
                  </div>
                </div>
              </div>
			  
			  
			  
			  
			  
			  <div class="tab-pane" id="faltasa">

                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                   

 <?php 

 if (1==$_SESSION['rol'] or 0<$nump3) {
	 
 // if (1==$_SESSION['rol'] or 0<$nump3) { ?>
 
 
 	 <a href=""  data-toggle="modal" data-target="#miModalfa">
<button type="button" class="btn btn-success btn-xs" >+ Nuevo</button>
</a>
<br>

 
 <?php
 } else {}

 
  if (1==$_SESSION['snr_tipo_oficina']) {
$selectu = mysql_query("SELECT * FROM faltas_curaduria, funcionario where tipo_falta=2 and faltas_curaduria.id_funcionario=funcionario.id_funcionario and faltas_curaduria.id_curaduria=".$id." and estado_faltas_curaduria=1 ", $conexion);
  } else {
$selectu = mysql_query("SELECT * FROM faltas_curaduria, funcionario where tipo_falta=2 and faltas_curaduria.id_funcionario=funcionario.id_funcionario and faltas_curaduria.id_curaduria=".$id." and faltas_curaduria.id_funcionario=".$_SESSION['snr']." and estado_faltas_curaduria=1 ", $conexion);
  }


 

 





$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
if (0<$totalRowsu){
	echo '<table class="table table-bordered"><tr><td>Usuario</td><td>Tipo</td><td>Soporte</td><td>Fecha</td><td>File</td><td></td></tr>';
do {
echo '<tr>';
echo ' <td>'.$rowu['nombre_funcionario'].' </td><td>'.$rowu['nombre_faltas_curaduria'].'</td>

<td>'.$rowu['tipo_documento'].' </td>
<td>'.$rowu['fecha_iniciof'].' </td>

 
   <td><a href="filesnr/faltascuradurias/'.$rowu['url'].'" target="_blank"><i class="fa fa-file"></i></a> </td>';
  
  
 
 if (1==$_SESSION['rol'] or 0<$nump3) { 
 echo '<td>';
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="faltas_curaduria" id="'.$rowu['id_faltas_curaduria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	echo '</td>';
	} else {}
	
 
echo '</tr>';
 } while ($rowu = mysql_fetch_assoc($selectu)); 
 echo '</table>';
} else { } 
mysql_free_result($selectu);


?>


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












<?php
if ((1==$_SESSION['rol']) or 0<$nump3) { 
?>


<div class="modal fade" id="actualizarsituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Actualizar situación</h4>
      </div>
      <div class="modal-body" id="ver_situacionc">
	  
	 
	  </div> 
</div> 
</div> 
</div> 
	  
	  
	  

 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva situación</h4>
      </div>
      <div class="modal-body">
	  



<form action="" method="POST" name="form1" enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> <span style="color:#ff0000;">*</span> CURADOR:</label> 
<select  class="form-control" required  name="id_funcionario" required>
<option value="" selected></option>
<?php 
$query = sprintf("SELECT id_funcionario, nombre_funcionario, nombre_cargo FROM funcionario, cargo where funcionario.id_cargo=cargo.id_cargo and estado_funcionario=1 and id_tipo_oficina=4 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].' - '.$row['nombre_cargo'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ACTO DE NOMBRAMIENTO:</label> 
<select  class="form-control" required  name="id_tipo_acto" >
<option value="" selected></option>
<?php echo  lista('tipo_acto'); ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DECRETO DE ACTO DE NOMBRAMIENTO:</label> 
<input type="file" class="form-control" required  name="file" >
</div>




<div class="row">
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE ACTO:</label> 
<input type="text" class="form-control numero" name="nombre_situacion_curaduria"  >
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE NOMBRAMIENTO:</label> 
<input type="text" readonly="readonly" class="form-control datepickera" name="fecha_nombramiento"   >
</div>
</div>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MODALIDAD DE SELECCIÓN:</label> 
<select class="form-control" required  name="modalidad_seleccion"  >
<option value="" selected></option>
<option value="Concurso - Municipio">Concurso - Municipio</option>
<option value="Concurso - Distrito">Concurso - Distrito</option>
<option value="Concurso - SNR">Concurso - SNR</option>
<option value="Libre nombramiento - Alcalde">Libre nombramiento - Alcalde</option>
<option value="Libre nombramiento - Secretaria de planeación">Libre nombramiento - Secretaria de planeación</option>
<option value="Otro">Otro</option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ENTIDAD QUE DESIGNA:</label> 
<select class="form-control" required  name="entidad_designa">
<option value="" selected></option>
<option value="Concurso del distrito">Alcaldia</option>
<option value="Municipio">Municipio</option>
<option value="Municipio">Secretaria de Planeación</option>
</select>
</div>

<script>
function cur_nombra_propiedad() {
	
	var cura= document.getElementById("cura_nombra_propiedad").value;
	if (1==cura) {
		document.getElementById("termina").style="display:none;";
	} else {
		
	}
}

</script>

<div class="form-group text-left"> 
<label  class="control-label"> <span style="color:#ff0000;">*</span> TIPO DE NOMBRAMIENTO:</label> 
<select  class="form-control" required  required name="id_tipo_nombramiento" id="cura_nombra_propiedad" onchange="cur_nombra_propiedad();">
<option value="" selected></option>
<?php echo  lista('tipo_nombramiento'); ?>
</select>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO - ACTA DE POSESIÓN:</label> 
<input type="text" class="form-control numero" name="n_acta_posesion" >
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA - ACTA DE POSESIÓN:</label> 
<input type="text" readonly="readonly" class="form-control datepickera" name="fecha_acta_posesion" required  >
</div>
</div>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO DEL ACTA DE POSESION:</label> 
<input type="file" class="form-control" required  name="fileacta" >
</div>





<div class="form-group text-left" id="termina" style=""> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE TERMINACIÓN:</label> 
<input type="date"  class="form-control " name="fecha_terminacion" value=""  >
</div>







<input type="hidden"  class="form-control" required  name="nueva_situacion" value="1"  >
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success"><input type="hidden" name="table" value="situacion_curaduria"><span class="glyphicon glyphicon-ok">
</span> Crear </button></div></form>



</div>
</div> 
</div> 
</div> 



<?php } else { } ?>


	




<?php
					
$select = mysql_query("select count(id_licencia_curaduria) as total from licencia_curaduria where licencia_curaduria.id_curaduria=".$id." and estado_licencia_curaduria=1 and situacion_licencia=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows=intval($row['total']);
mysql_free_result($reghtp);


$select = mysql_query("select count(licencia_cerrada) as totale from licencia_curaduria where licencia_curaduria.id_curaduria=".$id." and estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$tramite=intval($row['totale']);
mysql_free_result($select);



$todas=intval($totalRows);

$cerradas=intval($tramite);

 
?>					
							
							
<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php  echo $todas; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "Licencias: <?php echo $todas; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Finalizadas:  <?php  echo $cerradas; ?>", <?php echo $cerradas; ?>],
            ["Pendiente de finalizar: <?php $pendientes=$todas-$cerradas; echo $pendientes; ?>", <?php echo $pendientes; ?>],
        ]
    });
}, 1500);

setTimeout(function () {
    chart.unload({
        ids: 'data1'
    });
    chart.unload({
        ids: 'data2'
    });
}, 1500);
}
</script>


















	
		





 <div class="modal fade" id="actualizarsituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Situación administrativa</h4>
          </div>
          <div class="modal-body" id="resultadoposesion">


          </div>
        </div>
      </div>
    </div>
	
	
	

    <div class="modal fade" id="updatesituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Situación administrativa</h4>
          </div>
          <div class="modal-body" id="resultadoactposesion">


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




      <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva situación</h4>
            </div>
            <div class="modal-body">

            
            </div>
          </div>
        </div>
      </div>
	  
	  
	  

    <div class="modal fade" id="popupcontrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><label class="control-label"><span style="color:#ff0000;">*</span> Reactivación de ORIP / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
          </div>
          <div class="modal-body">
           

            </form>
          </div>
        </div>
      </div>
    </div>










    <div class="modal fade" id="popupsuministros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><label class="control-label"><span style="color:#ff0000;">*</span> Suministros / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
          </div>
          <div class="modal-body">

            
            
          </div>
        </div>
      </div>
    </div>















    <div class="modal fade" id="popuplocativas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><label class="control-label"><span style="color:#ff0000;">*</span> Aspectos locativos / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
          </div>
          <div class="modal-body">



          </div>
        </div>
      </div>
    </div>


  
  
  
  
   <div class="modal fade" id="miModalft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva falta temporal</h4>
      </div>
      <div class="modal-body">
	  
	  
	   <form action=""  method="post" name="454454335" id="435345435" enctype="multipart/form-data">
	   
	   Curador: 
 
 <?php if (isset($userc) && ""!=$userc && 0!=$userc) {
	 echo quees('funcionario',$userc); 
 } else { echo '<span style="color:#B40404">No se encontro curador vigente.</span>';}
 ?>
 <br>
 Tipo de falta: 
 <select class="form-control" name="nombre_faltas_curaduria" placeholder="Tipo de falta" required> 
 <option></option>
<option>Licencia Temporal</OPTION>
<option>Suspensión Provisional</option>
 </select>
 <br>Acto administrativo: 
  <input type="text" class="form-control" name="acto" required placeholder="Número de acto"> 

   <br>Fecha del acto administrativo: 
  <input type="text" class="form-control datepicker" name="fecha_acto" required > 
  <br>
  Documento soporte: 
   <input type="file" class="form-control" required name="file" > 
  <br>
   Encargado: <select class="form-control" required name="encargado" >
<option></option>
 <?php 
$selectu = mysql_query("SELECT funcionario.id_funcionario, nombre_funcionario, estado_activo, tipo_relacion, requisitos_curaduria, id_relacion_curaduria 
 FROM relacion_curaduria, funcionario where  relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_curaduria=".$id." and estado_relacion_curaduria=1 ", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
if (0<$totalRowsu){
do {
echo '<option>'.$rowu['nombre_funcionario'].'</option>';
 } while ($rowu = mysql_fetch_assoc($selectu)); 
} else {  } 
mysql_free_result($selectu);
?>
</select>

<br>   Fecha inicial: 
    <input type="text" class="form-control datepicker" required name="fecha_iniciof" > <br>
	Fecha terminación: 
	 <input type="text" class="form-control  datepicker" required name="fecha_termina" > <br>
	 
	  <?php if (isset($userc) && ""!=$userc && 0!=$userc) {
	?>
	 <input type="submit" class="btn btn-success" value="Agregar">
	<?php
 } else { echo '<span style="color:#B40404">No se encontro curador vigente.</span>';}
 ?>
 
	 
	
 <input type="hidden" name="tipo_falta" value="1">
  <input type="hidden" name="id_funcionarioc" value="<?php echo $userc; ?>">

 
 </form>
 
 </div>
        </div>
      </div>
    </div>








 <div class="modal fade" id="miModalfa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva falta absoluta</h4>
      </div>
      <div class="modal-body">
	  
	  
	  
<form action="" method="post" name="45435" id="435435" enctype="multipart/form-data">
   Curador: 
 
<?php if (isset($userc) && ""!=$userc && 0!=$userc) {
	 echo quees('funcionario',$userc); 
 } else { echo '<span style="color:#B40404">No se encontro curador vigente.</span>';}
 ?>
 <br>
 Tipo de falta: 
 <select name="nombre_faltas_curaduria" class="form-control" required> 
<option></option>

<option>Renuncia del cargo</option>
<option>Destitución del cargo</option>
<option>Incapacidad médica mayor 180 días</option>
<option>Muerte</option>
<option>Inhabilidad sobreviviente</option>
<option>Abandono injustificado del cargo</option>
<option>Orden o decisión judicial</option>
<option>Vencimiento del periodo</option>
</select>


 <!--  Designación: 
   <br>
   <select name="encargado" class="form-control" required> 
   <option></option>
 <optgroup label="Personal de la Curaduria">
    <?php 
	/*
$selectu = mysql_query("SELECT funcionario.id_funcionario, nombre_funcionario, estado_activo, tipo_relacion, requisitos_curaduria, id_relacion_curaduria 
 FROM relacion_curaduria, funcionario where requisitos_curaduria='Si' and relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_curaduria=".$id." and estado_relacion_curaduria=1 ", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
if (0<$totalRowsu){
do {
echo '<option>'.$rowu['nombre_funcionario'].'</option>';
 } while ($rowu = mysql_fetch_assoc($selectu)); 
} else {  } 
mysql_free_result($selectu);


echo '</optgroup><optgroup label="En propiedad / Personal de lista de elegibles">';


$selectu = mysql_query("SELECT * from funcionario, elegible_curaduria, municipio where 
funcionario.cedula_funcionario=elegible_curaduria.elegible and 

elegible_curaduria.id_municipio=municipio.id_municipio and  municipio.id_municipio=".$infomun." and estado_elegible_curaduria=1  ", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
if (0<$totalRowsu){
do {
echo '<option value="'.$rowu['id_funcionario'].'">'.$rowu['nombre_funcionario'].'</option>';
 } while ($rowu = mysql_fetch_assoc($selectu)); 
} else {  } 
mysql_free_result($selectu);
*/
?>
</optgroup>
<optgroup label="Otro">
<option value="0">Otro</option>
</optgroup>
   </select>
   
   
      <BR>
    <input type="text" name="otro" class="form-control" style="display:display;" id="otro" placeholder="En caso de otro"> 
-->



      <BR>Identificación del tipo de documento
    <input type="text" name="tipo_documento" class="form-control" > 
	

   <BR>Fecha del acto administrativo: 
    <input type="text" name="fecha_iniciof" class="form-control datepicker" required> 
 <br>
 Documento soporte: 
   <input type="file" class="form-control" required name="file" > 
 
 <br>
	
		  <?php if (isset($userc) && ""!=$userc && 0!=$userc) {
	?>
	 <input type="submit" class="btn btn-success" value="Agregar">
	<?php
 } else { echo '<span style="color:#B40404">No se encontro curador vigente.</span>';}
 ?>
 
 <input type="hidden" name="tipo_falta" value="2">
  <input type="hidden" name="id_funcionarioc" value="<?php echo $userc; ?>">
 </form>
 
 
 </div>
        </div>
      </div>
    </div>
	
	
<?php
  }
}
?>