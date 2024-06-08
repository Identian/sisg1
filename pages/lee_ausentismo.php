<?php

require_once('../conf.php');
if (isset($_POST['id_ausentismo'])) {

   $id_ausentismo = $_POST['id_ausentismo'];
  	  	  
   $query5 = sprintf("SELECT au.id_ausentismo, au.id_funcionario, 
	  au.id_tipo_ausentismo, 
      fecha_inicio, hora_inicio, fecha_final, hora_final, 
      au.id_funcionario_jefe, au.id_funcionario_reempla,
      motivo_ausentismo, soli.nombre_funcionario funcionario_soli,
	  tipoa.nombre_tipo_ausentismo, jefe.nombre_funcionario funcionario_jefe,
	  reem.nombre_funcionario funcionario_reem,
	  au.id_aprobacion_ausentismo, apa.nombre_aprobacion_ausentismo,
	  tot_dias, tot_horas
      FROM ausentismo au
      LEFT JOIN funcionario soli
      ON  au.id_funcionario = soli.id_funcionario
      LEFT JOIN tipo_ausentismo tipoa
      ON au.id_tipo_ausentismo = tipoa.id_tipo_ausentismo
      LEFT JOIN funcionario jefe
      ON  au.id_funcionario_jefe = jefe.id_funcionario
      LEFT JOIN funcionario reem
      ON  au.id_funcionario_reempla = reem.id_funcionario
      LEFT JOIN aprobacion_ausentismo apa
      ON   au.id_aprobacion_ausentismo =  apa.id_aprobacion_ausentismo
	  LEFT JOIN consol_ausentismo f
	  ON au.id_ausentismo = f.id_ausentismo 
      WHERE au.id_ausentismo = %s 
	  AND au.estado_ausentismo = 1 ", GetSQLValueString($id_ausentismo, "int"));
	  $select5 = mysql_query($query5, $conexion) or die(mysql_error());
      $row_5 = mysql_fetch_assoc($select5);
      $totalRows5 = mysql_num_rows($select5);
      if ($totalRows5 > 0){
         $id_ausentismo2 = $row_5['id_ausentismo'];
      }			   
   
      echo $row_5;

}

?>  


