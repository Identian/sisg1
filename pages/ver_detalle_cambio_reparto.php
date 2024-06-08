<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=intval($_POST['option']);
require_once('../conf.php'); 
?>
 
<div style="padding: 10px 10px 10px 10px">
<form action="" method="post" name="ewrewr">
<div class="form-group text-left"> 
<label  class="control-label">Acción:</label> 
<select name="tipo_accion" class="form-control" required>
<option></option>
<option value="1">Anulación</option>
<option value="2">Restitución de turno</option>
<option value="3">Corrección</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label">Número de resolución:</label> 
<input type="number" name="nresolucion" class="form-control numero" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Año de resolución:</label> 
<select name="anoresolucion" class="form-control" required>
<option></option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
</select>
</div>






<div class="form-group text-left"> 
<label  class="control-label">Descripción:</label><br> 
<textarea name="descripcion_accion" style="width:100%"></textarea>
</div>



<div class="modal-footer">
<input type="hidden" name="reparto_proyectoid" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-success"> Modificar </button>
</div>
</form>


</div>

<?php
} else {}
?>


