<?php
$nump154=privilegios(154,$_SESSION['snr']);

if (3>$_SESSION['snr_tipo_oficina']) { 
?>
<div class="row">
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php //echo date('y-m-d'); ?><span id="cantidad"></span></h3>

              <p>Cantidad de elementos</p>
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
              <h3>$ <span id="valor"></span></h3>

              <p>Asignación</p>
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
  
  
  
  <div class="col-md-8">
 
  
  <p>
<b>  Inventario</b>


  </p>
  
  
<?php 
if (1==$_SESSION['rol'] or 0<$nump154) {?>

<form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required="">
          <option value="" selected="">- - - Buscar por:  - - - - </option>
 		  <option value="cc">Cédula</option>
		   <option value="placa">Placa</option>
		
		  </select>
</div>
<div class="input-group-btn">
<input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required=""></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>

 <?php } else {} ?>
 
 
 
 
 
 <?php
if (1==$_SESSION['rol'] or 0<$nump154) {

if (isset($_GET['i'])) {
$varcc=$_GET['i'];
$json = file_get_contents('http://192.168.210.130:8080/wsHgfi/'.$varcc.'.json');
} else {
	
if (isset($_POST['buscar'])) {
	if ('cc'==$_POST['campo']) {
$varcc=$_POST['buscar'];
$json = file_get_contents('http://192.168.210.130:8080/wsHgfi/'.$varcc.'.json');
	} else {
$varpp=$_POST['buscar'];
$json = file_get_contents('http://192.168.210.130:8080/wsHgfiPlaca/'.$varpp.'.json');	
	}
	
} else {
	$varcc=$_SESSION['cedula_funcionario'];
$json = file_get_contents('http://192.168.210.130:8080/wsHgfi/'.$varcc.'.json');
}
	
}



} else {
	$varcc=$_SESSION['cedula_funcionario'];
$json = file_get_contents('http://192.168.210.130:8080/wsHgfi/'.$varcc.'.json');
}
?>


 
	  </div>
	  
	  
	  
	   <div class="col-md-4">
	  <a onclick="window.print();" style="cursor: pointer">Imprimir</a>
	  </div>

<?php if (isset($varpp) && ""!=$varpp) { } else {

if ($_SESSION['cedula_funcionario']==$varcc) {
?>	
<div class="col-md-6">
 <br>
 <?php
 echo 'Fecha: '.date('Y-m-d').'<br>';
echo 'Identificación: '.$_SESSION['cedula_funcionario'].'<br>';
echo 'Funcionario: '.$_SESSION['snr_nombre'].'<br>';
echo 'Cargo: '.$_SESSION['snr_grupo_cargo'].'<br>';


$_SESSION['snr']=$row1['id_funcionario'];
$_SESSION['usuariomoodle']=$row1['alias_iduca'];
$_SESSION['sesion'] = md5($row1['alias_iduca'].$row1['cedula_funcionario']);
$_SESSION['rol']=$row1['id_rol'];
$_SESSION['snr_nombre']=$row1['nombre_funcionario'];
$_SESSION['snr_correo']=$row1['correo_funcionario'];
$_SESSION['fecha_nacimiento']=$row1['fecha_nacimiento'];
$_SESSION['snr_grupo_area']=$row1['id_grupo_area'];
$_SESSION['snr_grupo_cargo']=$row1['id_cargo'];
$_SESSION['snr_lider_pqrs']=$row1['lider_pqrs'];
$_SESSION['snr_perfil_funcionario']=$row1['perfil_funcionario'];
$_SESSION['snr_tipo_oficina']=$row1['id_tipo_oficina'];

$_SESSION['vinculacion']=$row1['id_vinculacion'];
$_SESSION['id_cargo_nomina_encargo']=$row1['id_cargo_nomina_encargo'];



if (1==$row1['id_tipo_oficina']){
$_SESSION['snr_area']=$row16['id_area'];
} else if (2==$row1['id_tipo_oficina']){
$_SESSION['id_oficina_registro']=$row1['id_oficina_registro'];
} else {}



?>
 </div>
 <div class="col-md-6">
 <br>
 <?php 
$n='';
echo 'Vinculación: '.$_SESSION['vinculacion'].'<br>';
echo 'Oficina: '.$n.'<br>';
echo 'Dependencia: '.$n.'<br>';
echo 'Codigo: '.$n.'<br>';
echo 'Grado: '.$n.'<br>';

?>
 </div>

	
	<?php
} else {
	?>
 <div class="col-md-6">
 <br>
<?php 
$iduser=cualid($varcc); 
//echo $iduser;
$consulta = mysql_query("SELECT * FROM funcionario, cargo, vinculacion WHERE funcionario.id_vinculacion=vinculacion.id_vinculacion and funcionario.id_cargo=cargo.id_cargo and id_funcionario=".$iduser."  limit 1", $conexion);
$row1 = mysql_fetch_assoc($consulta);
$nn = mysql_num_rows($consulta);
if (0<$nn) {
echo 'Fecha: '.date('Y-m-d').'<br>';
echo 'Identificación: '.$row1['cedula_funcionario'].'<br>';
echo 'Funcionario: '.$row1['nombre_funcionario'].'<br>';
echo 'Cargo: '.$row1['nombre_cargo'].'<br>';

?>
</div>
 <div class="col-md-6">
 <br>
<?php 
$n='';
echo 'Vinculación: '.$row1['nombre_vinculacion'].'<br>';
echo 'Oficina: '.$n.'<br>';
echo 'Dependencia: '.$n.'<br>';
echo 'Codigo: '.$n.'<br>';
echo 'Grado: '.$n.'<br>';
}
?>
</div>
<?php 
}
}
?>


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Item</th>
		<th>Placa</th>
		<th>Clase de bien</th>
				  <th>Descripción</th>
				 	<th>Marca</th>
						<th>Modelo</th>
						<th>Serie</th>
						<th>Estado</th>
						<th>Valor</th>
						<?php if (isset($varpp) && ""!=$varpp) { ?>
						<th>Funcionario</th>
						<?php } ?>
						
<th style="width:45px;"></th>		  
</tr>
</thead>
	<tbody>
<?php 
$array=array();
$obj = json_decode($json);
$cant=count($obj);
foreach ($obj as $character) {
	echo '<tr><td>'.$character->ITEM.'</td>';
	echo '<td>'.$character->TXTPLACAINVENTARIO.'</td>';
echo '<td>'.$character->TXTCLASEBIEN.'</td>';
echo '<td>'.$character->DESCRIPCION.'</td>';
echo '<td>'.$character->TXTMARCA.'</td>';
echo '<td>'.$character->TXTMODELO.'</td>';
echo '<td>'.$character->TXTSERIE.'</td>';
echo '<td>'.$character->TXTESTADO.'</td>';
$valor=$character->MNDCOSTO;

echo '<td>'.$valor.'</td>';
array_push($array, $valor);

if (isset($varpp) && ""!=$varpp) { 

$cedu=$character->TXTIDENTIFICACIONR;
$iduser=cualid($cedu);
	echo '<td><a href="usuario&'.$iduser.'.jsp" target="_blank">'.$character->TXTNOMBRESR.'</a></td>';				
 } 
						


echo '<td>';
?>
<a style="color:#ff0000;cursor: pointer" onclick="alert('Debe escriubir a inventario@supernotariado.gov.co');" title="Actualizar" name="salalactante" ><span class="glyphicon glyphicon-edit"></span></a>
</td>  
</tr>
<?PHP } ?>

</tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			
<hr>

<?php
$val=number_format(array_sum($array));
echo '<b>Total de valores: '.$val.'</b>';

?>
<script>
document.getElementById("cantidad").innerHTML='<?php echo $cant; ?>';
document.getElementById("valor").innerHTML='<?php echo $val; ?>';
</script>
		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php

} else {} ?>



