<?php
$nump125 = privilegios(125, $_SESSION['snr']); // SID Auxiliar
$nump126 = privilegios(126, $_SESSION['snr']); // SID Profesional
$nump127 = privilegios(127, $_SESSION['snr']); // SID Coordinador
$nump128 = privilegios(128, $_SESSION['snr']); // SID Jefe
$nump143 = privilegios(143, $_SESSION['snr']); // Usuario usado por sebastian

// VARIABLES GLOBALES
$GlobalIdFuncionario = $_SESSION['snr'];
$GlobalGrupoArea = $_SESSION['snr_grupo_area'];
$asignacionProfesional = '125,126,127,128';

// Oficina de Control Disciplinario Interno = 23
if ($GlobalGrupoArea == 23) {
  $GlobalTipoDeOficina = 1;
  $nomenclatura = 'OCDI';
  $asignadoGlobalGrupoArea = '23';
  if (0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND";
  } elseif (0 < $nump126) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND id_funcionario_fk_asignado=$GlobalIdFuncionario AND";
  }
  $correoMasivoDesde = 'procesos.disciplinarios@supernotariado.gov.co,juzgamientoocdi@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}

// Superintendencia Delegada Para El Registro = 41
// Grupo de Inspeccion Vigilancia y Control Registral = 42
// Grupo de Gestion Disciplinaria Registral = 313
if ($GlobalGrupoArea == 41 or $GlobalGrupoArea == 42 or $GlobalGrupoArea == 313) {
  $GlobalTipoDeOficina = 2;
  $nomenclatura = 'SDR';
  $asignadoGlobalGrupoArea = '41,42,313';
  if (0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND";
  } elseif (0 < $nump126) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND id_funcionario_fk_asignado=$GlobalIdFuncionario AND";
  }
  $correoMasivoDesde = 'instrucciondisciplinariaregistral@supernotariado.gov.co,alertasinstrucciondisciplinariaregistral@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}

// Superintendencia Delegada Para El Notariado = 44
// Direccion de Vigilancia y Control Notarial = 45 
if ($GlobalGrupoArea == 44 or $GlobalGrupoArea == 45) {
  $GlobalTipoDeOficina = 3;
  $nomenclatura = 'SDN';
  $asignadoGlobalGrupoArea = '44,45';
  if (0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND";
  } elseif (0 < $nump126) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND id_funcionario_fk_asignado=$GlobalIdFuncionario AND";
  }
  $correoMasivoDesde = 'notificacionesdisciplinariosdn@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}

// Superintendencia Delegada para la Proteccion Restitucion y Formalizacion de Tierras = 297
// Grupo para el control y vigilancia de Curadores Urbanos = 305
if ($GlobalGrupoArea == 297 or $GlobalGrupoArea == 305) {
  $GlobalTipoDeOficina = 4;
  $nomenclatura = 'SDC';
  $asignadoGlobalGrupoArea = '297,305';
  if (0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND";
  } elseif (0 < $nump126) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND id_funcionario_fk_asignado=$GlobalIdFuncionario AND";
  }
  $correoMasivoDesde = 'instrucciondisciplinariacuradores@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}

// Oficina Asesora Juridica = 12
if ($GlobalGrupoArea == 12) {
  $GlobalTipoDeOficina = 5;
  $nomenclatura = 'OAJ';
  $asignadoGlobalGrupoArea = '12';
  if (0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND";
  } elseif (0 < $nump126) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND id_funcionario_fk_asignado=$GlobalIdFuncionario AND";
  }
  $correoMasivoDesde = 'juzgamiento.oaj@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}

// Despacho Del Superintendente = 1 | Oficina Asesora Juridica = 12 para asignar a luisa
if ($GlobalGrupoArea == 1) {
  $GlobalTipoDeOficina = 6;
  $nomenclatura = 'DDS';
  $asignadoGlobalGrupoArea = '1';
  if (0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND";
  } elseif (0 < $nump126) {
    $querynum = "id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND id_funcionario_fk_asignado=$GlobalIdFuncionario AND";
  }
  $correoMasivoDesde = 'sisg@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}

// SUPER ADMINISTRADOR
if (1 == $_SESSION['rol'] or 0 < $nump143) {
  $GlobalTipoDeOficina = 3; // 3 = OFICINA NOTARIA
  $nomenclatura = 'SDN'; // NOMENCLATURA
  $querynum = ""; // CONSULTA
  $asignadoGlobalGrupoArea = '44,45'; // AREAS QUE SE VEN EN LAS OPCIONES
  $correoMasivoDesde = 'sisg@supernotariado.gov.co';
  $correoCopiaOculta = 'sisg@supernotariado.gov.co';
}


// CONTROL DE INGRESO A LA APLICACION
if ((0 < $nump125 or
    0 < $nump126 or
    0 < $nump127 or
    0 < $nump128) or
  1 == $_SESSION['rol']
) {
  // Fecha Actual
  date_default_timezone_set("America/Bogota");
  $fechaActual = date("Y-m-d H:i:s");
  $fechaAno = date("Y");

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

  //  ENVIO DE CORREO PARA EL NOTIFICADOR
  function envioCorreoPerfil($idCd, $para, $correoMasivoDesde, $correoCopiaOculta, $rol)
  {
    if ('notificador' == $rol) {
      $desde = $correoMasivoDesde;
      $cuerpo  = "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'>";
      $cuerpo .= "<img src='https://sisg.supernotariado.gov.co/siteminderagent/dmspages/SNR.jpg'><br>";
      $cuerpo .= "Se informa que se ha realizado una asignación sobre el sistema SID que necesita de su atención.<br>";
      $cuerpo .= "Por favor Ingresar a: <br>";
      $cuerpo .= '<a href="https://sisg.supernotariado.gov.co/control_proceso_detalle&' . $idCd . '.jsp" target="_blank">https://sisg.supernotariado.gov.co/control_proceso_detalle&' . $idCd . '.jsp</a> <br>';
      $cuerpo .= "Gracias.<br>";
      $cuerpo .= "Este correo es informativo, no brindará ninguna respuesta. ";
      $cuerpo .= "<br></div><br></div>";
    } elseif ('profesional' == $rol) {
      $desde = $correoMasivoDesde;
      $cuerpo  = "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'>";
      $cuerpo .= "<img src='https://sisg.supernotariado.gov.co/siteminderagent/dmspages/SNR.jpg'><br>";
      $cuerpo .= "Se informa que se ha realizado una asignación sobre el sistema SID que necesita de su atención.<br>";
      $cuerpo .= "Por favor ingresar a: <br>";
      $cuerpo .= '<a href="https://sisg.supernotariado.gov.co/control_proceso_detalle&' . $idCd . '.jsp" target="_blank">https://sisg.supernotariado.gov.co/control_proceso_detalle&' . $idCd . '.jsp</a> <br>';
      $cuerpo .= "Gracias.<br>";
      $cuerpo .= "Este correo es informativo, no brindará ninguna respuesta.";
      $cuerpo .= "<br></div><br></div>";
    }
    $destinatario = "{$para}";
    $asunto = "Nueva Notificación";
    //para el envío en formato HTML 
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    //dirección del remitente 
    $headers .= "From: Supernotariado <{$desde}>\r\n";
    //direcciones que recibián copia 
    $headers .= "Cc: {$desde}\r\n";
    //direcciones que recibirán copia oculta 
    $headers .= "Bcc: {$correoCopiaOculta}\r\n";
    //Enviar EMail
    $mail = @mail($destinatario, $asunto, $cuerpo, $headers);
  }

  // FORMULARIO INICIAL
  if (
    isset($_POST["radicacion_iris_cd"]) && $_POST["radicacion_iris_cd"] != "" and
    isset($_POST["fecha_queja_cd"]) && $_POST["fecha_queja_cd"] != "" and
    isset($_POST["fecha_traslado_cd"]) && $_POST["fecha_traslado_cd"] != "" and
    isset($_POST["canal_entrada_cd"]) && $_POST["canal_entrada_cd"] != "" and
    isset($_POST["nombre_quejoso_cd"]) && $_POST["nombre_quejoso_cd"] != "" and
    isset($_POST["asunto_cd"]) && $_POST["asunto_cd"] != ""
  ) {

    //Consecutivo del sistema
    if (isset($_POST["consecutivo_nomenclatura_cd"]) && $_POST["consecutivo_nomenclatura_cd"] != "") {
      $query2 = "SELECT MAX(consecutivo_numero_cd) AS CONSE FROM cd WHERE estado_cd=1 AND consecutivo_ano_cd=$fechaAno";
      $result2 = $mysqli->query($query2);
      $row2 = $result2->fetch_array(MYSQLI_ASSOC);
      if (isset($row2['CONSE'])) {
        $ConsecutivoNumero = 1 + $row2['CONSE'];
      } else {
        $ConsecutivoNumero = 1;
      }
    }

    // funcion para enviar correo cuando la fecha hechos tiene mas 4 años a la fecha actual
    // $dateDifference = abs(strtotime($fechaActual) - strtotime($_POST["fecha_hechos_cd"]));
    // $years  = floor($dateDifference / (365 * 60 * 60 * 24));
    // $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    // if (isset($_POST["fecha_hechos_cd"]) && $years >= 4 && $months >= 11) {
    //   $emailur2 = "giovanni.ortegon@supernotariado.gov.co";
    //   $emailur2 = $correoMasivoDesde;

    //   $subject = 'ASUNTO DEL CORREO DE LA DELEGADA CORRESPONDIENTE';
    //   $cuerpo2 = '';
    //   $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    //   $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha CUERPO DEL CORREO DE LA DELEGADA CORRESPONDIENTE por el siguiente motivo.<br><br>';
    //   $cuerpo2 .= "CUERPO DEL CORREO DE LA DELEGADA CORRESPONDIENTE";
    //   $cuerpo2 .= "<br><br>";
    //   $cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
    //   $cuerpo2 .= "<br></div><br></div>";
    //   $cabeceras = '';
    //   $cabeceras .= 'From: Supernotariado<sisg@supernotariado.gov.co>' . "\r\n";
    //   $cabeceras .= 'Bcc: ' . $correoCopiaOculta . "\r\n";
    //   $cabeceras .= "MIME-Version: 1.0\r\n";
    //   $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    //   mail($emailur2, $subject, $cuerpo2, $cabeceras);
    // }

    // Funcion para sumar 5 años
    if (isset($_POST["fecha_hechos_cd"])) {
      $fechaHechos = date($_POST["fecha_hechos_cd"]);
      $fechaPrescripcion = date("Y-m-d", strtotime($fechaHechos . "+ 5 year"));
    } else {
      $fechaHechos = NULL;
      $fechaPrescripcion = NULL;
    }

    // Insertar datos en tabla cd
    $insertSQL = sprintf(
      "INSERT INTO cd (
        id_tipo_oficina_fk_tipo_oficina, 
        canal_entrada_cd,
        radicacion_iris_cd,
        fecha_queja_cd,
        iris_traslado_cd,

        fecha_traslado_cd,
        fecha_hechos_cd,
        checkbox_prioritario_cd,
        nombre_quejoso_cd,
        nombre_entidad_cd,

        consecutivo_nomenclatura_cd,
        nomenclatura_fase_cd,
        consecutivo_numero_cd,
        consecutivo_ano_cd,
        creado_desde_cd,

        asunto_cd,
        fecha_prescripcion_cd, 
        id_cd_tipo_fk_cd_tipo,
        fecha_creado_cd) 
        VALUES 
        (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s)",
      GetSQLValueString($GlobalTipoDeOficina, "int"),
      GetSQLValueString($_POST["canal_entrada_cd"], "text"),
      GetSQLValueString($_POST["radicacion_iris_cd"], "text"),
      GetSQLValueString($_POST["fecha_queja_cd"], "date"),
      GetSQLValueString($_POST["iris_traslado_cd"], "date"),

      GetSQLValueString($_POST["fecha_traslado_cd"], "date"),
      GetSQLValueString($_POST["fecha_hechos_cd"], "date"),
      GetSQLValueString($_POST["checkbox_prioritario_cd"] ? 1 : 0, "int"),
      GetSQLValueString($_POST["nombre_quejoso_cd"], "text"),
      GetSQLValueString($_POST["nombre_entidad_cd"], "text"),

      GetSQLValueString($_POST["consecutivo_nomenclatura_cd"], "text"),
      GetSQLValueString(1, "int"),
      GetSQLValueString($ConsecutivoNumero, "int"),
      GetSQLValueString($fechaAno, "text"),
      GetSQLValueString("Nuevo SID", "text"),

      GetSQLValueString($_POST["asunto_cd"], "text"),
      GetSQLValueString($fechaPrescripcion, "date"),
      GetSQLValueString($_POST["id_cd_tipo_fk_cd_tipo"], "int"),
      GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
    $idInsert = mysql_insert_id($conexion);
    auditoria(NULL, 'cd', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=./control_proceso.jsp" />';
  }

  // FORMULARIO DE ASIGNACION
  if (
    isset($_POST["crear_asignacion"]) && $_POST["crear_asignacion"] != "" &&
    isset($_POST["id_cd_fk_cd_asignado"]) && $_POST["id_cd_fk_cd_asignado"] != "" &&
    isset($_POST["para_cd_asignado_fk_id_funcionario"]) && $_POST["para_cd_asignado_fk_id_funcionario"] != ""
  ) {
    // VARIABLES
    $deGrupoArea = isset($_SESSION['snr_grupo_area']) ? $_SESSION['snr_grupo_area'] : 0;
    $idCd = $_POST["id_cd_fk_cd_asignado"];
    $funcionario_area = explode("-", $_POST["para_cd_asignado_fk_id_funcionario"]);
    $idfuncionario = $funcionario_area[0];
    $grupoarea = $funcionario_area[1];

    // CONSULTA SABER PERFIL SID NOTIFICADOR
    $query7 = "SELECT count(id_funcionario) AS countFunPerfil FROM funcionario_perfil WHERE id_funcionario = $idfuncionario AND id_perfil=130 AND estado_funcionario_perfil=1 LIMIT 1";
    $result7 = $mysqli->query($query7);
    $row7 = $result7->fetch_array(MYSQLI_ASSOC);
    $countFunPerfilRow = $row7['countFunPerfil'];

    // CONSULTA SABER PERFIL PROFESIONAL
    $query8 = "SELECT count(id_funcionario) AS countProfesional FROM funcionario_perfil WHERE id_funcionario = $idfuncionario AND id_perfil=126 AND estado_funcionario_perfil=1 LIMIT 1";
    $result8 = $mysqli->query($query8);
    $row8 = $result8->fetch_array(MYSQLI_ASSOC);
    $countProfesional = $row8['countProfesional'];

    // CONSULTA CORRREO DEL FUNCIONARIO
    if (0 < $countFunPerfilRow || 0 < $countProfesional) {
      $query9 = "SELECT correo_funcionario FROM funcionario WHERE id_funcionario = $idfuncionario AND estado_funcionario=1 LIMIT 1";
      $result9 = $mysqli->query($query9);
      $row9 = $result9->fetch_array(MYSQLI_ASSOC);
      $correoFunNotificador = $row9['correo_funcionario'];

      if (isset($row9['correo_funcionario']) && null != $row9['correo_funcionario']) {
        if (0 < $countFunPerfilRow) {
          envioCorreoPerfil($idCd, $correoFunNotificador, $correoMasivoDesde, $correoCopiaOculta, 'notificador');
        }
        if (0 < $countProfesional) {
          envioCorreoPerfil($idCd, $correoFunNotificador, $correoMasivoDesde, $correoCopiaOculta, 'profesional');
        }
      } else {
        echo  '<script type="text/javascript">swal(" NO Existe Correo!", " Debe Contactar con el administrador del sistema el usuario NO tiene correo Institucional asignado. !", "error"); </script>';
      }
    }

    // INSERT ASIGNADO
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
      GetSQLValueString($idCd, "int"),
      GetSQLValueString($GlobalIdFuncionario, "int"),
      GetSQLValueString($deGrupoArea, "int"),
      GetSQLValueString($idfuncionario, "int"),
      GetSQLValueString($grupoarea, "int"),

      GetSQLValueString($_POST["motivo_cd_asignado"], "text"),
      GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
    $idInsert = mysql_insert_id($conexion);
    auditoria($idCd, 'cd', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
    // actualiza el id funcionario 
    $queryUpdate = "UPDATE cd SET id_funcionario_fk_asignado = $idfuncionario WHERE id_cd = $idCd";
    $mysqli->query($queryUpdate);
    auditoria($idCd, 'cd', $idInsert, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
    // ingreso primera vez de la fecha asignacion
    $query6 = "SELECT fecha_asignacion AS fa FROM cd WHERE id_cd = $idCd AND estado_cd=1";
    $result6 = $mysqli->query($query6);
    $row6 = $result6->fetch_array(MYSQLI_ASSOC);
    if (is_null($row6['fa'])) {
      $queryUpdatefec = "UPDATE cd SET fecha_asignacion = '$fechaActual' WHERE id_cd = $idCd";
      $mysqli->query($queryUpdatefec);
    }
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=./control_proceso.jsp" />';
  }

  // INSERTAR UN TRANSLADO
  if (
    isset($_POST["cd_traslado"]) && '' != $_POST["cd_traslado"] &&
    isset($_POST["id_cd"]) && '' != $_POST["id_cd"] &&
    isset($_POST["id_tipo_oficina_fk_tipo_oficina"]) && '' != $_POST["id_tipo_oficina_fk_tipo_oficina"]
  ) {
    $uno = $_POST["id_cd"];
    $dos = $_POST["id_tipo_oficina_fk_tipo_oficina"];
    $tres = NULL;
    if (7 == $_POST["id_tipo_oficina_fk_tipo_oficina"]) {
      $dos = 1;
      $tres = 'OCDI-JZ-';
    }
    if (8 == $_POST["id_tipo_oficina_fk_tipo_oficina"]) {
      $dos = 5;
      $tres = 'OAJ-JZ-';
    }
    $queryUpdate0 = "UPDATE cd SET id_tipo_oficina_fk_tipo_oficina = $dos, nomenclatura_juzgamiento_cd = '$tres', id_funcionario_fk_asignado = NULL WHERE id_cd = $uno ";

    $insertSQL = sprintf(
      "INSERT INTO cd_traslado (
        id_cd_fk_cd_traslado, 
        dependencia_cd_traslado,
        fecha_cd_traslado) 
        VALUES 
        (%s,%s,%s)",
      GetSQLValueString($uno, "int"),
      GetSQLValueString($dos, "int"),
      GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

    auditoria($uno, 'cd', $uno, $queryUpdate0, $GlobalIdFuncionario, $fechaActual, $conexion);
    if ($mysqli->query($queryUpdate0) === TRUE) {
      echo $actualizado;
    } else {
      echo "Error: " . $queryUpdate0 . $queryUpdate1 . "<br>" . $mysqli->error;
    }
    echo '<meta http-equiv="refresh" content="0;URL=./control_proceso.jsp" />';
  }

  // CAMBIO DE AREA PARA LUISA
  if (
    isset($_POST["guardar_cambio_grupo"]) && '' != $_POST["guardar_cambio_grupo"] &&
    isset($_POST["id_grupo_area"]) && '' != $_POST["id_grupo_area"]
  ) {
    $idGrupoArea = $_POST["id_grupo_area"];
    $queryUpdate = "UPDATE funcionario SET id_grupo_area = '$idGrupoArea' WHERE id_funcionario = $GlobalIdFuncionario";
    $mysqli->query($queryUpdate);
    auditoria(NULL, 'funcionario', $idGrupoArea, $queryUpdate, $GlobalIdFuncionario, $fechaActual, $conexion);
    echo '<meta http-equiv="refresh" content="0;URL=https://accesos.supernotariado.gov.co/iam/im/logout.jsp?envAlias=snr" />';
  }

?>
  <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #888 !important;
      border-color: #888 !important;
      color: white;
      padding: 0 10px !important;
      margin-top: 0.31rem !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
      color: white !important;
      float: right !important;
      margin-left: 5px !important;
      margin-right: -2px !important;
    }

    .label-info,
    .modal-info .modal-body {
      background-color: #888 !important;
    }

    .label {
      display: inline;
      padding: 0.2em 0.6em 0.3em;
      font-size: 75%;
      font-weight: 400;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25em;
    }

    .bootstrap-tagsinput input {
      text-transform: uppercase;
      width: 600px !important;
    }

    .bootstrap-tagsinput .tag {
      text-transform: uppercase;
    }
  </style>

  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo Expediente Disciplinario</h4>
        </div>
        <div class="modal-body">

          <form action="" method="POST" name="for54354r6546tretret4563m1">

            <div class="form-group text-left">
              <label class="control-label">CONSECUTIVO:</label>
              <input type="text" readonly class="form-control" value="<?php echo $nomenclatura; ?>" name="consecutivo_nomenclatura_cd">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN IRIS:</label>
              <input type="text" class="form-control" name="radicacion_iris_cd" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE QUEJA:</label>
              <input type="date" class="form-control" name="fecha_queja_cd" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"> IRIS DEL TRASLADO:</label>
              <input type="text" class="form-control" name="iris_traslado_cd">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL TRASLADO A DISCIPLINARIO:</label>
              <input type="date" class="form-control" name="fecha_traslado_cd" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CANAL DE ENTRADA:</label>
              <select class="form-control" name="canal_entrada_cd" required>
                <option value="" selected></option>
                <option value="PQRSD">PQRSD</option>
                <option value="INFORME OFICIAL">INFORME OFICIAL</option>
                <option value="DE OFICIO">DE OFICIO</option>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label">TIPOLOGIA:</label>
              <select class="form-control" name="id_cd_tipo_fk_cd_tipo">
                <option value="" selected></option>
                <?php $query5 = "SELECT * FROM cd_tipo WHERE id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND estado_cd_tipo=1";
                $result = $mysqli->query($query5);
                while ($row5 = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                  <option value="<?php echo $row5['id_cd_tipo']; ?>"><?php echo $row5['nombre_cd_tipo']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL QUEJOSO:</label>
              <input type="text" class="form-control" name="nombre_quejoso_cd" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label">ENTIDAD:</label>
              <input type="text" class="form-control" name="nombre_entidad_cd">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> ASUNTO:</label>
              <textarea class="form-control" name="asunto_cd" required></textarea>
            </div>

            <div class="form-group text-left">
              <label class="control-label">FECHA DE HECHOS:</label>
              <input type="date" class="form-control" name="fecha_hechos_cd" id="fechaHechos" onchange="cambiarEndDate()">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="checkbox_prioritario_cd"> Prioritario
                </label>
              </div>
            </div>

            <div class="form-group text-left">
              <label class="control-label">FECHA DE PRESCRIPCIÓN:</label>
              <input type="text" class="form-control" id="fechaPrescripcion" readonly>
            </div>

            <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success">
                <input type="hidden" name="table" value="resoluciondatos">
                <span class="glyphicon glyphicon-ok"></span> Crear </button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Cambiar de Area solo luisa -->
  <?php if (1247 == $_SESSION['snr'] || 1 == $_SESSION['rol']) {
    $query22 = "SELECT id_grupo_area FROM funcionario WHERE id_funcionario=$GlobalIdFuncionario AND estado_funcionario=1";
    $result22 = $mysqli->query($query22);
    $row22 = $result22->fetch_array(MYSQLI_ASSOC);
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <span><b>Cambio de Area</b></span>
            <div class="box-tools pull-right" style="width:500px">
              <form action="" method="post" name="cambioArea234">
                <div class="input-group-btn">
                  <input type="hidden" name="guardar_cambio_grupo" value="save">
                  <select name="id_grupo_area" class="form-control" required>
                    <?php if (1 == $row22['id_grupo_area']) { ?>
                      <option value="1" selected>Despacho Del Superintendente</option>
                    <?php } elseif (12 == $row22['id_grupo_area']) { ?>
                      <option value="12" selected>Oficina Asesora Juridica</option>
                    <?php } else { ?>
                      <option value="" selected>--- Seleccionar ---</option>
                    <?php } ?>
                    <option value="">--- Seleccionar ---</option>
                    <option value="1">Despacho Del Superintendente</option>
                    <option value="12">Oficina Asesora Juridica</option>
                  </select>
                </div>
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">

          <div class="col-md-5">
            <h3 class="box-title">
              <?php if (0 < $nump125 or 0 < $nump127 or 1 == $_SESSION['rol']) { ?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
                  Nuevo
                </button>&nbsp;&nbsp;&nbsp;
              <?php } ?>
            </h3>
            | <a href="https://supernotariadoyregistro-my.sharepoint.com/:v:/r/personal/jhon_morera_supernotariado_gov_co/Documents/Grabaciones/CAPACITACI%C3%93N%20OFICIAL%20NUEVO%20SISTEMA%20DISCIPLINARIO-20230502_094340-Meeting%20Recording.mp4?csf=1&web=1&e=V8LQxX&nav=eyJwbGF5YmFja09wdGlvbnMiOnsic3RhcnRUaW1lSW5TZWNvbmRzIjozLjA3fX0%3D" target="_blank"><span style="font-size: 13px;">Capacitacion Video 1</span></a> |
            <a href="https://supernotariadoyregistro-my.sharepoint.com/:v:/r/personal/luisa_sosa_supernotariado_gov_co/Documents/Grabaciones/CAPACITACI%C3%93N%20OFICIAL%20NUEVO%20SISTEMA%20DISCIPLINARIO-20230504_221022-Grabaci%C3%B3n%20de%20la%20reuni%C3%B3n.mp4?csf=1&web=1&e=cWX9cF" target="_blank"><span style="font-size: 13px;">Capacitacion Video 2</span></a> |
            <a href="../images/Circular No. 671 Diciembre 29 de 2022.pdf" target="_blank"><span style="font-size: 13px;">Circular No. 671 Diciembre 29 de 2022</span></a> |
            <a href="https://sisg.supernotariado.gov.co/files/portal/intranet/portal-manual_sid_2023.pdf" target="_blank"><span style="font-size: 13px;">Manual SID 2023</span></a> |
          </div>

          <div class="col-md-2">
            <h3 class="box-title">
              <b>Bandeja de Entrada</b>
            </h3>
          </div>

          <div class="box-tools pull-right">
            <?php if (1 == $_SESSION['rol'] or (isset($nump129) && 0 < $nump129)) { ?>
              <a href="control_proceso_nueva_notificacion.jsp" class="btn btn-success btn-sm" target="_blank"><span class="glyphicon glyphicon-plus-sign"></span> Notificación</a>
            <?php } ?>
            <a href="control_proceso_reporte.jsp" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-fw fa-table"></i> Historico</a>
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div> <!-- FINAL box-tools pull-right -->
        </div> <!-- FINAL box-header with-border -->

        <div class="row">
          <div class="box-tools pull-right" style="margin-right:10px;">
            <form class="navbar-form" name="fotertrm3252345rter1erteg" method="POST">
              <div class="input-group">
                <div style="padding-right: 20px;">
                  <span class="help-block">Buscar expedientes trasladados a otras areas</span>
                </div>
                <div class="input-group-btn">
                  <select name="buscar" class="form-control" required>
                    <option value="Traslado">Traslado</option>
                  </select>
                </div>
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger" title="Buscar Expediente"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                  <a href="https://sisg.supernotariado.gov.co/control_proceso.jsp" class="btn btn-default" title="Refrescar Consulta"><i class="fa fa-fw fa-refresh"></i></a><br>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">

              <thead>
                <tr align="center" valign="middle">
                  <th>Fecha</th>
                  <th>Expediente</th>
                  <th>Entrada</th>
                  <th>Area</th>
                  <th>Fase | Etapa | Accion</th>
                  <th>Creado desde</th>
                  <th>Asignado</th>
                  <th>Tipo</th>
                  <th>Estado</th>
                  <th style="width:100px;">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                  $querydependencia = "SELECT GROUP_CONCAT(DISTINCT id_cd_fk_cd_traslado ORDER BY id_cd_fk_cd_traslado) AS id_cd_fk_cd_traslado_array
                     FROM cd_traslado
                     WHERE dependencia_cd_traslado = $GlobalTipoDeOficina AND estado_cd_traslado = 1";
                  $resultdependencia = $mysqli->query($querydependencia);
                  $stringValue = "";
                  while ($rowdependencia = $resultdependencia->fetch_array(MYSQLI_ASSOC)) {
                    $arrayValue = $rowdependencia["id_cd_fk_cd_traslado_array"];
                    $stringValue .= $arrayValue;
                  }
                  $stringValue = trim($stringValue, ",");
                  $infop = " id_cd IN ($stringValue) AND";
                } else {
                  $infop = $querynum;
                }
                $query4 = "SELECT * FROM cd WHERE 
                $infop
                estado_cd=1";
                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                  <tr>
                    <?php
                    echo '<td>' . $row['fecha_creado_cd'] . '</td>';

                    echo '<td style="width: 120px;">';
                    if (7 == $row['id_cd']) {
                      echo '<span style="color:red">Expediente Prueba <br>' . $row['nomenclatura_juzgamiento_cd'] . $row['consecutivo_nomenclatura_cd'] . '-' . $row['consecutivo_numero_cd'] . '-' . $row['consecutivo_ano_cd'] . '</span>';
                    } else {
                      echo
                      '<a href="control_proceso_detalle&' . $row['id_cd'] . '.jsp">' .
                        $row['nomenclatura_juzgamiento_cd'] . $row['consecutivo_nomenclatura_cd'] . '-' . $row['consecutivo_numero_cd'] . '-' . $row['consecutivo_ano_cd'] .
                        '</a>';
                    }
                    echo '</td>';


                    echo '<td>' . $row['canal_entrada_cd'] . '</td>';

                    echo '<td>';
                    $tipoOficina = $row['id_tipo_oficina_fk_tipo_oficina'];
                    if ($tipoOficina == 1) {
                      echo 'Oficina de Control Disciplinario Interno';
                    } elseif ($tipoOficina == 2) {
                      echo 'Grupo de Gestion Disciplinaria Registral';
                    } elseif ($tipoOficina == 3) {
                      echo 'Direccion de Vigilancia y Control Notarial';
                    } elseif ($tipoOficina == 4) {
                      echo 'Grupo para el control y vigilancia de Curadores Urbanos';
                    } elseif ($tipoOficina == 5) {
                      echo 'Oficina Asesora Juridica';
                    } elseif ($tipoOficina == 6) {
                      echo 'Despacho Del Superintendente';
                    }
                    echo '</td>';

                    echo '<td style="font-size:10px;">';

                    $idCdUnionCdDetalle = $row['id_cd'];
                    $query20 = "SELECT * FROM cd_detalle_accion WHERE id_cd_fk_cd_detalle_accion=$idCdUnionCdDetalle AND estado_cd_detalle_accion=1 ORDER BY fecha_creado_cd_detalle_accion DESC";
                    $result20 = $mysqli->query($query20);
                    $row20 = $result20->fetch_array(MYSQLI_ASSOC);
                    if (isset($row20['id_cd_etapa_fk_cd_detalle_accion'])) {
                      if ($row20['id_cd_etapa_fk_cd_detalle_accion']) {
                        $idEtapa = $row20['id_cd_etapa_fk_cd_detalle_accion'];
                        $query21 = "SELECT * FROM cd_etapa WHERE id_cd_etapa=$idEtapa AND estado_cd_etapa=1";
                        $result21 = $mysqli->query($query21);
                        $row21 = $result21->fetch_array(MYSQLI_ASSOC);
                        echo 'Fase: ';
                        echo quees('cd_fase', $row21['id_cd_fase_fk_cd_etapa']);
                      }
                      echo '<br>';
                      echo 'Etapa: ';
                      echo quees('cd_etapa', $row20['id_cd_etapa_fk_cd_detalle_accion']);
                      echo '<br>';
                      echo 'Accion: ';
                      echo quees('cd_accion', $row20['id_cd_accion_fk_cd_detalle_accion']);

                      $idAccion = $row20['id_cd_detalle_accion'];
                      $query21 = "SELECT * FROM cd_anexos WHERE id_cd_fk_cd_anexos=$idCdUnionCdDetalle 
                      AND id_cd_accion_fk_cd_anexos=$idAccion
                      AND estado_cd_anexos=1 
                      ORDER BY fecha_creado_cd_anexos DESC";
                      $result21 = $mysqli->query($query21);
                      $row21 = $result21->fetch_array(MYSQLI_ASSOC);
                      echo '<br>';
                      echo 'Detalle: ';
                      if (isset($row21['id_cd_accion_fk_cd_anexos']) && $idAccion == $row21['id_cd_accion_fk_cd_anexos']) {
                        echo $row21['pra_cd_anexos'];
                      } else {
                        echo 'Sin Adjuntos';
                      }
                    }

                    echo '</td>';

                    echo '<td>';
                    echo $row['creado_desde_cd'];
                    echo '</td>';

                    echo '<td>';
                    echo isset($row['id_funcionario_fk_asignado']) ? quees('funcionario', $row['id_funcionario_fk_asignado']) : 'Sin Asignar';
                    echo '</td>';

                    echo '<td>';
                    if (isset($row['id_cd_tipo_fk_cd_tipo'])) {
                      echo quees('cd_tipo', $row['id_cd_tipo_fk_cd_tipo']);
                    }
                    echo '</td>';

                    echo '<td>';
                    echo $row['estado_expediente_cd'];
                    echo '</td>';

                    echo '<td style="width: 85px;">'; ?>
                    <?php if ($row['id_tipo_oficina_fk_tipo_oficina'] == $GlobalTipoDeOficina || 1 == $_SESSION['rol'] || 0 < $nump143) { ?>

                      <?php if (isset($row["estado_expediente_cd"]) && "Activo" == $row["estado_expediente_cd"]) { ?>

                        <?php if (0 < $nump125 || 0 < $nump127 ||  0 < $nump128 || 1 == $_SESSION['rol'] || 0 < $nump143) { ?>
                          <a href="" class="btn btn-info btn-xs sidasignacion" id="<?php echo $row['id_cd'] . '-' . $asignadoGlobalGrupoArea; ?>" data-toggle="modal" data-target="#modalAsignacion" title="Asignación Expediente">
                            <i class="fa fa-fw fa-group"></i>
                          </a>
                          <a href="" onclick="alertconfirmtras();" class="btn btn-default btn-xs sidtraslado" id="<?php echo $row['id_cd'] . '-' . $GlobalTipoDeOficina; ?>" data-toggle="modal" data-target="#modalTraslado" title="Traslado Dependencias">
                            <i class="fa fa-exchange"></i>
                          </a>
                        <?php } ?>

                      <?php } ?>

                    <?php } ?>

                    <a class="btn btn-warning btn-xs" href="control_proceso_detalle&<?php echo $row['id_cd']; ?>.jsp" target="_blank" title="Ver Detalle Expediente">
                      <span class="fa fa-edit"></span>
                    </a>

                    <?php echo '</td>';
                    ?>
                  </tr>
                <?php } ?>
              </tbody>

            </table>


            <script>
              $(document).ready(function() {
                $('#inforesoluciones').DataTable({
                  "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "desc"]
                  ]
                });
              });
            </script>

          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->

      </div> <!-- FINAL PRIMARY -->
    </div> <!-- FINAL DE COL MD 12 -->
  </div> <!-- FINAL DE ROW -->


  <!-- MODAL ASIGNAR PROFESIONALES -->
  <div class="modal fade" id="modalAsignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <b>Asignación</b>
        </div>
        <div id="divsidasignacion"></div>
      </div>
    </div>
  </div>

  <!-- MODAL TRASLADO EXPEDIENTES ENTRE OFICINAS -->
  <div class="modal fade" id="modalTraslado" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <b>Traslado de Expedientes</b>
        </div>
        <div class="modal-body">
          <div id="divsidtraslado"></div>
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
      //Initialize Select2 Elements
      $('.select2').select2()
    })

    // Funcion visual para calcular los 5 años
    function cambiarEndDate() {
      let inputValue = document.getElementById("fechaHechos").value;
      var fechaA = new Date(inputValue);
      var fechaB = new Date(fechaA.setFullYear(fechaA.getFullYear() + 5));
      //Para mostrar en toLocalDateString 
      var resultado = document.getElementById('fechaPrescripcion').value = fechaB.toLocaleDateString();
    }

    function alertconfirmtras() {
      var mensaje = confirm("¿Esta seguro que desea Trasladar?");
    }
  </script>
<?php } ?>