<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {	
require_once('../conf.php'); 
require_once('listas.php');
session_start();
$id=intval($_POST['option']);
$query235 = "SELECT * FROM concertacion_edl where id_concertacion_edl=".$id." and 
(id_comision=".$_SESSION['snr']." or id_evaluador=".$_SESSION['snr'].") 
and estado_concertacion_edl=1 limit 1";
$result235 = mysql_query($query235);	
$row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
 ?>

<div style="padding: 10px 10px 10px 10px">

<form action="" method="post" name="ewr43e353455435435435ewr" >
<input type="hidden" value="<?php echo $row['id_evaluador']; ?>" name="userevaluador">
<input type="hidden" value="<?php echo $id; ?>" name="id_concertacion_com">
<div class="form-group text-left"> 
<label  class="control-label">COMISIÓN EVALUADORA:</label> 
<input type="text" class="form-control" value="<?php echo quees('funcionario',$row['id_comision']); ?>"  readonly >
</div>

<div class="form-group text-left"> 
<label  class="control-label"> COMPROMISOS:</label> 
<?php

$notas=array();

$select1 = mysql_query("SELECT * from compromiso_edl, metas_edl where compromiso_edl.id_metas_edl=metas_edl.id_metas_edl  
and id_concertacion_edl=".$id." and estado_compromiso_edl=1 ", $conexion);
$row4 = mysql_fetch_assoc($select1);
$totalRows1 = mysql_num_rows($select1);
if (0<$totalRows1){
$i=1;
do {
$compromiso=$row4['id_compromiso_edl'];
echo '<br>'.$i++.'. ';
echo '<b>'.$row4['nombre_metas_edl'].'</b>: ';
echo ''.$row4['nombre_compromiso_edl'].'. ';
echo '<b>'.$row4['porcentaje'].'%</b>. ';
if (isset($row4['nota'])) {
echo '<b>Nota: '.$row4['nota'].'</b> ';
array_push($notas, 1);
} else {
array_push($notas, 0);
echo 'Pendiente';
}
if (isset($row4['confirmacion_nota'])) {
if (1==$row4['confirmacion_nota']) {
 echo '<span style="color:#3F8E4D">Aprobada</span>';
} else { echo '<span style="color:#B52824">Rechazada</span>';

 } 
} else { 

echo 'Confirmación: <select  name="aprobarcompromiso-'.$compromiso.'">';
echo '<option value="" selected=""></option>
<option value="1">Si</option>
<option value="0">No</option>';
echo '</select> ';

 }
	 } while ($row4 = mysql_fetch_assoc($select1)); 
} else {}	 
mysql_free_result($select1);
?>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> COMPETENCIAS:</label> 
<?php
$select12 = mysql_query("SELECT * from competencia_edl, competencias_edl where 
competencia_edl.id_competencias_edl=competencias_edl.id_competencias_edl 
and id_concertacion_edl=".$id." and estado_competencia_edl=1 ", $conexion);
$row42 = mysql_fetch_assoc($select12);
$totalRows12 = mysql_num_rows($select12);
if (0<$totalRows12){
$e=1;
do {
$competencia=$row42['id_competencia_edl'];
echo '<br>'.$e++.'. ';
echo '<b>'.$row42['nombre_competencias_edl'].'</b>: ';
echo ''.$row42['definicion_edl'].'. ';
echo '<i>'.$row42['conducta_asociada'].'</i>. ';
if (isset($row42['nota'])) {
echo '<b>Nota: '.$row42['nota'].'</b> ';
} else {
echo 'Pendiente';
}
if (isset($row42['confirmacion_nota'])) {
if (1==$row42['confirmacion_nota']) {
 echo '<span style="color:#3F8E4D">Aprobada</span>';
} else { echo '<span style="color:#B52824">Rechazada</span>';

 } 
} else { 
echo 'Confirmación: <select  name="aprobarcompetencia-'.$competencia.'">';
echo '<option value="" selected=""></option>
<option value="1">Si</option>
<option value="0">No</option>';
echo '</select> ';
 }

	 } while ($row42 = mysql_fetch_assoc($select12)); 
} else {}	 
mysql_free_result($select12);
?>


</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<?php 

$valnotas= array_sum($notas);


if (3<=$valnotas) { ?>

<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="estado_contable">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
<?php } else {} ?>
</div>


</form>

</div>
<?php

	} else { echo 'No tiene permisos'; }
mysql_free_result($result235);


} else {}
?>


