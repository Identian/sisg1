<?php
$nump124 = privilegios(124, $_SESSION['snr']); // SID Migracion
$nump131 = privilegios(131, $_SESSION['snr']); // SID Migracion Traslados Migraci&oacute;n
$nump139 = privilegios(139, $_SESSION['snr']); // SID Migracion Cargar Anexos
$nump132 = privilegios(132, $_SESSION['snr']); // SID Migracion Eliminar Anexos
$nump143 = privilegios(143, $_SESSION['snr']); // Usuario usado por sebastian
$GlobalGrupoArea = $_SESSION['snr_grupo_area'];
$GlobalIdFuncionario = $_SESSION['snr'];

if ((0 < $nump124) or 1 == $_SESSION['rol'] or 0 < $nump143 or 0 < $nump131 or 0 < $nump139) {

    // Oficina de Control Disciplinario Interno = 23
    if ($GlobalGrupoArea == 23) {
        $querycpmo2 = "AND tipo_oficina_cdmso = 1";
        $GlobalTipoDeOficina = 1;
        $nomenclatura = 'OCDI';
    }
    // Superintendencia Delegada Para El Registro = 41
    // Grupo de Inspeccion Vigilancia y Control Registral = 42
    // Grupo de Gestion Disciplinaria Registral = 313
    if ($GlobalGrupoArea == 41 || $GlobalGrupoArea == 41 || $GlobalGrupoArea == 313) {
        $querycpmo2 = "AND tipo_oficina_cdmso = 2";
        $GlobalTipoDeOficina = 2;
        $nomenclatura = 'SDR';
    }
    // Superintendencia Delegada Para El Notariado = 44
    // Direccion de Vigilancia y Control Notarial = 45 
    if ($GlobalGrupoArea == 44 || $GlobalGrupoArea == 45) {
        $querycpmo2 = "AND tipo_oficina_cdmso = 3";
        $GlobalTipoDeOficina = 3;
        $nomenclatura = 'SDN';
    }
    // Superintendencia Delegada para la Proteccion Restitucion y Formalizacion de Tierras = 297
    // Grupo para el control y vigilancia de Curadores Urbanos = 305
    if ($GlobalGrupoArea == 297 or $GlobalGrupoArea == 305) {
        $querycpmo2 = "AND tipo_oficina_cdmso = 4";
        $GlobalTipoDeOficina = 4;
        $nomenclatura = 'SDC';
    }
    // Oficina Asesora Juridica = 12
    if ($GlobalGrupoArea == 12) {
        $querycpmo2 = "AND tipo_oficina_cdmso = 5";
        $GlobalTipoDeOficina = 5;
        $nomenclatura = 'OAJ';
    }
    // Despacho Del Superintendente = 1 | Oficina Asesora Juridica = 12 para asignar a luisa
    if ($GlobalGrupoArea == 1) {
        $querycpmo2 = "AND tipo_oficina_cdmso = 6";
        $GlobalTipoDeOficina = 6;
        $nomenclatura = 'DDS';
    }
    // Super usuario para simular Superintendencia Delegada Para El Notariado
    if (1 == $_SESSION['rol'] or 0 < $nump143) {
        $GlobalTipoDeOficina = 3;
        $nomenclatura = 'SDN';
    }


    // Fecha Actual
    date_default_timezone_set("America/Bogota");
    $fechaActual = date("Y-m-d H:i:s");
    $fechaAno = date("Y");

    // Funcion para la auditoria global
    function auditoria($id, $tabla, $idTabla, $accion, $GlobalIdFuncionario, $fechaActual, $conexion)
    {
        $AuditoriaSQL = sprintf(
            "INSERT INTO cd_auditoria_migracion (
                id_cdam,
                tabla_cdam,
                id_tabla_cdam,
                accion_cdam,
                id_funcionario_fk_cdam,
                fecha_creado_cdam) VALUES (%s,%s,%s,%s,%s,%s)",
            GetSQLValueString($id, "text"),
            GetSQLValueString($tabla, "text"),
            GetSQLValueString($idTabla, "int"),
            GetSQLValueString($accion, "text"),
            GetSQLValueString($GlobalIdFuncionario, "int"),
            GetSQLValueString($fechaActual, "date")
        );
        mysql_query($AuditoriaSQL, $conexion) or die(mysql_error());
    }

    // GUARDAR FILE 
    if (
        isset($_FILES['file']) && "" != $_FILES['file'] &&
        isset($_POST['id_proc_cdmfs']) && "" != $_POST['id_proc_cdmfs']
    ) {
        $id = $_POST['id_proc_cdmfs'];
        $tamano_archivo = 15728640; //15728640
        $formato_archivo = array('pdf');
        $carpeta_archivo = "filesnr/archivo/";
        $ruta_archivo =  date("YmdGis") . md5(rtrim(strtr(base64_encode(date("YmdGis")), '+/', '-_'), '='));


        if ("" != $_FILES['file']['tmp_name']) {
            $archivo = $_FILES['file']['tmp_name'];
            $nombre = strtolower($_FILES['file']['name']);
            $nom = pathinfo($nombre);
            $extension = $nom['extension'];
            $array_archivo = explode('.', $nombre);
            $extension2 = end($array_archivo);

            if ($tamano_archivo >= intval($_FILES['file']['size'])) {
                if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
                    $files = $ruta_archivo . '.' . $extension;
                    $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo . $files);
                    $nombreUc = ucwords($nombre);
                    $hash = md5($files);
                    $insertDocumento = sprintf("INSERT INTO cd_migracion_file_sid 
                        (id_procf_cdmfs,id_proc_cdmfs,nombre_procf_cdmfs,id_sid_no_borrar) 
                        VALUES 
                        ('$files',$id,'$nombre',1)");
                    mysql_query($insertDocumento, $conexion) or die(mysql_error());
                    $idInsert = mysql_insert_id($conexion);
                    auditoria($id, 'cd_migracion_file_sid', $idInsert, $insertDocumento, $GlobalIdFuncionario, $fechaActual, $conexion);
                    echo $insertado;
                } else {
                    echo  $doc_no_tipo;
                }
            } else {
                echo '<script type="text/javascript">swal(" ERROR !", " El archivo Supera los 15 Megas Permitidos. !", "error");</script>';
            }
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }


    // ACTUALIZAR ETAPA
    if (
        isset($_POST["actualizar_expediente"]) && $_POST["actualizar_expediente"] != "" &&
        isset($_POST["id_cdms"]) && $_POST["id_cdms"] != "" &&
        isset($_POST["estado_expediente_cdmso"]) && $_POST["estado_expediente_cdmso"] != ""
    ) {
        $id = $_POST["id_cdms"];
        $creadoPor = $_POST["nomenclatura_cdmso"];
        $origen = $_POST["proc_origen_cdmso"];
        $tipologia = $_POST["nombre_cd_tipo"];
        $etapa = $_POST["etapa_cdmso"];
        $estado = $_POST["estado_expediente_cdmso"];
        $observacion = $_POST["observacion_cdmso"];
        $Update = "UPDATE cd_migracion_sid SET 
        nomenclatura_cdmso = '$creadoPor',
        proc_origen_cdmso = '$origen',
        nombre_cd_tipo = '$tipologia', 
        etapa_cdmso = '$etapa', 
        estado_expediente_cdmso = '$estado',
        observacion_cdmso = '$observacion'
        WHERE id_cdms = $id";
        $result102 = $mysqli->query($Update);
        if ($result102 === TRUE) {
            auditoria($id, 'cd_migracion_sid', $id, $Update, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo $actualizado;
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // BORRAR DOCUMENTOS ANEXOS
    if (isset($_POST["borrar_id_procf_cdmfs"]) && '' != $_POST["borrar_id_procf_cdmfs"]) {
        $idborrar = $_POST["borrar_id_procf_cdmfs"];
        $queryUpdate = "UPDATE cd_migracion_file_sid SET estado_cd_migracion_file_sid = 0
        WHERE id_cdmfs = $idborrar ";
        $result103 = $mysqli->query($queryUpdate);
        if ($result103 === TRUE) {
            auditoria(NULL, 'cd_migracion_file_sid', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // NUEVO EXPEDIENTE
    if (isset($_POST["nuevo_cd_migracion_sid"]) && '' != $_POST["nuevo_cd_migracion_sid"]) {
        $InsertSQL = sprintf(
            "INSERT INTO cd_migracion_sid (
            proc_id_cdmso,
            proc_nro_radicacion_cdmso,
            proc_origen_cdmso,
            nomenclatura_cdmso,

            tipo_oficina_cdmso,
            nombre_cd_tipo,
            etapa_cdmso,
            estado_expediente_cdmso,
            observacion_cdmso,
            fecha_cdmso
            ) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
            GetSQLValueString(NULL, "text"),
            GetSQLValueString($_POST["proc_nro_radicacion_cdmso"], "text"),
            GetSQLValueString($_POST["proc_origen_cdmso"], "text"),
            GetSQLValueString($nomenclatura, "text"),

            GetSQLValueString($GlobalTipoDeOficina, "int"),
            GetSQLValueString($_POST["nombre_cd_tipo"], "text"),
            GetSQLValueString($_POST["etapa_cdmso"], "text"),
            GetSQLValueString($_POST["estado_expediente_cdmso"], "text"),
            GetSQLValueString($_POST["observacion_cdmso"], "text"),
            GetSQLValueString($fechaActual, "date")
        );
        mysql_query($InsertSQL, $conexion) or die(mysql_error());
        $idInsert = mysql_insert_id($conexion);
        auditoria(NULL, 'cd_migracion_file_sid', $idInsert, $InsertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
        $queryUpdate = "UPDATE cd_migracion_sid SET proc_id_cdmso = $idInsert WHERE id_cdms = $idInsert";
        $result105 = $mysqli->query($queryUpdate);
        if ($result105 === TRUE) {
            echo $insertado;
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // ACTUALIZAR TRASLADO
    if (
        isset($_POST["cd_migracion_sid_traslado"]) && $_POST["cd_migracion_sid_traslado"] != "" &&
        isset($_POST["id_cdms"]) && $_POST["id_cdms"] != "" &&
        isset($_POST["fase_cdmso"]) && $_POST["fase_cdmso"] != "" &&
        isset($_POST["tipo_oficina_cdmso"]) && $_POST["tipo_oficina_cdmso"] != ""
    ) {
        $id   = $_POST["id_cdms"];
        $tipo = $_POST["tipo_oficina_cdmso"];
        $fase = $_POST["fase_cdmso"];
        $ano  = $fechaAno;

        $querys1 = "SELECT tipo_oficina_cdmso FROM cd_migracion_sid WHERE id_cdms = $id limit 1";
        $results1 = $mysqli->query($querys1);
        $rows1 = $results1->fetch_array(MYSQLI_ASSOC);
        $desdeTipoOficina = $rows1["tipo_oficina_cdmso"];

        $queryUpdate = "UPDATE cd_migracion_sid SET tipo_oficina_cdmso = $tipo, fase_cdmso = '$fase' WHERE id_cdms = $id";
        $result103 = $mysqli->query($queryUpdate);
        if ($result103 === TRUE) {

            $InsertSQL = sprintf(
                "INSERT INTO cd_migracion_traslado (
                id_fk_cd_migracion_sid,
                desde_cd_migracion_traslado,
                para_cd_migracion_traslado,
                id_fk_funcionario,
                fecha_creado_cd_migracion_traslado
                ) VALUES (%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($desdeTipoOficina, "int"),
                GetSQLValueString($tipo, "int"),
                GetSQLValueString($GlobalIdFuncionario, "int"),
                GetSQLValueString($fechaActual, "date")
            );
            mysql_query($InsertSQL, $conexion) or die(mysql_error());

            $queryUpdate2 = "UPDATE cd_migracion_sid SET ano_cdmso = '$ano' WHERE id_cdms = $id AND ano_cdmso is null";
            $result102 = $mysqli->query($queryUpdate2);

            auditoria(NULL, 'cd_migracion_sid', $id, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo $actualizado;
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // BORRAR EXPEDIENTE
    if (
        isset($_POST["borrar_expediente"]) && '' != $_POST["borrar_expediente"] &&
        isset($_POST["id_cdms"]) && '' != $_POST["id_cdms"]
    ) {
        $idborrar = $_POST["id_cdms"];
        $queryUpdate = "UPDATE cd_migracion_sid SET estado_cdmso = 0
        WHERE id_cdms = $idborrar ";
        $result103 = $mysqli->query($queryUpdate);
        if ($result103 === TRUE) {
            auditoria(NULL, 'cd_migracion_sid = Eliminar Expediente', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // BORRAR IMPLICADO EXPEDIENTE
    if (
        isset($_POST["borrar_implicado_migracion"]) && '' != $_POST["borrar_implicado_migracion"] &&
        isset($_POST["id_cdms"]) && '' != $_POST["id_cdms"]
    ) {
        $idborrar = $_POST["id_cdms"];
        $queryUpdate = "UPDATE cd_migracion_implicados SET estado_cd_migracion_implicados = 0
        WHERE id_cd_migracion_implicados = $idborrar ";
        $result103 = $mysqli->query($queryUpdate);
        if ($result103 === TRUE) {
            auditoria(NULL, 'cd_migracion_implicados = Borrar implicados Expediente', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // AGREGAR IMPLICADO EXPEDIENTE
    if (
        isset($_POST["guardar_implicado_migracion"]) && '' != $_POST["guardar_implicado_migracion"] &&
        isset($_POST["id_cdms"]) && '' != $_POST["id_cdms"] &&
        isset($_POST["nombre_cd_migracion_implicados"]) && '' != $_POST["nombre_cd_migracion_implicados"]
    ) {
        $id = $_POST["id_cdms"];
        $InsertSQL = sprintf(
            "INSERT INTO cd_migracion_implicados (
            id_cdms_fk_cd_migracion_sid,
            nombre_cd_migracion_implicados
            ) VALUES (%s,%s)",
            GetSQLValueString($id, "int"),
            GetSQLValueString(strtoupper($_POST["nombre_cd_migracion_implicados"]), "text")
        );
        mysql_query($InsertSQL, $conexion) or die(mysql_error());
        auditoria(NULL, 'cd_migracion_implicados = Agregar implicados Expediente', $id, $InsertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
        echo $insertado;
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // BORRAR ENTIDAD EXPEDIENTE
    if (
        isset($_POST["borrar_entidad_migracion"]) && '' != $_POST["borrar_entidad_migracion"] &&
        isset($_POST["id_cdms"]) && '' != $_POST["id_cdms"]
    ) {
        $idborrar = $_POST["id_cdms"];
        $queryUpdate = "UPDATE cd_migracion_entidad SET estado_cd_migracion_entidad = 0
        WHERE id_cd_migracion_entidad = $idborrar ";
        $result103 = $mysqli->query($queryUpdate);
        if ($result103 === TRUE) {
            auditoria(NULL, 'cd_migracion_entidad = Borrar entidad Expediente', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // AGREGAR ENTIDAD EXPEDIENTE
    if (
        isset($_POST["guardar_entidad_migracion"]) && '' != $_POST["guardar_entidad_migracion"] &&
        isset($_POST["id_cdms"]) && '' != $_POST["id_cdms"] &&
        isset($_POST["nombre_cd_migracion_entidad"]) && '' != $_POST["nombre_cd_migracion_entidad"]
    ) {
        $id = $_POST["id_cdms"];
        $InsertSQL = sprintf(
            "INSERT INTO cd_migracion_entidad (
            id_cdms_fk_cd_migracion_sid,
            nombre_cd_migracion_entidad
            ) VALUES (%s,%s)",
            GetSQLValueString($id, "int"),
            GetSQLValueString($_POST["nombre_cd_migracion_entidad"], "text")
        );
        mysql_query($InsertSQL, $conexion) or die(mysql_error());
        auditoria(NULL, 'cd_migracion_entidad = Agregar entidad Expediente', $id, $InsertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
        echo $insertado;
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // ACTUALIZAR ASIGNAR
    if (
        isset($_POST["cd_migracion_sid_asignar"]) && $_POST["cd_migracion_sid_asignar"] != "" &&
        isset($_POST["id_cdms"]) && $_POST["id_cdms"] != "" &&
        isset($_POST["id_funcionario"]) && $_POST["id_funcionario"] != ""
    ) {
        $id = $_POST["id_cdms"];
        $InsertSQL = sprintf(
            "INSERT INTO cd_migracion_asignacion (
            id_cd_migracion_sid,
            id_funcionario,
            fecha_registro
            ) VALUES (%s,%s,%s)",
            GetSQLValueString($id, "int"),
            GetSQLValueString($_POST["id_funcionario"], "int"),
            GetSQLValueString($fechaActual, "date")
        );
        mysql_query($InsertSQL, $conexion) or die(mysql_error());
        auditoria(NULL, 'cd_migracion_asignacion = Asignar funcionario Expediente', $id, $InsertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
        echo $insertado;
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }


    // BORRAR ASIGNACION
    if (
        isset($_POST["borrar_asignacion_sid_migracion"]) && '' != $_POST["borrar_asignacion_sid_migracion"] &&
        isset($_POST["id_cd_migracion_asignacion"]) && '' != $_POST["id_cd_migracion_asignacion"]
    ) {
        $idborrar = $_POST["id_cd_migracion_asignacion"];
        echo $queryUpdate = "UPDATE cd_migracion_asignacion SET estado_cd_migracion_asignacion = 0
        WHERE id_cd_migracion_asignacion = $idborrar ";
        $result = $mysqli->query($queryUpdate);
        if ($result === TRUE) {
            auditoria(NULL, 'cd_migracion_asignacion = Borrar Asignacion Expendiente', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

    // NUEVO VIDEO
    if (
        isset($_POST["id_cd_migracion_sid"]) && '' != $_POST["id_cd_migracion_sid"] &&
        isset($_POST["nombre_cd_migracion_video"]) && '' != $_POST["nombre_cd_migracion_video"] &&
        isset($_POST["url_cd_migracion_video"]) && '' != $_POST["url_cd_migracion_video"]
    ) {
        $InsertSQL = sprintf(
            "INSERT INTO cd_migracion_video (
        id_cd_migracion_sid,
        nombre_cd_migracion_video,
        url_cd_migracion_video
        ) VALUES (%s,%s,%s)",
            GetSQLValueString($_POST["id_cd_migracion_sid"], "int"),
            GetSQLValueString($_POST["nombre_cd_migracion_video"], "text"),
            GetSQLValueString($_POST["url_cd_migracion_video"], "text")
        );
        mysql_query($InsertSQL, $conexion) or die(mysql_error());
    }


    // BORRAR VIDEO
    if (isset($_POST["borrar_video_id_cd_migracion_sid"]) && '' != $_POST["borrar_video_id_cd_migracion_sid"]) {
        $idborrar = $_POST["borrar_video_id_cd_migracion_sid"];
        $queryUpdate = "UPDATE cd_migracion_video SET estado_cd_migracion_video = 0
            WHERE id_cd_migracion_video = $idborrar ";
        $result103 = $mysqli->query($queryUpdate);
        if ($result103 === TRUE) {
            auditoria(NULL, 'cd_migracion_video', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
        } else {
            echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
        }
        echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_migracion.jsp" />';
    }

?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">

                    <div class="col-md-4">
                        <h3 class="box-title">
                            <b>MIGRACIÓN SID ANTIGUO</b>
                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalsidcrearmigracion">Nuevo</button>
                        </h3>
                    </div>
                    <div class="box-tools pull-right">
                        <a href="control_proceso_migracion_reporte.jsp" class="btn btn-success btn-sm" target="_blank" style="padding-left: 10px;"><i class="fa fa-fw fa-table"></i> Historico</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>

                    <div class="col-md-5">
                        <form class="navbar-form" name="buscadorfinalizados474" method="POST">

                            <div class="input-group">
                                <div class="input-group-btn">Buscar
                                    <select class="form-control" name="campo" required>
                                        <option value="" selected> - - Buscar por: - - </option>
                                        <option value="proc_nro_radicacion_cdmso">Expediente</option>
                                        <?php if (1 == $_SESSION['rol'] or 0 < $nump143) { ?>
                                            <option value="OCDI">OCDI</option>
                                            <option value="REGISTRO">REGISTRO</option>
                                            <option value="NOTARIADO">NOTARIADO</option>
                                            <option value="CURADURIA">CURADURIA</option>
                                            <option value="JURIDICA">JURIDICA</option>
                                            <option value="DESPACHO">DESPACHO</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-group-btn">
                                    <input type="text" name="buscar" placeholder="Buscar" class="form-control">
                                </div>

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>



                <div class="box-body">
                    <div class="table-responsive" style="font-size:90%">

                        <table class="table table-bordered" id="migracion">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CREADO POR</th>
                                    <th># EXPEDIENTE</th>
                                    <th>ORIGEN</th>
                                    <th>TIPOLOGIA</th>
                                    <th>ENTIDAD</th>
                                    <th>IMPLICADOS</th>
                                    <th>AREA ACTUAL</th>
                                    <th>FASE</th>
                                    <th>ETAPA</th>
                                    <th>ESTADO</th>
                                    <th style="width: 170px;">ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (1 == $_SESSION['rol'] or 0 < $nump143) {
                                    if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                                        $querycpm2 = $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' AND estado_cdmso=1";
                                        $querycpmo2 = "AND (tipo_oficina_cdmso = 1 OR
                                        tipo_oficina_cdmso = 2 OR
                                        tipo_oficina_cdmso = 3 OR
                                        tipo_oficina_cdmso = 4 OR
                                        tipo_oficina_cdmso = 5 OR
                                        tipo_oficina_cdmso = 6)";
                                    } elseif (isset($_POST['campo']) && $_POST['campo'] == 'OCDI') {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                        $querycpmo2 = "AND tipo_oficina_cdmso = 1";
                                    } elseif (isset($_POST['campo']) &&  $_POST['campo'] == 'REGISTRO') {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                        $querycpmo2 = "AND tipo_oficina_cdmso = 2";
                                    } elseif (isset($_POST['campo']) &&  $_POST['campo'] == 'NOTARIADO') {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                        $querycpmo2 = "AND tipo_oficina_cdmso = 3";
                                    } elseif (isset($_POST['campo']) &&  $_POST['campo'] == 'CURADURIA') {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                        $querycpmo2 = "AND tipo_oficina_cdmso = 4";
                                    } elseif (isset($_POST['campo']) &&  $_POST['campo'] == 'JURIDICA') {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                        $querycpmo2 = "AND tipo_oficina_cdmso = 5";
                                    } elseif (isset($_POST['campo']) &&  $_POST['campo'] == 'DESPACHO') {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                        $querycpmo2 = "AND tipo_oficina_cdmso = 6";
                                    } else {
                                        $querycpm2 = "";
                                        $querycpmo2 = "tipo_oficina_cdmso = 0";
                                    }
                                } else {
                                    if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                                        $querycpm2 = $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' AND estado_cdmso=1";
                                    } else {
                                        $querycpm2 = "estado_expediente_cdmso='Activo' AND estado_cdmso=1";
                                    }
                                }
                                $querycpm4 = "SELECT * FROM cd_migracion_sid
                                WHERE $querycpm2
                                $querycpmo2 ";

                                $resultcpm4 = $mysqli->query($querycpm4);
                                while ($row = $resultcpm4->fetch_array(MYSQLI_ASSOC)) {
                                ?>
                                    <tr>
                                        <?php
                                        echo '<td>' . $row['id_cdms'] . '</td>';
                                        echo '<td>' . $row['nomenclatura_cdmso'] . '</td>';
                                        echo '<td>';
                                        if ($row['nomenclatura_cdmso'] == 'SDC') {
                                            if ($row['fase_cdmso'] == 'Juzgamiento' || $row['fase_cdmso'] == 'Segunda Instancia') {
                                                echo 'OCDI-JZ' . '-' . $row['id_cdms'] . '-' . $row['ano_cdmso'] . '-' . 'C-' . $row['proc_nro_radicacion_cdmso'];
                                            } else {
                                                echo 'C-' . $row['proc_nro_radicacion_cdmso'];
                                            }
                                        } else {
                                            if ($row['fase_cdmso'] == 'Juzgamiento' || $row['fase_cdmso'] == 'Segunda Instancia') {
                                                echo 'OCDI-JZ' . '-' . $row['id_cdms'] . '-' . $row['ano_cdmso'] . '-' . $row['proc_nro_radicacion_cdmso'];
                                            } else {
                                                echo $row['proc_nro_radicacion_cdmso'];
                                            }
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['proc_origen_cdmso'] == 'O') {
                                            echo 'De Oficio';
                                        }
                                        if ($row['proc_origen_cdmso'] == 'C') {
                                            echo 'Ciudadano';
                                        }
                                        if ($row['proc_origen_cdmso'] == 'A') {
                                            echo 'Falta identificar';
                                        }
                                        if ($row['proc_origen_cdmso'] == 'IO') {
                                            echo 'Informe oficial';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        echo isset($row['nombre_cd_tipo']) ? $row['nombre_cd_tipo'] : '';
                                        echo '</td>';
                                        echo '<td>';
                                        $id_cdms = $row['id_cdms'];
                                        $Query8 = "SELECT nombre_cd_migracion_entidad FROM cd_migracion_entidad 
                                            WHERE id_cdms_fk_cd_migracion_sid=$id_cdms AND estado_cd_migracion_entidad=1";
                                        $result8 = $mysqli->query($Query8);
                                        while ($row8 = $result8->fetch_array(MYSQLI_ASSOC)) {
                                            echo $row8['nombre_cd_migracion_entidad'] . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        $id_cdms = $row['id_cdms'];
                                        $Query9 = "SELECT nombre_cd_migracion_implicados FROM cd_migracion_implicados 
                                            WHERE id_cdms_fk_cd_migracion_sid=$id_cdms AND estado_cd_migracion_implicados=1";
                                        $result9 = $mysqli->query($Query9);
                                        while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) {
                                            echo $row9['nombre_cd_migracion_implicados'] . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['tipo_oficina_cdmso'] == 0) {
                                            echo 'Por Identificar';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 1) {
                                            echo 'OCDI - Oficina de Control Disciplinario Interno';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 2) {
                                            echo 'SDR - Superintendencia Delegada Para El Registro';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 3) {
                                            echo 'SDN - Superintendencia Delegada Para El Notariado';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 4) {
                                            echo 'SDC - Grupo para el control y vigilancia de Curadores Urbanos';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 5) {
                                            echo 'OAJ - Oficina Asesora Juridica';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 6) {
                                            echo 'DDS - Despacho Del Superintendente';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if (isset($row['fase_cdmso']) and '' <> $row['fase_cdmso']) {
                                            echo $row['fase_cdmso'];
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if (isset($row['etapa_cdmso']) and '' <> $row['etapa_cdmso']) {
                                            echo quees('cd_migracion_etapa', $row['etapa_cdmso']);
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['estado_expediente_cdmso'] == 'Activo') {
                                            echo 'Activo';
                                        } else {
                                            echo 'Finalizado';
                                        }
                                        echo '</td>';
                                        ?>
                                        <td>
                                            <?php
                                            $idCount = $row['id_cdms'];
                                            $Query19 = "SELECT count(estado_cd_migracion_file_sid) as ecmfs FROM cd_migracion_file_sid 
                                                LEFT JOIN cd_migracion_sid
                                                ON cd_migracion_file_sid.id_proc_cdmfs=cd_migracion_sid.proc_id_cdmso
                                                WHERE id_proc_cdmfs='$idCount' AND estado_cd_migracion_file_sid=1";
                                            $Resultado19 = $mysqli->query($Query19);
                                            $row19 = $Resultado19->fetch_array(MYSQLI_ASSOC);
                                            ?>
                                            <a style="cursor:pointer;" class="siddetallemigracion btn btn-success btn-xs" data-toggle="modal" data-target="#modalsiddetallemigracion" id="pdf-<?php echo $row['id_cdms'] . '-' . $row['tipo_oficina_cdmso']; ?>">
                                                <?php echo $row19['ecmfs']; ?> <i class="fa fa-fw fa-file-pdf-o" title="Cargar PDF"></i>
                                            </a>
                                            <?php
                                            $Query20 = "SELECT count(id_cd_migracion_video) AS countVideo FROM cd_migracion_video 
                                                LEFT JOIN cd_migracion_sid
                                                ON cd_migracion_video.id_cd_migracion_sid=cd_migracion_sid.id_cdms 
                                                WHERE id_cdms='$idCount' AND estado_cd_migracion_video=1";
                                            $Resultado20 = $mysqli->query($Query20);
                                            $row20 = $Resultado20->fetch_array(MYSQLI_ASSOC);
                                            ?>
                                            <a style="cursor:pointer;" class="siddetallemigracion btn btn-dropbox btn-xs" data-toggle="modal" data-target="#modalsiddetallemigracion" id="video-<?php echo $row['id_cdms'] . '-' . $row['tipo_oficina_cdmso']; ?>">
                                                <?php echo $row20['countVideo']; ?> <i class="fa fa-fw fa-file-video-o" title="Cargar Link de Video (audiencias)"></i>
                                            </a>
                                            <?php if (1 == $_SESSION['rol'] or 0 < $nump143 or 0 < $nump139 and ($row['tipo_oficina_cdmso'] == $GlobalTipoDeOficina)) { ?>
                                                <a style="cursor:pointer;" class="sidetapamigracion btn btn-warning btn-xs" data-toggle="modal" data-target="#modalsidetapamigracion" id="<?php echo $row['id_cdms'] . '-' . $GlobalTipoDeOficina; ?>">
                                                    <i class="fa fa-fw fa-pencil" title="Actualizar Información"></i>
                                                </a>
                                            <?php } ?>
                                            <?php if (1 == $_SESSION['rol'] or 0 < $nump143 or 0 < $nump131 and ($row['tipo_oficina_cdmso'] == $GlobalTipoDeOficina)) { ?>
                                                <a style="cursor:pointer;" class="sidoldtraslado btn btn-default btn-xs" data-toggle="modal" data-target="#modalsidoldtraslado" id="traslado-<?php echo $row['id_cdms']; ?>">
                                                    <i class="fa fa-exchange" title="Traslado entre Dependencias"></i>
                                                </a>
                                            <?php } ?>
                                            <?php if (1 == $_SESSION['rol'] or 0 < $nump143 or 0 < $nump131 and ($row['tipo_oficina_cdmso'] == $GlobalTipoDeOficina)) { ?>
                                                <a style="cursor:pointer;" class="sidoldtraslado btn btn-default btn-xs" data-toggle="modal" data-target="#modalsidoldtraslado" id="asignacion-<?php echo $row['id_cdms']; ?>">
                                                    <i class="fa fa-fw fa-user-plus" title="Asignación Expedientes"></i>
                                                </a>
                                            <?php } ?>
                                            <?php if (1 == $_SESSION['rol'] or 0 < $nump143) { ?>
                                                <form action="" method="post" name="eliminadologico" style="display:inline">
                                                    <input type="hidden" name="id_cdms" value="<?php echo $row['id_cdms']; ?>">
                                                    <input type="hidden" name="borrar_expediente" value="borrar">
                                                    <button type="submit" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash" title="Borrar Expediente"></i>
                                                    </button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                $resultcpm4->free();
                                ?>
                            </tbody>
                        </table>


                        <script>
                            $(document).ready(function() {
                                $('#migracion').DataTable({
                                    order: [
                                        [0, 'desc']
                                    ],
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'csv', 'excel'
                                    ],
                                    "lengthMenu": [
                                        [50, 100, 200, 300, 500],
                                        [50, 100, 200, 300, 500]
                                    ],
                                    "language": {
                                        "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                                    }
                                });
                            });
                        </script>

                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->

            </div> <!-- FINAL PRIMARY -->
        </div> <!-- FINAL DE COL MD 12 -->
    </div> <!-- FINAL DE ROW -->

    <!-- MODAL EMVIO DE NOTIFICACIONES -->
    <div class="modal fade" id="modalsiddetallemigracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <b>Cargar</b>
                </div>
                <div class="modal-body">
                    <div id="divsiddetallemigracion"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL NUEVO EXPEDIENTE -->
    <div class="modal fade" id="modalsidcrearmigracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <b>Nuevo Expediente</b>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" name="formassadashda342234">
                        <div class="form-group text-left">
                            <label>N Radicación</label>
                            <input class="form-control" type="text" name="proc_nro_radicacion_cdmso">
                        </div>
                        <div class="form-group text-left">
                            <label>Origen</label>
                            <select class="form-control" name="proc_origen_cdmso">
                                <option value="" selected>--- Seleccion ---</option>
                                <option value="O">De Oficio</option>
                                <option value="C">Ciudadano</option>
                                <option value="A">Falta identificar</option>
                                <option value="IO">Informe oficial</option>
                            </select>
                        </div>
                        <div class="form-group text-left">
                            <label class="control-label">Tipologia:</label>
                            <select class="form-control" name="nombre_cd_tipo">
                                <option value="" selected>--- Seleccion ---</option>
                                <?php $query5 = "SELECT * FROM cd_tipo WHERE id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND estado_cd_tipo=1";
                                $result = $mysqli->query($query5);
                                while ($row5 = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                                    <option value="<?php echo $row5['nombre_cd_tipo']; ?>"><?php echo $row5['nombre_cd_tipo']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group text-left">
                            <label>Etapa</label>
                            <select class="form-control" name="etapa_cdmso">
                                <option value="" selected>--- Seleccion ---</option>
                                <?php $Query24 = "SELECT * FROM cd_migracion_etapa WHERE estado_cd_migracion_etapa=1 ORDER BY nombre_cd_migracion_etapa ASC";
                                $Resul24 = $mysqli->query($Query24);
                                while ($row24 = $Resul24->fetch_array(MYSQLI_ASSOC)) {
                                    if (isset($row24['id_cd_migracion_etapa'])) {
                                        echo '<option value="' . $row24['id_cd_migracion_etapa'] . '">' . $row24['nombre_cd_migracion_etapa'] . '</option>';
                                    }
                                }
                                $Resul24->free();
                                ?>
                            </select>

                        </div>
                        <div class="form-group text-left">
                            <label>Estado Expediente</label>
                            <select class="form-control" name="estado_expediente_cdmso">
                                <option value="" selected>--- Seleccion ---</option>
                                <option value="Activo">Activo</option>
                                <option value="Finalizado">Finalizado</option>
                            </select>
                        </div>

                        <div class="form-group text-left">
                            <label><b>Observación</b></label>
                            <textarea class="form-control" name="observacion_cdmso" id="observacionMigracionSid" cols="10" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="nuevo_cd_migracion_sid">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ACTUALIZAR ETAPA -->
    <div class="modal fade" id="modalsidetapamigracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <b>Actualizar</b>
                </div>
                <div class="modal-body">
                    <div id="divsidetapamigracion"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA TRASLADO ENTRE DEPENDENCIAS -->
    <div class="modal fade" id="modalsidoldtraslado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Expediente</h4>
                </div>
                <div class="modal-body">
                    <div id="divsidoldtraslado"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcion para no duplicar envios de formularios
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        $(function() {
            CKEDITOR.replace('observacionMigracionSid');
            $("#identidadimplicadacdmso").select2({
                dropdownParent: $('#modalsidcrearmigracion')
            });
        });
    </script>
<?php } ?>