<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 
$idn=intval($_POST['option']);
$query = sprintf("SELECT * FROM umarital_notaria where id_umarital_notaria=".$idn." and estado_umarital_notaria=1 limit 1");
$select = mysql_query($query, $conexion);
$rown = mysql_fetch_assoc($select);
?>
<div class="row" style="padding: 10px 15px 10px 15px;"><section>
<div class="content">
<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="control-label">Fecha de la escritura: </label> 
<input type="text" readonly  class="form-control" value="<?php  echo $rown['fecha_umarital_notaria'];  ?>">
</div>
<div class="form-group"><label class="control-label">Número de la escritura</label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['nombre_umarital_notaria'];  ?>">
 </div>
<div class="form-group"><label class="control-label">Tipo de Acto Notarial</label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['tipo_acto'];  ?>">
 </div>
<div class="form-group"><label class="control-label">Genero Sexual del Acto</label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['genero_acto'];  ?>">
 </div>
 </div>
<div class="col-md-6">
<div class="form-group"><label class="control-label">Tipo de Identificacion del Primer Otorgante </label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['tipo_doc_primer_otorgante'];  ?>">
</div>
<div class="form-group"><label class="control-label">Fecha de Nacimiento del Primer Otorgante </label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['nacim_primer_otorgante'];  ?>">
</div>
<div class="form-group"><label class="control-label">Tipo de Identificacion del Segundo Otorgante</label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['tipo_doc_segundo_otorgante'];  ?>">
</div>
<div class="form-group"><label class="control-label">Fecha de Nacimiento del Segundo Otorgante </label>
<input type="text" readonly  class="form-control" value="<?php  echo $rown['nacim_segundo_otorgante'];  ?>">
</div>

</div>
</div>
</div>  








</section></div>


<?php

mysql_free_result($select);

 } else { }?>