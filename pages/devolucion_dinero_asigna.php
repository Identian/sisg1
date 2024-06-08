<?php
session_start();
if (isset($_POST['option']) and "" != $_POST['option']) {
	require_once('../conf.php');
	require_once('listas.php');
	$asigna = intval($_POST['option']);

	$nump57 = privilegios(57, $_SESSION['snr']);
	$nump59 = privilegios(59, $_SESSION['snr']);
	$nump58 = privilegios(58, $_SESSION['snr']);
	$nump60 = privilegios(60, $_SESSION['snr']);
	$nump56 = privilegios(56, $_SESSION['snr']);
	$nump61 = privilegios(61, $_SESSION['snr']);



	$query = sprintf("SELECT * FROM devolucion_dinero where id_devolucion_dinero=" . $asigna . " and estado_devolucion_dinero=1 limit 1");
	$select = mysql_query($query, $conexion) or die(mysql_error());
	$row = mysql_fetch_assoc($select); ?>
	<div style="margin:5px 20px 20px 10px;padding:5px 20px 20px 10px;">
		<b>Radicado</b>: <?php echo $row['nombre_devolucion_dinero']; ?><br>
		<b>Referencia</b>: <?php echo $row['referencia']; ?><br>
		<b>Asunto</b>: <?php echo $row['asunto_correspondencia']; ?><br>
		<b>Creado</b>: <?php echo $row['fecha_correspondencia']; ?>



		<br>
		<center><b>Asignaciones</b></center>

		<?php if (0 < $nump57 or 1 == $_SESSION['rol']) { ?>
			<script>
				function toggleCheckbox(element) {
					if (element.checked == true) {
						document.getElementById("radmasivos").style = 'display:display;width:550px;height:220px;';
						document.getElementById("presupuestomasivo").style = 'display:display;';
						document.getElementById("presupuesto").style = 'display:none;';
					} else {
						document.getElementById("radmasivos").style = 'display:none;';
						document.getElementById("presupuestomasivo").style = 'display:none;';
						document.getElementById("presupuesto").style = 'display:display;';
						document.getElementById("multiplemasivo").value = '0';
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
						<select id="multiplemasivo" name="radicadosm[]" multiple style="width:550px;height:220px;">
							<?php
							$queryop = sprintf("SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 AND check_tesoreria=1 and estado_devolucion_dinero=1 ORDER BY id_devolucion_dinero desc");
							$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
							$rowop = mysql_fetch_assoc($selectop);
							$total = mysql_num_rows($selectop);
							if (0 < $total) {
								do { ?>
									<option value="<?php echo $rowop['id_devolucion_dinero']; ?>" title="<?php echo $rowop['fecha_correspondencia']; ?>"><?php echo $rowop['nombre_devolucion_dinero']; ?> - <?php echo $rowop['asunto_correspondencia']; ?></option>
							<?php
								} while ($rowop = mysql_fetch_assoc($selectop));
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
							$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=57 OR id_perfil=59)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
							$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
							$rowop = mysql_fetch_assoc($selectop);
							$total = mysql_num_rows($selectop);
							if (0 < $total) {
								do { ?>
									<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
								} while ($rowop = mysql_fetch_assoc($selectop));
								mysql_free_result($selectop);
							} else {
							}
							?>
						</select>
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-xs btn-warning">Asignar masivamente</button>

					</div>
					<hr>
				</div>
			</form>
		<?php
		} else {}


		if (0 < $nump56 or 1 == $_SESSION['rol']) { ?>

			<div class="row">
				<form action="" method="post" name="23434555">
					<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">

					<div class="col-md-4"><b>Asignar Visto Tesoreria a:</b></div>
					<div class="col-md-6">
						<select name="id_fun_tesoreria_check">
							<option value=""></option>
							<?php
							$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=56 OR id_perfil=61)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
							$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
							$rowop = mysql_fetch_assoc($selectop);
							$total = mysql_num_rows($selectop);
							if (0 < $total) {
								do { ?>
									<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
								} while ($rowop = mysql_fetch_assoc($selectop));
								mysql_free_result($selectop);
							} else {
							}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-xs btn-success" name="AsignarFunTesoreriaVistoBueno" value="1">Asignar</button>
					</div>
				</form>
			</div>
		<?php
		} else {}
		?>

		<?php
		if (0 < $nump57 or 1 == $_SESSION['rol']) { ?>

			<div class="row" id="presupuesto">
				<form action="" method="post" name="435435">

					<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">


					<div class="col-md-4"><b>Asignar presupuesto a:</b></div>
					<div class="col-md-6">
						<select name="id_fun_presupuesto">
							<option value=""></option>
							<?php
							$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=57 OR id_perfil=59)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
							$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
							$rowop = mysql_fetch_assoc($selectop);
							$total = mysql_num_rows($selectop);
							if (0 < $total) {
								do { ?>
									<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
								} while ($rowop = mysql_fetch_assoc($selectop));
								mysql_free_result($selectop);
							} else {
							}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-xs btn-success" name="AsignarFunPresupuesto" value="1">Asignar</button>
					</div>
				</form>
			</div>

		<?php } else {}
		if (0 < $nump58 or 1 == $_SESSION['rol']) { ?>

			<div class="row">
				<form action="" method="post" name="43gfhg5435">
					<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">
					<div class="col-md-4"><b>Asignar Contabilidad a:</b></div>
					<div class="col-md-6">
						<select name="id_fun_contabilidad">
							<option value=""></option>
							<?php
							$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=58 OR id_perfil=60)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
							$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
							$rowop = mysql_fetch_assoc($selectop);
							$total = mysql_num_rows($selectop);
							if (0 < $total) {
								do { ?>
									<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
								} while ($rowop = mysql_fetch_assoc($selectop));
								mysql_free_result($selectop);
							} else {
							}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-xs btn-success" name="AsignarFunContabilidad" value="1">Asignar</button>
					</div>
				</form>
			</div>

		<?php } else {}

		if (0 < $nump56 or 1 == $_SESSION['rol']) { ?>

			<div class="row">
				<form action="" method="post" name="434335435">
					<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">

					<div class="col-md-4"><b>Asignar Tesoreria a:</b></div>
					<div class="col-md-6">
						<select name="id_fun_tesoreria">
							<option value=""></option>
							<?php
							$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=56 OR id_perfil=61)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
							$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
							$rowop = mysql_fetch_assoc($selectop);
							$total = mysql_num_rows($selectop);
							if (0 < $total) {
								do { ?>
									<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
								} while ($rowop = mysql_fetch_assoc($selectop));
								mysql_free_result($selectop);
							} else {
							}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-xs btn-success" name="AsignarFunTesoreria" value="1">Asignar</button>
					</div>
				</form>
			</div>

		<?php
		} else {}
		?>

		<hr><b>Visto Tesoreria</b>: <?php if (isset($row['id_fun_tesoreria_check'])) {
								echo quees('funcionario', $row['id_fun_tesoreria_check']);
							} else {
								echo 'No tiene asignación';
							} ?><br>
		<b>Presupuesto</b>: <?php if (isset($row['id_fun_presupuesto'])) {
									echo quees('funcionario', $row['id_fun_presupuesto']);
								} else {
									echo 'No tiene asignación';
								} ?><br>
		<b>Contabilidad</b>: <?php if (isset($row['id_fun_contabilidad'])) {
									echo quees('funcionario', $row['id_fun_contabilidad']);
								} else {
									echo 'No tiene asignación';
								} ?><br>
		<b>Tesoreria</b>: <?php if (isset($row['id_fun_tesoreria'])) {
								echo quees('funcionario', $row['id_fun_tesoreria']);
							} else {
								echo 'No tiene asignación';
							} ?><br>


		<?php if (1 == $_SESSION['rol'] or 0 < $nump57) { ?>
			<br>
			<form action="" method="post" name="43g3234324fhg5435">
				<button type="submit" class="btn btn-xs btn-danger" name="archivar" value="<?php echo $row['id_correspondencia']; ?>">Archivar / Borrar</button>
			</form>
		<?php	} else {
		} ?>

		<br>
	<?php
	mysql_free_result($select);
}
	?>
	</div>