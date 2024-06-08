<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$idradicado=intval($_POST['option']);
require_once('../conf.php'); 
$query_update = "SELECT * FROM traza_radicacion, radicacion_curaduria, funcionario 
where traza_radicacion.id_radicacion_curaduria=radicacion_curaduria.id_radicacion_curaduria 
and traza_radicacion.id_funcionario=funcionario.id_funcionario 
and traza_radicacion.nombre_traza_radicacion LIKE '%fecha_cambio_legal%' 
and traza_radicacion.id_radicacion_curaduria=".$idradicado."";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>
 
 

<div style="padding: 10px 10px 10px 10px">
<?php 
echo '<b>Total de transacciones: '.$totalRows_update.'</b><br><br>';
?>

<?php do {?>
<label  class="control-label">Id</label> 
<?php echo $row_update['id_radicacion_curaduria']; ?>
<br>
<label  class="control-label">Nùmero</label> 
<?php echo $row_update['codigo_curaduria'].'-'.$row_update['numero_radicacion_curaduria']; ?>
<br>
<label  class="control-label">Fecha</label> 
<?php echo $row_update['fecha_traza_radicacion']; ?>
<br>
<label  class="control-label">Usuario</label> 
<a href="usuario&<?php echo $row_update['id_funcionario']; ?>.jsp" target="_blank"><?php echo $row_update['nombre_funcionario']; ?></a>
<br>
<label  class="control-label">Descripción</label> 
<?php  //echo $row_update['nombre_traza_radicacion']; ?>


<table border="1">
<tr>
<td>Objeto</td><td>Actuación</td><td>Est. Rad</td><td>Fecha creacion</td><td>Fecha debida forma</td>
<td>Estado proyecto</td><td>Fecha cambio estado</td><td>Cedulas</td><td>Matriculas</td>
</tr>
<?php

  $data = json_decode($row_update['nombre_traza_radicacion']);
  
echo '<tr><td>';
$object=$data->id_objeto_lic_curaduria2;


if ($object=="1") { echo "Licencia Urbanistica"; } else 
if ($object=="4") { echo "Modificación de Licencia urbanistica"; } else 
if ($object=="5") { echo "Revalidación de Licencia urbanistica"; } else 
if ($object=="6") { echo "Modificación de Licencia vigente con Prórroga 1"; } else 
if ($object=="7") { echo "Modificación de Licencia vigente con Prórroga 2"; } else 
if ($object=="9") { echo "Modificación de la Revalidación"; } else 
if ($object=="10") { echo "Modificación de la Revalidación con Prórroga"; } else 
if ($object=="11") { echo "Revalidación con prorroga 1"; } else 
if ($object=="12") { echo "Revalidación con prorroga 2"; } else 
if ($object=="13") { echo "Reconocimiento de la existencia de edificaciones"; } else 
if ($object=="14") { echo "Licencia urbanistica con Reconocimiento de la existencia de edificaciones."; 

} else {}
	
	
	

echo '</td><td>'.$data->actuacion2;
echo '</td><td>'.$data->radicacion_legal_update;
echo '</td><td>'.$data->fecha_radicacion_curaduria;
echo '</td><td>'.$data->fecha_cambio_legal;
echo '</td><td>'.$data->estado_r;
echo '</td><td>'.$data->fecha_cambio_estado;
echo '</td><td>'.$data->cedulas2;
echo '</td><td>'.$data->matriculas2;
echo '</td></tr>';
 
?>
</table>

<?php } while ($row_update = mysql_fetch_assoc($update)); ?>

</div>



<?php 
} else {
	
	echo '<div style="padding: 10px 10px 10px 10px">No se encontro auditoria especifica, <a href="auditoria.jsp" target="_blank">por favor auditar de forma general.</a></div>';
	
}
mysql_free_result($row_update);
} else { }?>



