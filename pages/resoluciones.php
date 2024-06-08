<?php

$nump19=privilegios(19,$_SESSION['snr']);

if (0<$nump19 or 1==$_SESSION['rol']) {




if ((isset($_POST["borrar_documento"])) && ($_POST["borrar_documento"] != "")) { 

 
$updateSQL7799m = sprintf("UPDATE documento_resolucion SET estado_documento_resolucion=%s WHERE id_documento_resolucion=%s and estado_documento_resolucion=1",                  
					  GetSQLValueString(0, "int"),
					  GetSQLValueString(intval($_POST["borrar_documento"]), "int"));
$Result17799m = mysql_query($updateSQL7799m, $conexion) or die(mysql_error());
  
echo '<script type="text/javascript">swal(" OK !", "Archivo borrado.", "success");</script>';




} else { }




//if (isset($_GET["i"]) && $_GET["i"] != "" && isset($_GET["e"]) && $_GET["e"] == 0) { 
if ((isset($_POST["borrar_documento_resolucion"])) && ($_POST["borrar_documento_resolucion"] != "")) { 
 
$updateSQL7799mB = sprintf("UPDATE resolucion SET url_resolucion=null WHERE id_resolucion=%s and estado_resolucion=1",                  
					  GetSQLValueString(intval($_POST["borrar_documento_resolucion"]), "int"));
$Result17799mB = mysql_query($updateSQL7799mB, $conexion) or die(mysql_error());
  
echo '<script type="text/javascript">swal(" OK !", "Archivo borrado.", "success");</script>';




} else { }





if ((isset($_POST["table"])) && ($_POST["table"] == "actualizar_resolucion")) { 


$updateSQL = sprintf("UPDATE resolucion SET 
nombre_resolucion=%s, 
codigo_oficina=%s, 
id_municipio=%s, 
quien_solicita=%s, 
id_funcionario_solicita=%s, 
id_area=%s, 
id_grupo_area=%s, 
id_funcionario_hace=%s, 
fecha_exp_resolucion=%s, 
hora_resolucion=%s, 
num_folios=%s, 
id_funcionario_firma=%s 
where id_resolucion=%s",
GetSQLValueString($_POST["nombre_resolucion"], "text"), 
GetSQLValueString($_POST["codigo_oficina"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["quien_solicita"], "text"), 
GetSQLValueString($_POST["id_funcionario_solicita"], "int"), 
GetSQLValueString($_POST["id_area"], "int"), 
GetSQLValueString($_POST["id_grupo_area"], "int"),  
GetSQLValueString($_POST["id_funcionario_hace"], "int"), 
GetSQLValueString($_POST["fecha_exp_resolucion"], "date"), 
GetSQLValueString($_POST["hora_resolucion"], "date"), 
GetSQLValueString($_POST["num_folios"], "int"), 
GetSQLValueString($_POST["id_funcionario_firma"], "int"), 
GetSQLValueString($_POST["id_resolucion"], "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;


} else { }
	


	
if ((isset($_POST["resolucionfile"])) && ($_POST["resolucionfile"] != "")) { 

$tamano_archivo=17301504; //11534336

//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/resoluciones/";


$ruta_archivo = 'res-'.$idper.'-'.date("YmdGis");



	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  

//$seguridad=md5($files.$id_ciudadano);
  
$insertSQL = sprintf("INSERT INTO documento_resolucion (id_resolucion, nombre_documento_resolucion, estado_documento_resolucion) 
VALUES (%s, %s, %s)", 
GetSQLValueString($_POST["resolucionfile"], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo '<script type="text/javascript">swal(" OK !", " Documento almacenado correctamente  !", "success");</script>';





  
  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';

		}
	
	



} else { }





if ((isset($_POST["table"])) && ($_POST["table"] == "resoluciondatos")) {

$vi=intval($_POST["vigencia"]);
$res=intval($_POST["resolucion"]);
$actualizar5 = mysql_query("SELECT count(id_resolucion) as tot FROM resolucion where estado_resolucion=1 and resolucion=".$res." and vigencia=".$vi." ", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);

if (0<$row15['tot']) {
$repetido='<script type="text/javascript">swal(" ERROR !", " El número de resolución introducido YA existe en el sistema. !", "error");</script>';
echo $repetido;
}
else {
	

	
$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/resoluciones/";








if (isset($_FILES['filet']['name']) && ""!=$_FILES['filet']['name']) {

$ruta_archivo = 'res-'.$_SESSION['snr'].'-'.date("YmdGis");

$archivo = $_FILES['filet']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['filet']['size'];
$nombrefile = strtolower($_FILES['filet']['name']);
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
  
	
	
$insertSQL = sprintf("INSERT INTO resolucion (vigencia, resolucion, nombre_resolucion, 
id_tipo_oficina, codigo_oficina, id_municipio, quien_solicita, id_funcionario_solicita, id_area, id_grupo_area, id_funcionario_hace, fecha_exp_resolucion, 
hora_resolucion, num_folios, id_funcionario_firma, fecha_sistema, url_resolucion, estado_resolucion, id_funcionario_numera) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($_POST["vigencia"], "int"), 
GetSQLValueString($_POST["resolucion"], "int"), 
GetSQLValueString($_POST["nombre_resolucion"], "text"),
GetSQLValueString($_POST["id_tipo_oficina"], "int"), 
GetSQLValueString($_POST["codigo_oficina"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["quien_solicita"], "text"), 
GetSQLValueString($_POST["id_funcionario_solicita"], "int"), 
GetSQLValueString($_POST["id_area"], "int"), 
GetSQLValueString($_POST["id_grupo_area"], "int"), 
GetSQLValueString($_POST["id_funcionario_hace"], "int"), 
GetSQLValueString($_POST["fecha_exp_resolucion"], "date"), 
GetSQLValueString($_POST["hora_resolucion"], "text"), 
GetSQLValueString($_POST["num_folios"], "int"), 
GetSQLValueString($_POST["id_funcionario_firma"], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_SESSION['snr'], "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;




  
 
	
	

	
	
	
	



}
}
 else { }

 
 



?>

 <link rel="stylesheet" href="plugins/chosenselect/chosen.css">
<script src="plugins/chosenselect/chosen.js" type="text/javascript"></script>
<script type="text/javascript">
 var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Registro no encontrado!'},
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
 
 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva resolución</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65464563m1" enctype="multipart/form-data" >
<div class="form-group text-left"> 
<label  class="control-label"> VIGENCIA:</label> 



<select name="vigencia" class="form-control">
<!--
<option value="22" selected>2022</option>
<option value="21">2021</option>
<option value="20">2020</option>
<option value="19">2019</option>
<option value="18">2018</option>-->

<?php 
for ($in=18; $in <= $anoactual; $in++) {
echo '<option value="'.$in.'" ';
if ($in==$anoactual) { echo 'selected'; } else {}
echo '>20'.$in.'</option>';
}

?>

</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label">RESOLUCIÓN:</label> 



<div class="input-group">
<span class="input-group-addon">
N. Resolución actual: 
<?php
$query44 = sprintf("SELECT MAX(resolucion) as maximo FROM resolucion where vigencia=".$anoactual." and estado_resolucion=1"); //and id_funcionario_numera=".$_SESSION['snr']."
$selectreg = mysql_query($query44, $conexion);
$row1reg = mysql_fetch_assoc($selectreg);
$maximo=$row1reg['maximo'];
echo $maximo;
$res=$maximo+1;
mysql_free_result($selectreg);
?>
</span>
<span class="input-group-addon">
Nueva resolución 
</span>
<span class="input-group-addon">

<input type="text" class="form-control numero" name="resolucion" value="<?php echo $res; ?>" >

 </span>
</div>


</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICIÓN:</label> 
<input type="text" autocomplete="off" class="form-control datepicker" name="fecha_exp_resolucion" required  >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> HORA DE RESOLUCION:</label> 
<select class="form-control " name="hora_resolucion" required>
<option value="06:00:00">06:00:00</option>
<option value="06:15:00">06:15:00</option>
<option value="06:30:00">06:30:00</option>
<option value="06:45:00">06:45:00</option>
<option value="07:00:00">07:00:00</option>
<option value="07:15:00">07:15:00</option>
<option value="07:30:00">07:30:00</option>
<option value="07:45:00">07:45:00</option>
<option value="08:00:00" selected>08:00:00</option>
<option value="08:15:00">08:15:00</option>
<option value="08:30:00">08:30:00</option>
<option value="08:45:00">08:45:00</option>
<option value="09:00:00">09:00:00</option>
<option value="09:15:00">09:15:00</option>
<option value="09:30:00">09:30:00</option>
<option value="09:45:00">09:45:00</option>
<option value="10:00:00">10:00:00</option>
<option value="10:15:00">10:15:00</option>
<option value="10:30:00">10:30:00</option>
<option value="10:45:00">10:45:00</option>
<option value="11:00:00">11:00:00</option>
<option value="11:15:00">11:15:00</option>
<option value="11:30:00">11:30:00</option>
<option value="11:45:00">11:45:00</option>
<option value="12:00:00">12:00:00</option>
<option value="12:15:00">12:15:00</option>
<option value="12:30:00">12:30:00</option>
<option value="12:45:00">12:45:00</option>
<option value="13:00:00">13:00:00</option>
<option value="13:15:00">13:15:00</option>
<option value="13:30:00">13:30:00</option>
<option value="13:45:00">13:45:00</option>
<option value="14:00:00">14:00:00</option>
<option value="14:15:00">14:15:00</option>
<option value="14:30:00">14:30:00</option>
<option value="14:45:00">14:45:00</option>
<option value="15:00:00">15:00:00</option>
<option value="15:15:00">15:15:00</option>
<option value="15:30:00">15:30:00</option>
<option value="15:45:00">15:45:00</option>
<option value="16:00:00">16:00:00</option>
<option value="16:15:00">16:15:00</option>
<option value="16:30:00">16:30:00</option>
<option value="16:45:00">16:45:00</option>
<option value="17:00:00">17:00:00</option>
<option value="17:15:00">17:15:00</option>
<option value="17:30:00">17:30:00</option>
<option value="17:45:00">17:45:00</option>
<option value="18:00:00">18:00:00</option>
<option value="18:15:00">18:15:00</option>
<option value="18:30:00">18:30:00</option>
<option value="18:45:00">18:45:00</option>
<option value="19:00:00">19:00:00</option>
<option value="19:15:00">19:15:00</option>
<option value="19:30:00">19:30:00</option>
<option value="19:45:00">19:45:00</option>
<option value="20:00:00">20:00:00</option>


</select>
</div>
<hr>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OFICINA QUE SOLICITA:</label> 
<select  class="form-control" name="id_tipo_oficina" id="id_tipo_oficina4" required >
<option value="" selected></option>
<?php echo lista('tipo_oficina'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"> OFICINA QUE SOLICITA:</label> 

<div id="listado_oficinas4">
</div>



</div>


<HR>
<div class="form-group text-left"> 
<label  class="control-label"> LISTADO DE ASUNTOS:</label> 
<select  class="form-control chosen-select" style="width:100%;" name="id_asunto_resolucion" id="id_asunto_resolucion">
<option value="" selected></option>
<?php

$query = sprintf("SELECT * FROM asunto_resolucion where estado_asunto_resolucion=1 order by nombre_asunto_resolucion"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['nombre_asunto_resolucion'].'" ';
	echo '>'.$row['nombre_asunto_resolucion'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {
	
}	 
mysql_free_result($select);

?>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"> MUNICIPIO:</label> 
<select  class="form-control chosen-select" style="width:100%;" name="id_municipio">
<option value="" selected></option>
<?php

$querym = sprintf("SELECT * FROM municipio where estado_municipio=1 order by nombre_municipio"); 
$selectm = mysql_query($querym, $conexion) or die(mysql_error());
$rowm = mysql_fetch_assoc($selectm);
$totalRowsm = mysql_num_rows($selectm);
if (0<$totalRowsm){
do {
	echo '<option value="'.$rowm['id_municipio'].'" ';
	echo '>'.$rowm['nombre_municipio'].'</option>';

	 } while ($rowm = mysql_fetch_assoc($selectm)); 
} else {
	
}	 
mysql_free_result($selectm);

?>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label">ASUNTO:</label> 
<textarea class="form-control" name="nombre_resolucion" id="nombre_resolucion" STYLE="height:100px;"></textarea>
</div>

 
	 
	 

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SOLICITANTE:</label> 

 &nbsp; <input id="consultanombre" value="" style="width:200px;" placeholder="Nombre" required>
<button type="button" class="btn btn-xs btn-warning" id="botonconsultanombre">
<span class="glyphicon glyphicon-search"></span></button>
<div id="resultadoconsultanombre">
</div>





</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AREA DE DESTINO:</label> 
<select  class="form-control" name="id_area" id="id_area" required>
<option value="" selected></option>
<?php echo lista('area'); ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> GRUPO DE DESTINO:</label> 
<select  class="form-control" name="id_grupo_area" id="id_grupo_area" required>
<option value="" selected></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FUNCIONARIO DE HACE LA RESOLUCIÓN:</label> 


 &nbsp; <input id="consultanombre2" value="" style="width:200px;" placeholder="Nombre" required>
<button type="button" class="btn btn-xs btn-warning" id="botonconsultanombre2">
<span class="glyphicon glyphicon-search"></span></button>
<div id="resultadoconsultanombre2">
</div>



</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE FOLIOS:</label> 
<input type="text" class="form-control numero" name="num_folios" value="" required >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FIRMADO POR :</label> 
<select  class="form-control" name="id_funcionario_firma" required>
<option value="" selected></option>

<?php
$query7 = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_tipo_oficina=1 and id_cargo=1 and estado_funcionario=1 order by nombre_funcionario asc"); 
$select7 = mysql_query($query7, $conexion) or die(mysql_error());
$row7 = mysql_fetch_assoc($select7);
$totalRows7 = mysql_num_rows($select7);
	do {
	echo '<option value="'.$row7['id_funcionario'].'">'.strtoupper($row7['nombre_funcionario']).'</option>';
	 } while ($row7 = mysql_fetch_assoc($select7)); 
	 
mysql_free_result($select7);
?>
<!--<option value="1751">Patricia Garcia Diaz</option>-->

</select>
</div>



<div class="form-group text-left">
<input type="file" name="filet" value="">
<span style="color:#aaa;font-size:13px;">PDF inferior a 11 Mg</span>
</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="resoluciondatos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>
<?php
}
?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('resolucion'); ?></h3>

              <p>Cantidad de resoluciones</p>
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
              <h3><?php
$query44m = sprintf("SELECT count(resolucion) as maximomo FROM resolucion where vigencia=".$anoactual." and estado_resolucion=1");
$selectregm = mysql_query($query44m, $conexion) or die(mysql_error());
$row1regm = mysql_fetch_assoc($selectregm);
$maximom=$row1regm['maximomo'];
echo $maximom; 
 ?></h3>

              <p>Número de resoluciones en 20<?php echo $anoactual; ?></p>
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
              <h3>
			  
<?php
$diac=date("d");
$query44r = sprintf("SELECT count(id_resolucion) as numr FROM resolucion where vigencia=".$anoactual." and DAY(fecha_sistema)=".$diac." and estado_resolucion=1");
$selectregr = mysql_query($query44r, $conexion) or die(mysql_error());
$row1regr = mysql_fetch_assoc($selectregr);
echo $row1regr['numr'];
?>

			  </h3>

              <p>Resoluciones Hoy</p>
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
              <h3><?php
			
			  $anoc=date("Y");
			  $mesc=date("m");
			  
$query44ru = sprintf("SELECT count(id_resolucion) as numre FROM resolucion where vigencia=".$anoactual." and MONTH(fecha_sistema) = ".$mesc." AND YEAR(fecha_sistema) = ".$anoc." and estado_resolucion=1");
$selectregru = mysql_query($query44ru, $conexion) or die(mysql_error());
$row1regru = mysql_fetch_assoc($selectregru);
echo $row1regru['numre'];
?></h3>
              <p>Resoluciones en el mes.</p>
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
<?php  if (0<$nump19 or 1==$_SESSION['rol']) { ?>
  
    <h3  class="box-title">

	
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nueva Resolución
      </button>&nbsp;&nbsp;&nbsp;</h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	  
	<div class="col-md-4">
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value=""> - - Buscar por: - -  </option>
     <option value="resolucion" selected>Número de resolución</option>
<option value="nombre_resolucion">Asunto</option>
<option value="quien_solicita">Solicitante</option>
<option value="fecha_exp_resolucion">Fecha de resolución</option>
<option value="nombre_funcionario">Nombre de quien firma</option>
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



<div class="col-md-3">
<?php  if (0<$nump19 or 1==$_SESSION['rol']) { ?>
  
 	
<form class="navbar-form" name="fotertrmrte5435r1erteg" method="post" action="xls/resoluciones.xls">
<div class="col-md-8">
<div class="input-group">
<div class="input-group-btn">Reporte 
<input type="text" class="form-control datepicker" style="width:100px;" name="fecha_inicial" required placeholder="Fecha inicial">

              
</div>
<div class="input-group-btn">
<input type="text" class="form-control datepicker" style="width:100px;" name="fecha_final" required placeholder="Fecha final">
</div>
  
<div class="input-group-btn">
<button type="submit" class="btn btn-danger">
<span class="glyphicon glyphicon-search"></span> Obtener </button> 
</div>
</div>
</div>
</form>
	  
<?php } else {} ?>
	  </div>
	  <div class="col-md-1">
	  <a href="resoluciones_publicas.jsp">Públicas</a>
	  </div>

  
  
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div> <!-- FINAL box-tools pull-right -->
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
<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
				  <th>VIGENCIA</th>
				  <th>RESOLUCION</th>
				    <th>FECHA</th>
					<th>SOLICITANTE</th>
					<th>ASUNTO</th>
				  <th>SOLICITUD</th>
			   	<th>DESTINO</th>
				  <th>FOLIOS</th>
				 <th>FIRMADO POR</th>
				  <th style="min-width:60px;"></th>
</tr>
</thead>
<?php 



/*
if (isset($_POST['campo']) and 'area_destino'==$_POST['campo']) {
$solicitante=" and id_tipo_oficina_p=1 and resolucion.codigo_oficina=area.id_area and area.nombre_area like '%".$_POST['buscar']."%'  ";
$infobus='';
$infop='';
$pagina=0; 
					} else {*/
						
						

	if (isset($_POST['campo']) and 'quien_solicita'==$_POST['campo']) {
$solicitante=" and (resolucion.id_funcionario_solicita=funcionario.id_funcionario and nombre_funcionario like '%".$_POST['buscar']."%') or (resolucion.id_funcionario_firma=funcionario.id_funcionario and quien_solicita like '%".$_POST['buscar']."%') ";
$infobus='';
$infop='';
$pagina=0; 
					} else {
						
			
					$solicitante=" and resolucion.id_funcionario_firma=funcionario.id_funcionario ";
						
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




				
}
		
				//	}
	 	 

$query4 = "SELECT resolucion.id_tipo_oficina as id_tipo_oficina_p, id_resolucion, bis, id_funcionario_firma, vigencia, resolucion, url_resolucion, fecha_exp_resolucion, quien_solicita, nombre_resolucion, id_funcionario_solicita, codigo_oficina, nombre_oficina, resolucion.id_grupo_area, num_folios, nombre_funcionario  FROM resolucion, funcionario where estado_resolucion=1 ".$solicitante." ".$infop." ORDER BY id_resolucion desc LIMIT 500 OFFSET ".$pagina."";
//$query4 = "SELECT * FROM resolucion where estado_resolucion=1 ".$infop." ORDER BY id_resolucion desc limit 500";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tbody>
				<tr>
				<?php
echo '<td>'.$row['vigencia'].'</td>';
echo '<td>'.$row['resolucion'].' '.$row['bis'].'</td>';
echo '<td>'.$row['fecha_exp_resolucion'].'</td>';


echo '<td>';
if (isset($row['id_funcionario_solicita'])) {
echo quees('funcionario', $row['id_funcionario_solicita']);
} else { 
echo $row['quien_solicita'];
}
echo '</td>';

echo '<td>'.$row['nombre_resolucion'].'</td>';

echo '<td>';
if (isset($row['id_tipo_oficina_p']) && ""!=$row['id_tipo_oficina_p']) {


echo quees('tipo_oficina', $row['id_tipo_oficina_p']);

echo ' - ';
$code=intval($row['id_tipo_oficina_p']);

if (isset($row['codigo_oficina'])) {

if (1==$code) {
echo quees('area', $row['codigo_oficina']);
} else if (2==$code) {
echo quees('oficina_registro', $row['codigo_oficina']);
} else if (3==$code) {
echo quees('notaria', $row['codigo_oficina']);
} else if (4==$code) {
echo quees('curaduria', $row['codigo_oficina']);

} else {}


} else {}


}	else {
	echo ''.$row['nombre_oficina'].'';	
	}
echo '</td>';

echo '<td>';
echo quees('grupo_area', $row['id_grupo_area']);
echo '</td>';
echo '<td>'.$row['num_folios'].'</td>';
echo '<td>';
if ('quien_solicita'==$_POST['campo']) {

if (isset($row['id_funcionario_firma'])) {
echo quees('funcionario', $row['id_funcionario_firma']);
} else { 
echo '';
}


	} else {
$name=$row['nombre_funcionario'];
echo strtoupper($name);
}
echo '</td>';

echo '<td>';

if (0<$nump19 or 1==$_SESSION['rol']) { 
echo '<a href="" class="buscar_resolucion" id="'.$row['id_resolucion'].'" data-toggle="modal" data-target="#popupresolucion"><i class="glyphicon glyphicon-search"></i></a>';
} else { }

if (isset($row['url_resolucion'])){
if (18==$row['vigencia']) {
echo ' <a href="files/'.$row['url_resolucion'].'" target="_blank"><img src="images/pdf.png"></a> '; 
} else {
echo ' <a href="files/resoluciones/'.$row['url_resolucion'].'" target="_blank"><img src="images/pdf.png"></a> '; 
}
} else { }

$actualizar5 = mysql_query("SELECT * from documento_resolucion where id_resolucion=".$row['id_resolucion']." and estado_documento_resolucion=1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
echo ' <a href="files/resoluciones/'.$row15['nombre_documento_resolucion'].'" target="_blank"><img src="images/pdf.png"></a> '; 
} while ($row15 = mysql_fetch_assoc($actualizar5)); 
 mysql_free_result($actualizar5);
} else {}
  
  
	if (1==$_SESSION['rol']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="resolucion" id="'.$row['id_resolucion'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	

echo '</td>';
?>
      
                  </tr>
                <?php } ?>
				
				
 <?php	if ("resolucion"==$_POST['campo'] && "7351"==$_POST['buscar']) { ?><tr>
				  <td>19</td>
				  <td>7351-b</td>
				  <td>2019-06-13</td>
				<td></td>
				<td>Resolución 7351 b</td>
				 <td></td>
			   	<td></td>
				  <td>1</td>
				  <td></td>
				 <td><a href="files/resoluciones/7351_B-2019.pdf" target="_blank"><img src="images/pdf.png"></a></td>
</tr><?php } else { } ?>
				
				
	 <?php	if ("resolucion"==$_POST['campo'] && "8120"==$_POST['buscar']) { ?><tr>
				  <td>19</td>
				  <td>8120-b</td>
				  <td>2019-07-03</td>
				<td></td>
				<td>Resolución 8120 b</td>
				 <td></td>
			   	<td></td>
				  <td>1</td>
				  <td></td>
				 <td><a href="files/resoluciones/8120_B-2109.pdf" target="_blank"><img src="images/pdf.png"></a></td>
</tr><?php } else { } ?>


 <?php	if ("resolucion"==$_POST['campo'] && "13685"==$_POST['buscar']) { ?><tr>
				  <td>19</td>
				  <td>13685-b</td>
				  <td>2019-10-23</td>
				<td></td>
				<td>Resolución 13685 b</td>
				 <td></td>
			   	<td></td>
				  <td>1</td>
				  <td></td>
				 <td><a href="files/resoluciones/13685_B-2019.pdf" target="_blank"><img src="images/pdf.png"></a></td>
				 
</tr><?php } else { } ?>		 
				 
	 <?php	if ("resolucion"==$_POST['campo'] && "02230"==$_POST['buscar']) { ?><tr>
				  <td>20</td>
				  <td>02230-b</td>
				  <td>2020-03-02</td>
				<td></td>
				<td>Resolución 02230 b</td>
				 <td></td>
			   	<td></td>
				  <td>1</td>
				  <td></td>
				 <td><a href="files/resoluciones/02230-b-2020.pdf" target="_blank"><img src="images/pdf.png"></a></td>
				 
				 
				 			 
				 
				 
</tr><?php } else { } ?>

			
				
				
				
				
                </tbody>
          
         </table>
		 
		 
		 
 <?php
 if (isset($_POST['buscar'])) { } else {
	 
$selectfrz = mysql_query("select count(id_resolucion) as cuentarel from resolucion where estado_resolucion=1", $conexion);
$rowfrz = mysql_fetch_assoc($selectfrz);
$totalr=$rowfrz['cuentarel'];
$maxp=$totalr/500;
$maxp2=intval($maxp);
$maxp3=$maxp2*500;
  
 if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
		
		
echo '<hr>Paginación:  &nbsp;  <a href="resoluciones.jsp">Inicio</a> &nbsp;  ';

if (500<$pagina) {
$menosp=$pagina-500;
echo ' <a href="resoluciones&'.$menosp.'.jsp">Anterior</a> &nbsp;  ';	
} else {
echo '';
}


if ($pagina<$maxp3) {
$masp=$pagina+500;
echo '<a href="resoluciones&'.$masp.'.jsp">Siguiente</a> &nbsp; ';
} else {
echo '';
}


echo '<a href="resoluciones&'.$maxp3.'.jsp">Final</a> ';
	
		
	 } else {

	 

echo '<hr>Paginación:  &nbsp;  <a href="resoluciones&500.jsp">Siguiente</a> &nbsp; <a href="resoluciones&'.$maxp3.'.jsp">Final</a> ';
		
	 }
	 
		 } 
	 ?>
		 
		 
		
			 
			 
			 	
		
				
		
			 
		 	  <script>
					      	$(document).ready(function() {
							  $('#inforesoluciones').DataTable({
							    "language": {
							      "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
							    },
								"aaSorting": [[ 1, "desc"]]
							  });
							});
					    </script>


						
					</div>
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div> <!-- FINAL DE ROW -->


<?php if (0<$nump19 or 1==$_SESSION['rol']) { ?>

<div class="modal fade" id="popupresolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Resolución</label></h4>
</div> 
<div class="ver_resolucion"> 





</div>
</div> 
</div> 
</div> 



<?php } else { }?>





