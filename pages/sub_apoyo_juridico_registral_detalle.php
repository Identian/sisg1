<?php
isset($_GET['i']) && "" != $_GET['i'] && 0 < existenciaunica('sajr', 'id_sajr', $_GET['i']) ? $id = $_GET['i'] : exit;

// PRIVILEGIOS
$nump167 = privilegios(167, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Admin 
$nump168 = privilegios(168, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Abogado
$nump171 = privilegios(171, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Subdirector
$nump172 = privilegios(172, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Notificador

// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");
$idFuncionario = $_SESSION['snr'];

// VALIDAR ASIGNADA
function validarAcceso($id, $idFuncionario, $mysqli)
{
    $query7 = "SELECT fk_hasta_id_funcionario FROM sajr_asignacion WHERE fk_id_sajr=$id AND fk_hasta_id_funcionario=$idFuncionario AND estado_sajr_asignacion=1";
    $result7 = $mysqli->query($query7);
    $row7 = $result7->fetch_assoc();
    return $row7['fk_hasta_id_funcionario'];
    $result7->free();
}

// MOSTRAR LOS BOTONES SOLO SI TIENE EN EL MOMENTO LA ASIGNACION
function mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)
{
    $query7 = "SELECT fk_hasta_id_funcionario FROM sajr_asignacion WHERE fk_id_sajr=$id AND estado_sajr_asignacion=1 ORDER BY id_sajr_asignacion DESC";
    $result7 = $mysqli->query($query7);
    $row7 = $result7->fetch_assoc();
    if ($row7['fk_hasta_id_funcionario'] === $idFuncionario) {
        return 1;
    } else {
        return 0;
    }
    $result7->free();
}

// VALIDACION GENERAL DE INGRESO
1 == $_SESSION['rol'] ||
    0 < $nump167 ||
    (0 < $nump168 || 0 < $nump171 || 0 < $nump172) && ('' != validarAcceso($id, $idFuncionario, $mysqli) && $idFuncionario == validarAcceso($id, $idFuncionario, $mysqli))
    ?: exit;


// NUEVA ACTIVIDAD
if (isset($_POST["guardarActividadSajr"]) && '' != $_POST["guardarActividadSajr"]) {
    // "radicado_iris" => crearNuevoIris($_SESSION['username_iris'], '315', '1863', 'TRAMITES PARA COMISIONES DE SERVICIO SNR', 'IE', 'COMISION ', 'COMISION', $conexionpostgres),
    $datos = array(
        "fk_id_sajr" => $id,
        "fk_id_sajr_opcion" => $_POST["fk_id_sajr_opcion"],
        "fecha_ejecucion" => $_POST['fecha_ejecucion'],
        "fecha_notificacion" => $_POST['fecha_notificacion'],
        "observacion_sajr_detalle" => $_POST["observacion_sajr_detalle"],
        "fk_id_funcionario" => $idFuncionario,
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "sajr_detalle", $datos)) {
        sweetAlert('OK', 'Creado Correctamente.', 'success');
    } else {
        echo sweetAlert('Advertencia', 'No Existe.', 'warning');
    }
}

// ELIMINAR ATIVIDAD
if (isset($_POST["eliminarActividadSajr"]) && '' != $_POST["eliminarActividadSajr"]) {
    $datos = array(
        "estado_sajr_detalle" => 0,
    );
    $idDetalle = $_POST["id_sajr_detalle"];
    if (actualizarDatos($mysqli, "sajr_detalle", $datos, "id_sajr_detalle=" . $idDetalle)) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// ASIGNACION
if (isset($_POST["btnGuardarAsignacionSajr"]) && '' != $_POST["btnGuardarAsignacionSajr"]) {
    $datos = array(
        "fk_id_sajr" => $_POST["fk_id_sajr"],
        "nombre_sajr_asignacion" => 'Asignado',
        "fk_desde_id_funcionario" => $idFuncionario,
        "fk_hasta_id_funcionario" => $_POST["fk_hasta_id_funcionario"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "sajr_asignacion", $datos)) {
        sweetAlert('OK', 'Asignación Correctamente.', 'success');
        echo '<meta http-equiv="refresh" content="0;URL=./sub_apoyo_juridico_registral_detalle&' . $id . '.jsp" />';
    } else {
        echo "Error en la inserción";
    }
}

// TRASLADOS
if (
    isset($_POST['fk_id_sajr']) && "" != $_POST['fk_id_sajr'] &&
    isset($_POST['btnguardarTrasladosajr']) && "" != $_POST['btnguardarTrasladosajr']
) {
    if (isset($_POST['dependencia']) && "" != $_POST['dependencia']) {
        $fkidsajrtraslado = $_POST['dependencia'];
        $fknombresajrtraslado = 'DEPENDENCIA';
    } elseif (isset($_POST['oficina_registro']) && "" != $_POST['oficina_registro']) {
        $fkidsajrtraslado = $_POST['oficina_registro'];
        $fknombresajrtraslado = 'OFICINA REGISTRO';
    }

    if (isset($fkidsajrtraslado) && "" != $fkidsajrtraslado && isset($fknombresajrtraslado) && "" != $fknombresajrtraslado) {
        $datos = array(
            "fk_id_sajr" => $_POST["fk_id_sajr"],
            "nombre_sajr_asignacion" => 'Traslado',
            "fk_desde_id_funcionario" => $idFuncionario,
            "fk_id_sajr_traslado" => $fkidsajrtraslado,
            "fk_nombre_sajr_traslado" => $fknombresajrtraslado,
            "fecha" => $fechaActual,
        );
        if (insertarDatos($mysqli, "sajr_asignacion", $datos)) {
            sweetAlert('OK', 'Traslado Correctamente.', 'success');
            echo '<meta http-equiv="refresh" content="0;URL=./sub_apoyo_juridico_registral_detalle&' . $id . '.jsp" />';
        } else {
            echo "Error al actualizar datos.";
        }
    }
}

// NUEVO INCLUIDO
if (isset($_POST["guardarRecurrenteSajr"]) && '' != $_POST["guardarRecurrenteSajr"]) {
    $datos = array(
        "fk_id_sajr" => $id,
        "fk_id_tipo_documento" => $_POST["fk_id_tipo_documento"],
        "numero_documento" => $_POST["numero_documento"],
        "nombre_sajr_incluido" => $_POST["nombre_sajr_incluido"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "sajr_incluido", $datos)) {
        sweetAlert('OK', 'Creado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// NUEVO OFICINA
if (isset($_POST["guardarOficinaRegistroSajr"]) && '' != $_POST["guardarOficinaRegistroSajr"]) {
    $datos = array(
        "fk_id_sajr" => $id,
        "nombre_sajr_incluido" => NULL,
        "fk_id_oficina_registro" => $_POST["nombre_sajr_incluido"],
        "matriculas" => $_POST["matriculas"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "sajr_incluido", $datos)) {
        sweetAlert('OK', 'Creado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// ELIMINAR INCLUIDO
if (isset($_POST["btnEliminarIncluido"]) && '' != $_POST["btnEliminarIncluido"]) {
    $datos = array(
        "estado_sajr_incluido" => 0,
    );
    $idIncluido = $_POST["id_sajr_incluido"];
    if (actualizarDatos($mysqli, "sajr_incluido", $datos, "id_sajr_incluido=" . $idIncluido)) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// GUARDAR PDF
if (
    isset($_POST["guardarDocumentoSajr"]) && '' != $_POST["guardarDocumentoSajr"] &&
    isset($_FILES['file_sajr_documento']) && '' != $_FILES['file_sajr_documento']
) {
    // FUNCION GLOBAL PARA GUARDAR FILES
    $fileP = $_FILES['file_sajr_documento'];
    $fileName = uniqid() . date("YmdGis");
    $hashName = date("YmdGis") . uniqid();
    $nombreArchivo = $fileP['name'];
    $extension = strtolower(pathinfo(basename($fileP['name']), PATHINFO_EXTENSION));
    $tipoArchivoPermitido = array('pdf', 'docx', 'doc');

    $cargarPDF = uploadFileGlobal($fileP, 'filesnr/sajr/' . $anoActual . '/', $fileName, $tipoArchivoPermitido, 10);

    if (isset($cargarPDF) && '' != $cargarPDF) {
        $datos = array(
            "fk_id_sajr" => $id,
            "fk_id_sajr_detalle" => $_POST['fk_id_sajr_detalle'],
            "nombre_sajr_documento" => $_POST["nombre_sajr_documento"],
            "ano_sajr_documento" => $anoActual,
            "url_sajr_documento" => $fileName . '.' . $extension,
            "hash_sajr_documento" => $hashName,
            "fecha" => $fechaActual
        );
        if (insertarDatos($mysqli, "sajr_documento", $datos)) {
            sweetAlert('OK', 'Cargado Correctamente.', 'success');
        } else {
            echo "Error en la inserción";
        }
    }
}

// BORRAR PDF
if (
    isset($_POST['id_sajr_documento']) && "" != $_POST['id_sajr_documento'] &&
    isset($_POST['btnBorrarDocumentoSajr']) && "" != $_POST['btnBorrarDocumentoSajr']
) {
    $idDoc = $_POST['id_sajr_documento'];
    $datos = array(
        "estado_sajr_documento" => 0
    );
    if (actualizarDatos($mysqli, "sajr_documento", $datos, "id_sajr_documento=$idDoc LIMIT 1")) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error al actualizar datos.";
    }
}
?>
<style>
    .divscroll {
        overflow-y: scroll;
        height: 270px;
    }
</style>

<div class="row">
    <div class="col-md-9" style="min-height: 500px;">
        <div class="box box-default">
            <div class="box-header with-border">
                <b>Información Inicial</b>
                <div class="box-tools pull-right">
                    <a href="sub_apoyo_juridico_registral.jsp" class="btn btn-default btn-xs" title="Regreso">Regresar</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
                $query1 = "SELECT * FROM sajr WHERE id_sajr=$id AND estado_sajr=1 LIMIT 1";
                $result1 = $mysqli->query($query1);
                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                ?>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                        <a style="cursor:pointer;" class="sajr btn btn-warning btn-xs" data-toggle="modal" data-target="#modalsajr" id="editarinicial-<?php echo $row1['id_sajr']; ?>">
                            <span class="fa fa-fw fa-pencil" title="Editar"></span>
                        </a>
                    <?php } ?>
                </div>
                <b>Radicado </b>
                <span>
                    <?php if (isset($row1['radicado'])) {
                        echo '<a href="http://sisg.supernotariado.gov.co/correspondencia&' . $row1['radicado'] . '.jsp" target="_blank">' . $row1['radicado'] . '</a>';
                    } else {
                        echo '';
                    }  ?>
                </span><br>
                <b>Fecha Radicado </b>
                <span><?php echo isset($row1['fecha_radicado'])  ? $row1['fecha_radicado'] : ''; ?></span><br>
                <b>Medio Radicación</b>
                <span><?php echo isset($row1['medio_radicado'])  ? quees('sajr_opcion', $row1['medio_radicado']) : ''; ?></span><br>
                <b>Tipo Recurso </b>
                <span><?php echo isset($row1['tipo_recurso'])  ? quees('sajr_opcion', $row1['tipo_recurso']) : ''; ?></span><br>
                <b>Expediente </b>
                <span><?php echo isset($row1['numero_expediente']) &&  isset($row1['ano_expediente']) ? 'SAJ-' . $row1['numero_expediente'] . '-' . $row1['ano_expediente'] : ''; ?></span><br>
                <b>Fecha </b>
                <span><?php echo isset($row1['fecha'])  ? $row1['fecha'] : ''; ?></span><br>
                <b>Descripcion </b><br>
                <span><?php echo isset($row1['descripcion_sajr'])  ? $row1['descripcion_sajr'] : ''; ?></span><br>
                <?php $result1->free(); ?>
            </div>
        </div>


        <div class="box box-default" style="min-height: 400px;">
            <div class="box-header with-border">
                <b>Actividad</b>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                        <a style="cursor:pointer;" class="sajr btn btn-success btn-xs" data-toggle="modal" data-target="#modalsajr" id="nuevaactividad-0">
                            <span class="fa fa-fw fa-plus" title="Nuevo"></span> Nueva Actividad
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Actividad</th>
                            <th>Fecha Ejecucion</th>
                            <th>Fecha Notificación</th>
                            <th>Observacion</th>
                            <th>Anexos</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query2 = "SELECT * FROM sajr_detalle WHERE fk_id_sajr=$id AND estado_sajr_detalle=1 ORDER BY fecha DESC";
                        $result2 = $mysqli->query($query2);
                        while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                            if (isset($row2['id_sajr_detalle'])) { ?>
                                <tr>
                                    <td><?php echo isset($row2['id_sajr_detalle'])  ? $row2['id_sajr_detalle'] : ''; ?></td>
                                    <td><?php echo isset($row2['fecha'])  ? $row2['fecha'] : ''; ?></td>
                                    <td><?php echo isset($row2['fk_id_sajr_opcion'])  ? quees('sajr_opcion', $row2['fk_id_sajr_opcion']) : ''; ?></td>
                                    <td><?php echo isset($row2['fecha_ejecucion'])  ? $row2['fecha_ejecucion'] : ''; ?></td>
                                    <td><?php echo isset($row2['fecha_notificacion'])  ? $row2['fecha_notificacion'] : ''; ?></td>
                                    <td><?php echo isset($row2['observacion_sajr_detalle'])  ? $row2['observacion_sajr_detalle'] : ''; ?></td>
                                    <td style="width: 200px;">
                                        <?php $idDetalle = $row2['id_sajr_detalle'];
                                        $query5 = "SELECT * FROM sajr_documento WHERE fk_id_sajr=$id AND fk_id_sajr_detalle=$idDetalle AND estado_sajr_documento=1 ORDER BY fecha DESC";
                                        $result5 = $mysqli->query($query5);
                                        while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) { ?>
                                            <?php $pathInfo = pathinfo($row5['url_sajr_documento']);
                                            $extension = $pathInfo['extension'];
                                            if ($extension == 'pdf') { ?>
                                                <a href="filesnr/sajr/<?php echo $row5['ano_sajr_documento']; ?>/<?php echo $row5['url_sajr_documento']; ?>" target="_blank"><img src="images/pdf.png" alt="" style="width:15px;"> <?php echo $row5['nombre_sajr_documento']; ?></a><br>
                                            <?php } else { ?>
                                                <a href="filesnr/sajr/<?php echo $row5['ano_sajr_documento']; ?>/<?php echo $row5['url_sajr_documento']; ?>" target="_blank"><img src="images/doc.png" alt="" style="width:15px;"> <?php echo $row5['nombre_sajr_documento']; ?></a><br>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php $result5->free(); ?>
                                    </td>
                                    <td style="width: 110px;">
                                        <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                                            <a style="cursor:pointer;" class="sajr btn btn-warning btn-xs" data-toggle="modal" data-target="#modalsajr" id="editaractividad-<?php echo $row2['id_sajr_detalle']; ?>">
                                                <span class="fa fa-fw fa-pencil" title="Editar"></span>
                                            </a>
                                            <a style="cursor:pointer;" class="sajr btn btn-info btn-xs" data-toggle="modal" data-target="#modalsajr" id="adjuntarpdf-<?php echo $row2['id_sajr_detalle']; ?>">
                                                <span class="fa fa-fw fa-file-pdf-o" title="Adjuntar"></span>
                                            </a>
                                            <form action="" method="post" style="display: inline;">
                                                <input type="hidden" name="id_sajr_detalle" value="<?php echo $row2['id_sajr_detalle']; ?>">
                                                <button type="submit" class="btn btn-danger btn-xs" name="eliminarActividadSajr" value="eliminarActividadSajr"><i class="fa fa-fw fa-trash" title="Borrar"></i></button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php }
                        }
                        $result2->free(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <b>Recurrentes</b>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                        <a style="cursor:pointer;" class="sajr btn btn-info btn-xs" data-toggle="modal" data-target="#modalsajr" id="recurrente-0" title="Nuevo">
                            <span class="fa fa-fw fa-plus" title="Nuevo"></span>
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body divscroll">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo, N Doc, Nombre</th>
                            <th>Fecha</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query4 = "SELECT * FROM sajr_incluido WHERE fk_id_sajr=$id AND estado_sajr_incluido=1 ORDER BY fecha DESC";
                        $result4 = $mysqli->query($query4);
                        while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
                            if (isset($row4['id_sajr_incluido']) && isset($row4['numero_documento'])) { ?>
                                <tr>
                                    <td><?php echo isset($row4['id_sajr_incluido'])  ? $row4['id_sajr_incluido'] : ''; ?></td>
                                    <td><?php
                                        echo isset($row4['fk_id_tipo_documento'])  ? buscarcampo('tipo_documento', 'sigla', 'id_tipo_documento=' . $row4['fk_id_tipo_documento']) : '';
                                        echo isset($row4['numero_documento'])  ? '<br>' . $row4['numero_documento'] : '';
                                        echo isset($row4['nombre_sajr_incluido'])  ? '<br>' . $row4['nombre_sajr_incluido'] : '';
                                        ?></td>
                                    <td><?php echo isset($row4['fecha']) ? $row4['fecha'] : ''; ?></td>
                                    <td>
                                        <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                                            <form action="" method="post" style="display: inline;">
                                                <input type="hidden" name="id_sajr_incluido" value="<?php echo $row4['id_sajr_incluido']; ?>">
                                                <button type="submit" class="btn btn-danger btn-xs" name="btnEliminarIncluido" value="btnEliminarIncluido"><i class="fa fa-fw fa-trash" title="Borrar"></i></button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php }
                        }
                        $result4->free(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-warning">
            <div class="box-header with-border">
                <b>Oficinas Registro</b>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                        <a style="cursor:pointer;" class="sajr btn btn-warning btn-xs" data-toggle="modal" data-target="#modalsajr" id="oficinas_registro-<?php echo $id; ?>" title="Nuevo">
                            <span class="fa fa-fw fa-plus" title="Nuevo"></span>
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body divscroll">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Circulo</th>
                            <th>Matriculas</th>
                            <th>Fecha</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query8 = "SELECT * FROM sajr_incluido WHERE fk_id_sajr=$id AND estado_sajr_incluido=1 ORDER BY fecha DESC";
                        $result8 = $mysqli->query($query4);
                        while ($row8 = $result8->fetch_array(MYSQLI_ASSOC)) {
                            if (isset($row8['id_sajr_incluido']) && isset($row8['matriculas']) && '' != $row8['matriculas']) { ?>
                                <tr>
                                    <td><?php echo isset($row8['id_sajr_incluido'])  ? $row8['id_sajr_incluido'] : ''; ?></td>
                                    <td><?php echo isset($row8['fk_id_oficina_registro']) ? buscarcampo('oficina_registro', 'nombre_oficina_registro', 'estado_oficina_registro=1 AND id_oficina_registro=' . $row8['fk_id_oficina_registro']) : ''; ?></td>
                                    <td><?php echo isset($row8['fk_id_oficina_registro']) ? buscarcampo('oficina_registro', 'circulo', 'estado_oficina_registro=1 AND id_oficina_registro=' . $row8['fk_id_oficina_registro']) : ''; ?></td>
                                    <td><?php echo isset($row8['matriculas']) ? $row8['matriculas'] : ''; ?></td>
                                    <td><?php echo isset($row8['fecha']) ? $row8['fecha'] : ''; ?></td>
                                    <td>
                                        <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                                            <form action="" method="post" style="display: inline;">
                                                <input type="hidden" name="id_sajr_incluido" value="<?php echo $row8['id_sajr_incluido']; ?>">
                                                <button type="submit" class="btn btn-danger btn-xs" name="btnEliminarIncluido" value="btnEliminarIncluido"><i class="fa fa-fw fa-trash" title="Borrar"></i></button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php }
                        }
                        $result8->free(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <b>Historial - Asignado</b>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump167 || 1 == mostrarBotonesAsignacion($id, $idFuncionario, $mysqli)) { ?>
                        <a style="cursor:pointer;" class="sajr btn btn-success btn-xs" data-toggle="modal" data-target="#modalsajr" id="asignacion-<?php echo $id; ?>">
                            <i class="fa fa-fw fa-user-plus" title="Asignar Abogado"></i>
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body divscroll">
                <?php
                $query3 = "SELECT * FROM sajr_asignacion WHERE fk_id_sajr=$id AND estado_sajr_asignacion=1 ORDER BY fecha DESC";
                $result3 = $mysqli->query($query3);
                while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                    if (isset($row3['id_sajr_asignacion'])) { ?>
                        <div style="border-top: 1px solid #D2D6DE;"><b><?php echo isset($row3['nombre_sajr_asignacion'])  ? $row3['nombre_sajr_asignacion'] : ''; ?></b></div>
                        <div><b>De:</b> <?php echo isset($row3['fk_desde_id_funcionario'])  ? quees('funcionario', $row3['fk_desde_id_funcionario']) : ''; ?></div>
                        <div><b>Para:</b> <?php echo isset($row3['fk_hasta_id_funcionario'])  ? quees('funcionario', $row3['fk_hasta_id_funcionario']) : ''; ?></div>
                    <?php } ?>
                    <div style="border-bottom: 1px solid #D2D6DE; margin-bottom:8px;"><b>Fecha:</b> <?php echo isset($row3['fecha'])  ? $row3['fecha'] : ''; ?></div>
                <?php }
                $result3->free(); ?>
            </div>
        </div>

    </div>
</div>

<!-- MODAL MULTIPLE -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalsajr" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal50">
        <div class="modal-content">
            <div class="modal-header">
                <b>Actualizar</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divsajr"></div>
            </div>
        </div>
    </div>
</div>


<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $('.sajr').click(function() {
        var id = this.id;
        jQuery.ajax({
            type: "POST",
            url: "pages/sub_apoyo_juridico_registral_modal.php",
            data: 'option=' + id,
            async: true,
            success: function(b) {
                jQuery('#divsajr').html(b);
            }
        })
    });
</script>