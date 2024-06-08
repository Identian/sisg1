<div class="row">
        <div class="col-md-3">
		
		<a href="tipificacion_pqrs.jsp">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-save"></i></span>

            <div class="info-box-content">
              <span>Tipificación PQRS</span>
			  <span class="info-box-number"><?php echo existencia('clase_oac'); ?> clases</span>
              
			 
            </div>
         
          </div>
    </a>
        </div>

       
    
       

     <div class="col-md-3">
		<a href="pqrs_area.jsp">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-floppy-disk"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS por areas N.C.</span>
			  
			  <span class="info-box-number"><?php 
			  
$reghtpo = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=1 and estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
//$rowcco = mysql_fetch_assoc($reghtpo);
$totuu = mysql_num_rows($reghtpo );
echo $totuu;	
			  
			 ?></span>
			  
              
            </div>
          
          </div>
      </a>
        </div>
    
        <div class="col-md-3">
		<a href="mapa_calor.jsp">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-inbox"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS por ORIP y Región</span>
	
			 <span class="info-box-number"> <?php 
			 
			 $reghtpoH = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=2 and estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
//$rowcco = mysql_fetch_assoc($reghtpo);
$totuuH = mysql_num_rows($reghtpoH );
echo $totuuH;

			 ?></span>
              
            </div>
        
          </div>
     </a>
        </div>
		
		
   
        <div class="col-md-3">
		<a href="xls/pqrs_retornadas.xls">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-hdd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS retornadas</span>
			  <span class="info-box-number"><?php echo existencia('retorno_pqrs');?></span>
              <span class="info-box-number"><img src="images/excel.png"></span>
            </div>
        
          </div>
   </a>
        </div>
 
		
		
       
		
      </div>
	  

<div class="row">
<div class="col-md-12">          
  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>TIPIFICACIÓN DE PQRS</h3>

			<div style="text-align:right">
			
			<a href="xls/tipos_pqrs.xls">Reporte completo <img src="images/excel.png"></a>
			<br>
			
			<a href="xls/tipologia_pqrs.xls">Tipologias de PQRS <img src="images/excel.png"></a>
			</div>  
				  

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

<form action="xls/tipos_pqrs.xls" method="POST" name="for5tfgfdggmgjht1">
<div class="row">
<div class="col-md-2"> 
<b>Rango de fechas:</b>
</div>
<div class="col-md-2"> 
<input type="text" class="form-control datepicker" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly" >
</div>
<div class="col-md-2"> 
<input type="test"  class="form-control datepicker" name="fecha_hasta" required placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-2"> 
<button type="submit" class="btn btn-success">
Descargar</button>
</div>

<div class="col-md-4"> 

</div>


</div>
</form>
Categoria / Clase / Motivo / Asunto
<hr>

	<?php
ini_set('max_execution_time', 10000000);

$actualizar579pb = mysql_query("SELECT count(id_solicitud_pqrs) as tot FROM solicitud_pqrs where estado_solicitud_pqrs=1 ", $conexion) or die(mysql_error());
$row1579pb = mysql_fetch_assoc($actualizar579pb);
$tot=$row1579pb['tot'];


echo '<ol>';
$actualizar579p = mysql_query("SELECT id_categoria_oac, nombre_categoria_oac FROM categoria_oac where estado_categoria_oac=1 ", $conexion) or die(mysql_error());
$row1579p = mysql_fetch_assoc($actualizar579p);
 do { 
echo '<li title="'.$row1579p['id_categoria_oac'].'">'.$row1579p['nombre_categoria_oac'].'';
$categoria=intval($row1579p['id_categoria_oac']);
$infoc=existenciaunica('clasificacion_pqrs', 'id_categoria_oac', $categoria);
$infoc2=($infoc*100)/$tot;
echo ' <i class="label label-success"> Total: '.$infoc.' </i><i class="label label-warning"> '.round($infoc2,1).'% </i>';
echo '</li>';


$actualizar579m = mysql_query("SELECT id_clase_oac, nombre_clase_oac, terminos_dias FROM clase_oac where id_categoria_oac=".$categoria." and estado_clase_oac=1 ", $conexion) or die(mysql_error());
$row1579m = mysql_fetch_assoc($actualizar579m);
echo '<ol class="a">';
 do { 
echo '<li title="'.$row1579m['id_clase_oac'].'">'.$row1579m['nombre_clase_oac'].' <span style="color:#337AB7">(Terminos en dias: '.$row1579m['terminos_dias'].')</span>';
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
echo '<li title="'.$row1579n['id_tema_oac'].'">'.$row1579n['nombre_tema_oac'].'';
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
echo '<li title="'.$row1579k['id_motivo_oac'].'" >'.$row1579k['nombre_motivo_oac'].'';

$motivo=intval($row1579k['id_motivo_oac']);
$infom=existenciamotivo('clasificacion_pqrs', 'id_motivo_oac', $motivo);
$infom2=($infom*100)/$tot;
echo ' <i class="label label-success"> Total: '.$infom.' </i><i class="label label-warning"> '.round($infom,1).'% </i>';
echo '</li>';

 } while ($row1579k = mysql_fetch_assoc($actualizar579k)); 
  mysql_free_result($actualizar579k);
  
$actualizar579nr = mysql_query("SELECT count(id_clasificacion_pqrs) as toittu FROM clasificacion_pqrs where id_tema_oac=".$tema." and id_motivo_oac=0 and estado_clasificacion_pqrs=1 ", $conexion) or die(mysql_error());
$row1579nr = mysql_fetch_assoc($actualizar579nr);
echo '<li title="0">Sin asunto clasificado: <i class="label label-success"> Total: '.$row1579nr['toittu'].' </i> </li>';



  echo '</ol>';
}


 } while ($row1579n = mysql_fetch_assoc($actualizar579n)); 
  mysql_free_result($actualizar579n);
  
  
$actualizar579nr = mysql_query("SELECT count(id_clasificacion_pqrs) as toitt FROM clasificacion_pqrs where id_clase_oac=".$clase." and id_tema_oac=0 and estado_clasificacion_pqrs=1 ", $conexion) or die(mysql_error());
$row1579nr = mysql_fetch_assoc($actualizar579nr);
echo '<li title="0">Sin motivo clasificado: <i class="label label-success"> Total: '.$row1579nr['toitt'].' </i> </li>';

  
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




