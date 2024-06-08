<?php
if (isset($_POST['option']) && ""!=$_POST['option']) {

	require_once('../conf.php'); 
	
	
	global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

	
function quees($table, $valor){
global $mysqli;
$query = "SELECT nombre_".$table." FROM ".$table." where id_".$table."=".$valor." and estado_".$table."=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$info='nombre_'.$table;
if (0<count($row)){
printf ("%s", $row[$info]);
} else { echo 'No esta parametrizado';}
$result->free();
}


$parametro=$_POST['option'];
	

$query_update = sprintf("SELECT * FROM posesion_notaria WHERE id_posesion_notaria = %s and estado_posesion_notaria=1", GetSQLValueString($parametro, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);
?>
<div  class="modal-body"><div class="form-group text-left"> 
<label  class="control-label">NOTARIO:</label>   
<?php echo quees('funcionario', $row_update['id_funcionario']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FORMA DE INGRESO:</label>   
<?php echo $row_update['forma_ingreso']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TIPO DE NOMBRAMIENTO:</label>   
<?php echo quees('tipo_nombramiento_n', $row_update['id_tipo_nombramiento_n']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE INICIO:</label>   
<?php echo $row_update['fecha_inicio']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ACTO DE NOMBRAMIENTO:</label>   
<?php echo $row_update['acto_nombramiento']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOMBRAMIENTO:</label>   
<?php echo $row_update['numero_nombramiento']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE NOMBRAMIENTO:</label>   
<?php echo $row_update['fecha_nombramiento']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOMINADOR:</label>   
<?php echo $row_update['nominador']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ACTO DE CONFIRMACION:</label>   
<?php echo $row_update['acto_confirmacion']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NUMERO DEL ACTO DE CONFORMACION:</label>   
<?php echo $row_update['acto_conf_numero']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DEL ACTO DE CONFIRMACION:</label>   
<?php echo $row_update['acto_conf_fecha']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">AUTORIDAD DEL ACTO DE CONFIRMACION:</label>   
<?php echo $row_update['acto_conf_autoridad']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ACTA DE POSESION - NUMERO:</label>   
<?php echo $row_update['acta_pose_numero']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DEL ACTO DE POSESION:</label>   
<?php echo $row_update['acto_pose_fecha']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ACTO DE POSESION - EFECTOS FISCALES:</label>   
<?php echo $row_update['acto_pose_f_fiscales']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE RECIBO DE LA NOTARIA:</label>   
<?php echo $row_update['fecha_rec_notaria']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CAUSAL DE RETIRO:</label>   
<?php echo $row_update['causal_retiro']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE RETIRO:</label>   
<?php echo $row_update['fecha_retiro']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><B>FECHA DE FINALIZACION </b>:</label>   
<?php echo $row_update['fecha_fin']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">AUTORIDAD QUE RETIRA:</label>   
<?php echo $row_update['autoridad_ret']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TIPO DE DOCUMENTO DE RETIRO:</label>   
<?php echo $row_update['t_doc_ret']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NUMERO DE DOCUMENTO DE RETIRO:</label>   
<?php echo $row_update['n_doc_ret']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE DOCUMENTO DE RETIRO:</label>   
<?php echo $row_update['fecha_doc_ret']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NUMERO DE ACTA DE ENTREGA:</label>   
<?php echo $row_update['n_acta_entrega']; ?>
</div>
</div><?php
}}
?>