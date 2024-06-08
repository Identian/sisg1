<?php
$nump155=privilegios(155,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump155) { 




function oacf() {
global $mysqli;
$query = "SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=24 and estado_funcionario=1 order by nombre_funcionario";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
$func.= '<option value="'.$obj['id_funcionario'].'">'.$obj['nombre_funcionario'].'</option>';
}
$result->free();
return $func;
}




function cualnumero($ofi) {
$menor=$ofi-1;
global $mysqli;
$query4hj = sprintf("SELECT id_gestion_pqrs FROM solicitud_pqrs where id_solicitud_pqrs=".$menor."  and estado_solicitud_pqrs=1 "); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
$reshhj=intval($row4hj['id_gestion_pqrs']);
return $reshhj;
$result4hj->free();
}





function updatenum($ido) {
	
$nume=cualnumero($ido);
$cant=$nume+1;

//INACTIVAR ANALISTA if (3==$cant) {  $cant=$cant+1; } else {
	
if (4<$cant) {
	$canti=1;
} else {
	$canti=$cant;
}
//}
global $mysqli;
$query88 = "UPDATE solicitud_pqrs SET id_gestion_pqrs=".$canti." WHERE id_solicitud_pqrs=".$ido."";  
$result44 = $mysqli->query($query88);
return;
}



function repartirpqrs() {
global $mysqli;
$query = "SELECT id_solicitud_pqrs from solicitud_pqrs where id_gestion_pqrs IS null and estado_solicitud_pqrs=1 
 and  id_estado_solicitud=2 and pqrs_direccionada!=1 
 ";
$result = $mysqli->query($query);  //and id_solicitud_pqrs>220360

while ($obj = $result->fetch_array()) {
$reg=$obj['id_solicitud_pqrs'];
echo updatenum($reg);

}
$result->free();
return;
}




IF ((isset($_POST['repartir']) and ""!=$_POST['repartir']) OR (isset($_GET['q']))) {
echo repartirpqrs();
$fechadd= date('Y-m-d H:i:s');

echo '<script type="text/javascript">swal(" OK !", " Reparto realizado Correctamente.  '.$fechadd.'", "success");</script>';

}




function upd($idd,$ff) {
global $mysqli;
$query888 = "UPDATE gestion_pqrs SET id_funcionario=".$ff." WHERE id_gestion_pqrs=".$idd."";  
$result444 = $mysqli->query($query888);
return 'OK';
}

IF (isset($_POST['id_gestion_pqrs']) and ""!=$_POST['id_gestion_pqrs']) {
echo upd($_POST['id_gestion_pqrs'],$_POST['id_funcionario']);
}



function cuentare($vv) {
global $mysqli;
$query4h = sprintf("SELECT count(id_solicitud_pqrs) as cc FROM solicitud_pqrs where id_gestion_pqrs=".$vv."  AND pqrs_direccionada!=1 and estado_solicitud_pqrs=1"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['cc'];
return $reshh;
$result4h->free();
}

?>

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
 



<div class="col-md-12">
<p>REPARTOS DE PQRSD
<form class="navbar-form" name="form144355344354326435436" method="post" action="">
<input type="hidden" name="repartir" value="1">
<button type="submit" class="btn btn-success">Repartir</button> 
  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; <b>Fecha:
<?php echo  date('Y-m-d');?></b>
</form>

</p>
<br><br><br>
</div>

<?php
$query = sprintf("SELECT id_gestion_pqrs, nombre_funcionario FROM funcionario, gestion_pqrs where funcionario.id_funcionario=gestion_pqrs.id_funcionario and estado_funcionario=1 and estado_gestion_pqrs=1 order by id_gestion_pqrs"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	?>
<div class="form-group text-left"> 
<label  class="control-label">Gestión <?php echo $row['id_gestion_pqrs']; ?>:</label>   
<form class="navbar-form" name="formret145354326435436<?php echo $row['id_gestion_pqrs']; ?>" method="post" action="">
<input type="hidden" name="id_gestion_pqrs" value="<?php echo $row['id_gestion_pqrs']; ?>">
<?php echo $row['nombre_funcionario']; ?> 
<div class="input-group">
<div class="input-group-btn">

<select class="form-control" name="id_funcionario"  required>
<option></option>
<?php echo oacf(); ?>
</select>
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button> 
</div>
</div> &nbsp;  &nbsp; 
<?php echo cuentare($row['id_gestion_pqrs']); ?> Registros
</form>
</div>


<?php
 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>






</div>
</div>
</div>
</div>

<?php } else { }?>