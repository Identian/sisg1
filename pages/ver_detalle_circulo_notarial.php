<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];
$id2=explode('-',$id);
$dep=$id2[1];
$muni=$id2[0];
require_once('../conf.php'); 

?>
 
<div style="padding: 10px 10px 10px 10px">
 
<?php
$query = sprintf("SELECT * FROM notaria where id_departamento=".$dep." and codigo_municipio=".$muni." and estado_notaria=1 and estado_reparton=1 order by id_notaria"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo ''.$row['nombre_notaria'].'<br> ';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);


echo '<hr>';
if (1<$totalRows){
echo 'Prueba de aleatoriedad: ';
$query2 = sprintf("SELECT * FROM notaria where id_departamento=".$dep." and codigo_municipio=".$muni." and estado_reparton=1 and estado_notaria=1 ORDER BY RAND() LIMIT 1"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
echo $row2['id_notaria'].'-'.$row2['nombre_notaria'];
mysql_free_result($select2);
} else {}
?>

<br><br>
      </div>



<?php 

} else { }

?>




