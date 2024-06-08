<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];

require_once('../conf.php'); 

?>
 
<div style="padding: 10px 10px 10px 10px">

<?php
echo '';
$query2 = sprintf("SELECT * FROM tipo_visita, area where tipo_visita.id_area=area.id_area and id_tipo_visita=".$id." and estado_tipo_visita=1 LIMIT 1"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);


?>

<form name="for24545435456436" method="post" action="">

 <div >
              <label class="control-label"><span style="color:#ff0000;">*</span> Area:</label><br>
   <input type="text" readonly required class="form-control" value="<?php echo $row2['nombre_area']; ?>">
            </div>
<br>



<div >
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de visita:</label>  <br>
			    <select class="form-control" name="tipo" required>
		  <option value="0" <?php if (0==$row2['tipo']) { echo 'selected'; } else {} ?>>General</option>
		    <option  value="1" <?php if (1==$row2['tipo']) { echo 'selected'; } else {} ?>>Especial</option>
			  </select>
            </div>
<br>
 <div >
              <label class="control-label"><span style="color:#ff0000;">*</span> Subtipo de visita:</label><br>
             <input type="text" class="form-control" name="nombre_tipo_visita" required value="<?php echo $row2['nombre_tipo_visita']; ?>">
            </div>
			<br>
			
			
			 <div >
              <label class="control-label"><span style="color:#ff0000;">*</span> Asunto:</label><br>
             <input type="text" class="form-control" name="auto_titulo" required value="<?php echo $row2['auto_titulo']; ?>">
            </div>
			<br>
			
			
			 <div >
              <label class="control-label"><span style="color:#ff0000;">*</span> Objeto:</label><br>
             <textarea class="form-control" name="auto_texto" style="min-height:250px;"  required><?php echo $row2['auto_texto']; ?></textarea>
            </div>
			
			<br>
			
	
	
<input type="hidden"  name="actualizar_id_tipo_visita" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-xs btn-success">Actualizar</button>

</form>	



<br>
      </div>



<?php 
mysql_free_result($select2);

} else { }

?>



