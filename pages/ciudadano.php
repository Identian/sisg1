<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);

if  (21373==$id){
	echo 'No tiene permisos para cambio del usuario anónimo.';
} else {

	
if ((isset($_POST["table"]) && $_POST["table"] == "ciudadano") && (1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area'] or 24==$_SESSION['snr_grupo_area'])) { 


if (1==$_SESSION['rol']) {
	

$updateSQL = sprintf("UPDATE ciudadano SET nombre_ciudadano=%s, id_tipo_documento=%s, identificacion=%s, id_tipo_respuesta=%s, sexo=%s, id_etnia=%s, correo_ciudadano=%s, telefono_ciudadano=%s, id_departamento=%s, id_municipio=%s, direccion_ciudadano=%s where id_ciudadano=%s  and id_ciudadano!=21373",
GetSQLValueString($_POST["nombre_ciudadano"], "text"), 
GetSQLValueString($_POST["id_tipo_documento"], "int"), 
GetSQLValueString($_POST["identificacion"], "text"), 
GetSQLValueString($_POST["id_tipo_respuesta"], "int"),
GetSQLValueString($_POST["sexo"], "text"),  
GetSQLValueString($_POST["id_etnia"], "int"), 
GetSQLValueString($_POST["correo_ciudadano"], "text"), 
GetSQLValueString($_POST["telefono_ciudadano"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["direccion_ciudadano"], "text"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

$identificacionf=$_POST["identificacion"];
$identificacion_radi_cert=$_POST["identificacion_radi_cert"];

$updateSQL99 = sprintf("UPDATE radi_cert SET identificacion=%s where identificacion=%s",
GetSQLValueString($identificacionf, "text"), 
GetSQLValueString($identificacion_radi_cert, "text"));
$Result99 = mysql_query($updateSQL99, $conexion) or die(mysql_error());

} else {
	
$updateSQL = sprintf("UPDATE ciudadano SET nombre_ciudadano=%s, id_tipo_respuesta=%s, sexo=%s, id_etnia=%s, correo_ciudadano=%s, telefono_ciudadano=%s, id_departamento=%s, id_municipio=%s, direccion_ciudadano=%s where id_ciudadano=%s  and id_ciudadano!=21373",
GetSQLValueString($_POST["nombre_ciudadano"], "text"), 
GetSQLValueString($_POST["id_tipo_respuesta"], "int"), 
GetSQLValueString($_POST["sexo"], "text"), 
GetSQLValueString($_POST["id_etnia"], "int"), 
GetSQLValueString($_POST["correo_ciudadano"], "text"), 
GetSQLValueString($_POST["telefono_ciudadano"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["direccion_ciudadano"], "text"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
	
	
}



echo $actualizado;
} else { }
	
	
	
	
	
$query_update = sprintf("SELECT * FROM ciudadano WHERE id_ciudadano = %s and estado_ciudadano=1", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);

if (0<$totalRows_update){

	
	$identificacion=$row_update['identificacion'];

?>









<div class="row">
<div class="col-md-9">
	<div class="box box-info">
 <div class="box-header with-border">
                  <h3 class="box-title">CIUDADANO  
				  
				  <?php if (4==$row_update['fuente']) { ?>

<span style="color:#ff0000;">**Autenticación con Gov.co**</span>   

<?php } else {} ?>

				  </h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
			

	 
	 
	
<div class="row">

<?php if (1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area'] or 24==$_SESSION['snr_grupo_area']) { ?>

<form action="" method="post" name="formret1" >
<div class="col-md-6">

<div class="form-group text-left"> 
<label  class="control-label">NOMBRE:</label>   

 <?php // if (1==$_SESSION['rol'] && 4!=$row_update['fuente']) { ?>
<input type="text" class="form-control" name="nombre_ciudadano"  required value="<?php echo $row_update['nombre_ciudadano']; ?>">
<?php //} else { echo $row_update['nombre_ciudadano']; } ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">TIPO DE DOCUMENTO:</label>  
 <?php if (1==$_SESSION['rol']) { ?>
<select  class="form-control" name="id_tipo_documento"  required>
<?php
$select = mysql_query("select * from tipo_documento where estado_tipo_documento=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_tipo_documento'].'"';
	if ($row_update['id_tipo_documento']==$row['id_tipo_documento']) { echo 'selected'; } else {}
	echo '>'.$row['nombre_tipo_documento'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);
?>
</select>
 <?php } else { echo quees('tipo_documento', $row_update['id_tipo_documento']); } ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">IDENTIFICACIÓN:</label>   

 <?php if (1==$_SESSION['rol'] && 4!=$row_update['fuente']) { ?>
<input type="text" class="form-control" name="identificacion"  required value="<?php echo $identificacion; ?>">
<input type="hidden" name="identificacion_radi_cert" value="<?php echo $identificacion; ?>">
 <?php } else { echo $identificacion; } ?>
</div>

<div class="form-group text-left" > 
<label  class="control-label">GENERO:</label> 
<select  class="form-control" name="sexo" required>
<option value="<?php echo $row_update['sexo']; ?>" selected><?php echo $row_update['sexo']; ?></option>
<option value="Mujer">Mujer</option>
<option value="Hombre">Hombre</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">ETNIA:</label>   
<select  class="form-control" name="id_etnia" >
<?php
$select = mysql_query("select * from etnia where estado_etnia=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_etnia'].'"';
	if ($row_update['id_etnia']==$row['id_etnia']) { echo 'selected'; } else {}
	echo '>'.$row['nombre_etnia'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CORREO:</label>   
<input type="mail" class="form-control" name="correo_ciudadano"  required value="<?php echo htmlentities($row_update['correo_ciudadano'], ENT_COMPAT, ''); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">TELEFONO:</label>   
<input type="text" class="form-control" name="telefono_ciudadano"   value="<?php echo htmlentities($row_update['telefono_ciudadano'], ENT_COMPAT, ''); ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">DEPARTAMENTO:</label>   
<select  class="form-control" name="id_departamento" id="id_departamentomun" required>
<?php
$select = mysql_query("select * from departamento where estado_departamento=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_departamento'].'"';
	if ($row_update['id_departamento']==$row['id_departamento']) { echo 'selected'; } else {}
	echo '>'.$row['nombre_departamento'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">MUNICIPIO:</label>   

<select  class="form-control" name="id_municipio" id="id_municipiomun" required>
<option value="<?php $muni=$row_update['id_municipio']; echo $muni; ?>" id="mun"><?php echo quees('municipio', $muni); ?></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">POR QUE MEDIO DESEA RECIBIR SU RESPUESTA::</label>   
<select  class="form-control" name="id_tipo_respuesta" required>

<?php
$select = mysql_query("select * from tipo_respuesta where estado_tipo_respuesta=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_tipo_respuesta'].'"';
	if ($row_update['id_tipo_respuesta']==$row['id_tipo_respuesta']) { echo 'selected'; } else {}
	echo '>'.$row['nombre_tipo_respuesta'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">DIRECCION DEL CIUDADANO:</label>   
<input type="text" class="form-control" name="direccion_ciudadano"   value="<?php echo htmlentities($row_update['direccion_ciudadano'], ENT_COMPAT, ''); ?>">
</div>

<div class="row">
<div class="col-md-12">
<div class="modal-footer">
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="ciudadano"><span class="glyphicon glyphicon-ok"></span> MODIFICAR</button>
</div>
</div>
</div>



</div>
</form>
<?php } else { ?>



<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">NOMBRE:</label>   
<?php echo $row_update['nombre_ciudadano']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TIPO DE DOCUMENTO:</label>   
<?php echo quees('tipo_documento', $row_update['id_tipo_documento']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">IDENTIFICACIÓN:</label>   
<?php echo $identificacion; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">GENERO:</label>   
<?php echo $row_update['sexo']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ETNIA:</label>   
<?php echo quees('etnia', $row_update['id_etnia']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CORREO:</label>   
<?php echo htmlentities($row_update['correo_ciudadano'], ENT_COMPAT, ''); ?>
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">TELEFONO:</label>   
<?php echo htmlentities($row_update['telefono_ciudadano'], ENT_COMPAT, ''); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">DEPARTAMENTO:</label>  
<?php echo quees('departamento', $row_update['id_departamento']); ?> 
</div>
<div class="form-group text-left"> 
<label  class="control-label">MUNICIPIO:</label>   
<?php $muni=$row_update['id_municipio'];  echo quees('municipio', $muni); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">POR QUE MEDIO DESEA RECIBIR SU RESPUESTA::</label>   
<?php echo quees('tipo_respuesta', $row_update['id_tipo_respuesta']); ?>

</div>
<div class="form-group text-left"> 
<label  class="control-label">DIRECCION DEL CIUDADANO:</label>   
<?php echo htmlentities($row_update['direccion_ciudadano'], ENT_COMPAT, ''); ?>
</div>
</div>




<?php } ?>


</div>


</div>
</div>
</div>
</div>

<div class="col-md-3">

	  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">PQRS del Ciudadano</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div  class="modal-body" style="max-height:450px;">
		

			<?php
			
		
$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1 order by id_solicitud_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
			echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
			
			
			
	}
	$result8->free();
?>
		

		
<?php
		
$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1", $conexion) or die(mysql_error());
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/radicado_anterior&'.$row157ll['id_radi_cert'].'.jsp">Certicamara '.$row157ll['radi_cert'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row157ll['fecha_radi_cert'].'</span><br>';
			echo $row157ll['nombre_radi_cert'].'<hr>';
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}
?>




		

		
			
			</div>
			</div>	
	</div>
	

</div>
</div>


<?php
} 

} 
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
?>