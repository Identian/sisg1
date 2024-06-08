<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
$id = $_GET['i'];


$query_update = sprintf("SELECT * FROM situacion_curaduria WHERE id_situacion_curaduria = %s", 
GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){

?>


<div class="row">
<div class="col-md-12">

	
 <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Detalles</b></h3>
<div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
			
<div  class="modal-body"><form action="" method="POST" name="form1" onsubmit="return validate();"><div class="form-group text-left"> 
<label  class="control-label">FUNCIONARIO:</label>   
<select  class="form-control" name="id_funcionario" required>
<option value="<?php echo $row_update['id_funcionario']; ?>" selected><?php echo $row_update['id_funcionario']; ?></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ID DE TIPO DE ACTO:</label>   
<select  class="form-control" name="id_tipo_acto" >
<option value="<?php echo $row_update['id_tipo_acto']; ?>" selected><?php echo $row_update['id_tipo_acto']; ?></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DE SITUACION DE CURADURIA:</label>   
<input type="text" class="form-control" name="nombre_situacion_curaduria"   value="<?php echo htmlentities($row_update['nombre_situacion_curaduria'], ENT_COMPAT, ''); ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">MODALIDAD DE SELECCION:</label>   
<input type="text" class="form-control" name="modalidad_seleccion"   value="<?php echo htmlentities($row_update['modalidad_seleccion'], ENT_COMPAT, ''); ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">ENTIDAD DE DESIGNA:</label>   
<input type="text" class="form-control" name="entidad_designa"   value="<?php echo htmlentities($row_update['entidad_designa'], ENT_COMPAT, ''); ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">ID DE TIPO DE NOMBRAMIENTO:</label>   
<select  class="form-control" name="id_tipo_nombramiento" >
<option value="<?php echo $row_update['id_tipo_nombramiento']; ?>" selected><?php echo $row_update['id_tipo_nombramiento']; ?></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE NOMBRAMIENTO:</label>   
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_nombramiento"  value="<?php echo $row_update['fecha_nombramiento']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">N DE ACTA DE POSESION:</label>   
<select  class="form-control" name="n_acta_posesion" >
<option value="<?php echo $row_update['n_acta_posesion']; ?>" selected><?php echo $row_update['n_acta_posesion']; ?></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE ACTA DE POSESION:</label>   
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_acta_posesion"  value="<?php echo $row_update['fecha_acta_posesion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE TERMINACION:</label>   
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_terminacion"  value="<?php echo $row_update['fecha_terminacion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">ESTADO DE SITUACION DE CURADURIA:</label>   
<br /><input type="radio" name="estado_situacion_curaduria"  value="1"  t="<?php if (1==$row_update['estado_situacion_curaduria']) { echo 'checked'; } else {} ?>"> SI       
<input type="radio"  name="estado_situacion_curaduria"  value="0" t="<?php if (0==$row_update['estado_situacion_curaduria']) { echo 'checked'; } else {} ?>"> NO
</div>
<div class="form-group text-left"> 
<label  class="control-label">EXPERIENCIA:</label>   
<input type="text" class="form-control" name="experiencia"   value="<?php echo htmlentities($row_update['experiencia'], ENT_COMPAT, ''); ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">ANOS DE EXPERIENCIA:</label>   
<select  class="form-control" name="anos_experiencia" >
<option value="<?php echo $row_update['anos_experiencia']; ?>" selected><?php echo $row_update['anos_experiencia']; ?></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">DIRECCION DE NOTIFICACION:</label>   
<input type="text" class="form-control" name="direccion_notificacion"   value="<?php echo htmlentities($row_update['direccion_notificacion'], ENT_COMPAT, ''); ?>">
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success"><input type="hidden" name="table" value="situacion_curaduria"><span class="glyphicon glyphicon-ok"></span> Crear</button></div></form>

<?php } 

mysql_free_result($update);?>
</div>
</div>
</div>
</div>
</div>
	  