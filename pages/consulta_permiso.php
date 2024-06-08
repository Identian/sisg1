<style>
.table {
	width:100%;
}
</style>
<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=intval($_POST['option']);



/*

$query_regh = "SELECT * FROM documento_permiso, sub_tipo_adjunto WHERE documento_permiso.id_sub_tipo_adjunto=sub_tipo_adjunto.id_sub_tipo_adjunto and documento_permiso.id_permiso =".$parametro." and documento_permiso.estado_documento_permiso=1";
 $regh = mysql_query($query_regh, $conexion);
$row_regh = mysql_fetch_assoc($regh);
$totalRows_regh = mysql_num_rows($regh);
if (0<$totalRows_regh) {
 do {
  echo '<a href="filesnr/documento_permiso/'.$row_regh['nombre_documento_permiso'].'" target="_blank">';
  echo '<img src="images/pdf.png"> <span title="'.$row_regh['fecha_subida'].'">'.$row_regh['nombre_sub_tipo_adjunto'].'</span>';
  echo '</a>';
 } while ($row_regh = mysql_fetch_assoc($regh));   
  echo '<br><br>';
  } else { echo ''; }
*/



$actualizar5 = mysql_query("SELECT fecha_permiso, hora_desde, hora_hasta, nombre_tipo_encargo, nombre_funcionario FROM dia_licencia, funcionario, tipo_encargo where funcionario.id_funcionario=dia_licencia.id_funcionario_encargo and dia_licencia.id_tipo_encargo=tipo_encargo.id_tipo_encargo and id_permiso=".$parametro." and estado_dia_licencia=1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
echo '<table class="table">';
echo '<tr><td>Fecha</td>';
echo '<td>Hora desde</td>';
echo '<td>Hora hasta</td>';
echo '<td>Tipo de encargo</td>';
echo '<td>Encargado</td></tr>';

 do {

echo '<tr><td>'.$row15['fecha_permiso'].'</td>';
echo '<td>'.$row15['hora_desde'].'</td>';
echo '<td>'.$row15['hora_hasta'].'</td>';
echo '<td>'.$row15['nombre_tipo_encargo'].'</td>';
echo '<td>'.$row15['nombre_funcionario'].'</td></tr>';


 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  
echo '</table>';
} else {}

mysql_free_result($actualizar5); 

} else { }
?>