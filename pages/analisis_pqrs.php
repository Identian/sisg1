<div class="row">
<div class="col-md-12">          
  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>TIPIFICACIÓN DE PQRS</h3>

 <!-- <div class="panel-heading">
  <b>TIPIFICACIÓN DE PQRS
  </b></div>
  -->

  <HR>
  
  
<div class="panel-body">
 <style>
ol.main > li {
    counter-increment: root;
}

ol.main > li > ol {
    counter-reset: subsection;
    list-style-type: none;
}

ol.main > li > ol > li {
    counter-increment: subsection;
}

ol.main > li > ol > li:before {
    content: counter(root) "." counter(subsection) " ";
}

ol.a {list-style-type:upper-alpha;}
ol.b {list-style-type:lower-alpha;}
ol.c {list-style-type:lower-roman;}

.glyphicon-signal{color:#6699ff;}
.cant{color:#ff0033;}
.porc{color:#6699ff;}



</style>
	<?php
ini_set('max_execution_time', 10000000);

$actualizar579pb = mysql_query("SELECT count(id_solicitud_pqrs) as tot FROM solicitud_pqrs where estado_solicitud_pqrs=1 ", $conexion) or die(mysql_error());
$row1579pb = mysql_fetch_assoc($actualizar579pb);
$tot=$row1579pb['tot'];


echo '<ol>';
$actualizar579p = mysql_query("SELECT id_categoria_oac, nombre_categoria_oac FROM categoria_oac where estado_categoria_oac=1 ", $conexion) or die(mysql_error());
$row1579p = mysql_fetch_assoc($actualizar579p);
 do { 
echo '<li>'.$row1579p['nombre_categoria_oac'].'';
$categoria=intval($row1579p['id_categoria_oac']);
$infoc=existenciaunica('clasificacion_pqrs', 'id_categoria_oac', $categoria);
$infoc2=($infoc*100)/$tot;
echo ' <i class="label label-success"> Total: '.$infoc.' </i><i class="label label-warning"> '.round($infoc2,1).'% </i>';
echo '</li>';


$actualizar579m = mysql_query("SELECT id_clase_oac, nombre_clase_oac, terminos_dias FROM clase_oac where id_categoria_oac=".$categoria." and estado_clase_oac=1 ", $conexion) or die(mysql_error());
$row1579m = mysql_fetch_assoc($actualizar579m);
echo '<ol class="a">';
 do { 
echo '<li>'.$row1579m['nombre_clase_oac'].' <span style="color:#337AB7">(Terminos en dias: '.$row1579m['terminos_dias'].')</span>';
$clase=intval($row1579m['id_clase_oac']);
$infocl=existenciaunica('clasificacion_pqrs', 'id_clase_oac', $clase);
$infocl2=($infocl*100)/$tot;
echo ' <i class="label label-success"> Total: '.$infocl.' </i><i class="label label-warning"> '.round($infocl2,1).'% </i>';
echo '</li>';



$actualizar579n = mysql_query("SELECT id_tema_oac, nombre_tema_oac FROM tema_oac where id_clase_oac=".$clase." and estado_tema_oac=1 ", $conexion) or die(mysql_error());
$row1579n = mysql_fetch_assoc($actualizar579n);
$totalRowsn = mysql_num_rows($actualizar579n);
if (0<$totalRowsn){
echo '<ol class="b">';
 do { 
echo '<li>'.$row1579n['nombre_tema_oac'].'';
$tema=intval($row1579n['id_tema_oac']);
$infot=existenciaunica('clasificacion_pqrs', 'id_tema_oac', $tema);
$infot2=($infot*100)/$tot;
echo ' <i class="label label-success"> Total: '.$infot.' </i><i class="label label-warning"> '.round($infot2,1).'% </i>';
echo '</li>';


$actualizar579k = mysql_query("SELECT id_motivo_oac, nombre_motivo_oac FROM motivo_oac where id_tema_oac=".$tema." and estado_motivo_oac=1", $conexion) or die(mysql_error());
$row1579k = mysql_fetch_assoc($actualizar579k);
$totalRowsk = mysql_num_rows($actualizar579k);
if (0<$totalRowsk){
echo '<ol class="c">';
 do { 
echo '<li>'.$row1579k['nombre_motivo_oac'].'';
$motivo=intval($row1579k['nombre_motivo_oac']);
$infom=existenciamotivo('clasificacion_pqrs', 'id_motivo_oac', $motivo);
$infom2=($infom*100)/$tot;
echo ' <i class="label label-success"> Total: '.$infom.' </i><i class="label label-warning"> '.round($infom,1).'% </i>';
echo '</li>';


 } while ($row1579k = mysql_fetch_assoc($actualizar579k)); 
  mysql_free_result($actualizar579k);
  echo '</ol>';
}


 } while ($row1579n = mysql_fetch_assoc($actualizar579n)); 
  mysql_free_result($actualizar579n);
    echo '</ol>';
}


 } while ($row1579m = mysql_fetch_assoc($actualizar579m)); 
  mysql_free_result($actualizar579m);
    echo '</ol>';
  



 } while ($row1579p = mysql_fetch_assoc($actualizar579p)); 
  mysql_free_result($actualizar579p);

echo '</ol>';

?>
</div>
</div>
</div>
</div>
</div>


</div>

