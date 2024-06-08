 <?php
if (isset($_GET['i']) && "" != $_GET['i']) {
$id = $_GET['i'];

$nump4=privilegios(4,$_SESSION['snr']);
$nump5=privilegios(5,$_SESSION['snr']);
$nump6=privilegios(6,$_SESSION['snr']);
$nump18=privilegios(18,$_SESSION['snr']);
$nump97=privilegios(97,$_SESSION['snr']);
$nump104=privilegios(104,$_SESSION['snr']);






if (isset($_POST['id_municipio_notaria']) && ""!=$_POST['id_municipio_notaria']) {
$infomun=explode("-", $_POST['id_municipio_notaria']);
	$dep=$infomun[0];
	$mun=$infomun[1];
	 $insertSQL = sprintf(
      "INSERT INTO municipio_notaria (
        id_notaria, id_departamento, codigo_municipio, 
        estado_municipio_notaria) VALUES (%s,%s, %s, %s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString($dep, "int"),
       GetSQLValueString($mun, "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
    mysql_free_result($Result);

}



if ((isset($_POST["nombre_soporte_posesion_notaria"])) && (""!=$_POST["nombre_soporte_posesion_notaria"])) { 


$identificadora=$id.$_POST["id_posesion_notaria"].$identi;
$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/soporteposesion/";




if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = $identificadora;

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
  
  

$insertSQL = sprintf("INSERT INTO soporte_posesion_notaria (id_posesion_notaria, 
nombre_soporte_posesion_notaria, url_soporte, fecha_soporte_posesion_notaria, 
estado_soporte_posesion_notaria) VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($_POST["id_posesion_notaria"], "int"), 
GetSQLValueString($_POST["nombre_soporte_posesion_notaria"], "text"), 
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
  
 
} else { }









if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && (0<$nump5 or 1==$_SESSION['rol'])) {
 $updateSQL = sprintf("UPDATE posesion_notaria SET forma_ingreso=%s, fecha_inicio=%s, 
 acto_nombramiento=%s, numero_nombramiento=%s, fecha_nombramiento=%s, nominador=%s, 
 acto_confirmacion=%s, acto_conf_numero=%s, acto_conf_fecha=%s, acto_conf_autoridad=%s, 
 acta_pose_numero=%s, acto_pose_fecha=%s, autoridad_pose=%s, acto_pose_f_fiscales=%s, fecha_rec_notaria=%s, 
 causal_retiro=%s, fecha_retiro=%s, fecha_fin=%s, autoridad_ret=%s, t_doc_ret=%s, 
 n_doc_ret=%s, fecha_doc_ret=%s, n_acta_entrega=%s WHERE id_posesion_notaria=%s",

                       GetSQLValueString($_POST['forma_ingreso'], "text"),
 
                       GetSQLValueString($_POST['fecha_inicio'], "date"),
                       GetSQLValueString($_POST['acto_nombramiento'], "text"),
                       GetSQLValueString($_POST['numero_nombramiento'], "int"),
                       GetSQLValueString($_POST['fecha_nombramiento'], "date"),
                       GetSQLValueString($_POST['nominador'], "text"),
                       GetSQLValueString($_POST['acto_confirmacion'], "text"),
                       GetSQLValueString($_POST['acto_conf_numero'], "int"),
                       GetSQLValueString($_POST['acto_conf_fecha'], "date"),
                       GetSQLValueString($_POST['acto_conf_autoridad'], "text"),
                       GetSQLValueString($_POST['acta_pose_numero'], "int"),
                       GetSQLValueString($_POST['acto_pose_fecha'], "date"),
					     GetSQLValueString($_POST['autoridad_pose'], "text"),
                       GetSQLValueString($_POST['acto_pose_f_fiscales'], "date"),
                       GetSQLValueString($_POST['fecha_rec_notaria'], "date"),
                       GetSQLValueString($_POST['causal_retiro'], "text"),
                       GetSQLValueString($_POST['fecha_retiro'], "date"),
                       GetSQLValueString($_POST['fecha_fin'], "date"),
                       GetSQLValueString($_POST['autoridad_ret'], "text"),
                       GetSQLValueString($_POST['t_doc_ret'], "text"),
                       GetSQLValueString($_POST['n_doc_ret'], "int"),
                       GetSQLValueString($_POST['fecha_doc_ret'], "date"),
                       GetSQLValueString($_POST['n_acta_entrega'], "int"),
					   GetSQLValueString($_POST['id_posesion_notaria'], "int"));
					   


  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;
}




if ((isset($_POST["table"])) && ($_POST["table"] == "notaria") && (0<$nump4 or 1==$_SESSION['rol'])) { 
$updateSQL = sprintf("UPDATE notaria SET direccion_notaria=%s, telefono_notaria=%s, email_notaria=%s, 
id_oficina_registro=%s, id_categoria_notaria=%s, sin=%s, subsidiada=%s, ultima_visita=%s, sabado=%s, horario_notaria=%s, latitud=%s, longitud=%s, 
acto_creacion=%s, numero_acto=%s, fecha_acto=%s, reparto=%s where id_notaria=%s",
GetSQLValueString($_POST["direccion_notaria"], "text"), 
GetSQLValueString($_POST["telefono_notaria"], "text"), 
GetSQLValueString($_POST["email_notaria"], "text"), 
GetSQLValueString($_POST["id_oficina_registro"], "int"), 
GetSQLValueString($_POST["id_categoria_notaria"], "int"), 
GetSQLValueString($_POST["sin"], "int"), 
GetSQLValueString($_POST["subsidiada"], "int"),
GetSQLValueString($_POST["ultima_visita"], "date"),
GetSQLValueString($_POST["sabado"], "int"), 
GetSQLValueString($_POST["horario_notaria"], "text"), 
GetSQLValueString($_POST["latitud"], "text"), 
GetSQLValueString($_POST["longitud"], "text"), 
GetSQLValueString($_POST["acto_creacion"], "text"), 
GetSQLValueString($_POST["numero_acto"], "text"), 
GetSQLValueString($_POST["fecha_acto"], "date"), 
GetSQLValueString($_POST["reparto"], "int"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) ;
echo $actualizado;
  
} else { }



if ((isset($_POST["table"])) && ($_POST["table"] == "posesion_notaria") && 
(1==$_SESSION['rol'] or 0<$nump5)) { 


if (1530==$_SESSION['snr']) {  //or 1==$_SESSION['rol']
	
$insertSQL = sprintf("INSERT INTO posesion_notaria (id_funcionario, id_notaria, 
acto_nombramiento, numero_nombramiento, id_tipo_nombramiento_n, fecha_inicio, 
estado_posesion_notaria) VALUES (%s, %s, %s, %s, %s, %s,  %s)", 
GetSQLValueString($_POST["id_funcionario"], "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["acto_nombramiento"], "text"), 
GetSQLValueString($_POST["numero_nombramiento"], "text"), 
GetSQLValueString($_POST["id_tipo_nombramiento_n"], "int"), 
GetSQLValueString($_POST["fecha_inicio"], "date"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;
echo $insertado;

} else {
	
	
$insertSQL = sprintf("INSERT INTO posesion_notaria (id_funcionario, id_notaria, 
acto_nombramiento, numero_nombramiento, id_tipo_nombramiento_n, fecha_inicio, fecha_fin, 
estado_posesion_notaria) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["id_funcionario"], "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["acto_nombramiento"], "text"), 
GetSQLValueString($_POST["numero_nombramiento"], "text"), 
GetSQLValueString($_POST["id_tipo_nombramiento_n"], "int"), 
GetSQLValueString($_POST["fecha_inicio"], "date"), 
GetSQLValueString($_POST["fecha_fin"], "date"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;
echo $insertado;

}


} else { }







$query_update = sprintf("SELECT * FROM notaria WHERE notaria.id_notaria = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);
?>


<?php 
if ((1==$_SESSION['rol']) or 0<$nump4) { 
?>

<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar notaria:</b></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form1" >
<div class="form-group text-left"> 
<label  class="control-label">DIRECCION DE LA NOTARIA:</label>   
<input type="text" class="form-control" name="direccion_notaria"   value="<?php echo $row_update['direccion_notaria']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">TELEFONO DE LA NOTARIA:</label>   
<input type="text" class="form-control" name="telefono_notaria"   value="<?php echo $row_update['telefono_notaria']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">EMAIL DE LA NOTARIA:</label>   
<input type="text" class="form-control" name="email_notaria"   value="<?php echo $row_update['email_notaria']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">CATEGORIA DE LA NOTARIA:</label>   
<select  class="form-control" name="id_categoria_notaria" required>
<option value="1" <?php if (1==$row_update['id_categoria_notaria']) { echo 'selected'; } else {} ?>>1</option>
<option value="2" <?php if (2==$row_update['id_categoria_notaria']) { echo 'selected'; } else {} ?>>2</option>
<option value="3" <?php if (3==$row_update['id_categoria_notaria']) { echo 'selected'; } else {} ?>>3</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">TURNO DE SABADO:</label>   
<select  class="form-control" name="sabado" required>
<option value="1" <?php if (1==$row_update['sabado']) { echo 'selected'; } else {} ?>>Si</option>
<option value="0" <?php if (0==$row_update['sabado']) { echo 'selected'; } else {} ?>>No</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">SIN:</label>   
<select  class="form-control" name="sin" required>
<option value="1" <?php if (1==$row_update['sin']) { echo 'selected'; } else {} ?>>Si</option>
<option value="0" <?php if (0==$row_update['sin']) { echo 'selected'; } else {} ?>>No</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label">SUBSIDIADA:</label>   
<select  class="form-control" name="subsidiada" required>
<option value="1" <?php if (1==$row_update['subsidiada']) { echo 'selected'; } else {} ?>>Si</option>
<option value="0" <?php if (0==$row_update['subsidiada']) { echo 'selected'; } else {} ?>>No</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">ÚLTIMA VISITA:</label>   
<input type="text" class="form-control datepickera" name="ultima_visita" readonly  value="<?php echo $row_update['ultima_visita']; ?>">
</div>




<div class="form-group text-left"> 
<label  class="control-label"> CIRCULAR REGISTRAL:</label> 

 <select class="form-control" name="id_oficina_registro" required>
	  <option value="" selected></option>


<?php
$query = sprintf("SELECT * FROM oficina_registro where estado_oficina_registro=1 order by nombre_oficina_registro"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_oficina_registro'].'" ';
	
	if ($row_update['id_oficina_registro']==$row['id_oficina_registro']) { echo ' selected'; } else {} 
	
	echo '>'.$row['nombre_oficina_registro'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label">HORARIO DE LA NOTARIA:</label>   
<input type="text" class="form-control" name="horario_notaria"   value="<?php echo $row_update['horario_notaria']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">LATITUD:</label>   
<input type="text" class="form-control" name="latitud"   value="<?php echo $row_update['latitud']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">LONGITUD:</label>   
<input type="text" class="form-control" name="longitud"   value="<?php echo $row_update['longitud']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">HACE REPARTO:</label>   
<select  class="form-control" name="reparto" required>
<option value="1" <?php if (1==$row_update['reparto']) { echo 'selected'; } else {} ?>>Si</option>
<option value="0" <?php if (0==$row_update['reparto']) { echo 'selected'; } else {} ?>>No</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label">Acto de creación:</label>   
<input type="text" class="form-control" name="acto_creacion"   value="<?php echo $row_update['acto_creacion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">Número de acto:</label>   
<input type="text" class="form-control" name="numero_acto"   value="<?php echo $row_update['numero_acto']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">Fecha del acto:</label>   
<input type="text" class="form-control datepickera" name="fecha_acto"   value="<?php echo $row_update['fecha_acto']; ?>">
</div>


				


<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="notaria">
<span class="glyphicon glyphicon-ok"></span> Actualizar</button></div></form>



</div>
</div> 
</div> 
</div> 

<?php 
} else {}


?>


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

	  
	  
	  
<?php  if ((1==$_SESSION['rol']) or 0<$nump5) {  ?>

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
	  
<form action="" method="POST" name="form1" onsubmit="return validate();"><div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> USUARIO:</label> 
<select  class="form-control" name="id_funcionario" required>
<option selected></option>
<?php
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_tipo_oficina=3 and id_rol=3 and id_cargo=1 and estado_funcionario=1 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
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
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ACTO DE NOMBRAMIENTO:</label> 

 <select class="form-control" name="acto_nombramiento" required>
	  <option value="" selected></option>
	  <option value="Decreto">Decreto</option>
	  <option value="Resolucion">Resolucion</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO:</label> 
<input type="text"  required class="form-control" name="numero_nombramiento"   >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE NOMBRAMIENTO:</label> 
<select  class="form-control" name="id_tipo_nombramiento_n" required>
<option value="" selected></option>
<?php echo lista('tipo_nombramiento_n'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INICIO:</label> 
<input type="text" readonly="readonly" required class="form-control datepickera" style="width:150px;"  name="fecha_inicio"   >
</div>

<?php if (1530==$_SESSION['snr'] ) { echo ''; } else { //or 1==$_SESSION['rol'] ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE FINALIZACIÓN:</label> 
<input type="text" readonly="readonly" required class="form-control datepickera" style="width:150px;" name="fecha_fin" required >
</div>
<?php } ?>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="posesion_notaria">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>
</form>

</div>
</div> 
</div> 
</div> 



<?php } else { } ?>




<?php if (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado']))
{ include 'menu_notaria.php'; } else { ?>


<?php
 IF (1==$_SESSION['rol'] or 0<$nump4 or 0<$nump5 or 0<$nump6 or 0<$nump18 or 0<$nump97) { 	
?>
<div class="row">
  <div class="col-md-12">
    <nav class="navbar navbar-default" style="background:#fff;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		</div>
 <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b> 	 
     <?php echo quees('notaria', $id);?>
		  </b></a></li>
           
   <?php if (1==$_SESSION['rol']) { ?> 
<li><a href="privilegios_notariado&<?php echo $id; ?>.jsp">Acceso a módulos</a></li>
 <?php } else {} ?>
			   
 <li><a href="sucesion<?php if (1==$_SESSION['rol'] or 0<$nump18) { echo '&'.$id; } else {} ?>.jsp">Liq. Herencia</a></li>	  
<li><a href="salida_menor<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Salida de menores</a></li>
 <li><a href="notaria_datos_facturacion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Facturación</a></li>
<li><a href="personal_notaria<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="">Personal</a></li>
    

<?php if (1==$_SESSION['rol'] or 0<$nump5) { ?> 
 <li><a href="historico_notarias&<?php echo $id; ?>.jsp" title="Consulta historica">Historial</a></li>
<?php } else { } 
 if (1==$_SESSION['rol'] or 0<$nump97) { ?> 
<li><a href="digitalizacion_notarial&<?php echo $id; ?>.jsp" title="Digitalización">Digitalización</a></li>
<?php } else { } ?> 
  
  
  <?php if (1==$_SESSION['rol']) { ?> 
  <li><a href="testamento<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Testamento">Testamentos</a></li>
<li><a href="apostilla&<?php echo $id; ?>.jsp" title="Apostilla">Apostilla</a></li>
<li><a href="local_notaria&<?php echo $id; ?>.jsp" title="">Local</a></li>	  	
<?php } else {} ?>

            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>
	  <?php } else {}  ?>
	  
	  <?php }  ?>
	  




 <div class="row">
        <div class="col-md-4">

     
          <div class="box box-primary">
            <div class="box-body box-profile">
			
			<div class="box-tools">
         <?php 
if (1==$_SESSION['rol'] or (0<$nump4)){ ?>
 &nbsp; <a href=""  data-toggle="modal" data-target="#popup">
<button type="button" class="btn btn-warning btn-xs" >Actualizar</button>
	</a>
<?php } else { } ?>
              </div>
			  
			
			
            <p class="text-muted text-center">Notaria</p>
              <h3 class="profile-username text-center"><?php echo $row_update['nombre_notaria']; ?></h3>

              <p class="text-muted text-center"><?php echo quees('departamento', $row_update['id_departamento']); ?> / <?php echo nombre_municipio($row_update['codigo_municipio'], $row_update['id_departamento']); ?></p>

			  	  <p class="text-muted text-center">DANE: <?php echo $row_update['codigo_dane']; ?></p>
				  
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Categoria:</b> <?php echo $row_update['id_categoria_notaria']; ?>
                </li>
				
				 <li class="list-group-item">
                  <b>SIN:</b> <?php if (1==$row_update['sin']) { echo 'Si'; } else { echo 'No';} ?>
                </li>
				
				
				<li class="list-group-item">
                  <b>Subsidiada:</b> <?php if (1==$row_update['subsidiada']) { echo 'Si'; } else { echo 'No';} ?>
                </li>
				
				<li class="list-group-item">
                  <b>Última visita:</b> <?php echo $row_update['ultima_visita']; ?>
                </li>
				

                <li class="list-group-item">
                  <b>Teléfono:</b> <?php echo $row_update['telefono_notaria']; ?>
                </li>
                <li class="list-group-item">
                  <b>Email:</b> <?php echo $row_update['email_notaria']; ?>
                </li>
				   <li class="list-group-item">
                  <b>Dirección:</b> <?php echo $row_update['direccion_notaria']; ?>
                </li>
				   <li class="list-group-item">
                  <b>Horario:</b> <?php echo $row_update['horario_notaria']; ?>
                </li>
				
			  <li class="list-group-item">
                  <b>Sabado:</b> <?php if (1==$row_update['sabado']) { echo 'Si'; } else { echo 'No';} ?>
                </li>
				
				 <li class="list-group-item">
                  <b>Circulo Registral:</b> <?php 
				  if (isset($row_update['id_oficina_registro'])) {
				  echo quees('oficina_registro', $row_update['id_oficina_registro']);
				  } else {}

				  ?>
                </li>
				
				 <li class="list-group-item">
                  <b>En reparto Notarial:</b> <?php if (1==$row_update['reparto']) { echo 'Si'; } else { echo 'No';} ?>
                </li>
				
				 <li class="list-group-item">
                  <b>Acto de creación:</b> <?php echo $row_update['acto_creacion']; ?>
                </li>
				
				<li class="list-group-item">
                  <b>Número de acto:</b> <?php echo $row_update['numero_acto']; ?>
                </li>
				
				<li class="list-group-item">
                  <b>Fecha del acto:</b> <?php echo $row_update['fecha_acto']; ?>
                </li>
				

	 <li class="list-group-item">
                  <b>Geolocalización:</b> <?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>
                </li>

				
				
              </ul>

		
			  

			  
			  
 <div id="mapid" style="width: 100%; min-height: 315px;border: 2px #333;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

		  <script>

	var mymap = L.map('mapid').setView([<?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>], 12);  // toda colombia 6

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		
	
		maxZoom: 18,
		attribution: 'OpenStreetMap' +
			'' +
			'',
		id: 'open.streets'
	}).addTo(mymap);

	
	L.marker([<?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>]).addTo(mymap)
   .bindPopup('<?php echo $row_update['nombre_notaria']; ?>');
   
</script>
 <p>
			<br> <b><i class="fa fa-map-marker margin-r-5"></i> COBERTURA</b>
			<BR>
			
			<?php
			if (1==$_SESSION['rol'] or 0<$nump4) { ?>

 <form action="" method="POST" name="65465435435zam1" >
 <select name="id_municipio_notaria">
 <option value="" selected></option>
 <?php echo dep_mun(); ?>
 </select><br>
 <input type="Submit" value="Agregar">
 </form><br>

			<?php } else {}
    
	?>
	
	
			
					<ul class="list-group list-group-unbordered">
			  
<?php

$query = sprintf("SELECT id_municipio_notaria, nombre_municipio FROM municipio_notaria, municipio where municipio_notaria.id_departamento=municipio.id_departamento and municipio_notaria.codigo_municipio=municipio.codigo_municipio and municipio_notaria.id_notaria=".$id." and estado_municipio_notaria=1"); 

$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {

echo '<li class="list-group-item">';
if (1==$_SESSION['rol'] or 0<$nump4) { echo 
'<a style="color:#ff0000;cursor: pointer" title="Borrar" name="municipio_notaria" id="'.$row['id_municipio_notaria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>'; } else {}
               echo ' <b>Municipio:</b> '.$row['nombre_municipio'].'
              </li>';
			  

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>
			</UL>
			  </p>


			  
			  
			  
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Nombramientos</a></li>
              <li><a href="#timeline" data-toggle="tab">Personas</a></li>
              <li><a href="#settings" data-toggle="tab">Encargados</a></li>
              <?php if (1 == $row_update['id_categoria_notaria']) { ?>
                <li><a href="#permisos" data-toggle="tab">Permisos-Licencias</a></li>
                <?php } ?>
			    <li><a href="#requerimientos" data-toggle="tab">Requerimientos</a></li>
				<li><a href="#propiedad" data-toggle="tab">Propiedad</a></li>
        <li><a href="https://sisg.supernotariado.gov.co/permisos_licencias.jsp">Repositorio Permisos</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
 
  <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	 
                      <div class="col-sm-12">
					   <?php 

$queryb = sprintf("SELECT count(id_posesion_notaria) as todpose FROM posesion_notaria where fecha_fin is null and id_notaria=".$id."  and estado_posesion_notaria=1");
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
//echo $rowb['todpose'];

if (0<$nump5 or 1==$_SESSION['rol']){  //  && 0==$rowb['todpose']   ?>
 <a href=""  data-toggle="modal" data-target="#miModal">
<button type="button" class="btn btn-success btn-xs" >+ Nuevo</button>
</a>	 
<?php
 } else {} 
 
 
 
 if (0==$rowb['todpose']) { echo '<span style="color:#ff0000;">Revisar, debe existir un notario en posesión para los reportes.</span>';} else { echo '';}
 ?>
                      </div>
					
	<?php				  
$query = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n where id_cargo=1 and posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_tipo_nombramiento_n=tipo_nombramiento_n.id_tipo_nombramiento_n and id_notaria=".$id." and estado_funcionario=1 and estado_posesion_notaria=1 order by fecha_inicio desc");
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
?>
					  
          <table class="table table-striped">
            <thead>
            <tr>
			  <th>Cedula</th>
              <th>Nombre</th>
			  <th>Nombramiento</th>
              <th>Desde</th>
              <th>Hasta</th>
              <th style="width:150px;"></th>
            </tr>
            </thead>
            <tbody>
            <?php
			$nombre_propiedad='';
			do {
	echo '<tr>';

if (isset($row['id_funcionario'])) {
echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';
echo '<td>';
echo $row['nombre_funcionario'];
echo '</td>';
} else { echo '<td></td><td></td>'; }

echo '<td>'.$row['nombre_tipo_nombramiento_n'].'</td>';

echo '<td>'.$row['fecha_inicio'].'</td>';

if (isset($row['fecha_fin'])) {
echo '<td>'.$row['fecha_fin'].'</td>';
} else {
	if (1==$row['id_cargo']) {
		$id_notario=$row['id_funcionario'];
	echo '<td><span class="label label-info"> Actual </span></td>';
	if (2==$row['id_tipo_nombramiento_n']) {
	$nombre_propiedad=$row['nombre_funcionario'];
	} else {
		}
	} else {
		$id_notario=0;
	echo '<td></td>';
	}
}

echo '<td>

<a href="usuario&'.$row['id_funcionario'].'.jsp"><span class="glyphicon glyphicon glyphicon-user"></span></a> 


 &nbsp; <a href="" id="'.$row['id_posesion_notaria'].'" class="consultaposesion" data-toggle="modal" data-target="#actualizarsituacion"><span class="glyphicon glyphicon glyphicon-search"></span></a> ';


	if (1==$_SESSION['rol'] or 0<$nump5) {
	echo ' &nbsp; <a href="" id="'.$row['id_posesion_notaria'].'" title="'.$row['id_posesion_notaria'].'" class="actualizaposesion" data-toggle="modal" data-target="#updatesituacion"><i class="glyphicon glyphicon-pencil"></i></a> ';
	
	
	echo '  &nbsp; <a href="" class="buscar_soporte" id="'.$row['id_posesion_notaria'].'" name="  CC'.$row['cedula_funcionario'].'" data-toggle="modal" data-target="#popupsoporte"><span class="fa fa-file" ></span></a> &nbsp; ';
	
	} else {}
	
	if (1==$_SESSION['rol'] or 0<$nump104) {
		echo '  &nbsp; <a href="certificacion&'.$row['id_funcionario'].'.jsp" ><span class="fa fa-file" style="color:#3F8E4D;" ></span></a> &nbsp; ';
} else {}


if (1==$_SESSION['rol']) {
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="posesion_notaria" id="'.$row['id_posesion_notaria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else { }
echo '</td></tr>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);


?>
           
            </tbody>
          </table>
	
        </div>
    </div>
    </div>
 
 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
              <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	 
                      <div class="col-sm-3">
                      <?php if (1==$_SESSION['rol']  or (0<$nump5)){ 

if ((isset($_POST["nueva_relacion"])) && ($_POST["nueva_relacion"] != "")) { 
$nueva_relacion=$_POST["nueva_relacion"];

$querynm = sprintf("SELECT count(id_funcionario) as sifun FROM funcionario where id_tipo_oficina=3 and id_notaria_f!=".$id." and estado_funcionario=1");
$selectnm = mysql_query($querynm, $conexion) or die(mysql_error());
$rownm = mysql_fetch_assoc($selectnm);
if(0<$rownm['sifun']) {
$updateSQL = "UPDATE funcionario SET id_notaria_f=".$id." where cedula_funcionario='$nueva_relacion' and id_tipo_oficina=3 and id_notaria_f!=".$id." and estado_funcionario=1";
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $insertado;
} else {
echo $nopermitido;	
}
} else { }

?>
                       
<form class="navbar-form" name="forewqrrm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input type="text" class="form-control numero" required name="nueva_relacion" style="width:300px;" placeholder="Número de Cédula" >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"> + Asociar usuario </button> 
</div>
</div>
</form>

					   
					   <?php } else {} ?>
                      </div>
					   <div class="col-sm-9"></div>
					  

					  
          <table class="table table-striped">
            <thead>
            <tr>
			  <th>Cedula</th>
              <th>Nombre</th>
			    <th>Usuario</th>
              <th>Correo</th>
			  <th>Cargo</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
			        			  
$queryn = sprintf("SELECT * FROM funcionario, cargo where funcionario.id_cargo=cargo.id_cargo and id_notaria_f=".$id." and id_tipo_oficina=3 and id_rol=3 and funcionario.id_cargo=3  and estado_funcionario=1 ORDER BY id_funcionario desc");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);

			do {
	echo '<tr>';
echo '<td>'.$rown['cedula_funcionario'].'</td>';
echo '<td>'.$rown['nombre_funcionario'].'</td>';
echo '<td>'.$rown['alias_iduca'].'</td>';
echo '<td>'.$rown['correo_funcionario'].'</td>';
echo '<td>'.$rown['nombre_cargo'].'</td>';
echo '<td><a href="usuario&'.$rown['id_funcionario'].'.jsp"><span class="glyphicon glyphicon-user"></span></a> ';
echo '<a href="personal_notaria&'.$id.'.jsp" title="Actualizar"><span class="fa fa-edit" style="color:#E08E0B;"></span></a>';


echo '</td></tr>';
} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
 </tbody>
          </table>
	
        </div>
    </div>
    </div>
               
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	 
                      <div class="col-sm-3">

                      </div>
					   <div class="col-sm-9"></div>

        
<?php				  
$querynv = sprintf("SELECT DISTINCT funcionario.id_funcionario, cedula_funcionario, nombre_funcionario, correo_funcionario, nombre_cargo FROM funcionario, cargo, permiso where permiso.id_funcionario_encargado=funcionario.id_funcionario and funcionario.id_cargo=cargo.id_cargo and  id_rol=3 and funcionario.id_cargo=3 and permiso.id_notaria=".$id." and id_tipo_oficina=3 and estado_funcionario=1 and estado_permiso=1");
$selectnv = mysql_query($querynv, $conexion) or die(mysql_error());
$rownv = mysql_fetch_assoc($selectnv);
?>
				  
          <table class="table table-striped">
            <thead>
            <tr>
			  <th>Cedula</th>
              <th>Nombre</th>
              <th>Correo</th>
			  <th>Cargo</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
			do {
	echo '<tr>';
echo '<td>'.$rownv['cedula_funcionario'].'</td>';
echo '<td>'.$rownv['nombre_funcionario'].'</td>';
echo '<td>'.$rownv['correo_funcionario'].'</td>';
echo '<td>'.$rownv['nombre_cargo'].'</td>';
echo '<td><a href="usuario&'.$rownv['id_funcionario'].'.jsp"><i class="glyphicon glyphicon-user"></i></a> ';

echo '<a href="personal_notaria&'.$id.'.jsp" title="Actualizar"><span class="fa fa-edit" style="color:#E08E0B;"></span></a> ';


echo ' <a href="html/encargo&'.$rownv['id_funcionario'].'.html" target="_blank"><i class="glyphicon glyphicon-file" style="color:#3F8E4D;"></i></a>';


echo '</td></tr>';


} while ($rownv = mysql_fetch_assoc($selectnv));
mysql_free_result($selectnv);

?>

 </tbody>
          </table>

					  
          
	
        </div>
    </div>
    </div>
	
              </div>
			  
			  
			  
			  
			  
			  
			  
			   <div class="tab-pane" id="permisos">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	 
                      <div class="col-sm-12">
                      <?php if (1==$_SESSION['rol'] or 0<$nump6) { 
					  
					  
if ((isset($_POST["id_funcionario_encargado"])) && ($_POST["id_funcionario_encargado"] != "") && (0<$nump6 or 1==$_SESSION['rol'])) { 
//echo $error;
$insertSQL = sprintf("INSERT INTO permiso (origen, id_funcionario, id_notaria, id_funcionario_encargado, fecha_creacion, estado_permiso) 
VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString(0, "int"), 
GetSQLValueString($_POST["id_funcionario_notario"], "int"),
GetSQLValueString($id, "int"),
GetSQLValueString($_POST["id_funcionario_encargado"], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
} else {} 
?>
					  
<form action="" method="POST" name="fo45465456rm1">

<div class="form-group text-left"> 
<label  class="control-label"> Notario:</label> 
<select  type="text" class="form-control" name="id_funcionario_notario">
	<?php				  
$query9 = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n where id_cargo=1 and posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_tipo_nombramiento_n=tipo_nombramiento_n.id_tipo_nombramiento_n and id_notaria=".$id." and estado_funcionario=1 and estado_posesion_notaria=1 order by fecha_inicio desc");
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
<label  class="control-label"><span style="color:#ff0000;">*</span> Encargado:</label> 
<?php
$queryn = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_notaria_f=".$id." and id_tipo_oficina=3 and estado_funcionario=1");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
$totalRowsn = mysql_num_rows($selectn);
if (0<$totalRowsn){
echo '<select class="form-control" name="id_funcionario_encargado" required>
<option selected> - Encargado - </option>';
			do {
echo '<option value="'.$rown['id_funcionario'].'">'.$rown['nombre_funcionario'].'</option>';
} while ($rown = mysql_fetch_assoc($selectn));
echo '</select>';
} else {
	echo 'No tiene personal relacionado con la Notaria.';
}
mysql_free_result($selectn);
?>

</div>
<div class="modal-footer">

<?php if ((1==$_SESSION['rol'] or 46==$_SESSION['snr_grupo_area'] or ""!=$_SESSION['posesionnotaria']) && 0!=$id_notario) { ?>
<div style="text-align:left;">
<a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls"><IMG SRC="images/xls.png" style="width:16px;height:16px;"> &nbsp; Reporte detallado de permisos de la Notaria.
</a>
</div>
<?php } else {} ?>
					  
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>


</form>



					   <?php } else {} ?>
                      </div>
					   

        
<?php	
if (1==$_SESSION['rol'] or 0<$nump6 or ""!=$_SESSION['posesionnotaria']) {			  

?>
				  
  <table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
            <tr>
			 <th>Acto Admin</th>
			  <th>Fecha</th>
              <th>Notario</th>
             <th>Encargado</th>
			 <th>Canal</th>
              <th>Estado</th>
			  <th></th>
            </tr>
   </thead>
<tbody>
				
<?php 

$query4="SELECT * FROM funcionario, permiso where permiso.id_funcionario=funcionario.id_funcionario and permiso.id_notaria=".$id." and estado_permiso=1 order by id_permiso desc";

$result = $mysqli->query($query4);
while($rownvb = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>

            <?php

echo '<td>'.$rownvb['numero_resolucion'].'</td>';
echo '<td>'.$rownvb['fecha_resolucion'].'</td>';


echo '<td>'.$rownvb['nombre_funcionario'].'</td>';

echo '<td>';
if (isset($rownvb['id_funcionario_encargado'])) {
echo quees('funcionario', $rownvb['id_funcionario_encargado']);
} else { }
echo '</td>';

echo '<td>';
if (0==$rownvb['origen']) {
	echo 'SNR';
} else {
	echo 'WEB';
}
echo '</td>';
echo '<td>';
if (isset($rownvb['numero_resolucion'])) {
	echo 'Aprobada';
} else {
	echo 'En tramite';
}
echo '</td>';
echo '<td><a href="" id="'.$rownvb['id_permiso'].'" class="consultapermiso" data-toggle="modal" data-target="#resultadopermisolicencia"><i class="glyphicon glyphicon-search"></i></a> ';


	
	if (1==$_SESSION['rol'] or 0<$nump6) {
	echo ' <a href="permiso&'.$rownvb['id_permiso'].'.jsp"><i class="glyphicon glyphicon-pencil"></i></a> ';
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
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

<?php 




} else { }?>	  
          
	
        </div>
    </div>
    </div>
	
              </div>
			  
			

<div class="tab-pane" id="requerimientos">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	 

					   

      
<?php	
if (1==$_SESSION['rol'] or 45==$_SESSION['snr_grupo_area'] or ""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado']) {			  

$query = sprintf("SELECT * FROM requerir_pqrs where radicado_requerimiento is not null and id_tipo_oficina=3 and id_vigilado=".$id." and estado_requerir_pqrs=1");
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

if (0<$totalRows){
?>
<div class="box-header with-border">
<table class="table table-striped table-bordered table-hover" id="pqrsvigilados">
<thead>
<tr align='center' valign='middle'>
<th>Radicado</th>
<th>Fecha de solicitud</th>
<th>Plazo</th>
<th>Estado</th>
<th>Fecha de respuesta</th>
<th style="width:90px;"></th>
</tr>
</thead><tbody>
<?php
do {
echo '<tr>';
echo '<td>'.$row['radicado_requerimiento'].'</td>';
echo '<td>'.$row['fecha_solicitudr'].'</td>';
$fecharnotario=fechahabil($row['fecha_solicitudr'],5);
echo '<td>'.$fecharnotario.'</td>';
echo '<td>';
if (isset($row['fecha_respuestar'])){
	echo 'Con respuesta del Notario';
} else {
	echo 'Pendiente';
}

echo '</td>';
echo '<td>'.$row['fecha_respuestar'].'</td>';
echo '<td>';
if (""!=$_SESSION['posesionnotaria'] && (1==$_SESSION['snr_tipo_oficina'] or $_SESSION['id_vigilado']==$id)) {	
echo '<a href="requerimiento_respuesta&'.$row['id_solicitud_pqrs'].'.jsp"><span class="label label-warning">Ver</span></a>';
echo ' <a href="pdf/requerimiento&'.$row['id_solicitud_pqrs'].'.pdf"><span class="label label-danger">PDF</span></a>';
} else {
if (1==$_SESSION['snr_tipo_oficina'] or $_SESSION['id_vigilado']==$id) {	
echo '<a href="requerimiento_respuesta&'.$row['id_solicitud_pqrs'].'.jsp"><span class="label label-warning">Ver</span></a>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp"><span class="label label-warning"><i class="glyphicon glyphicon-search"></i> Ver</span></a>';
echo ' <a href="pdf/requerimiento&'.$row['id_solicitud_pqrs'].'.pdf"><span class="label label-danger">PDF</span></a>';

} else {}

}

echo '</td>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
?>	
</tbody></table>
 </div>
<?php } else { }?>	  
          
	<?php } else { }?>	
       
    </div>
    </div>
	
              </div>



			
			  
              <!-- /.tab-pane -->
            
			 </div>
			
			
			
			<div class="tab-pane" id="propiedad">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
<div class="box-header with-border">

<?php

$query4 = "SELECT funcionario.id_funcionario, nombre_funcionario FROM notario_propiedad, funcionario where notario_propiedad.id_funcionario=funcionario.id_funcionario and id_notaria=".$id." and estado_notario_propiedad=1"; 
$select4 = mysql_query($query4, $conexion);
$row4 = mysql_fetch_assoc($select4);
$totalRows4 = mysql_num_rows($select4);

if (0<$totalRows4){
	
echo '<a href="usuario&'.$row4['id_funcionario'].'.jsp"><span class="fa fa-user"></span></a> ';
echo 'Notario en propiedad: '.$row4['nombre_funcionario'];


} else { 
echo $nombre_propiedad;

 }
	mysql_free_result($select4);
?>
 </div>
 </div>
  </div>
 </div>
 </div>

 
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
	  </div>
	  
	  
	  
	  
	  <div class="modal fade" id="popupsoporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Documento</b><span id="idsoporte"></span></h4>
</div> 
<div class="ver_soporte" class="modal-body"> 
</div>
</div> 
</div> 
</div> 

	  <?php
}}
?>