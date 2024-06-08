<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=intval($_POST['option']);

require_once('../conf.php'); 



$query_update = "SELECT * FROM entidad_reparto, reparto, categoria_reparto where reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto and entidad_reparto.id_entidad_reparto=reparto.id_entidad_reparto and id_reparto= ".$id."  and estado_entidad_reparto=1 limit 1";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 

<?php if (7==$row_update['id_categoria_reparto']) { ?>
<div class="form-group text-left"> 
<label  class="control-label"></label> 
<?php echo $row_update['nombre_entidad_reparto']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Tipo:</label> 
Persona Natural
</div>

<?php } else {
	?>
	
	<div class="form-group text-left"> 
<label  class="control-label">Entidad: </label> 
<?php echo $row_update['nombre_entidad_reparto']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Tipo:</label> 
<?php echo $row_update['tipo']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Correo electrónico:</label> 
<?php echo $row_update['correo_entidad']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Dirección:</label> 
<?php echo $row_update['direccion_entidad']; ?>
</div>

<?php	
} ?>




<div class="form-group text-left"> 
<label  class="control-label">Fecha:</label> 
<?php echo $row_update['fecha_ingreso']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Categoria de reparto:</label> 
<?php echo $row_update['nombre_categoria_reparto'];
 ?>
</div>

<?php 
if (7==$row_update['id_categoria_reparto']) {
} else { ?>

<div class="form-group text-left"> 
<label  class="control-label">Nombre del proyecto:</label> 
<?php echo $row_update['nombre_reparto']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Código:</label> 
<?php echo $row_update['codigo']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Cuantia:</label> 
<?php echo number_format($row_update['cuantia']); ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Actos:</label> 
<?php echo $row_update['actos']; ?>
</div>

<?php }  ?>


<div class="form-group text-left"> 
<label  class="control-label">Unidades:</label> 
<?php echo $row_update['unidades']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Intervinientes:</label> 
<?php echo $row_update['intervinientes']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Correos de intervinientes:</label> 
<?php echo $row_update['correos_intervinientes']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Matriculas:</label> 
<?php $matriculas=$row_update['matriculas']; echo $matriculas;

$query_updateu = "SELECT count(id_reparto) as cuenta FROM reparto where matriculas like '%$matriculas%' and estado_reparto=1 and anulado!=1";
$updateu = mysql_query($query_updateu, $conexion);
$row_u = mysql_fetch_assoc($updateu);
if (1<$row_u['cuenta']){
	echo ' / <span style="color:#960721">Ya existe la matricula en otro reparto.</span>';
} else {}
mysql_free_result($updateu);

?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Dirección:</label> 
<?php echo $row_update['direccion_reparto']; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Formulario solicitante:</label> 
<a href="filesnr/reparto/<?php echo $row_update['url']; ?>" target="_blank">Ver</a>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Observaciones:</label> 
<?php echo $row_update['observaciones']; ?>
</div>


<?php 
if (isset($row_update['id_notaria'])) { Echo 'Ya fue repartida'; } else { 

if (isset($row_update['correo_entidad'])) { 

$dep=$row_update['id_departamento'];
$muni=$row_update['id_municipio'];

$query = sprintf("SELECT count(id_notaria) as cuent FROM notaria where id_departamento=".$dep." and codigo_municipio=".$muni." and estado_notaria=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
if (1<$row['cuent']){

?>
<form action="" method="POST" name="for23423454432dsfds3m1">
<div class="modal-footer">
<input type="hidden"  name="id_reparto2"  value="<?php  echo $row_update['id_reparto']; ?>">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Revisar </button>
</div>
</form>
<?php 
} else {
		echo ' &nbsp;  &nbsp;  &nbsp; <b style="color:#ff0000;">El municipio no tiene 2 ó mas notarias, no es posible repartir.</b>'; 
}

} else { echo ' &nbsp;  &nbsp;  &nbsp; <b style="color:#ff0000;">La entidad debe tener correo para poder repartir</b>'; } 


} ?>
<br><br>

<hr>

<br>

 <form action="" method="POST" name="formewr31">
Rechazar:<br>
	<textarea name="rechazo" style="width:100%" required></textarea>
	<br>
	<button type="submit" class="btn btn-success">
	  <input type="hidden" name="id_rechazo" value="<?php  echo $row_update['id_reparto']; ?>">
                        <span class="glyphicon glyphicon-ok"></span>Rechazar</button>
				  
				</form>
				<br><br>
      </div>



<?php 
} else {}
mysql_free_result($update);
} else { }

?>




