<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$ed=$_POST['option'];
require_once('../conf.php'); 

$queryop = sprintf("SELECT * FROM banner_portal where id_banner_portal=".$ed."");
$selectop = mysql_query($queryop, $conexion);
$row_update = mysql_fetch_assoc($selectop);
?>
<div style="padding: 10px 10px 10px 10px">
<form action="" method="POST" name="forerwerm1">
<div class="form-group text-left"> 
<label  class="control-label">ORDEN:</label>   
<input  class="form-control numero" name="orden" required value="<?php echo $row_update['orden']; ?>">

</div>
<div class="form-group text-left"> 
<label  class="control-label">PUBLICADO:</label>   
<br /><input type="radio" name="publicado"  value="1" <?php if (1==$row_update['publicado']) { echo 'checked'; } else {} ?>> SI       
<input type="radio"  name="publicado"  value="0" <?php if (0==$row_update['publicado']) { echo 'checked'; } else {} ?>> NO
</div>


<div class="form-group text-left"> 
<label  class="control-label">PRIMERO:</label>   
<br /><input type="radio" name="activo"  value="1" <?php if (1==$row_update['activo']) { echo 'checked'; } else {} ?>> SI       
<input type="radio"  name="activo"  value="0" <?php if (0==$row_update['activo']) { echo 'checked'; } else {} ?>> NO
</div>


<div class="form-group text-left"> 
<label  class="control-label">ENLACE:</label>   
<input type="text" class="form-control" name="enlace" value="<?php echo htmlentities($row_update['enlace'], ENT_COMPAT, ''); ?>">
</div>


<div class="form-group text-left">
<center>
<img src="files/portal/<?php echo $row_update['nombre_banner_portal']; ?>" style="width:60%;">
</center>
</div>


<div class="modal-footer">
<input type="hidden" name="banner" value="<?php echo $ed; ?>">

<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Actualizar</button>
</div>

</form>








<?php 
mysql_free_result($selectop);
?>
</div>

<?php } else {} ?>