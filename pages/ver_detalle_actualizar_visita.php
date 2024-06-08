<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];

require_once('../conf.php'); 

?>
 
<div style="padding: 10px 10px 10px 10px">

<?php
echo '';
$query2 = sprintf("SELECT * FROM plantilla_visita where id_plantilla_visita=".$id." and estado_plantilla_visita=1 LIMIT 1"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);


?>

<form class="navbar-form" name="for245435456436" method="post" action="">


              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre de la sección:</label>
			  <br>
              <input type="text" class="form-control" style="width:100%" name="nombre_plantilla_visita" value="<?php echo $row2['nombre_plantilla_visita']; ?>">
      
<br>

              <label class="control-label"><span style="color:#ff0000;">*</span> Orden:</label>
              <select class="form-control" name="orden" >
			  <option><?php echo $row2['orden']; ?></option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			   <option>6</option>
			    <option>7</option>
				 <option>8</option>
				  <option>9</option>
				   <option>10</option>
				    <option>11</option>
					 <option>12</option>
					  <option>13</option>
					   <option>14</option>
					    <option>15</option>

			  </select>
          
			<br><br>
	
<input type="hidden"  name="actualizar_id_plantilla_visita" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-xs btn-success">Actualizar</button>

</form>	



<br>
      </div>



<?php 
mysql_free_result($select2);

} else { }

?>



