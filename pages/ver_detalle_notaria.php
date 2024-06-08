<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 


$queryt = sprintf("SELECT id_notaria, nombre_notaria FROM notaria where id_departamento=".$_POST['option']." order by id_notaria"); 
$selectt = mysql_query($queryt, $conexion) ;
$rowt = mysql_fetch_assoc($selectt);
$totalRowst = mysql_num_rows($selectt);
if (0<$totalRowst){
	echo '<option selected></option>';
do {
	echo '<option value="'.$rowt['id_notaria'].'" ';
	echo '>'.$rowt['nombre_notaria'].'</option>';
	 } while ($rowt = mysql_fetch_assoc($selectt)); 
} else {}	 
mysql_free_result($selectt);


 } else {} 
 ?>
