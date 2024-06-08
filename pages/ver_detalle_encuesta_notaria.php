<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 

$idn=intval($_POST['option']);

$query = sprintf("SELECT * FROM encuesta_notaria where id_encuesta_notaria=".$idn." and estado_encuesta_notaria=1 limit 1");
$select = mysql_query($query, $conexion);
$rown = mysql_fetch_assoc($select);

?>

<div class="row" style="padding: 10px 15px 10px 15px;"><div class="col-md-6">
<div class="form-group"><label class="control-label">AÑO Y MES QUE REPORTO: </label> 
 <input type="text" readonly  class="form-control" value="<?php  $i=explode('-', $rown['fecha']); echo $i[0].'-'.$i[1];  ?>">
</div>
<div class="form-group"><label class="control-label">Vivienda de Interés Social - VIS: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p1']; ?>"> </div>
<div class="form-group"><label class="control-label">Escrituras de Vivienda de Interés Prioritario - VIP: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p2']; ?>"> </div>
<div class="form-group"><label class="control-label">Escrituras de Vivienda de Interés Prioritario para Ahorradores - VIPA: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p3']; ?>"> </div>
<div class="form-group"><label class="control-label">Fiducias: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p6']; ?>"> </div>
<div class="form-group"><label class="control-label">Leasing: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p7']; ?>"> </div>
<div class="form-group"><label class="control-label">Contitución de Sociedades: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p8']; ?>"> </div>
<div class="form-group"><label class="control-label">Liquidación de Sociedades: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p9']; ?>"> </div>
<div class="form-group"><label class="control-label">Reforma de Sociedad Comercial: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p10']; ?>"> </div>
<div class="form-group"><label class="control-label">Matrimonios Civiles de diferente sexo: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p11']; ?>"> </div>
<div class="form-group"><label class="control-label">Matrimonios Civiles entre Personas del Mismo Sexo - SU 214 de 2016: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p12']; ?>"> </div>
<div class="form-group"><label class="control-label">Divorcios entre el mismo sexo: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p35']; ?>"> </div>
<div class="form-group"><label class="control-label">Uniones entre Personas del Mismo Sexo : </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p22']; ?>"> </div>
<div class="form-group"><label class="control-label">Divorcios entre personas de diferente sexo: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p13']; ?>"> </div>
<div class="form-group"><label class="control-label">Declaraciones de Uniones Maritales de Hecho.: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p14']; ?>"> </div>
<div class="form-group"><label class="control-label">Disoluciones de Uniones Maritales de Hecho.: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p15']; ?>"> </div>
<div class="form-group"><label class="control-label">Disoluciones y/o Liquidaciones de sociedades conyugales: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p16']; ?>"> </div>
<div class="form-group"><label class="control-label">Correcciones del Registro civil: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p17']; ?>"> </div>
</div><div class="col-md-6">
<div class="form-group"><label class="control-label">Sucesiones: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p4']; ?>"> </div>
<div class="form-group"><label class="control-label">Contratos por Arrendamientos: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p5']; ?>"> </div>
<div class="form-group"><label class="control-label">Escrituras sobre Cambios de Nombre: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p18']; ?>"> </div>
<div class="form-group"><label class="control-label">Escrituras sobre Legitimación de Hijos: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p19']; ?>"> </div>
<div class="form-group"><label class="control-label">Capitulaciones Matrimoniales: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p20']; ?>"> </div>
<div class="form-group"><label class="control-label">Actas de Comparecencia: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p23']; ?>"> </div>
<div class="form-group"><label class="control-label">Autenticaciones: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p24']; ?>"> </div>
<div class="form-group"><label class="control-label">Declaraciones Extra Juicio: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p25']; ?>"> </div>
<div class="form-group"><label class="control-label">Declaraciones de Supervivencia: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p26']; ?>"> </div>
<div class="form-group"><label class="control-label">Conciliaciones: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p27']; ?>"> </div>
<div class="form-group"><label class="control-label">Copias del Registro Civil: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p28']; ?>"> </div>
<div class="form-group"><label class="control-label">Registros Civiles de Nacimiento: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p29']; ?>"> </div>
<div class="form-group"><label class="control-label">Registros Civiles de Matrimonio: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p30']; ?>"> </div>
<div class="form-group"><label class="control-label">Registros Civiles de Defunción: </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p31']; ?>"> </div>
<div class="form-group"><label class="control-label">Escrituras Publicas sobre Corrección del componente Sexo de Masculino ( M ) a Femenino ( F ): </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p32']; ?>"> </div>
<div class="form-group"><label class="control-label">Escrituras Publicas sobre Corrección del componente Sexo de Femenino ( F) a Masculino (M): </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p33']; ?>"> </div>
<div class="form-group"><label class="control-label">Matrimonios Civiles que Involucraron a un menor de Edad : </label> <input type="text" readonly  class="form-control" value="<?php echo $rown['p34']; ?>"> </div>

</div></div>


<?php

mysql_free_result($select);

 } else { }?>