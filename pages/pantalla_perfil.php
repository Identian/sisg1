<?php

$nump143 = privilegios(143, $_SESSION['snr']);


if (1 == $_SESSION['rol'] or 0 < $nump143) {
	if ((isset($_POST["nombre_perfil"])) && ($_POST["nombre_perfil"] != "")) {
		$insertSQL = sprintf(
			"INSERT INTO perfil (nombre_perfil, estado_perfil) VALUES (%s, %s)",
			GetSQLValueString($_POST["nombre_perfil"], "text"),
			GetSQLValueString(1, "int")
		);
		$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		echo $insertado;
	} else {
	}

?>

	<div class="row">

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3> Privilegios</h3>
					<hr>
					<form class="navbar-form" name="form1" method="post" action="">
						<div class="input-group">
							<div class="input-group-btn">
								<input type="text" class="form-control" required name="nombre_perfil" style="width:300px;" placeholder="Nuevo privilegio">
							</div>
							<div class="input-group-btn">
								<button type="submit" class="btn btn-success"> + </button>
							</div>
						</div>
					</form>
					<div class="box-body">
						<div class="table-responsive">
							<br>
							<?php
							$query = sprintf("SELECT * FROM perfil where estado_perfil=1");
							$select = mysql_query($query, $conexion) or die(mysql_error());
							$row = mysql_fetch_assoc($select);
							$totalRows = mysql_num_rows($select);
							if (0 < $totalRows) {
								do {
									$id_perfil = $row['id_perfil'];
									echo '<b>' . $row['id_perfil'] . '. ' . $row['nombre_perfil'] . '</b><br>';

									$selectk = mysql_query("SELECT id_funcionario_perfil, nombre_funcionario, funcionario.id_funcionario, funcionario.id_grupo_area FROM funcionario_perfil, funcionario  where funcionario_perfil.id_perfil=" . $id_perfil . "  and  funcionario_perfil.id_funcionario=funcionario.id_funcionario and estado_funcionario_perfil=1 and estado_funcionario=1 order by nombre_funcionario", $conexion);
									$rowk = mysql_fetch_assoc($selectk);
									$totalRowsk = mysql_num_rows($selectk);
									if (0 < $totalRowsk) {
										echo '<ul style="list-style:none;">';  // 
										do {
											echo '<li>';
											echo '<a href="usuario&' . $rowk['id_funcionario'] . '.jsp" target="_blank"><span class="fa fa-user"></span></a> ';
											echo $rowk['nombre_funcionario'] . ' <span style="cursor: pointer; color:#3c8dbc;" title="' . quees('grupo_area', $rowk['id_grupo_area']) . '"> Grupo</span>';
											echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="funcionario_perfil" id="' . $rowk['id_funcionario_perfil'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

											if (75 == $id_perfil) {
												$select77n = mysql_query("select count(id_notaria) as cuentann from notaria_facturacion where instalada=0 and id_funcionario=" . $rowk['id_funcionario'] . " ", $conexion);
												$row77n = mysql_fetch_assoc($select77n);
												echo ' - ' . $row77n['cuentann'];
												mysql_free_result($select77n);
											} else {
											}

											echo '</li>';
										} while ($rowk = mysql_fetch_assoc($selectk));
										echo '</ul>';
									} else {
									}
									mysql_free_result($selectk);
								} while ($row = mysql_fetch_assoc($select));
							} else {
							}
							mysql_free_result($select);
							?>


						</div>
					</div>
				</div>
			</div>
		</div>






		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<h3> Secciones</h3>
						</div>
						<div class="col-md-6 text-right">
							<a href="rdf/" target="blank" class="btn btn-warning">
								<span class=""></span>RDF</a>
						</div>
					</div>
					<hr>

					<div class="box-body">
						<div class="table-responsive">


							<div class="bloque">
								<div class=" thumbnail">
									<h3>Configuración General</h3>
									<ul>
										<?php

										$query = sprintf("SELECT id_estructura_seccion, nombre_estructura_seccion, tabla FROM estructura_seccion where id_seccion=1 and estado_estructura_seccion=1 order by id_estructura_seccion");
										$select = mysql_query($query, $conexion) or die(mysql_error());
										$row = mysql_fetch_assoc($select);
										$totalRows = mysql_num_rows($select);
										if (0 < $totalRows) {
											do {
												echo '<li><a href="">' . strtoupper($row['nombre_estructura_seccion']) . '</a></li>';
											} while ($row = mysql_fetch_assoc($select));
										} else {
										}
										mysql_free_result($select);
										?>
									</ul>
								</div>
							</div>
							<div class="bloque">
								<div class=" thumbnail">
									<h3>Componente Registral</h3>
									<ul>
										<?php

										$query = sprintf("SELECT id_estructura_seccion, nombre_estructura_seccion, tabla FROM estructura_seccion where id_seccion=2 and estado_estructura_seccion=1 order by id_estructura_seccion");
										$select = mysql_query($query, $conexion) or die(mysql_error());
										$row = mysql_fetch_assoc($select);
										$totalRows = mysql_num_rows($select);
										if (0 < $totalRows) {
											do {
												echo '<li><a href="">' . strtoupper($row['nombre_estructura_seccion']) . '</a></li>';
											} while ($row = mysql_fetch_assoc($select));
										} else {
										}
										mysql_free_result($select);
										?>
									</ul>
								</div>
							</div>
							<div class="bloque">
								<div class=" thumbnail">
									<h3>Componente Notarial</h3>
									<ul>
										<?php

										$query = sprintf("SELECT id_estructura_seccion, nombre_estructura_seccion, tabla FROM estructura_seccion where id_seccion=3 and estado_estructura_seccion=1 order by id_estructura_seccion");
										$select = mysql_query($query, $conexion) or die(mysql_error());
										$row = mysql_fetch_assoc($select);
										$totalRows = mysql_num_rows($select);
										if (0 < $totalRows) {
											do {
												echo '<li><a href="">' . strtoupper($row['nombre_estructura_seccion']) . '</a></li>';
											} while ($row = mysql_fetch_assoc($select));
										} else {
										}
										mysql_free_result($select);
										?>
									</ul>
								</div>
							</div>
							<div class="bloque">
								<div class=" thumbnail">
									<h3>Componente Curadurias</h3>
									<ul>
										<?php

										$query = sprintf("SELECT id_estructura_seccion, nombre_estructura_seccion, tabla FROM estructura_seccion where id_seccion=4 and estado_estructura_seccion=1 order by id_estructura_seccion");
										$select = mysql_query($query, $conexion) or die(mysql_error());
										$row = mysql_fetch_assoc($select);
										$totalRows = mysql_num_rows($select);
										if (0 < $totalRows) {
											do {
												echo '<li><a href="">' . strtoupper($row['nombre_estructura_seccion']) . '</a></li>';
											} while ($row = mysql_fetch_assoc($select));
										} else {
										}
										mysql_free_result($select);
										?>
									</ul>
								</div>
							</div>
							<div class="bloque">
								<div class=" thumbnail">
									<h3>Componente PQRS</h3>
									<ul>
										<?php

										$query = sprintf("SELECT id_estructura_seccion, nombre_estructura_seccion, tabla FROM estructura_seccion where id_seccion=5 and estado_estructura_seccion=1 order by id_estructura_seccion");
										$select = mysql_query($query, $conexion) or die(mysql_error());
										$row = mysql_fetch_assoc($select);
										$totalRows = mysql_num_rows($select);
										if (0 < $totalRows) {
											do {
												echo '<li><a href="">' . strtoupper($row['nombre_estructura_seccion']) . '</a></li>';
											} while ($row = mysql_fetch_assoc($select));
										} else {
										}
										mysql_free_result($select);
										?>
									</ul>
								</div>
							</div>


							<div class="bloque">
								<div class=" thumbnail">
									<h3>Componente Sistemas de Información</h3>
									<ul>
										<?php

										$query = sprintf("SELECT id_estructura_seccion, nombre_estructura_seccion, tabla FROM estructura_seccion where id_seccion=8 and estado_estructura_seccion=1 order by id_estructura_seccion");
										$select = mysql_query($query, $conexion) or die(mysql_error());
										$row = mysql_fetch_assoc($select);
										$totalRows = mysql_num_rows($select);
										if (0 < $totalRows) {
											do {
												echo '<li><a href="">' . strtoupper($row['nombre_estructura_seccion']) . '</a></li>';
											} while ($row = mysql_fetch_assoc($select));
										} else {
										}
										mysql_free_result($select);
										?>
									</ul>
								</div>
							</div>




						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
<?php
} else {
}
?>