<?php
isset($_GET['i']) && "" != $_GET['i'] && 0 < existenciaunica('gaj_tutela', 'id_gaj_tutela', $_GET['i']) ? $id = $_GET['i'] : exit;


// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");
$idFuncionario = $_SESSION['snr'];

// PRIVILEGIOS
$nump141 = privilegios(141, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Admin
$nump142 = privilegios(142, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Abogados

// PRIVILEGIOS DEPENDECIAS
$nump23 = privilegios(23, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Dependencias Lider
$nump24 = privilegios(24, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Dependencias Abogado

if (1 == $_SESSION['rol'] || 0 < $nump141 || 0 < $nump142) {
    $idDONC = 0;
    $prefijoDONC = 'DEPENDENCIA';
    $privilegiosLider = 0;
    $privilegiosAbogado = 0;
} elseif (0 < $nump23 || 0 < $nump24) {
    // Dependencias
    $idDONC = $_SESSION['snr_grupo_area'];
    $prefijoDONC = 'DEPENDENCIA';
    $privilegiosLider = $nump23; // Lider Tutela
    $privilegiosAbogado = $nump24;  // Abogado Tutela

} elseif (2 == $_SESSION['snr_tipo_oficina']) {
    // Oficinas de Registro
    $idDONC = $_SESSION['id_oficina_registro'];
    $prefijoDONC = 'OFICINA REGISTRO';
    $privilegiosLider = 0 < privreg($idDONC, $idFuncionario, 9, 14); // Lider Tutela
    $privilegiosAbogado = 0 < privreg($idDONC, $idFuncionario, 9, 15); // Abogado Tutela

} elseif (3 == $_SESSION['snr_tipo_oficina']) {
    // Notarias
    $idDONC = $_SESSION['posesionnotaria'];
    $prefijoDONC = 'NOTARIA';
    $privilegiosLider = 0 < privilegiosnotariado($idDONC, 15, $idFuncionario); // Lider Tutela
    $privilegiosAbogado = 0 < privilegiosnotariado($idDONC, 16, $idFuncionario); // Abogado Tutela

} elseif (4 == $_SESSION['snr_tipo_oficina']) {
    // Curadurias
    $idDONC = $_SESSION['id_vigiladocurador'];
    $prefijoDONC = 'CURADURIA';
    $privilegiosLider = 0 < privilegiosnotariado($idDONC, 1, $idFuncionario); // Lider Tutela
    $privilegiosAbogado = 0 < privilegiosnotariado($idDONC, 2, $idFuncionario); // Abogado Tutela
} else {
    $idDONC = 0;
    $prefijoDONC = '';
    $privilegiosLider = 0;
    $privilegiosAbogado = 0;
}


// VALIDA QUE SE ENCUENTRE PREFIJO DEPENDENCIA-OFICINA-NOTARIA-CURADURIA ID DE QUE CORRESPONDE
$query9 = "SELECT id_gaj_tutela_asignacion, fk_nombre_gaj_tutela_traslado FROM gaj_tutela_asignacion WHERE fk_id_gaj_tutela=$id AND estado_gaj_tutela_asignacion=1 AND nombre_gaj_tutela_asignacion='Traslado' ORDER BY fecha DESC";
$result9 = $mysqli->query($query9);
$row9 = $result9->fetch_array(MYSQLI_ASSOC);
if ($prefijoDONC == $row9['fk_nombre_gaj_tutela_traslado']) {
    $generalPrefijoArea = 1;
} else {
    $generalPrefijoArea = 0;
}
$result9->free();

// VALIDAR TUTELA ASIGNADA
function validarAcceso($id, $mysqli)
{
    $query7 = "SELECT fk_hasta_id_funcionario FROM gaj_tutela_asignacion WHERE fk_id_gaj_tutela=$id AND estado_gaj_tutela_asignacion=1 ";
    $result7 = $mysqli->query($query7);
    $row7 = $result7->fetch_assoc();
    return $row7['fk_hasta_id_funcionario'];
    $result7->free();
}

// VALIDAR TUTELAS LIDER
function validarLider($prefijoDONC, $idDONC, $id, $mysqli)
{
    $query8 = "SELECT id_gaj_tutela_asignacion FROM gaj_tutela_asignacion AS gta 
    WHERE gta.nombre_gaj_tutela_asignacion='Traslado' 
    AND gta.fk_nombre_gaj_tutela_traslado='$prefijoDONC' 
    AND gta.fk_id_gaj_tutela_traslado='$idDONC'
    AND gta.fk_id_gaj_tutela=$id
    AND gta.estado_gaj_tutela_asignacion=1";
    $result8 = $mysqli->query($query8);
    $row8 = $result8->fetch_assoc();
    return $row8['id_gaj_tutela_asignacion'];
    $result8->free();
}




// VALIDACION GENERAL DE INGRESO
1 == $_SESSION['rol'] ||
    0 < $nump141 ||
    (0 < $nump142 && '' != validarAcceso($id, $mysqli) && $idFuncionario == validarAcceso($id, $mysqli)) ||
    (0 < $privilegiosLider && 0 < validarLider($prefijoDONC, $idDONC, $id, $mysqli)) ||
    (0 < $privilegiosAbogado && ('' != validarAcceso($id, $mysqli) || $idFuncionario == validarAcceso($id, $mysqli)))
    ?: exit;



function envioCorreoGaj($id, $para, $desde, $buzonOAJ)
{
    $cuerpo  = "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'>";
    $cuerpo .= "<img src='https://sisg.supernotariado.gov.co/siteminderagent/dmspages/SNR.jpg'><br>";
    $cuerpo .= "Atentamente nos permitimos enviar tutela.<br>";
    $cuerpo .= "<br>";
    $cuerpo .= '<a href="https://sisg.supernotariado.gov.co/gaj_tutela_detalle&' . $id . '.jsp" target="_blank">https://sisg.supernotariado.gov.co/gaj_tutela_detalle&' . $id . '.jsp</a> <br>';
    $cuerpo .= "Gracias.<br>";
    $cuerpo .= "Este correo es informativo, no brindará ninguna respuesta. ";
    $cuerpo .= "<br></div><br></div>";

    $destinatario = "{$para}";
    $asunto = "Respuesta a la tutela con fecha xx-xx-xxx";
    //para el envío en formato HTML 
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    //dirección del remitente 
    $headers .= "From: Supernotariado <{$desde}>\r\n";
    //direcciones que recibián copia 
    $headers .= "Cc: {$desde}\r\n";
    //direcciones que recibirán copia oculta 
    $headers .= "Bcc: {$buzonOAJ}\r\n";
    //Enviar EMail
    @mail($destinatario, $asunto, $cuerpo, $headers);
}

// ASIGNACION
if (isset($_POST["guardarAsignaciongajtutela"]) && '' != $_POST["guardarAsignaciongajtutela"]) {
    $datos = array(
        "fk_id_gaj_tutela" => $_POST["fk_id_gaj_tutela"],
        "nombre_gaj_tutela_asignacion" => 'Asignado',
        "fk_desde_id_funcionario" => $idFuncionario,
        "fk_hasta_id_funcionario" => $_POST["fk_hasta_id_funcionario"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "gaj_tutela_asignacion", $datos)) {
        sweetAlert('OK', 'Asignación Correctamente.', 'success');
		
		
$correofunci=correofuncionario($_POST["fk_hasta_id_funcionario"]);
		
$emailu=$correofunci;
$subject = 'Asignación de tutela';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky informa que se asigno una nueva tutela.<br>";
$cuerpo .= '<br><br><a href="https://sisg.supernotariado.gov.co/gaj_tutela_detalle&'.$id.'.jsp">https://sisg.supernotariado.gov.co/gaj_tutela_detalle&'.$id.'.jsp</a>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($emailu,$subject,$cuerpo,$cabeceras);
		
		
		
		
		
        echo '<meta http-equiv="refresh" content="0;URL=./gaj_tutela_detalle&' . $id . '.jsp" />';
    } else {
        echo "Error en la inserción";
    }
}

// TRASLADOS
if (
    isset($_POST['fk_id_gaj_tutela']) && "" != $_POST['fk_id_gaj_tutela'] &&
    isset($_POST['btnguardarTrasladogajtutela']) && "" != $_POST['btnguardarTrasladogajtutela']
) {
    if (isset($_POST['dependencia']) && "" != $_POST['dependencia']) {
        $fkidgajtutelatraslado = $_POST['dependencia'];
        $fknombregajtutelatraslado = 'DEPENDENCIA';
    } elseif (isset($_POST['oficina_registro']) && "" != $_POST['oficina_registro']) {
        $fkidgajtutelatraslado = $_POST['oficina_registro'];
        $fknombregajtutelatraslado = 'OFICINA REGISTRO';
    } elseif (isset($_POST['notaria']) && "" != $_POST['notaria']) {
        $fkidgajtutelatraslado = $_POST['notaria'];
        $fknombregajtutelatraslado = 'NOTARIA';
    } elseif (isset($_POST['curaduria']) && "" != $_POST['curaduria']) {
        $fkidgajtutelatraslado = $_POST['curaduria'];
        $fknombregajtutelatraslado = 'CURADURIA';
    }

    if (isset($fkidgajtutelatraslado) && "" != $fkidgajtutelatraslado && isset($fknombregajtutelatraslado) && "" != $fknombregajtutelatraslado) {
        $datos = array(
            "fk_id_gaj_tutela" => $_POST["fk_id_gaj_tutela"],
            "nombre_gaj_tutela_asignacion" => 'Traslado',
            "fk_desde_id_funcionario" => $idFuncionario,
            "fk_id_gaj_tutela_traslado" => $fkidgajtutelatraslado,
            "fk_nombre_gaj_tutela_traslado" => $fknombregajtutelatraslado,
            "fecha" => $fechaActual,
        );
        if (insertarDatos($mysqli, "gaj_tutela_asignacion", $datos)) {
            sweetAlert('OK', 'Traslado Correctamente.', 'success');
            if ($fknombregajtutelatraslado == 'OFICINA REGISTRO') {
                $correo = buscarcampo('grupo_area_correos', 'correo_gaj', 'fk_id_grupo_area='.$fkidgajtutelatraslado. 'AND estado_grupo_area_correos=1');
                if (isset($correo)) {
                    envioCorreoGaj($id, $correo, 'miguel.gonzalez@supernotariado.gov.co', '');
                }
            }
            echo '<meta http-equiv="refresh" content="0;URL=./gaj_tutela_detalle&' . $id . '.jsp" />';
        } else {
            echo "Error al actualizar datos.";
        }
    }
}

// NUEVA ACTIVIDAD
if (isset($_POST["guardarGajTutelaActividad"]) && '' != $_POST["guardarGajTutelaActividad"]) {
    // "radicado_iris" => crearNuevoIris($_SESSION['username_iris'], '315', '1863', 'TRAMITES PARA COMISIONES DE SERVICIO SNR', 'IE', 'COMISION ', 'COMISION', $conexionpostgres),
    $datos = array(
        "fk_id_gaj_tutela" => $id,
        "fk_tutela_opcion" => $_POST["fk_tutela_opcion"],
        "fecha_ejecucion" => $_POST["fecha_ejecucion"],
        "observacion_gaj_tutela_detalle" => $_POST["observacion_gaj_tutela_detalle"],
        "fk_id_funcionario" => $idFuncionario,
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "gaj_tutela_detalle", $datos)) {
        // Envio OAJ
        if (
            (isset($_POST["fk_tutela_opcion"]) && 20 == $_POST["fk_tutela_opcion"])
        ) {
            $datos = array(
                "fk_id_gaj_tutela" => $id,
                "nombre_gaj_tutela_asignacion" => 'Traslado',
                "fk_desde_id_funcionario" => $idFuncionario,
                "fk_id_gaj_tutela_traslado" => 14, // Grupo Administracion Juridica
                "fk_nombre_gaj_tutela_traslado" => 'DEPENDENCIA',
                "fecha" => $fechaActual,
            );
            if (insertarDatos($mysqli, "gaj_tutela_asignacion", $datos)) {
                sweetAlert('OK', 'Traslado Correctamente.', 'success');
                echo '<meta http-equiv="refresh" content="0;URL=./gaj_tutela_detalle&' . $id . '.jsp" />';
            } else {
                echo "Error al actualizar datos.";
            }
        }
    } else {
        echo "Error en la inserción";
    }
}

// NUEVO ACCIONADO
if (isset($_POST["guardarAccionadogajtutela"]) && '' != $_POST["guardarAccionadogajtutela"]) {
    if (isset($_POST['dependencia']) && "" != $_POST['dependencia']) {
        $nombregajtutelaincluidos = $_POST['dependencia'];
    } elseif (isset($_POST['oficina_registro']) && "" != $_POST['oficina_registro']) {
        $nombregajtutelaincluidos = 'Oficina Registro ' . $_POST['oficina_registro'];
    } elseif (isset($_POST['notaria']) && "" != $_POST['notaria']) {
        $nombregajtutelaincluidos = 'Notaria ' . $_POST['notaria'];
    } elseif (isset($_POST['curaduria']) && "" != $_POST['curaduria']) {
        $nombregajtutelaincluidos = 'Curaduria ' . $_POST['curaduria'];
    } elseif (isset($_POST['persona']) && "" != $_POST['persona']) {
        $nombregajtutelaincluidos = $_POST["persona"];
    } elseif (isset($_POST['entidad']) && "" != $_POST['entidad']) { 
        $nombregajtutelaincluidos = $_POST["entidad"];
    }
    $datos = array(
        "accionado_accionante" => 'Accionado',
        "fk_id_gaj_tutela" => $id,
        "fk_id_tipo_documento" => $_POST["fk_id_tipo_documento"],
        "numero_documento" => $_POST["numero_documento"],
        "nombre_gaj_tutela_incluidos" => $nombregajtutelaincluidos,
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "gaj_tutela_incluidos", $datos)) {
        sweetAlert('OK', 'Creado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// NUEVO ACCIONANTE
if (
    isset($_POST["guardarAccionantegajtutela"]) && '' != $_POST["guardarAccionantegajtutela"] &&
    isset($_POST["nombre_gaj_tutela_incluidos"]) && '' != $_POST["nombre_gaj_tutela_incluidos"]
) {
    $datos = array(
        "accionado_accionante" => 'Accionante',
        "fk_id_gaj_tutela" => $id,
        "fk_id_tipo_documento" => $_POST["fk_id_tipo_documento"],
        "numero_documento" => $_POST["numero_documento"],
        "nombre_gaj_tutela_incluidos" => $_POST["nombre_gaj_tutela_incluidos"],
        "observacion_gaj_tutela_incluidos" => $_POST["observacion_gaj_tutela_incluidos"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "gaj_tutela_incluidos", $datos)) {
        sweetAlert('OK', 'Creado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// ELIMINAR ATIVIDAD
if (isset($_POST["eliminaractividad"]) && '' != $_POST["eliminaractividad"]) {
    $datos = array(
        "estado_gaj_tutela_detalle" => 0,
    );
    $idDetalle = $_POST["id_gaj_tutela_detalle"];
    if (actualizarDatos($mysqli, "gaj_tutela_detalle", $datos, "id_gaj_tutela_detalle=" . $idDetalle)) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// ELIMINAR INCLUIDO
if (isset($_POST["eliminarincluido"]) && '' != $_POST["eliminarincluido"]) {
    $datos = array(
        "estado_gaj_tutela_incluidos" => 0,
    );
    $idDetalle = $_POST["id_gaj_tutela_incluidos"];
    if (actualizarDatos($mysqli, "gaj_tutela_incluidos", $datos, "id_gaj_tutela_incluidos=" . $idDetalle)) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}

// GUARDAR PDF
if (
    isset($_POST["guardarDocumentoGajTutela"]) && '' != $_POST["guardarDocumentoGajTutela"] &&
    isset($_FILES['file_gaj_tutela_documento']) && '' != $_FILES['file_gaj_tutela_documento'] &&
    isset($_POST['nombre_gaj_tutela_documento']) && '' != $_POST['nombre_gaj_tutela_documento']
) {
    // FUNCION GLOBAL PARA GUARDAR FILES
    $fileP = $_FILES['file_gaj_tutela_documento'];
    $fileName = uniqid() . date("YmdGis");
    $hashName = date("YmdGis") . uniqid();
    $nombreArchivo = $fileP['name'];
    $extension = strtolower(pathinfo(basename($fileP['name']), PATHINFO_EXTENSION));

    // BUSCAR OPCION
    if (isset($_POST['fk_id_gaj_tutela_detalle']) && '' != $_POST['fk_id_gaj_tutela_detalle']) {
        $fkidgajtuteladetalle = $_POST['fk_id_gaj_tutela_detalle'];
        $query6 = "SELECT * FROM gaj_tutela_detalle WHERE id_gaj_tutela_detalle=$fkidgajtuteladetalle AND estado_gaj_tutela_detalle=1 LIMIT 1";
        $result6 = $mysqli->query($query6);
        $row6 = $result6->fetch_array(MYSQLI_ASSOC);
        $fkidtutelaopcion = $row6['fk_tutela_opcion'];
    }

    $tipoArchivoPermitido = array('pdf', 'docx', 'doc');
    $cargarPDF = uploadFileGlobal($fileP, 'filesnr/gajtutela/' . $anoActual . '/', $fileName, $tipoArchivoPermitido, 10);

    if (isset($cargarPDF) && '' != $cargarPDF) {
        $datos = array(
            "fk_id_gaj_tutela" => $id,
            "fk_id_gaj_tutela_detalle" => $fkidgajtuteladetalle,
            "fk_id_gaj_tutela_opcion" => $fkidtutelaopcion,
            "nombre_gaj_tutela_documento" => $_POST["nombre_gaj_tutela_documento"],
            "ano_gaj_tutela_documento" => $anoActual,
            "ulr_gaj_tutela_documento" => $fileName . '.' . $extension,
            "hash_gaj_tutela_documento" => $hashName,
            "fecha" => $fechaActual
        );
        if (insertarDatos($mysqli, "gaj_tutela_documento", $datos)) {
            sweetAlert('OK', 'Cargado Correctamente.', 'success');
        } else {
            echo "Error en la inserción";
        }
    }
}

// BORRAR PDF
if (
    isset($_POST['id_gaj_tutela_documento']) && "" != $_POST['id_gaj_tutela_documento'] &&
    isset($_POST['btnBorrarDocumentoGajTutela']) && "" != $_POST['btnBorrarDocumentoGajTutela']
) {
    $idDoc = $_POST['id_gaj_tutela_documento'];
    $datos = array(
        "estado_gaj_tutela_documento" => 0
    );
    if (actualizarDatos($mysqli, "gaj_tutela_documento", $datos, "id_gaj_tutela_documento=$idDoc LIMIT 1")) {
        sweetAlert('OK', 'Borrado Correctamente.', 'success');
    } else {
        echo "Error al actualizar datos.";
    }
}
?>
<style>
    .divscroll-y {
        overflow-y: scroll;
        height: 270px;
    }

    .divscroll-yx {
        overflow-y: scroll;
        overflow-x: scroll;
        height: 200px;
    }
</style>

<div class="row">
    <div class="col-md-9" style="min-height: 500px;">
        <div class="box box-default">
            <div class="box-header with-border">
                <b>Información Inicial</b>
                <div class="box-tools pull-right">
                    <a href="gaj_tutela.jsp" class="btn btn-default btn-xs" title="Regreso a Tutelas">Regresar</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
 $query1 = "SELECT * FROM gaj_tutela WHERE  id_gaj_tutela=$id AND estado_gaj_tutela=1 LIMIT 1";
                $result1 = $mysqli->query($query1);
                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                ?>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || (0 < $generalPrefijoArea && (0 < $nump141 || 0 < $nump142))) { ?>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-warning btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="editarinicial-<?php echo $row1['id_gaj_tutela']; ?>">
                            <span class="fa fa-fw fa-pencil" title="Editar"></span>
                        </a>
                    <?php } ?>
                </div>
                <b>Radicado </b>
                <span><?php echo isset($row1['radicado'])  ? $row1['radicado'] : ''; ?></span><br>
                <b>Juzgado </b>
                <span><?php echo isset($row1['juzgado'])  ? $row1['juzgado'] : ''; ?></span><br>
                <b>Email Juzgado </b>
                <span><?php echo isset($row1['email_juzgado'])  ? $row1['email_juzgado'] : ''; ?></span><br>
                <b>Fecha Tutela</b>
                <span><?php echo isset($row1['fecha_tutela'])  ? $row1['fecha_tutela'] : ''; ?></span><br>
                <b>Tema</b>
                <span><?php echo isset($row1['tema'])  ? quees('gaj_tutela_opcion',$row1['tema']) : ''; ?></span><br>
                <b>Derecho Fundamental</b>
                <span><?php echo isset($row1['derecho_fundamental'])  ? quees('gaj_tutela_opcion',$row1['derecho_fundamental']) : ''; ?></span><br>
                <b>Descripcion </b><br>
                <span><?php echo isset($row1['descripcion_tutela'])  ? $row1['descripcion_tutela'] : ''; ?></span><br>
                <?php $result1->free(); ?>
            </div>
        </div>


        <div class="box box-default" style="min-height: 400px;">
            <div class="box-header with-border">
                <b>Actividad</b>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || (0 < $generalPrefijoArea)) { ?>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-success btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="nuevaactividad-0">
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
                            <th>Creada</th>
                            <th>Actividad</th>
                            <th>Fecha Ejecución</th>
                            <th>Observacion</th>
                            <th>Fecha Notificación</th>
                            <th>Fecha Limite Respuesta</th>
                            <th>Anexos</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query2 = "SELECT * FROM gaj_tutela_detalle WHERE fk_id_gaj_tutela=$id AND estado_gaj_tutela_detalle=1 ORDER BY fecha DESC";
                        $result2 = $mysqli->query($query2);
                        while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                            if (isset($row2['id_gaj_tutela_detalle'])) { ?>
                                <tr>
                                    <td><?php echo isset($row2['id_gaj_tutela_detalle'])  ? $row2['id_gaj_tutela_detalle'] : ''; ?></td>
                                    <td><?php echo isset($row2['fecha'])  ? $row2['fecha'] : ''; ?></td>
                                    <td><?php echo isset($row2['fk_tutela_opcion'])  ? quees('gaj_tutela_opcion', $row2['fk_tutela_opcion']) : ''; ?></td>
                                    <td><?php echo isset($row2['fecha_ejecucion'])  ? $row2['fecha_ejecucion'] : ''; ?></td>
                                    <td><?php echo isset($row2['observacion_gaj_tutela_detalle'])  ? $row2['observacion_gaj_tutela_detalle'] : ''; ?></td>
                                    <td><?php echo isset($row2['fecha_plazo'])  ? $row2['fecha_plazo'] : ''; ?></td>
                                    <td>
                                        <?php echo (isset($row2['fecha_plazo']) && isset($row2['dias_plazo'])) ? fechahabil($row2['fecha_plazo'], $row2['dias_plazo']) : ''; ?>
                                    </td>
                                    <td style="width: 200px;">
                                        <?php
                                        $idDetalle = $row2['id_gaj_tutela_detalle'];
                                        $query5 = "SELECT * FROM gaj_tutela_documento WHERE fk_id_gaj_tutela_detalle=$idDetalle AND fk_id_gaj_tutela=$id AND estado_gaj_tutela_documento=1 ORDER BY fecha DESC";
                                        $result5 = $mysqli->query($query5);
                                        while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) { ?>
                                            <a href="filesnr/gajtutela/<?php echo $row5['ano_gaj_tutela_documento']; ?>/<?php echo $row5['ulr_gaj_tutela_documento']; ?>" target="_blank">
                                            <?php 
                                            $pathInfo = pathinfo($row5['ulr_gaj_tutela_documento']);
                                            $extension = $pathInfo['extension'];
                                             if ($extension == 'pdf') { ?>
                                                <img src="images/pdf.png" alt="" style="width:15px;"> <?php echo $row5['nombre_gaj_tutela_documento']; ?></a><br>
                                            <?php } else { ?>
                                                <img src="images/doc.png" alt="" style="width:15px;"> <?php echo $row5['nombre_gaj_tutela_documento']; ?></a><br>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php $result5->free(); ?>
                                    </td>
                                    <td style="width: 110px;">
                                        <?php $opciont = $row2['fk_tutela_opcion'];
                                        $prefijogaj = buscarcampo('gaj_tutela_opcion', 'prefijo_gaj_tutela_opcion', "id_gaj_tutela_opcion='$opciont' AND estado_gaj_tutela_opcion=1"); ?>
                                        <!-- SuperAdmin | Admin | Abogado -->
                                        <?php if (1 == $_SESSION['rol'] || (0 < $generalPrefijoArea && (0 < $nump141 || 0 < $nump142))) { ?>
                                            <a style="cursor:pointer;" class="gajtutelas btn btn-warning btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="editaractividad-<?php echo $row2['id_gaj_tutela_detalle']; ?>">
                                                <span class="fa fa-fw fa-pencil" title="Editar"></span>
                                            </a>
                                            <a style="cursor:pointer;" class="gajtutelas btn btn-info btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="adjuntarpdf-<?php echo $row2['id_gaj_tutela_detalle']; ?>">
                                                <span class="fa fa-fw fa-file-pdf-o" title="Adjuntar"></span>
                                            </a>
                                            <?php if (1 == $_SESSION['rol'] || (0 < $generalPrefijoArea && (0 < $nump141 || 0 < $nump142))) { ?>
                                                <form action="" method="post" style="display: inline;">
                                                    <input type="hidden" name="id_gaj_tutela_detalle" value="<?php echo $row2['id_gaj_tutela_detalle']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs" name="eliminaractividad" value="eliminaractividad"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            <?php } ?>
                                        <?php } elseif ($prefijogaj == 'donc' && 0 < $generalPrefijoArea && (0 < $privilegiosLider || 0 < $privilegiosAbogado)) {  ?>
                                            <a style="cursor:pointer;" class="gajtutelas btn btn-warning btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="editaractividad-<?php echo $row2['id_gaj_tutela_detalle']; ?>">
                                                <span class="fa fa-fw fa-pencil" title="Editar"></span>
                                            </a>
                                            <a style="cursor:pointer;" class="gajtutelas btn btn-info btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="adjuntarpdf-<?php echo $row2['id_gaj_tutela_detalle']; ?>">
                                                <span class="fa fa-fw fa-file-pdf-o" title="Adjuntar"></span>
                                            </a>
                                            <?php if (0 < $generalPrefijoArea && (0 < $privilegiosLider)) { ?>
                                                <form action="" method="post" style="display: inline;">
                                                    <input type="hidden" name="id_gaj_tutela_detalle" value="<?php echo $row2['id_gaj_tutela_detalle']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs" name="eliminaractividad" value="eliminaractividad"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            <?php } ?>
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
        <!-- ACCIONADOS -->
        <div class="box box-default">
            <div class="box-header with-border">
                <b>Accionados</b>
                <div class="box-tools pull-right">
                    <?php 
					
					
					
					if (1 == $_SESSION['rol'] || ((0 < $nump141 || 0 < $nump142))) { ?>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-default btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="accionado-0">
                            <span class="fa fa-fw fa-plus" title="Nuevo"></span>
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body divscroll-yx">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="min-width: 100px;">Nombre</th>
                            <th style="min-width: 100px;">Fecha</th>
                            <th style="min-width: 100px;">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query4 = "SELECT * FROM gaj_tutela_incluidos WHERE fk_id_gaj_tutela=$id AND accionado_accionante='accionado' AND estado_gaj_tutela_incluidos=1 ORDER BY fecha DESC";
                        $result4 = $mysqli->query($query4);
                        while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
                            if (isset($row4['id_gaj_tutela_incluidos'])) { ?>
                                <tr>
                                    <td><?php echo isset($row4['nombre_gaj_tutela_incluidos'])  ? $row4['nombre_gaj_tutela_incluidos'] : ''; ?></td>
                                    <td><?php echo isset($row4['fecha'])  ? $row4['fecha'] : ''; ?></td>
                                    <td>
                                        <?php if (1 == $_SESSION['rol'] || (0 < $generalPrefijoArea && (0 < $nump141 || 0 < $nump142))) { ?>
                                            <form action="" method="post" style="display: inline;">
                                                <input type="hidden" name="id_gaj_tutela_incluidos" value="<?php echo $row4['id_gaj_tutela_incluidos']; ?>">
                                                <button type="submit" class="btn btn-danger btn-xs" name="eliminarincluido" value="eliminarincluido"><i class="fa fa-fw fa-trash"></i></button>
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
        <!-- ACCIONANTES -->
        <div class="box box-info">
            <div class="box-header with-border">
                <b>Accionantes</b>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || ((0 < $nump141 || 0 < $nump142))) { ?>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-info btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="accionante-0">
                            <span class="fa fa-fw fa-plus" title="Nuevo"></span>
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body divscroll-yx">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Numero</th>
                            <th style="min-width: 200px;">Nombre</th>
                            <th style="min-width: 200px;">Observacion</th>
                            <th style="min-width: 130px;">Fecha</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query4 = "SELECT * FROM gaj_tutela_incluidos WHERE fk_id_gaj_tutela=$id  AND accionado_accionante='accionante' AND estado_gaj_tutela_incluidos=1 ORDER BY fecha DESC";
                        $result4 = $mysqli->query($query4);
                        while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
                            if (isset($row4['id_gaj_tutela_incluidos'])) { ?>
                                <tr>
                                    <td><?php echo isset($row4['fk_id_tipo_documento'])  ? quees('tipo_documento', $row4['fk_id_tipo_documento']) : ''; ?></td>
                                    <td><?php echo isset($row4['numero_documento'])  ? $row4['numero_documento'] : ''; ?></td>
                                    <td><?php echo isset($row4['nombre_gaj_tutela_incluidos'])  ? $row4['nombre_gaj_tutela_incluidos'] : ''; ?></td>
                                    <td><?php echo isset($row4['observacion_gaj_tutela_incluidos'])  ? $row4['observacion_gaj_tutela_incluidos'] : ''; ?></td>
                                    <td><?php echo isset($row4['fecha'])  ? $row4['fecha'] : ''; ?></td>
                                    <td>
                                        <?php if (1 == $_SESSION['rol'] || (0 < $generalPrefijoArea && (0 < $nump141 || 0 < $nump142))) { ?>
                                            <form action="" method="post" style="display: inline;">
                                                <input type="hidden" name="id_gaj_tutela_incluidos" value="<?php echo $row4['id_gaj_tutela_incluidos']; ?>">
                                                <button type="submit" class="btn btn-danger btn-xs" name="eliminarincluido" value="eliminarincluido"><i class="fa fa-fw fa-trash"></i></button>
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


        <div class="box box-success">
            <div class="box-header with-border">
                <b>Historial - Traslado / Asignado</b>
                <div class="box-tools pull-right">
                    <!-- VALIDA ADMIN, ADMIN GAJ, ABOGADOS GAJ PARA REALIZAR LAS ASIGNACIONES A LOS DE SU GRUPO 
					
					0 < $generalPrefijoArea &&
					
					-->
                    <?php if (1 == $_SESSION['rol'] || (0 < $nump141 || 0 < $nump142 || 0<$nump24)) { ?>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-success btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="asignacion-<?php echo $id; ?>">
                            <i class="fa fa-fw fa-user-plus" title="Asignar Profesional"></i>
                        </a>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-info btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="traslado-<?php echo $id; ?>">
                            <i class="fa fa-fw fa-exchange" title="Trasladar"></i>
                        </a>
                    <?php } ?>
                    <!-- VALIDA LIDER PARA REALIZAR LAS ASIGNACIONES A LOS DE SU GRUPO -->
                    <?php if (0 < $generalPrefijoArea && (0 < $privilegiosLider)) { ?>
                        <a style="cursor:pointer;" class="gajtutelas btn btn-success btn-xs" data-toggle="modal" data-target="#modalgajtutelas" id="asignacion-<?php echo $id; ?>">
                            <i class="fa fa-fw fa-user-plus" title="Asignar Profesional"></i>
                        </a>
                    <?php } ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body divscroll-y">
                <?php
                $query3 = "SELECT * FROM gaj_tutela_asignacion WHERE fk_id_gaj_tutela=$id AND estado_gaj_tutela_asignacion=1 ORDER BY fecha DESC";
                $result3 = $mysqli->query($query3);
                while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                    if (isset($row3['id_gaj_tutela_asignacion'])) { ?>
                        <div style="border-top: 1px solid #D2D6DE;"><b><?php echo isset($row3['nombre_gaj_tutela_asignacion'])  ? $row3['nombre_gaj_tutela_asignacion'] : ''; ?></b></div>
                        <div><b>De:</b> <?php echo isset($row3['fk_desde_id_funcionario'])  ? quees('funcionario', $row3['fk_desde_id_funcionario']) : ''; ?></div>
                        <?php if (isset($row3['nombre_gaj_tutela_asignacion']) && 'Asignado' == $row3['nombre_gaj_tutela_asignacion']) { ?>
                            <div><b>Para:</b> <?php echo isset($row3['fk_hasta_id_funcionario'])  ? quees('funcionario', $row3['fk_hasta_id_funcionario']) : ''; ?></div>
                        <?php } elseif (isset($row3['nombre_gaj_tutela_asignacion']) && 'Traslado' == $row3['nombre_gaj_tutela_asignacion']) {
                            if (isset($row3['fk_nombre_gaj_tutela_traslado']) && 'DEPENDENCIA' == $row3['fk_nombre_gaj_tutela_traslado']) {
                                $donc = 'Dependencia ' . quees('grupo_area', $row3['fk_id_gaj_tutela_traslado']);
                            }
                            if (isset($row3['fk_nombre_gaj_tutela_traslado']) && 'OFICINA REGISTRO' == $row3['fk_nombre_gaj_tutela_traslado']) {
                                $donc = 'Oficina Registro ' . quees('oficina_registro', $row3['fk_id_gaj_tutela_traslado']);
                            }
                            if (isset($row3['fk_nombre_gaj_tutela_traslado']) && 'NOTARIA' == $row3['fk_nombre_gaj_tutela_traslado']) {
                                $donc = 'Notaria ' . quees('notaria', $row3['fk_id_gaj_tutela_traslado']);
                            }
                            if (isset($row3['fk_nombre_gaj_tutela_traslado']) && 'CURADURIA' == $row3['fk_nombre_gaj_tutela_traslado']) {
                                $donc = 'Curaduria ' . quees('curaduria', $row3['fk_id_gaj_tutela_traslado']);
                            }
                        ?>
                            <div><b>Para:</b> <?php echo $donc; ?></div>
                        <?php } ?>
                        <div style="border-bottom: 1px solid #D2D6DE; margin-bottom:8px;"><b>Fecha:</b> <?php echo isset($row3['fecha'])  ? $row3['fecha'] : ''; ?></div>
                <?php }
                }
                $result3->free(); ?>
            </div>
        </div>
    </div>
</div>

<!-- MODAL MULTIPLE -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalgajtutelas" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal50">
        <div class="modal-content">
            <div class="modal-header">
                <b>Tutela</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divgajtutelas"></div>
            </div>
        </div>
    </div>
</div>


<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $('.gajtutelas').click(function() {
        var id = this.id;
        jQuery.ajax({
            type: "POST",
            url: "pages/gaj_tutela_modal.php",
            data: 'option=' + id,
            async: true,
            success: function(b) {
                jQuery('#divgajtutelas').html(b);
            }
        })
    });
</script>