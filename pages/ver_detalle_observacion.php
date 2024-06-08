<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 
	// require_once('listas.php');
	
$idbe=intval($_POST['option']);
$query="SELECT * FROM departamento, notaria, posesion_notaria, funcionario, beneficio_notaria   
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
and departamento.id_departamento=notaria.id_departamento 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND beneficio_notaria.id_notaria=notaria.id_notaria 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
AND estado_beneficio_notaria=1 
AND beneficio_notaria.id_beneficio_notaria=".$idbe." ";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
?>
<div style="padding:10px 10px 10px 10px">
<div class="form-group text-left"> 
<label  class="control-label">Notario:</label> 
<?php echo $row['nombre_funcionario'];  ?>.
 <b>C.C.</b> <?php echo $row['cedula_funcionario'];  ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Notaria:</label> 
<?php echo $row['nombre_departamento']; ?> / <?php echo $row['nombre_notaria']; ?> - <?php $emailn=$row['email_notaria']; echo $emailn; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Mes:</label> 
<?php echo $row['mes_beneficio'];  ?>
</div>


<?php if (isset($row['fecha_envio_rev'])) {  ?>
<div class="form-group text-left"> 
<label  class="control-label">Fecha de analisis:</label> 
<?php echo $row['fecha_envio_rev'].' '; 

/*
$fechaf=$row['fecha_envio_rev'];
$fechaf2 = date('Y-m-d', strtotime($fechaf));
$fecha_ven=fechahabil($fechaf2, 3);
echo ''.$fecha_ven.'';
*/

?>
</div>
<?php } else {}  ?>


<div class="form-group text-left"> 
<label  class="control-label">Observaciones de evaluación:</label> 
<?php 
if (isset($row['nombre_beneficio_notaria'])) {
	echo $row['nombre_beneficio_notaria'];
} else { echo '0'; }
?>
						
</div>


<form action="" method="POST" name="for435435345m1">
<div class="form-group text-left"> 
<label  class="control-label">Observación de la revision:</label> 
<textarea name="observacion_revision" style="width:100%;"><?php echo $row['observacion_revision']; ?></textarea>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Observación del DAF:</label> 
<textarea name="observacion_daf" style="width:100%;"><?php echo $row['observacion_daf']; ?></textarea>
</div><div class="form-group text-left"> 

<input type="hidden" name="id_beneficio_notaria" value="<?php echo $idbe; ?>">
<input type="submit" value="Enviar">
</div>



</div>
<?php
 } else {} 
 ?>
