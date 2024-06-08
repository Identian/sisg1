
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
  


<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
require_once('../conf.php'); 
session_start();



 $id=intval($_POST['option']);


$query235 = "SELECT * FROM funcionario, nomina WHERE funcionario.cedula_funcionario=nomina.identificacion and 
id_nomina=".$id." limit 1";
$result235 = mysql_query($query235);	
 $row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
	$cedulaa=$row['cedula_funcionario'];
	$namefun=$row['nombre_funcionario'];



 ?>
<div style="padding: 10px 10px 10px 10px">
<?php echo $namefun; ?>
<br>

<form action="" method="post" name="ewr43ewrewr3243244353455435ewr">
<br>
Dependencia 
<select class="form-control" style="width:100%;" name="id_dependencia">
<?php
$query346 = sprintf("select * from dependencia order by codigo "); 
$select346 = mysql_query($query346, $conexion);  
$rowrt46 = mysql_fetch_assoc($select346);
$totalRows346 = mysql_num_rows($select346);
if (0<$totalRows346){

do {
echo '<option value="'.$rowrt46['codigo'].'" ';

if ($row['codegrupo']==$rowrt46['codigo']) { echo 'selected'; } else {}
echo '>'.$rowrt46['codigo'].' / '.$rowrt46['nombre_dependencia'].'</option>';

} while ($rowrt46 = mysql_fetch_assoc($select346));  
} else {}	 
mysql_free_result($select346);
?>
</select>

<br>
Cargo <input type="number" name="id_cargo" class="form-control" maxlength="4" value="<?php echo $row['cargo']; ?>"><br>
Grado <input type="number" name="id_grado" class="form-control" maxlength="2" value="<?php echo $row['grado']; ?>"><br>

Fecha de ingreso <input type="date" name="fecha_ingreso2" class="form-control"  value="<?php echo $row['fecha_ingreso2']; ?>"><br>

<div class="modal-footer">
<button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-ok"></span> Guardar</button>
<input type="hidden" name="id_nomina" value="<?php echo $id; ?>">
<input type="hidden" name="id_cedula" value="<?php echo $cedulaa; ?>">

</form>

</div>
<?php

	} else { }
mysql_free_result($result235);


} else {}
?>


