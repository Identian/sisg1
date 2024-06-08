<?php
$nump125 = privilegios(125, $_SESSION['snr']); // SID Auxiliar
$nump126 = privilegios(126, $_SESSION['snr']); // SID Profesional
$nump127 = privilegios(127, $_SESSION['snr']); // SID Coordinador
$nump128 = privilegios(128, $_SESSION['snr']); // SID Jefe
$nump129 = privilegios(129, $_SESSION['snr']); // SID ADMIN Noficador encargado de crear plantillas de notificacion
$nump130 = privilegios(130, $_SESSION['snr']); // SID Noficador recibe una notificacion 
$nump143 = privilegios(143, $_SESSION['snr']); // Usuario usado por sebastian

// VARIABLES GLOBALES
$GlobalIdFuncionario = $_SESSION['snr'];
$GlobalGrupoArea = $_SESSION['snr_grupo_area'];
$idControlDisciplinario = $_GET['i'];

// Oficina de Control Disciplinario Interno = 23
if ($GlobalGrupoArea == 23) {
    $GlobalTipoDeOficina = 1;
    $nomenclatura = 'OCDI';
    $asignadoGlobalGrupoArea = '23';

    // CONSULTA ADICIONAL POR QUE JUZGAMIENTO A OCDI LA REALIZA JURIDICA
    $query34 = "SELECT consecutivo_nomenclatura_cd FROM cd WHERE id_cd = $idControlDisciplinario";
    $result34 = $mysqli->query($query34);
    $row34 = $result34->fetch_array(MYSQLI_ASSOC);
    if ('OCDI' == $row34['consecutivo_nomenclatura_cd']) {
        $radicacion       = 1;
        $instruccion      = 1;
        $juzgamiento      = 0;
        $segundaInstancia = 0;
    } else {
        $radicacion       = 0;
        $instruccion      = 0;
        $juzgamiento      = 1;
        $segundaInstancia = 0;
    }
    $correoMasivoDesde = 'procesos.disciplinarios@supernotariado.gov.co,juzgamientoocdi@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// Superintendencia Delegada Para El Registro = 41
// Grupo de Inspeccion Vigilancia y Control Registral = 42
// Grupo de Gestion Disciplinaria Registral = 313
if ($GlobalGrupoArea == 41 or $GlobalGrupoArea == 42 or $GlobalGrupoArea == 313) {
    $GlobalTipoDeOficina = 2;
    $nomenclatura = 'SDR';
    $asignadoGlobalGrupoArea = '41,42,313';
    $radicacion       = 1;
    $instruccion      = 1;
    $juzgamiento      = 0;
    $segundaInstancia = 0;
    $correoMasivoDesde = 'instrucciondisciplinariaregistral@supernotariado.gov.co,alertasinstrucciondisciplinariaregistral@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// Superintendencia Delegada Para El Notariado = 44
// Direccion de Vigilancia y Control Notarial = 45 
if ($GlobalGrupoArea == 44 or $GlobalGrupoArea == 45) {
    $GlobalTipoDeOficina = 3;
    $nomenclatura = 'SDN';
    $asignadoGlobalGrupoArea = '44,45';
    $radicacion       = 1;
    $instruccion      = 1;
    $juzgamiento      = 0;
    $segundaInstancia = 0;
    $correoMasivoDesde = 'notificacionesdisciplinariosdn@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// Superintendencia Delegada para la Proteccion Restitucion y Formalizacion de Tierras = 297
// Grupo para el control y vigilancia de Curadores Urbanos = 305
if ($GlobalGrupoArea == 297 or $GlobalGrupoArea == 305) {
    $GlobalTipoDeOficina = 4;
    $nomenclatura = 'SDC';
    $asignadoGlobalGrupoArea = '297,305';
    $radicacion       = 1;
    $instruccion      = 1;
    $juzgamiento      = 0;
    $segundaInstancia = 0;
    $correoMasivoDesde = 'instrucciondisciplinariacuradores@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// Oficina Asesora Juridica = 12
if ($GlobalGrupoArea == 12) {
    $GlobalTipoDeOficina = 5;
    $nomenclatura = 'OAJ';
    $asignadoGlobalGrupoArea = '12';
    $radicacion       = 0;
    $instruccion      = 0;
    $juzgamiento      = 1;
    $segundaInstancia = 0;
    $correoMasivoDesde = 'juzgamiento.oaj@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// Despacho Del Superintendente = 1
if ($GlobalGrupoArea == 1) {
    $GlobalTipoDeOficina = 6;
    $nomenclatura = 'DDS';
    $asignadoGlobalGrupoArea = '1';
    $radicacion       = 0;
    $instruccion      = 0;
    $juzgamiento      = 0;
    $segundaInstancia = 1;
    $correoMasivoDesde = 'sisg@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// SUPER ADMINISTRADOR
if (1 == $_SESSION['rol'] or 0 < $nump143) {
    $GlobalTipoDeOficina = 3; // 3 = OFICINA NOTARIA
    $nomenclatura = 'SDN'; // NOMENCLATURA
    $asignadoGlobalGrupoArea = '44,45'; // AREAS QUE SE VEN EN LAS OPCIONES
    if (1 == $_SESSION['rol'] || 0 < $nump143) {
        $radicacion       = 1;
        $instruccion      = 1;
        $juzgamiento      = 1;
        $segundaInstancia = 1;
    }
    $correoMasivoDesde = 'sisg@supernotariado.gov.co';
    $correoCopiaOculta = '';
}

// SOLO SEGURIDAD DE ACCESO
if (0 < $nump125 or 0 < $nump127  or 0 < $nump128 or 1 == $_SESSION['rol'] or 0 < $nump143) {
    $seguridadFuncionarioAsignado = "";
} elseif (0 < $nump126) {
    $seguridadFuncionarioAsignado = "AND id_funcionario_fk_asignado=$GlobalIdFuncionario";
}

// CONSULTA PARA SEGURIDAD DEPENDIENDO DE LA OFICINA 
$query16 = "SELECT id_tipo_oficina_fk_tipo_oficina, consecutivo_nomenclatura_cd, estado_expediente_cd
FROM cd WHERE  
id_cd = $idControlDisciplinario
$seguridadFuncionarioAsignado
AND estado_cd=1
limit 1";
$result = $mysqli->query($query16);
$row16 = $result->fetch_array(MYSQLI_ASSOC);
$GlobalTipoDeOficinaQuery = $row16['id_tipo_oficina_fk_tipo_oficina'];
$NomenclaturaOficinaQuery = $row16['consecutivo_nomenclatura_cd'];
$estadoExpediente = $row16['estado_expediente_cd'];

// CONTROL DE INGRESO A LA APLICACION
if ((0 < $nump125 ||
        0 < $nump126 ||
        0 < $nump127 ||
        0 < $nump128 ||
        0 < $nump129) ||
    1 == $_SESSION['rol'] ||
    0 < $nump143
) {
   // PERMITE VER EL EXPEDIENTE SI SE TRASLADO A LA OFICINA ACTUAL cd_traslado 
   $querytraslado = "SELECT COUNT(id_cd_fk_cd_traslado) AS countTraslado FROM cd_traslado WHERE id_cd_fk_cd_traslado = $idControlDisciplinario AND dependencia_cd_traslado=$GlobalTipoDeOficina AND estado_cd_traslado=1 LIMIT 1";
    $resulttraslado = $mysqli->query($querytraslado);
    $row16 = $resulttraslado->fetch_array(MYSQLI_ASSOC);
    $countTraslado = $row16['countTraslado'];
    // LOGICA PARA MOSTRAR LAS DEPENDENCIAS
    if ($GlobalTipoDeOficina == 5 ||  $GlobalTipoDeOficina == 6 || 1 == $_SESSION['rol'] || 0 < $nump143) {
        $mostrarPage = 1;
    } elseif ($GlobalTipoDeOficina == 1) {
        if ($NomenclaturaOficinaQuery == $nomenclatura || 0 < $countTraslado) {
            $mostrarPage = 1;
        } else {
            $mostrarPage = 0;
        }
    } elseif ($GlobalTipoDeOficina == 2) {
        if ($NomenclaturaOficinaQuery == $nomenclatura || 0 < $countTraslado) {
            $mostrarPage = 1;
        } else {
            $mostrarPage = 0;
        }
    } elseif ($GlobalTipoDeOficina == 3) {
        if ($NomenclaturaOficinaQuery == $nomenclatura || 0 < $countTraslado) {
            $mostrarPage = 1;
        } else {
            $mostrarPage = 0;
        }
    } elseif ($GlobalTipoDeOficina == 4) {
        if ($NomenclaturaOficinaQuery == $nomenclatura || 0 < $countTraslado) {
            $mostrarPage = 1;
        } else {
            $mostrarPage = 0;
        }
    }

    // CONTROL DE VER SOLO PROCESOS DE LA DEPENDENCIA
    if (1 == $mostrarPage) {

        // VARIABLE GLOBAL CONTROLA VER PERO NO EDITAR
        if (
            isset($GlobalTipoDeOficina) &&
            $GlobalTipoDeOficina == $GlobalTipoDeOficinaQuery &&
            $estadoExpediente == 'Activo'
        ) {
            $GlobalVista = 0;
        } else {
            $GlobalVista = 1;
            if ($estadoExpediente == 'Finalizado') {
                echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span style="font-size: 16px;"><i class="fa fa-fw fa-bookmark-o"></i> <b>Expediente Finalizado.</b> </span>
                    </div>';
            } else {
                echo '<div class="alert alert-warning alert-dismissible" style="text-align:center;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span style="font-size: 16px;"><i class="fa fa-fw fa-bookmark-o"></i> Expediente Solo de Lectura.</span>
                    </div>';
            }
        }

        // Fecha Actual
        date_default_timezone_set("America/Bogota");
        $fechaActual = date("Y-m-d H:i:s");
        $anoActual = date("Y");

        // Funcion para la auditoria global
        function auditoria($idControlDisciplinario, $tabla, $idTabla, $accion, $GlobalIdFuncionario, $fechaActual, $conexion)
        {
            if (7 != $idControlDisciplinario) {
                $AuditoriaSQL = sprintf(
                    "INSERT INTO cd_auditoria (
                        id_cd_fk_cd_auditoria,
                        tabla_cd_auditoria,
                        id_tabla_cd_auditoria,
                        accion_cd_auditoria,
                        id_funcionario_fk_cd_auditoria,
                        fecha_creado_cd_auditoria) VALUES (%s,%s,%s,%s,%s,%s)",
                    GetSQLValueString($idControlDisciplinario, "text"),
                    GetSQLValueString($tabla, "text"),
                    GetSQLValueString($idTabla, "int"),
                    GetSQLValueString($accion, "text"),
                    GetSQLValueString($GlobalIdFuncionario, "int"),
                    GetSQLValueString($fechaActual, "date")
                );
                mysql_query($AuditoriaSQL, $conexion) or die(mysql_error());
            }
        }

        // FUNCION PARA ENVIAR CORREO DE LAS NOTIFICACIONES
        function envioCorreo($para, $correoMasivoDesde, $asunto, $cuerpoplantilla, $links, $radicado, $correoCopiaOculta, $mysqli)
        {
            $destinatario = "{$para}";
            // Asunto
            $asunto = "Nueva Correspondencia: {$radicado} - {$asunto}";
            //para el envío en formato HTML 
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            //dirección del remitente 
            $headers .= "From: Supernotariado <{$correoMasivoDesde}>\r\n";
            //direcciones que recibián copia 
            $headers .= "Cc: {$correoMasivoDesde}\r\n";
            //direcciones que recibirán copia oculta 
            $headers .= "Bcc: {$correoCopiaOculta}\r\n";
            // script apertura correos
            $infoacuse1 = base64_encode($para);
            $bodytag = str_replace("=", "", $infoacuse1);
            $infoacuse = $bodytag . '&' . $radicado;
            //Enviar EMail
            $cuerpoCompleto = '<img src="https://servicios.supernotariado.gov.co/pqrs/logo/' . $infoacuse . '.gif">';
            $cuerpoCompleto .= '<br><br><b>' . $radicado . '</b><br>';
            $cuerpoCompleto .= $cuerpoplantilla;
            //construccion de todos los links de los documentos enviados
            foreach ($links as $key => $value) {
                $query4 = "SELECT * FROM cd_anexos 
                WHERE cd_anexos.hash_cd_anexos = '$value'
                AND definitivo_cd_anexos=1 
                AND estado_cd_anexos=1 
                ORDER BY posicion_cd_anexos ASC";
                $Result4 = $mysqli->query($query4);
                $row4 = $Result4->fetch_array(MYSQLI_ASSOC);
                $cuerpoCompleto .= '<a href="https://servicios.supernotariado.gov.co/filesidtemp/' . $value . '.pdf" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a> Clave: ' . substr($value, -4) . '<br>';
            }

            $mail = @mail($destinatario, $asunto, $cuerpoCompleto, $headers);
            //Estado de envío de correo electrónico
            echo $mail ?  '<script type="text/javascript">swal(" OK !", " Correo enviado. N° Radicado: ' . $radicado . '  !", "success");</script>' :
                '<script type="text/javascript">swal(" Eliminado!", " El envío de correo falló. !", "error"); </script>';
        }

        // CREAR IRIS DE SALIDA
        function crearIris($asuntoCorrespondencia, $descripcionCorrespondencia, $tipoCorrespondencia, $idTipoDocumento, $paraint, $para, $conexionpostgres, $conexion)
        {
            $nump36 = privilegios(36, $_SESSION['snr']);
            if ("0" != $_SESSION['username_iris']) {
                $conexionpostgresql = pg_connect($conexionpostgres);
                if (!$conexionpostgresql) {
                    echo 'No se puede conectar con IRIS.';
                } else {
                    $username_iris = $_SESSION['username_iris'];
                    $queryi = "SELECT idusuario, nombre, apellido FROM usuario where username='$username_iris' limit 1";
                    $resultadoi = pg_query($queryi);
                    $num_resultadosi = pg_num_rows($resultadoi);
                    for ($i = 0; $i < $num_resultadosi; $i++) {
                        $rowi = pg_fetch_array($resultadoi);
                        $id_iris = $rowi['idusuario'];
                        $_SESSION['idiris'] = $id_iris;
                        $nombre_iris = $rowi['nombre'];
                        $apellido_iris = $rowi['apellido'];
                    }
                    $nombrec_iris = $nombre_iris . ' ' . $apellido_iris;
                    pg_free_result($resultadoi);
                }
                pg_close($conexionpostgresql);
            } else {
            }

            $conexionpostgresql = pg_connect($conexionpostgres);
            if (!$conexionpostgresql) {
                echo 'No se puede conectar con IRIS.';
            } else {

                if (('ER' == $tipoCorrespondencia) && (0 < $nump36 or 1 == $_SESSION['rol'] or 40 == $_SESSION['snr_grupo_area'])) {
                    $id_iris = '1642';

                    $recibida = 'true';
                    $interno = 'false';
                    $idestado = 8;
                    $ruta_archivo = '3-' . $_SESSION['snr'] . '-' . date("YmdGis");
                } else if ('IE' == $tipoCorrespondencia) {
                    $recibida = 'false';
                    $interno = 'true';
                    $idestado = 20;
                    $ruta_archivo = '1-' . $_SESSION['snr'] . '-' . date("YmdGis");
                } else if ('EE' == $tipoCorrespondencia) {
                    $recibida = 'false';
                    $interno = 'false';
                    $idestado = 15;
                    $ruta_archivo = '2-' . $_SESSION['snr'] . '-' . date("YmdGis");
                } else {
                }

                $anoiris = date("Y");
                $infoiris = 'SNR' . $anoiris . $tipoCorrespondencia;
                $query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1";
                $resultado = pg_query($query);
                $num_resultados = pg_num_rows($resultado);

                for ($i = 0; $i < $num_resultados; $i++) {
                    $row = pg_fetch_array($resultado);
                    $info2iris = $row['codigo'];
                }


                $info3iris = explode($anoiris . $tipoCorrespondencia, $info2iris);
                $info4iris = intval($info3iris[1]);
                $info5iris = $info4iris + 1;
                $info6iris = trim(substr('000000' . $info5iris, -6));
                $radicado_salida = 'SNR' . $anoiris . $tipoCorrespondencia . $info6iris;
                $fechairis = date("Y-m-d H:i:s");
                $fechaenvio = date("Y-m-d ") . '00:00:00';
                $textoiris4 = strip_tags($descripcionCorrespondencia);
                $string = preg_replace("/[\r\n|\n|\r]+/", " ", $textoiris4);
                $textoiris = $asuntoCorrespondencia . ': ' . $string;
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
                    fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                    GetSQLValueString('1', "text"),
                    GetSQLValueString($idTipoDocumento, "text"),
                    GetSQLValueString($radicado_salida, "text"),
                    GetSQLValueString($radicado_salida, "text"),
                    GetSQLValueString($asuntoCorrespondencia, "text"),

                    GetSQLValueString($idestado, "text"),
                    GetSQLValueString('3', "text"),
                    GetSQLValueString($recibida, "text"),
                    GetSQLValueString($interno, "text"),
                    GetSQLValueString('5,' . $id_iris . ' ', "text"),

                    GetSQLValueString($nombrec_iris . ' [USUARIO]', "text"),
                    GetSQLValueString('5,' . $paraint . ' ', "text"),
                    GetSQLValueString($para . ' / ', "text"),
                    GetSQLValueString('1', "text"),
                    GetSQLValueString('1', "text"),
                    GetSQLValueString('1', "text"),
                    GetSQLValueString($fechaenvio, "text"),
                    GetSQLValueString($fechairis, "text"),
                    GetSQLValueString($textoiris, "text"),
                    GetSQLValueString($id_iris, "text"),
                    GetSQLValueString($fechairis, "text")
                );
                $resultado = pg_query($consultab);
                pg_free_result($resultado);
                pg_close($conexionpostgresql);
            }

            $query55 = "SELECT count(id_correspondencia) as valorfm FROM correspondencia WHERE nombre_correspondencia='$radicado_salida' and estado_correspondencia=1";
            $select55 = mysql_query($query55, $conexion);
            $row55 = mysql_fetch_assoc($select55);
            if (0 < $row55['valorfm']) {
                echo 'Error de red, Genere nuevamente radicado !';
            } else {

                $insertSQL = sprintf(
                    "INSERT INTO correspondencia (
                    nombre_correspondencia, 
                    referencia, 
                    cedula_contratista, 
                    id_tipo_correspondencia, 
                    id_funcionario_de, 
                    id_funcionario_para, 
                    fecha_correspondencia, 
                    asunto_correspondencia, 
                    descripcion_correspondencia, 
                    id_tipo_oficina_de, 
                    codigo_oficina_de, 
                    id_tipo_oficina_para, 
                    codigo_oficina_para, 
                    ruta_documento, 
                    estado_correspondencia) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s)",
                    GetSQLValueString($radicado_salida, "text"),
                    GetSQLValueString($radicado_salida, "text"),
                    GetSQLValueString(NULL, "int"),
                    GetSQLValueString($idTipoDocumento, "text"),
                    GetSQLValueString($_SESSION['snr'], "int"),
                    GetSQLValueString($paraint, "int"),
                    GetSQLValueString($asuntoCorrespondencia, "text"),
                    GetSQLValueString($descripcionCorrespondencia, "text"),
                    GetSQLValueString($_SESSION['snr_tipo_oficina'], "int"),
                    GetSQLValueString($_SESSION['snr_area'], "int"),
                    GetSQLValueString(NULL, "int"),
                    GetSQLValueString(NULL, "int"),
                    GetSQLValueString($ruta_archivo . '.pdf', "text"),
                    GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion);

                mysql_free_result($Result);
            }
            mysql_free_result($select55);

            return $radicado_salida;
        }


        //  AGREGAR ENTIDADES E IMPLICADOS
        if (
            isset($_POST["grupo_cd_entidad"]) && $_POST["grupo_cd_entidad"] != "" &&
            isset($_POST["nombre_cd_implicado"]) && $_POST["nombre_cd_implicado"] != "" &&
            isset($_POST["crear_implicado_entidad"]) && $_POST["crear_implicado_entidad"] != ""
        ) {
            if (isset($GlobalTipoDeOficina) && 1 === $GlobalTipoDeOficina) {
                $division = explode("-", $_POST["grupo_cd_entidad"]);
                echo $nombreEntidad = $division[0];
                echo $grupoEntidad = $division[1];
            } else {
                $nombreEntidad = $_POST["nombre_cd_entidad"];
                $grupoEntidad = $_POST["grupo_cd_entidad"];
            }
            $insertSQLEntidad = sprintf(
                "INSERT INTO cd_entidad (
                id_cd_fk_cd_entidad,
                nombre_cd_entidad, 
                grupo_cd_entidad,
                fecha_creado_cd_entidad
                )VALUES (%s,%s,%s,%s)",
                GetSQLValueString($idControlDisciplinario, "int"),
                GetSQLValueString($nombreEntidad, "int"),
                GetSQLValueString($grupoEntidad, "int"),
                GetSQLValueString($fechaActual, "date")
            );
            $Result = mysql_query($insertSQLEntidad, $conexion) or die(mysql_error());
            $id_cd_entidad = mysql_insert_id($conexion);
            $insertSQLImplicado = sprintf(
                "INSERT INTO cd_implicado (
                id_cd_fk_cd_implicado,
                id_cd_entidad_fk_cd_implicado,
                cedula_cd_implicado, 
                nombre_cd_implicado,
                email_cd_implicado,
                direccion_cd_implicado,
                fecha_creado_cd_implicado
                )VALUES (%s,%s,%s,%s,%s,%s,%s)",
                GetSQLValueString($idControlDisciplinario, "int"),
                GetSQLValueString($id_cd_entidad, "int"),
                GetSQLValueString($_POST["cedula_cd_implicado"], "int"),
                GetSQLValueString($_POST["nombre_cd_implicado"], "text"),
                GetSQLValueString($_POST["email_cd_implicado"], "text"),
                GetSQLValueString($_POST["direccion_cd_implicado"], "text"),
                GetSQLValueString($fechaActual, "date")
            );
            $Result = mysql_query($insertSQLImplicado, $conexion) or die(mysql_error());
            // Auditoria cd_entidad
            auditoria($idControlDisciplinario, 'cd_entidad', $id_cd_entidad, $insertSQLEntidad, $GlobalIdFuncionario, $fechaActual, $conexion);
            // Auditoria cd_implicado
            auditoria($idControlDisciplinario, 'cd_implicado', $id_cd_entidad, $insertSQLImplicado, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        //  ACTUALIZAR ENTIDADES E IMPLICADOS
        if (
            isset($_POST["grupo_cd_entidad"]) && $_POST["grupo_cd_entidad"] != "" &&
            isset($_POST["nombre_cd_implicado"]) && $_POST["nombre_cd_implicado"] != "" &&
            isset($_POST["update_implicado_entidad"]) && $_POST["update_implicado_entidad"] != ""
        ) {
            if (isset($GlobalTipoDeOficina) && 1 === $GlobalTipoDeOficina) {
                $division = explode("-", $_POST["grupo_cd_entidad"]);
                echo $c1 = $division[0];
                echo $c2 = $division[1];
            } else {
                $c1 = $_POST["nombre_cd_entidad"];
                $c2 = $_POST["grupo_cd_entidad"];
            }
            $id = $_POST["id_cd_implicado"];
            $updateQuery = "UPDATE cd_entidad SET
            nombre_cd_entidad = '$c1',
            grupo_cd_entidad = '$c2'
            WHERE id_cd_entidad = $id";
            auditoria($idControlDisciplinario, 'cd_entidad', $id, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
            if ($mysqli->query($updateQuery) === TRUE) {
                $c1im = $_POST["cedula_cd_implicado"];
                $c2im = $_POST["nombre_cd_implicado"];
                $c3im = $_POST["email_cd_implicado"];
                $c4im = $_POST["direccion_cd_implicado"];
                $id = $_POST["id_cd_implicado"];
                $updateQueryim = "UPDATE cd_implicado SET
                cedula_cd_implicado = '$c1im',
                nombre_cd_implicado = '$c2im',
                email_cd_implicado = '$c3im',
                direccion_cd_implicado = '$c4im'
                WHERE id_cd_implicado = $id";
                auditoria($idControlDisciplinario, 'cd_implicado', $id, $updateQueryim, $GlobalIdFuncionario, $fechaActual, $conexion);
                $mysqli->query($updateQueryim);
                echo $actualizado;
            } else {
                echo "Error: " . $updateQueryim . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }


        // BORRAR ENTIDADES E IMPLICADOS
        if ((isset($_POST["borrar_id_cd_implicado"]) && '' != $_POST["borrar_id_cd_implicado"])) {
            $separ = explode("-", $_POST["borrar_id_cd_implicado"]);
            $id_cd_implicado = $separ[0];
            $id_cd_entidad = $separ[1];
            $queryUpdate0 = "UPDATE cd_entidad SET estado_cd_entidad = 0 WHERE id_cd_entidad = $id_cd_entidad ";
            $queryUpdate1 = "UPDATE cd_implicado SET estado_cd_implicado = 0 WHERE id_cd_implicado = $id_cd_implicado ";
            auditoria($idControlDisciplinario, 'cd_entidad', $id_cd_entidad, $queryUpdate0, $GlobalIdFuncionario, $fechaActual, $conexion);
            auditoria($idControlDisciplinario, 'cd_implicado', $id_cd_implicado, $queryUpdate1, $GlobalIdFuncionario, $fechaActual, $conexion);
            if ($mysqli->query($queryUpdate0) === TRUE && $mysqli->query($queryUpdate1) === TRUE) {
                echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
            } else {
                echo "Error: " . $queryUpdate0 . $queryUpdate1 . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        //  AGREGAR DOCUMENTOS ANEXOS
        if (
            isset($_FILES['file']) && "" != $_FILES['file'] &&
            isset($_POST['nombre_cd_anexos']) && "" != $_POST['nombre_cd_anexos'] &&
            isset($_POST['id_cd_accion_fk_cd_anexos']) && "" != $_POST['id_cd_accion_fk_cd_anexos'] &&
            isset($_POST['guardar_cd_anexos']) && "" != $_POST['guardar_cd_anexos']
        ) {
            //VALIDACION DE CAMPO definitivo_cd_anexos
            $NomFile = pathinfo(strtolower($_FILES['file']['name']));
            $ExtensionFile = $NomFile['extension'];
            if (isset($_POST['definitivo_cd_anexos']) && 
                'on' == $_POST['definitivo_cd_anexos'] && 
                ("pdf" == $ExtensionFile || "PDF" == $ExtensionFile)) {
                $Checkboxdefinitivo = 1;
            } else {
                $Checkboxdefinitivo = 0;
            }
            $NombreDocumento = $_POST['nombre_cd_anexos'];
            $pracdanexos = $_POST['pra_cd_anexos'];
            $observacionAnexos = $_POST['observacion_doc_cd_anexos'];
            $TipoDocumento = $_POST['id_cd_accion_fk_cd_anexos'];
            $tamano_archivo = 15728640;
            $formato_archivo = array('pdf', 'docx', 'doc', 'mp3');
            $carpeta_archivo = "filesnr/sid/" . $anoActual . "/";
            $ruta_archivo =  date("YmdGisu") . rtrim(strtr(base64_encode(date("YmdGisu")), '+/', '-_'), '=');

            if ($Checkboxdefinitivo == 1) {
                // CONSULTA PARA CONOCER EL NUMERO DE POSICION DE ANEXOS
                $Query33 = sprintf("SELECT MAX(posicion_cd_anexos) AS countPosicionAnexos
                FROM cd_anexos 
                WHERE id_cd_fk_cd_anexos=$idControlDisciplinario AND 
                      definitivo_cd_anexos = 1 AND 
                      estado_cd_anexos=1");
                $Result33 = $mysqli->query($Query33);
                $row33 = $Result33->fetch_array(MYSQLI_ASSOC);
                if ('' == $row33['countPosicionAnexos']) {
                    $countPosicionAnexos = 0;
                } else {
                    $countPosicionAnexos = $row33['countPosicionAnexos'] + 1;
                }
            } else {
                $countPosicionAnexos = NULL;
            }

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
                        $hash = md5($files);
                        $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo . $hash . '.' . $extension);
                        $nombreUc = ucwords($nombre);
                        $insertDocumento = sprintf("INSERT INTO cd_anexos (nombre_cd_anexos, pra_cd_anexos, definitivo_cd_anexos, id_cd_accion_fk_cd_anexos, id_cd_fk_cd_anexos, extension_cd_anexos, ano_creacion_cd_anexos, url_cd_anexos, observacion_doc_cd_anexos, hash_cd_anexos, id_funcionario_fk_cd_anexos, posicion_cd_anexos, fecha_creado_cd_anexos) 
                        VALUES 
                        ('$NombreDocumento', '$pracdanexos', $Checkboxdefinitivo, " . $TipoDocumento . ", " . $idControlDisciplinario . ", '$extension', '$anoActual', '$hash', '$observacionAnexos', '$hash', $GlobalIdFuncionario, '$countPosicionAnexos', '$fechaActual')");
                        $Result = mysql_query($insertDocumento, $conexion) or die(mysql_error());
                        $idInsert = mysql_insert_id($conexion);
                        auditoria($idControlDisciplinario, 'cd_anexos', $idInsert, $insertDocumento, $GlobalIdFuncionario, $fechaActual, $conexion);
                        echo $insertado;
                    } else {
                        echo  $doc_no_tipo;
                    }
                }
            } else {
                echo '<script type="text/javascript">swal(" ERROR !", " El archivo Supera los 15 Megas Permitidos. !", "error");</script>';
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        //  AGREGAR OBSERVACION A LA ACCION
        if (
            isset($_POST['id_cd_accion_fk_cd_anexos']) && "" != $_POST['id_cd_accion_fk_cd_anexos'] &&
            isset($_POST['observacion_cd_anexos']) && "" != $_POST['observacion_cd_anexos']
        ) {
            $insertSQL = sprintf(
                "INSERT INTO cd_anexos (
                id_cd_fk_cd_anexos,
                id_cd_accion_fk_cd_anexos,
                observacion_cd_anexos,
                id_funcionario_fk_cd_anexos,
                fecha_creado_cd_anexos
                )VALUES (%s,%s,%s,%s,%s)",
                GetSQLValueString($idControlDisciplinario, "int"),
                GetSQLValueString($_POST['id_cd_accion_fk_cd_anexos'], "int"),
                GetSQLValueString($_POST['observacion_cd_anexos'], "text"),
                GetSQLValueString($GlobalIdFuncionario, "int"),
                GetSQLValueString($fechaActual, "date")
            );
            $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
            $idInsert = mysql_insert_id($conexion);
            auditoria($idControlDisciplinario, 'cd_anexos', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // BORRAR DOCUMENTOS ANEXOS
        if ((isset($_POST["borrar_id_cd_anexos"]) && '' != $_POST["borrar_id_cd_anexos"])) {
            $idborrar = $_POST["borrar_id_cd_anexos"];
            $queryUpdate = "UPDATE cd_anexos SET estado_cd_anexos = 0 WHERE id_cd_anexos = $idborrar";
            auditoria($idControlDisciplinario, 'cd_anexos', $idborrar, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            if ($mysqli->query($queryUpdate) === TRUE) {
                echo '<script type="text/javascript">swal(" Eliminado!", " Borrado con Exito !", "error"); </script>';
            } else {
                echo "Error: " . $queryUpdate . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // AGREGAR ASIGNACION
        if (
            isset($_POST["para_cd_asignado_fk_id_funcionario"]) && $_POST["para_cd_asignado_fk_id_funcionario"] != "" &&
            isset($_POST["crear_asignacion_detalle"]) && $_POST["crear_asignacion_detalle"] != ""
        ) {
            $deGrupoArea = isset($_SESSION['snr_grupo_area']) ? $_SESSION['snr_grupo_area'] : 0;
            $funcionario_area = explode("-", $_POST["para_cd_asignado_fk_id_funcionario"]);
            $idfuncionario = $funcionario_area[0];
            $grupoarea = $funcionario_area[1];
            $insertSQL = sprintf(
                "INSERT INTO cd_asignado (
                id_cd_fk_cd_asignado, 
                de_cd_asignado_fk_id_funcionario,
                de_grupo_area,
                para_cd_asignado_fk_id_funcionario,
                para_grupo_area,
        
                motivo_cd_asignado,
                fecha_creado_cd_asignado) 
                VALUES 
                (%s,%s,%s,%s,%s, %s,%s)",
                GetSQLValueString($idControlDisciplinario, "int"),
                GetSQLValueString($GlobalIdFuncionario, "int"),
                GetSQLValueString($deGrupoArea, "int"),
                GetSQLValueString($idfuncionario, "int"),
                GetSQLValueString($grupoarea, "int"),

                GetSQLValueString($_POST["motivo_cd_asignado"], "text"),
                GetSQLValueString($fechaActual, "date")
            );
            $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
            $idInsert = mysql_insert_id($conexion);
            auditoria($idControlDisciplinario, 'cd', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
            // actualiza el id funcionario 
            $queryUpdate = "UPDATE cd SET id_funcionario_fk_asignado = $idfuncionario WHERE id_cd = $idControlDisciplinario";
            $mysqli->query($queryUpdate);
            auditoria($idControlDisciplinario, 'cd', $idInsert, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            // Actualizacion fecha asignacion
            $query6 = "SELECT fecha_asignacion AS fa FROM cd WHERE id_cd = $idControlDisciplinario AND estado_cd=1";
            $result6 = $mysqli->query($query6);
            $row6 = $result6->fetch_array(MYSQLI_ASSOC);
            if (is_null($row6['fa'])) {
                $queryUpdatefec = "UPDATE cd SET fecha_asignacion = '$fechaActual' WHERE id_cd = $idControlDisciplinario";
                $mysqli->query($queryUpdatefec);
            }
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // RETORNAR ASIGNACION
        if (
            isset($_POST["retornar_asignacion"]) && $_POST["retornar_asignacion"] != ""
        ) {
            $updateQuery = "UPDATE cd SET id_funcionario_fk_asignado = NULL
            WHERE id_cd = $idControlDisciplinario";
            auditoria($idControlDisciplinario, 'cd', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
            if ($mysqli->query($updateQuery) === TRUE) {
                echo $actualizado;
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // AGREGAR FASE E ETAPAS
        if (
            isset($_POST["id_cd_fase_fk_cd_detalle_etapa"]) && $_POST["id_cd_fase_fk_cd_detalle_etapa"] != "" &&
            isset($_POST["id_cd_etapa_fk_cd_detalle_etapa"]) && $_POST["id_cd_etapa_fk_cd_detalle_etapa"] != "" ||
            isset($_POST["crear_radicacion"]) && $_POST["crear_radicacion"] != "" ||
            isset($_POST["crear_instruccion"]) && $_POST["crear_instruccion"] != "" ||
            isset($_POST["crear_juzgamiento"]) && $_POST["crear_juzgamiento"] != "" ||
            isset($_POST["crear_segunda_instancia"]) && $_POST["crear_segunda_instancia"] != ""
        ) {
            $insertSQL = sprintf(
                "INSERT INTO cd_detalle_etapa (
                    id_cd_fk_cd_detalle_etapa,
                    id_cd_fase_fk_cd_detalle_etapa,
                    id_cd_etapa_fk_cd_detalle_etapa,
                    fecha_creado_cd_detalle_etapa
                    )VALUES (%s,%s,%s,%s)",
                GetSQLValueString($idControlDisciplinario, "int"),
                GetSQLValueString($_POST["id_cd_fase_fk_cd_detalle_etapa"], "int"),
                GetSQLValueString($_POST["id_cd_etapa_fk_cd_detalle_etapa"], "int"),
                GetSQLValueString($fechaActual, "date")
            );
            $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
            $idInsert = mysql_insert_id($conexion);
            auditoria($idControlDisciplinario, 'cd_detalle_etapa', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo $insertado;
            // }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // AGREGAR ETAPA Y ACCIONES
        if (
            isset($_POST["id_cd_etapa_fk_cd_detalle_accion"]) && $_POST["id_cd_etapa_fk_cd_detalle_accion"] != "" &&
            isset($_POST["id_cd_accion_fk_cd_detalle_accion"]) && $_POST["id_cd_accion_fk_cd_detalle_accion"] != "" &&
            isset($_POST["crear_accion"]) && $_POST["crear_accion"] != ""
        ) {
            $idaccion = explode("-", $_POST["id_cd_accion_fk_cd_detalle_accion"]);
            $id_cd_accion_fk_cd_detalle_accion_post = $idaccion[0];
            $tipo_notificacion_cd_accion = $idaccion[1];

            $id_cd_etapa_fk_cd_detalle_accion = $_POST["id_cd_etapa_fk_cd_detalle_accion"];

            $Query32 = "SELECT repetir_accion_cd_accion FROM cd_accion WHERE id_cd_accion=$id_cd_accion_fk_cd_detalle_accion_post AND estado_cd_accion=1";
            $Result32 = $mysqli->query($Query32);
            $row32 = $Result32->fetch_array(MYSQLI_ASSOC);
            $row32['repetir_accion_cd_accion'];
            if (1 == $row32['repetir_accion_cd_accion']) {
                $insertSQL = sprintf(
                    "INSERT INTO cd_detalle_accion (
                    id_cd_fk_cd_detalle_accion,
                    id_cd_detalle_etapa_fk_cd_detalle_accion,
                    id_cd_etapa_fk_cd_detalle_accion,
                    id_cd_accion_fk_cd_detalle_accion,
                    tipo_notificacion_cd_detalle_accion,
                    fecha_creado_cd_detalle_accion
                    )VALUES (%s,%s,%s,%s,%s,%s)",
                    GetSQLValueString($idControlDisciplinario, "int"),
                    GetSQLValueString($_POST["id_cd_detalle_etapa"], "int"),
                    GetSQLValueString($id_cd_etapa_fk_cd_detalle_accion, "int"),
                    GetSQLValueString($id_cd_accion_fk_cd_detalle_accion_post, "int"),
                    GetSQLValueString($tipo_notificacion_cd_accion, "int"),
                    GetSQLValueString($fechaActual, "date")
                );
                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                $idInsert = mysql_insert_id($conexion);
                auditoria($idControlDisciplinario, 'cd_detalle_accion', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo $insertado;
            } else {

                $Query14 = "SELECT COUNT(id_cd_accion_fk_cd_detalle_accion) AS contadoricafcda
                FROM cd_detalle_accion WHERE 
                id_cd_fk_cd_detalle_accion = $idControlDisciplinario AND
                id_cd_etapa_fk_cd_detalle_accion = $id_cd_etapa_fk_cd_detalle_accion AND
                id_cd_accion_fk_cd_detalle_accion =  $id_cd_accion_fk_cd_detalle_accion_post AND
                estado_cd_detalle_accion=1";
                $Result14 = $mysqli->query($Query14);
                $row14 = $Result14->fetch_array(MYSQLI_ASSOC);
                if (0 < $row14['contadoricafcda']) {
                    echo $repetido;
                } else {
                    $insertSQL = sprintf(
                        "INSERT INTO cd_detalle_accion (
                        id_cd_fk_cd_detalle_accion,
                        id_cd_detalle_etapa_fk_cd_detalle_accion,
                        id_cd_etapa_fk_cd_detalle_accion,
                        id_cd_accion_fk_cd_detalle_accion,
                        tipo_notificacion_cd_detalle_accion,
                        fecha_creado_cd_detalle_accion
                        )VALUES (%s,%s,%s,%s,%s,%s)",
                        GetSQLValueString($idControlDisciplinario, "int"),
                        GetSQLValueString($_POST["id_cd_detalle_etapa"], "int"),
                        GetSQLValueString($id_cd_etapa_fk_cd_detalle_accion, "int"),
                        GetSQLValueString($id_cd_accion_fk_cd_detalle_accion_post, "int"),
                        GetSQLValueString($tipo_notificacion_cd_accion, "int"),
                        GetSQLValueString($fechaActual, "date")
                    );
                    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                    $idInsert = mysql_insert_id($conexion);
                    auditoria($idControlDisciplinario, 'cd_detalle_accion', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
                    echo $insertado;
                }
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // INSERTAR HISTORIAL NOTIFICACION
        if (
            isset($_POST["editar_cd_historial_notificacion"]) && $_POST["editar_cd_historial_notificacion"] != "" &&
            isset($_POST["asunto_cd_historial_notificacion"]) && $_POST["asunto_cd_historial_notificacion"] != "" &&
            isset($_POST["cuerpo_cd_historial_notificacion"]) && $_POST["cuerpo_cd_historial_notificacion"] != ""
        ) {
            if (isset($_SESSION['username_iris']) and '' != $_SESSION['username_iris']) {
                // CREACION DE IRIS
                if (1642 == $_POST["id_iris_para_cd_historial_notificacion"]) {
                    $idUsuarioIris = 1642;
                    $NombreIris = $_POST["nombre_para_cd_historial_notificacion"];
                } else {
                    $ResIris = encontrarUsuarioIris($_POST["id_iris_para_cd_historial_notificacion"], $conexionpostgres);
                    $idUsuarioIris = $ResIris['idusuario'];
                    $NombreIris = $ResIris['nombre'] . ' ' . $ResIris['apellido'];
                }

                $radicadoCreado = crearIris(
                    $_POST["asunto_cd_historial_notificacion"],
                    $_POST["cuerpo_cd_historial_notificacion"],
                    $_POST["id_tipo_correspondencia_cd_historial_notificacion"],
                    $_POST["id_tipo_doc_cd_historial_notificacion"],
                    $idUsuarioIris,
                    $NombreIris,
                    $conexionpostgres,
                    $conexion
                );
                //  INSERT EL ENVIO DE LA NOTIFICACION
                if (isset($radicadoCreado) && '' != $radicadoCreado) {

                    // VALIDAR DIRECCION SI ES NULL
                    if (isset($_POST["direccion_destino_cd_historial_notificacion"]) && '' != $_POST["direccion_destino_cd_historial_notificacion"]) {
                        $diredestinocdhn = $_POST["direccion_destino_cd_historial_notificacion"];
                    } else {
                        $diredestinocdhn = NULL;
                    }

                    // VALIDAR EMAIL PARA SI ES NULL
                    if (isset($_POST["para_cd_historial_notificacion"]) && '' != $_POST["para_cd_historial_notificacion"]) {
                        $paracdhn = $_POST["para_cd_historial_notificacion"];
                    } else {
                        $paracdhn = NULL;
                    }

                    $insertSQL = sprintf(
                        "INSERT INTO cd_historial_notificacion (
                        nombre_cd_historial_notificacion,
                        id_cd_fk_cd_historial_notificacion,
                        desde_cd_historial_notificacion,
                        para_cd_historial_notificacion,

                        direccion_destino_cd_historial_notificacion,
                        asunto_cd_historial_notificacion,
                        cuerpo_cd_historial_notificacion,
                        links_cd_historial_notificacion,
                        fecha_creado_cd_historial_notificacion
                        )VALUES (%s,%s,%s,%s, %s,%s,%s,%s,%s)",
                        GetSQLValueString($radicadoCreado, "text"),
                        GetSQLValueString($idControlDisciplinario, "int"),
                        GetSQLValueString($_POST["desde_cd_historial_notificacion"], "text"),
                        GetSQLValueString($paracdhn, "text"),

                        GetSQLValueString($diredestinocdhn, "text"),
                        GetSQLValueString($_POST["asunto_cd_historial_notificacion"], "text"),
                        GetSQLValueString($_POST["cuerpo_cd_historial_notificacion"], "text"),
                        GetSQLValueString(implode(',', $_POST["array_cd_anexos"]), "text"),
                        GetSQLValueString($fechaActual, "date")
                    );
                    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                    $idInsert53a219b = mysql_insert_id($conexion);
                    auditoria($idControlDisciplinario, 'cd_historial_notificacion', $idInsert53a219b, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);


                    // CONSULTA PARA CONOCER EL NUMERO DE POSICION DE ANEXOS
                    $Query33 = sprintf("SELECT MAX(posicion_cd_anexos) AS countPosicionAnexos
                    FROM cd_anexos 
                    WHERE id_cd_fk_cd_anexos=$idControlDisciplinario AND 
                    definitivo_cd_anexos = 1 AND 
                    estado_cd_anexos=1");
                    $Result33 = $mysqli->query($Query33);
                    $row33 = $Result33->fetch_array(MYSQLI_ASSOC);
                    if ('' == $row33['countPosicionAnexos']) {
                        $countPosicionAnexos = 0;
                    } else {
                        $countPosicionAnexos = $row33['countPosicionAnexos'] + 1;
                    }


                    // INSERT DEL ANEXO PARA GUARDAR TAMBIEN LA NOTIFICACION
                    $ruta_archivo =  date("YmdGisu") . rtrim(strtr(base64_encode(date("YmdGisu")), '+/', '-_'), '=');
                    $files = $ruta_archivo . '.' . 'pdf';
                    $hash = md5($files);
                    $insertSQL = sprintf(
                        "INSERT INTO cd_anexos (
                        id_cd_fk_cd_anexos,
                        id_cd_h_n_fk_cd_anexos,
                        nombre_cd_anexos,
                        pra_cd_anexos,
                        definitivo_cd_anexos,
                        id_cd_accion_fk_cd_anexos,

                        extension_cd_anexos,
                        ano_creacion_cd_anexos,
                        url_cd_anexos,
                        hash_cd_anexos,
                        observacion_doc_cd_anexos,

                        id_funcionario_fk_cd_anexos,
                        posicion_cd_anexos,
                        fecha_creado_cd_anexos
                        )VALUES (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s)",
                        GetSQLValueString($idControlDisciplinario, "int"),
                        GetSQLValueString($idInsert53a219b, "int"),
                        GetSQLValueString($_POST["nombre_cd_anexos"], "text"),
                        GetSQLValueString('Aprobo', "text"),
                        GetSQLValueString(1, "int"),
                        GetSQLValueString($_POST["id_cd_accion_fk_cd_anexos"], "text"),

                        GetSQLValueString('pdf', "text"),
                        GetSQLValueString($anoActual, "int"),
                        GetSQLValueString($hash, "text"),
                        GetSQLValueString($hash, "text"),
                        GetSQLValueString('Cargado desde Notificacion', "text"),

                        GetSQLValueString($GlobalIdFuncionario, "int"),
                        GetSQLValueString($countPosicionAnexos, "int"),
                        GetSQLValueString($fechaActual, "date")
                    );
                    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                    $idInsertAnexo = mysql_insert_id($conexion);
                    auditoria($idControlDisciplinario, 'cd_anexos', $idInsertAnexo, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);

                    // INCLUDE PARA QUE SE GUARDE EL PDF EN LA CARPETA DEL SID
                    //revisar los slash linux (/) para windows (\) acceder a carpetas
                    $hashPdf3eb811 = $hash;
                    $rutaDir = dirname(__DIR__);
                    include $rutaDir . "/pdf/control_proceso_notificacion_pdf.php";

                    if ('correo' == $_POST["check_historial_notificacion"]) {
                        envioCorreo(
                            $_POST["para_cd_historial_notificacion"],
                            $_POST["desde_cd_historial_notificacion"],
                            $_POST["asunto_cd_historial_notificacion"],
                            $_POST["cuerpo_cd_historial_notificacion"],
                            $_POST["array_cd_anexos"],
                            $radicadoCreado,
                            $correoCopiaOculta,
                            $mysqli
                        );
                    } else {
                        echo '<script type="text/javascript">swal(" OK !", " N° Radicado: ' . $radicadoCreado . '  !", "success");</script>';
                    }
                }
            } else {
                echo '<script type="text/javascript">swal(" ERROR !", "No posee usuario de IRIS Configurado. !", "error");</script>';
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // INSERTAR NUEVA PERMISO
        if (
            isset($_POST["crear_permiso"]) && $_POST["crear_permiso"] != "" &&
            isset($_POST["identificacion"]) && $_POST["identificacion"] != "" &&
            isset($_POST["nombre_cd_permiso_file_sid"]) && $_POST["nombre_cd_permiso_file_sid"] != ""
        ) {
            $insertSQL = sprintf(
                "INSERT INTO cd_permiso_file_sid (
                id_cd,
                identificacion,
                nombre_cd_permiso_file_sid
                )VALUES (%s,%s,%s)",
                GetSQLValueString($idControlDisciplinario, "int"),
                GetSQLValueString($_POST["identificacion"], "int"),
                GetSQLValueString($_POST["nombre_cd_permiso_file_sid"], "text")
            );
            $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
            $idInsert = mysql_insert_id($conexion);
            auditoria($idControlDisciplinario, 'cd_permiso_file_sid', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // ACTUALIZAR PERMISO
        if (
            isset($_POST["actualizar_permiso"]) && $_POST["actualizar_permiso"] != "" &&
            isset($_POST["id_cd_permiso_file_sid"]) && $_POST["id_cd_permiso_file_sid"] != "" &&
            isset($_POST["identificacion"]) && $_POST["identificacion"] != "" &&
            isset($_POST["nombre_cd_permiso_file_sid"]) && $_POST["nombre_cd_permiso_file_sid"] != ""
        ) {
            $c1 = $_POST["identificacion"];
            $c2 = $_POST["nombre_cd_permiso_file_sid"];
            $idPermiso = $_POST["id_cd_permiso_file_sid"];
            $updateQuery = "UPDATE cd_permiso_file_sid SET
            identificacion = '$c1',
            nombre_cd_permiso_file_sid = '$c2'
            WHERE id_cd_permiso_file_sid = $idPermiso";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'cd_permiso_file_sid', $idPermiso, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo $actualizado;
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
                echo '<script type="text/javascript">swal(" ERROR!", " Campos vacios por favor validar los campos obligatorios !", "error"); </script>';
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // BORRAR PERMISO
        if (
            isset($_POST["btnBorrarPermiso"]) && $_POST["btnBorrarPermiso"] != "" &&
            isset($_POST["id_cd_permiso_file_sid"]) && $_POST["id_cd_permiso_file_sid"] != ""
        ) {
            $idPermiso = $_POST["id_cd_permiso_file_sid"];
            $updateQuery = "UPDATE cd_permiso_file_sid SET
            estado_cd_permiso_file_sid = 0
            WHERE id_cd_permiso_file_sid = $idPermiso";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'cd_permiso_file_sid', $idPermiso, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo '<script type="text/javascript">swal(" OK!", " Borrado Correctamente !", "success"); </script>';
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
                echo '<script type="text/javascript">swal(" ERROR!", " Campos vacios por favor validar los campos obligatorios !", "error"); </script>';
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        //  ACTUALIZAR ENTIDADES E IMPLICADOS
        if (
            isset($_POST["editar_cd"]) && $_POST["editar_cd"] != "" and
            isset($_POST["radicacion_iris_cd"]) && $_POST["radicacion_iris_cd"] != "" and
            isset($_POST["fecha_queja_cd"]) && $_POST["fecha_queja_cd"] != "" and
            isset($_POST["fecha_traslado_cd"]) && $_POST["fecha_traslado_cd"] != "" and
            isset($_POST["canal_entrada_cd"]) && $_POST["canal_entrada_cd"] != "" and
            isset($_POST["nombre_quejoso_cd"]) && $_POST["nombre_quejoso_cd"] != "" and
            isset($_POST["asunto_cd"]) && $_POST["asunto_cd"] != ""
        ) {
            $c1 = $_POST["canal_entrada_cd"];
            $c2 = $_POST["id_cd_tipo_fk_cd_tipo"];
            $c3 = $_POST["nombre_quejoso_cd"];
            $c4 = $_POST["nombre_entidad_cd"];
            $c5 = $_POST["fecha_queja_cd"];
            $c6 = $_POST["fecha_traslado_cd"];
            // Funcion para sumar 5 años
            if (isset($_POST["fecha_hechos_cd"])) {
                $c7 = date($_POST["fecha_hechos_cd"]);
                $c8 = date("Y-m-d", strtotime($c7 . "+ 5 year"));
            } else {
                $c7 = NULL;
                $c8 = NULL;
            }
            $c9 = $_POST["asunto_cd"];
            $c10 = $_POST["radicacion_iris_cd"];
            $c11 = $_POST["iris_traslado_cd"];
            $updateQuery = "UPDATE cd SET
            canal_entrada_cd = '$c1',
            id_cd_tipo_fk_cd_tipo = '$c2',
            nombre_quejoso_cd = '$c3',
            nombre_entidad_cd = '$c4',
            fecha_queja_cd = '$c5',
            fecha_traslado_cd = '$c6',
            fecha_hechos_cd = '$c7',
            fecha_prescripcion_cd = '$c8',
            asunto_cd = '$c9',
            radicacion_iris_cd = '$c10',
            iris_traslado_cd = '$c11'
            WHERE id_cd = $idControlDisciplinario";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'cd', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo $actualizado;
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
                echo '<script type="text/javascript">swal(" ERROR!", " Campos vacios por favor validar los campos obligatorios !", "error"); </script>';
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // BORRAR UNA ETAPA - SOLO LO HACE EL JEFE
        if (
            isset($_POST["borrar_etapa"]) && $_POST["borrar_etapa"] != "" &&
            isset($_POST["id_cd_detalle_etapa"]) && $_POST["id_cd_detalle_etapa"] != ""
        ) {
            $uno = $_POST["id_cd_detalle_etapa"];
            $updateQuery = "UPDATE cd_detalle_etapa SET estado_cd_detalle_etapa = 0
            WHERE id_cd_detalle_etapa = $uno";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'Borrar Etapa cd_detalle_etapa', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo '<script type="text/javascript">swal(" OK !", "Se Borro Etapa correctamente. !", "success");</script>';
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // BORRAR UNA ACCION - SOLO LO HACE EL JEFE
        if (
            isset($_POST["borrar_accion"]) && $_POST["borrar_accion"] != "" &&
            isset($_POST["id_cd_detalle_accion"]) && $_POST["id_cd_detalle_accion"] != ""
        ) {
            $uno = $_POST["id_cd_detalle_accion"];
            $updateQuery = "UPDATE cd_detalle_accion
            LEFT JOIN cd_anexos
            ON cd_detalle_accion.id_cd_detalle_accion = cd_anexos.id_cd_accion_fk_cd_anexos
            SET cd_detalle_accion.estado_cd_detalle_accion = 0, cd_anexos.estado_cd_anexos = 0  
            WHERE cd_detalle_accion.id_cd_detalle_accion = $uno";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'Borrar Accion cd_detalle_accion + cd_anexos', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo '<script type="text/javascript">swal(" OK !", "Se Borro Acción correctamente. !", "success");</script>';
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // FINALIZAR EXPEDIENTE
        if (
            isset($_POST["finalizar_expediente"]) && $_POST["finalizar_expediente"] != ""
        ) {
            $finalizado = 'Finalizado';
            $updateQuery = "UPDATE cd SET estado_expediente_cd = '$finalizado' WHERE id_cd = $idControlDisciplinario";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'Finalizar Expediente', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo '<script type="text/javascript">swal(" OK !", "Se Finalizo correctamente. !", "success");</script>';
                echo '<meta http-equiv="refresh" content="0;URL=./control_proceso.jsp" />';
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // FINALIZAR EXPEDIENTE
        if (
            isset($_POST["activo_expediente"]) && $_POST["activo_expediente"] != ""
        ) {
            $Activo = 'Activo';
            $updateQuery = "UPDATE cd SET estado_expediente_cd = '$Activo' WHERE id_cd = $idControlDisciplinario";
            if ($mysqli->query($updateQuery) === TRUE) {
                auditoria($idControlDisciplinario, 'Activo Expediente', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
                echo '<script type="text/javascript">swal(" OK !", "Se Activo correctamente. !", "success");</script>';
                echo '<meta http-equiv="refresh" content="0;URL=./control_proceso.jsp" />';
            } else {
                echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
            }
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

        // ELIMINAR LA FASE DE JUZGAMIENTO - CUANDO SE COMETE ERROR
        if (isset($_POST["borrar_juzgamiento"]) && '' != $_POST["borrar_juzgamiento"]) {
            $idcddetalle = $_POST["borrar_juzgamiento"];
            $queryUpdate = "UPDATE cd SET nomenclatura_juzgamiento_cd = NULL WHERE id_cd = $idcddetalle LIMIT 1";
            $mysqli->query($queryUpdate);
            auditoria(NULL, 'cd', $idcddetalle, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
            echo '<meta http-equiv="refresh" content="0;URL=./control_proceso_detalle&' . $idControlDisciplinario . '.jsp" />';
        }

?>

        <style>
            .capitalize {
                text-transform: capitalize !important;
                font-size: 14px;
            }

            .direct-chat-info {
                display: block;
                margin-bottom: 2px;
                font-size: 14px;
            }

            .Radicacion {
                background: #1DBFD3;
                color: white;
                padding: 3px;
                border-radius: 3px;
                font-size: 13px;
            }

            .direct-chat-msg {
                margin-bottom: 10px;
                margin-top: 10px;
                border-bottom: solid 1px #A5A1A1;
                border-top: solid 1px #A5A1A1;
                padding: 10px;
            }

            .Instruccion {
                background: purple;
                color: white;
                padding: 3px;
                border-radius: 3px;
                font-size: 13px;
            }

            .Juzgamiento {
                background: orange;
                color: white;
                padding: 3px;
                border-radius: 3px;
                font-size: 13px;
            }

            .primera_instancia {
                background: #EC7063;
                color: white;
                padding: 3px;
                border-radius: 3px;
                font-size: 13px;
            }

            .segunda_instancia {
                background: #239B56;
                color: white;
                padding: 3px;
                border-radius: 3px;
                font-size: 13px;
            }

            .alertaRoja {
                background: #C73516;
                color: white;
                padding: 2px;
                border-radius: 3px;
                font-size: 12px;
                font-weight: 800;
            }

            .etapa {
                background: #CCC;
                color: black;
                padding: 4px;
                border-radius: 3px;
                font-size: 12px;
            }

            .divscroll200 {
                overflow-y: scroll;
                overflow-x: scroll;
                height: 200px;
            }

            .divscroll100 {
                overflow-y: scroll;
                overflow-x: scroll;
                height: 100px;
            }

            .divscroll80 {
                overflow-y: scroll;
                overflow-x: scroll;
                height: 80px;
            }

            .textoTachado {
                text-decoration: line-through;
            }

            .fuente10 {
                font-size: 10px;
            }


            .info-box-sid {
                border-radius: 50px;
                float: left;
                height: 50px;
                width: 50px;
                text-align: center;
                font-size: 30px;
                line-height: 50px;
                border: 1px solid #B2BABB;
            }

            .alertabaja {
                background-color: #00a65a;
                color: white;
            }

            .alertamedia {
                background-color: #FFCE33;
                color: white;
            }

            .alertaalta {
                background-color: #E74C3C;
                color: white;
            }

            .info-box-sidA {
                border-radius: 50px;
                float: left;
                height: 50px;
                width: 50px;
                text-align: center;
                font-size: 30px;
                line-height: 50px;
            }

            .sortable li {
                padding: 2px;
                list-style: none;
                margin-top: 0;
                margin-bottom: 5px;
                margin-left: -40px;
            }
        </style>

        <script src="../plugins/ckeditor40/ckeditor.js"></script>

        <div class="row">
            <div class="col-md-8 col-sm-8">

                <!-- INFORMACION INICIAL -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <b>Información Inicial</b>
                        <div class="box-tools pull-right">
                            <a href="control_proceso.jsp" class="btn btn-default btn-xs" title="Regreso a Tablero Expedientes">Regresar</a>
                            <?php if (0 == $GlobalVista) { ?>
                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditarExpediente" title="Editar Expediente"><span class="fa fa-fw fa-pencil"></span></button>
                            <?php } ?>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="col-md-12 col-sm-12">
                            <?php
                            $query4 = "SELECT * FROM cd WHERE id_cd = $idControlDisciplinario";
                            $result = $mysqli->query($query4);
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            ?>
                            <?php echo $row['checkbox_prioritario_cd'] == 1 ? '<span style="font-size: 13px;" class="alertaRoja">Prioritario</span><br>' : ''; ?>
                            <strong> CONSECUTIVO: </strong>
                            <span class="text-muted">
                                <?php
                                if (
                                    isset($row['nomenclatura_juzgamiento_cd']) && (1 == $_SESSION['rol'] || 0 < $nump143))
                                { ?>
                                    <form action="" name="quitarnomenclaturajz" method="post" style="display: inline;">
                                        <input type="hidden" name="borrar_juzgamiento" value="<?php echo $idControlDisciplinario; ?>">
                                        <button class="btn btn-xs btn-danger" type="submit" title="Eliminar Nomenclatura Fase de Juzgamiento"><i class="fa fa-trash-o"></i> <?php echo $row['nomenclatura_juzgamiento_cd']; ?></button>
                                    </form>
                                <?php echo '-' . $row['consecutivo_numero_cd'] . '-' . $row['consecutivo_ano_cd'];
                                } else {
                                    echo $row['nomenclatura_juzgamiento_cd'] . $row['consecutivo_nomenclatura_cd'] . '-' . $row['consecutivo_numero_cd'] . '-' . $row['consecutivo_ano_cd'];
                                }
                                ?>
                            </span>
                            <br>
                            <strong> RADICACIÓN IRIS: </strong>
                            <span class="text-muted">
                                <?php $radicacioniris = $row['radicacion_iris_cd'];
                                $array = explode(",", $radicacioniris);
                                foreach ($array as $key => $value) {
                                    if (isset($row['radicacion_iris_cd']) && "" != $row['radicacion_iris_cd']) { ?>
                                        <a href="https://sisg.supernotariado.gov.co/correspondencia&<?php echo $value; ?>.jsp" target="_blank"><?php echo $value; ?> <img src="images\pdf.png" alt="imagen pdf"></a>
                                <?php }
                                } ?>
                            </span>
                            <br>
                            <strong> FECHA DE QUEJA: </strong>
                            <span class="text-muted"> <?php echo $row['fecha_queja_cd'] ? $row['fecha_queja_cd'] : ''; ?> </span>
                            <br>
                            <strong> IRIS DEL TRASLADO: </strong>
                            <span class="text-muted">
                                <?php $radicacioniris = $row['iris_traslado_cd'];
                                $array = explode(",", $radicacioniris);
                                foreach ($array as $key => $value) {
                                    if (isset($row['iris_traslado_cd']) && "" != $row['iris_traslado_cd']) { ?>
                                        <a href="https://sisg.supernotariado.gov.co/correspondencia&<?php echo $value; ?>.jsp" target="_blank"><?php echo $value; ?> <img src="images\pdf.png" alt="imagen pdf"></a>
                                <?php }
                                } ?>
                            </span>
                            <br>
                            <strong> FECHA DEL TRASLADO A DISCIPLINARIO: </strong>
                            <span class="text-muted"> <?php echo $row['fecha_traslado_cd'] ? $row['fecha_traslado_cd'] : ''; ?> </span>
                            <br>
                            <strong> CANAL DE ENTRADA: </strong>
                            <span class="text-muted"> <?php echo $row['canal_entrada_cd'] ? $row['canal_entrada_cd'] : ''; ?> </span>
                            <br>
                            <strong> TIPOLOGIA: </strong>
                            <span class="text-muted"> <?php echo isset($row['id_cd_tipo_fk_cd_tipo']) ? quees('cd_tipo', $row['id_cd_tipo_fk_cd_tipo']) : ''; ?> </span>
                            <br>
                            <strong> NOMBRE DEL QUEJOSO: </strong>
                            <span class="text-muted"> <?php echo $row['nombre_quejoso_cd'] ? $row['nombre_quejoso_cd'] : ''; ?> </span>
                            <br>
                            <strong> ENTIDAD: </strong>
                            <span class="text-muted"> <?php echo $row['nombre_entidad_cd'] ? $row['nombre_entidad_cd'] : ''; ?> </span>
                            <br>
                            <strong> FECHA DE HECHOS: </strong>
                            <span class="text-muted"> <?php echo $row['fecha_hechos_cd'] ? $row['fecha_hechos_cd'] : '<span class="alertaRoja">Por Determinar</span>'; ?> </span>
                            <br>
                            <strong> FECHA DE PRESCRIPCIÓN: </strong>
                            <span class="text-muted"> <?php echo $row['fecha_prescripcion_cd']; ?> </span>
                            <br>
                            <strong> ASUNTO: </strong>
                            <span class="text-muted">
                                <a data-toggle="collapse" href="#multiCollapseExample0" role="button" aria-expanded="false" aria-controls="multiCollapseExample0"><button class="btn btn-xs"><i class="fa fa-fw fa-plus-circle"></i> Detalle</button></a>
                                <div class="col-md-12 col-sm-12">
                                    <div class="collapse multi-collapse" id="multiCollapseExample0">
                                        <div class="card card-body">
                                            <?php echo $row['asunto_cd']; ?>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <br>
                        </div>
                    </div>
                </div>

                <!-- INFORMACION DETALLE -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <b>Fases | Etapas</b>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <div class="direct-chat-messages" style="height: 1200px;">
                            <!-- Message. Default to the left -->
                            <?php $Query7 = sprintf("SELECT * FROM cd_detalle_etapa 
                            WHERE estado_cd_detalle_etapa=1 AND  
                            id_cd_fk_cd_detalle_etapa=$idControlDisciplinario
                            ORDER BY id_cd_detalle_etapa DESC");
                            $Resultado7 = $mysqli->query($Query7);
                            while ($row7 = $Resultado7->fetch_array(MYSQLI_ASSOC)) {
                                if (isset($row7['id_cd_detalle_etapa'])) { ?>
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left capitalize">
                                                <!-- Fase -->
                                                <?php $idCdDetalleEtapa = $row7['id_cd_detalle_etapa'];
                                                $Query10 = "SELECT * FROM cd_detalle_etapa 
                                                    LEFT JOIN cd_fase
                                                    ON cd_detalle_etapa.id_cd_fase_fk_cd_detalle_etapa=cd_fase.id_cd_fase
                                                    LEFT JOIN cd_etapa
                                                    ON cd_detalle_etapa.id_cd_etapa_fk_cd_detalle_etapa=cd_etapa.id_cd_etapa
                                                    WHERE id_cd_detalle_etapa='" . $idCdDetalleEtapa . "' AND 
                                                    cd_detalle_etapa.id_cd_fk_cd_detalle_etapa = $idControlDisciplinario AND
                                                    estado_cd_detalle_etapa=1";
                                                $Result = $mysqli->query($Query10);
                                                $row10 = $Result->fetch_array(MYSQLI_ASSOC); ?>
                                                <span class="btn btn-xs <?php echo isset($row10['nombre_estilo_cd_fase']) ? $row10['nombre_estilo_cd_fase'] : ''; ?>">
                                                    <b>FASE</b> - <?php echo isset($row10['nombre_cd_fase']) ? $row10['nombre_cd_fase'] : ''; ?>
                                                </span>

                                                <?php
                                                // BORRAR LA ETAPA
                                                $idEtapa = $row7['id_cd_etapa_fk_cd_detalle_etapa'];
                                                $idAccionEtapa = $row10['id_cd_etapa'];
                                                $Query31 = "SELECT COUNT(id_cd_detalle_etapa_fk_cd_detalle_accion) AS countborraetapa FROM cd_detalle_accion 
                                                    WHERE id_cd_etapa_fk_cd_detalle_accion=$idAccionEtapa 
                                                    AND id_cd_detalle_etapa_fk_cd_detalle_accion=$idCdDetalleEtapa 
                                                    AND estado_cd_detalle_accion=1";
                                                $Result31 = $mysqli->query($Query31);
                                                $row31 = $Result31->fetch_array(MYSQLI_ASSOC);
                                                $countBorraEtapa = $row31['countborraetapa'];
                                                if (0 == $countBorraEtapa) {
                                                    if (0 == $GlobalVista) {
                                                        // CONTROL ENTRE FASES
                                                        if (($radicacion == 1 && $row10['id_cd_fase'] == 1) or
                                                            ($instruccion == 1 && $row10['id_cd_fase'] == 2) or
                                                            ($juzgamiento == 1 && $row10['id_cd_fase'] == 3) or
                                                            ($segundaInstancia == 1 && $row10['id_cd_fase'] == 5)
                                                        ) {
                                                            if (1 == $_SESSION['rol'] or 0 < $nump128 or 0 < $nump143) { ?>
                                                                <form action="" method="post" name="borraretapa5656" style="display:inline">
                                                                    <input type="hidden" name="id_cd_detalle_etapa" value="<?php echo $row7['id_cd_detalle_etapa']; ?>">
                                                                    <input type="hidden" name="borrar_etapa" value="borrarEtapa">
                                                                    <button type="submit" class="btn btn-danger btn-xs" title="Borrar Etapa"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                } ?>

                                                <!-- ETAPA -->
                                                <!-- CONSULTA ETAPA -->
                                                <?php if ($GlobalVista == 0) {
                                                    // CONTROL ENTRE FASES
                                                    if (($radicacion == 1 && $row10['id_cd_fase'] == 1) or
                                                        ($instruccion == 1 && $row10['id_cd_fase'] == 2) or
                                                        ($juzgamiento == 1 && $row10['id_cd_fase'] == 3) or
                                                        ($segundaInstancia == 1 && $row10['id_cd_fase'] == 5)
                                                    ) {
                                                        echo '<a class="btn btn-xs etapa controlProcesoAccionEtapa" id="' . $row7['id_cd_etapa_fk_cd_detalle_etapa'] . '-' . $row7['id_cd_detalle_etapa'] . '" data-toggle="modal" data-target="#modalEtapa">';
                                                    } else {
                                                        echo '<a class="btn btn-xs etapa">';
                                                    }
                                                } elseif ($GlobalVista == 1) {
                                                    echo '<a class="btn btn-xs etapa">';
                                                } ?>
                                                <b>ETAPA</b> -
                                                <?php if (1 == $_SESSION['rol']) {
                                                    echo $row7['id_cd_etapa_fk_cd_detalle_etapa'] . ' - ' . $idCdDetalleEtapa;
                                                } ?>
                                                <?php echo isset($row10['nombre_cd_etapa']) ? $row10['nombre_cd_etapa'] : ''; ?>
                                                <i class="fa fa-fw fa-plus-circle"></i>
                                                <!-- Contador de Acciones conocer en la etapa -->
                                                <?php $idAccionEtapa = $row10['id_cd_etapa'];
                                                $Query15 = "SELECT COUNT(id_cd_detalle_etapa_fk_cd_detalle_accion) AS countEtapa FROM cd_detalle_accion 
                                                    WHERE id_cd_etapa_fk_cd_detalle_accion=$idAccionEtapa 
                                                    AND id_cd_detalle_etapa_fk_cd_detalle_accion=$idCdDetalleEtapa 
                                                    AND estado_cd_detalle_accion=1";
                                                $Result15 = $mysqli->query($Query15);
                                                $row15 = $Result15->fetch_array(MYSQLI_ASSOC);
                                                echo $row15['countEtapa']; ?>
                                                </a>
                                            </span>
                                            <!-- Fecha Creación -->
                                            <span class="direct-chat-timestamp pull-right">
                                                Fecha Creación: <?php echo $row7['fecha_creado_cd_detalle_etapa']; ?>&nbsp;&nbsp;
                                                <a class="direct-chat-timestamp pull-right capitalize" data-toggle="collapse" href="#multiCollapseFase<?php echo $row7['id_cd_detalle_etapa']; ?>" role="button" aria-expanded="true" aria-controls="multiCollapseFase<?php echo $row7['id_cd_detalle_etapa']; ?>">
                                                    <button class="btn btn-xs"><i class="fa fa-fw fa-plus-circle"></i></button>
                                                </a>
                                            </span><br><br>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="collapse multi-collapse in" id="multiCollapseFase<?php echo $row7['id_cd_detalle_etapa']; ?>" aria-expanded="true">
                                                    <div class="card card-body">
                                                        <?php // Consulta Etapa
                                                        $idAccionEtapa = $row10['id_cd_etapa'];
                                                        $Query11 = sprintf("SELECT * FROM cd_detalle_accion AS cda
                                                        LEFT JOIN cd_accion
                                                        ON cda.id_cd_accion_fk_cd_detalle_accion=cd_accion.id_cd_accion
                                                        WHERE cda.id_cd_fk_cd_detalle_accion = $idControlDisciplinario AND
                                                        cda.id_cd_etapa_fk_cd_detalle_accion=$idAccionEtapa AND
                                                        cda.id_cd_detalle_etapa_fk_cd_detalle_accion=$idCdDetalleEtapa AND
                                                        cda.estado_cd_detalle_accion = 1
                                                        ORDER BY fecha_creado_cd_detalle_accion DESC");
                                                        $Resultado11 = $mysqli->query($Query11);




                                                        while ($row11 = $Resultado11->fetch_array(MYSQLI_ASSOC)) {
                                                            if (isset($row11['id_cd_detalle_accion'])) { ?>
                                                                <!-- BORRAR LA ACCION -->
                                                                <?php
                                                                if (0 == $GlobalVista) {
                                                                    // CONTROL ENTRE FASES
                                                                    if (($radicacion == 1 && $row10['id_cd_fase'] == 1) or
                                                                        ($instruccion == 1 && $row10['id_cd_fase'] == 2) or
                                                                        ($juzgamiento == 1 && $row10['id_cd_fase'] == 3) or
                                                                        ($segundaInstancia == 1 && $row10['id_cd_fase'] == 5)
                                                                    ) {
                                                                        if (1 == $_SESSION['rol'] or 0 < $nump128 or 0 < $nump143) { ?>
                                                                            <form action="" method="post" name="borraraccion5656" style="display:inline">
                                                                                <input type="hidden" name="id_cd_detalle_accion" value="<?php echo $row11['id_cd_detalle_accion']; ?>">
                                                                                <input type="hidden" name="borrar_accion" value="borrar">
                                                                                <button type="submit" class="btn btn-danger btn-xs" title="Borrar Acción"><i class="fa fa-trash-o"></i></button>
                                                                            </form>
                                                                <?php   }
                                                                    }
                                                                } ?>
                                                                <!-- CONSULTA ACCION -->
                                                                <button class="btn btn-xs">
                                                                    <b>ACCIÓN</b> -
                                                                    <?php if (1 == $_SESSION['rol']) {
                                                                        echo $row11['id_cd_detalle_accion'] . ' - ';
                                                                    } ?>
                                                                    <?php echo $row11['nombre_cd_accion']; ?>
                                                                </button>
                                                                <?php if (0 == $GlobalVista) {

                                                                    // CONTROL ENTRE FASES
                                                                    if (($radicacion == 1 && $row10['id_cd_fase'] == 1) or
                                                                        ($instruccion == 1 && $row10['id_cd_fase'] == 2) or
                                                                        ($juzgamiento == 1 && $row10['id_cd_fase'] == 3) or
                                                                        ($segundaInstancia == 1 && $row10['id_cd_fase'] == 5)
                                                                    ) { ?>
                                                                        <?php if (0 == $row11['tipo_notificacion_cd_detalle_accion']) { ?>
                                                                            <a class="anexoetapa" id="<?php echo $row11['id_cd_detalle_accion'] . '-' . $row11['id_cd_accion_fk_cd_detalle_accion']; ?>" data-toggle="modal" data-target="#modalAgregarAnexosEtapas">
                                                                                <button class="btn btn-success btn-xs" title="Cargar Documentos">
                                                                                    <i class="fa fa-fw fa-plus-circle"></i>
                                                                                </button>
                                                                            </a>

                                                                            <a class="anexoobservacion" id="<?php echo $row11['id_cd_detalle_accion']; ?>" data-toggle="modal" data-target="#modalAgregarObservacionEtapas">
                                                                                <button class="btn btn-warning btn-xs" title="Dejar una Observación"><i class="fa fa-sticky-note-o"></i></button>
                                                                            </a>
                                                                        <?php } ?>

                                                                        <?php if (1 == $row11['tipo_notificacion_cd_detalle_accion']) { ?>
                                                                            <a class="anexoetapa" id="<?php echo $row11['id_cd_detalle_accion'] . '-' . $row11['id_cd_accion_fk_cd_detalle_accion']; ?>" data-toggle="modal" data-target="#modalAgregarAnexosEtapas">
                                                                                <button class="btn btn-success btn-xs" title="Cargar Documentos">
                                                                                    <i class="fa fa-fw fa-plus-circle"></i>
                                                                                </button>
                                                                            </a>

                                                                            <a class="anexoobservacion" id="<?php echo $row11['id_cd_detalle_accion']; ?>" data-toggle="modal" data-target="#modalAgregarObservacionEtapas">
                                                                                <button class="btn btn-warning btn-xs" title="Dejar una Observación"><i class="fa fa-sticky-note-o"></i></button>
                                                                            </a>

                                                                            <a class="sidnotificacion" id="<?php echo $row11['id_cd_detalle_accion'] . '-' . $row11['id_cd_accion_fk_cd_detalle_accion'] . '-' . $GlobalTipoDeOficina . '-' . $idControlDisciplinario; ?>" data-toggle="modal" data-target="#primodalNotificacion">
                                                                                <button class="btn btn-danger btn-xs" title="Envio Notificación"><i class="fa fa-send"></i></button>
                                                                            </a>
                                                                        <?php } ?>

                                                                    <?php } ?>

                                                                <?php } ?>
                                                                <!-- Anexo -->
                                                                <div class="card card-body">
                                                                    <?php $NombreDelModulo = $row11['id_cd_detalle_accion'];
                                                                    $Query8 = "SELECT * FROM cd_anexos 
                                                                    WHERE id_cd_accion_fk_cd_anexos=$NombreDelModulo 
                                                                    ORDER BY fecha_creado_cd_anexos DESC";
                                                                    $Resultado8 = $mysqli->query($Query8);
                                                                    ?>
                                                                    <br>
                                                                    <table class="table">
                                                                        <?php while ($row8 = $Resultado8->fetch_array(MYSQLI_ASSOC)) {
                                                                            if (isset($row8['id_cd_anexos'])) {
                                                                                if (isset($row8['extension_cd_anexos']) && 'pdf' == $row8['extension_cd_anexos'] || 'PDF' == $row8['extension_cd_anexos']) {
                                                                                    $extencion = '.pdf';
                                                                                    $imagenExtencion = 'images\pdf.png';
                                                                                } elseif (isset($row8['extension_cd_anexos']) && 'docx' == $row8['extension_cd_anexos'] || 'DOCX' == $row8['extension_cd_anexos']) {
                                                                                    $extencion = '.docx';
                                                                                    $imagenExtencion = 'images\doc.png';
                                                                                } elseif (isset($row8['extension_cd_anexos']) && 'doc' == $row8['extension_cd_anexos'] || 'DOC' == $row8['extension_cd_anexos']) {
                                                                                    $extencion = '.doc';
                                                                                    $imagenExtencion = 'images\doc.png';
                                                                                } else {
                                                                                    $extencion = '.mp3';
                                                                                    $imagenExtencion = 'images\music.png';
                                                                                }
                                                                                if (0 == $row8['estado_cd_anexos']) {
                                                                                    $tachado = 'textoTachado';
                                                                                } else {
                                                                                    $tachado = '';
                                                                                } ?>
                                                                                <tr class="<?php echo $tachado; ?>">
                                                                                    <form action="" method="POST" name="formsdasdasdd55">
                                                                                        <?php if (1 == $_SESSION['rol']) {
                                                                                            echo '<td>';
                                                                                            echo $row8['id_cd_anexos'];
                                                                                            echo '</td>';
                                                                                        } ?>
                                                                                        <td>
                                                                                            <?php echo $row8['fecha_creado_cd_anexos']; ?>
                                                                                        </td>
                                                                                        <td style="width:350px;">
                                                                                            <?php if (isset($row8['url_cd_anexos'])) {
                                                                                                if (isset($row8['observacion_doc_cd_anexos']) and 'Cargado desde Notificacion' == $row8['observacion_doc_cd_anexos']) { ?>
                                                                                                    <a href="filesnr/sid/<?php echo $row8['ano_creacion_cd_anexos'] . '/' . $row8['hash_cd_anexos'] . '.pdf'; ?>" target="_blank">
                                                                                                        <img src="<?php echo $imagenExtencion; ?>" alt="" style="width:15px;">
                                                                                                        <?php echo $row8['id_cd_anexos'] . '-' . $row8['nombre_cd_anexos']; ?>
                                                                                                    </a>
                                                                                                <?php } else { ?>
                                                                                                    <a href="filesnr/sid/<?php echo $row8['ano_creacion_cd_anexos'] . '/' . $row8['url_cd_anexos'] . $extencion; ?>" target="_blank">
                                                                                                        <img src="<?php echo $imagenExtencion; ?>" alt="" style="width:15px;">
                                                                                                        <?php echo $row8['id_cd_anexos'] . '-' . $row8['nombre_cd_anexos']; ?>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                            <?php } else { ?>
                                                                                                <?php echo '<p align="justify">Observación:' . $row8['observacion_cd_anexos'] . '</p>'; ?>
                                                                                            <?php } ?>
                                                                                        </td>
                                                                                        <?php if (1 == $_SESSION['rol'] or 0 < $nump128 or 0 < $nump143) { ?>
                                                                                            <input type="hidden" name="borrar_id_cd_anexos" value="<?php echo $row8['id_cd_anexos']; ?>">
                                                                                        <?php } else {
                                                                                        } ?>
                                                                                        <td>
                                                                                            <?php if (1 == $row8['definitivo_cd_anexos']) {
                                                                                                echo 'Definitivo';
                                                                                            } ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $row8['observacion_doc_cd_anexos']; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $row8['pra_cd_anexos']; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo quees('funcionario', $row8['id_funcionario_fk_cd_anexos']); ?>
                                                                                        </td>
                                                                                        <?php if (0 == $GlobalVista) {
                                                                                            // CONTROL ENTRE FASES
                                                                                            if (($radicacion == 1 && $row10['id_cd_fase'] == 1) or
                                                                                                ($instruccion == 1 && $row10['id_cd_fase'] == 2) or
                                                                                                ($juzgamiento == 1 && $row10['id_cd_fase'] == 3) or
                                                                                                ($segundaInstancia == 1 && $row10['id_cd_fase'] == 5)
                                                                                            ) { ?>
                                                                                                <td style="width:70px;">
                                                                                                    <?php if (1 == $row8['estado_cd_anexos'] && (1 == $_SESSION['rol'] or 0 < $nump128 or 0 < $nump143)) { ?>
                                                                                                        <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i></button>
                                                                                                    <?php } ?>
                                                                                                </td>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    </form>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </table>
                                                                </div>
                                                                <hr>
                                                            <?php } ?>
                                                        <?php  } ?>
                                                    </div><br>
                                                </div>
                                            </div>
                                        </div><!-- /.direct-chat-info -->
                                    </div><!-- /.direct-chat-msg -->
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <!-- Fases -->
                <div class="box">
                    <div class="box-header">
                        <b>Fases</b>
                    </div>
                    <div class="box-body">

                        <!-- RADICACION -->
                        <?php if ($GlobalVista == 0) {
                            if ($radicacion == 1) {
                                echo '<button type="button" class="btn btn-app Radicacion" data-toggle="modal" data-target="#modalRadicacion">';
                            } else {
                                echo '<button type="button" class="btn btn-app defautl">';
                            }
                        } elseif ($GlobalVista == 1) {
                            echo '<button type="button" class="btn btn-app">';
                        }
                        $Query19r = "SELECT count(id_cd_fase_fk_cd_detalle_etapa) AS contador 
                            FROM cd_detalle_etapa 
                            WHERE id_cd_fk_cd_detalle_etapa=$idControlDisciplinario 
                            AND id_cd_fase_fk_cd_detalle_etapa=1
                            AND estado_cd_detalle_etapa=1";
                        $Resultado19r = $mysqli->query($Query19r);
                        while ($row19r = $Resultado19r->fetch_array(MYSQLI_ASSOC)) {
                            echo '<span class="badge bg-navy">' . $row19r['contador'] . '</span>';
                        } ?> <i class="fa fa-inbox"></i> Radicación </button>

                        <!-- INSTRUCCION -->
                        <?php if ($GlobalVista == 0) {
                            if ($instruccion == 1) {
                                echo '<button type="button" class="btn btn-app Instruccion" data-toggle="modal" data-target="#modalInstruccion">';
                            } else {
                                echo '<button type="button" class="btn btn-app defautl">';
                            }
                        } elseif ($GlobalVista == 1) {
                            echo '<button type="button" class="btn btn-app">';
                        }
                        $Query19i = "SELECT count(id_cd_fase_fk_cd_detalle_etapa) AS contador 
                            FROM cd_detalle_etapa 
                            WHERE id_cd_fk_cd_detalle_etapa=$idControlDisciplinario
                            AND id_cd_fase_fk_cd_detalle_etapa=2
                            AND estado_cd_detalle_etapa=1";
                        $Resultado19i = $mysqli->query($Query19i);
                        while ($row19i = $Resultado19i->fetch_array(MYSQLI_ASSOC)) {
                            echo '<span class="badge bg-navy">' . $row19i['contador'] . '</span>';
                        } ?> <i class="fa fa-inbox"></i> Instrucción </button>

                        <!-- JUZGAMIENTO -->
                        <?php if ($GlobalVista == 0) {
                            if ($juzgamiento == 1) {
                                echo '<button type="button" class="btn btn-app Juzgamiento" data-toggle="modal" data-target="#modalJuzgamiento">';
                            } else {
                                echo '<button type="button" class="btn btn-app defautl">';
                            }
                        } elseif ($GlobalVista == 1) {
                            echo '<button type="button" class="btn btn-app defautl">';
                        }
                        $Query19j = "SELECT count(id_cd_fase_fk_cd_detalle_etapa) AS contador 
                            FROM cd_detalle_etapa 
                            WHERE id_cd_fk_cd_detalle_etapa=$idControlDisciplinario
                            AND id_cd_fase_fk_cd_detalle_etapa=3
                            AND estado_cd_detalle_etapa=1";
                        $Resultado19j = $mysqli->query($Query19j);
                        while ($row19j = $Resultado19j->fetch_array(MYSQLI_ASSOC)) {
                            echo '<span class="badge bg-navy">' . $row19j['contador'] . '</span>';
                        } ?> <i class="fa fa-balance-scale"></i> Juzgamiento </button>

                        <!-- SEGUNDA INSTANCIA -->
                        <?php if ($GlobalVista == 0) {
                            if ($segundaInstancia == 1) {
                                echo '<button type="button" class="btn btn-app segunda_instancia" data-toggle="modal" data-target="#modalSegundaInstancia">';
                            } else {
                                echo '<button type="button" class="btn btn-app defautl">';
                            }
                        } elseif ($GlobalVista == 1) {
                            echo '<button type="button" class="btn btn-app defautl">';
                        }
                        $Query19j = "SELECT count(id_cd_fase_fk_cd_detalle_etapa) AS contador 
                            FROM cd_detalle_etapa 
                            WHERE id_cd_fk_cd_detalle_etapa=$idControlDisciplinario
                            AND id_cd_fase_fk_cd_detalle_etapa=5
                            AND estado_cd_detalle_etapa=1";
                        $Resultado19j = $mysqli->query($Query19j);
                        while ($row19j = $Resultado19j->fetch_array(MYSQLI_ASSOC)) {
                            echo '<span class="badge bg-navy">' . $row19j['contador'] . '</span>';
                        } ?> <i class="fa fa-balance-scale"></i> Segunda Instancia </button>

                    </div>
                </div>
                <!-- ENTIDADES | IMPLICADOS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <b>Entidades | Implicados</b>
                        <span class="pull-letf badge bg-aqua">
                            <?php
                            $query3 = sprintf("SELECT count(id_cd_fk_cd_entidad) AS countImplicados FROM cd_entidad 
                            WHERE cd_entidad.id_cd_fk_cd_entidad = $idControlDisciplinario AND
                            cd_entidad.estado_cd_entidad=1");
                            $select3 = mysql_query($query3, $conexion) or die(mysql_error());
                            $row3 = mysql_fetch_assoc($select3);
                            echo $row3['countImplicados'];
                            ?>
                        </span>

                        <div style="float: right;">
                            <?php if (0 == $GlobalVista || 1 == $_SESSION['rol']) { ?>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalAgregarEntidadesImplicados"><i class="fa fa-plus"></i></button>
                            <?php } ?>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body divscroll200">
                        <table class="table">

                            <head>
                                <tr>
                                    <th>Entidades</th>
                                    <th>Grupo</th>
                                    <th>Cedula Implicado</th>
                                    <th>Nombre Implicado</th>
                                    <th>Email Implicado</th>
                                    <th>Direccion Implicado</th>
                                    <th>#</th>
                                </tr>
                            </head>

                            <body>
                                <?php $query2 = sprintf("SELECT * FROM cd_entidad
                                LEFT JOIN cd_implicado
                                ON cd_entidad.id_cd_entidad=cd_implicado.id_cd_entidad_fk_cd_implicado
                                WHERE cd_entidad.id_cd_fk_cd_entidad = $idControlDisciplinario AND 
                                cd_entidad.estado_cd_entidad=1 AND 
                                cd_implicado.estado_cd_implicado=1");
                                $select2 = mysql_query($query2, $conexion) or die(mysql_error());
                                $row2 = mysql_fetch_assoc($select2);
                                $totalRows2 = mysql_num_rows($select2);
                                do {
                                    echo '<tr>';
                                    if ($row2['nombre_cd_entidad'] == 1) { ?>
                                        <td>Nivel Central</td>
                                        <td> <?php echo quees('grupo_area', $row2['grupo_cd_entidad']) ?> </td>
                                    <?php } elseif ($row2['nombre_cd_entidad'] == 2) { ?>
                                        <td>Oficina Registro</td>
                                        <td> <?php echo quees('oficina_registro', $row2['grupo_cd_entidad']) ?> </td>
                                    <?php } elseif ($row2['nombre_cd_entidad'] == 3) { ?>
                                        <td>Notaria</td>
                                        <td> <?php echo quees('notaria', $row2['grupo_cd_entidad']) ?> </td>
                                    <?php } elseif ($row2['nombre_cd_entidad'] == 4) { ?>
                                        <td>Curaduria</td>
                                        <td> <?php echo quees('curaduria', $row2['grupo_cd_entidad']) ?> </td>
                                        <?php }
                                    echo '<td>' . $row2['cedula_cd_implicado'] . '</td>';
                                    echo '<td>' . $row2['nombre_cd_implicado'] . '</td>';
                                    echo '<td>' . $row2['email_cd_implicado'] . '</td>';
                                    echo '<td>' . $row2['direccion_cd_implicado'] . '</td>';
                                    if (0 == $GlobalVista && (1 == $_SESSION['rol'] || 0 < $nump128)) {
                                        echo '<td>';
                                        if (isset($row2['id_cd_implicado']) && (1 == $GlobalTipoDeOficina && (1 == $row2['nombre_cd_entidad'] || 2 == $row2['nombre_cd_entidad'])) || $GlobalTipoDeOficina == $row2['nombre_cd_entidad']) {
                                            echo '<form action="" method="POST" name="formsdasjkp88dd55">
                                            <input type="hidden" name="borrar_id_cd_implicado" value="' . $row2['id_cd_implicado'] . '-' . $row2['id_cd_entidad_fk_cd_implicado'] . '">
                                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i></button><br>
                                            </form>'; ?>
                                            <a class="btn btn-warning btn-xs controlprocesoeditarimplicado" id="<?php echo $row2['id_cd_implicado'] . '-' . $GlobalTipoDeOficina; ?>" data-toggle="modal" data-target="#modalEditarImplicado">
                                                <span class="fa fa-fw fa-pencil"></span>
                                            </a>
                                <?php
                                        }
                                        echo '</td>';
                                    }
                                    echo '</tr>';
                                } while ($row2 = mysql_fetch_assoc($select2));
                                mysql_free_result($select2); ?>
                            </body>
                        </table>
                    </div>
                </div>
                <!-- Documentos Definitivos -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <b>Documentos Definitivos</b>
                        <a href="https://sisg.supernotariado.gov.co/expediente/<?php echo rtrim(strtr(base64_encode('SALTMDCINCO' . $_GET['i']), '+/', '-_'), '='); ?>.jsp" target="_blank" class="btn btn-primary btn-xs">Consultar</a>
                        <span class="pull-letf badge bg-yellow">
                            <?php
                            $query3 = sprintf("SELECT count(id_cd_fk_cd_anexos) AS countanexos FROM cd_anexos 
                                WHERE id_cd_fk_cd_anexos = $idControlDisciplinario 
                                AND definitivo_cd_anexos=1
                                AND estado_cd_anexos=1");
                            $select3 = mysql_query($query3, $conexion) or die(mysql_error());
                            $row3 = mysql_fetch_assoc($select3);
                            echo $row3['countanexos'];
                            ?>
                        </span>
                    </div>
                    <div class="box-body divscroll200">
                        <?php $query4 = "SELECT * FROM cd_anexos 
                        WHERE cd_anexos.id_cd_fk_cd_anexos = $idControlDisciplinario 
                        AND definitivo_cd_anexos=1 
                        AND estado_cd_anexos=1
                        ORDER BY posicion_cd_anexos ASC";
                        $Result4 = $mysqli->query($query4); ?>
                        <ul id="organizaAnexos" class="sortable">
                            <!-- DOCUMENTOS DE SISG EN CARPETA SID -->
                            <?php $organizacion = array();
                            while ($row4 = $Result4->fetch_array(MYSQLI_ASSOC)) {
                                if (isset($row4['id_cd_anexos'])) {
                                    if (isset($row4['observacion_doc_cd_anexos']) and 'Cargado desde Notificacion' == $row4['observacion_doc_cd_anexos']) {
                                        echo '<li class="ui-state-default" id="anexo_' . $row4['id_cd_anexos'] . '">';
                                        echo '<a href="filesnr/sid/' . $row4['ano_creacion_cd_anexos'] . '/' . $row4['hash_cd_anexos'] . '.pdf" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                        echo '</li>';
                                        array_push($organizacion, $row4['id_cd_anexos']);
                                    } else {
                                        if (isset($row4['extension_cd_anexos']) && 'pdf' == $row4['extension_cd_anexos'] || 'PDF' == $row4['extension_cd_anexos']) {
                                            echo '<li class="ui-state-default" id="anexo_' . $row4['id_cd_anexos'] . '">';
                                            echo '<a href="filesnr/sid/' . $row4['ano_creacion_cd_anexos'] . '/' . $row4['url_cd_anexos'] . '.pdf" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                            echo '</li>';
                                            array_push($organizacion, $row4['id_cd_anexos']);
                                        }
                                    }
                                    if (isset($row4['extension_cd_anexos']) && 'docx' == $row4['extension_cd_anexos'] || 'docx' == $row4['extension_cd_anexos']) {
                                        echo '<li class="ui-state-default" id="anexo_' . $row4['id_cd_anexos'] . '">';
                                        echo '<a href="filesnr/sid/' . $row4['ano_creacion_cd_anexos'] . '/' . $row4['url_cd_anexos'] . '.docx" target="_blank"><img src="images\doc.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                        echo '</li>';
                                        array_push($organizacion, $row4['id_cd_anexos']);
                                    }
                                    if (isset($row4['extension_cd_anexos']) && 'doc' == $row4['extension_cd_anexos'] || 'doc' == $row4['extension_cd_anexos']) {
                                        echo '<li class="ui-state-default" id="anexo_' . $row4['id_cd_anexos'] . '">';
                                        echo '<a href="filesnr/sid/' . $row4['ano_creacion_cd_anexos'] . '/' . $row4['url_cd_anexos'] . '.doc" target="_blank"><img src="images\doc.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                        echo '</li>';
                                        array_push($organizacion, $row4['id_cd_anexos']);
                                    }
                                    if (isset($row4['extension_cd_anexos']) && 'mp3' == $row4['extension_cd_anexos'] || 'MP3' == $row4['extension_cd_anexos']) {
                                        echo '<li class="ui-state-default" id="anexo_' . $row4['id_cd_anexos'] . '">';
                                        echo '<a href="filesnr/sid/' . $row4['ano_creacion_cd_anexos'] . '/' . $row4['url_cd_anexos'] . '.mp3" target="_blank"><img src="images\music.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                        echo '</li>';
                                        array_push($organizacion, $row4['id_cd_anexos']);
                                    }
                                }
                            } ?>
                            <!-- DOCUMENTOS IRIS TRASLADO -->
                            <?php
                            $irisTraslado = $row['iris_traslado_cd'];
                            $array = explode(",", $irisTraslado);

                            foreach ($array as $key => $value) {
                                $query48 = "SELECT * FROM solicitud_pqrs, documento_pqrs 
                            WHERE solicitud_pqrs.id_solicitud_pqrs=documento_pqrs.id_solicitud_pqrs 
                            AND solicitud_pqrs.radicado='$value'";
                                $Result48 = $mysqli->query($query48);
                                while ($row48 = $Result48->fetch_array(MYSQLI_ASSOC)) {
                                    echo '<li class="ui-state-default" id="anexo_' . $row4['url_documento'] . '">';
                                    echo '<a href="/files/' . $row48['carpeta'] . $row48['url_documento'] . '" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row48['url_documento'] . '</a>';
                                    echo '</li>';
                                }
                            }
                            ?>
                            <!-- DOCUMENTOS RADICADOS DE IRIS -->
                            <?php
                            $radicacioniris = $row['radicacion_iris_cd'];
                            $array = explode(",", $radicacioniris);

                            foreach ($array as $key => $value) {
                                $query48 = "SELECT * FROM solicitud_pqrs, documento_pqrs 
                                WHERE solicitud_pqrs.id_solicitud_pqrs=documento_pqrs.id_solicitud_pqrs 
                                AND solicitud_pqrs.radicado='$value'";
                                $Result48 = $mysqli->query($query48);
                                while ($row48 = $Result48->fetch_array(MYSQLI_ASSOC)) {
                                    echo '<li class="ui-state-default" id="anexo_' . $row4['url_documento'] . '">';
                                    echo '<a href="/files/' . $row48['carpeta'] . $row48['url_documento'] . '" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row48['url_documento'] . '</a>';
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>


                <!-- ASIGNACION -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <b>Historial de Asignaciones</b>
                        <span class="pull-letf badge bg-green">
                            <?php
                            $query3 = sprintf("SELECT count(id_cd_fk_cd_asignado) AS countasignado FROM cd_asignado 
                        WHERE 
                        id_cd_fk_cd_asignado=$idControlDisciplinario AND estado_cd_asignado=1");
                            $select3 = mysql_query($query3, $conexion) or die(mysql_error());
                            $row3 = mysql_fetch_assoc($select3);
                            echo $row3['countasignado'];
                            ?>
                        </span>
                        <div style="float: right;">
                            <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAsignacion"><i class="fa fa-plus"></i></button> -->
                            <?php if (0 == $GlobalVista || 1 == $_SESSION['rol'] or 0 < $nump143) { ?>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump126 ||  0 < $nump130 || 0 < $nump143) { ?>
                                    <form action="" method="post" name="retornarasignacion434" style="display:inline;">
                                        <input type="submit" class="btn btn-success btn-xs" name="retornar_asignacion" value="Retornar" title="Retorna Tablero Dependencia">
                                    </form>
                                <?php } ?>
                            <?php } ?>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body divscroll200">
                        <table class="table">
                            <?php $Query5 = "SELECT * FROM cd_asignado WHERE 
                            id_cd_fk_cd_asignado=$idControlDisciplinario
                            AND estado_cd_asignado=1  ORDER BY fecha_creado_cd_asignado DESC";
                            $Resultado5 = $mysqli->query($Query5);
                            while ($row5 = $Resultado5->fetch_array(MYSQLI_ASSOC)) {
                                if (isset($row5['id_cd_asignado'])) { ?>
                                    <tr>
                                        <td>
                                            <b style="color:#00a65a;"><i class="fa fa-fw fa-clock-o"></i>
                                                <?php echo isset($row5['fecha_creado_cd_asignado']) ? $row5['fecha_creado_cd_asignado'] : '' ?>
                                            </b>
                                            <br>
                                            <b>De:</b>
                                            <?php echo isset($row5['de_cd_asignado_fk_id_funcionario']) ? quees('funcionario', $row5['de_cd_asignado_fk_id_funcionario']) : '' ?>
                                            <br>
                                            <?php echo isset($row5['de_grupo_area']) ? quees('grupo_area', $row5['de_grupo_area']) : '' ?>
                                            <br>
                                            <b>Para:</b>
                                            <?php echo isset($row5['para_cd_asignado_fk_id_funcionario']) ? quees('funcionario', $row5['para_cd_asignado_fk_id_funcionario']) : '' ?>
                                            <br>
                                            <?php echo isset($row5['para_grupo_area']) ? quees('grupo_area', $row5['para_grupo_area']) : '' ?>
                                            <br>
                                            <b>Motivo:</b>
                                            <?php echo $row5['motivo_cd_asignado']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <!-- HISTORIAL NOTIFICACIONES -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <b>Historial Notificación</b>
                        <span class="pull-letf badge bg-red">
                            <?php
                            $query6 = sprintf("SELECT count(id_cd_historial_notificacion) AS countnoti 
                        FROM cd_historial_notificacion 
                        WHERE id_cd_fk_cd_historial_notificacion=$idControlDisciplinario
                        AND estado_cd_historial_notificacion=1 ");
                            $select6 = mysql_query($query6, $conexion) or die(mysql_error());
                            $row6 = mysql_fetch_assoc($select6);
                            echo $row6['countnoti'];
                            ?>
                        </span>
                        <div style="float: right;">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body divscroll200">
                        <table class="table">
                            <?php $Query7 = "SELECT * FROM cd_historial_notificacion 
                        WHERE id_cd_fk_cd_historial_notificacion=$idControlDisciplinario
                        AND estado_cd_historial_notificacion=1 
                        ORDER BY fecha_creado_cd_historial_notificacion DESC";
                            $Resultado7 = $mysqli->query($Query7);
                            while ($row7 = $Resultado7->fetch_array(MYSQLI_ASSOC)) {

                                if (isset($row7['id_cd_historial_notificacion'])) { ?>
                                    <tr>
                                        <td>
                                            <b style="color:#dd4b39;"><i class="fa fa-fw fa-clock-o"></i>
                                                <?php echo isset($row7['fecha_creado_cd_historial_notificacion']) ? $row7['fecha_creado_cd_historial_notificacion'] : '' ?>
                                            </b>
                                            <br>
                                            <b>De:</b>
                                            <?php echo isset($row7['desde_cd_historial_notificacion']) ? $row7['desde_cd_historial_notificacion'] : '' ?>
                                            <br>
                                            <b>Para:</b>
                                            <?php echo isset($row7['para_cd_historial_notificacion']) ? $row7['para_cd_historial_notificacion'] : '' ?>
                                            <br>
                                            <b>Asunto:</b>
                                            <?php echo isset($row7['asunto_cd_historial_notificacion']) ? $row7['asunto_cd_historial_notificacion'] : '' ?>
                                            <br>
                                            <b>Correo:</b>
                                            <?php if (isset($row7['envio_cd_historial_notificacion']) && $row7['envio_cd_historial_notificacion'] == 1) {
                                                echo 'Enviado y entregado';
                                            } else {
                                                echo 'Pendiente Envio';
                                            } ?>
                                            <br>
                                            <b>Radicado Iris:</b>
                                            <?php echo isset($row7['nombre_cd_historial_notificacion']) ? $row7['nombre_cd_historial_notificacion'] : '' ?>
                                            <br>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>

                <!-- PERMISO SERVICIO DE AUTENTICACION DIGITAL -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <b>Permiso Servicio de Autenticación Digital</b>
                        <span class="pull-letf badge bg-info">
                            <?php
                            $query20 = sprintf("SELECT count(id_cd) AS contador 
                            FROM cd_permiso_file_sid 
                            WHERE  id_cd=$idControlDisciplinario
                            AND estado_cd_permiso_file_sid=1");
                            $select20 = mysql_query($query20, $conexion) or die(mysql_error());
                            $row20 = mysql_fetch_assoc($select20);
                            echo $row20['contador'];
                            ?>
                        </span>

                        <div style="float: right;">
                            <?php if (0 == $GlobalVista || 1 == $_SESSION['rol'] || 0 < $nump143) { ?>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalCrearPermiso" title="Nuevo">
                                    <i class="fa fa-plus"></i>
                                </button>
                            <?php } ?>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body divscroll200">
                        <table class="table">
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                            <?php $Query21 = "SELECT * FROM cd_permiso_file_sid
                                WHERE id_cd=$idControlDisciplinario
                                AND estado_cd_permiso_file_sid=1";
                            $Resultado21 = $mysqli->query($Query21);
                            while ($row21 = $Resultado21->fetch_array(MYSQLI_ASSOC)) {

                                if (isset($row21['id_cd'])) { ?>
                                    <tr>
                                        <td>
                                            <?php echo isset($row21['identificacion']) ? $row21['identificacion'] : '' ?>
                                        </td>
                                        <td>
                                            <?php echo isset($row21['nombre_cd_permiso_file_sid']) ? $row21['nombre_cd_permiso_file_sid'] : '' ?>
                                        </td>
                                        <td>
                                            <?php echo isset($row21['fecha_permiso']) ? $row21['fecha_permiso'] : '' ?>
                                        </td>
                                        <td>
                                            <?php if (0 == $GlobalVista || 1 == $_SESSION['rol'] || 0 < $nump143) { ?>
                                                <a class="btn btn-warning btn-xs controlprocesoeditarpermiso" id="<?php echo $row21['id_cd_permiso_file_sid']; ?>" data-toggle="modal" data-target="#modalEditarPermiso">
                                                    <span class="fa fa-fw fa-pencil"></span>
                                                </a>
                                                <form action="" method="post" style="display: inline;" name="formBorrarPermiso">
                                                    <input type="hidden" name="id_cd_permiso_file_sid" value="<?php echo $row21['id_cd_permiso_file_sid']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs" name="btnBorrarPermiso" value="btnBorrarPermiso"><i class="fa fa-trash-o"></i></button></button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php
                $Query25 = "SELECT estado_expediente_cd FROM cd
                    WHERE id_cd=$idControlDisciplinario
                    AND estado_cd=1";
                $Resultado25 = $mysqli->query($Query25);
                $row25 = $Resultado25->fetch_array(MYSQLI_ASSOC);
                $estado_expediente = $row25['estado_expediente_cd'];
                ?>
                <?php if ('Activo' == $row25['estado_expediente_cd'] && (1 == $_SESSION['rol'] || 0 < $nump143 || 0 < $nump125 || 0 < $nump127 || 0 < $nump128)) { ?>

                    <form action="" method="post">
                        <input type="hidden" name="finalizar_expediente" value="finalizar_expediente">
                        <button type="submit" class="btn btn-danger btn-sm">Finalizar</button>
                    </form>

                <?php } elseif ('Finalizado' == $row25['estado_expediente_cd'] && (1 == $_SESSION['rol'] || 0 < $nump143 || 0 < $nump127 || 0 < $nump128)) { ?>

                    <form action="" method="post">
                        <input type="hidden" name="activo_expediente" value="activo_expediente">
                        <button type="submit" class="btn btn-success btn-sm">Activo</button>
                    </form>

                <?php } ?>
            </div>
        </div>

        <!-- MODAL RADICACIÓN -->
        <div class="modal fade" id="modalRadicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Radicación</b>
                    </div>
                    <form action="" method="POST" name="form1F435435G42343DG">
                        <div class="modal-body">
                            <div class="form-group text-left">
                                <label class="control-label">Etapa:</label><br>
                                <input type="hidden" name="id_cd_fase_fk_cd_detalle_etapa" value="1">
                                <select class="form-control" name="id_cd_etapa_fk_cd_detalle_etapa" require>
                                    <option value="" selected>Seleccionar</option>
                                    <?php $Query22 = sprintf("SELECT * FROM cd_etapa WHERE id_cd_fase_fk_cd_etapa=1 AND estado_cd_etapa=1
                                                        ORDER BY nombre_cd_etapa ASC");
                                    $Resultado22 = $mysqli->query($Query22);
                                    while ($row22 = $Resultado22->fetch_array(MYSQLI_ASSOC)) {
                                        if (isset($row22['id_cd_etapa'])) {
                                            echo '<option value="' . $row22['id_cd_etapa'] . '">' . $row22['nombre_cd_etapa'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_radicacion">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL INSTRUCCION -->
        <div class="modal fade" id="modalInstruccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Instrucción</b>
                    </div>
                    <form action="" method="POST" name="form1F435435G42343DG">
                        <div class="modal-body">
                            <div class="form-group text-left">
                                <label class="control-label">Etapa:</label><br>
                                <input type="hidden" name="id_cd_fase_fk_cd_detalle_etapa" value="2">
                                <select class="form-control" name="id_cd_etapa_fk_cd_detalle_etapa" require>
                                    <option value="" selected>Seleccionar</option>
                                    <?php $Query23 = sprintf("SELECT * FROM cd_etapa WHERE id_cd_fase_fk_cd_etapa=2 AND estado_cd_etapa=1
                                                         ORDER BY nombre_cd_etapa ASC");
                                    $Resultado23 = $mysqli->query($Query23);
                                    while ($row23 = $Resultado23->fetch_array(MYSQLI_ASSOC)) {
                                        if (isset($row23['id_cd_etapa'])) {
                                            echo '<option value="' . $row23['id_cd_etapa'] . '">' . $row23['nombre_cd_etapa'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_instruccion">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL JUZGAMIENTO -->
        <div class="modal fade" id="modalJuzgamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Juzgamiento</b>
                    </div>
                    <form action="" method="POST" name="formjuzgasjdksdd">
                        <div class="modal-body">
                            <div class="form-group text-left">
                                <label class="control-label">Etapa:</label><br>
                                <input type="hidden" name="id_cd_fase_fk_cd_detalle_etapa" value="3">
                                <select class="form-control" name="id_cd_etapa_fk_cd_detalle_etapa" require>
                                    <option value="" selected>Seleccionar</option>
                                    <?php $Query9 = sprintf("SELECT * FROM cd_etapa WHERE id_cd_fase_fk_cd_etapa=3 AND estado_cd_etapa=1
                                                        ORDER BY nombre_cd_etapa ASC");
                                    $Resultado9 = $mysqli->query($Query9);
                                    while ($row9 = $Resultado9->fetch_array(MYSQLI_ASSOC)) {
                                        if (isset($row9['id_cd_etapa'])) {
                                            echo '<option value="' . $row9['id_cd_etapa'] . '">' . $row9['nombre_cd_etapa'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_juzgamiento">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL SEGUNDA INSTANCIA -->
        <div class="modal fade" id="modalSegundaInstancia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Segunda Instancia</b>
                    </div>
                    <form action="" method="POST" name="formprimerainsdsadhjksa">
                        <div class="modal-body">
                            <div class="form-group text-left">
                                <label class="control-label">Etapa:</label><br>
                                <input type="hidden" name="id_cd_fase_fk_cd_detalle_etapa" value="5">
                                <select class="form-control" name="id_cd_etapa_fk_cd_detalle_etapa" require>
                                    <option value="" selected>Seleccionar</option>
                                    <?php $Query24 = sprintf("SELECT * FROM cd_etapa WHERE id_cd_fase_fk_cd_etapa=5 AND estado_cd_etapa=1
                                                        ORDER BY nombre_cd_etapa ASC");
                                    $Result24 = $mysqli->query($Query24);
                                    while ($row24 = $Result24->fetch_array(MYSQLI_ASSOC)) {
                                        if (isset($row24['id_cd_etapa'])) {
                                            echo '<option value="' . $row24['id_cd_etapa'] . '">' . $row24['nombre_cd_etapa'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_segunda_instancia">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL AGREGAR ACCION -->
        <div class="modal fade" id="modalEtapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Agregar Accion</b>
                    </div>
                    <div id="divControlProcesoAccionEtapa"></div>
                </div>
            </div>
        </div>

        <!-- MODAL AGREGAR ENTIDADES E IMPLICADOS -->
        <div class="modal fade" id="modalAgregarEntidadesImplicados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Agregar Entidades e Implicados</b>
                    </div>

                    <form action="" method="POST" name="formsdsdsdas55150">
                        <div class="modal-body">

                            <div class="form-group text-left">
                                <span style="color:#ff0000;">*</span>
                                <?php
                                if ($GlobalTipoDeOficina == 1) {
                                    $Querytipo = "SELECT id_grupo_area AS id_area, nombre_grupo_area AS nombre_area, dependencia
                                                    FROM (
                                                        SELECT id_grupo_area, nombre_grupo_area, (1) AS dependencia
                                                        FROM grupo_area WHERE id_area IS NOT NULL AND estado_grupo_area=1
                                                        UNION
                                                        SELECT id_oficina_registro, nombre_oficina_registro, (2) AS dependencia
                                                        FROM oficina_registro WHERE estado_oficina_registro=1
                                                    ) AS resultados_combinados
                                                    ORDER BY nombre_area ASC";
                                    echo '<label class="control-label">Nivel Central o Oficinas Registro:</label>';
                                } elseif ($GlobalTipoDeOficina == 2) {
                                    $Querytipo = "SELECT * FROM oficina_registro where estado_oficina_registro=1";
                                    echo '<label class="control-label">Oficinas Registro:</label>';
                                    echo '<input type="hidden" name="nombre_cd_entidad" value="2">';
                                } elseif ($GlobalTipoDeOficina == 3) {
                                    $Querytipo = "SELECT * FROM notaria where estado_notaria=1";
                                    echo '<label class="control-label">Notarias:</label>';
                                    echo '<input type="hidden" name="nombre_cd_entidad" value="3">';
                                } elseif ($GlobalTipoDeOficina == 4) {
                                    $Querytipo = "SELECT * FROM curaduria where estado_curaduria=1";
                                    echo '<label class="control-label">Curadurias:</label>';
                                    echo '<input type="hidden" name="nombre_cd_entidad" value="4">';
                                } elseif ($GlobalTipoDeOficina == 5) {
                                    $Querytipo = "SELECT * FROM grupo_area where id_area IS NOT NULL AND estado_grupo_area=1";
                                    echo '<label class="control-label">Nivel Central:</label>';
                                    echo '<input type="hidden" name="nombre_cd_entidad" value="1">';
                                } elseif ($GlobalTipoDeOficina == 6) {
                                    $Querytipo = "SELECT * FROM grupo_area where id_area IS NOT NULL AND estado_grupo_area=1";
                                    echo '<label class="control-label">Nivel Central:</label>';
                                    echo '<input type="hidden" name="nombre_cd_entidad" value="1">';
                                }
                                ?>
                                <select style="width:100%" name="grupo_cd_entidad" id="idAgregarEntidades" required>
                                    <option value="" selected>--Seleccionar--</option>
                                    <?php $Query18 = "$Querytipo";
                                    $Resul18 = $mysqli->query($Query18);
                                    while ($row18 = $Resul18->fetch_array(MYSQLI_ASSOC)) {
                                        if ($GlobalTipoDeOficina == 1 and isset($row18['id_area'])) {
                                            echo '<option value="' . $row18['dependencia'] . '-' . $row18['id_area'] . '">' . $row18['nombre_area'] . '</option>';
                                        } elseif ($GlobalTipoDeOficina == 2 and isset($row18['id_oficina_registro'])) {
                                            echo '<option value="' . $row18['id_oficina_registro'] . '">' . $row18['nombre_oficina_registro'] . '</option>';
                                        } elseif ($GlobalTipoDeOficina == 3 and isset($row18['id_notaria'])) {
                                            echo '<option value="' . $row18['id_notaria'] . '">' . $row18['nombre_notaria'] . '</option>';
                                        } elseif ($GlobalTipoDeOficina == 4 and isset($row18['id_curaduria'])) {
                                            echo '<option value="' . $row18['id_curaduria'] . '">' . $row18['nombre_curaduria'] . '</option>';
                                        } elseif ($GlobalTipoDeOficina == 5 and isset($row18['id_grupo_area'])) {
                                            echo '<option value="' . $row18['id_grupo_area'] . '">' . $row18['nombre_grupo_area'] . '</option>';
                                        } elseif ($GlobalTipoDeOficina == 6 and isset($row18['id_grupo_area'])) {
                                            echo '<option value="' . $row18['id_grupo_area'] . '">' . $row18['nombre_grupo_area'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group text-left">
                                <label class="control-label">Cedula Implicado:</label>
                                <input type="number" class="form-control" name="cedula_cd_implicado">
                            </div>
                            <div class="form-group text-left">
                                <span style="color:#ff0000;">*</span><label class="control-label">Nombre Implicado:</label>
                                <input type="text" class="form-control" name="nombre_cd_implicado" required>
                            </div>
                            <div class="form-group text-left">
                                <label class="control-label">Email Implicado:</label>
                                <input type="text" class="form-control" name="email_cd_implicado">
                            </div>
                            <div class="form-group text-left">
                                <label class="control-label">Direccion Implicado:</label>
                                <input type="text" class="form-control" name="direccion_cd_implicado">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_implicado_entidad">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- MODAL AGREGAR ANEXOS DE ETAPAS -->
        <div class="modal fade" id="modalAgregarAnexosEtapas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Agregar Anexos</b>
                    </div>
                    <div id="divverfaseetapa"></div>
                </div>
            </div>
        </div>

        <!-- MODAL AGREGAR OBSERVACION DE ETAPAS -->
        <div class="modal fade" id="modalAgregarObservacionEtapas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Observación</b>
                    </div>
                    <div id="divetapaobservacion"></div>
                </div>
            </div>
        </div>

        <!-- MODAL EMVIO DE NOTIFICACIONES -->
        <div class="modal fade" id="primodalNotificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Enviar Notificación</b>
                    </div>
                    <div class="modal-body">
                        <div id="divsidnotificacion"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDITAR IMPLICADO | ENTIDAD -->
        <div class="modal fade" id="modalEditarImplicado" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Editar Entidad e Implicado</b>
                    </div>
                    <div class="modal-body">
                        <div id="divControlProcesoEditarImplicado"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL CREAR PERMISO -->
        <div class="modal fade" id="modalCrearPermiso" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Crear Permiso Servicio de Autenticación Digital</b>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" name="formCrearPermiso">

                            <div class="form-group text-left">
                                <label><b>Identificación</b></label>
                                <input type="number" class="form-control" name="identificacion">
                            </div>
                            <div class="form-group text-left">
                                <label><b>Nombre y Apellido:</b></label>
                                <input type="text" class="form-control" name="nombre_cd_permiso_file_sid">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_permiso">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDITAR PERMISO -->
        <div class="modal fade" id="modalEditarPermiso" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Editar Permiso Servicio de Autenticación Digital</b>
                    </div>
                    <div class="modal-body">
                        <div id="divControlProcesoEditarPermiso"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDITAR INFORMACION INICIAL -->
        <div class="modal fade" id="modalEditarExpediente" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <b>Editar Información Inicial</b>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" name="formeditarexpediente5262">
                            <?php $query26 = "SELECT * FROM cd WHERE
                        id_cd = $idControlDisciplinario
                        AND estado_cd=1
                        limit 1";
                            $result = $mysqli->query($query26);
                            $row26 = $result->fetch_array(MYSQLI_ASSOC); ?>

                            <div class="form-group text-left">
                                <label class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN IRIS:</label>
                                <input type="text" class="form-control" name="radicacion_iris_cd" value="<?php echo $row26['radicacion_iris_cd']; ?>" required>
                                <div class="help-block" style="font-size:12px;">Solo recibe radicados seguido por coma, sin espacios. Ejemplo: SNR2022ER000231,SNR2023ER012593</div>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE QUEJA:</label>
                                <input type="date" class="form-control" name="fecha_queja_cd" value="<?php echo $row26['fecha_queja_cd']; ?>" required>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"> IRIS DEL TRASLADO:</label>
                                <input type="text" class="form-control" name="iris_traslado_cd" value="<?php echo $row26['iris_traslado_cd']; ?>">
                                <div class="help-block" style="font-size:12px;">Solo recibe radicados seguido por coma, sin espacios. Ejemplo: SNR2022ER000231,SNR2023ER012593</div>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL TRASLADO A DISCIPLINARIO:</label>
                                <input type="date" class="form-control" name="fecha_traslado_cd" value="<?php echo $row26['fecha_traslado_cd']; ?>" required>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"><span style="color:#ff0000;">*</span> CANAL DE ENTRADA:</label>
                                <select class="form-control" name="canal_entrada_cd" required>
                                    <?php if ($row26['canal_entrada_cd']) { ?>
                                        <option value="<?php echo $row26['canal_entrada_cd']; ?>" selected><?php echo $row26['canal_entrada_cd']; ?></option>
                                    <?php } ?>
                                    <option value=""></option>
                                    <option value="PQRSD">PQRSD</option>
                                    <option value="INFORME OFICIAL">INFORME OFICIAL</option>
                                    <option value="DE OFICIO">DE OFICIO</option>
                                </select>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label">TIPOLOGIA:</label>
                                <select class="form-control" name="id_cd_tipo_fk_cd_tipo">
                                    <?php if (isset($row26['id_cd_tipo_fk_cd_tipo'])) { ?>
                                        <option value="<?php echo $row26['id_cd_tipo_fk_cd_tipo']; ?>" selected><?php echo quees('cd_tipo', $row26['id_cd_tipo_fk_cd_tipo']); ?></option>
                                    <?php } ?>
                                    <option value=""></option>
                                    <?php $query5 = "SELECT * FROM cd_tipo WHERE id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND estado_cd_tipo=1";
                                    $result = $mysqli->query($query5);
                                    while ($row5 = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <option value="<?php echo $row5['id_cd_tipo']; ?>"><?php echo $row5['nombre_cd_tipo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL QUEJOSO:</label>
                                <input type="text" class="form-control" name="nombre_quejoso_cd" value="<?php echo $row26['nombre_quejoso_cd']; ?>" required>
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label">ENTIDAD:</label>
                                <input type="text" class="form-control" name="nombre_entidad_cd" value="<?php echo $row26['nombre_entidad_cd']; ?>">
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"> FECHA DE HECHOS:</label>
                                <input type="date" class="form-control" name="fecha_hechos_cd" value="<?php echo $row26['fecha_hechos_cd']; ?>">
                            </div>

                            <div class="form-group text-left">
                                <label class="control-label"><span style="color:#ff0000;">*</span> ASUNTO:</label>
                                <textarea class="form-control" name="asunto_cd" required><?php echo $row26['asunto_cd']; ?></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success btn-xs" value="Actualizar" name="editar_cd">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <script>
            // Funcion para no duplicar envios de formularios
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            // FUNCION SORTABLE
            $(document).ready(function() {
                $('#organizaAnexos').sortable({
                    revert: true,
                    opacity: 0.6,
                    cursor: 'move',
                    update: function() {
                        var order = $('#organizaAnexos').sortable("serialize") + '&action=orderState';
                        $.post("pages/control_proceso_organiza.php", order, function(theResponse) {
                            window.alert('Ordenado Correctamente');
                        });
                    }
                });
            });
            // FUNCION AGREGA ENTIDADES
            $(function() {
                $("#idAgregarEntidades").select2({
                    dropdownParent: $('#modalAgregarEntidadesImplicados')
                });
            });
        </script>
<?php
    }
}
