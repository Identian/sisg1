<?php
// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");
$idFuncionario = $_SESSION['snr'];
if (1 == $_SESSION['snr_grupo_cargo']) {
    $autorizaJefe = 1;
    $idGrupoArea = $_SESSION['snr_grupo_area'];
    $buscarIdArea = buscarcampo('grupo_area', 'id_area', 'id_grupo_area=' . $idGrupoArea);
} else {
    $autorizaJefe = 0;
    $idGrupoArea = 0;
    $buscarIdArea = 0;
}

$nump100 = privilegios(100, $_SESSION['snr']); // Comision Admin
$nump101 = privilegios(101, $_SESSION['snr']); // Comision Revisor 
$nump166 = privilegios(166, $_SESSION['snr']); // Comision Aprobo
$nump120 = privilegios(120, $_SESSION['snr']); // Comision Usuario Tiquetes

$nump173 = privilegios(173, $_SESSION['snr']); // Comision Admin Presupuesto
$nump162 = privilegios(162, $_SESSION['snr']); // Comision Usuario Presupuesto

$nump174 = privilegios(174, $_SESSION['snr']); // Comision Admin Contabilidad
$nump163 = privilegios(163, $_SESSION['snr']); // Comision Usuario Contabilidad

$nump175 = privilegios(175, $_SESSION['snr']); // Comision Admin Tesoreria
$nump164 = privilegios(164, $_SESSION['snr']); // Comision Usuario Tesoreria

isset($_GET['i']) && "" != $_GET['i'] ? $id = $_GET['i'] : $id = 0;

// VALIDACION DE SEGURIDAD
$buscarIdArea = buscarcampo('comision', 'fk_id_area_crea', 'estado_comision=1 AND id_comision=' . $id);
$permisoGeneral = buscarcampo('comision', 'fk_id_funcionario_crea', 'estado_comision=1 AND id_comision=' . $id);

// VALIDACION GENERAL DE INGRESO
1 == $_SESSION['rol'] || 0 < $nump100 || 0 < $nump101 || 0 < $nump166 || 0 < $nump120 || 0 < $nump162 || 0 < $nump163 || 0 < $nump164 || 0 < $nump173 || 0 < $nump174 || 0 < $nump175 ||
    ((1 == $_SESSION['snr_grupo_cargo'] || 2 == $_SESSION['snr_grupo_cargo']) && $buscarIdArea == $buscarIdArea) ||
    isset($permisoGeneral) && $permisoGeneral == $idFuncionario
    ?: exit;

// ESTADO GENERAL
$estadoGeneral = buscarcampo('comision', 'estado', "id_comision='$id' AND estado_comision=1");

// GUARDAR NUEVO COMISIONADO 
if (
    isset($_POST["guardarComisionado"]) && '' != $_POST["guardarComisionado"] &&
    isset($_POST["fecha_ida"]) && '' != $_POST["fecha_ida"] &&
    isset($_POST["fecha_regreso"]) && '' != $_POST["fecha_regreso"] &&
    isset($_POST["id_funcionario"]) && '' != $_POST["id_funcionario"] &&
    isset($_POST["objeto"]) && '' != $_POST["objeto"]
) {
    $flatError = 0;

    // VALIDA QUE SEA POSTERIOR A HOY
    $fechaNueva = date("Y-m-d");
    if ($_POST["fecha_ida"] < $fechaNueva) {
        $flatError = 1;
        echo sweetAlert('ADVERTENCIA', 'La fecha no puede ser anterior a la actual.', 'warning');
    }

    // VALIDA QUE REGRESO SEA POSTERIOR A IDA
    if ($_POST["fecha_ida"] > $_POST["fecha_regreso"]) {
        $flatError = 1;
        echo sweetAlert('ADVERTENCIA', 'La fecha de regreso debe ser posterior a la fecha de ida.', 'warning');
    }

    // VALIDA QUE NO PASE DE 27 DIAS COMISION
    $diasComisionCalculo = calcularDiferenciaDias($_POST["fecha_regreso"], $_POST["fecha_ida"]);
    if ($diasComisionCalculo > 28) {
        $flatError = 1;
        echo sweetAlert('ADVERTENCIA', 'La duración máxima de una comisión es de 27 días.', 'warning');
    }

    // Consulta funcionario contratista
    $idFuncionario = $_POST["id_funcionario"];
    $query1 = "SELECT id_cargo FROM funcionario WHERE id_funcionario=$idFuncionario";
    $result1 = $mysqli->query($query1);
    $row1 = $result1->fetch_assoc();

    if ($flatError == 0 && 1 == $row1['id_cargo'] || 2 == $row1['id_cargo'] || 4 == $row1['id_cargo'] || 5 == $row1['id_cargo']) {
        $idCargo = $row1['id_cargo'];
    } else {
        echo sweetAlert('ADVERTENCIA', 'Asegurarse de que la persona sea un funcionario o contratista y volver a verificar su número de cédula.', 'warning');
        $idCargo = 0;
    }

    // jefe, coordinador, funcionario
    if (1 == $idCargo || 2 == $idCargo || 4 == $idCargo && $flatError == 0) {
        // consulta nombre cargo, cod cargo, grupo cargo nomina, salario, grupo-dependencia
        $query2 = "SELECT funcionario.nombre_funcionario AS nombre,
            funcionario.id_funcionario AS idFuncionario,
            funcionario.cedula_funcionario AS cedula,
            cargo_nomina.nombre_cargo_nomina AS nombreCargo,
            cargo_nomina.cod_cargo_nomina AS codCargo,
            cargo_nomina.grado_cargo_nomina AS gradoCargo,
            salario_nomina.nombre_salario_nomina AS valorSalario,
            salario_nomina.valor_dia_comision AS valorDiaComision,
            grupo_area.nombre_grupo_area AS nombreArea
            FROM funcionario, cargo_nomina, salario_nomina, grupo_area 
            WHERE cargo_nomina.id_cargo_nomina=funcionario.id_cargo_nomina_encargo
            AND salario_nomina.id_salario_nomina=cargo_nomina.id_cargo_nomina AND salario_nomina.ano_salario_nomina=$anoActual AND salario_nomina.estado_salario_nomina=1
            AND grupo_area.id_grupo_area=funcionario.id_grupo_area
            AND funcionario.id_funcionario=$idFuncionario  LIMIT 1";
        $result2 = $mysqli->query($query2);
        $row2 = $result2->fetch_assoc();
        // Funcionario
        if (
            isset($row2['nombre']) && '' != $row2['nombre'] &&
            isset($row2['cedula']) && '' != $row2['cedula'] &&
            isset($row2['nombreCargo']) && '' != $row2['nombreCargo'] &&
            isset($row2['valorSalario']) && '' != $row2['valorSalario'] &&
            isset($row2['valorDiaComision']) && '' != $row2['valorDiaComision'] &&
            isset($row2['nombreArea']) && '' != $row2['nombreArea']
        ) {
            $datos = array(
                "id_comision" => $_POST["id_comision"],
                "nombre_comision_detalle" => $row2['nombre'],
                "id_funcionario" => $row2['idFuncionario'],
                "cedula" => $row2['cedula'],
                "cargo_perfil" => $row2['nombreCargo'] . ' - Codigo ' . $row2['codCargo'] . ' - Grado ' . $row2['gradoCargo'],
                "dia_comision" => $row2['valorDiaComision'],
                "salario" => $row2['valorSalario'],
                "dependencia" => $row2['nombreArea'],
                "fecha_ida" => $_POST["fecha_ida"],
                "fecha_regreso" => $_POST["fecha_regreso"],
                "objeto" => $_POST["objeto"],
                "observacion" => $_POST["observacion"]
            );
            // INSERT 
            if ("insertComisionado" == $_POST["guardarComisionado"]) {
                if (insertarDatos($mysqli, "comision_detalle", $datos)) {
                    sweetAlert('OK', 'Registrado Correctamente.', 'success');
                } else {
                    echo "Error en la inserción del comisionado";
                }
            }
            // UPDATE
            if ("updateComisionado" == $_POST["guardarComisionado"]) {
                $idComisionado = $_POST["id_comision_detalle"];
                if (actualizarDatos($mysqli, "comision_detalle", $datos, "id_comision_detalle=$idComisionado LIMIT 1")) {
                    sweetAlert('OK', 'Actualizado Correctamente.', 'success');
                } else {
                    echo "Error al actualizar datos.";
                }
            }
        } else {
            sweetAlert('ADVERTENCIA', 'El funcionario debe registrar su cargo, salario y grupo de área antes de poder iniciar una comisión.', 'warning');
        }
    } elseif (5 == $idCargo && $flatError == 0) {
        // CONTRATISTA consulta perfil
        $query3 = "SELECT funcionario.nombre_funcionario AS nombreContratista,
            funcionario.id_funcionario AS idFuncionario,
            funcionario.cedula_funcionario AS cedulaContratista,
            nc_cargo.nombre_nc_cargo AS perfilContratista,
            nc_salario.nombre_nc_salario AS salaraioContratista,
            nc_salario.valor_dia_comision AS valorDiaComision,
            grupo_area.nombre_grupo_area AS nombreAreaContratista
            FROM funcionario, nc_contratos, nc_salario, nc_cargo, grupo_area
            WHERE funcionario.id_funcionario=nc_contratos.id_funcionario
            AND nc_contratos.id_nc_salario=nc_salario.id_nc_salario AND nc_salario.ano_nc_salario=$anoActual AND nc_salario.estado_nc_salario=1
            AND nc_salario.id_nc_cargo=nc_cargo.id_nc_cargo
            AND grupo_area.id_grupo_area=funcionario.id_grupo_area
            AND funcionario.id_funcionario=$idFuncionario LIMIT 1";
        $result3 = $mysqli->query($query3);
        $row3 = $result3->fetch_assoc();
        // Contratista
        if (
            isset($row3['nombreContratista']) && '' != $row3['nombreContratista'] &&
            isset($row3['cedulaContratista']) && '' != $row3['cedulaContratista'] &&
            isset($row3['perfilContratista']) && '' != $row3['perfilContratista'] &&
            isset($row3['salaraioContratista']) && '' != $row3['salaraioContratista'] &&
            isset($row3['valorDiaComision']) && '' != $row3['valorDiaComision'] &&
            isset($row3['nombreAreaContratista']) && '' != $row3['nombreAreaContratista']
        ) {
            $datos = array(
                "id_comision" => $_POST["id_comision"],
                "nombre_comision_detalle" => $row3['nombreContratista'],
                "id_funcionario" => $row3['idFuncionario'],
                "cedula" => $row3['cedulaContratista'],
                "cargo_perfil" => $row3['perfilContratista'],
                "dia_comision" => $row3['valorDiaComision'],
                "salario" => $row3['salaraioContratista'],
                "dependencia" => $row3['nombreAreaContratista'],
                "fecha_ida" => $_POST["fecha_ida"],
                "fecha_regreso" => $_POST["fecha_regreso"],
                "objeto" => $_POST["objeto"],
                "observacion" => $_POST["observacion"]
            );
            // INSERT 
            if ("insertComisionado" == $_POST["guardarComisionado"]) {
                if (insertarDatos($mysqli, "comision_detalle", $datos)) {
                    sweetAlert('OK', 'Registrado Correctamente.', 'success');
                } else {
                    echo "Error en la inserción del comisionado";
                }
            }
            // UPDATE
            if ("updateComisionado" == $_POST["guardarComisionado"]) {
                $idComisionado = $_POST["id_comision_detalle"];
                if (actualizarDatos($mysqli, "comision_detalle", $datos, "id_comision_detalle=$idComisionado LIMIT 1")) {
                    sweetAlert('OK', 'Actualizado Correctamente.', 'success');
                } else {
                    echo "Error al actualizar datos.";
                }
            }
        } else {
            sweetAlert('ADVERTENCIA', 'El contratista debe registrar su perfil, salario y grupo de área antes de poder iniciar una comisión.', 'warning');
        }
    }
}

// GUARDAR NUEVO TRAMO
if (
    isset($_POST["guardarNuevoTramo"]) && '' != $_POST["guardarNuevoTramo"] &&
    isset($_POST["fk_id_comision_detalle"]) && '' != $_POST["fk_id_comision_detalle"] &&
    isset($_POST["desde_id_municipio"]) && '' != $_POST["desde_id_municipio"] &&
    isset($_POST["hasta_id_municipio"]) && '' != $_POST["hasta_id_municipio"] &&
    isset($_POST["medio_transporte"]) && '' != $_POST["medio_transporte"]
) {
    $datos = array(
        "fk_id_comision_detalle" => $_POST["fk_id_comision_detalle"],
        "desde_id_municipio" => $_POST['desde_id_municipio'],
        "hasta_id_municipio" => $_POST['hasta_id_municipio'],
        "medio_transporte" => $_POST['medio_transporte'],
        "centro_costos" => $_POST['centro_costos'],
        "centro_costos_viaticos" => $_POST['centro_costos_viaticos']
    );
    if (insertarDatos($mysqli, "comision_detalle_tramo", $datos)) {
        sweetAlert('OK', 'Registrado Correctamente.', 'success');
    } else {
        echo "Error en la inserción del tramo";
    }
}

// GUARDAR NUEVO DOCUMENTO
if (
    isset($_POST["guardarDocumentoComision"]) && '' != $_POST["guardarDocumentoComision"] &&
    isset($_FILES['file_comision']) && '' != $_FILES['file_comision']
) {
    // FUNCION GLOBAL PARA GUARDAR FILES
    $fileP = $_FILES['file_comision'];
    $fileName = uniqid() . date("YmdGis");
    $hashName = date("YmdGis") . uniqid();
    $nombreArchivo = $fileP['name'];
    $extension = strtolower(pathinfo(basename($fileP['name']), PATHINFO_EXTENSION));
    $tipoArchivoPermitido = array("pdf");

    // cargarDocumentoIris('SNR2023IE012200','filesnr/comision/' . $anoActual . '/' . $fileName .'.pdf', $conexionpostgres);
    // exit;
    $cargarPDF = uploadFileGlobal($fileP, 'filesnr/comision/' . $anoActual . '/', $fileName, $tipoArchivoPermitido, 10);

    if (isset($cargarPDF) && '' != $cargarPDF) {
        $datos = array(
            "nombre_comision_documento" => $_POST["nombre_comision_documento"],
            "ano_comision_documento" => $anoActual,
            "id_comision" => $_POST['id_comision'],
            "url_documento" => $fileName . '.' . $extension,
            "hash_documento" => $hashName,
            "observacion_documento" => $_POST["observacion_documento"],
            "fecha" => $fechaActual
        );
        if (insertarDatos($mysqli, "comision_documento", $datos)) {
            sweetAlert('OK', 'Registrado Correctamente.', 'success');
        } else {
            echo "Error en la inserción del tramo";
        }

        // ACTUALIZA ESTADO SI SUBSANA
        if ('Subsanado' == $_POST["nombre_comision_documento"]) {
            $idComisionSubsanado = $_POST["id_comision"];
            $queryUpdate = "UPDATE comision SET estado='Subsanado' WHERE id_comision=" . $idComisionSubsanado . " limit 1";
            $resultUpdate = $mysqli->query($queryUpdate);
            $datos = array(
                "nombre_comision_autorizacion" => 'Subsanado',
                "fk_id_comision" => $id,
                "fk_id_funcionario" => $idFuncionario,
                "fecha" => $fechaActual
            );
            if (insertarDatos($mysqli, "comision_autorizacion", $datos)) {
                sweetAlert('OK', 'Actualizado Correctamente.', 'success');
            } else {
                echo 'erro';
            }
        }

        // ACTUALIZA EL FUNCIONARIO EN CAMPO PAGO PRESUPUESTO
        if ('Presupuesto' == $_POST["nombre_comision_documento"]) {
            $idComisionPago = $_POST["id_comision"];
            $queryUpdate = "UPDATE comision SET pago_presupuesto=$idFuncionario WHERE id_comision=" . $idComisionPago . " limit 1";
            $resultUpdate = $mysqli->query($queryUpdate);
        }

        // ACTUALIZA EL FUNCIONARIO EN CAMPO PAGO CONTABILIDAD
        if ('Contabilidad' == $_POST["nombre_comision_documento"]) {
            $idComisionPago = $_POST["id_comision"];
            $queryUpdate = "UPDATE comision SET pago_contabilidad=$idFuncionario WHERE id_comision=" . $idComisionPago . " limit 1";
            $resultUpdate = $mysqli->query($queryUpdate);
        }

        // ACTUALIZA EL FUNCIONARIO EN CAMPO PAGO TESORERIA
        if ('Tesoreria' == $_POST["nombre_comision_documento"]) {
            $idComisionPago = $_POST["id_comision"];
            $queryUpdate = "UPDATE comision SET pago_tesoreria=$idFuncionario WHERE id_comision=" . $idComisionPago . " limit 1";
            $resultUpdate = $mysqli->query($queryUpdate);
        }
    }
}

// BORRAR DOCUMENTOS
if (
    isset($_POST['id_comision_documento']) && "" != $_POST['id_comision_documento'] &&
    isset($_POST['btnBorrarDoc']) && "" != $_POST['btnBorrarDoc']
) {
    $idDoc = $_POST['id_comision_documento'];
    $datos = array(
        "estado_comision_documento" => 0
    );
    if (actualizarDatos($mysqli, "comision_documento", $datos, "id_comision_documento=$idDoc LIMIT 1")) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error al actualizar datos.";
    }
}

// BORRAR COMISIONADO
if (isset($_POST['id_comision_detalle']) and "" != $_POST['id_comision_detalle'] and isset($_POST['btnBorrarComisionado']) and "" != $_POST['btnBorrarComisionado']) {
    $idComision = $_POST['id_comision_detalle'];
    $queryUpdate = "UPDATE comision_detalle SET estado_comision_detalle=0 WHERE id_comision_detalle=" . $idComision . " limit 1";
    $resultUpdate = $mysqli->query($queryUpdate);
    $queryUpdate2 = "UPDATE comision_detalle_tramo SET estado_comision_detalle_tramo=0 WHERE fk_id_comision_detalle=" . $idComision . "";
    $resultUpdate2 = $mysqli->query($queryUpdate2);
}

// BORRAR TRAMOS
if (isset($_POST['id_comision_detalle_tramo']) and "" != $_POST['id_comision_detalle_tramo'] and isset($_POST['btnBorrarTramo']) and "" != $_POST['btnBorrarTramo']) {
    $idTramo = $_POST['id_comision_detalle_tramo'];
    $queryUpdate = "UPDATE comision_detalle_tramo SET estado_comision_detalle_tramo=0 WHERE id_comision_detalle_tramo=" . $idTramo . " limit 1";
    $resultUpdate = $mysqli->query($queryUpdate);
}


// GUARDAR RECHAZO
if (isset($_POST["guardarRechazo"]) && '' != $_POST["guardarRechazo"]) {
    $idFuncionarioCrea = buscarcampo('comision', 'fk_id_funcionario_crea', "id_comision='$id' LIMIT 1");
    $emailur2 = buscarcampo('funcionario', 'correo_funcionario', "id_funcionario='$idFuncionarioCrea' LIMIT 1");
    if (isset($emailur2)) {
        $datos = array(
            "id_comision" => $_POST["id_comision"],
            "id_funcionario" => $idFuncionario,
            "correo_comision_rechazo" => $emailur2,
            "cuerpo_comision_rechazo" => $_POST["cuerpo_comision_rechazo"],
            "fecha_comision_rechazo" => $fechaActual
        );
        if (insertarDatos($mysqli, "comision_rechazo", $datos)) {
            $idComisionRechazo = $_POST["id_comision"];
            $datos = array(
                "estado" => 'Rechazo'
            );
            if (actualizarDatos($mysqli, "comision", $datos, "id_comision=$idComisionRechazo LIMIT 1")) {
                $datos = array(
                    "nombre_comision_autorizacion" => 'Rechazo',
                    "fk_id_comision" => $id,
                    "fk_id_funcionario" => $idFuncionario,
                    "fecha" => $fechaActual
                );
                if (insertarDatos($mysqli, "comision_autorizacion", $datos)) {
                    sweetAlert('OK', 'Actualizado Correctamente.', 'success');
                } else {
                    echo 'erro';
                }
            } else {
                echo "Error al actualizar datos.";
            }
        } else {
            echo "Error en la inserción";
        }

        $subject = 'RECHAZO DE COMISION';
        $cuerpo2 = '';
        $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
        $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha RECHAZADO la comision por el siguiente motivo.<br><br>';
        $cuerpo2 .= $_POST["cuerpo_comision_rechazo"] . '<br>';
        $cuerpo2 .= "<br><br>";
        $cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
        $cuerpo2 .= "<br></div><br></div>";
        $cabeceras = '';
        $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
        $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
        $cabeceras .= "MIME-Version: 1.0\r\n";
        $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($emailur2, $subject, $cuerpo2, $cabeceras);
    } else {
        sweetAlert('Alerta', 'No podemos rechazarlo debido a la falta de una dirección de correo electrónico para notificación.', 'warning');
    }
}

// ACTUALIZAR CAMPO DE MEDIO DE TRANSPORTE
if (
    isset($_POST["btnActualizarMedioTransporte"]) && '' != $_POST["btnActualizarMedioTransporte"] &&
    isset($_POST["id_comision_detalle_tramo"]) && '' != $_POST["id_comision_detalle_tramo"] &&
    isset($_POST["medio_transporte"]) && '' != $_POST["medio_transporte"] &&
    isset($_POST["centro_costos"]) && '' != $_POST["centro_costos"] &&
    isset($_POST["centro_costos_viaticos"]) && '' != $_POST["centro_costos_viaticos"]
) {
    $id = $_POST["id_comision_detalle_tramo"];
    if ('Aereo' == $_POST["medio_transporte"]) {
        $datos = array(
            "medio_transporte" => $_POST["medio_transporte"],
            "centro_costos" => $_POST["centro_costos"],
            "centro_costos_viaticos" => $_POST["centro_costos_viaticos"]
        );
    } else {
        $datos = array(
            "medio_transporte" => $_POST["medio_transporte"],
            "centro_costos" => 0,
            "centro_costos_viaticos" => 0
        );
    }
    if (actualizarDatos($mysqli, "comision_detalle_tramo", $datos, "id_comision_detalle_tramo=$id LIMIT 1")) {
        sweetAlert('OK', 'Actualizado Correctamente.', 'success');
    } else {
        echo "Error al actualizar datos.";
    }
}

// ESTADO GENERAL COMISION
if (isset($_POST["btnGuardarEstadoComision"]) && '' != $_POST["btnGuardarEstadoComision"] && isset($_POST["estado"]) && '' != $_POST["estado"]) {
    $datos = array(
        "estado" => $_POST["estado"]
    );
    if (actualizarDatos($mysqli, "comision", $datos, "id_comision=$id LIMIT 1")) {
        $datos = array(
            "nombre_comision_autorizacion" => $_POST["estado"],
            "fk_id_comision" => $id,
            "fk_id_funcionario" => $idFuncionario,
            "fecha" => $fechaActual
        );
        if (insertarDatos($mysqli, "comision_autorizacion", $datos)) {
            if ('Presupuesto' == $estadoGeneral && (0 < $nump173 || 0 < $nump162)) {
                $queryUpdate = "UPDATE comision SET pago_contabilidad=$idFuncionario WHERE id_comision=" . $id . " limit 1";
                $resultUpdate = $mysqli->query($queryUpdate);
            }
            sweetAlert('OK', 'Actualizado Correctamente.', 'success');
            echo '<meta http-equiv="refresh" content="0;URL=./comision_detalle&' . $id . '.jsp" />';
        } else {
            echo 'erro';
        }
    } else {
        echo "Error al actualizar datos.";
    }
}
?>
<style>
    .col-md-12 {
        margin-bottom: 20px;
    }

    .col-md-6 {
        margin-bottom: 20px;
    }

    .modal50 {
        width: 50%;
    }

    .sinMarginPadding {
        margin: 0px;
        padding: 0px;
    }

    .divscroll {
        overflow-y: scroll;
        height: 250px;
    }

    .divscrollx {
        overflow-x: scroll;
    }

    .divscrollTramos {
        overflow-y: scroll;
        height: 270px;
    }
</style>
<div class="row">
    <div class="col-md-9">
        <div class="box box-default">
            <div class="box-header with-border">
                <b>Información Inicial</b>
                <div class="box-tools pull-right">
                    <a href="comision.jsp" class="btn btn-default btn-xs" title="Regreso a Tablero Expedientes">Regresar</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $queryc = "SELECT * FROM comision WHERE id_comision = $id";
                $resultc = $mysqli->query($queryc);
                $rowc = $resultc->fetch_array(MYSQLI_ASSOC); ?>

                <div class="col-md-12">
                    <strong> Radicado Iris: </strong>
                    <span class="text-muted"> <?php echo $rowc['radicado_iris'] ? $rowc['radicado_iris'] : ''; ?> </span>
                    <br><br>
                    <strong> Estado: </strong>
                    <span class="text-muted"> <?php echo $rowc['estado'] ? $rowc['estado'] : ''; ?> </span>

                    <?php if (1 == $_SESSION['rol'] || (('Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100)) { ?>
                        <br><br>
                        <strong> Radicado Siif: </strong>
                        <div class="input-group col-md-2">
                            <input type="number" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowc['radicado_siif']; ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-xs" onclick="modalCloseEstadosComision(
                            '<?php echo $CampoFrom; ?>',
                            '<?php echo encrypt('comision-radicado_siif-id_comision-' . $id . '', cs()); ?>')">
                                    <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                                </button>
                            </span>
                        </div>
                    <?php } else { ?>
                        <br><br>
                        <strong> Radicado Siif: </strong>
                        <span class="text-muted"> <?php echo $rowc['radicado_siif'] ? $rowc['radicado_siif'] : ''; ?> </span>
                    <?php } ?>
                </div>
                <?php $resultc->free(); ?>
            </div>
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <b>Comisionados</b>
                <div class="box-tools pull-right">
                    <?php
                    if (
                        1 == $_SESSION['rol'] ||
                        (('Autorizo' == $estadoGeneral || 'Reviso' == $estadoGeneral || 'Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100) ||
                        (2 == $_SESSION['snr_grupo_cargo'] && ('Creado' == $estadoGeneral || 'Rechazo' == $estadoGeneral))
                    ) { ?>
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createNuevoComisionado"><i class="fa fa-fw fa-user-plus"></i> Nuevo Comisionado</button>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
                $query5 = "SELECT * FROM comision_detalle WHERE id_comision=$id AND estado_comision_detalle=1";
                $result5 = $mysqli->query($query5);
                while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) { ?>
                    <div class="row" style="font-size:90%; margin:5px; text-align: justify;">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background: #CCC;">
                                    <th>Comisionado</th>
                                    <th>Cedula</th>
                                    <th>Cargo o Perfil</th>
                                    <th>Dependencia</th>
                                    <th>Ida_Regreso</th>
                                    <th>Dias</th>
                                    <th>Objeto</th>
                                    <th>Observacion</th>
                                    <th style="width: 70px;">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo isset($row5['nombre_comision_detalle']) ? $row5['nombre_comision_detalle'] : ''; ?></td>
                                    <td><?php echo isset($row5['cedula']) ? $row5['cedula'] : ''; ?></td>
                                    <td><?php echo isset($row5['cargo_perfil']) ? $row5['cargo_perfil'] : ''; ?></td>
                                    <td><?php echo isset($row5['dependencia']) ? $row5['dependencia'] : ''; ?></td>
                                    <td><?php echo isset($row5['fecha_ida']) && isset($row5['fecha_regreso']) ? $row5['fecha_ida'] . '  ' . $row5['fecha_regreso'] : ''; ?></td>
                                    <td><?php echo isset($row5['fecha_ida']) && isset($row5['fecha_regreso']) ? datecomision($row5['fecha_ida'], $row5['fecha_regreso']) : ''; ?></td>
                                    <td><?php echo isset($row5['objeto']) ? $row5['objeto'] : ''; ?></td>
                                    <td><?php echo isset($row5['observacion']) ? $row5['observacion'] : ''; ?></td>
                                    <td>
                                        <?php if (
                                            1 == $_SESSION['rol'] ||
                                            (('Autorizo' == $estadoGeneral || 'Reviso' == $estadoGeneral || 'Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100) ||
                                            (('Creado' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo'])
                                        ) { ?>
                                            <a style="cursor:pointer;" class="tramosComision btn btn-warning btn-xs" data-toggle="modal" data-target="#modalTramosComision" id="actualizarComisionado-<?php echo $row5['id_comision_detalle']; ?>">
                                                <span class="fa fa-fw fa-pencil" title="Actualizar Comisionado"></span>
                                            </a>
                                            <form action="" method="POST" name="btnBorrarComisionado" style="display: inline;">
                                                <input type="hidden" name="id_comision_detalle" value="<?php echo $row5['id_comision_detalle']; ?>">
                                                <button type="submit" class="btn btn-danger btn-xs" name="btnBorrarComisionado" value="borrar" title="Borrar Comisionado"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <label>Tramos del Comisionado</label>
                            <div class="pull-right">
                                <?php if (
                                    1 == $_SESSION['rol'] ||
                                    (('Autorizo' == $estadoGeneral || 'Reviso' == $estadoGeneral || 'Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100) ||
                                    (('Creado' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo'])
                                ) { ?>
                                    <a style="cursor:pointer;" class="tramosComision btn btn-success btn-xs" data-toggle="modal" data-target="#modalTramosComision" id="nuevoTramo-<?php echo $row5['id_comision_detalle']; ?>">
                                        <i class="fa fa-fw fa-map-marker" title="Nuevo Tramo"></i>Nuevo Tramo
                                    </a>
                                <?php } ?>
                            </div>
                            <thead>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Medio</th>
                                <th>Centro Costos Viaticos</th>
                                <th>Centro Costos Tiquetes</th>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump100) { ?>
                                    <th title="Valor del Transporte">Transporte</th>
                                <?php } ?>
                                <th>Accion</th>
                            </thead>
                            <tbody>
                                <?php $idComisionDetalle = $row5['id_comision_detalle'];
                                $query6 = "SELECT * FROM comision_detalle_tramo WHERE fk_id_comision_detalle=$idComisionDetalle AND estado_comision_detalle_tramo=1";
                                $result6 = $mysqli->query($query6);
                                while ($row6 = $result6->fetch_array(MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo isset($row6['desde_id_municipio']) ? quees('municipio', $row6['desde_id_municipio']) : ''; ?></td>
                                        <td><?php echo isset($row6['hasta_id_municipio']) ? quees('municipio', $row6['hasta_id_municipio']) : ''; ?></td>
                                        <td><?php echo isset($row6['medio_transporte']) ? $row6['medio_transporte'] : ''; ?></td>
                                        <td><?php echo isset($row6['centro_costos']) ? quees('comision_centro_costos', $row6['centro_costos']) : ''; ?></td>
                                        <td><?php echo isset($row6['centro_costos_viaticos']) ? quees('comision_centro_costos', $row6['centro_costos_viaticos']) : ''; ?></td>
                                        <?php if (1 == $_SESSION['rol'] || 0 < $nump100) { ?>
                                            <td><?php echo isset($row6['valor_trasporte']) ? '$ ' . number_format($row6['valor_trasporte'], 0, ',', '.') : ''; ?></td>
                                        <?php } ?>
                                        <td>
                                            <?php if (
                                                1 == $_SESSION['rol'] ||
                                                (('Autorizo' == $estadoGeneral || 'Reviso' == $estadoGeneral || 'Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100) ||
                                                (('Creado' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo'])
                                            ) { ?>
                                                <a style="cursor:pointer;" class="tramosComision btn btn-warning btn-xs" data-toggle="modal" data-target="#modalTramosComision" id="editarTramo-<?php echo $row6['id_comision_detalle_tramo']; ?>">
                                                    <span class="fa fa-fw fa-pencil" title="Actualizar Tramo"></span>
                                                </a>
                                                <form action="" method="POST" name="btnBorrarTramo" style="display: inline;">
                                                    <input type="hidden" name="id_comision_detalle_tramo" value="<?php echo $row6['id_comision_detalle_tramo']; ?>">
                                                    <button class="btn btn-danger btn-xs" type="submit" name="btnBorrarTramo" value="borrar" title="Borrar Tramo"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                                $result6->free() ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                <?php }
                $result5->free() ?>
            </div>
        </div>

    </div>
    <div class="col-md-3">

        <!-- ADJUNTOS -->
        <div class="box box-info divscroll">
            <div class="box-header with-border">
                <b>Documentos</b>
                <div class="box-tools pull-right">
                    <?php if (
                        1 == $_SESSION['rol'] ||
                        (('Autorizo' == $estadoGeneral || 'Reviso' == $estadoGeneral || 'Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100) ||
                        (('Creado' == $estadoGeneral || 'Solicito' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo']) ||
                        ('Reviso' == $estadoGeneral && 0 < $nump101) ||
                        ('Reviso Financiera' == $estadoGeneral && 0 < $nump166) ||
                        ('Presupuesto' == $estadoGeneral && (0 < $nump173 || 0 < $nump162)) ||
                        ('Contabilidad' == $estadoGeneral && (0 < $nump174 || 0 < $nump163)) ||
                        ('Tesoreria' == $estadoGeneral && (0 < $nump175 || 0 < $nump164))
                    ) { ?>
                        <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalNuevoDocComision" title="Nuevo Documento"><span class="fa fa-fw fa-plus"></span></button>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $query6 = "SELECT * FROM comision_documento 
                WHERE id_comision=$id AND estado_comision_documento=1 ORDER BY fecha DESC";
                $result6 = $mysqli->query($query6);
                while ($row6 = $result6->fetch_assoc()) {
                    if (1 == $_SESSION['rol']) { ?>
                        <div style="border-top: solid 1px #D2D6DE; border-bottom: solid 1px #D2D6DE;">
                            <a href="filesnr/comision/<?php echo $row6['ano_comision_documento']; ?>/<?php echo $row6['url_documento']; ?>" target="_blank"><img src="images/pdf.png" alt="" style="width:15px;"><?php echo $row6['nombre_comision_documento']; ?></a>
                            <?php echo $row6['fecha']; ?>
                            <a href="filesnr/comision/<?php echo $row6['ano_comision_documento']; ?>/<?php echo $row6['url_documento']; ?>" download="<?php echo $row6['nombre_comision_documento']; ?>.pdf" title="Descargar"> <i class="fa fa-fw fa-download" style="color: red;"></i> </a>
                            <form action="" method="POST" name="comisiondocumentoeliminar" style="display: inline;">
                                <input type="hidden" name="id_comision_documento" value="<?php echo $row6['id_comision_documento']; ?>">
                                <button style="border:none; background:white;" type="submit" name="btnBorrarDoc" value="btnBorrarDoc"><i class="fa fa-trash-o"></i></button>
                            </form><br>
                            <?php echo isset($row6['observacion_documento']) ? $row6['observacion_documento'] : ''; ?>
                        </div>
                    <?php } else { ?>
                        <a href="filesnr/comision/<?php echo $row6['ano_comision_documento']; ?>/<?php echo $row6['url_documento']; ?>" target="_blank"><img src="images/pdf.png" alt="" style="width:15px;"><?php echo $row6['nombre_comision_documento']; ?></a> <?php echo $row6['fecha']; ?>
                        <a href="filesnr/comision/<?php echo $row6['ano_comision_documento']; ?>/<?php echo $row6['url_documento']; ?>" download="<?php echo $row6['nombre_comision_documento']; ?>.pdf" title="Descargar"> <i class="fa fa-fw fa-download" style="color: red;"></i> </a><br>
                        <?php echo isset($row6['observacion_documento']) ? $row6['observacion_documento'] : ''; ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

        <!-- AUTORIZACIONES -->
        <div class="box box-success divscroll">
            <div class="box-header with-border">
                <b>Autorizaciones</b>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php if (1 == $_SESSION['rol']) { ?>
                    <div class="input-group">
                        <select id="<?php echo $CampoFrom = gia(); ?>" style="width:100%;" required>
                            <option value=""></option>
                            <option value="Solicito">Solicito</option>
                            <option value="Autorizo">Autorizacion Jefe Area</option>
                            <option value="Reviso">Reviso</option>
                            <option value="Reviso Financiera">Reviso Financiera</option>
                            <option value="Aprobo">Aprobo</option>
                            <option value="Envio Pago">Envio Pago</option>
                            <option value="Presupuesto">Pago Presupuesto</option>
                            <option value="Contabilidad">Pago Contabilidad</option>
                            <option value="Tesoreria">Pago Tesoreria</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-xs" onclick="modalCloseEstadosComision(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('comision-estado-id_comision-' . $id . '', cs()); ?>')">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                <?php } ?>

                <form action="" method="post" name="btnGuardarEstadoComision">
                    <div class="input-group">
                        <select name="estado" class="form-control" required>
                            <option value=""></option>
                            <?php if ('Creado' == $estadoGeneral && 2 == $_SESSION['snr_grupo_cargo']) { ?>
                                <option value="Solicito">Solicito</option>
                            <?php } ?>
                            <?php if ('Solicito' == $estadoGeneral && 0 < $autorizaJefe) { ?>
                                <option value="Autorizo">Autorizo Jefe Area</option>
                            <?php } ?>
                            <?php if ('Autorizo' == $estadoGeneral && 0 < $nump100) { ?>
                                <option value="Reviso">Reviso</option>
                            <?php } ?>
                            <?php if ('Reviso' == $estadoGeneral && 0 < $nump101) { ?>
                                <option value="Reviso Financiera">Reviso Financiera</option>
                            <?php } ?>
                            <?php if ('Reviso Financiera' == $estadoGeneral && 0 < $nump166) { ?>
                                <option value="Aprobo">Aprobo</option>
                            <?php } ?>
                            <?php if ('Aprobo' == $estadoGeneral && 0 < $nump100) { ?>
                                <option value="Envio Pago">Envio Pago</option>
                            <?php } ?>
                            <?php if ('Envio Pago' == $estadoGeneral && (0 < $nump173 || 0 < $nump162)) { ?>
                                <option value="Presupuesto">Pago Presupuesto</option>
                                <option value="Contabilidad">Pago Contabilidad</option>
                            <?php } ?>
                            <?php if ('Presupuesto' == $estadoGeneral && (0 < $nump174 || 0 < $nump163)) { ?>
                                <option value="Contabilidad">Pago Contabilidad</option>
                            <?php } ?>
                            <?php if ('Contabilidad' == $estadoGeneral && (0 < $nump175 || 0 < $nump164)) { ?>
                                <option value="Tesoreria">Pago Tesoreria</option>
                            <?php } ?>
                            <?php if ('Tesoreria' == $estadoGeneral) { ?>
                                <option value="Finalizado">Finalizado</option>
                            <?php } ?>
                        </select>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success" name="btnGuardarEstadoComision" value="btnGuardarEstadoComision">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                </form><br>

                <?php $query7 = "SELECT * FROM comision_autorizacion WHERE fk_id_comision=$id AND estado_comision_autorizacion=1 ORDER BY fecha DESC";
                $result7 = $mysqli->query($query7); ?>
                <table class="table">
                    <thead>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                    </thead>
                    <?php while ($row7 = $result7->fetch_array(MYSQLI_ASSOC)) {
                        if (isset($row7['nombre_comision_autorizacion'])) { ?>
                            <tbody>
                                <td><?php echo isset($row7['nombre_comision_autorizacion']) ? $row7['nombre_comision_autorizacion'] : ''; ?></td>
                                <td><?php echo isset($row7['fk_id_funcionario']) ? quees('funcionario', $row7['fk_id_funcionario']) : ''; ?></td>
                                <td><?php echo isset($row7['fecha']) ? $row7['fecha'] : ''; ?></td>
                            </tbody>
                    <?php }
                    }
                    $result7->free(); ?>
                </table>
            </div>
        </div>

        <!-- RECHAZOS -->
        <div class="box box-danger divscroll">
            <div class="box-header with-border">
                <b>Rechazos</b>
                <div class="box-tools pull-right">
                    <?php if (
                        1 == $_SESSION['rol'] ||
                        (('Autorizo' == $estadoGeneral || 'Reviso' == $estadoGeneral || 'Aprobo' == $estadoGeneral || 'Envio Pago' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $nump100) ||
                        (('Creado' == $estadoGeneral || 'Solicito' == $estadoGeneral || 'Rechazo' == $estadoGeneral) && 0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo']) ||
                        ('Reviso' == $estadoGeneral && 0 < $nump101) ||
                        ('Reviso Financiera' == $estadoGeneral && 0 < $nump166) ||
                        ('Presupuesto' == $estadoGeneral && (0 < $nump173 || 0 < $nump162)) ||
                        ('Contabilidad' == $estadoGeneral && (0 < $nump174 || 0 < $nump163)) ||
                        ('Tesoreria' == $estadoGeneral && (0 < $nump175 || 0 < $nump164))
                    ) { ?>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalNuevoRechazo" title="Nuevo Rechazo"><span class="fa fa-fw fa-plus"></span></button>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $query4 = "SELECT * FROM comision_rechazo LEFT JOIN funcionario
                ON comision_rechazo.id_funcionario=funcionario.id_funcionario
                WHERE comision_rechazo.id_comision=$id AND comision_rechazo.estado_comision_estado=1 ORDER BY fecha_comision_rechazo DESC";
                $result4 = $mysqli->query($query4); ?>
                <div class="col-sm-12">
                    <?php while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
                        if (isset($row4['nombre_funcionario'])) {
                            echo '<b>Funcionario:</b> ' . $row4['nombre_funcionario'] . '<br>';
                            echo '<b>Fecha:</b> ' . $row4['fecha_comision_rechazo'] . '<br>';
                            echo '<b>Correo:</b> ' . $row4['correo_comision_rechazo'] . '<br>';
                            echo '<b>Detalle:</b> ' . $row4['cuerpo_comision_rechazo'] . '<br>';
                            echo '<hr>';
                        }
                    }
                    $result4->free(); ?>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO COMISIONADO -->
<div class="modal fade" tabindex="-1" role="dialog" id="createNuevoComisionado" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="font-size: 90%;">
    <div class="modal-dialog modal50">
        <div class="modal-content">
            <div class="modal-header">
                <b>Nuevo Comisionado</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="padding: 20px 20px 40px 20px;">

                <form action="" method="POST" name="formInsertComisionado">

                    <input type="hidden" name="id_comision" value="<?php echo $id; ?>">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span>Fecha Ida</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="fecha_ida" required>
                        </div>
                        <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span>Fecha Regreso</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="fecha_regreso" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span> Comisionado </label>
                        <div class="col-sm-10">
                            <?php $idGrupoArea = $_SESSION['snr_grupo_area'];
                            $idArea = buscarcampo('grupo_area', 'id_area', 'id_grupo_area=' . $idGrupoArea);
                            if (isset($idArea) && '' != $idArea) {
                                $datos = array();
                                $query8 = "SELECT * FROM grupo_area  WHERE id_area=$idArea AND estado_grupo_area=1";
                                $result8 = $mysqli->query($query8);
                                while ($row8 = $result8->fetch_array()) {
                                    $datos[] = $row8['id_grupo_area'];
                                }
                                $cadena = implode(", ", $datos); ?>
                                <select class="form-control" name="id_funcionario">
                                    <option value="">Seleccion</option>
                                    <?php $query9 = "SELECT * FROM funcionario  WHERE id_grupo_area IN ($cadena) AND estado_funcionario=1";
                                    $result9 = $mysqli->query($query9);
                                    while ($row9 = $result9->fetch_array()) { ?>
                                        <option value="<?php echo $row9['id_funcionario']; ?>"><?php echo $row9['nombre_funcionario']; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } else {
                                echo 'Unicamente para Nivel Central';
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span> Objeto</label>
                        <div class="col-sm-10">
                            <textarea name="objeto" cols="30" class="form-control" maxlength="500" placeholder="Maximo 500 Caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Observacion </label>
                        <div class="col-sm-10">
                            <textarea name="observacion" cols="30" class="form-control" maxlength="500" placeholder="Maximo 500 Caracteres"></textarea>
                        </div>
                    </div>


                    <div class="pull-right">
                        <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarComisionado" value="insertComisionado"> Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL MULTIPLE -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalTramosComision" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal50">
        <div class="modal-content">
            <div class="modal-header">
                <b>Tramo</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divdetallecomision"></div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL NUEVO DOCUMENTO -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoDocComision" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog withModal" style="min-height: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <b>Nuevo Documento</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" name="guardarDocumentoComision" enctype="multipart/form-data">
                    <input type="hidden" name="id_comision" value="<?php echo $id; ?>">
                    <div class="row">
                        <div class="col-sm-4" style="margin-bottom: 5px;">
                            <select name="nombre_comision_documento" class="form-control" required>
                                <option value="">Seleccionar</option>
                                <option value="Solicitud Comision">Solicitud Comision</option>
                                <option value="Justificacion Comision">Justificacion Comision</option>
                                <option value="Soporte SIIF">Soporte SIIF</option>
                                <option value="Tiquetes">Tiquetes</option>
                                <option value="Anexos">Anexos</option>
                                <option value="Subsanado">Subsanado</option>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump173 || 0 < $nump162) { ?>
                                    <option value="Presupuesto">Presupuesto</option>
                                <?php } ?>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump174 || 0 < $nump163) { ?>
                                    <option value="Contabilidad">Contabilidad</option>
                                <?php } ?>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump175 || 0 < $nump164) { ?>
                                    <option value="Tesoreria">Tesoreria</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <input type="file" name="file_comision">
                        </div>
                        <div class="col-sm-12">
                            <textarea name="observacion_documento" class="form-control" placeholder="Dejar Observación de Maximo 300 Caracteres" maxlength="300" style="margin-bottom: 5px;"></textarea>
                            <div class="box-tools pull-right">
                                <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarDocumentoComision" value="guardar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL RECHAZO -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoRechazo" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog withModal" style="min-height: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <b>Nuevo Rechazo</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_comision" value="<?php echo $id; ?>" required>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><span style="color:#ff0000;">*</span>Detalle del Rechazo</label>
                        <div class="col-sm-8">
                            <textarea name="cuerpo_comision_rechazo" class="form-control" cols="10" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarRechazo" value="Guardar"> Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $('.tramosComision').click(function() {
        var id = this.id;
        jQuery.ajax({
            type: "POST",
            url: "pages/comision_detalle_tramos.php",
            data: 'option=' + id,
            async: true,
            success: function(b) {
                jQuery('#divdetallecomision').html(b);
            }
        })
    });

    function modalCloseEstadosComision(valorCampo, dato) {
        let campo = $('#' + valorCampo).val();
        $.ajax({
            url: "pages/modal_actualiza.php",
            type: 'POST',
            data: {
                campo: campo,
                option: dato
            },
            success: function(response) {
                swal({
                    title: "Actualizado!",
                    text: false,
                    timer: 400,
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr, status, error);
            }
        });
    };
</script>