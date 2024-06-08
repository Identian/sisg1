<?php

$nump108 = privilegios(108, $_SESSION['snr']);

if ((1 == $_SESSION['rol'] or 0 < $nump108) and isset($_GET["i"])) {
  $id = $_GET['i'];
  $select = mysql_query("SELECT codigo_dane, nombre_notaria, email_notaria, nombre_municipio, nombre_funcionario, nombre_departamento, id_autoridad_cancilleria 
  FROM departamento, notaria, municipio, funcionario, posesion_notaria  
  WHERE funcionario.id_cargo=1 AND funcionario.id_tipo_oficina=3 AND posesion_notaria.id_funcionario=funcionario.id_funcionario and estado_funcionario=1 
  and estado_posesion_notaria=1 AND fecha_fin is null AND notaria.id_notaria=posesion_notaria.id_notaria AND departamento.id_departamento=notaria.id_departamento and
  notaria.id_departamento=municipio.id_departamento AND notaria.codigo_municipio=municipio.codigo_municipio and notaria.id_notaria=" . $id . " and estado_notaria=1  limit 1", $conexion);
  $row = mysql_fetch_assoc($select);
  $codigo_dane = $row['codigo_dane'];
  $nombre_notaria = $row['nombre_notaria'];
  $nombre_municipio = $row['nombre_municipio'];
  $email_notaria = $row['email_notaria'];
  $nombre_funcionario = $row['nombre_funcionario'];
  $nombre_departamento = $row['nombre_departamento'];
  $id_autoridad_cancilleria = $row['id_autoridad_cancilleria'];
  mysql_free_result($select);
} else {

  $id = $_SESSION['id_vigilado'];
  if (1 == $_SESSION['snr_grupo_cargo'] && isset($_SESSION['posesionnotaria'])) {
    $select = mysql_query("SELECT codigo_dane, nombre_notaria, email_notaria, nombre_municipio, nombre_funcionario, nombre_departamento, id_autoridad_cancilleria 
    FROM departamento, notaria, municipio, funcionario, posesion_notaria  
    WHERE funcionario.id_cargo=1 AND funcionario.id_tipo_oficina=3 AND posesion_notaria.id_funcionario=funcionario.id_funcionario and estado_funcionario=1 
    and estado_posesion_notaria=1 AND fecha_fin is null AND notaria.id_notaria=posesion_notaria.id_notaria AND departamento.id_departamento=notaria.id_departamento and
    notaria.id_departamento=municipio.id_departamento AND notaria.codigo_municipio=municipio.codigo_municipio and notaria.id_notaria=" . $id . " and estado_notaria=1  limit 1", $conexion);
    $row = mysql_fetch_assoc($select);
    $codigo_dane = $row['codigo_dane'];
    $nombre_notaria = $row['nombre_notaria'];
    $nombre_municipio = $row['nombre_municipio'];
    $email_notaria = $row['email_notaria'];
    $nombre_funcionario = $row['nombre_funcionario'];
    $nombre_departamento = $row['nombre_departamento'];
    $id_autoridad_cancilleria = $row['id_autoridad_cancilleria'];
    mysql_free_result($select);
  } else {

    $select = mysql_query("SELECT codigo_dane, nombre_notaria, email_notaria, nombre_municipio, nombre_funcionario, nombre_departamento, id_autoridad_cancilleria 
FROM departamento, notaria, municipio, funcionario   
WHERE  funcionario.id_tipo_oficina=3 and estado_funcionario=1 AND funcionario.id_notaria_f=notaria.id_notaria
  AND departamento.id_departamento=notaria.id_departamento AND funcionario.id_funcionario=" . $_SESSION['snr'] . " AND notaria.id_notaria=" . $id . " 
and notaria.id_departamento=municipio.id_departamento AND notaria.codigo_municipio=municipio.codigo_municipio and  estado_notaria=1  limit 1 ", $conexion);
    $row = mysql_fetch_assoc($select);
    $codigo_dane = $row['codigo_dane'];
    $nombre_notaria = $row['nombre_notaria'];
    $nombre_municipio = $row['nombre_municipio'];
    $email_notaria = $row['email_notaria'];
    $nombre_funcionario = $row['nombre_funcionario'];
    $nombre_departamento = $row['nombre_departamento'];
    $id_autoridad_cancilleria = $row['id_autoridad_cancilleria'];
    mysql_free_result($select);
  }
}



///UPDATE FIRMA

if ((isset($_POST["id_apostilla_firmada"])) && ("" != $_POST["id_apostilla_firmada"])) {


  $tamano_archivo = 11534336;
  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
  $formato_archivo = array('pdf');


  $directoryftp = "filesnr/apostilla/";




  if (isset($_FILES['file']['name']) && "" != $_FILES['file']['name']) {

    $ruta_archivo = 'apostilla-' . $_SESSION['snr'] . '-' . date("YmdGis");

    $archivo = $_FILES['file']['tmp_name'];
    $tam_archivo = filesize($archivo);
    $tam_archivo2 = $_FILES['file']['size'];
    $nombrefile = strtolower($_FILES['file']['name']);
    //echo '<script>alert("'.$nombrefile.'");</script>';
    $info = pathinfo($nombrefile);

    $extension = $info['extension'];

    $array_archivo = explode('.', $nombrefile);
    $extension2 = end($array_archivo);

    //echo $tam_archivo;
    //echo $tam_archivo2;



    if ($tamano_archivo >= intval($tam_archivo2)) {

      if (($extension2 == $extension)) {
        $files = $ruta_archivo . '.' . $extension;
        $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
        //chmod($files,0777);
        $nombrebre_orig = ucwords($nombrefile);



        $insertSQL3 = sprintf(
          "UPDATE apostilla SET filefirmado=%s, fecha_firma=now()  WHERE identificador_a=%s and id_notaria=%s and estado_apostilla=1",
          GetSQLValueString($files, "text"),
          GetSQLValueString($_POST["id_apostilla_firmada"], "text"),
          GetSQLValueString($id, "int")
        );
        $Result3 = mysql_query($insertSQL3, $conexion);
        mysql_free_result($insertSQL3);
        $files2 = explode('.', $files);
        $files3 = $files2[0];



        $documentof3 = 'filesnr/apostilla/' . $files . '';


        if (file_exists($documentof3)) {


          $json1 = file_get_contents('http://192.168.202.57/wsMetadataPDF/' . $files3 . '.json');
          $json2 = json_decode($json1, true);
          $meta = $json2['estado'];

          if (1 == $meta) {
            $xml = $json2['data'];
            $info = explode('<IdAutoridad>', $xml);
            $info2 = $info[1];
            $info3 = explode('</IdAutoridad>', $info2);
            $code = $info3[0];
            $insertSQL323 = sprintf(
              "UPDATE apostilla SET revmetadata=" . $code . " WHERE identificador_a=%s and id_notaria=%s and estado_apostilla=1",
              GetSQLValueString($_POST["id_apostilla_firmada"], "text"),
              GetSQLValueString($id, "int")
            );
            $Result323 = mysql_query($insertSQL323, $conexion);
          } else {
            $insertSQL323 = sprintf(
              "UPDATE apostilla SET revmetadata=0 WHERE identificador_a=%s and id_notaria=%s and estado_apostilla=1",
              GetSQLValueString($_POST["id_apostilla_firmada"], "text"),
              GetSQLValueString($id, "int")
            );
            $Result323 = mysql_query($insertSQL323, $conexion);
          }
          mysql_free_result($insertSQL323);



          if (1 == 1) {
            $insertSQL32 = sprintf(
              "UPDATE apostilla SET metadata=1 WHERE identificador_a=%s and id_notaria=%s and estado_apostilla=1",
              GetSQLValueString($_POST["id_apostilla_firmada"], "text"),
              GetSQLValueString($id, "int")
            );
            $Result32 = mysql_query($insertSQL32, $conexion);
            mysql_free_result($insertSQL32);
            $resmetadata = 1;
          } else {
            $resmetadata = 1;
          }



          /*
$json = file_get_contents('https://sisg.supernotariado.gov.co/firmado/'.$files3.'.json');
$decoded_json = json_decode($json, true);
$rew= $decoded_json['pdfSignatureInfo'];
foreach($rew as $rews) {
    $namefirma=$rews['name'];
}*/
          $namefirma = '1';

          if (isset($namefirma) && "" != $namefirma) {
            $insertSQL34 = sprintf(
              "UPDATE apostilla SET firmadigital=1 WHERE identificador_a=%s and id_notaria=%s and estado_apostilla=1",
              GetSQLValueString($_POST["id_apostilla_firmada"], "text"),
              GetSQLValueString($id, "int")
            );
            $Result34 = mysql_query($insertSQL34, $conexion);
            mysql_free_result($insertSQL34);
            $resfirmadigital = 1;
          } else {
            $resfirmadigital = 0;
          }
        } else {
          $resmetadata = 0;
          $resfirmadigital = 0;
        }




        if (1 == $resmetadata && 1 == $resfirmadigital) {

          function nameapostilla($idapostilla)
          {
            global $mysqli;
            $query4n3 = sprintf("SELECT nombre_tipo_apostilla FROM tipo_apostilla where coddocumento='$idapostilla' limit 1");
            $result4n3 = $mysqli->query($query4n3);
            $row4n3 = $result4n3->fetch_array(MYSQLI_ASSOC);
            $estadopq = $row4n3['nombre_tipo_apostilla'];
            return $estadopq;
            $result4n3->free();
          }


          function namenotaria($idn)
          {
            global $mysqli;
            $query4n3m = sprintf("SELECT nombre_notaria, email_notaria FROM notaria where id_notaria=" . $idn . " limit 1");
            $result4n3m = $mysqli->query($query4n3m);
            $row4n3m = $result4n3m->fetch_array(MYSQLI_ASSOC);
            $estadopqm = $row4n3m['nombre_notaria'] . ' / ' . $row4n3m['email_notaria'];
            return $estadopqm;
            $result4n3m->free();
          }

          echo $insertado;

          $identiapostilla = $_POST["id_apostilla_firmada"];


          $sqlapos = "SELECT * FROM apostilla, notaria WHERE apostilla.id_notaria=notaria.id_notaria and  identificador_a='$identiapostilla' and apostilla.id_notaria=" . $id . " and estado_apostilla=1 limit 1";

          $consulta5 = mysql_query($sqlapos, $conexion);
          $row15 = mysql_fetch_assoc($consulta5);
          $nn5 = mysql_num_rows($consulta5);
          if (0 < $nn5) {


            $nombreapostilla = nameapostilla($row15['id_tipo_apostilla']);



            $emailu = $row15['correo'] . ''; //,temas.internos@cancilleria.gov.co
            $subject = 'Documento firmado digitalmente con fines de Apostilla o de Legalización';
            $cuerpo = '';
            $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
            $cuerpo .= "Señor usuario: <br><br>
Su documento con fines de Apostilla o de Legalización ante el Ministerio de Relaciones Exteriores ha sido firmado digitalmente y aprobado con los siguientes datos:";
            $cuerpo .= "<br><br>";
            $cuerpo .= "<b>Código: </b> " . $row15['identificador_a'];
            $cuerpo .= "<br><br>";
            $cuerpo .= 'Autoridad: ' . quees('funcionario', $row15['id_funcionario']) . '<br>';
            $cuerpo .= 'Notaria: ' . $row15['nombre_notaria'] . ' / ' . $row15['email_notaria'] . '<br>';
            $cuerpo .= 'Tipo de documento: ' . $nombreapostilla . '<br>';
            $cuerpo .= 'Titular del Documento: ' . $row15['titular'] . '<br>';
            $cuerpo .= 'Solicitante: ' . $row15['solicitante'] . '<br>';
            $cuerpo .= 'Número del documento: ' . $row15['serial'] . '<br>';
            $cuerpo .= 'Fecha del Documento: ' . $row15['fecha_inscripcion'] . '<br>';




            $cuerpo .= '<br><br>Confirme que los datos registrados estén correctos y correspondan a su documento, y verifique que se encuentre digitalizado en el sistema de forma clara y completa en <a href="https://servicios.supernotariado.gov.co/radicado_apostilla.html">https://servicios.supernotariado.gov.co/radicado_apostilla.html</a>, donde podrá consultarlo y descargarlo con el código indicado previamente.
            <br><br>
            En caso de existir algún error o inconsistencia en la información o digitalización del documento, deberá solicitar su corrección ante la Notaría respectiva, con antelación a la continuación del trámite de Apostilla o de Legalización ante el Ministerio de Relaciones Exteriores, toda vez que expedida la Apostilla o la Legalización, no hay lugar a corrección ni devolución de dinero.
            <br><br>
            Cualquier inconsistencia, falta de firma digital, falta de metadatos, mala digitalización o error atribuible a la notaría, implica que la notaría deba repetir el procedimiento de digitalización y cargue del documento y de diligenciamiento de la información en el aplicativo para tal fin, sin que se genere un costo adicional por ello al usuario.
            <br><br>
            Solicite la Apostilla o la Legalización en línea a través del sitio web del Ministerio de Relaciones Exteriores en <a href="https://tramites.cancilleria.gov.co/apostillalegalizacion/solicitud/inicio.aspx">https://tramites.cancilleria.gov.co/apostillalegalizacion/solicitud/inicio.aspx</a> opción “Documentos Electrónicos con firma digital” - Documentos firmados en Notarías colombianas, seleccionando el país de destino e ingresando el código de su documento <b>' . $row15['identificador_a'] . '</b>
            <br><br>
            Verifique que la información que le genera el sistema este correcta y continúe con el pago.
            <br><br>
            Cordialmente,';



            $cuerpo .= '<br><br><br>Superintendencia de Notariado y Registro<br>';
            $cuerpo .= "<br></div><br></div>";
            $cabeceras = '';
            $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
            $cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
            $cabeceras .= "MIME-Version: 1.0\r\n";
            $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";


            mail($emailu, $subject, $cuerpo, $cabeceras);
          }
          mysql_free_result($consulta5);
        } else {

          echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El documento pdf tiene errores.</div>';
        }
      } else {
        $files = '';
        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
      }
    } else {
      $files = '';
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
    }
  } else {
    $files = '';
  }
} else {
}





if ((isset($_POST["id_tipo_apostilla"])) && ("" != $_POST["id_tipo_apostilla"])) {


  $identificadora = $codigo_dane . $_POST["id_tipo_apostilla"] . $identi;
  $tamano_archivo = 11534336;
  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
  $formato_archivo = array('pdf');


  $directoryftp = "filesnr/crearapostilla/";









  if (isset($_FILES['file']['name']) && "" != $_FILES['file']['name']) {

    $ruta_archivo = $identificadora;

    $archivo = $_FILES['file']['tmp_name'];
    $tam_archivo = filesize($archivo);
    $tam_archivo2 = $_FILES['file']['size'];
    $nombrefile = strtolower($_FILES['file']['name']);
    //echo '<script>alert("'.$nombrefile.'");</script>';
    $info = pathinfo($nombrefile);

    $extension = $info['extension'];

    $array_archivo = explode('.', $nombrefile);
    $extension2 = end($array_archivo);

    //echo $tam_archivo;
    //echo $tam_archivo2;



    if ($tamano_archivo >= intval($tam_archivo2)) {

      if (($extension2 == $extension)) {
        $files = $ruta_archivo . '.' . $extension;
        $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
        //chmod($files,0777);
        $nombrebre_orig = ucwords($nombrefile);


        $documentof = 'filesnr/crearapostilla/' . $ruta_archivo . '.pdf';
        if (file_exists($documentof)) {
          $insertSQL = sprintf(
            "INSERT INTO apostilla (identificador_a, id_notaria, id_funcionario, 
            id_tipo_apostilla, fecha_apostilla, file, tipo_doc_solicitante, numero_solicitante, solicitante, cuenta_correo, correo, tratamiento, 
            numero_hojas, serial, fecha_inscripcion, titular, autoridad, estado_apostilla) 
            VALUES (%s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            GetSQLValueString($identificadora, "text"),
            GetSQLValueString($id, "int"),
            GetSQLValueString($_SESSION["snr"], "int"),
            GetSQLValueString($_POST["id_tipo_apostilla"], "int"),
            GetSQLValueString($files, "text"),
            GetSQLValueString($_POST["tipo_doc_solicitante"], "text"),
            GetSQLValueString($_POST["numero_solicitante"], "text"),
            GetSQLValueString($_POST["solicitante"], "text"),
            GetSQLValueString(1, "int"),
            GetSQLValueString($_POST["correo"], "text"),
            GetSQLValueString(1, "int"),
            GetSQLValueString(1, "int"),
            GetSQLValueString($_POST["serial"], "text"),
            GetSQLValueString($_POST["fecha_inscripcion"], "date"),
            GetSQLValueString($_POST["titular"], "text"),
            GetSQLValueString($_POST["autoridad"], "text"),
            GetSQLValueString(1, "int")
          );
          $Result = mysql_query($insertSQL, $conexion);
          //echo $insertado;
          mysql_free_result($insertSQL);
          //echo '<div class="alert aviso" style="background:#fff;color:#777;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Registro hecho. Código de verificación: '.$identificadora.'</div>';
          echo '<script type="text/javascript">swal(" OK !", " Código de verificación: ' . $identificadora . '.  - RECUERDE INFORMARLO POR ESCRITO AL CIUDADANO. -", "success");</script>';
        } else {
          $error = '<script type="text/javascript">swal(" ERROR !", " El documento no se cargo. !", "error");</script>';
        }


        /*
        $nombreapostilla=nameapostilla($_POST["id_tipo_apostilla"]);
        $idnotaria=namenotaria($id);


        $emailu=$_POST["correo"].',temas.internos@cancilleria.gov.co'; 
        $subject = 'Documento firmado digitalmente con fines de Apostilla o de Legalización';
        $cuerpo = ''; 
        $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
        $cuerpo .= "Señor usuario: <br><br>
        Su documento con fines de Apostilla o de Legalización ante el Ministerio de Relaciones Exteriores ha sido firmado digitalmente y aprobado con los siguientes datos:
        "; 
        $cuerpo .= "<br><br>"; 
        $cuerpo .= "<b>Código: </b> ".$identificadora;
        $cuerpo .= "<br><br>";
        $cuerpo .= 'Autoridad: '.$nombre_funcionario.'<br>';
        $cuerpo .= 'Notaria: '.$idnotaria.' / '.$email_notaria.'<br>';
        $cuerpo .= 'Tipo de documento: '.$nombreapostilla.'<br>';
        $cuerpo .= 'Titular del Documento: '.$_POST["titular"].'<br>';
        $cuerpo .= 'Solicitante: '.$_POST["solicitante"].'<br>';
        $cuerpo .= 'Número del documento: '.$_POST["serial"].'<br>';
        $cuerpo .= 'Fecha del Documento: '.$_POST["fecha_inscripcion"].'<br>';

        $cuerpo .= '<br><br>Si la información registrada es correcta y corresponde a su documento, solicite la Apostilla o la Legalización en línea ingresando al sitio web del Ministerio de Relaciones Exteriores www.cancilleria.gov.co seleccionando “Trámites y servicios” – Apostilla y Legalización en línea, opción “Documentos Electrónicos con firma digital” - “Documentos firmados en Notarías colombianas”, donde deberá ingresar el código de su documento 
        '.$identificadora.'
        <br><br>
        Verifique que la información que le genera el sistema este correcta y continúe con el pago.
        <br><br>
        En caso de existir algún error o inconsistencia en la información, deberá solicitar su corrección ante la Notaría respectiva, previa nueva solicitud del trámite de Apostilla o de Legalización ante el Ministerio de Relaciones Exteriores, toda vez que expedida la Apostilla o la Legalización, no hay lugar a corrección ni devolución de dinero.
        <br><br>
        Cordialmente,';


        $cuerpo .= '<br><br><br>Superintendencia de Notariado y Registro<br>';
        $cuerpo .= "<br></div><br></div>"; 
        $cabeceras ='';
        $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
        $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
        $cabeceras .= "MIME-Version: 1.0\r\n";
        $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($emailu,$subject,$cuerpo,$cabeceras);

        */
      } else {
        $files = '';
        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
      }
    } else {
      $files = '';
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
    }
  } else {
    $files = '';
  }
} else {
}
?>

<body onpaste="return false"> <!--oncopy="return false"-->


  <?php if (1 == $_SESSION['rol'] or (3 == $_SESSION['snr_tipo_oficina'] && ("" != $_SESSION['posesionnotaria'] or "" != $_SESSION['id_vigilado']))) {
    include 'menu_notaria.php';
  } else {
  } ?>


  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">



          <div class="col-md-5">
            <?php if (isset($id_autoridad_cancilleria) and "" != $id_autoridad_cancilleria) { ?>

              <h3 class="box-title">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span>
                  Nueva Apostilla
                </button>

                <?php //echo $nombre_notaria; 
                ?>
              </h3>
              <br><b>Nota:</b> Cada Notario ya sea titular o encargado debe entrar al sistema con sus propias credenciales y usar su propio codigo de autoridad,
              el nombre debe coincidir con la firma digital que se registra en el documento.


            <?php  } else {
              echo 'El Notario no tiene código de autoridad en Cancilleria. Solicitelo al correo indicando nombre completo del Notario Titular y encargados: registro.firmas@cancilleria.gov.co';
            } ?>
          </div>



          <div class="col-md-7">
            <A HREF="documentos/ManualApostilla.pdf" target="_blank">Manual</A> <br>
            <A HREF="documentos/tiposdocumentales.pdf" target="_blank">Ejemplos</A> <br>
            <A HREF="documentos/videosdeapostilla.pdf" target="_blank">Videos de cada acto</A><br>
            <?php  //if (1==$_SESSION['snr_grupo_cargo']) { } else { 
            ?>
            <i>Recuerde que el Notario titular debe configurar el <a href="https://sisg.supernotariado.gov.co/documentos/MANUAL_ACCESO_MODULOS_NOTARIADO.pdf" target="_blank">acceso a módulos</a> de los usuarios de la Notaria.</i>
            <?php //} 
            ?>
            <!--
            <form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

            <div class="input-group">
            <div class="input-group-btn">Buscar 
            <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - -  </option>
            <option>Tipo de documento</option>
            <option>Solicitante</option>
            <option>Titular</option>
            <option>Serial</option>
                  </select>
            </div>
            <div class="input-group-btn">
            <input type="text" name="buscar" placeholder="" class="form-control" required ></div>
              
            <div class="input-group-btn">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
            </div>
            </div>
            </form>
            -->


          </div>



        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">





            <?php


            $queryn = "SELECT * FROM apostilla, funcionario, tipo_apostilla where apostilla.id_funcionario=funcionario.id_funcionario and  apostilla.id_tipo_apostilla=tipo_apostilla.coddocumento and id_notaria=" . $id . " and estado_apostilla=1 and estado_tipo_apostilla=1 order by id_apostilla desc";
            $selectn = mysql_query($queryn, $conexion);
            $row = mysql_fetch_assoc($selectn);
            $totalRows = mysql_num_rows($selectn);

            if (0 < $totalRows) {
            ?>



              <table class="table table-striped table-bordered table-hover" id="detallefun">

                <thead>
                  <tr align='center' valign='middle'>
                    <!--	<th></th>-->
                    <th>CÓDIGO VERIFICACIÓN</th>
                    <th>TIPO DE APOSTILLA</th>
                    <th>FECHA CREACIÓN</th>
                    <th>FECHA DOCUMENTO</th>
                    <th>AUTORIDAD</th>
                    <th>SOLICITANTE</th>
                    <th>CORREO</th>
                    <th>ID. SOLICITANTE</th>
                    <th>TITULAR</th>
                    <th STYLE="width:110px;"></th>
                    <th>RESULTADO</th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  do {
                    $id_apostilla = $row['id_apostilla'];
                    $id_res = $row['identificador_a'];
                    echo '<tr>';
                    //echo '<td><span style="font-size:7px;color:#fff;">'.$id_apostilla.'</span></td>';
                    echo '<td>';





                    if (isset($row['filefirmado']) and "" != $row['filefirmado']) {

                      $docapostillado = 'filesnr/apostilla/' . $row['filefirmado'];
                      if (file_exists($docapostillado)) {
                        echo '<a href="https://tramites.cancilleria.gov.co/ApostillaLegalizacion/validacionDocumento/superNotariado.aspx?c=23" target="_blank">' . $row['identificador_a'] . '</a>';
                      } else {
                        echo $row['identificador_a'];
                      }
                    } else {
                      echo $row['identificador_a'];
                    }
                    echo '</td>';
                    echo '<td>' . $row['nombre_tipo_apostilla'] . '</td>';
                    echo '<td>' . $row['fecha_apostilla'] . '</td>';
                    echo '<td>' . $row['fecha_inscripcion'] . '</td>';
                    echo '<td>' . $row['autoridad'] . ' / ' . $row['nombre_funcionario'] . '</td>';
                    echo '<td>' . $row['solicitante'] . '</td>';
                    echo '<td>' . $row['correo'] . '</td>';
                    echo '<td>' . $row['numero_solicitante'] . '</td>';

                    echo '<td>' . $row['titular'] . '</td>';


                    echo '<td>';
                    $documentof = 'filesnr/crearapostilla/' . $id_res . '.pdf';




                    if (file_exists($documentof)) {
                      //echo ' <a href="https://servicios.supernotariado.gov.co/pdfmetadato/?q='.$id_res.'" title="Con metadatos"><span class="fa fa-file-pdf-o" style="color:red"></span></a> ';
                      //echo ' <a target="_blank" href="http://192.168.202.57/wsIntegrarMetadataPDF/?q='.$id_res.'" title="Con metadatos"><span class="fa fa-file-pdf-o" style="color:red"></span></a> ';

                      if (isset($row['filefirmado'])) {
                      } else {
                        echo ' <a target="_blank" href="https://sisg.supernotariado.gov.co/wsrest/wsIntegrarMetadataPDF/?q=' . $id_res . '" title="Pdf"><span class="fa fa-file-pdf-o" style="color:red"></span></a> ';
                      }


                      if (isset($row['filefirmado']) and "" != $row['filefirmado']) {
                        $existe = 1;


                        $documentofinal = 'filesnr/apostilla/' . $row['filefirmado'] . '.pdf';
                        //if (file_exists($documentofinal)) {


                        if (1 == $row['metadata'] and 1 == $row['firmadigital']) {
                          //echo '  &nbsp; <span class="fa fa-file" style="color:#eee;"></span>';
                        } else {
                          echo ' &nbsp; <a href="" class="buscar_apostilla" id="' . $id_res . '" name="' . $id_res . '" data-toggle="modal" data-target="#popupapostilla"><span class="fa fa-file" style="color:#F39C3F;"></span></a> ';
                        }
                      } else {
                        $existe = 0;
                        echo ' &nbsp; <a href="" class="buscar_apostilla" id="' . $id_res . '" name="' . $id_res . '" data-toggle="modal" data-target="#popupapostilla"><span class="fa fa-file" style="color:#F39C3F;"></span></a> ';
                      }

                      if (isset($row['filefirmado']) and "" != $row['filefirmado']) {
                        if (1 == $row['metadata'] and 1 == $row['firmadigital']) {
                          echo ' &nbsp;  <a href="filesnr/apostilla/' . $row['filefirmado'] . '" target="_blank" title="' . $row['fecha_firma'] . '"><span class="fa fa-file" style="color:#3D8939"></span></a> ';
                        } else {
                          echo ' &nbsp;  <a href="filesnr/apostilla/' . $row['filefirmado'] . '" target="_blank" title="' . $row['fecha_firma'] . '"><span class="fa fa-file" style="color:#eee"></span></a> ';
                        }
                      } else {

                        echo ' &nbsp;Falta firma';
                      }
                    } else {

                      echo ' <span class="fa fa-close" title="Error, debe volver a cargar documento" style="color:#ff0000;"></span> Error, Borrrar ';
                      echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="apostilla" id="' . $id_apostilla . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                    }

                    echo '</td><td>';


                    if (1 == $existe) {


                      //if (file_exists($documentofinal)) {

                      if (1 == $row['metadata'] and 1 == $row['firmadigital']) {
                        echo 'Carga Ok';
                      } else {
                        echo 'Pdf-Error';
                      }



                      $iden2 = explode('.', $row['filefirmado']);
                      $iden = $iden2[0];

                      echo ' <a href="detalle_apostilla&' . $iden . '&' . $row['autoridad'] . '.jsp" target="_blank" title="Información del documento."><span class="fa fa-search" style="color:#669900;"></span></a> ';

                      if (1 == $_SESSION['rol']) {


                        //echo ' <a href="detalle_apostilla&'.$iden.'&'.$row['autoridad'].'.jsp" target="_blank" title="Información del documento."><span class="fa fa-search" style="color:#669900;"></span></a> ';


                        echo ' <a href="https://sisg.supernotariado.gov.co/wsrest/wsVersionPDF/' . $iden . '.json" target="_blank" title="Ver versión"><span class="fa fa-search" style="color:#3179B0;"></span></a> ';

                        echo ' <a href="https://sisg.supernotariado.gov.co/wsrest/wsMetadataPDF/' . $iden . '.json" target="_blank" title="Revisar metadatos"><span class="fa fa-search" style="color:#ff0000"></span></a> ';

                        echo ' <a href="firmado/' . $iden . '.json" target="_blank" title="Ver firma"><span class="fa fa-search" style="color:#3D8939"></span></a>';
                      } else {
                      }

                      if ($id_apostilla >= 27981) {
                        if ($id_apostilla <= 28430) {
                          echo ' No cumple';
                        } else {
                        }
                      } else {
                      }

                    } else {
                      echo 'No existe';
                    }



                    echo '</td></tr>';
                  } while ($row = mysql_fetch_assoc($selectn));
                  mysql_free_result($selectn);


                  ?>
                  <script>
                    $(document).ready(function() {
                      $('#detallefun').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                          // 'copyHtml5',
                          //'excelHtml5'

                          // 'pdfHtml5'
                        ],
                        "lengthMenu": [
                          [50, 100, 200, 300, 500],
                          [50, 100, 200, 300, 500]
                        ],
                        "language": {
                          "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                        },
                        "aaSorting": [
                          [2, "desc"]
                        ]
                      });
                    });
                  </script>

                </tbody>
              </table>
            <?php } else {
              echo 'No existen registros';
            } ?>





          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->

      </div> <!-- FINAL PRIMARY -->
    </div> <!-- FINAL DE COL MD 12 -->
  </div><!-- FINAL DE ROW -->











  <div class="modal fade" id="popupapostilla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Apostilla</b>, identificador: <span id="idapostilla"></span></h4>
        </div>
        <div class="ver_apostilla" class="modal-body">

        </div>
      </div>
    </div>
  </div>








  <script type="text/javascript">
    function validate() {

      if (document.getElementById('clave_c2').value == document.getElementById('clave_c').value) {
        return true;
      } else {
        alert("Los correos electrónicos deben coincidir identicamente en los dos campos.");
        return false;
      }


    }


    window.onload = function() {
      var myInput = document.getElementById('bloquear');
      myInput.onpaste = function(e) {
        e.preventDefault();
        alert("esta acción está prohibida");
      }

      myInput.oncopy = function(e) {
        e.preventDefault();
        alert("esta acción está prohibida");
      }
    }
  </script>




  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>APOSTILLA</b></h4>
        </div>
        <div id="nuevaAventura" class="modal-body">


          <form action="" method="POST" name="fo443ewrewr4r4324546456456m1" enctype="multipart/form-data" onsubmit="return validate();">
            <center> DATOS DEL SOLICITANTE</center>
            <br>
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO DE IDENTIFICACIÓN DEL SOLICITANTE:</label>
              <select class="form-control" name="tipo_doc_solicitante" required>
                <option selected></option>
                <option value="" selected=""></option>
                <option value="1">Cédula de ciudadania</option>
                <option value="2">Cédula de extranjeria</option>
                <option value="3">Pasaporte</option>
                <option value="4">Nit</option>
                <option value="5">Tarjeta de identidad</option>
                <option value="6">Registro civil de nacimiento</option>
                <option value="8">DNI - Documento nacional de identidad</option>
                <option value="9">PEP - Permiso especial de permanencia</option>
                <option value="12">Permiso de protección temporal</option>

              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE IDENTIFICACIÓN - SOLICITANTE:</label>
              <input type="text" class="form-control" name="numero_solicitante" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE SOLICITANTE (Persona que realiza el tramite):</label>
              <input type="text" class="form-control" name="solicitante" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CORREO ELECTRÓNICO:</label>
              <input type="email" class="form-control" name="correo" id="clave_c" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> REPITA EL CORREO ELECTRÓNICO:</label>
              <input type="email" class="form-control" id="clave_c2" required>
            </div>

            <hr>
            <br>
            <center>DATOS DEL DOCUMENTO A APOSTILLAR</CENTER>
            <BR>
            <BR>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO A APOSTILLAR: (<A HREF="documentos/ManualApostilla.pdf" target="_blank">Manual</A> / <A HREF="documentos/tiposdocumentales.pdf" target="_blank">Ejemplos</A>)</label>
              <select class="form-control" name="id_tipo_apostilla" required>
                <option value="" selected></option>
                <optgroup label="Autorizados directamente por la Notaria">
                  <option value="2772">Registro Civil Nacimiento - 2772</option>
                  <option value="2773">Registro Civil Matrimonio - 2773</option>
                  <option value="2774">Registro Civil Defunción - 2774</option>
                  <option value="3208">Escritura Pública - 3208</option>
                  <option value="2893">Declaración Extraproceso - 2893</option>
                  <option value="3209">Certificación Notarial - 3209</option>
                  <option value="2948">Libro de Registro de varios - 2948</option>
                  <option value="3015">Edicto - 3015</option>
                </optgroup>
                <optgroup label="Reconocimiento de firma y contenido en documento privado">
                  <option value="2954">Certificación - 2954</option>
                  <option value="3053">Constancia - 3053</option>
                  <option value="3093">Declaración - 3093</option>
                  <option value="3057">Carta - 3057</option>
                  <option value="2972">Acta - 2972</option>
                  <option value="2920">Autorización - 2920</option>
                  <option value="2968">Formato - 2968</option>
                  <option value="2913">Acuerdo - 2913</option>
                  <option value="2746">Contrato - 2746</option>
                  <option value="3046">Convenio - 3046</option>
                  <option value="3210">Cesión - 3210</option>
                  <option value="3052">Informe - 3052</option>
                  <option value="2941">Resolución - 2941</option>
                  <option value="3211">Fórmula - 3211</option>
                  <option value="3212">Extracto - 3212</option>
                  <option value="3213">Anexo - 3213</option>
                  <option value="3214">Consulta web - 3214</option>
                  <option value="3215">Carnet - 3215</option>
                  <option value="2642">Cedula ciudadania - 2642</option>
                  <option value="2682">Cedula de Extranjeria - 2682</option>
                  <option value="2644">Tarjeta de identidad - 2644</option>
                  <option value="3216">Contraseña documento de identidad - 3216</option>
                  <option value="3217">Comprobante de documento en trámite - 3217</option>
                  <option value="2943">Certificado de supervivencia - 2943</option>
                  <option value="3067">Certificado Fe de vida - 3067</option>
                  <option value="2767">Estatutos - 2767</option>
                  <option value="2711">Factura de venta - 2711</option>
                  <option value="2724">Garantía - 2724</option>
                  <option value="3218">Pagare - 3218</option>
                  <option value="2686">Permiso salida menor - 2686</option>
                  <option value="2749">Poder - 2749</option>
                  <option value="3219">Recibo de pago - 3219</option>
                  <option value="3220">Libro - 3220</option>
                  <option value="3221">Fotografía - 3221</option>
                  <option value="3222">Artículo - 3222</option>
                  <option value="3223">Publicidad - 3223</option>
                  <option value="3224">Correo o mensaje electrónico - 3224</option>
                  <option value="3225">Certificación Documento de estudio - 3225</option> - 3225</option>
                  <option value="3258">Traducción Oficial - 3258</option>
                </optgroup>
                <optgroup label="Autenticación de copia">
                  <option value="3214">Consulta web - 3214</option>
                  <option value="3215">Carnet - 3215</option>
                  <option value="2642">Cedula ciudadania - 2642</option>
                  <option value="2682">Cedula de Extranjeria - 2682</option>
                  <option value="2644">Tarjeta de identidad - 2644</option>
                  <option value="3216">Contraseña documento de identidad - 3216</option>
                  <option value="3217">Comprobante de documento en trámite - 3217</option>
                  <option value="3219">Recibo de pago - 3219</option>
                  <option value="3220">Libro - 3220</option>
                  <option value="3221">Fotografía - 3221</option>
                  <option value="3222">Articulo - 3222</option>
                  <option value="3223">Publicidad - 3223</option>
                  <option value="3224">Correo o mensaje electrónico - 3224</option>

                </optgroup>
              </select>
            </div>


            <!--
            <div class="form-group text-left"> 
            <label  class="control-label"><span style="color:#ff0000;">*</span> TRATAMIENTO:</label> 
            <select class="form-control" name="tratamiento"  required>
            <option></option>
            <option value="1">Original</option>
            <option value="2">Copia</option>
            </select>
            </div>-->

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> TITULAR Ó TITULARES (Separados por / ) (Exactamente como aparece en el Documento):</label>
              <input type="text" class="form-control" name="titular" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label">IDENTIFICADOR DEL DOCUMENTO (Serial ó código interno del documento) :</label>
              <input type="text" class="form-control" name="serial">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL DOCUMENTO (Fecha de expedición del documento.):</label>
              <input type="text" readonly="readonly" class="form-control datepickera" required name="fecha_inscripcion">
            </div>





            <script>
              function fileValidation() {
                var fileInput = document.getElementById('file');
                var filePath = fileInput.value;


                var fsize = 10000;
                var fileSize = fileInput.files[0].size;
                var siezekiloByte = parseInt(fileSize / 1024);

                //  alert(siezekiloByte+'<'+fsize);

                if (siezekiloByte < fsize) {

                  var allowedExtensions = /(.pdf)$/i;
                  if (!allowedExtensions.exec(filePath)) {
                    alert('Solo se permite extension .pdf.');
                    fileInput.value = '';
                    document.getElementById('imagePreview').innerHTML = 'Error por tipo de archivo';
                    return false;
                  } else {
                    //Image preview
                    if (fileInput.files && fileInput.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = 'ok';
                      };
                      reader.readAsDataURL(fileInput.files[0]);
                    }
                  }

                } else {
                  alert('Debe ser inferior a 10000 Kb, el archivo cargado es de ' + siezekiloByte + ' Kb');
                  fileInput.value = '';
                  document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
                  return false;
                }

              }
            </script>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>DOCUMENTO: (Solo se permite formato .pdf menor a 10 Mg)</label>
              <input type="file" id="file" class="form-control" name="file" required onchange="return fileValidation()">
              <div id="imagePreview"></div>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>ID AUTORIDAD: <span style="color:#ff0000;">Posteriormente debe firmarlo digitalmente la misma persona.</span></label>
              <input type="text" class="form-control" readonly name="autoridad" value="<?php echo $id_autoridad_cancilleria; ?>" required>
              <?php echo $nombre_funcionario; ?>
            </div>

            <div class="modal-footer">

              <span style="color:#ff0000;">* Obligatorio</span>
              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success"><input type="hidden" name="table" value="apostilla"><span class="glyphicon glyphicon-ok"></span> Enviar para apostillar </button>
            </div>




          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function mayus(e) {
      e.value = e.value.toUpperCase();
    }
  </script>


</body>