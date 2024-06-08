<?php
if (isset($_GET['i'])) {

$curaduria=$_GET['i'];

$nump=privilegios(33,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 0<$nump) {
  
  $query = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where situacion_curaduria.fecha_terminacion>='$realdate' and curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=".$curaduria." limit 1"); 

} 
else {
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where situacion_curaduria.fecha_terminacion>='$realdate' and funcionario.id_funcionario=".$idfun." and curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=".$curaduria." limit 1"); 
}
  
// $query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$funcionarioreal = $row1['id_funcionario'];
$correo = $row1['correo_funcionario'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$ncuraduria=$row1['numero_curaduria'];



?>  







<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-body">
<h3>SEGUNDA ENCUESTA - <?php echo $name; ?>
</h3>

<br>
<?php

$query = sprintf("SELECT * FROM encuesta_curadores, respuesta_enc_cur where encuesta_curadores.encuesta=respuesta_enc_cur.encuesta and respuesta_enc_cur.encuesta=2 and encuesta_curadores.id_encuesta_curadores=respuesta_enc_cur.id_encuesta_curadores and id_curaduria=".$curaduria." and estado_respuesta_enc_cur=1 and estado_encuesta_curadores=1 order by orden_pregunta"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if(0<$totalRows){
	
	
if (isset($_POST['borrar_encuesta'])){ 


$insertSQLa = "update respuesta_enc_cur set estado_respuesta_enc_cur=0 where encuesta=2 and id_curaduria=".$curaduria."";
$Resulta = mysql_query($insertSQLa, $conexion);


echo $actualizado;
echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=segunda_encuesta_curadores&'.$curaduria.'.jsp">';
} else { }


	
	
	
echo '<h4>Ya se encuentra registrada una respuesta.</h4><br>';
echo '<table class="table" border="1"><thead class="thead-dark"><tr><th scope="col">#</th>
      <th scope="col">Pregunta</th>
      <th scope="col">Respuesta</th></tr></thead><tbody>';
do {


	$id_encuesta_cur=$row['id_encuesta_curadores'];
 echo '<tr><td>'.$row['orden_pregunta'].'</td><td>'.$row['nombre_encuesta_curadores'].'</td>';
 
 echo '<td>';
 echo $row['nombre_respuesta_enc_cur'];
  echo '</td></tr>';
 


	 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);
echo ' </tbody></table>';

if (1==$_SESSION['rol'] or 0<$nump) {
echo '
<form action="" method="POST" name="for34543534m1">
<div class="modal-footer">
<input type="hidden" value="1" name="borrar_encuesta">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Borrar encuesta </button></div></form>
';
} else {}

} else {


if (isset($_POST['encuesta'])){ 

$numero = count($_POST);
$tags = array_keys($_POST);
$valores = array_values($_POST);

for($i=0;$i<$numero;$i++){

$pregunta= $tags[$i];
$respuesta=$valores[$i];

$insertSQL = "INSERT INTO respuesta_enc_cur (id_curaduria, encuesta, id_encuesta_curadores, nombre_respuesta_enc_cur, fecha_respuesta, estado_respuesta_enc_cur) VALUES ('$curaduria', 2, '$pregunta', '$respuesta', now(), '1')";
$Result = mysql_query($insertSQL, $conexion);
  

}

echo $insertado;
mysql_free_result($Result);
echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=segunda_encuesta_curadores&'.$curaduria.'.jsp">';

} else { }



?>



<form action="" method="POST" name="form1" >

<table class="table">
<?php 
$query126 = "select * from encuesta_curadores where encuesta=2 and estado_encuesta_curadores=1 order by orden_pregunta asc";
$result126 = mysql_query($query126);
$totalresult126 = mysql_num_rows($result126);
if(0<$totalresult126){
while ($row126 = @mysql_fetch_assoc($result126)){
	
$id_encuesta_cur=$row126['id_encuesta_curadores'];
 echo '<tr><td>'.$row126['orden_pregunta'].'. '.$row126['nombre_encuesta_curadores'].'<td>';
 
 if (1==$row126['tipo_pregunta']) {
	
 echo '<select class="form-control" style="min-width:150px;" name="'.$id_encuesta_cur.'" required>';
  echo '<option value="" selected></option>';
  
$queryj="select * from respuesta_def_cur where id_encuesta_curadores=".$id_encuesta_cur." and estado_respuesta_def_cur=1";
$selectj = mysql_query($queryj, $conexion);
$rowrj = mysql_fetch_assoc($selectj);
$totalRowsj = mysql_num_rows($selectj);
if (0<$totalRowsj){
do {
   echo '<option value="'.$rowrj['nombre_respuesta_def_cur'].'">'.$rowrj['nombre_respuesta_def_cur'].'</option>';
	 } while ($rowrj = mysql_fetch_assoc($selectj)); 
} else {}	 
mysql_free_result($selectj);

	echo '</select>';
	
	
 } else {
echo '<input class="form-control" style="min-width:200px;" name="'.$id_encuesta_cur.'" value="" required>';
 }

 echo '</td></tr>';
}
mysql_free_result($result126);
} else { }


 ?> 
</table>
<!--
<input type="hidden" value="1" name="encuesta">
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Crear </button></div>
-->

</form>


<?php } ?>
<br>

<br>


</div>
</div>
</div>
</div>


<?php } } ?>









