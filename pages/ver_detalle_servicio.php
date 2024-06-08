<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$servicio=intval($_POST['option']);

$nump44=privilegios(44,$_SESSION['snr']);
$nump47=privilegios(47,$_SESSION['snr']);
$nump45=privilegios(45,$_SESSION['snr']);
$nump48=privilegios(48,$_SESSION['snr']);
$nump46=privilegios(46,$_SESSION['snr']);
$nump49=privilegios(49,$_SESSION['snr']);

	
$query = sprintf("SELECT * FROM correspondencia where id_correspondencia=".$servicio." and estado_correspondencia=1 limit 1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
?>
<div style="margin:5px 20px 20px 10px;padding:5px 20px 20px 10px;">
	<b>Radicado</b>: <?php echo $row['nombre_correspondencia']; ?><br>
	<b>Referencia</b>: <?php echo $row['referencia']; ?><br>
	<b>Asunto</b>: <?php echo $row['asunto_correspondencia']; ?><br>
	<b>Creado</b>: <?php echo $row['fecha_correspondencia']; ?>

<br><center>
<b>Asignaciones</b></center><br>


<?php
if (0<$nump44 OR 1==$_SESSION['rol']) { ?>
	<form action="" method="post" name="435435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">
		<div class="row">
			<div class="col-md-4"><b>Asignar presupuesto a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_presupuesto">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=44 or id_perfil=47)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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
		</div>
	</form>
<?php } else {} if (0<$nump45 OR 1==$_SESSION['rol']) { ?>
		<form action="" method="post" name="43gfhg5435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">

		<div class="row" >
			<div class="col-md-4"><b>Asignar Contabilidad a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_contabilidad">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=45 or id_perfil=48)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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
		</div>
	</form>
<?php } else {} if (0<$nump46 OR 1==$_SESSION['rol']) { ?>
		<form action="" method="post" name="434335435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">

		<div class="row" >
			<div class="col-md-4"><b>Asignar Tesoreria a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_tesoreria">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=46  or id_perfil=49)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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
		</div>
	</form>
	
	
	
	
	
	

<?php
	}
	?>
	<hr>
	<b>Presupuesto</b>: <?php if (isset($row['id_fun_presupuesto'])) { echo quees('funcionario', $row['id_fun_presupuesto']);	} else { echo 'No tiene asignación'; } ?><br>
	<b>Contabilidad</b>: <?php if (isset($row['id_fun_contabilidad'])) { echo quees('funcionario', $row['id_fun_contabilidad']);	} else { echo 'No tiene asignación';  } ?><br>
	<b>Tesoreria</b>: <?php if (isset($row['id_fun_tesoreria'])) { echo quees('funcionario', $row['id_fun_tesoreria']);	} else { echo 'No tiene asignación'; } ?><br>


<?php
	mysql_free_result($select);
}
?>
</div>