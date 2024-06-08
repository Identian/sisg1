<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$asigna=intval($_POST['option']);

$nump38=privilegios(38,$_SESSION['snr']);
$nump41=privilegios(41,$_SESSION['snr']);
$nump39=privilegios(39,$_SESSION['snr']);
$nump42=privilegios(42,$_SESSION['snr']);
$nump40=privilegios(40,$_SESSION['snr']);
$nump43=privilegios(43,$_SESSION['snr']);

	
$query = sprintf("SELECT * FROM correspondencia where id_correspondencia=".$asigna." and estado_correspondencia=1 limit 1");
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
if (1==$_SESSION['rol'] or 0<$nump36 or 0<$nump38 or 40==$_SESSION['snr_grupo_area']) {?>
		<form action="" method="post" name="43g4325fhg5435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">
		<input type="hidden" name="radicadosupervisor" value="<?php echo $row['nombre_correspondencia']; ?>">
		
		<div class="row" >
			<div class="col-md-4"><b>Supervisor:</b></div>
			<div class="col-md-6">
				<select name="id_supervisor" required>
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario where supervisor=1 and estado_funcionario=1 ORDER BY nombre_funcionario ASC");
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
				<button type="submit" class="btn btn-xs btn-success">Asignar</button> 
			</div>
		</div>
	</form>
<?php
} else { }
?>




<?php
if (0<$nump38 OR 1==$_SESSION['rol']) { ?>
	<form action="" method="post" name="435435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">
		<div class="row">
			<div class="col-md-4"><b>Tipo de Factura:</b></div>
			<div class="col-md-6">
				<select name="id_tipo_factura" required>
					<option value=""></option>
					<option value="1">Servicios Públicos</option>
					<option value="2">Administración</option>
					<option value="3">Arrendamientos</option>
					<option value="4">Cuentas de cobro contratistas con factura</option>
					<option value="5">Proveedores</option>
				</select><br/>
			</div>
			<div class="col-md-4"><b>Asignar presupuesto a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_presupuesto" required>
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=38 or id_perfil=41)  and estado_funcionario_perfil=1 group by funcionario_perfil.id_funcionario ORDER BY nombre_funcionario ASC");
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
<?php } else {} if (0<$nump39 OR 1==$_SESSION['rol']) { ?>
		<form action="" method="post" name="43gfhg5435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">

		<div class="row" >
			<div class="col-md-4"><b>Asignar Contabilidad a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_contabilidad" required>
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=39 or id_perfil=42)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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
<?php } else {} if (0<$nump40 OR 1==$_SESSION['rol']) { ?>
		<form action="" method="post" name="434335435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $row['id_correspondencia']; ?>">

		<div class="row" >
			<div class="col-md-4"><b>Asignar Tesoreria a:</b></div>
			<div class="col-md-6">
				<select name="id_fun_tesoreria" required>
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=40 or id_perfil=43)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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
	<b>Tipo de Factura:</b> 
	<?php 
		if (isset($row['id_tipo_factura'])) {
			$tipofac=$row['id_tipo_factura'];
			switch ($tipofac) {
				case 1:
							echo "Servicios Públicos";
							break;
				case 2:
							echo "Administración";
							break;
				case 3:
							echo "Arrendamientos";
							break;
			  case 4:
							echo "Cuentas de cobro contratistas con factura";
							break;
				case 5:
							echo "Proveedores";
							break;
			}
		} else { echo '<span style="color: red;">Sin Asignar Factura</span>';}
	?><br/>
	<b>Presupuesto</b>: <?php if (isset($row['id_fun_presupuesto'])) { echo quees('funcionario', $row['id_fun_presupuesto']);	} else { echo 'No tiene asignación'; } ?><br>
	<b>Contabilidad</b>: <?php if (isset($row['id_fun_contabilidad'])) { echo quees('funcionario', $row['id_fun_contabilidad']);	} else { echo 'No tiene asignación';  } ?><br>
	<b>Tesoreria</b>: <?php if (isset($row['id_fun_tesoreria'])) { echo quees('funcionario', $row['id_fun_tesoreria']);	} else { echo 'No tiene asignación'; } ?><br>

	<b>Supervisor</b>: <?php if (isset($row['id_supervisor'])) { echo quees('funcionario', $row['id_supervisor']);	} else { echo 'No tiene asignación'; } ?><br>

<hr>
           <form action="" method="post" name="4343gdfgret35435">
		<input type="hidden" name="id_correspondencia" value="<?php echo $asigna; ?>">
		<input type="hidden" name="rad_factura" value="<?php echo $row['nombre_correspondencia']; ?>">
<?php if (isset($row['id_supervisor'])) { echo '<input type="hidden" name="id_supervisor_factura" value="'.$row['id_supervisor'].'">';	} else { echo ''; } ?>
			
			<div class="row" >
			<div class="col-md-4"><b>Estado del tramite: </b>
			</div><div class="col-md-6">
			<select name="id_tipo_seguimiento_correspondencia" required style="width:220px;">
			<option value="" selected></option>
			<?php echo lista('tipo_seguimiento_correspondencia'); ?>
			</select>
			</div><div class="col-md-2">
				<button type="submit" class="btn btn-xs btn-success">Crear</button></div>
			</div>
			
			
			<div class="row" >
			<div class="col-md-12">
			
			<textarea required name="nombre_seguimiento_correspondencia" placeholder="Observación" style="width:100%;height:20px;"></textarea>
				</div></div>
				
	</form>

<?php
 $queryops = sprintf("SELECT * FROM seguimiento_correspondencia where id_correspondencia=".$asigna." and estado_seguimiento_correspondencia=1 ORDER BY id_seguimiento_correspondencia");
					$selectops = mysql_query($queryops, $conexion);
					$rowops = mysql_fetch_assoc($selectops);
					$totals = mysql_num_rows($selectops);
					if (0<$totals) {
						do {
							echo '<div style="margin: 0px 0px 3px 0px;padding: 5px 5px 5px 5px;background:#f2f2f2;border:solid 1px #ccc;"><span style="font-size:12px;">De: ';
							echo quees('funcionario', intval($rowops['id_funcionario']));
							echo ' / '.$rowops['fecha_seguimiento_correspondencia'];
							echo '  / <b>';
							echo quees('tipo_seguimiento_correspondencia', $rowops['id_tipo_seguimiento_correspondencia']);
							echo '</b></span><br>';
							echo ''.$rowops['nombre_seguimiento_correspondencia'];
							echo '</div>';
						}while ($rowops = mysql_fetch_assoc($selectops)); 
						mysql_free_result($selectops);
					} else {}
					?>






<?php
	mysql_free_result($select);
}
?>
</div>