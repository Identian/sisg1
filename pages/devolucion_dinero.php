<?php
// DEVOLUCIONES DE DINERO
$nump36 = privilegios(36, $_SESSION['snr']);  // GESTION IRIS
$nump56 = privilegios(56, $_SESSION['snr']);  // ADM TESORERIA
$nump57 = privilegios(57, $_SESSION['snr']);  // ADM PRESUPUESTO
$nump58 = privilegios(58, $_SESSION['snr']);  // ADM CONTABILIDAD
$nump59 = privilegios(59, $_SESSION['snr']);  // USU PRESUPUESTO
$nump60 = privilegios(60, $_SESSION['snr']);  // USU CONTABILIDAD
$nump61 = privilegios(61, $_SESSION['snr']);  // USU TESORERIA

if (
	1 == $_SESSION['rol'] || 0 < $nump36 || 0 < $nump56 || 0 < $nump57 || 0 < $nump58 || 0 < $nump59 || 0 < $nump60  || 0 < $nump61 ||
	(isset($_SESSION['id_oficina_registro']) && 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 7)) ||
	(isset($_SESSION['id_oficina_registro']) && 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 8))
) {
	// VARIABLES GLOBALES
	// Fecha Actual
	$fechaActual = date("Y-m-d H:i:s");

	//ANEXAR DOCUMENTOS EN IRIS (MAS DOCUMENTOS)
	if (isset($_POST['idcorrespondencia_anexa']) && "" != $_POST['idcorrespondencia_anexa'] && isset($_FILES['file']['name']) && "" != $_FILES['file']['name']) {
		$tamano_archivo = 11534336;
		$formato_archivo = array('pdf');
		$directoryftp = "filesnr/iris/";
		if (isset($_POST['id_tipo_documento_anexo']) && "" != $_POST['id_tipo_documento_anexo']) {
			$ruta_archivo2 = $_POST['id_tipo_documento_anexo'] . '-' . $_SESSION['snr'] . '-' . date("YmdGis");
		} else {
			$ruta_archivo2 = '4-' . $_SESSION['snr'] . '-' . date("YmdGis");
		}
		$archivo2 = $_FILES['file']['tmp_name'];
		$tam_archivo = filesize($archivo2);
		$tam_archivo3 = $_FILES['file']['size'];
		$nombrefile = strtolower($_FILES['file']['name']);
		$info = pathinfo($nombrefile);
		$extension = $info['extension'];
		$array_archivo = explode('.', $nombrefile);
		$extension2 = end($array_archivo);

		if ($tamano_archivo >= intval($tam_archivo3)) {

			if ('pdf' == $extension) {
				$filep = $ruta_archivo2 . '.pdf';
				$mover_archivos = move_uploaded_file($archivo2, $directoryftp . $filep);
				$nombrebre_orig = ucwords($nombrefile);
				$conexionpostgresql = pg_connect($conexionpostgres);
				if (!$conexionpostgresql) {
					echo 'No se puede conectar con IRIS.';
				} else {
					$idcorrespondencia = $_POST['idcorrespondencia_anexa'];
					$dateiris = date("Y-m-d H:i:s");
					$conn_id = ftp_connect($ftp_server);
					$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
					$file2 = $directoryftp . $filep;
					$remote_file2 = 'Correo/' . $idcorrespondencia . '/Files/' . $filep;
					if (ftp_put($conn_id, $remote_file2, $file2, FTP_BINARY)) {
						echo "";
					} else {
						echo "";
					}
					ftp_close($conn_id);

					$consultab = sprintf(
						"INSERT INTO correspondenciacontenido (
						idcorrespondencia, 
						idtipodocumento, 
						idsubclasedocumento, 
						indice, 
						upd, 
						mostrar, 
						nombre, 
						extension, 
						dir, 
						pag, 
						crc, 
						audita, 
						fechaaudita, 
						audita2, 
						fechaaudita2, 
						creado, 
						fcreado, 
						modificado, 
						fmodificado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						GetSQLValueString($idcorrespondencia, "text"),
						GetSQLValueString('0', "text"),
						GetSQLValueString('0', "text"),
						GetSQLValueString('1', "text"), //incremental
						GetSQLValueString('0', "text"),
						GetSQLValueString('f', "text"),
						GetSQLValueString($filep, "text"),
						GetSQLValueString('Pdf', "text"),
						GetSQLValueString('1', "text"),
						GetSQLValueString('1', "text"),
						GetSQLValueString('', "text"),
						GetSQLValueString('0', "text"),
						GetSQLValueString('', "text"),
						GetSQLValueString('0', "text"),
						GetSQLValueString('', "text"),
						GetSQLValueString('1642', "text"),
						GetSQLValueString($dateiris, "text"),
						GetSQLValueString('0', "text"),
						GetSQLValueString('', "text")
					);
					$resultado = pg_query($consultab);
					pg_free_result($resultado);
					pg_close($conexionpostgresql);
				}

				echo $insertado;

				if ((isset($_POST["radicadou"])) && ($_POST["radicadou"] != "")) {
					$radicadou = $_POST["radicadou"];
					$id_anexo = intval($_POST["id_tipo_documento_anexo"]);
					if (4 == $id_anexo) {
						$updateSQL = "UPDATE devolucion_dinero SET doc_anexo=1 WHERE nombre_devolucion_dinero='$radicadou' and estado_devolucion_dinero=1";
					} else if (10 == $id_anexo) {
						$updateSQL = "UPDATE devolucion_dinero SET doc_devolucion_completa=1 WHERE nombre_devolucion_dinero='$radicadou' and estado_devolucion_dinero=1";
					} else if (12 == $id_anexo) {
						$updateSQL = "UPDATE devolucion_dinero SET doc_vinculacion_cuenta=1 WHERE nombre_devolucion_dinero='$radicadou' and estado_devolucion_dinero=1";
					} else if (13 == $id_anexo) {
						$updateSQL = "UPDATE devolucion_dinero SET doc_reclasificacion=1 WHERE nombre_devolucion_dinero='$radicadou' and estado_devolucion_dinero=1";
					} else if (5 == $id_anexo) {
						$updateSQL = "UPDATE devolucion_dinero SET doc_cuenta_pagar=1 WHERE nombre_devolucion_dinero='$radicadou' and estado_devolucion_dinero=1";
					} else if (8 == $id_anexo) {
						$updateSQL = "UPDATE devolucion_dinero SET doc_orden_pago=1 WHERE nombre_devolucion_dinero='$radicadou' and estado_devolucion_dinero=1";
					} else {
					}
					$Result1 = mysql_query($updateSQL, $conexion);
				}
			} else {
				$filep = '';
				echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
			}
		} else {
			$filep = '';
			echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
		}
	} else {
		$filep = '';
	}


	//INSERTAR MASIVAMENTE
	if ((isset($_POST["radicadosm"])) && ("" != $_POST["radicadosm"])) {
		$estud = $_POST['radicadosm'];
		for ($u = 0; $u < count($estud); $u++) {
			$estu = $estud[$u];
			if (isset($_POST['id_fun_presupuestom']) and ("" != $_POST['id_fun_presupuestom'])) {
				$asig = $_POST["id_fun_presupuestom"];
				$queryp = "select id_fun_presupuesto from devolucion_dinero where id_devolucion_dinero=" . $estu . " and estado_devolucion_dinero=1 limit 1";
				$selectp = mysql_query($queryp, $conexion);
				$rowp = mysql_fetch_assoc($selectp);
				if (isset($rowp['id_fun_presupuesto'])) {
				} else {
					$updatecc = sprintf(
						"UPDATE devolucion_dinero SET id_fun_presupuesto=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
						GetSQLValueString($asig, "int"),
						GetSQLValueString($estu, "int")
					);
					$Resultcc = mysql_query($updatecc, $conexion);
					echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
				}
			} else {
			}

			if (isset($_POST['id_fun_contabilidadm']) and ("" != $_POST['id_fun_contabilidadm'])) {
				$asig = $_POST["id_fun_contabilidadm"];
				$queryp = "select id_fun_contabilidad from devolucion_dinero where id_devolucion_dinero=" . $estu . " and estado_devolucion_dinero=1 limit 1";
				$selectp = mysql_query($queryp, $conexion);
				$rowp = mysql_fetch_assoc($selectp);
				if (isset($rowp['id_fun_contabilidad'])) {
				} else {
					$updatecc = sprintf(
						"UPDATE devolucion_dinero SET id_fun_contabilidad=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
						GetSQLValueString($asig, "int"),
						GetSQLValueString($estu, "int")
					);
					$Resultcc = mysql_query($updatecc, $conexion);
					echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
				}
			} else {
			}

			if (isset($_POST['id_fun_tesoreriam']) and ("" != $_POST['id_fun_tesoreriam'])) {
				$asig = $_POST["id_fun_tesoreriam"];
				$queryp = "select id_fun_tesoreria from devolucion_dinero where id_devolucion_dinero=" . $estu . " and estado_devolucion_dinero=1 limit 1";
				$selectp = mysql_query($queryp, $conexion);
				$rowp = mysql_fetch_assoc($selectp);
				if (isset($rowp['id_fun_tesoreria'])) {
				} else {
					$updatecc = sprintf(
						"UPDATE devolucion_dinero SET id_fun_tesoreria=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
						GetSQLValueString($asig, "int"),
						GetSQLValueString($estu, "int")
					);
					$Resultcc = mysql_query($updatecc, $conexion);
					echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
				}
			} else {
			}
		}
		echo $insertado;
	}


	// INSERTAR ASIGNACION
	if (isset($_POST['AsignarFunPresupuesto'])) {
		$updatecc = sprintf(
			"UPDATE devolucion_dinero SET id_fun_presupuesto=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
			GetSQLValueString($_POST["id_fun_presupuesto"], "int"),
			GetSQLValueString($_POST["id_devolucion_dinero"], "int")
		);
		$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());
		echo $actualizado;
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}
	if (isset($_POST['AsignarFunContabilidad'])) {
		$updatecc = sprintf(
			"UPDATE devolucion_dinero SET id_fun_contabilidad=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
			GetSQLValueString($_POST["id_fun_contabilidad"], "int"),
			GetSQLValueString($_POST["id_devolucion_dinero"], "int")
		);
		$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());
		echo $actualizado;
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}
	if (isset($_POST['AsignarFunTesoreria'])) {
		$updatecc = sprintf(
			"UPDATE devolucion_dinero SET id_fun_tesoreria=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
			GetSQLValueString($_POST["id_fun_tesoreria"], "int"),
			GetSQLValueString($_POST["id_devolucion_dinero"], "int")
		);
		$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());
		echo $actualizado;
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}
	if (isset($_POST['AsignarFunTesoreriaVistoBueno'])) {
		$updatecc = sprintf(
			"UPDATE devolucion_dinero SET id_fun_tesoreria_check=%s WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
			GetSQLValueString($_POST["id_fun_tesoreria_check"], "int"),
			GetSQLValueString($_POST["id_devolucion_dinero"], "int")
		);
		$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());
		echo $actualizado;
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// ACTUALIZACION TIPO DE DOCUMENTO
	if ((isset($_POST["id_tipo_documento_cambio"])) && ($_POST["id_tipo_documento_cambio"] != "")) {
		$radicadotipodoc = $_POST["radicado_update_tipo_doc"];
		$id_tipo_documento_u = intval($_POST["id_tipo_documento_cambio"]);
		$conexionpostgresql = pg_connect($conexionpostgres);
		if (!$conexionpostgresql) {
			echo 'No se puede conectar con IRIS.';
		} else {
			$consultabre = sprintf(
				"UPDATE devolucion_dinero SET idtipodocumento=%s, modificado=1642, fmodificado=%s where codigo=%s",
				GetSQLValueString($id_tipo_documento_u, "int"),
				GetSQLValueString($fechairis_re, "text"),
				GetSQLValueString($radicadotipodoc, "text")
			);
			$resultadore = pg_query($consultabre);
			pg_free_result($resultadore);
			pg_close($conexionpostgresql);
		}
		$updateSQL2 = "UPDATE devolucion_dinero SET id_tipo_correspondencia=" . $id_tipo_documento_u . " WHERE nombre_devolucion_dinero='$radicadotipodoc' and estado_devolucion_dinero=1";
		$Result12 = mysql_query($updateSQL2, $conexion);
		echo  $actualizado;
		mysql_free_result($Result12);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	if (isset($_POST['archivar']) && "" != $_POST['archivar']) {
		$updatecc = sprintf(
			"UPDATE devolucion_dinero SET estado_devolucion_dinero=0 WHERE id_devolucion_dinero=%s and estado_devolucion_dinero=1",
			GetSQLValueString($_POST["archivar"], "int")
		);
		$Resultcc = mysql_query($updatecc, $conexion);
		echo $actualizado;
		mysql_free_result($Resultcc);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}


	if (isset($_POST["nuevaDevolucionDeDinero"])) {
		// CONEXION POSTGRES - RADICADO EN IRIS
		$userpostgres     = "postgres";
		$passwordpostgres   = "postgres";
		$dbpostgres        = "SNR";
		$portpostgres     = "5432";
		$hostpostgres     = "192.168.10.22";
		$conexionpostgres = pg_pconnect("host=" . $hostpostgres . " port=" . $portpostgres . " dbname=" . $dbpostgres . " user=" . $userpostgres . " password=" . $passwordpostgres . "") or die("No se ha podido conectar");


		$asunto_correspondencia =  $_POST["asunto_correspondencia"];
		$descripcion_correspondencia = $_POST["descripcion_correspondencia"];
		$recibida = 'true';
		$interno = 'false';
		$idestado = '8';
		$fechairis = date("Y-m-d H:i:s");
		$fechaenvio = date("Y-m-d ") . '00:00:00';

		$id = 'ER';
		$anoiris = date("Y");
		$infoiris = 'SNR' . $anoiris . $id;
		$sql = "SELECT codigo FROM correspondencia where codigo like '%" . $infoiris . "%' order by idcorrespondencia desc limit 1";
		$rs = pg_query($sql);
		$num_resultados = pg_num_rows($rs);
		if (0 < $num_resultados) {
			for ($i = 0; $i < $num_resultados; $i++) {
				$row = pg_fetch_array($rs);
				$info2iris = $row['codigo'];
			}
			$info3iris = explode($anoiris . $id, $info2iris);
			$info4iris = intval($info3iris[1]);
			$info5iris = $info4iris + 1;
			$info6iris = trim(substr('000000' . $info5iris, -6));
			$radicado = 'SNR' . $anoiris . $id . $info6iris;
		}
		pg_free_result($rs);

		$consultab = sprintf(
			"INSERT INTO correspondencia (
			idcorreoprioridad, 
			idtipodocumento, 
			codigo, 
			referencia, 
			asunto, 

			idestado, 
			idcorreovia, 
			recibida, 
			interna, 
			deint, 

			de, 
			paraint, 
			para,  
			folios, 
			anexos, 

			contenido, 
			fechaenvio, 
			fecharecepcion, 
			descripcion, 
			creado, 
			fcreado) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
			GetSQLValueString('1', "text"),
			GetSQLValueString('308', "text"),
			GetSQLValueString($radicado, "text"),
			GetSQLValueString('DEVOLUCION DAF', "text"),
			GetSQLValueString($asunto_correspondencia, "text"),

			GetSQLValueString($idestado, "text"),
			GetSQLValueString('3', "text"),
			GetSQLValueString($recibida, "text"),
			GetSQLValueString($interno, "text"),
			GetSQLValueString('5,1642 ', "text"),

			GetSQLValueString('SISG OTI [USUARIO]', "text"),
			GetSQLValueString('5,1753 ', "text"),
			GetSQLValueString('ARCHIVO DEVOLUCIONES / ', "text"),
			GetSQLValueString('1', "text"),
			GetSQLValueString('1', "text"),

			GetSQLValueString('1', "text"),
			GetSQLValueString($fechaenvio, "text"),
			GetSQLValueString($fechairis, "text"),
			GetSQLValueString($descripcion_correspondencia, "text"),
			GetSQLValueString(1642, "text"),
			GetSQLValueString($fechairis, "text")
		);
		$resultadopg = pg_query($consultab);

		if (FALSE != $resultadopg) {

			$insertSQL = sprintf(

				"INSERT INTO devolucion_dinero (
				nombre_devolucion_dinero, 
				referencia, 
				id_tipo_correspondencia, 
				id_funcionario_de, 
				id_funcionario_para,

				fecha_correspondencia, 

				asunto_correspondencia, 
				descripcion_correspondencia, 
				turno_devolucion_dinero,
				valor_devolucion_dinero,
				id_tipo_oficina_de, 
				codigo_oficina_de, 
				estado_devolucion_dinero) VALUES (%s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s)",
				GetSQLValueString($radicado, "text"),
				GetSQLValueString("DEVOLUCION-DAF", "text"),
				GetSQLValueString(308, "text"),
				GetSQLValueString($_SESSION['snr'], "int"),
				GetSQLValueString(1753, "int"),

				GetSQLValueString($asunto_correspondencia, "text"),
				GetSQLValueString($descripcion_correspondencia, "text"),
				GetSQLValueString($_POST["turno_devolucion_dinero"], "text"),
				GetSQLValueString($_POST["valor_devolucion_dinero"], "text"),
				GetSQLValueString(2, "int"),
				GetSQLValueString($_SESSION['id_oficina_registro'], "int"),
				GetSQLValueString(1, "int")
			);
			$ResultInsertSQL = mysql_query($insertSQL, $conexion);
			echo $insertado;
			echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
		}
	}

	// RECHAZO DEVOLUCION DINERO
	if (
		isset($_POST["rechazoDevolucion"]) && '' != $_POST["rechazoDevolucion"] &&
		isset($_POST["nombre_devolucion_dinero"]) && '' != $_POST["nombre_devolucion_dinero"] &&
		isset($_POST["mensaje_rechazo"]) && '' != $_POST["mensaje_rechazo"]
	) {
		$insertAutorizaSQL = sprintf(
			"INSERT INTO devolucion_rechazo (nombre_devolucion_dinero, id_funcionario_rechazo, mensaje_rechazo, estado_devolucion_rechazo) 
		VALUES (%s, %s, %s, %s)",
			GetSQLValueString($_POST["nombre_devolucion_dinero"], "text"),
			GetSQLValueString($_SESSION['snr'], "int"),
			GetSQLValueString($_POST["mensaje_rechazo"], "text"),
			GetSQLValueString(0, "int")
		);
		$ResultRechazo = mysql_query($insertAutorizaSQL, $conexion) or die(mysql_error());
		echo $insertado;
		mysql_free_result($ResultRechazo);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// SOLUCION DEVOLUCION DINERO
	if (isset($_POST["solucionDevolucion"]) && "" != $_POST["solucionDevolucion"]) {
		date_default_timezone_set("America/Bogota");
		$fechaAhoraSolucion = date("Y-m-d H:i:s");
		$updateSQL = sprintf(
			"UPDATE devolucion_rechazo SET id_funcionario_solucion=%s, mensaje_solucion=%s, fecha_solucion=%s, estado_devolucion_rechazo=%s  
        WHERE id_devolucion_rechazo=%s",
			GetSQLValueString($_SESSION['snr'], "int"),
			GetSQLValueString($_POST['mensaje_solucion'], "text"),
			GetSQLValueString($fechaAhoraSolucion, "date"),
			GetSQLValueString(1, "int"),
			GetSQLValueString($_POST['id_devolucion_rechazo'], "int")
		);
		$Result1 = mysql_query($updateSQL, $conexion);
		echo $insertado;
		mysql_free_result($Result1);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// ACTUALIZAR NUMERO RECLASIFICACION
	if (
		isset($_POST["num_r_reclasificacion"]) && "" != $_POST["num_r_reclasificacion"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL3 = sprintf(
			"UPDATE devolucion_dinero SET num_r_reclasificacion=%s WHERE id_devolucion_dinero=%s",
			GetSQLValueString($_POST["num_r_reclasificacion"], "text"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result3 = mysql_query($updateSQL3, $conexion);
		echo $insertado;
		mysql_free_result($Result3);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// ACTUALIZAR NUMERO SOLICITUD
	if (
		isset($_POST["num_s_reclasificacion"]) && "" != $_POST["num_s_reclasificacion"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL3 = sprintf(
			"UPDATE devolucion_dinero SET num_s_reclasificacion=%s WHERE id_devolucion_dinero=%s",
			GetSQLValueString($_POST["num_s_reclasificacion"], "text"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result3 = mysql_query($updateSQL3, $conexion);
		echo $insertado;
		mysql_free_result($Result3);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// ACTUALIZAR NUMERO DXC
	if (
		isset($_POST["num_dxc_reclasificacion"]) && "" != $_POST["num_dxc_reclasificacion"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL3 = sprintf(
			"UPDATE devolucion_dinero SET num_dxc_reclasificacion=%s WHERE id_devolucion_dinero=%s",
			GetSQLValueString($_POST["num_dxc_reclasificacion"], "text"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result3 = mysql_query($updateSQL3, $conexion);
		echo $insertado;
		mysql_free_result($Result3);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// NUMERO ORDEN PAGO
	if (
		isset($_POST["num_orden_pago"]) && "" != $_POST["num_orden_pago"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL3 = sprintf(
			"UPDATE devolucion_dinero SET num_orden_pago=%s WHERE id_devolucion_dinero=%s",
			GetSQLValueString($_POST["num_orden_pago"], "text"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result3 = mysql_query($updateSQL3, $conexion);
		echo $insertado;
		mysql_free_result($Result3);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// NUMERO BANCARIZACION
	if (
		isset($_POST["fecha_pago"]) && "" != $_POST["fecha_pago"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL3 = sprintf(
			"UPDATE devolucion_dinero SET fecha_pago=%s WHERE id_devolucion_dinero=%s",
			GetSQLValueString($_POST["fecha_pago"], "date"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result3 = mysql_query($updateSQL3, $conexion);
		echo $insertado;
		mysql_free_result($Result3);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// NUMERO BANCARIZACION
	if (
		isset($_POST["num_bancarizacion"]) && "" != $_POST["num_bancarizacion"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL3 = sprintf(
			"UPDATE devolucion_dinero SET num_bancarizacion=%s WHERE id_devolucion_dinero=%s",
			GetSQLValueString($_POST["num_bancarizacion"], "text"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result3 = mysql_query($updateSQL3, $conexion);
		echo $insertado;
		mysql_free_result($Result3);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// APROBACION PRINCIPAL
	if (
		isset($_POST["check_principal"]) && "" != $_POST["check_principal"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL4 = sprintf(
			"UPDATE devolucion_dinero SET 
			check_principal=%s,
			fecha_check_principal=%s 
			WHERE id_devolucion_dinero=%s",
			GetSQLValueString(1, "int"),
			GetSQLValueString($fechaActual, "date"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result4 = mysql_query($updateSQL4, $conexion);
		echo $insertado;
		mysql_free_result($Result4);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// APROBACION TESORERIA
	if (
		isset($_POST["check_tesoreria"]) && "" != $_POST["check_tesoreria"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL4 = sprintf(
			"UPDATE devolucion_dinero SET 
			check_tesoreria=%s,
			fecha_check_tesoreria=%s 
			WHERE id_devolucion_dinero=%s",
			GetSQLValueString(1, "int"),
			GetSQLValueString($fechaActual, "date"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result4 = mysql_query($updateSQL4, $conexion);
		echo $insertado;
		mysql_free_result($Result4);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}

	// FINALIZAR DEVOLUCION
	if (
		isset($_POST["finaliza_devolucion_dinero"]) && "" != $_POST["finaliza_devolucion_dinero"] &&
		isset($_POST["id_devolucion_dinero"]) && "" != $_POST["id_devolucion_dinero"]
	) {
		$updateSQL4 = sprintf(
			"UPDATE devolucion_dinero SET 
			finaliza_devolucion_dinero=%s
			WHERE id_devolucion_dinero=%s",
			GetSQLValueString(1, "int"),
			GetSQLValueString($_POST['id_devolucion_dinero'], "int")
		);
		$Result4 = mysql_query($updateSQL4, $conexion);
		echo $insertado;
		mysql_free_result($Result4);
		echo '<meta http-equiv="refresh" content="0;URL=./devolucion_dinero.jsp" />';
	}
?>
	<script src="../plugins/ckeditor40/ckeditor.js"></script>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3><b>Devolución de Dinero</b>
						<!-- BOTON NUEVA DEVOLUCION -->
						<?php
						if (1 == $_SESSION['rol'] || (isset($_SESSION['id_oficina_registro']) && 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 8))) { ?>
							<div class="box-tools pull-right">
								<a href="" data-toggle="modal" data-target="#nuevaDevolucionDinero">
									<button type="button" class="btn btn-success btn-xs">Nuevo</button>
								</a>
							</div>
						<?php } else {
						} ?>
					</h3><br>
					<div class="box-header with-border">
						<div class="row">
							<div class="col-md-12">

								<!-- MODAL NUEVO RADICADO DEVOLUCION -->
								<div class="modal fade bd-example-modal-lg" id="nuevaDevolucionDinero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">FORMULARIO DE DEVOLUCION DE DINERO</h4>
											</div>
											<div class="modal-body">

												<form action="" method="POST" name="for543543m1" enctype="multipart/form-data">
													<div class="row">

														<div class="col-md-6">
															<div class="form-group text-left">
																<label class="control-label"><span style="color:#ff0000;">*</span> DE:</label>
																<?php
																if (1 == $_SESSION['rol'] || 0 < $nump36 || 0 < $nump56 || 0 < $nump57 || 0 < $nump58 || 0 < $nump59 || 0 < $nump60  || 0 < $nump61) { ?>
																	<p>No pertenece a una ORIP</p>
																<?php } else { ?>
																	<p type="text" class="form-control" readonly="readonly"><?php echo quees('oficina_registro', $_SESSION['id_oficina_registro']); ?></p>
																<?php } ?>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group text-left">
																<label class="control-label"><span style="color:#ff0000;">*</span> PARA:</label>
																<input type="text" value="ARCHIVO DEVOLUCIONES" class="form-control" name="para" readonly="readonly" id="para" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="form-group text-left">
																<label class="control-label"><span style="color:#ff0000;">*</span> ASUNTO:</label>
																<input type="text" class="form-control" name="asunto_correspondencia" maxlength="250" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="form-group text-left">
																<label class="control-label"><span style="color:#ff0000;">*</span> TURNO RADICACION DOCUMENTO:</label>
																<input type="text" class="form-control" name="turno_devolucion_dinero" maxlength="255" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="form-group text-left">
																<label class="control-label"><span style="color:#ff0000;">*</span> VALOR A DEVOLVER:</label>
																<input type="text" class="form-control" name="valor_devolucion_dinero" maxlength="255" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="form-group text-left">
																<label class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN:</label>
																<textarea class="form-control" name="descripcion_correspondencia" maxlength="500" required></textarea>
															</div>
														</div>
													</div>

													<div class="modal-footer">
														<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
														<button type="submit" class="btn btn-success"><input type="hidden" name="nuevaDevolucionDeDinero" value="nuevaDevolucionDeDinero"><span class="glyphicon glyphicon-ok"></span> Guardar </button>
													</div>
												</form>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-5">
								<form class="navbar-form" name="fotertrm3252345rter1erteg" method="POST">

									<div class="input-group">
										<div class="input-group-btn">Buscar
											<select class="form-control" name="campo" required>
												<option value="" selected> - - Buscar por: - - </option>
												<option value="nombre_devolucion_dinero">Radicado</option>
												<option value="asunto_correspondencia">Asunto</option>
											</select>
										</div>
										<div class="input-group-btn">
											<input type="text" name="buscar" placeholder="Buscar" class="form-control" required>
										</div>

										<div class="input-group-btn">
											<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
										</div>
									</div>

								</form>
							</div>

							<div class="col-md-2">
								<!-- &nbsp; <a href="https://youtu.be/MfJrMjTq8h0" target="_blank"> Ver Manual</a>
								<br>
								<php if (1 == $_SESSION['rol'] or 0 < $nump36 or 0 < $nump57 or 0 < $nump58 or 0 < $nump56) { ?>
									<a href="https://sisg.supernotariado.gov.co/xls/correspondencia_cuenta_cobro.xls">Reporte completo</a>
								<php } else {
								} ?> -->
							</div>

							<div class="col-md-5">
								<?php if (1 == $_SESSION['rol'] or 0 < $nump36 or 0 < $nump57 or 0 < $nump58 or 0 < $nump56) { ?>
									<form class="navbar-form" name="formatobuscar2" method="POST">

										<div class="input-group">
											<div class="input-group-btn">Buscar
												<select class="form-control" name="campo2" required>
													<option value="" selected> - - Funcionario responsable: - - </option>
													<?php
													$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=56 OR id_perfil=57 OR id_perfil=58 OR id_perfil=59 OR id_perfil=60 OR id_perfil=61)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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
											<div class="input-group-btn">
												<button type="submit" class="btn btn-warning" name="btnbuscar2" value="1"><span class="glyphicon glyphicon-search"></span> Buscar </button>
											</div>
										</div>
									</form>
								<?php } else {
								} ?>
							</div>
						</div>
						<!-- FINAL box-tools pull-right -->
					</div>

					<style>
						/* .dataTables_filter {
							display: none;
						} */
					</style>

					<div class="box-body">
						<div class="table-responsive">
							<div style="text-align: center;"><b>Las Devoluciones que ya se tramitaron completamente, no aparecen en la sigueinte tabla. Debe Utilizar los Buscadores</b></div>
							<table class="table table-striped table-bordered table-hover" id="devolucionDinero" cellspacing="0" width="100%" style="font-size:11px;">
								<thead>
									<tr align="center" valign="middle" style="font-size:9px;">
										<th>Creación</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Oficina Registro</th>
										<th>
											Seccional<br>
											Devolucion Completa
										</th>
										<th>
											<span style="color:orange">Presupuesto</span><br>
											Vinculación Cuenta
										</th>
										<th>
											<span style="color:#3368FF">Tesoreria</span><br>
											Número Recla...
										</th>
										<th>
											<span style="color:#3368FF">Tesoreria</span><br>
											Número Soliciud
										</th>
										<th>
											<span style="color:#3368FF">Tesoreria</span><br>
											Número DXC
										</th>
										<th>
											<span style="color:green">Contabilidad</span><br>
											Acreedor <br>/ Cuenta pagar</span>
										</th>
										<th>
											<span style="color:#3368FF">Tesoreria</span><br>
											Orden Pago
										</th>
										<th>
											<span style="color:#3368FF">Tesoreria</span><br>
											Orden Bancaria
										</th>
										<th>
											<span style="color:#3368FF">Tesoreria</span><br>
											Fecha pago
										</th>
										<!-- <th>
											Anexo
										</th> -->
										<th>
											<span style="font-size:	8px;">Rechazo</span>
										</th>
										<th>
											Check
										</th>
										<th>
											Accion<span style="color:white">...............</span>
										</th>
									</tr>
								</thead>

								<tbody>

									<?php

									$si = 'Si <span class="fa fa-check" style="color:#398439"></span>';
									$no = 'No <span class="fa fa-close" style="color:#B40404"></span>';

									if (1 == $_SESSION['rol'] || 0 < $nump56) {
										// 1=SUPERADMIN, 56=Admin_Tesoreria_Devoluciones
										if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
											$infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
										} elseif (isset($_POST['campo2']) && "" != $_POST['campo2']) {
											$id_fun_res = intval($_POST['campo2']);
											$infobus = " and (id_fun_presupuesto=" . $id_fun_res . " or id_fun_contabilidad=" . $id_fun_res . " or id_fun_tesoreria=" . $id_fun_res . ") ";
										} else {
											$infobus = "AND check_principal=1 AND (doc_devolucion_completa IS NULL or doc_vinculacion_cuenta IS NULL or doc_reclasificacion IS NULL or doc_cuenta_pagar IS NULL OR doc_orden_pago IS null) AND finaliza_devolucion_dinero=0";
										}
										$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 and estado_devolucion_dinero=1 " . $infobus . " ORDER  BY id_devolucion_dinero DESC";
									} elseif (0 < $nump61) {
										// 61=Usuarios_Tesoreria_Devoluciones
										$idSnrFun = $_SESSION['snr'];
										if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
											$infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
										} else {
											$infobus = "AND check_principal=1 AND (doc_devolucion_completa IS NULL or doc_vinculacion_cuenta IS NULL or doc_reclasificacion IS NULL or doc_cuenta_pagar IS NULL OR doc_orden_pago IS null) AND finaliza_devolucion_dinero=0";
										}
										$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 
										AND id_fun_tesoreria_check=$idSnrFun
										AND estado_devolucion_dinero=1 " . $infobus . " ORDER  BY id_devolucion_dinero DESC";
									} elseif (0 < $nump36 || 0 < $nump57  || 0 < $nump58) {
										// 36=Gestionar IRIS en SISG, 57=Admin_Presupuesto_Devoluciones, 58=Admin_Contabilidad_Devoluciones
										if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
											$infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
										} elseif (isset($_POST['campo2']) && "" != $_POST['campo2']) {
											$id_fun_res = intval($_POST['campo2']);
											$infobus = " and (id_fun_presupuesto=" . $id_fun_res . " or id_fun_contabilidad=" . $id_fun_res . " or id_fun_tesoreria=" . $id_fun_res . ") ";
										} else {
											$infobus = "AND check_tesoreria=1 AND check_principal=1 AND (doc_devolucion_completa IS NULL or doc_vinculacion_cuenta IS NULL or doc_reclasificacion IS NULL or doc_cuenta_pagar IS NULL OR doc_orden_pago IS null) AND finaliza_devolucion_dinero=0";
										}
										$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 and estado_devolucion_dinero=1 " . $infobus . " ORDER  BY id_devolucion_dinero DESC";
									} elseif (0 < $nump59 || 0 < $nump60) {
										// 59=Usuarios_Presupuesto_Devoluciones, 60=Usuarios_Contabilidad_Devoluciones
										$idSnrFun = $_SESSION['snr'];
										if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
											$infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
										} else {
											$infobus = "AND check_tesoreria=1 AND check_principal=1 AND (doc_devolucion_completa IS NULL or doc_vinculacion_cuenta IS NULL or doc_reclasificacion IS NULL or doc_cuenta_pagar IS NULL OR doc_orden_pago IS null) AND finaliza_devolucion_dinero=0";
										}
										$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 
										AND (id_fun_presupuesto=$idSnrFun OR id_fun_contabilidad=$idSnrFun) 
										and estado_devolucion_dinero=1 " . $infobus . " ORDER  BY id_devolucion_dinero DESC";
									} elseif ((isset($_SESSION['id_oficina_registro']) && 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 7))) {
										// Privilegios oficina Principal
										$idOficinaPertence =  $_SESSION['id_oficina_registro'];
										$queryOfiRe = "SELECT 
										id_oficina_registro, 
										nombre_oficina_registro, 
										reporta_a AS reporta, 
										(SELECT nombre_oficina_registro 
										FROM oficina_registro 
										WHERE id_oficina_registro = reporta)
										FROM oficina_registro
										WHERE reporta_a=$idOficinaPertence AND estado_oficina_registro=1";
										$selectOfiRe = mysql_query($queryOfiRe, $conexion);
										$OfiRerow = mysql_fetch_assoc($selectOfiRe);
										$totalRowsOfiRe = mysql_num_rows($selectOfiRe);
										if (0 < $totalRowsOfiRe) {
											$array = array();
											do {
												array_push($array, $OfiRerow['id_oficina_registro']);
											} while ($OfiRerow = mysql_fetch_assoc($selectOfiRe));
											mysql_free_result($selectOfiRe);
										} else {
										}
										$idsOficinasRegistro = implode(",", $array);
										$queryIdPrincipal = "AND codigo_oficina_de IN ($idsOficinasRegistro)"; // Query Oficinas Regristro
										if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
											$infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
											$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 and estado_devolucion_dinero=1 " . $infobus . " " . $queryIdPrincipal . " ORDER  BY id_devolucion_dinero DESC";
										} else {
											$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 and estado_devolucion_dinero=1 " . $queryIdPrincipal . " ORDER BY id_devolucion_dinero DESC";
										}
									} elseif ((isset($_SESSION['id_oficina_registro']) && 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 8))) {
										// Privilegios oficina Seccional
										$idOficinaRegistro = $_SESSION['id_oficina_registro']; // Oficina Registro
										$queryIdOficinaRegis = "AND codigo_oficina_de = $idOficinaRegistro"; // Query Oficina Regristro
										if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
											$infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
											$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 and estado_devolucion_dinero=1 " . $infobus . " " . $queryIdOficinaRegis . " ORDER  BY id_devolucion_dinero DESC";
										} else {
											$query = "SELECT * FROM devolucion_dinero where id_tipo_correspondencia=308 and estado_devolucion_dinero=1 " . $queryIdOficinaRegis . " ORDER  BY id_devolucion_dinero DESC";
										}
									} else {
									}


									$select = mysql_query($query, $conexion);
									$row = mysql_fetch_assoc($select);
									$totalRows = mysql_num_rows($select);
									if (0 < $totalRows) {

										do {
											$idrad = $row['id_devolucion_dinero'];
											$radi = $row['nombre_devolucion_dinero'];
											echo '<tr><td>' . $row['fecha_correspondencia'] . '</td>';
											echo '<td>' . $radi . '<br>';
											if (isset($row['id_fun_tesoreria_check'])) { ?>
												<i style="color:#ff3333;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_tesoreria_check']); ?>"></i>&nbsp;
											<?php }
											if (isset($row['id_fun_presupuesto'])) { ?>
												<i style="color:orange;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_presupuesto']); ?>"></i>&nbsp;
											<?php }
											if (isset($row['id_fun_contabilidad'])) { ?>
												<i style="color:green;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_contabilidad']); ?>"></i>&nbsp;
											<?php }
											if (isset($row['id_fun_tesoreria'])) { ?>
												<i style="color:#3368FF;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_tesoreria']); ?>"></i>&nbsp;
											<?php
											} else {
											}

											echo '</td>';
											echo '<td style="font-size:	10px; width:200px;">' . $row['asunto_correspondencia'] . '</td>';
											?>
											<td>
												<?php echo quees('oficina_registro', $row['codigo_oficina_de']); ?>
											</td>
											<?php

											echo '<td>';
											if (1 == $row['doc_devolucion_completa']) {
												echo $si;
											} else {
												echo $no;
											}
											echo '</td>';

											echo '<td>';
											if (1 == $row['doc_vinculacion_cuenta']) {
												echo $si;
											} else {
												echo $no;
											}
											echo '</td>';

											echo '<td style="width:180px">';
											if (is_null($row['num_r_reclasificacion'])) {
												echo $no;
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Numero Reclasificación"><button class="btn btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo $si;
												echo '<br> ' . $row['num_r_reclasificacion'];
											}
											echo '</td>';

											echo '<td>';
											if (is_null($row['num_s_reclasificacion'])) {
												echo $no;
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Numero Solicitud"><button class="btn btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo $si;
												echo '<br> ' . $row['num_s_reclasificacion'];
											}
											echo '</td>';

											echo '<td>';
											if (is_null($row['num_dxc_reclasificacion'])) {
												echo $no;
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Numero DXC"><button class="btn btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo $si;
												echo '<br> ' . $row['num_dxc_reclasificacion'];
											}
											echo '</td>';

											echo '<td>';
											if (1 == $row['doc_cuenta_pagar']) {
												echo $si;
											} else {
												echo $no;
											}
											echo '</td>';

											echo '<td>';
											if (is_null($row['num_orden_pago'])) {
												echo $no;
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Numero Orden de pago"><button class="btn btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo $si;
												echo '<br> ' . $row['num_orden_pago'];
											}
											echo '</td>';

											echo '<td>';
											if (is_null($row['num_bancarizacion'])) {
												echo $no;
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Numero Bancarización"><button class="btn btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo $si;
												echo '<br> ' . $row['num_bancarizacion'];
											}
											echo '</td>';

											echo '<td>';
											if (is_null($row['fecha_pago'])) {
												echo $no;
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Fecha de Pago"><button class="btn btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo $si;
												echo '<br> ' . $row['fecha_pago'];
											}
											echo '</td>';

											// echo '<td>';
											// if (1 == $row['doc_anexo']) {
											// 	echo $si;
											// } else {
											// 	echo $no;
											// }
											// echo '</td>';

											echo '<td style="text-align: center;">';
											$query2 = "SELECT 
											COUNT(nombre_devolucion_dinero) AS contadorRechazo, 
											SUM(estado_devolucion_rechazo) AS contadorEstadoRechazo 
											FROM devolucion_rechazo WHERE nombre_devolucion_dinero = '" . $radi . "'";
											$select2 = mysql_query($query2, $conexion);
											$row2 = mysql_fetch_assoc($select2);
											if (0 == $row['finaliza_devolucion_dinero']) {
												if (0 < intval($row2['contadorRechazo']) && intval($row2['contadorRechazo']) != intval($row2['contadorEstadoRechazo'])) {
													echo ' <a href="" class="devoluciondinerorechazo" id="' . $radi . '" data-toggle="modal"data-target="#popupdevolucionrechazo" title="Rechazo"><button class="btn btn-xs btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i></i></button></a>';
												} else if (0 < intval($row2['contadorRechazo'])) {
													echo ' <a href="" class="devoluciondinerorechazo" id="' . $radi . '" data-toggle="modal"data-target="#popupdevolucionrechazo" title="Presenta Solución"><button class="btn btn-xs btn-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i></i></button></a>';
												} else if (intval($row2['contadorRechazo']) == 0) {
													echo ' <a href="" class="devoluciondinerorechazo" id="' . $radi . '" data-toggle="modal"data-target="#popupdevolucionrechazo" title="Iniciar Rechazo"><button class="btn btn-xs btn-warning"><i class="fa fa-plus" aria-hidden="true"></i></i></button></a>';
												}
											} else {
												echo ' <a href="" class="devoluciondinerorechazo" id="' . $radi . '" data-toggle="modal"data-target="#popupdevolucionrechazo" title="Ver Rechazos"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up" aria-hidden="true"></i></i></button></a>';
											}
											echo '</td>';

											echo '<td>';
											// Check Principal
											if (1 == $row['check_principal']) {
												echo 'Si <span class="fa fa-check" style="color:#398439" title="Check Principal"></span>';
											} else {
												echo 'No <span class="fa fa-close" style="color:#B40404" title="Check Principal"></span>';
												if (1 == $_SESSION['rol'] || (isset($_SESSION['id_oficina_registro']) && 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 7))) {
											?>
													<form action="" method="post" name="aprobacionPrincipal566" style="display: inline;">
														<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">
														<input type="hidden" name="check_principal" value="ok">
														<button type="submit" class="btn btn-success btn-xs">ok</button>
													</form>
												<?php
												}
											}
											echo '<br>';
											// echo '</td>';

											// echo '<td>';
											// Check Tesoreria
											if (1 == $row['check_tesoreria']) {
												echo 'Si <span class="fa fa-check" style="color:#398439" title="Check Tesoreria"></span>';
											} else {
												echo 'No <span class="fa fa-close" style="color:#B40404" title="Check Tesoreria"></span>';
												if (1 == $_SESSION['rol'] || (0 < $nump56 || 0 < $nump61)) {
												?>
													<form action="" method="post" name="aprobacionTesoreria" style="display: inline;">
														<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">
														<input type="hidden" name="check_tesoreria" value="ok">
														<button type="submit" class="btn btn-success btn-xs">ok</button>
													</form>
												<?php
												}
											}
											echo '</td>';

											echo '<td style="width:150px">';
											echo '<a name="' . $radi . '" href="" class="buscar_correspondencia" id="' . $radi . '" data-toggle="modal" data-target="#popupcorrespondencia"><img src="images/pdf.png"></a>&nbsp;';
											if (0 == $row['finaliza_devolucion_dinero']) {
												if (1 == $_SESSION['rol'] || 0 < $nump36 || 0 < $nump56 || 0 < $nump57 || 0 < $nump58 || 0 < $nump59 || 0 < $nump60  || 0 < $nump61) {
													echo '<a name="' . $radi . '" href="" class="devolucion_asigna" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevasigna" title="Asignar Cuenta"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-group"></i></button></a>';
												}
												if (1 == $_SESSION['rol'] || 0 < $nump56) {
													echo ' <a href="" class="devolucion_detalle" id="' . $idrad . '" data-toggle="modal"data-target="#modaldevoluciondetalle" title="Editar Devolución"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></i></button></a>';
												}
												if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
												?>
													<form action="" method="post" name="form_finalizar_devolucion" style="display:inline">
														<input type="hidden" name="id_devolucion_dinero" value="<?php echo $row['id_devolucion_dinero']; ?>">
														<input type="hidden" name="finaliza_devolucion_dinero" value="ok">
														<button type="submit" class="btn btn-success btn-xs"><span class="fa fa-check" title="Finalizar Devolucion"></span></button>
													</form>
									<?php
												}
											} else {
												echo '<button type="submit" class="btn btn-defult btn-xs">Finalizado</button>';
											}
											echo '</td>';
											echo '</tr>';
										} while ($row = mysql_fetch_assoc($select));
										mysql_free_result($select);
									} else {
									}
									?>
								</tbody>

							</table>
							<script>
								$(document).ready(function() {
									$('#devolucionDinero').DataTable({
										dom: 'Bfrtip',
										buttons: [
											'excelHtml5'
										],
										"lengthMenu": [
											[50, 100, 200, 300, 500],
											[50, 100, 200, 300, 500]
										],
										"language": {
											"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
										},
										"aaSorting": [
											[1, "desc"]
										]
									});
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL RECHAZO -->
	<div class="modal fade bd-example-modal-lg" id="popupdevolucionrechazo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
					<h4 class="modal-title" id="myModalLabel"><label class="control-label">Devolución Dinero | Rechazo</label> <span id="radicor"></span></h4>
				</div>
				<div class="ver_devolucion_dinero_rechazo" class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
					<h4 class="modal-title" id="myModalLabel"><label class="control-label">Correspondencia</label> <span id="radicor"></span></h4>
				</div>
				<div class="ver_correspondencia" class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modaldevasigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
					<h4 class="modal-title" id="myModalLabel"><label class="control-label">Correspondencia</label> <span id="asigna"></span></h4>
				</div>
				<div class="ver_devolucion_asigna" class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<!-- MODAL DEVOLUCION DETALLE -->
	<div class="modal fade bd-example-modal-md" id="modaldevoluciondetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
					<h4 class="modal-title" id="myModalLabel"><label class="control-label">Formulario</label></h4>
				</div>
				<div class="ver_devolucion_detalle" class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<style>
		.rojo {
			color: #ff0000;
		}
	</style>

<?php
}
?>