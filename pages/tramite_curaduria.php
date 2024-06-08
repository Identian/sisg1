<?php
if (isset($_GET['i'])) {
	$id=$_GET['i'];
	
	
$nump21=privilegios(21,$_SESSION['snr']);
	
	
$query4 = sprintf("SELECT * FROM licencia_curaduria where id_licencia_curaduria='$id' limit 1"); 
$select4 = mysql_query($query4, $conexion);
$row14 = mysql_fetch_assoc($select4);
$id_curaduria = $row14['id_curaduria'];
	
if (1==$_SESSION['rol'] or 0<$nump21) {
$query99 = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=".$id_curaduria." limit 1"); 

} 
else {
	/*
if (17==$id_curaduria && 1==2) {
	$idfun=intval($_SESSION['snr']);
	$query99 = sprintf("SELECT * FROM curaduria, funcionario, relacion_curaduria where funcionario.id_funcionario=".$idfun." and relacion_curaduria.id_funcionario=funcionario.id_funcionario and  relacion_curaduria.id_curaduria=curaduria.id_curaduria and curaduria.id_curaduria=".$id_curaduria." limit 1"); 
} else {
		*/
$idfun=intval($_SESSION['snr']);
$query99 = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where funcionario.id_funcionario=".$idfun." and situacion_curaduria.fecha_terminacion>='$realdate' and curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=".$id_curaduria." and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1"); 
//}

}
$select99 = mysql_query($query99, $conexion);
$row199 = mysql_fetch_assoc($select99);
$totalRows99 = mysql_num_rows($select99);
if (0<$totalRows99) {
	
	
$name = $row199['nombre_curaduria'];
$dep = $row199['departamento_curaduria'];
$tele = $row199['telefono_curaduria'];
$celu = $row199['celular_curaduria'];
$dire = $row199['direccion_curaduria'];
$correo = $row199['correo_funcionario'];
$ncuraduria=str_replace("Curaduria ","",$name);
$correo_curaduria = $row199['correo_curaduria'];
$id_departamento = $row199['id_departamento'];
$id_municipio = $row199['id_municipio'];

//$ciudade=nombre_municipio($id_municipio, $id_departamento);


if ((isset($_POST["table"])) && ($_POST["table"] == "estado_licencia_curaduria") && ""!=$_POST["vigencia_total"]) { 



$updateSQL7799 = sprintf("UPDATE licencia_curaduria SET licencia_cerrada=1, vigencia_total_l=%s, fecha_terminacion_l=%s WHERE id_licencia_curaduria=%s",                  
					  GetSQLValueString($_POST["vigencia_total"], "text"),
					  GetSQLValueString($_POST["fecha_terminacion"], "date"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion);




echo $hecho;
} else { }




	
if ((isset($_POST["table"])) && ($_POST["table"] == "licencia_curaduria")) { 

$radicadop=$_POST["depmun"].'-'.$_POST["ano_licencia2"].'-'.$_POST["nombre_licencia_curaduria2"];




$fecha_radicacion=date('Y-m-d', strtotime($_POST["fecha_radicacion"]));
$fecha_expedicion=date('Y-m-d', strtotime($_POST["fecha_expedicion"]));
$fecha_ejecutoria=date('Y-m-d', strtotime($_POST["fecha_ejecutoria"]));

if ($fecha_radicacion<$fecha_expedicion && $fecha_radicacion<$fecha_ejecutoria && $fecha_ejecutoria>=$fecha_expedicion) {



if (0<$nump21 or 1==$_SESSION['rol']) { 
$situacion_licenciaf=$_POST["situacion_licencia"];


if (0==$situacion_licenciaf) {
	
	
$Result00 = mysql_query("UPDATE tipo_autorizacion_licencia SET situacion_tipo_autorizacion_licencia=0 where id_licencia_curaduria=".$id." and estado_tipo_autorizacion_licencia=1", $conexion) or die(mysql_error());
$Result01 = mysql_query("UPDATE uso_aprobado_licencia SET situacion_uso_aprobado_licencia=0 where id_licencia_curaduria=".$id." and estado_uso_aprobado_licencia=1", $conexion) or die(mysql_error());
$Result02 = mysql_query("UPDATE titular_licencia SET situacion_titular_licencia=0 where id_licencia_curaduria=".$id." and estado_titular_licencia=1", $conexion) or die(mysql_error());
$Result03 = mysql_query("UPDATE uso_parqueo_licencia SET situacion_uso_parqueo_licencia=0 where id_licencia_curaduria=".$id." and estado_uso_parqueo_licencia=1", $conexion) or die(mysql_error());
$Result04 = mysql_query("UPDATE inmueble_licencia SET situacion_inmueble_licencia=0 where id_licencia_curaduria=".$id." and estado_inmueble_licencia=1", $conexion) or die(mysql_error());
$Result05 = mysql_query("UPDATE costo_licencia SET situacion_costo_licencia=0 where id_licencia_curaduria=".$id." and estado_costo_licencia=1", $conexion) or die(mysql_error());
$Result06 = mysql_query("UPDATE documento_licencia SET situacion_documento_licencia=0 where id_licencia_curaduria=".$id." and estado_documento_licencia=1", $conexion) or die(mysql_error());

 
	
} else {}



} else {
	$situacion_licenciaf=1;
}

$updateSQL77 = sprintf("UPDATE licencia_curaduria SET id_curaduria=%s, nombre_licencia_curaduria=%s, situacion_licencia=%s, fecha_radicacion=%s, fecha_viabilidad=%s, fecha_expedicion=%s, 
fecha_ejecutoria=%s, n_acto_administrativo=%s, certificado_ocupacion=%s, autorizacion_ocupacion=%s, observacion_licencia=%s, id_estado_lic_curaduria=%s, id_objeto_lic_curaduria=%s

where id_licencia_curaduria=%s",
GetSQLValueString($id_curaduria, "int"), 
GetSQLValueString($radicadop, "text"), 
GetSQLValueString($situacion_licenciaf, "int"), 
GetSQLValueString($_POST["fecha_radicacion"], "date"), 
GetSQLValueString($_POST["fecha_viabilidad"], "date"), 
GetSQLValueString($_POST["fecha_expedicion"], "date"), 
GetSQLValueString($_POST["fecha_ejecutoria"], "date"), 
GetSQLValueString($_POST["n_acto_administrativo"], "text"), 
GetSQLValueString($_POST["certificado_ocupacion"], "text"), 
GetSQLValueString($_POST["autorizacion_ocupacion"], "text"), 
GetSQLValueString($_POST["observacion_licencia"], "text"), 
GetSQLValueString($_POST["id_estado_lic_curaduria"], "int"), 
GetSQLValueString($_POST["id_objeto_lic_curaduria"], "int"), 


GetSQLValueString($id, "int"));

 $Result = mysql_query($updateSQL77, $conexion) or die(mysql_error());

 echo $actualizado;
 
 
 } else {
echo '<div class="alert alert-danger" role="alert"><a href="" class="close" style="text-decoration:none;">&times;</a>Las fechas no estan de acuerdo al orden cronológico.</div>';
	}

} else {}




	
	
$query_update = sprintf("SELECT * FROM licencia_curaduria WHERE id_licencia_curaduria = %s and estado_licencia_curaduria=1 ", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_updatett = mysql_num_rows($update);
if (0<$totalRows_updatett) {
$licencia=$row_update['nombre_licencia_curaduria'];
$n_acto_administrativo=$row_update['n_acto_administrativo'];
$responsable=$row_update['id_funcionario'];
$observacion_licencia=$row_update['observacion_licencia'];
$certificado_ocupacion=$row_update['certificado_ocupacion'];
$autorizacion_ocupacion=$row_update['autorizacion_ocupacion'];
$fecha_radicacion=$row_update['fecha_radicacion'];
$fecha_viabilidad=$row_update['fecha_viabilidad'];
$fecha_expedicion=$row_update['fecha_expedicion'];
$fecha_ejecutoria=$row_update['fecha_ejecutoria'];
$licencia_cerrada=intval($row_update['licencia_cerrada']);
$situacion_licencia=intval($row_update['situacion_licencia']);
if (isset($row_update['vigencia_total_l']) && ""!=$row_update['vigencia_total_l']){
$vigencia_total_l=$row_update['vigencia_total_l'];
} else {$vigencia_total_l="";} 
if (isset($row_update['fecha_terminacion_l']) && ""!=$row_update['fecha_terminacion_l']){
$fecha_terminacion_l=$row_update['fecha_terminacion_l'];
} else {$fecha_terminacion_l="";} 	
	


if (0<$licencia_cerrada){
	$estado=1;
} else {
	$estado=0;
	
}
mysql_free_result($select47);





} else { }

mysql_free_result($update);











?>

<?php



$query_update = sprintf("SELECT * FROM licencia_curaduria WHERE id_licencia_curaduria = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){



?>




<div class="modal fade" id="popupactualizacionlicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">RADICACIÓN DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form432545122">
<input type="hidden" name="table" value="licencia_curaduria">

<?php $infolc=$row_update['nombre_licencia_curaduria'];
$inli=explode("-", $infolc);
$totl=$inli[0].'-'.$inli[1];
$anoll=$inli[2];
$totlyy=$inli[3];

 ?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DEL PROYECTO:</label> 
<div class="input-group">



<input type="hidden" name="depmun" value="<?php echo $totl; ?>">

<span class="input-group-addon"><?php echo $totl.'-'; ?></span>
 <span class="input-group-addon">
<select name="ano_licencia2" required>

<?php 
//$anoactualcompleto
for ($in=15; $in <=$anoactual; $in++) {
echo '<option value="'.$in.'" ';
if ($anoll==$in) { echo 'selected'; } else {}
echo '>'.$in.'</option>';
}

?>

</select>
</span>
 <span class="input-group-addon">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria2" style="width:50px;" value="<?php echo $totlyy; ?>" maxlength="4" required>
</span>
</div>

</div>


<?php if (0<$nump21 or 1==$_SESSION['rol']) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SITUACIÓN DE LA LICENCIA :</label>   
<select type="text" class="form-control" name="situacion_licencia"  required>
<option value="1" <?php if (1==$row_update['situacion_licencia']) { echo 'selected'; } else {} ?>>Activa</option>
<option value="0" <?php if (0==$row_update['situacion_licencia']) { echo 'selected'; } else {} ?>>Anulada</option>
</select>
</div>
<?php } else {} ?>




<?php if (1==$_SESSION['rol'] or 0<$nump21) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTADO DEL TRAMITE:</label> 
<select  class="form-control" name="id_estado_lic_curaduria" required>

	<?php
$actualizar5 = mysql_query("SELECT * FROM estado_lic_curaduria WHERE estado_estado_lic_curaduria=1 order by id_estado_lic_curaduria", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
   echo '<option value="'.$row15['id_estado_lic_curaduria'].'" ';
   if ($row_update['id_estado_lic_curaduria']==$row15['id_estado_lic_curaduria']) { echo 'selected';} else {}
   echo '>'.$row15['nombre_estado_lic_curaduria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>

</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OBJETO DEL TRAMITE:</label> 
<select  class="form-control" name="id_objeto_lic_curaduria" required>

	<?php
$actualizar5 = mysql_query("SELECT * FROM objeto_lic_curaduria WHERE estado_objeto_lic_curaduria=1 order by id_objeto_lic_curaduria", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
   echo '<option value="'.$row15['id_objeto_lic_curaduria'].'" ';
     if ($row_update['id_objeto_lic_curaduria']==$row15['id_objeto_lic_curaduria']) { echo 'selected';} else {}
   echo '>'.$row15['nombre_objeto_lic_curaduria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>

</select>
</div>

<?php } else {} ?>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION EN LEGAL Y DEBIDA FORMA:</label>   
<input type="text" readonly="readonly" required class="form-control datepicker" name="fecha_radicacion"  value="<?php echo $row_update['fecha_radicacion']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL ACTA DE VIABILIDAD:</label>   
<input type="text" readonly="readonly" required class="form-control datepicker" name="fecha_viabilidad"  value="<?php echo $row_update['fecha_viabilidad']; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICION:</label>   
<input type="text" readonly="readonly" required class="form-control datepicker" name="fecha_expedicion"  value="<?php echo $row_update['fecha_expedicion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EJECUTORIA:</label>   
<input type="text" readonly="readonly" required class="form-control datepicker" name="fecha_ejecutoria"  value="<?php echo $row_update['fecha_ejecutoria']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE ACTO DE ADMINISTRATIVO:</label>   
<input type="text" required class="form-control" name="n_acto_administrativo"  required value="<?php echo $row_update['n_acto_administrativo']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE CERTIFICACIÓN TECNICA DE OCUPACIÓN:</label>   
<select class="form-control" name="certificado_ocupacion"  required>
<option value="SI" <?php if ('SI'==$row_update['certificado_ocupacion']) { echo 'selected'; } else {} ?>>SI</option>
<option value="NO" <?php if ('NO'==$row_update['certificado_ocupacion']) { echo 'selected'; } else {} ?>>NO</option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE AUTORIZACIÓN DE OCUPACIÓN DE INMUEBLE:</label>   
<select type="text" class="form-control" name="autorizacion_ocupacion"  required>
<option value="SI" <?php if ('SI'==$row_update['autorizacion_ocupacion']) { echo 'selected'; } else {} ?>>SI</option>
<option value="NO" <?php if ('NO'==$row_update['autorizacion_ocupacion']) { echo 'selected'; } else {} ?>>NO</option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OBSERVACION:</label> 
<span style="color:#ff0000;">(En caso de que el número de radicado sea de hace dos años, informar el motivo.)</span>
<textarea class="form-control" name="observacion_licencia" required ><?php echo $row_update['observacion_licencia']; ?></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 
<?php 
}

mysql_free_result($update);

?>



<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "tipo_autorizacion_licencia")) { 


$id_clase_licencia=$_POST["id_clase_licencia"];


$actualizar568 = mysql_query("SELECT id_tipo_autorizacion_licencia FROM tipo_autorizacion_licencia WHERE id_licencia_curaduria='$id' and estado_tipo_autorizacion_licencia=1", $conexion) or die(mysql_error());
$row1568 = mysql_fetch_assoc($actualizar568);
$total5568 = mysql_num_rows($actualizar568);
if (1<$total5568) {
	echo $nopermitido;
} else {
	
	

$actualizar56 = mysql_query("SELECT id_tipo_autorizacion_licencia FROM tipo_autorizacion_licencia WHERE id_licencia_curaduria='$id' and id_clase_licencia='$id_clase_licencia' and estado_tipo_autorizacion_licencia=1", $conexion) or die(mysql_error());
$row156 = mysql_fetch_assoc($actualizar56);
$total556 = mysql_num_rows($actualizar56);
if (0<$total556) {
	echo $nopermitido;
} else {
	
	
if (""==$_POST["vigencia_reconocimiento"]) {
	$reconocimientov=0;
} 
else {
	
	$reconocimientov=$_POST["vigencia_reconocimiento"];
} 


	
	
	
$insertSQL = sprintf("INSERT INTO tipo_autorizacion_licencia (id_licencia_curaduria, nombre_tipo_autorizacion_licencia, id_clase_licencia, vigencia_reconocimiento, lotes_resultantes, estado_tipo_autorizacion_licencia, situacion_tipo_autorizacion_licencia) VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($name, "text"), 
GetSQLValueString($id_clase_licencia, "int"), 
GetSQLValueString($reconocimientov, "int"), 
GetSQLValueString($_POST["lotes_resultantes"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
}
}
} else { }
?>


<div class="modal fade" id="popupnewtiposlicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">RADICACIÓN DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form122">
<input type="hidden" name="table" value="tipo_autorizacion_licencia">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE AUTORIZACIÓN:</label> 
<select  class="form-control mayuscula" name="id_clase_licencia" id="id_clase_licencia" required>
<option selected></option>
<?php echo lista('clase_licencia');  ?>
</select>
</div>


<div class="form-group text-left" id="vigencia_reconocimiento" style="display:none;"> 
<label  class="control-label">VIGENCIA DEL RECONOCIMIENTO:</label> 


<select name="" required id="reconocimiento_vigencia2">
<option value="1">Si</option>
<option value="0" selected>No</option>
</select>

<input disabled="disabled" type="text" class="form-control mayuscula numero" name="vigencia_reconocimiento" id="vigencia_reconocimiento1" placeholder="En meses">

</div>

<div class="form-group text-left" id="lotes_resultantes" style="display:none;"> 
<label  class="control-label">NÚMERO DE LOTES RESULTANTES:</label> 
<input type="text" class="form-control mayuscula numero" name="lotes_resultantes" id="lotes_resultantes1" >
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success vigenciab">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 







<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "uso_aprobado_licencia")) { 
$insertSQL = sprintf("INSERT INTO uso_aprobado_licencia (id_licencia_curaduria, nombre_uso_aprobado_licencia, id_uso_aprobado, otro_uso, unidades_uso_aprobado, estado_uso_aprobado_licencia, situacion_uso_aprobado_licencia) VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($name, "text"), 
GetSQLValueString($_POST["id_uso_aprobado"], "int"), 
GetSQLValueString($_POST["otro_uso"], "text"), 
GetSQLValueString($_POST["unidades_uso_aprobado"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} else {}
?>


<div class="modal fade" id="popupnewusoslicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">USOS APROBADOS DEL RADICADO DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form12asd2">

<input type="hidden" name="table" value="uso_aprobado_licencia">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> USOS APROBADOS:</label> 
<select  class="form-control mayuscula" name="id_uso_aprobado" id="id_uso_aprobado" required>
<option selected></option>
<?php echo lista('uso_aprobado');  ?>
</select>
</div>


<div class="form-group text-left" style="display:none;" id="cual"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ¿CUAL?:</label> 
<input type="text" class="form-control mayuscula" name="otro_uso" id="otro_uso">
</div>

<div class="form-group text-left"> 
<label  class="control-label">UNIDADES DE USOS APROBADOS:</label> 
<input type="text" class="form-control mayuscula numero" name="unidades_uso_aprobado">
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 










<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "uso_parqueo_licencia")) { 
$insertSQL = sprintf("INSERT INTO uso_parqueo_licencia (id_licencia_curaduria, nombre_uso_parqueo_licencia, id_tipo_parqueadero_licencia, unidades_parqueadero, estado_uso_parqueo_licencia, situacion_uso_parqueo_licencia) VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString('', "text"), 
GetSQLValueString($_POST["id_tipo_parqueadero_licencia"], "int"), 
GetSQLValueString($_POST["unidades_parqueadero"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} else {}
?>


<div class="modal fade" id="popupnewusosparqueolicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">USOS DE PARQUEADERO DEL RADICADO DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form3245345122">

<input type="hidden" name="table" value="uso_parqueo_licencia">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PARQUEADEROS:</label> 
<select  class="form-control mayuscula" name="id_tipo_parqueadero_licencia" id="id_tipo_parqueadero_licencia" required>
<option selected></option>
	<?php
$actualizar5 = mysql_query("SELECT * FROM tipo_parqueadero_licencia WHERE estado_tipo_parqueadero_licencia=1 order by id_tipo_parqueadero_licencia", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
   echo '<option value="'.$row15['id_tipo_parqueadero_licencia'].'" ';
   echo '>'.$row15['nombre_tipo_parqueadero_licencia'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">UNIDADES DE PARQUEADERO:</label> 
<input type="text" class="form-control mayuscula numero" name="unidades_parqueadero">
</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 








<?php
/*
if ((isset($_POST["table"])) && ($_POST["table"] == "costo_licencia")) { 
$insertSQL = sprintf("INSERT INTO costo_licencia (id_licencia_curaduria, nombre_costo_licencia, cargo_fijo, cargo_variable, estado_costo_licencia, situacion_costo_licencia) VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString('', "text"), 
GetSQLValueString($_POST["cargo_fijo"], "text"), 
GetSQLValueString($_POST["cargo_variable"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} else {}
*/
?>

<!--
<div class="modal fade" id="popupcostolicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">COSTO DEL RADICADO DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form3245343543545122">

<input type="hidden" name="table" value="costo_licencia">


<div class="form-group text-left"> 
<label  class="control-label">CARGO FIJO: <span style="color:#ff0000;">(Sin IVA)</span></label> 
<input type="text" class="form-control  numerodecimal" name="cargo_fijo">
</div>


<div class="form-group text-left"> 
<label  class="control-label">CARGO VARIABLE: <span style="color:#ff0000;">(Sin IVA)</span></label> 
<input type="text" class="form-control  numerodecimal" name="cargo_variable">
</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 
-->





<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "titular_licencia")) { 
$insertSQL = sprintf("INSERT INTO titular_licencia (id_licencia_curaduria, id_tipo_documento, identificacion_titular, nombre_titular_licencia, estado_titular_licencia, situacion_titular_licencia) VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_tipo_documento"], "int"), 
GetSQLValueString($_POST["identificacion_titular"], "text"), 
GetSQLValueString($_POST["nombre_titular_licencia"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} else { }
?>


<div class="modal fade" id="popupnewagenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">TITULARES DEL RADICADO DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form122">
<input type="hidden" name="id_licencia_curaduria" value="" class="licencia" required>
<input type="hidden" name="table" value="titular_licencia">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de documento</label> 
<select class="form-control mayuscula" name="id_tipo_documento" required>
<option selected></option>
<?php
$actualizar5 = mysql_query("SELECT * FROM tipo_documento WHERE estado_tipo_documento=1 order by nombre_tipo_documento", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 //echo '<option value="" selected></option>';
 do {
   echo '<option value="'.$row15['id_tipo_documento'].'" ';
   echo '>'.$row15['nombre_tipo_documento'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número</label> 
<input type="text" value="" class="form-control mayuscula" name="identificacion_titular" required>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre</label> 
<input type="text" value="" class="form-control mayuscula" name="nombre_titular_licencia" required>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 



<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "inmueble_licencia")) { 

$matricula=$_POST["circulo"].'-'.$_POST["fmi_matricula"];
$area=$_POST["area_predio"].' '.$_POST["unidadmedida"];

if (2==$_POST["id_tipo_predio"]) {

$direccion_inmueble=$_POST["dir1"].' '.$_POST["dir2"].' # '.$_POST["dir3"].' - '.$_POST["dir4"].' / '.$_POST["dir5"];
} else {
	$direccion_inmueble=$_POST["direccion_inmueble"];
	
}


$insertSQL = sprintf("INSERT INTO inmueble_licencia (id_licencia_curaduria, nombre_inmueble_licencia, id_tipo_predio, fmi_matricula, cedula_catastral, area_predio, direccion_inmueble, estrato, localidad, sector, barrio, vereda, corregimiento, manzana, lote, estado_inmueble_licencia, situacion_inmueble_licencia) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($name, "text"), 
GetSQLValueString($_POST["id_tipo_predio"], "int"), 
GetSQLValueString($matricula, "text"), 
GetSQLValueString($_POST["cedula_catastral"], "text"), 
GetSQLValueString($area, "text"), 
GetSQLValueString($direccion_inmueble, "text"), 
GetSQLValueString($_POST["estrato"], "text"), 
GetSQLValueString($_POST["localidad"], "text"), 
GetSQLValueString($_POST["sector"], "text"), 
GetSQLValueString($_POST["barrio"], "text"), 
GetSQLValueString($_POST["vereda"], "text"), 
GetSQLValueString($_POST["corregimiento"], "text"), 
GetSQLValueString($_POST["manzana"], "text"), 
GetSQLValueString($_POST["lote"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} else { }
?>
<div class="modal fade" id="popupnewinmueble" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">INMUEBLES DEL RADICADO DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form122435">
<input type="hidden" name="table" value="inmueble_licencia">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de predio</label> 
<select class="form-control mayuscula" name="id_tipo_predio" required id="tipo_predio">
<option selected></option>
<?php
$actualizar5 = mysql_query("SELECT * FROM tipo_predio WHERE estado_tipo_predio=1 order by nombre_tipo_predio", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 //echo '<option value="" selected></option>';
 do {
   echo '<option value="'.$row15['id_tipo_predio'].'" ';
   echo '>'.$row15['nombre_tipo_predio'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>
</select>
</div>


<div class="form-group text-left" id="urbano" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dirección:</label> 

 <div class="input-group">
 <select class="form-control" name="dir1" id="urbano1" style="min-width:150px;">
<option value="" selected></option>
<option value="Calle">Calle</option>
<option value="Carrera">Carrera</option>
<option value="Avenida">Avenida</option>
<option value="Avenida Carrera">Avenida Carrera</option>
<option value="Avenida Calle">Avenida Calle</option>
<option value="Circular">Circular</option>
<option value="Circunvalar">Circunvalar</option>
<option value="Diagonal">Diagonal</option>
<option value="Transversal">Transversal</option>
<option value="Manzana">Manzana</option>
<option value="Supermanzana">Supermanzana</option>
<option value="Lote">Lote</option>
<option value="Vía">Vía</option>
</select>
<span class="input-group-addon">:</span>
<input type="text" class="form-control " name="dir2" value="">
  <span class="input-group-addon">#</span>
	<input type="text" class="form-control " name="dir3" value="">
	 <span class="input-group-addon">-</span>
	<input type="text" class="form-control" name="dir4">
	  </div> 
	
 <div class="input-group">
  <span class="input-group-addon">Torre, Bloque, Apartamento, Casa:</span>
	<input type="text" class="form-control " name="dir5" value="">

 </div> 
	 </div>   
	  
	  
	  
	  <div class="form-group text-left" id="rural"  style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dirección o nombre del predio</label> 
<input type="text" id="rural1" value="" class="form-control mayuscula" name="direccion_inmueble">
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Matricula Inmobiliaria</label> 
<!--<input type="text" value="" class="form-control mayuscula" name="fmi_matricula" required>-->
<div class="input-group">
<span class="input-group-addon">
  <select name="circulo" required>
  <option value="">Circulo</option>
  <?php
$actualizar5 = mysql_query("SELECT * FROM oficina_registro, curaduria_orip WHERE oficina_registro.id_oficina_registro=curaduria_orip.id_oficina_registro and curaduria_orip.id_curaduria='$id_curaduria' and estado_oficina_registro=1 order by nombre_oficina_registro", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 //echo '<option value="" selected></option>';
 do {
   echo '<option value="'.$row15['circulo'].'" ';
   echo '>'.$row15['nombre_oficina_registro'].' - '.$row15['circulo'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>
  
  
  </select>
  </span>
  <input type="text" class="form-control mayuscula numero" name="fmi_matricula" required >
</div>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cedula catastral ó chip</label> 
<input type="text" value="" class="form-control mayuscula" name="cedula_catastral" required>
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Area del predio</label> 
<div class="input-group">
<span class="input-group-addon">
  <select name="unidadmedida" required>
  <option value="">Unidad de Medida</option>
  <option value="Metros">Metros</option>
  <option value="Hectarias">Hectarias</option>
    </select>
  </span>
  <input type="text" class="form-control mayuscula numerodecimal" name="area_predio" required >
</div>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Estrato</label> 
<input type="text" value="" class="form-control mayuscula" name="estrato">
</div>

<hr>


<div class="form-group text-left"> 
<label  class="control-label">Comuna ó localidad</label> 
<input type="text" value="" class="form-control mayuscula" name="localidad">
</div>

<div class="form-group text-left"> 
<label  class="control-label">Sector</label> 
<input type="text" value="" class="form-control mayuscula" name="sector">
</div>


<div class="form-group text-left"> 
<label  class="control-label">Barrio ó Urbanización</label> 
<input type="text" value="" class="form-control mayuscula" name="barrio">
</div>

<div class="form-group text-left"> 
<label  class="control-label">Vereda</label> 
<input type="text" value="" class="form-control mayuscula" name="vereda">
</div>


<div class="form-group text-left"> 
<label  class="control-label">Corregimiento</label> 
<input type="text" value="" class="form-control mayuscula" name="corregimiento">
</div>


<div class="form-group text-left"> 
<label  class="control-label">Manzana</label> 
<input type="text" value="" class="form-control mayuscula" name="manzana">
</div>

<div class="form-group text-left"> 
<label  class="control-label">Lote</label> 
<input type="text" value="" class="form-control mayuscula" name="lote">
</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 




<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "documento_licencia")) { 



$tamano_archivo=15728640; //10485760;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$carpeta_archivo="files/licenciassnr/";
$ruta_archivo = date("YmdGis").'&'.base64_encode($_FILES['file']['tmp_name']);


 if (""!=$_FILES['file']['tmp_name']){
	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);


if (($tam_archivo==$tam_archivo2) and ($tamano_archivo>$tam_archivo)) {
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo.$files);
 // chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  $hash=md5($files);


$insertSQL = sprintf("INSERT INTO documento_licencia (id_licencia_curaduria, id_tipo_file_licencia, nombre_documento_licencia, url_documento_licencia, hash_documento, estado_documento_licencia, cantidad_planos_estructurales, cantidad_planos_arquitectonicos, cantidad_planos_subdivision, cantidad_planos_urbanizacion, cantidad_planos_parcelacion, estudio_suelo, memorias_calculo, situacion_documento_licencia) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
 GetSQLValueString($id, "int"), 
 GetSQLValueString(1, "int"),
 GetSQLValueString('Acto Administrativo', "text"), 
 GetSQLValueString($files, "text"), 
 GetSQLValueString($hash, "text"), 
 GetSQLValueString(1, "int"),
 GetSQLValueString($_POST['cantidad_planos_estructurales'], "int"),
 GetSQLValueString($_POST['cantidad_planos_arquitectonicos'], "int"),
 GetSQLValueString($_POST['cantidad_planos_subdivision'], "int"),
 GetSQLValueString($_POST['cantidad_planos_urbanizacion'], "int"),
 GetSQLValueString($_POST['cantidad_planos_parcelacion'], "int"),
 GetSQLValueString($_POST['estudio_suelo'], "int"),
 GetSQLValueString($_POST['memorias_calculo'], "int"),
  GetSQLValueString(1, "int"));
 


$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;

    } else { $valido=0; echo  $doc_no_tipo;
			}
} else { $valido=0; echo $doc_tam;
		}
	
	
	

} else { 
echo $doc_tam;

}

} else { }
?>
<div class="modal fade" id="popupnewdocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">DOCUMENTOS Y PLANOS DEL PROYECTO: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form1224355447" enctype="multipart/form-data">
<input type="hidden" name="id_licencia_curaduria" value="" class="licencia">
<input type="hidden" name="table" value="documento_licencia">


<div class="form-group text-left"> 
<label  class="control-label">Cantidad de Planos estructurales:</label> 
<input type="text" value="" class="form-control numero" name="cantidad_planos_estructurales" >
</div>
<div class="form-group text-left"> 
<label  class="control-label">Cantidad de Planos arquitectonicos:</label> 
<input type="text" value="" class="form-control numero" name="cantidad_planos_arquitectonicos" >
</div>
<div class="form-group text-left"> 
<label  class="control-label">Cantidad de Planos de subdivisión:</label> 
<input type="text" value="" class="form-control numero" name="cantidad_planos_subdivision" >
</div>
<div class="form-group text-left"> 
<label  class="control-label">Cantidad de Planos de urbanización:</label> 
<input type="text" value="" class="form-control numero" name="cantidad_planos_urbanizacion" >
</div>
<div class="form-group text-left"> 
<label  class="control-label">Cantidad de Planos de Parcelación:</label> 
<input type="text" value="" class="form-control numero" name="cantidad_planos_parcelacion" >
</div>

<?php
$nump144=privilegios(144,$_SESSION['snr']);
if (0<$nump144) {
	$req='';
} else {
	$req='required';
}

?>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tiene estudio de suelo:</label> 
<select name="estudio_suelo" <?php echo $req; ?>>
<option value="" selected></option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tiene memorias de calculo:</label> 
<select name="memorias_calculo" <?php echo $req; ?>>
<option value="" selected></option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
</div>






<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Adjuntar acto administrativo:</label> 
<input type="file" value=""  name="file" required>
<span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 15 Megas.)</span>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>

</div>
</div> 
</div> 
</div>




















<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "correccion_licencia")) { 



$tamano_archivo=15728640;  //10485760;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$carpeta_archivo="files/";
$ruta_archivo = 'correccion_licencia_'.date("YmdGis").'&'.base64_encode($_FILES['file']['tmp_name']);


 if (""!=$_FILES['file']['tmp_name']){
	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);


if (($tam_archivo==$tam_archivo2) and ($tamano_archivo>$tam_archivo)) {
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo.$files);
 // chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);


  
  
  

$insertSQL = sprintf("INSERT INTO correccion_licencia (nombre_correccion_licencia, adjunto_url, fecha_correccion_licencia, id_licencia_curaduria, radicado_entrada, estado_correccion_licencia) VALUES (%s, %s, now(), %s, %s, %s)", 
GetSQLValueString($_POST['nombre_correccion_licencia'], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["radicado_entrada"], "text"), 
GetSQLValueString(1, "int"));
 
 


$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;

    } else { $valido=0; echo  $doc_no_tipo;
			}
} else { $valido=0; echo $doc_tam;
		}
	
	
	

} else { 
echo $doc_tam;

}

} else { }
?>
<div class="modal fade" id="popupnewcorreccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">CORRECCIONES DE LA LICENCIA: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1224355447" enctype="multipart/form-data">
<input type="hidden" name="id_licencia_curaduria" value="" class="licencia">
<input type="hidden" name="table" value="correccion_licencia">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Radicado de entrada:</label> 
<input type="text" value="" name="radicado_entrada" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Descripcion de la corrección:</label> 
<textarea class="textarea" id="texto_modelo_respuesta_pqrs" name="nombre_correccion_licencia">
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Adjuntar oficio de soporte:</label> 
<input type="file" value=""  name="file" required>
<span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 15 Megas.)</span>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div>




<div class="modal fade" id="popupnewexpediente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">AGREGAR DOCUMENTO AL EXPEDIENTE: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1224355447" enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre del archivo:</label> 
<input type="text" value=""  class="form-control" name="nombre_expediente_licencia" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Archivo :</label> 
<input type="file" value=""  name="file" required>
<span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 15 Megas.)</span>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div>












<?php
if ((isset($_POST["nombre_expediente_licencia"])) && ($_POST["nombre_expediente_licencia"] != "")) { 

$tamano_archivo=15728640; //10485760;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$carpeta_archivo="files/";
$ruta_archivo = 'expediente_licencia_'.date("YmdGis").'&'.base64_encode($_FILES['file']['tmp_name']);


 if (""!=$_FILES['file']['tmp_name']){
	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);


if (($tam_archivo==$tam_archivo2) and ($tamano_archivo>$tam_archivo)) {
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $filest = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo.$filest);
 // chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);


$insertSQL = sprintf("INSERT INTO expediente_licencia (nombre_expediente_licencia, url, 
id_licencia_curaduria, estado_expediente_licencia) VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST['nombre_expediente_licencia'], "text"),
GetSQLValueString($filest, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"));

$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;

    } else { $valido=0; echo  $doc_no_tipo;
			}
} else { $valido=0; echo $doc_tam;
		}
	

} else { 
echo $doc_tam;

}

} else { }
?>














<?php
if ((isset($_POST["id_acto_administrativo_licencia"])) && ($_POST["id_acto_administrativo_licencia"] != "")) { 



$tamano_archivo=15728640; //10485760;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$carpeta_archivo="files/";
$ruta_archivo = 'otro_acto_asociado_licencia_'.date("YmdGis").'&'.base64_encode($_FILES['file']['tmp_name']);


 if (""!=$_FILES['file']['tmp_name']){
	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);


if (($tam_archivo==$tam_archivo2) and ($tamano_archivo>$tam_archivo)) {
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $filest = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo.$filest);
 // chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);


  
  
  

$insertSQL = sprintf("INSERT INTO acto_admin_x_licencia (nombre_acto_admin_x_licencia, documento_url_acto, fecha_acto_admin_x_licencia, id_licencia_curaduria, id_acto_administrativo_licencia, estado_acto_admin_x_licencia) VALUES (%s, %s, now(), %s, %s, %s)", 
GetSQLValueString($_POST['nombre_acto_admin_x_licencia'], "text"),
GetSQLValueString($filest, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["id_acto_administrativo_licencia"], "int"), 
GetSQLValueString(1, "int"));
 
 


$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;

    } else { $valido=0; echo  $doc_no_tipo;
			}
} else { $valido=0; echo $doc_tam;
		}
	
	
	

} else { 
echo $doc_tam;

}

} else { }
?>

<div class="modal fade" id="popupnewotroacto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Actos administrativos asociados: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="fo445rm15435345224355447" enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de acto:</label> 
<select required name="id_acto_administrativo_licencia" >
<option value="" selected></option>
<?php
$queryz = sprintf("SELECT * FROM acto_administrativo_licencia where estado_acto_administrativo_licencia=1 order by id_acto_administrativo_licencia"); 
$selectz = mysql_query($queryz, $conexion);
$rowz = mysql_fetch_assoc($selectz);
$totalRowsz = mysql_num_rows($selectz);
if (0<$totalRowsz){
do {
	echo '<option value="'.$rowz['id_acto_administrativo_licencia'].'">'.$rowz['nombre_acto_administrativo_licencia'].'</option>';

 
	} while ($rowz = mysql_fetch_assoc($selectz)); 
} else {}	 
mysql_free_result($selectz);
?>


</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label">Descripcion:</label> 
<textarea class="textarea" id="texto_acto_admin_x_licencia" name="nombre_acto_admin_x_licencia">
</textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Adjuntar oficio de soporte:</label> 
<input type="file" value=""  name="file" required>
<span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 15 Megas.)</span>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div>













<?php
if ((isset($_POST["table"])) && ($_POST["table"] == "tipo_modalidad_licencia")) { 
$insertSQL = sprintf("INSERT INTO tipo_modalidad_licencia (id_modalidad_licencia, id_tipo_autorizacion_licencia, nombre_tipo_modalidad_licencia, estado_tipo_modalidad_licencia) VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST["id_modalidad_licencia"], "int"),
GetSQLValueString($_POST["id_tipo_autorizacion_licencia"], "int"), 
GetSQLValueString($name, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} else { }
?>
	
<?php  /////////////////////////////////////////////////////////////////////////////////////////
?>




 <section class="content">
 
  
 

		  
		  
 
 
 
 <div class="row">
 
<div class="panel-body" style="background:#fff;">     
<div class="col-md-4"> 
<i class="glyphicon glyphicon-home"></i>  <?php echo $name; ?> <br>
<i class="glyphicon glyphicon-envelope"></i> <?php echo $correo_curaduria; ?><br>
<i class="glyphicon glyphicon-map-marker"></i> <?php echo quees('departamento', $id_departamento); ?>  <br>

</div>
<div class="col-md-4"> 
<i class="glyphicon glyphicon-map-marker"></i>  <?php echo nombre_municipio($id_municipio, $id_departamento); ?><br>
<i class="glyphicon glyphicon-earphone"></i>  <?php echo $tele; ?><br>

</div> 

<div class="col-md-4">
<div>
  
  
  		  <?php if (0==$estado) {?>
		  
		  
<?php 
		   
		   

$val1=existenciaunica('tipo_autorizacion_licencia', 'id_licencia_curaduria', $id);
$val2=existenciaunica('uso_aprobado_licencia', 'id_licencia_curaduria', $id);
$val3=existenciaunica('titular_licencia', 'id_licencia_curaduria', $id);
$val4=existenciaunica('inmueble_licencia', 'id_licencia_curaduria', $id);
$val5=existenciaunica('documento_licencia', 'id_licencia_curaduria', $id);
$val6=existenciaunica('uso_parqueo_licencia', 'id_licencia_curaduria', $id);
//$val7=existenciaunica('costo_licencia', 'id_licencia_curaduria', $id);

if (0<$val1 && 0<$val2 && 0<$val3 && 0<$val4 && 0<$val5 && 0<$val6) {
	
	
	
	?>
		  

		   <form action="" method="POST" name="form16543435345657">
		  <button type="submit" class="btn btn-lg btn-warning" style="width:100%;" id="vigenciab">
		  <span class="glyphicon glyphicon-ok"></span> CERRAR LICENCIA </button>
		  <input type="hidden" name="table" value="estado_licencia_curaduria">
		  <input type="hidden" name="vigencia_total" value="" id="vigencia_total">
		  <input type="hidden" name="fecha_terminacion" value="" id="fecha_terminacion">
		  </form>
		

		  
		
		
		   <?php } else { ?>
		   
		 
		   
		  <button title="Falta agregar documentos" onclick="alert('Todos los modulos descriptivos son obligatorios.');" class="btn btn-lg btn-warning" style="width:100%;">
		  <span class="glyphicon glyphicon-warning-sign"></span> CERRAR LICENCIA </button>

	
		
		   
		    <?php } ?>
		  
		  
		  <?php } else { ?>
		  
		  
         
		  <a href="pdf/licencia&<?php echo $licencia;  ?>.pdf" class="btn btn-lg btn-success" style="width:100%;">
		  <span class=""></span><img src="images/pdf.png"> CREAR PDF </a>
		
		 
		  <?php }  ?>
		  
		  
 </div>
 <br>
 </div>
 </div>
  </div>

 



 <?php  if (0==$situacion_licencia) { echo '<br><div class="row"><div class="alert alert-danger" role="alert"><b>DOCUMENTO ANULADO</b></div></div>'; } else {} ?>
 

      
		

      <div class="row">

        <div class="col-md-9">
		<div class="row">
          <div class="box">
       	  <div class="box box-primary">
        
                  <h3 class="box-title">Licencia</h3> &nbsp; &nbsp; 
<?php  if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) { ?>
<a id="" class="ventana1" data-toggle="modal" data-target="#popupactualizacionlicencia" href="" title="Modificar datos de licencia"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>
<?php } else {} ?>
 

				  
                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
            <!-- /.box-header -->
            <div class="box-body">


<div class="row">
<div class="col-md-4">

<div class="form-group text-left"> 
<label  class="control-label">NÚMERO DE RADICACIÓN DEL PROYECTO:</label>   
<?php echo $licencia ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA DE CREACIÓN:</label>   
<?php echo $row_update['fecha_licencia_real']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">TIPO DE OBJETO:</label>   
<?php //(1==$row_update['id_objeto_lic_curaduria']) 
	echo $row_update['nombre_objeto'];
?>
</div>


 <div class="form-group text-left"> 
<label  class="control-label"> NÚMERO DE RADICACIÓN DE LA PRORROGA ASIGNADO POR VUR:</label>   
<?php echo $row_update['numero_prorroga_vur']; ?>
</div>


 <div class="form-group text-left"> 
<label  class="control-label"> OTRA ACTUACIÓN:</label>   
<?php echo $row_update['actuacion']; ?>
</div>



 <div class="form-group text-left"> 
<label  class="control-label"> ESTADO:</label>   
<?php echo $row_update['estado']; ?>
</div>




<div class="form-group text-left"> 
<label  class="control-label">NÚMERO DEL ACTO ADMINISTRATIVO:</label>   
<?php echo $n_acto_administrativo; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">EXPEDIDA POR:</label>   
<?php echo quees('funcionario',$responsable); ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">OBSERVACION DE LA LICENCIA:</label>   
<?php echo $observacion_licencia; ?>
</div>

</div>
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label">REQUIERE CERTIFICACIÓN TECNICA DE OCUPACIÓN:</label>   
<?php echo $certificado_ocupacion; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">REQUIERE AUTORIZACIÓN DE OCUPACIÓN DE INMUEBLE:</label>   
<?php echo $autorizacion_ocupacion; ?>
</div>




 <div class="form-group text-left"> 
<label  class="control-label"> NÚMERO DE TITULARES:</label>   
<?php echo $row_update['titulares']; ?>
</div>

 <div class="form-group text-left"> 
<label  class="control-label"> NÚMERO DE MATRICULAS INMOBILIARIAS ASOCIADAS AL PROYECTO:</label>   
<?php echo $row_update['matriculas']; ?>
</div>




</div>

<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE RADICACION LEGAL Y EN DEBIDA FORMA:</label>   
<?php echo $fecha_radicacion; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">FECHA DEL ACTA DE VIABILIDAD:</label>   
<?php echo $fecha_viabilidad; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">FECHA DE EXPEDICION:</label>   
<?php echo $fecha_expedicion; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE EJECUTORIA:</label>   
<?php echo $fecha_ejecutoria; ?>

</div>
<div class="form-group text-left"> 
<label  class="control-label">VIGENCIA:</label> 
<?php //echo $vigencia_total_l; ?>
<!--<span id="vigencia1"></span>-->
Ver en la seccion del tipo de autorización y modalidad.
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE TERMINACIÓN:</label> 
<?php //echo $fecha_terminacion_l; ?>
<!--<span id="hastafecha1"></span> -->
Ver en la seccion del tipo de autorización y modalidad.
</div>
</div>
</div>
 </div>
 
 


  
            </div>

		

		
			</div>
			
			
<?php  if (0==$situacion_licencia) { echo '<br><div class="row"><div class="alert alert-danger" role="alert"><b>DOCUMENTO ANULADO</b></div></div>'; } else {} ?>
 

 
			
			<div class="row">
			
			
			<div class="col-md-4">
			<div class="box box-primary">
            <div class="box-header with-border">
    <b>Tipo de autorización</b> 
<div class="text-right"> 
<?php

function calculovigencia($vigenciaf) {
global $mysqli;
$query4hj = sprintf("SELECT tiempo FROM vigencia_curaduria where pmodalidad=".$vigenciaf."  and estado_vigencia_curaduria=1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
$reshhj=$row4hj['tiempo'];
} else {
$reshhj='';
}
return $reshhj;
$result4hj->free();
}

 $arrayv='';






 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewtiposlicencia" href="" title="Añadir tipos de licencia"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>


<div class="box-body">
			
<?php




$query = sprintf("SELECT * FROM tipo_autorizacion_licencia, clase_licencia where 

tipo_autorizacion_licencia.id_clase_licencia=clase_licencia.id_clase_licencia and 


tipo_autorizacion_licencia.id_licencia_curaduria='$id' and tipo_autorizacion_licencia.estado_tipo_autorizacion_licencia=1 order by tipo_autorizacion_licencia.id_tipo_autorizacion_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	$array = array();
do {
	$idcl=$row['id_clase_licencia'];
	$clase_licencia=$row['nombre_clase_licencia'];
	
	
		
	
	if (5==$idcl) {	

	
if (1<$totalRows) {
	if ('2021-12-20'<$fecha_radicacion) {
    $vigencia=$row['nueva_vigencia_clase'];
	} else {
	$vigencia=$row['vigencia'];
	} 
} else {
	$vigencia=$row['vigencia_reconocimiento'];
}

	
	  
	} else {
		if ('2021-12-20'<$fecha_radicacion) {
   // $vigencia=$row['nueva_vigencia_clase'];
	} else {
	//$vigencia=$row['vigencia'];
	}
	}
	
	

	//array_push($array, $vigencia);	  
	
	
	echo 'Tipo: '.$clase_licencia.'';
	
	 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="tipo_autorizacion_licencia" id="'.$row['id_tipo_autorizacion_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	 } else {}
	echo '<br />';
	
	
	
	if (isset($vigencia)) {
	//echo 'Vigencia x tipo: ';

		if (5==$idcl) {			 
	 // echo $row['vigencia_reconocimiento'];
	} else {
		

	//echo $vigencia;
	
	  //echo $row['vigencia'];
	}
	
	
	//echo ' meses<br />';
	} else {}
	
	
	
	
	if (isset($row['lotes_resultantes'])){
	echo 'Lotes resultantes: '.$row['lotes_resultantes'].'';
} else {}


if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
	?>
	
<form action="" method="POST" name="form1262">
Modalidad: 
<select style="width:120px;" name="id_modalidad_licencia" id="id_modalidad_licencia" required>
<?php
$actualizar5 = mysql_query("SELECT * FROM modalidad_licencia WHERE id_clase_licencia='$idcl' and estado_modalidad_licencia=1 order by nombre_modalidad_licencia", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected></option>';
 do {
   echo '<option value="'.$row15['id_modalidad_licencia'].'" ';
   echo '>'.$row15['nombre_modalidad_licencia'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>
</select>
<button type="submit" class="btn btn-xs btn-success" title="Agregar" id="mmodalidad">
<input type="hidden" name="id_tipo_autorizacion_licencia" value="<?php echo $row['id_tipo_autorizacion_licencia']; ?>">
<input type="hidden" name="table" value="tipo_modalidad_licencia" >
<span class="glyphicon glyphicon-plus-sign"></span> </button>
</form>
<?php 

} else {}



$valid=$row['id_tipo_autorizacion_licencia'];
$actualizar56 = mysql_query("SELECT * FROM modalidad_licencia, tipo_modalidad_licencia WHERE 
modalidad_licencia.id_modalidad_licencia=tipo_modalidad_licencia.id_modalidad_licencia and 
tipo_modalidad_licencia.id_tipo_autorizacion_licencia='$valid' and 
tipo_modalidad_licencia.estado_tipo_modalidad_licencia=1  
order by nueva_vigencia asc", $conexion);
$row156 = mysql_fetch_assoc($actualizar56);
$total556 = mysql_num_rows($actualizar56);
if (0<$total556) {
 echo '<ol>';
 
 	/*if (5==$idcl) {			 
	 echo '<LI>RECONOCIMIENTO DE LA EXISTENCIA DE UNA EDIFICACIÓN</li>';
	} else { }*/
 
 
 
	
	
 do {
	 
	$arrayv.=$row156['id_modalidad_licencia'].'-';
	 
   echo '<li>'.$row156['nombre_modalidad_licencia'].'';
   
   
   	if ('2021-12-20'<$fecha_radicacion) {
    $vigencia_modalidad=$row156['nueva_vigencia'];
	} else {
	$vigencia_modalidad=$row156['vigencia_modalidad'];
	}
   echo ' / '.$vigencia_modalidad.' meses';
   
    if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
   echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="tipo_modalidad_licencia" id="'.$row156['id_tipo_modalidad_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
   
   echo '</li>';
   
   array_push($array, $vigencia_modalidad);

	/*
$id_modalidad_licencia=$row156['id_modalidad_licencia'];

if (7==$id_modalidad_licencia && 1<$total556) { 
$dosl=1;
array_push($array, 12);
} else {
$dosl=0;
array_push($array, $vigencia_modalidad);
}
*/



   
 } while ($row156 = mysql_fetch_assoc($actualizar56)); 

  echo '</ol>';
  mysql_free_result($actualizar56);
} else {}


	




	echo '<hr>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 


/*
if (1==$dosl) {
$suma=array_sum($array); 
} else {
$suma=$vigencia_modalidad; 
}
*/

$sarrayv=explode("-",$arrayv);
$total556=count($sarrayv);

 if (3==$total556) {
	$m1=$sarrayv[0];
    $m2=$sarrayv[1];
	
	if ((1==$m1 && 7==$m2) or (7==$m1 && 1==$m2)) {
$suma=48;	
	} else if ((3==$m1 && 7==$m2) or (7==$m1 && 3==$m2)) {	
$suma=48;	
} else	if ((20==$m1 && 7==$m2) or (7==$m1 && 20==$m2)) {
$suma=48;
} else	if ((20==$m1 && 18==$m2) or (18==$m1 && 20==$m2)) {
$suma=48;
} else {
$suma=array_sum($array);
}	

} else {
$suma=array_sum($array);
}
 


$nuevafecha = strtotime ( '+'.$suma.' month' , strtotime ($fecha_ejecutoria) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
 
 if (0<$total556) {
 
	
echo '<b>Vigencia: '.$suma.' meses</b>';
echo '<br /><b>Hasta: '.$nuevafecha.'</b>';
echo '<input type="hidden" value="'.$suma.' meses" id="vigencia">';	
echo '<input type="hidden" value="'.$nuevafecha.'"  id="hastafecha">';

	

} else {
	
	echo '<input type="hidden" value="Falta Modalidad" id="vigencia">';	
echo '<input type="hidden" value="Falta Modalidad"  id="hastafecha">';

if (5==$idcl) { } else {	
	echo '<b style="color:#ff0000">No se ha asociado modalidad</b>';
}

}
	
} else {}	 
mysql_free_result($select);

?>
			</div>
			</div>
			
			
			
			
			

			
			
			
			
			
			
			
						<div class="box box-primary">
           <div class="box-header with-border">
    <b>Profesionales responsables</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewusoslicencia" href="" title="Añadir tipos de licencia"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
<div class="box-body">

<?php
$query = sprintf("SELECT * FROM area"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	//echo ': '.$row['nombre_area'].'';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>		
			</div>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
					<div class="box box-primary">
           <div class="box-header with-border">
    <b>Datos generales del proyecto</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewusoslicencia" href="" title="Añadir tipos de licencia"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
<div class="box-body">
<?php
$query = sprintf("SELECT * FROM area"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	//echo ': '.$row['nombre_area'].'';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>		
			</div>
			</div>
			
			
			
			
			
			    <div class="box box-primary">
            <div class="box-header with-border">
    <b>Expensas</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">
			</div>
			</div>
			
			
	
			
			
			
			
			
			
			
			
			
			

			
			</div>
			
			
			
			<div class="col-md-4">
			<div class="box box-primary">
<div class="box-header with-border">
    <b>Titulares</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewagenda" href="" title="Añadir titulares"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
            <div class="box-body">
			
<?php

$query = sprintf("SELECT * FROM titular_licencia, tipo_documento where titular_licencia.id_tipo_documento=tipo_documento.id_tipo_documento and id_licencia_curaduria='$id' and estado_titular_licencia=1 order by id_titular_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo ''.strtoupper($row['nombre_titular_licencia']).'';
	 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="titular_licencia" id="'.$row['id_titular_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	 } else { }
	echo '<br />';
	echo ''.$row['nombre_tipo_documento'].'<br />';
	echo ''.strtoupper($row['identificacion_titular']).'<hr>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);

?>
			</div>
			</div>
			
			
			
			
			
				<div class="box box-primary">
           <div class="box-header with-border">
    <b>Usos aprobados</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewusoslicencia" href="" title="Añadir tipos de licencia"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
            <div class="box-body">
			
			
<?php

$query = sprintf("SELECT * FROM uso_aprobado_licencia, uso_aprobado where 
uso_aprobado_licencia.id_uso_aprobado=uso_aprobado.id_uso_aprobado and 
uso_aprobado_licencia.estado_uso_aprobado_licencia=1  and 
uso_aprobado_licencia.id_licencia_curaduria='$id'  
order by uso_aprobado_licencia.id_uso_aprobado_licencia"); 

$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {

	echo 'USO: '.$row['nombre_uso_aprobado'].'';
	
	 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="uso_aprobado_licencia" id="'.$row['id_uso_aprobado_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	 } else { }
	
	if ('OTRO'==$row['nombre_uso_aprobado']){
		echo ': '.$row['otro_uso'].'<br />';
	} else { echo '<br />'; }
	
	echo 'Unidades de Uso: '.$row['unidades_uso_aprobado'].'<br />';
	
	

	
	echo '<hr>';
	
	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>
			
			</div>
			</div>
			
			
			
			
				<div class="box box-primary">
           <div class="box-header with-border">
    <b>Usos de parqueadero</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewusosparqueolicencia" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
            <div class="box-body">
			
			
<?php

$query = sprintf("SELECT * FROM uso_parqueo_licencia, tipo_parqueadero_licencia  where 
uso_parqueo_licencia.id_tipo_parqueadero_licencia=tipo_parqueadero_licencia.id_tipo_parqueadero_licencia and 
uso_parqueo_licencia.estado_uso_parqueo_licencia=1  and 
uso_parqueo_licencia.id_licencia_curaduria='$id'  
order by uso_parqueo_licencia.id_uso_parqueo_licencia"); 

$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {


	 
	echo ''.$row['nombre_tipo_parqueadero_licencia'].'';
	 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="uso_parqueo_licencia" id="'.$row['id_uso_parqueo_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	 } else {}
	echo '<br />'; 
		echo 'Unidades de parqueadero: '.$row['unidades_parqueadero'].'<hr>';
	
	
	
	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>
			
			</div>
			</div>
			
			
			
				<div class="box box-primary">
<div class="box-header with-border">
    <b>Inmuebles</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewinmueble" href="" title="Añadir inmuebles"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
            <div class="box-body">
			<?php

$query = sprintf("SELECT * FROM inmueble_licencia, tipo_predio where 
inmueble_licencia.id_tipo_predio=tipo_predio.id_tipo_predio and 
inmueble_licencia.id_licencia_curaduria='$id' and 
inmueble_licencia.estado_inmueble_licencia=1 
order by inmueble_licencia.id_inmueble_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo 'Predio: '.strtoupper($row['nombre_tipo_predio']).'';
	 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="inmueble_licencia" id="'.$row['id_inmueble_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	 } else {}
	echo '<br >';
	echo 'Matricula: '.strtoupper($row['fmi_matricula']).'<br >';
   echo 'Chip - C. Catas.: '.strtoupper($row['cedula_catastral']).'<br >';
   echo 'Dirección: '.$row['direccion_inmueble'].'<br />';
   echo 'Area: '.$row['area_predio'].'';
   
   echo '<hr>';
   
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

			</div>
			</div>
			
			
			
			</div>
			
			
	
			<div class="col-md-4">
			
			
			<div class="box box-primary">
            <div class="box-header with-border">
    <b>Acto administrativo y planos</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol'] or 61==$id_curaduria) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewdocumento" href="" title="Añadir documentos"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
            <div class="box-body">
			<?php
$query = sprintf("SELECT * FROM documento_licencia, tipo_file_licencia where documento_licencia.id_tipo_file_licencia=tipo_file_licencia.id_tipo_file_licencia and id_licencia_curaduria='$id' and estado_documento_licencia=1 order by id_documento_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	//echo ''.$row['nombre_tipo_file_licencia'].'<br />';
	echo '<a href="files/licenciassnr/'.$row['url_documento_licencia'].'" target="_blank"><img src="images/pdf.png"> '.$row['nombre_documento_licencia'].'</a>';
		
		 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol'] or 61==$id_curaduria) {
		echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_licencia" id="'.$row['id_documento_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		 } else {}
	
	echo '<br>';
	

 echo 'Planos Estructurales: '.$row['cantidad_planos_estructurales'].'<br>';
 echo 'Planos Arquitectonicos: '.$row['cantidad_planos_arquitectonicos'].'<br>';
 echo 'Planos Subdivisión: '.$row['cantidad_planos_subdivision'].'<br>';
 echo 'Planos Urbanización: '.$row['cantidad_planos_urbanizacion'].'<br>';
 echo 'Planos Parcelación: '.$row['cantidad_planos_parcelacion'].'<br>';


  echo 'Memorias de calculo: ';
  if (1==$row['memorias_calculo']) { echo 'Si';  } else { echo 'No';}
  echo '<br>';
   echo 'Memorias de suelo: ';
  if (1==$row['estudio_suelo']) { echo 'Si';  } else { echo 'No'; }
  echo '<br>';
 echo '<hr>';
 
 


 
	} while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
			</div>
			</div>
			
			
			
			
			
			
				<?php if (1==$_SESSION['rol'] or 0<$nump21) { ?>
		<div class="box box-primary">
            <div class="box-header with-border">
    <b>Expediente completo</b> 
<div class="text-right"> 
<a id="" name="" class="ventana1" data-toggle="modal" data-target="#popupnewexpediente"> 
<button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';

</div>					  
</div>
<div class="box-body">
<?php
$query = sprintf("SELECT * FROM expediente_licencia where id_licencia_curaduria='$id' and estado_expediente_licencia=1 order by id_expediente_licencia"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
   echo '<a href="files/'.$row['url'].'" target="_blank">'.$row['nombre_expediente_licencia'].'</a><br>';

	} while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
			</div>
			</div>
				<?php } else {} ?>
				
			
			
			
			<?php if (1==$_SESSION['rol'] or 0<$nump21) { ?>
		<div class="box box-primary">
            <div class="box-header with-border">
    <b>Correcciones</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewcorreccion" href="" title="Modificaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">
<?php
$query = sprintf("SELECT * FROM correccion_licencia where id_licencia_curaduria='$id' and estado_correccion_licencia=1 order by id_correccion_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo ''.$row['nombre_correccion_licencia'].'';
		if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
		echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="correccion_licencia" id="'.$row['id_correccion_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		 } else {}
	echo '<br />';
echo 'Soporte (Entrada): <a href="files/'.$row['adjunto_url'].'" target="blank"><img src="images/pdf.png">  '.$row['radicado_entrada'].'</a><br />';
echo ''.$row['fecha_correccion_licencia'].'<br />';

 echo '<hr>';
 
	} while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
			</div>
			</div>
				<?php } else {} ?>
			
			
			
			
			
			
			
			
			
			
			
			<?php if (1==$_SESSION['rol'] or 0<$nump21) { ?>
		<div class="box box-primary">
            <div class="box-header with-border">
    <b>Actos administrativos asociados</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">
<?php
$query = sprintf("SELECT * FROM acto_admin_x_licencia, acto_administrativo_licencia where acto_admin_x_licencia.id_acto_administrativo_licencia=acto_administrativo_licencia.id_acto_administrativo_licencia and id_licencia_curaduria=".$id." and estado_acto_admin_x_licencia=1 AND estado_acto_administrativo_licencia=1 order by id_acto_admin_x_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo ''.$row['nombre_acto_administrativo_licencia'].'';
		if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
		echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="acto_admin_x_licencia" id="'.$row['id_acto_admin_x_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		 } else {}
	echo '<br />';
	
	echo ''.$row['nombre_acto_admin_x_licencia'].'<br>';
	
echo 'Soporte (Entrada): <a href="files/'.$row['documento_url_acto'].'" target="blank"><img src="images/pdf.png"> Acto</a><br />';
echo ''.$row['fecha_acto_admin_x_licencia'].'<br />';

 echo '<hr>';
 
 


 
	} while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
			</div>
			</div>
				<?php } else {} ?>
				
			
			
			
			</div>
			
			
			
			</div>
			
			
          </div>
		  
		  
		  
		  
		  
		  
		  
		   <div class="col-md-3" style="background:#ff000;">
	<br>
<center><b>ETAPAS PROCESALES</b></CENTER>
		  <br>
		  
		  <div class="box box-primary">
           <div class="box-header with-border">
    <b>Documentos del Expediente</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewusoslicencia" href="" title="Añadir tipos de licencia"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
<div class="box-body">
<?php
$query = sprintf("SELECT * FROM area"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	//echo ': '.$row['nombre_area'].'';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>		
			</div>
			</div>
			
			
			
			
			<div class="box box-primary">
            <div class="box-header with-border">
    <b>Recursos contra actos administrativos que se aprueban o niegan</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">

			</div>
			</div>
			
			
			
			
		
		  
		  
		  <div class="box box-primary">
           <div class="box-header with-border">
    <b>Citacion a vecinos</b> 
<div class="text-right"> 
<?php
 if (0==$estado or 0<$nump21 or 1==$_SESSION['rol']) {
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewusoslicencia" href="" title="Añadir tipos de licencia"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
 } else {}
?>
</div>					  
</div>
<div class="box-body">
<?php
$query = sprintf("SELECT * FROM area"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	//echo ': '.$row['nombre_area'].'';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>		
			</div>
			</div>
			
			
		
			
			<div class="box box-primary">
            <div class="box-header with-border">
    <b>Solicitud de información autoridades</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">

			</div>
			</div>
			
			
		  
		  
		  
		  
		  <div class="box box-primary">
            <div class="box-header with-border">
    <b>Acta de observaciones y correcciones</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">

			</div>
			</div>
			
			
			
			  <div class="box box-primary">
            <div class="box-header with-border">
    <b>Acta de viabilidad</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">

			</div>
			</div>
			
		  
		  
		    <div class="box box-primary">
            <div class="box-header with-border">
    <b>Revocatoria directa</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">
			</div>
			</div>
			
			
		  
		  
		      <div class="box box-primary">
            <div class="box-header with-border">
    <b>Otros</b> 
<div class="text-right"> 
<?php
echo '<a id="'.$row_update['nombre_licencia_curaduria'].'" name="'.$row_update['id_licencia_curaduria'].'" class="ventana1" data-toggle="modal" data-target="#popupnewotroacto" href="" title="Otras actuaciones"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
?>
</div>					  
</div>
<div class="box-body">
			</div>
			</div>
		  
		  
		  
		  
		  
	
		  </div>
		  
        
		
		

        </div>
        <!-- /.col -->
     
      <!-- /.row -->
    </section>
	
	<?php
} else {}
	} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
	?>