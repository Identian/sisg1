<?php
session_start();
	
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
require_once('../conf.php');

$idcausante=intval($_POST['option']);
	
$query = "SELECT num_dcto_causante, nombre_ciudadano FROM causante, ciudadano where causante.num_dcto_causante=ciudadano.identificacion and id_causante=".$idcausante." and estado_causante=1  order by id_causante limit 1"; 

$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){




echo '<input type="hidden" name="identificacion"  value="'.$row['num_dcto_causante'].'" required>';

echo '<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL CIUDADANO:</label> 
<input type="text" class="form-control" name="nombre_ciudadano"  value="'.$row['nombre_ciudadano'].'" required>
</div>';



	 
	 
	 



} else {}	 

mysql_free_result($select);


} else {}


?>






