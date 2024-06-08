<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];

require_once('../conf.php'); 

function quees($table, $valor){
global $mysqli;
$query = "SELECT nombre_".$table." FROM ".$table." where id_".$table."=".$valor." and estado_".$table."=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
$info='nombre_'.$table;
if (0<count($row)){
$nameff=$row[$info];
} else { $nameff='No esta parametrizado';}
$result->free();
return $nameff;
}
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<?php
echo '';
$query2 = sprintf("SELECT * FROM cuenta_cobro, funcionario, nc_contratos 
where funcionario.id_funcionario=nc_contratos.id_funcionario and cuenta_cobro.id_funcionario=funcionario.id_funcionario and id_cuenta_cobro=".$id." and estado_cuenta_cobro=1 LIMIT 1"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$name=$row2['nombre_funcionario'];
echo 'Contratista: '.$name;
//echo '<br>Supervisor: '.quees('funcionario',$row2['id_funcionario_supervisor']).'';
echo '<br>Objeto: '.$row2['objeto'].'';

$correoenvio=$row2['correo_funcionario'];
$cedulaenvio=$row2['cedula_funcionario'];

echo '<br>Fecha inicial: '.$row2['fecha_inicial'];
echo '<br>Fecha final: '.$row2['fecha_final'];

echo '<br>Número de contrato: '.$row2['contrato_pago'].'';
echo '<br>Año de contrato: '.$row2['ano_datos_contrato'].'';


echo '<br><b><a href="filesnr/cuenta_cobro/'.$row2['cuenta_cobro'].'" target="_blank">Cuenta de cobro.</a></b><br>';


mysql_free_result($select2);


$query23 = sprintf("SELECT * FROM soporte_cuenta_cobro where id_cuenta_cobro=".$id." and estado_soporte_cuenta_cobro=1 order by nombre_soporte_cuenta_cobro asc"); 
$select23 = mysql_query($query23, $conexion);
$row23 = mysql_fetch_assoc($select23);
$totalRows23 = mysql_num_rows($select23);
if (0<$totalRows23){
do {
		echo '<a href="filesnr/cuenta_cobro/'.$row23['url'].'" target="_blank">'.$row23['nombre_soporte_cuenta_cobro'].'</a><br>';
	 } while ($row23 = mysql_fetch_assoc($select23)); 
} else {}	 
mysql_free_result($select23);


?>

<br>


<form class="navbar-form" name="for2456436" method="post" action="" enctype="multipart/form-data" >


<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO APROBADO / FIRMADO : </label> 
<input type="file" name="file" id="file" title="Solo PDF" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>
<br>
<input type="hidden"  readonly  name="estado" value="Aprobado">
<input type="hidden"  name="id_cuenta_cobro" value="<?php echo $id; ?>">
<input type="hidden"  name="correo_contratista" value="<?php echo $correoenvio; ?>">
<input type="hidden"  name="nombre_contratista" value="<?php echo $name; ?>">
<input type="hidden"  name="cedula_contratista" value="<?php echo $cedulaenvio; ?>">
<button type="submit" class="btn btn-success">Aprobar</button>
</form>	
<hr>

<form class="navbar-form" name="for2435456436" method="post" action="">
<input type="hidden" class="form-control"  readonly  name="estado" value="Rechazado">
Motivo de rechazo:<br>
<textarea class="form-control" name="motivo" required style="width:100%;"></textarea>
<br>
<input type="hidden"  name="correo_contratista" value="<?php echo $correoenvio; ?>">
<input type="hidden"  name="id_cuenta_cobro" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-danger">Rechazar</button>
</form>	


<br>
      </div>



<?php 

} else { }

?>



