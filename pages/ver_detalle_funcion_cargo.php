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
echo '<select  class="form-control chosen-select" style="width:100%;" name="id_funcion_cargo" required ><option selected></option>';

$selectut = mysql_query("SELECT id_funcion_cargo, nombre_dependencia, codigodep, funcion_ano,  nombre_cargo_nomina, cod_cargo_nomina, grado_cargo_nomina  
FROM funcion_cargo, dependencia, cargo_nomina WHERE funcion_cargo.id_cargo_nomina= cargo_nomina.id_cargo_nomina AND estado_funcion_cargo=1 
AND funcion_cargo.codigodep=dependencia.codigo 
 ORDER BY funcion_ano, cod_cargo_nomina, grado_cargo_nomina", $conexion);
$rowut = mysql_fetch_assoc($selectut);
$totalRowsut = mysql_num_rows($selectut);
do {
echo '<option value="'.$rowut['id_funcion_cargo'].'-'.$rowut['codigodep'].'">'.$rowut['nombre_dependencia'].' ('.$rowut['codigodep'].') "'.$rowut['funcion_ano'].'"  ('.$rowut['nombre_cargo_nomina'].' - '.$rowut['cod_cargo_nomina'].'-'.$rowut['grado_cargo_nomina'].')</option>';
 } while ($rowut = mysql_fetch_assoc($selectut)); 
mysql_free_result($selectut);
echo '</select>';
}
?>
