<?php
  if (1==$_SESSION['rol']) {
  ?>
 
<div class="row">
<style>
a:visited { 
    color:#ff0000;
}
</style>
<div class="col-md-12">
            
<div class="panel panel-default">
  <div class="panel-body">
 
	
<?php

if (isset($_GET['i'])) {
  $id=intval($_GET['i']);
  
    $updateSQL77 = sprintf("UPDATE solicitud_pqrs SET id_estado_solicitud=%s WHERE id_solicitud_pqrs=%s and estado_solicitud_pqrs=1",                  
					  GetSQLValueString(2, "int"),
					 GetSQLValueString($id, "int"));
  $Result177 = mysql_query($updateSQL77, $conexion) or die(mysql_error());
  
   } else {   } 


$array0 = array();


echo ' <h3> Analisis de datos</h3><hr>';



$select = mysql_query("SELECT * FROM auditoria where descripcion_auditoria like '%[borrardetabla] => respuesta_pqrs%'", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

echo '<b>Borrado de respuestas de PQRS:</b><br><br>';
do {
	
$info1=explode("solicitud_pqrs%26", $row['url']);
$info2=explode(".js", $info1[1]);
$info=$info2[0];

echo $row['fecha_hora'].' - '.$row['url'].' - '.$row['alias'].'<br>';
//<a href="mantenimiento_preventivo&'.$info.'.jsp">Tramitar</a>

	
	 } while ($row = mysql_fetch_assoc($select)); 
	 

} else { } 
mysql_free_result($select);




 echo '<hr>';


 
 
$select2 = mysql_query("SELECT * FROM solicitud_pqrs where id_estado_solicitud=1 and estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row2 = mysql_fetch_assoc($select2);
$totalRows2 = mysql_num_rows($select2);
if (0<$totalRows2){

echo '<b>PQRS en estado de proceso de radicación:</b><br><br>';
do {
	
echo quees('canal_pqrs', $row2['id_canal_pqrs']).' - '.$row2['fecha_radicado'].' - '.$row2['id_solicitud_pqrs'].' - '.$row2['radicado'].' - <a href="mantenimiento_preventivo&'.$row2['id_solicitud_pqrs'].'.jsp">Tramitar</a><br>';

	
	 } while ($row2 = mysql_fetch_assoc($select2)); 
	 

} else { } 
mysql_free_result($select2);





?>



</div>
</div>
</div>


</div>

<?php
} else { } 
?>

