<?php
/*
if (!isset($_SESSION['snr'])) {
  echo '<meta http-equiv="refresh" content="0;URL=./" />';
}
*/

require_once('../conf.php');
if (isset($_POST['cc_causante'])) {
   $cc_causante=$_POST['cc_causante'];
   $nom_causante = '';
   	
   $query = "SELECT * FROM ciudadano 
            WHERE identificacion = '$cc_causante' limit 1"; 
   $select = mysql_query($query, $conexion) or die(mysql_error());
   $row_update = mysql_fetch_assoc($select);
   $totalRows_reg = mysql_num_rows($select);
   if (0<$totalRows_reg) {
      $nom_causante = $row_update['nombre_funcionario'];
   } else {
      $nom_causante = 'NO EXISTE CEDULA ...!!! ';
   }	   
echo $nom_causante;
} 

?>  


