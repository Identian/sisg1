<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];
?>
 
<div style="padding: 10px 10px 10px 10px">


<br>


<form class="" name="for245456436" method="post" action="">
 <label class="control-label"><span style="color:#ff0000;">*</span> Nombre del anexo:</label>
<input type="text" class="form-control" style="width:100%" required name="nombre_soporte_visita" value="">
<input type="hidden"  name="soporte_id_plantilla_visita" value="<?php echo $id; ?>">
<br><br>
<button type="submit" class="btn btn-xs btn-success">Enviar</button>
</form>	

<br>
      </div>


<?php 

} else { }

?>



