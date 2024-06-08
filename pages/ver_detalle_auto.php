<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$idper=intval($_POST['option']);
	

$query = sprintf("SELECT * FROM auto_oaj, oficina_registro where auto_oaj.id_oficina_registro=oficina_registro.id_oficina_registro and id_auto_oaj=".$idper." and estado_auto_oaj=1 limit 1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($select);
echo '<div style="padding: 10px 30px 30px 30px">';
?>

<div class="form-group text-left"> 
<label  class="control-label">OFICINA DE REGISTRO:</label>   
<?php echo $row_update['nombre_oficina_registro']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RADICACIÓN:</label>   
<?php echo $row_update['radicacion']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE ENTRADA:</label>   
<?php echo $row_update['fecha_entrada']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE PUBLICACIÓN:</label>   
<?php echo $row_update['fecha_publicacion']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">EXPEDIENTE:</label>   
<?php echo $row_update['expediente']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">MATRICULA:</label>   
<?php echo $row_update['matricula']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CERTIFICADO DE INTEGRIDAD <a href="http://relatoria.consejodeestado.gov.co:8081/Vistas/documentos/evalidador" target="_blank">Validar - Consejo de Estado</a>: </label>   
<?php echo $row_update['certificado_integridad']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ASUNTO / TEMA:</label>   
<?php echo $row_update['nombre_auto_oaj']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">DOCUMENTO:</label>   
<a href="files/autos/<?php echo $row_update['url']; ?>" target="_blank"><img src="images/pdf.png"></a>


</div>


	
<?php
	mysql_free_result($select);
echo '</div>';
} else {}

?>


