<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {	
require_once('../conf.php'); 
session_start();
$id=intval($_POST['option']);
$query235 = "SELECT * FROM concertacion_edl where id_concertacion_edl=".$id." and estado_concertacion_edl=1 limit 1";
$result235 = mysql_query($query235);	
 $row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
 ?>

<div style="padding: 10px 10px 10px 10px">

<form action="" method="post" name="ewr43e353455435ewr" >

<input type="hidden" value="<?php echo $id; ?>" name="cambio_concertacion">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Desde:</label> 
<input type="date" class="form-control" value="<?php echo $row['desde']; ?>" name="cambio_desde" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Hasta:</label> 
<input type="date" class="form-control"  value="<?php echo $row['hasta']; ?>" name="cambio_hasta"  required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Evaluador:</label> 
 
<select class="form-control" name="cambio_evaluador" required >
	<?php
$select1 = mysql_query("select id_funcionario, nombre_funcionario from funcionario where id_cargo in (1, 2, 4, 8, 10) and id_tipo_oficina<3 order by nombre_funcionario ", $conexion);
$row1 = mysql_fetch_assoc($select1);
$totalRows1 = mysql_num_rows($select1);
if (0<$totalRows1){
do {
	echo '<option value="'.$row1['id_funcionario'].'" ';
	if ($row['id_evaluador']==$row1['id_funcionario']) { echo 'selected'; } else {}
	echo '>'.$row1['nombre_funcionario'].'</option>';
	 } while ($row1 = mysql_fetch_assoc($select1)); 
} else {}	 
mysql_free_result($select1);
?>
</select>


</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Comisión evaluadora:</label> 





 <select class="form-control" name="cambio_comision" required >
<!--<option value="2319" <?php //if (2319==$row['id_comision']) { echo 'selected'; } else {} ?> >No requiere comisión</option>-->
	<?php
$select2 = mysql_query("select id_funcionario, nombre_funcionario from funcionario where id_cargo in (1, 2, 4, 8, 10) and id_tipo_oficina<3 and estado_funcionario=1 order by nombre_funcionario", $conexion);
$row2 = mysql_fetch_assoc($select2);
$totalRows2 = mysql_num_rows($select2);
if (0<$totalRows2){
do {
	echo '<option value="'.$row2['id_funcionario'].'" ';
	if ($row['id_comision']==$row2['id_funcionario']) { echo 'selected'; } else {}
	echo '>'.$row2['nombre_funcionario'].'</option>';
	 } while ($row2 = mysql_fetch_assoc($select2)); 
} else {}	 
mysql_free_result($select2);
			?>
</select>
</div>


<div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span>
Tipo de evaluación</label>
<select name="cambio_tipo_concertacion" class="form-control" required> 
<option value="<?php echo $row['tipo_concertacion']; ?>" selected><?php echo $row['tipo_concertacion']; ?></option>
<option value="Calificación definitiva">Calificación definitiva</option>
<option value="Evaluación parcial eventual">Evaluación parcial eventual</option>
<option value="Calificación extraordinaria">Calificación extraordinaria</option>
<option value="Calificación inferior al semestre">Calificación inferior al semestre</option>
</select>
</div>

<div class="form-group text-left" > 
<label  class="control-label">
Seleccione motivo en caso de evaluación parcial o extraordinaria</label>
<select name="cambio_motivo_parcial" class="form-control obligaedl"> 
<option selected><?php echo $row['motivo_parcial']; ?></option>
<option>Cambio de evaluador</option>
<option>Lapso entre la última evaluación y el final del periodo</option>
<option>Por perido de prueba en otro empleo</option>
<option>Separación temporal del empleo por más de 30 días calendario</option>
<option>Cambio de empleo por traslado o reubicación</option>
<option> </option>
</select>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="estado_contable">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>


</form>

</div>
<?php

	} else { }
mysql_free_result($result235);


} else {}
?>


