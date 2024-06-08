<?php
/*
if (!isset($_SESSION['snr'])) {
  echo '<meta http-equiv="refresh" content="0;URL=./" />';
}
*/

require_once('../conf.php');
if (isset($_POST['id_sucesion'])) {

//   $id_sucesion=$_GET['i'];
   $id_sucesion = $_POST['id_sucesion'];
   $num_causantes = 0;
   $tot_causantes = 0;
   $difer = 0;
   $query_update = sprintf("SELECT num_causantes 
   FROM sucesion 
   WHERE id_sucesion = %s 
   and estado_sucesion = 1 ", GetSQLValueString($id_sucesion, "int"));
   $update = mysql_query($query_update, $conexion) or die(mysql_error());
   $row_update = mysql_fetch_assoc($update);
   $totRows = mysql_num_rows($update);
   if ($totRows > 0) {
      $num_causantes = $row_update['num_causantes'];
   }			   

   $query_update12 = sprintf("SELECT count(id_sucesion) tot_causantes 
   FROM causante 
   WHERE id_sucesion = %s 
   and estado_causante = 1 ", GetSQLValueString($id_sucesion, "int"));
   $update12 = mysql_query($query_update12, $conexion) or die(mysql_error());
   $row_update12 = mysql_fetch_assoc($update12);
   $totRows12 = mysql_num_rows($update12);
   if ($totRows12 > 0) {
      $tot_causantes = $row_update12['tot_causantes'];
   }			   

   if($num_causantes === $tot_causantes){
     $difer = 10;
   } else {
	 $difer = 0; 
   }

    echo $difer;
} else {}

?>  


