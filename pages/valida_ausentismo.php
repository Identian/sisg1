<?php

require_once('../conf.php');
if (isset($_POST['id_ausentismo'])) {

   $id_ausentismo = $_POST['id_ausentismo'];
   $num_causantes = 0;
   $tot_causantes = 0;
   $difer = 0;
   $query_update = sprintf("SELECT * 
   FROM ausentismo 
   WHERE id_ausentismo = %s 
   and estado_ausentismo = 1 ", GetSQLValueString($id_ausentismo, "int"));
   $update = mysql_query($query_update, $conexion) or die(mysql_error());
   $row_update = mysql_fetch_assoc($update);
   $totRows = mysql_num_rows($update);
   if ($totRows > 0) {
      $difer = 10;
   }			   
   
    echo $difer;
} 

?>  


