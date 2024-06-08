<?php
/*
if (!isset($_SESSION['snr'])) {
  echo '<meta http-equiv="refresh" content="0;URL=./" />';
}
*/

require_once('../conf.php');
if (isset($_POST['cc_funreg'])) {
   $cc_funreg=$_POST['cc_funreg'];
   $nom_funreg = '';
   	
   $query = "SELECT * FROM funcionario 
            WHERE cedula_funcionario = '$cc_funreg' limit 1"; 
   $select = mysql_query($query, $conexion) or die(mysql_error());
   $row_update = mysql_fetch_assoc($select);
   $totalRows_reg = mysql_num_rows($select);
   if (0<$totalRows_reg) {
      $nom_funreg = $row_update['nombre_funcionario'];
   } else {
      $nom_funreg = 'NO EXISTE CEDULA ...!!! ';
   }	   
echo $nom_funreg;
} 

?>  


