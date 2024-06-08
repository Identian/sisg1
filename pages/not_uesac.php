<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];

 echo 'ver parametro'.$parametro;

?>
	<select name="id_not_actos" class="form-control" required>
    <?php
    $query = sprintf("SELECT id_not_actos, nombre_not_actos, eo_not_actos FROM not_actos where  eo_not_actos='$parametro' and estado_not_actos=1 order by nombre_not_actos Asc"); 
    $select = mysql_query($query, $conexion) or die(mysql_error());
    $row = mysql_fetch_assoc($select);
    $totalRows = mysql_num_rows($select);
    if (0<$totalRows){
    do {
      echo '<option value="'.$row['id_not_actos'].'"  ';
      
      if ($row['id_not_actos']) {} else {} 
      
      echo '>'.$row['nombre_not_actos'].'</option>';
       } while ($row = mysql_fetch_assoc($select)); 
    } else {}  
    mysql_free_result($select);
    ?>
    </select><br>
<?php
} else {}

?>


