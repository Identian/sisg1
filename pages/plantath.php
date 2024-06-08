<?php
$nump114=privilegios(114,$_SESSION['snr']);

if (1==$_SESSION['rol']) { 

?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('plantath'); ?></h3>

              <p>Registros</p>
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
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>


	  </h3>
 </div>

</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Fecha</th>
				  <th>Funcionario</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				   <th>Cargo Titular</th>
				  <th>Cargo Actual</th>	
				  <th>Transitorio</th>	
	<th>Nivel</th>	
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

function posicionth($valorth){
global $mysqli;
$query = "SELECT nombre_posicionth from posicionth where numeroth=".$valorth." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$valth=$row['nombre_posicionth'];
} else { $valth='';}
return $valth;
$result->free();
}



$query4="SELECT * from plantath, funcionario, posicionth where posicionth.numeroth=plantath.numerothactual and plantath.id_funcionario=funcionario.id_funcionario and estado_plantath=1 ".$infop." ORDER BY id_plantath desc  "; //LIMIT 500 OFFSET ".$pagina."
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_plantath'];
echo '<td>'.$row['fecha_plantath'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}

echo '<td>';
if (isset($row['numerothtitular'])) {
	echo $row['numerothtitular'].' / ';
echo posicionth($row['numerothtitular']);
} else {}
echo '</td>';
echo '<td>'.$row['numerothactual'].' / '.$row['nombre_posicionth'].'</td>';
echo '<td>';
if (1==$row['transitorio']) {
echo 'Si';
} else { echo 'No'; }
echo '</td>';
echo '<td>'.$row['nivelth'].'</td>';
echo '<td>';
	if (1==$_SESSION['rol']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="plantath" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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


<?php if (1==$_SESSION['rol']) { ?>


 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r6534534546rtret4324324563m1"  >



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Funcionario:</label> 
<select class="form-control"  name="id_funcionario" required>
<option selected></option>
<?php
$query = sprintf("SELECT * FROM funcionario where id_tipo_oficina<3 and estado_funcionario=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
		echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>Fecha:</label> 
<input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
</div>




<div class="form-group text-left"> 
<label  class="control-label">Posicion Titular:</label> 
<select class="form-control"  name="numerothtitular">
<option selected></option>
<?php
$query = sprintf("SELECT * FROM posicionth where estado_posicionth=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
		echo '<option value="'.$row['numeroth'].'">'.$row['numeroth'].' - '.$row['nombre_posicionth'].' - '.$row['codigoth'].' - '.$row['gradoth'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Posicion Actual:</label> 
<select class="form-control"  name="numerothactual" required>
<option selected></option>
<?php
$query = sprintf("SELECT * FROM posicionth where estado_posicionth=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
		echo '<option value="'.$row['numeroth'].'">'.$row['numeroth'].' - '.$row['nombre_posicionth'].' - '.$row['codigoth'].' - '.$row['gradoth'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</select>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>

 <?php }


 } else { }


 ?>



