<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];

require_once('../conf.php'); 
require_once('listas.php'); 
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<?php
echo '';
$query2 = sprintf("SELECT nombre_funcionario, id_supervisor, fecha_inicial, fecha_final, cuenta_cobro FROM cuenta_cobro, funcionario where cuenta_cobro.id_funcionario=funcionario.id_funcionario and id_cuenta_cobro=".$id." and estado_cuenta_cobro=1 LIMIT 1"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);

echo 'Contratista: '.$row2['nombre_funcionario'];
echo '<br>Fecha inicial: '.$row2['fecha_inicial'];
echo '<br>Fecha final: '.$row2['fecha_final'];
echo '<br>Cuenta de cobro: <a href="filesnr/cuenta_cobro/'.$row2['cuenta_cobro'].'" target="_blank">Cuenta de cobro.</a>';

$correoenvio=correofuncionario($row2['id_supervisor']);

mysql_free_result($select2);

?>
<br>
<form class="navbar-form" name="for24435434543556436" method="post" action="" enctype="multipart/form-data">

Anexar soportes
<br>
<select name="tipo_soporte_anexo">
<option></option>
<option>Contrato</option>
<option>Adición y Prorroga</option>
<option>RUT</option>
<option>Soporte de retención en la fuente</option>
<option>Formato de retención</option>
<option>Factura electrónica</option>
<option>SECOP</option>
<option>Acta de inicio</option>
<option>Seguridad social</option>
<option>Poliza</option>
<option>Arl</option>
<option>Actos administrativos</option>
<option>Informe</option>
</select>
<br><br>
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>
<br>
<input type="hidden"  name="id_cuenta_cobro" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-xs btn-success">+ Anexar</button>
</form>	


<hr>
<form class="navbar-form" name="for244354345656543556436" method="post" action="" >
<center>
<input type="hidden"  name="id_cuenta_cobro_finaliza" value="<?php echo $id; ?>">
<input type="hidden"  name="correo_supervisa" value="<?php echo $correoenvio; ?>">
<button type="submit" class="btn btn-xs btn-warning confirmarcambio">Notificar al supervisor</button></center>
</form>	



<br>
      </div>



<?php 

} else { }

?>



