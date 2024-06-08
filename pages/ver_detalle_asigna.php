<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$asigna=intval($_POST['option']);

$nump25=privilegios(25,$_SESSION['snr']);
$nump26=privilegios(26,$_SESSION['snr']);
$nump27=privilegios(27,$_SESSION['snr']);
$nump28=privilegios(28,$_SESSION['snr']);
$nump29=privilegios(29,$_SESSION['snr']);
$nump30=privilegios(30,$_SESSION['snr']);
$nump158=privilegios(158,$_SESSION['snr']);


$query = sprintf("SELECT * FROM correspondencia where id_correspondencia=".$asigna." and estado_correspondencia=1 limit 1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
?>
<div style="margin:5px 20px 20px 10px;padding:5px 20px 20px 10px;">
	<b>Radicado</b>: <?php echo $row['nombre_correspondencia']; ?><br>
	<b>Referencia</b>: <?php echo $row['referencia']; ?><br>
	<b>Asunto</b>: <?php echo $row['asunto_correspondencia']; ?><br>
	<b>Creado</b>: <?php echo $row['fecha_correspondencia']; ?>



<br><center><b>Asignaciones</b></center>



<?php if (0<$nump25 or 1==$_SESSION['rol']) {?>
<script>
function toggleCheckbox(element)
 {
  if (element.checked==true) {
	document.getElementById("radmasivos").style='display:display;width:550px;height:220px;';
	document.getElementById("presupuestomasivo").style='display:display;';
 document.getElementById("presupuesto").style='display:none;';
  } else {
	  document.getElementById("radmasivos").style='display:none;';
	   document.getElementById("presupuestomasivo").style='display:none;';
	   document.getElementById("presupuesto").style='display:display;';
	  document.getElementById("multiplemasivo").value='0';
  }
 }
 
</script>
<br>
<form action="" method="post" name="43554345345435">
<div class="row">
			<div class="col-md-12"><b>
			<input type="checkbox" id="4353455345" onchange="toggleCheckbox(this)"> Masiva</b></div>
			</div>
		<div class="row" id="radmasivos" style="display:none;">
	
			<div class="col-md-12">
<select id="multiplemasivo" name="radicadosm[]" multiple style="width:550px;height:220px;" >
	<?php
	$queryop = sprintf("SELECT * FROM correspondencia where id_tipo_correspondencia=305 and estado_correspondencia=1 ORDER BY id_correspondencia desc");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_correspondencia']; ?>" title="<?php echo $rowop['fecha_correspondencia']; ?>"><?php echo $rowop['nombre_correspondencia']; ?> - <?php echo $rowop['asunto_correspondencia']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					
?>
</select>
<br>
</div>
</div>
<div class="row" id="presupuestomasivo" style="display:none;">
			<div class="col-md-4"><b>Presupuesto masivo a:</b></div>
			<div class="col-md-5">
				<select name="id_fun_presupuestom">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=25 OR id_perfil=26)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-xs btn-warning" >Asignar masivamente</button> 
			
			</div>
			<hr>
		</div>
	</form>
	
	
		
			<?php
} else {}
?>


<?php
if (0<$nump25 OR 1==$_SESSION['rol']) { ?>
		
		<div class="row" id="presupuesto">
			<form action="" method="post" name="435435">

		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">
		
		
			<div class="col-md-4"><b>Asignar presupuesto a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_presupuesto">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=25 OR id_perfil=26)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-xs btn-success" name="AsignarFunPresupuesto" value="1">Asignar</button> 
			</div>
			</form>
		</div>
	
<?php } else {} if (0<$nump27 OR 1==$_SESSION['rol']) { ?>

		

		<div class="row" >
		<form action="" method="post" name="43gfhg5435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">
			<div class="col-md-4"><b>Asignar Contabilidad a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_contabilidad">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=27 OR id_perfil=28)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-xs btn-success" name="AsignarFunContabilidad" value="1">Asignar</button> 
			</div>
			</form>
		</div>
	
<?php } else {} if (0<$nump29 OR 1==$_SESSION['rol']) { ?>
		
		<div class="row" >
		<form action="" method="post" name="434335435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">

			<div class="col-md-4"><b>Asignar Tesoreria a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_tesoreria">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=29 OR id_perfil=30)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-xs btn-success" name="AsignarFunTesoreria" value="1">Asignar</button> 
			</div>
			</form>
		</div>

	

<?php
	}
	?>
		<hr><b>Presupuesto</b>: <?php if (isset($row['id_fun_presupuesto'])) { echo quees('funcionario', $row['id_fun_presupuesto']);	} else { echo 'No tiene asignación'; } ?><br>
	<b>Contabilidad</b>: <?php if (isset($row['id_fun_contabilidad'])) { echo quees('funcionario', $row['id_fun_contabilidad']);	} else { echo 'No tiene asignación';  } ?><br>
	<b>Tesoreria</b>: <?php if (isset($row['id_fun_tesoreria'])) { echo quees('funcionario', $row['id_fun_tesoreria']);	} else { echo 'No tiene asignación'; } ?><br>


<?php if (1==$_SESSION['rol'] or 0<$nump25 or 0<$nump158) { ?>
<br>
<form action="" method="post" name="43g3234324fhg5435">
	<button type="submit" class="btn btn-xs btn-danger" name="archivar" value="<?php echo $row['id_correspondencia']; ?>">Archivar / Borrar</button> 
</form>
<?php	} else {  } ?>

<br>
<?php
	mysql_free_result($select);
}
?>
</div>