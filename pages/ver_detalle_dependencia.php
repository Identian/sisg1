<link rel="stylesheet" href="plugins/chosenselect/chosen.css">
<script src="plugins/chosenselect/chosen.js" type="text/javascript"></script>
<script type="text/javascript">
 var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Registro no encontrado!'},
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  
<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 
echo '<select  class="form-control chosen-select" style="width:100%;" name="id_dependencia" required ><option selected></option>';
$selectur = mysql_query("SELECT * FROM dependencia order by id_dependencia", $conexion);
$rowur = mysql_fetch_assoc($selectur);
do {
echo '<option value="'.$rowur['id_dependencia'].'">'.$rowur['nombre_dependencia'].' &nbsp;  &nbsp; ('.$rowur['fecha_desde'].' a '.$rowur['fecha_hasta'].') &nbsp; ('.$rowur['id_dependencia'].')</option>';
 } while ($rowur = mysql_fetch_assoc($selectur)); 
mysql_free_result($selectur);
echo '</select>';
}
?>