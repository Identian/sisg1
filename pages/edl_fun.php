<?php
$nump117=privilegios(117,$_SESSION['snr']);

if (3>$_SESSION['snr_tipo_oficina']) {
	
	

if (isset($_POST["id_funcionario"]) && ""!=$_POST["id_funcionario"]) {
	
$infop=explode("-", $_POST['periodo']);
$ano_periodo=intval($infop[0]);
$id_periodos_edl=intval($infop[1]);

$query = sprintf("SELECT count(id_edl) as tevaluacion_edl FROM edl 
	where ano=".$ano_periodo." and periodo=".$id_periodos_edl." and estado_edl=1 
	and id_funcionario=".$_POST['id_funcionario'].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);

if (0<$rowt['tevaluacion_edl']) {

echo '<script type="text/javascript">swal(" ERROR !", " El funcionario ya tiene registros EDL en dicho periodo. !", "error");</script>';	


} else {

	$insertSQL = sprintf("INSERT INTO edl (
      id_funcionario, nombre_edl, comision_edl, ano, periodo, estado_edl) 
	  VALUES (%s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($_POST['id_funcionario'], "int"), 
	  GetSQLValueString($_SESSION['snr'], "text"),
	   GetSQLValueString($_POST['comision_inicial'], "int"),
	  GetSQLValueString($ano_periodo, "int"),
	  GetSQLValueString($id_periodos_edl, "int"),
	  GetSQLValueString(1, "int")); 
      $Result = mysql_query($insertSQL, $conexion);
	 
	  echo $insertado;
   }
		
} else { }

 
 
?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('edl'); ?></h3>

              <p>Edl</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>5</h3>
			  
              <p>Regionales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>195</h3>
              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">

<?php

 if (1==$_SESSION['rol'] or 0<$nump117 or 
(1==$_SESSION['snr_grupo_cargo'] && 2==$_SESSION['snr_tipo_oficina']) or 
(2==$_SESSION['snr_grupo_cargo'] && 1==$_SESSION['snr_tipo_oficina']) or 
(1==$_SESSION['snr_grupo_cargo'] && 1==$_SESSION['snr_tipo_oficina'])
) {
	

	?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
<?php } else {} ?>

  Evaluación de Desempeño Laboral &nbsp;  &nbsp;  &nbsp; 
  
   
<a href="https://supernotariadoyregistro-my.sharepoint.com/:v:/g/personal/giovanni_ortegon_supernotariado_gov_co/EZUe2ovcYolLrXNt5ftyUCcB6jUhYGApJTiKMI59V4773w?e=wFljIw&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZyIsInJlZmVycmFsQXBwUGxhdGZvcm0iOiJXZWIiLCJyZWZlcnJhbE1vZGUiOiJ2aWV3In19" target="_blank">Manual de uso</a>



	<?php 
	/*
	if (1==$_SESSION['snr_tipo_oficina']) {
echo '<a href="area&'.$_SESSION['snr_area'].'.jsp"  target="_blank">Directorio de la oficina</a>';
	} else {
echo '<a href="orip&'.$_SESSION['id_oficina_registro'].'.jsp"  target="_blank">Directorio de la oficina</a>';
} */
?> 
	 </h3>
	  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Reportado</th>
 <th>Cédula</th>
				  <th>Funcionario</th>
				  <th>Regional</th>
				 <th>Oficina</th>
				  <th>Vinculación</th>
				<!--  <th>Regional</th>-->
				  <th>Oficina / grupo</th>
				
				  <th>Periodo</th>
			
				  
<!--<th>Info</th>	-->

<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

function eeeeevaluador($idevaluador) {
global $mysqli;
$query4hj = sprintf("SELECT count(edl.id_edl) as cuentaf from edl where  
(id_funcionario=".$idevaluador." or nombre_edl=".$idevaluador.") 
 and estado_edl=1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
$reshhj=intval($row4hj['cuentaf']);
} else {
$reshhj=0;
}
return $reshhj;
$result4hj->free();
}





if (1==$_SESSION['rol'] or 0<$nump117) {
$query4="SELECT * from edl, vinculacion, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and funcionario.id_vinculacion=vinculacion.id_vinculacion and edl.id_funcionario=funcionario.id_funcionario and estado_edl=1 ORDER BY id_edl desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
	
	
//$cuentaeva=evaluador($_SESSION['snr']);
if (0<$cuentaeva or 1==1) {

 $query4="SELECT * from vinculacion, funcionario, grupo_area, edl  
where funcionario.id_grupo_area=grupo_area.id_grupo_area and 
funcionario.id_vinculacion=vinculacion.id_vinculacion and 
 edl.id_funcionario=funcionario.id_funcionario and 
( edl.id_funcionario=".$_SESSION['snr']." or edl.nombre_edl=".$_SESSION['snr']." or edl.comision_edl=".$_SESSION['snr'].") 
 and estado_edl=1 group by edl.id_edl  ORDER BY id_edl desc  "; 
 
 
} else {
	
$query4="SELECT * from vinculacion, funcionario, grupo_area, edl, concertacion_edl    
WHERE 
edl.id_edl=concertacion_edl.id_edl AND 
funcionario.id_grupo_area=grupo_area.id_grupo_area and 
funcionario.id_vinculacion=vinculacion.id_vinculacion and 
 edl.id_funcionario=funcionario.id_funcionario and 
( edl.id_funcionario=".$_SESSION['snr']." or edl.nombre_edl=".$_SESSION['snr']." 
OR concertacion_edl.id_evaluador=".$_SESSION['snr']." OR 
concertacion_edl.id_comision=".$_SESSION['snr'].") 
 and estado_edl=1 group by edl.id_edl ORDER BY edl.id_edl desc  ";


}


 }
 
 
// echo $query4;
$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
<?php
$id_res=$row['id_edl'];
echo '<td>'.$row['fecha_edl'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}


echo '<td>'.$row['nombre_vinculacion'].'</td>';
echo '<td>'.$row['nombre_grupo_area'].'</td>';

/*
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}
*/



echo '<td>';
$vari= $row['ano'].'-'.$row['periodo'];
echo $vari;
echo '</td>';



/*
echo '<td>';
if ('2023-1'==$vari) {
	echo '<span style="color:#B40404">Calificar</span>';
} else {}
echo '</td>';
*/


echo '<td>';

echo ' <a href="consulta_edl&'.$id_res.'.jsp"><span class="fa fa-file"></span></a> ';

if (1==$_SESSION['rol'] or 0<$nump117) { //
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="edl" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
echo '</td>';
?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">SOLO PUEDE SER DILIGENCIADO POR JEFES O COORDINADORES</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65345345464324324563m1" enctype="multipart/form-data" >

<?php if (0<$nump117) { //1==$_SESSION['rol'] or 
?>

		  <div class="form-group text-left"> 
                       <label  class="control-label">Evaluador:</label> 
<select class="form-control" name="id_funcionario_jefe_inme" required >
<option selected></option>
	<?php
$select = mysql_query("select id_funcionario, nombre_funcionario from funcionario where id_cargo<3 and id_tipo_oficina<3 order by nombre_funcionario ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	echo '>'.$row['nombre_funcionario'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 
mysql_free_result($select);
			?>
</select>					   
					   </div>
					   
					   
                    <div class="form-group text-left"> 
                       <label  class="control-label">Comision:</label>   
<select class="form-control" name="id_funcionario_jefe_area" required >
<option selected></option>
<option value="2319">No requiere comisión</option>
	<?php
$select = mysql_query("select id_funcionario, nombre_funcionario from funcionario where id_cargo=1 and id_tipo_oficina<3 order by nombre_funcionario", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	echo '>'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
			?>
</select>
</div>


<div class="form-group text-left"> 
                       <label  class="control-label">Evaluado:</label>   
<select class="form-control" name="id_funcionario" required >
<option selected></option>
	<?php
$select = mysql_query("select id_funcionario, nombre_funcionario from funcionario where id_tipo_oficina<3 and id_vinculacion in (2, 3, 4) order by nombre_funcionario", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	echo '>'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
			?>
</select>
</div>


<?php } else { ?> 


<div class="form-group text-left"> 
<label  class="control-label">Nombre del evaluador:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
<input type="hidden" name="id_funcionario_jefe_inme" value="<?php echo $_SESSION['snr']; ?>">
</div>




 <div class="form-group text-left"> 
<label  class="control-label">Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Perfil:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>


 <div class="form-group text-left"> 
<label  class="control-label">Cargo:</label> 
<input type="text" class="form-control" readonly value="<?php echo cargo($_SESSION['id_cargo_nomina_encargo']); ?>">
</div>



 <div class="form-group text-left"> 
<label  class="control-label">Oficina:</label> 
<input type="text" class="form-control" readonly value="
<?php 
if (1==$_SESSION['snr_tipo_oficina']) {
echo ''.quees('area',$_SESSION['snr_area']).' / ';
echo ''.quees('grupo_area',$_SESSION['snr_grupo_area']).'';
} else {
echo ''.regional($_SESSION['id_oficina_registro']).' / ';
echo ''.quees('oficina_registro',$_SESSION['id_oficina_registro']).'';	
echo ' / '.quees('grupo_area',$_SESSION['snr_grupo_area']).'';
} 

?>
">
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Comision evaluadora:</label>   
<select class="form-control" name="comision_inicial" required >
<option selected></option>
<!--<option value="2319">No requiere comisión</option>-->
	<?php
$select = mysql_query("select id_funcionario, nombre_funcionario from funcionario where id_cargo=1 and (alias_iduca is not null or alias_iduca!='')  and id_tipo_oficina=1 order by nombre_funcionario", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	echo '>'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
			?>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Evaluado:</label> 
<select class="form-control"  name="id_funcionario" required  >
<option selected></option>

	<?php
if (1==$_SESSION['snr_tipo_oficina']) {	
	
if (1==$_SESSION['snr_grupo_cargo']) {
		
$actualizar5 = mysql_query("SELECT * FROM funcionario, grupo_area WHERE 
funcionario.id_grupo_area=grupo_area.id_grupo_area and id_area=".$_SESSION['snr_area']." 
 and (id_vinculacion=3 or id_vinculacion=4) 
and id_tipo_oficina<3 and id_funcionario!=".$_SESSION['snr']." 
and estado_funcionario=1 order by id_cargo_nomina_encargo", $conexion);
	
		} else {
$actualizar5 = mysql_query("SELECT * FROM funcionario WHERE 
id_grupo_area=".$_SESSION['snr_grupo_area']." and (id_vinculacion=3 or id_vinculacion=4) 
and id_tipo_oficina<3 and id_funcionario!=".$_SESSION['snr']." 
and id_cargo_nomina_encargo>=".$_SESSION['id_cargo_nomina_encargo']." 
and estado_funcionario=1 order by id_cargo_nomina_encargo", $conexion);
		}
	
	
	} else {
$actualizar5 = mysql_query("SELECT * FROM funcionario WHERE 
 id_oficina_registro=".$_SESSION['id_oficina_registro']." 
 and (id_vinculacion=3 or id_vinculacion=4) 
and id_tipo_oficina<3 and id_funcionario!=".$_SESSION['snr']." 
and estado_funcionario=1 order by id_cargo_nomina_encargo", $conexion);	
	}
	

$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

if (0<$total55) {
 do {
   echo '<option value="'.$row15['id_funcionario'].'" ';
   echo '>'.$row15['nombre_funcionario'].'  ';
   echo '</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>


</select>

</div>

<?php } ?>

 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Periodo:</label> 
<select class="form-control periodoedl"  name="periodo" required>
<option selected></option>
<option value="2023-1">2023-1</option>
<option value="2023-2">2023-2</option>
<option value="2024-1">2024-1</option>
</select>
</div>
 
 
 






<?php 
if (""!=$avison) {
echo $avison; 
} else { ?>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>
<?php } ?>
</form>


      </div>
    </div>
  </div>
</div>





<div class="modal fade bd-example-modal-lg" id="popuprevisionedl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>REVISIÓN</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestarevisionedl" class="modal-body">

   </div>
    </div>
  </div>
</div>

<?php


















$query9 = "SELECT  concertacion_edl.id_concertacion_edl, id_compromiso_edl FROM compromiso_edl, concertacion_edl WHERE compromiso_edl.id_concertacion_edl= concertacion_edl.id_concertacion_edl AND aceptado IS NULL 
AND estado_compromiso_edl=1 AND nombre_concertacion_edl<'2024-01-31'";
$result9 = $mysqli->query($query9);
while ($obj = $result9->fetch_array()) {
$concert=intval($obj['id_concertacion_edl']);
$comp=intval($obj['id_compromiso_edl']);


$query888 = "UPDATE concertacion_edl SET acep_auto=1 WHERE id_concertacion_edl=".$concert." limit 1";  
$result44 = $mysqli->query($query888);

$query889 = "UPDATE compromiso_edl SET aceptado=1 WHERE id_compromiso_edl=".$comp." limit 1";  
$result449 = $mysqli->query($query889);

    }
$result9->free();







} else {} ?>



