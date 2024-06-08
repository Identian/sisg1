<?php
$realdatecompleto = date('Y-m-d H:i:s');
$anoActual = date('Y');
$fecha_actual = strtotime($realdatecompleto);

//echo $realdatecompleto.'<br>';
$fecha_inicio = strtotime("2024-05-14 08:00:00");
$fecha_limite = strtotime("2024-05-14 17:00:00");

// echo $fecha_inicio.'<br>'.$fecha_actual.'<br>'.$fecha_limite.'<br>';

if ($fecha_actual >= $fecha_inicio) {
	//echo '.';
	if ($fecha_actual <= $fecha_limite) {
		// echo '.';
		$vali = 1;
	} else {
		echo 'La votación esta inactiva';
		$vali = 0;
	}
} else {
	echo 'La votación no ha iniciado';
	$vali = 0;
}



$valor = $_SESSION['snr'];

$selectu = mysql_query("SELECT id_funcionario, nombre_funcionario, correo_funcionario from funcionario where id_tipo_oficina<3 and id_cargo!=5 and id_funcionario=" . $valor . " limit 1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$idf = $rowu['id_funcionario'];
$correof = $rowu['correo_funcionario'];
$funcionario = $rowu['nombre_funcionario'];
mysql_free_result($selectu);

// if (0<$vali and 0<$idf) {
if (1 == $_SESSION['rol'] || 14819 == $_SESSION['snr'] || 2286 == $_SESSION['snr'] || 8959 == $_SESSION['snr'] || 10873 == $_SESSION['snr'] || 10863 == $_SESSION['snr'] || 511 == $_SESSION['snr']) {
?>
	<?php

	if ((isset($_POST["vot"])) && ($_POST["vot"] != "")) {

		$selectu = mysql_query("select count(id_votacion_sst) as totale from votacion_sst where id_funcionario=" . $idf . " AND ano_votacion_sst=" . $anoActual . " and estado_votacion_sst=1", $conexion);
		$rowu = mysql_fetch_assoc($selectu);
		$numvotauw = intval($rowu['totale']);
		if (0 < $numvotauw) {
			echo '<script>alert("Ya habia emitido el voto");</script>';
		} else {

			$realdatecompleto = date('Y-m-d H:i:s');

			$varvot = $_SESSION['snr'] . '-' . $_POST["vot"] . '-' . $realdatecompleto . '';
			$valorhash = md5($varvot);
			$insertSQL = sprintf(
				"INSERT INTO votacion_sst (nombre_votacion_sst, id_candidato_votacion_sst, id_funcionario, ano_votacion_sst, fecha_votacion_sst, estado_votacion_sst) VALUES (%s, %s, %s, %s, %s, %s)",
				GetSQLValueString($valorhash, "text"),
				GetSQLValueString($_POST["vot"], "int"),
				GetSQLValueString($idf, "int"),
				GetSQLValueString($anoActual, "int"),
				GetSQLValueString($realdatecompleto, "date"),
				GetSQLValueString(1, "int")
			);
			$Result = mysql_query($insertSQL, $conexion);

			echo $insertado;


			$votf = intval($_POST["vot"]);
			$prin = $_POST["prin"];
			$suple = $_POST["suple"];




			$emailur2 = $_SESSION['snr_correo'];
			$subject = 'CONFIRMACIÓN VOTO EXITOSO';
			$cuerpo2 = '';
			$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
			$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado correctamente el voto a COPASST.<br><br>';
			$cuerpo2 .= 'Fecha y hora de votación: ' . $realdatecompleto . '<br>';
			$cuerpo2 .= 'Para efecto de auditoria del sistema, su código hash de votación fue el siguiente: ' . $valorhash . '<br>';
			$cuerpo2 .= "<br><br>";
			$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
			$cuerpo2 .= "<br></div><br></div>";
			$cabeceras = '';
			$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
			$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
			$cabeceras .= "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
			mail($emailur2, $subject, $cuerpo2, $cabeceras);
		}
	} else {
	} ?>
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">

				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>195</h3>
						<p>ORIP'S</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">

				<div class="small-box bg-green">
					<div class="inner">
						<?php $selectVotos = mysql_query("select count(id_votacion_sst) as totale from votacion_sst WHERE estado_votacion_sst=1 AND ano_votacion_sst=" . $anoActual . "", $conexion);
						$rowVotos = mysql_fetch_assoc($selectVotos);
						$numVotos = intval($rowVotos['totale']);
						mysql_free_result($selectVotos);  ?>
						<h3><?php echo $numVotos; ?></h3>
						<p>Numero de Votos</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">

				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>14/05/2024</h3>
						<p>Fecha Votacion</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">

				<div class="small-box bg-red">
					<div class="inner">
						<h3>8:00 am A 5:00 pm</h3>
						<p>Hora Votación</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12" style=" background-color: white;">
				<div class="card-body p-0">
					<ul class="users-list clearfix">
						<?php $query = "SELECT * FROM candidato_votacion_sst, funcionario WHERE candidato_votacion_sst.id_funcionario=funcionario.id_funcionario and estado_candidato_votacion_sst=1 AND ano_candidato_votacion_sst=" . $anoActual . "";
						$select = mysql_query($query, $conexion);
						$row = mysql_fetch_assoc($select);
						$totalRows = mysql_num_rows($select);
						if (0 < $totalRows) {
							do {
								$idv = $row['numero_candidato_votacion_sst'];
								$fun1 = $row['id_funcionario'];
								$foto = $row['foto_funcionario'];
								$name = $row['nombre_funcionario']; ?>
								<li>
									<img src="files/<?php echo $foto; ?>" style="width: 150px; !important height: 150px; !important" alt="<?php echo $foto; ?>">
									<span class="users-list-name"><?php echo $name; ?></span>
									<span class="users-list-date">Candidato <?php echo $idv; ?></span>

									<?php
									$selectu = mysql_query("select count(id_votacion_sst) as totale from votacion_sst where id_funcionario=" . $idf . " and estado_votacion_sst=1 AND ano_votacion_sst=" . $anoActual . "", $conexion);
									$rowu = mysql_fetch_assoc($selectu);
									$numvotau = intval($rowu['totale']);
									mysql_free_result($selectu);
									if (0 < $numvotau) {
										echo '<button class="btn btn-default btn-block"> Votación hecha </button>';
									} else {
									?>
										<form action="" method="POST" name="form54565461" style="display: inline;">
											<input type="hidden" name="prin" value="<?php echo $name; ?>">
											<input type="hidden" name="vot" value="<?php echo $idv; ?>">
											<button type="submit" id="<?php echo $idv; ?>" class="btn btn-success btn-block confirmavotacion">
												<span class="glyphicon glyphicon-ok"></span> Votar</button>
										</Form>
									<?php } ?>
								</li>
						<?php
							} while ($row = mysql_fetch_assoc($select));
						} else {
						}
						mysql_free_result($select);
						?>
						<li>
							<img src="files/avatar.png" width="150px" height="150px" alt="Foto Candidato">
							<span class="users-list-name">Voto en Blanco</span>
							<span class="users-list-date">Voto en Blanco</span>
							<?php if (0 < $numvotau) {
								echo 'Votación hecha';
							} else { ?>
								<form action="" method="POST" name="form54435565461">
									<input type="hidden" name="prin" value="Voto en blanco">
									<input type="hidden" name="suple" value="Voto en blanco">
									<input type="hidden" name="vot" value="0">
									<button type="submit" id="Voto blanco" class="btn btn-success confirmavotacion" style="width:100%">
										<span class="glyphicon glyphicon-ok"></span> Votar</button>
								</Form>
							<?php } ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>


<?php
} else {
	echo '<br>Solo para funcionarios de la SNR.';
}
?>